<?php
/**
 * Regression checks for the template import completion settings link.
 *
 * Run from the TravelFic Toolkit plugin root:
 * php tests/security/tourfic-settings-redirect.php
 */

define( 'ABSPATH', __DIR__ . '/' );

$GLOBALS['travelfic_test_can_manage']   = true;
$GLOBALS['travelfic_test_nonce_action'] = '';

function add_action() {}
function add_filter() {}
function wp_unslash( $value ) {
	return $value;
}
function sanitize_key( $value ) {
	return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( $value ) );
}
function current_user_can( $capability ) {
	return 'manage_options' === $capability && $GLOBALS['travelfic_test_can_manage'];
}
function check_admin_referer( $action ) {
	$GLOBALS['travelfic_test_nonce_action'] = $action;
}
function esc_html__( $text ) {
	return $text;
}
function wp_die( $message, $title = '', $args = array() ) {
	throw new LogicException( (string) ( $args['response'] ?? 0 ) );
}
function admin_url( $path = '' ) {
	return 'https://example.test/wp-admin/' . ltrim( $path, '/' );
}
function wp_safe_redirect( $url ) {
	throw new RuntimeException( $url );
}

function travelfic_settings_redirect_assert( $condition, $message ) {
	if ( ! $condition ) {
		echo "FAIL: {$message}\n";
		exit( 1 );
	}
}

$plugin_root = dirname( __DIR__, 2 );
$list_file   = $plugin_root . '/inc/class/class-template-list.php';
$source      = file_get_contents( $list_file );

travelfic_settings_redirect_assert( false !== $source, 'Template list source must be readable.' );
travelfic_settings_redirect_assert(
	false !== strpos( $source, "add_action( 'admin_init', [ \$this, 'travelfic_tourfic_settings_redirect' ], 5 )" ),
	'The click-time redirect must run before the existing activation redirect.'
);
travelfic_settings_redirect_assert(
	false !== strpos( $source, "admin.php?page=travelfic-template-list&travelfic_tourfic_settings=1" ),
	'The completion link must use the Toolkit redirect instead of freezing a Tourfic slug during rendering.'
);
travelfic_settings_redirect_assert(
	false !== strpos( $source, "wp_nonce_url(" )
	&& false !== strpos( $source, "check_admin_referer( 'travelfic_tourfic_settings_redirect' )" ),
	'The generated redirect link and request handler must share a nonce action.'
);

require_once $list_file;

$template_list = Travelfic_Template_List::instance();

$_GET = array();
$template_list->travelfic_tourfic_settings_redirect();
travelfic_settings_redirect_assert(
	'' === $GLOBALS['travelfic_test_nonce_action'],
	'Unrelated admin requests must bypass the redirect handler.'
);

$_GET['travelfic_tourfic_settings'] = '1';
$legacy_redirect                    = '';

try {
	$template_list->travelfic_tourfic_settings_redirect();
} catch ( RuntimeException $exception ) {
	$legacy_redirect = $exception->getMessage();
}

travelfic_settings_redirect_assert(
	'https://example.test/wp-admin/admin.php?page=tf_settings' === $legacy_redirect,
	'The immediately previous Tourfic version must retain its legacy settings destination.'
);

travelfic_settings_redirect_assert(
	'travelfic_tourfic_settings_redirect' === $GLOBALS['travelfic_test_nonce_action'],
	'The redirect request must verify the expected nonce action.'
);

define( 'TOURFIC_SETTINGS_MENU_SLUG', 'tourfic_settings' );
$current_redirect = '';

try {
	$template_list->travelfic_tourfic_settings_redirect();
} catch ( RuntimeException $exception ) {
	$current_redirect = $exception->getMessage();
}

travelfic_settings_redirect_assert(
	'https://example.test/wp-admin/admin.php?page=tourfic_settings' === $current_redirect,
	'Current Tourfic must resolve to its registered settings slug at click time.'
);

$GLOBALS['travelfic_test_can_manage'] = false;
$denied_response                      = '';

try {
	$template_list->travelfic_tourfic_settings_redirect();
} catch ( LogicException $exception ) {
	$denied_response = $exception->getMessage();
}

travelfic_settings_redirect_assert(
	'403' === $denied_response,
	'The redirect must reject users who cannot manage the settings screen.'
);

echo "TravelFic Toolkit settings redirect regression checks passed.\n";
