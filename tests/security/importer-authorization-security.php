<?php
/**
 * Static authorization checks for destructive demo-import AJAX handlers.
 *
 * Run from the TravelFic Toolkit plugin root:
 * php tests/security/importer-authorization-security.php
 */

$root          = dirname( __DIR__, 2 );
$importer_file = $root . '/inc/class/class-importer.php';
$list_file     = $root . '/inc/class/class-template-list.php';

foreach ( array( $importer_file, $list_file ) as $file ) {
	if ( ! is_readable( $file ) ) {
		fwrite( STDERR, "Missing fixture: {$file}\n" );
		exit( 1 );
	}
}

function travelfic_import_security_assert( $condition, $message ) {
	if ( ! $condition ) {
		fwrite( STDERR, "FAIL: {$message}\n" );
		exit( 1 );
	}
}

function travelfic_import_security_method_body( $source, $method ) {
	$matched = preg_match(
		'/function\s+' . preg_quote( $method, '/' ) . '\s*\(/',
		$source,
		$matches,
		PREG_OFFSET_CAPTURE
	);
	travelfic_import_security_assert( 1 === $matched, "Method {$method} not found." );

	$offset = $matches[0][1];
	$brace  = strpos( $source, '{', $offset );
	travelfic_import_security_assert( false !== $brace, "Method {$method} has no body." );

	$depth  = 0;
	$length = strlen( $source );
	for ( $index = $brace; $index < $length; $index++ ) {
		if ( '{' === $source[ $index ] ) {
			$depth++;
		} elseif ( '}' === $source[ $index ] ) {
			$depth--;
			if ( 0 === $depth ) {
				return substr( $source, $brace, $index - $brace + 1 );
			}
		}
	}

	travelfic_import_security_assert( false, "Method {$method} body is not balanced." );
}

$importer_source = file_get_contents( $importer_file );
$list_source     = file_get_contents( $list_file );
$handlers        = array(
	'travelfic-global-settings-import'     => array( 'prepare_travelfic_global_settings', '$template_key' ),
	'travelfic-customizer-settings-import' => array( 'prepare_travelfic_customizer_settings', 'remove_theme_mods' ),
	'travelfic-demo-hotel-import'          => array( 'prepare_travelfic_hotel_imports', '$template_key' ),
	'travelfic-demo-tour-import'           => array( 'prepare_travelfic_tour_imports', '$tours_post' ),
	'travelfic-demo-car-import'            => array( 'prepare_travelfic_car_imports', '$tours_post' ),
	'travelfic-demo-pages-import'          => array( 'prepare_travelfic_pages_imports', '$template_key' ),
	'travelfic-demo-widget-import'         => array(
		'prepare_travelfic_widgets_imports',
		'travelfic_toolkit_clear_widgets',
	),
	'travelfic-demo-menu-import'           => array( 'prepare_travelfic_menus_imports', '$template_key' ),
);

travelfic_import_security_assert( 8 === count( $handlers ), 'The reported handler matrix must contain eight actions.' );

$guard = travelfic_import_security_method_body( $importer_source, 'verify_import_request' );
travelfic_import_security_assert(
	false !== strpos( $guard, "check_ajax_referer( 'updates', '_ajax_nonce' )" ),
	'The shared import guard must retain nonce validation.'
);
travelfic_import_security_assert(
	false !== strpos( $guard, "current_user_can( 'manage_options' )" ),
	'The shared import guard must require administrator capability.'
);
travelfic_import_security_assert(
	false !== strpos( $guard, 'wp_send_json_error' ) && false !== strpos( $guard, '403' ),
	'Unauthorized import requests must return a JSON error with HTTP 403.'
);
travelfic_import_security_assert(
	false !== strpos( $list_source, "'manage_options'" ),
	'The import guard must match the template-library screen capability.'
);

foreach ( $handlers as $action => $handler ) {
	list( $method, $first_operation ) = $handler;
	$registration = "add_action( 'wp_ajax_{$action}', array( \$this, '{$method}' ) )";

	travelfic_import_security_assert(
		false !== strpos( $importer_source, $registration ),
		"AJAX action {$action} must remain registered."
	);

	$body             = travelfic_import_security_method_body( $importer_source, $method );
	$guard_offset     = strpos( $body, '$this->verify_import_request()' );
	$operation_offset = strpos( $body, $first_operation );

	travelfic_import_security_assert(
		false !== $guard_offset,
		"Handler {$method} must call the shared import guard."
	);
	travelfic_import_security_assert(
		false !== $operation_offset && $guard_offset < $operation_offset,
		"Handler {$method} must authorize before processing import data."
	);
}

$bricks_handler = travelfic_import_security_method_body( $importer_source, 'prepare_bricks_template_import' );
travelfic_import_security_assert(
	false !== strpos( $bricks_handler, '$this->verify_import_request()' ),
	'The Bricks importer must use the same authorization boundary.'
);

echo "TravelFic Toolkit importer authorization regression checks passed.\n";
