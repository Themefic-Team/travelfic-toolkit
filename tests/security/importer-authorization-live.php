<?php
/**
 * Live authorization checks for destructive demo-import AJAX handlers.
 *
 * Run from the TravelFic Toolkit plugin root:
 * wp eval-file tests/security/importer-authorization-live.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	fwrite( STDERR, "This check must run inside WordPress.\n" );
	exit( 1 );
}

if ( ! defined( 'DOING_AJAX' ) ) {
	define( 'DOING_AJAX', true );
}

$importer_file = dirname( __DIR__, 2 ) . '/inc/class/class-importer.php';
if ( ! class_exists( 'Travelfic_Template_Importer' ) && is_readable( $importer_file ) ) {
	require_once $importer_file;
}

function travelfic_import_live_assert( $condition, $message ) {
	if ( ! $condition ) {
		fwrite( STDERR, "FAIL: {$message}\n" );
		exit( 1 );
	}
}

function travelfic_import_live_die_handler() {
	return 'travelfic_import_live_throw_on_die';
}

function travelfic_import_live_throw_on_die() {
	throw new RuntimeException( 'WordPress AJAX response completed.' );
}

function travelfic_import_live_capture_status( $status_header, $status_code ) {
	$GLOBALS['travelfic_import_live_status'] = absint( $status_code );

	return $status_header;
}

function travelfic_import_live_site_snapshot() {
	$post_counts = array();
	foreach ( array( 'page', 'tf_hotel', 'tf_tours', 'tf_carrental' ) as $post_type ) {
		$post_counts[ $post_type ] = wp_count_posts( $post_type );
	}

	return md5(
		maybe_serialize(
			array(
				'blogname'                   => get_option( 'blogname' ),
				'blogdescription'            => get_option( 'blogdescription' ),
				'show_on_front'              => get_option( 'show_on_front' ),
				'page_on_front'              => get_option( 'page_on_front' ),
				'page_for_posts'             => get_option( 'page_for_posts' ),
				'permalink_structure'        => get_option( 'permalink_structure' ),
				'sidebars_widgets'           => get_option( 'sidebars_widgets' ),
				'tf_settings'                => get_option( 'tourfic_settings' ),
				'travelfic_template_version' => get_option( 'travelfic_template_version' ),
				'theme_mods'                 => get_option( 'theme_mods_' . get_option( 'stylesheet' ) ),
				'post_counts'                => $post_counts,
				'menu_count'                 => wp_count_terms(
					array(
						'taxonomy'   => 'nav_menu',
						'hide_empty' => false,
					)
				),
			)
		)
	);
}

function travelfic_import_live_registered_importer( $action ) {
	global $wp_filter;

	$hook = 'wp_ajax_' . $action;
	if ( empty( $wp_filter[ $hook ]->callbacks ) ) {
		return null;
	}

	foreach ( $wp_filter[ $hook ]->callbacks as $callbacks ) {
		foreach ( $callbacks as $callback ) {
			$function = isset( $callback['function'] ) ? $callback['function'] : null;
			if (
				is_array( $function )
				&& isset( $function[0] )
				&& $function[0] instanceof Travelfic_Template_Importer
			) {
				return $function[0];
			}
		}
	}

	return null;
}

$administrators = get_users(
	array(
		'role'   => 'administrator',
		'number' => 1,
		'fields' => 'all',
	)
);
$subscribers = get_users(
	array(
		'role'   => 'subscriber',
		'number' => 1,
		'fields' => 'all',
	)
);

if ( empty( $administrators[0] ) || empty( $subscribers[0] ) ) {
	echo "TravelFic importer live checks skipped: administrator and Subscriber users are required.\n";
	return;
}

$actions = array(
	'travelfic-global-settings-import',
	'travelfic-customizer-settings-import',
	'travelfic-demo-hotel-import',
	'travelfic-demo-tour-import',
	'travelfic-demo-car-import',
	'travelfic-demo-pages-import',
	'travelfic-demo-widget-import',
	'travelfic-demo-menu-import',
);

foreach ( $actions as $action ) {
	travelfic_import_live_assert(
		false !== has_action( 'wp_ajax_' . $action ),
		"AJAX callback {$action} is not registered."
	);
}
$importer = travelfic_import_live_registered_importer( $actions[0] );
travelfic_import_live_assert(
	$importer instanceof Travelfic_Template_Importer,
	'The registered importer callback could not be inspected.'
);

add_filter( 'wp_die_ajax_handler', 'travelfic_import_live_die_handler' );
add_filter( 'status_header', 'travelfic_import_live_capture_status', 10, 2 );
wp_set_current_user( $subscribers[0]->ID );
$site_snapshot = travelfic_import_live_site_snapshot();

foreach ( $actions as $action ) {
	$_POST = array(
		'action'           => $action,
		'_ajax_nonce'      => wp_create_nonce( 'updates' ),
		'template_version' => '1',
	);
	$_REQUEST = $_POST;

	$GLOBALS['travelfic_import_live_status'] = 0;
	ob_start();
	$completed = false;
	try {
		do_action( 'wp_ajax_' . $action );
	} catch ( RuntimeException $error ) {
		$completed = true;
	}
	$response = ob_get_clean();
	$data     = json_decode( $response, true );

	travelfic_import_live_assert( $completed, "Subscriber request {$action} did not terminate." );
	travelfic_import_live_assert(
		is_array( $data ) && false === $data['success'],
		"Subscriber request {$action} did not return a JSON error."
	);
	travelfic_import_live_assert(
		403 === $GLOBALS['travelfic_import_live_status'],
		"Subscriber request {$action} did not return HTTP 403."
	);
}

travelfic_import_live_assert(
	$site_snapshot === travelfic_import_live_site_snapshot(),
	'Denied Subscriber imports must not modify site content or settings.'
);

$method   = new ReflectionMethod( $importer, 'verify_import_request' );
$method->setAccessible( true );

wp_set_current_user( $administrators[0]->ID );
$_POST = array( '_ajax_nonce' => wp_create_nonce( 'updates' ) );
$_REQUEST = $_POST;
$method->invoke( $importer );

remove_filter( 'wp_die_ajax_handler', 'travelfic_import_live_die_handler' );
remove_filter( 'status_header', 'travelfic_import_live_capture_status', 10 );
wp_set_current_user( 0 );
$_POST    = array();
$_REQUEST = array();

echo "TravelFic Toolkit importer live authorization checks passed.\n";
