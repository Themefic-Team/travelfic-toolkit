<?php
/**
 * Isolated regression checks for non-destructive demo menu import.
 *
 * Run: php tests/security/menu-import-preservation.php
 */

define( 'ABSPATH', __DIR__ . '/' );

$menu_items = array(
	10 => (object) array( 'ID' => 10, 'title' => 'Home', 'url' => 'https://themefic.test/' ),
	11 => (object) array( 'ID' => 11, 'title' => 'User link', 'url' => 'https://example.org/custom' ),
);
$menu_locations = array( 'primary_menu' => 99 );

function add_action() { return true; }
function is_wp_error() { return false; }
function wp_get_nav_menu_object() { return (object) array( 'term_id' => 7 ); }
function wp_get_nav_menu_items() { return array_values( $GLOBALS['menu_items'] ); }
function site_url() { return 'https://themefic.test'; }
function wp_parse_url( $url, $component = -1 ) { return parse_url( $url, $component ); }
function get_theme_mod() { return $GLOBALS['menu_locations']; }
function set_theme_mod( $name, $value ) { $GLOBALS['menu_locations'] = $value; }
function wp_update_nav_menu_item( $menu_id, $item_id, $data ) {
	$id = max( array_keys( $GLOBALS['menu_items'] ) ) + 1;
	$GLOBALS['menu_items'][ $id ] = (object) array(
		'ID' => $id,
		'title' => $data['menu-item-title'],
		'url' => $data['menu-item-url'],
		'parent' => isset( $data['menu-item-parent-id'] ) ? $data['menu-item-parent-id'] : 0,
	);
	return $id;
}

require dirname( __DIR__, 2 ) . '/inc/class/class-importer.php';

$feed = array(
	array(
		'title' => 'Home',
		'url' => 'https://demo.example/',
		'sub_menu' => array(
			array( 'title' => 'Contact', 'url' => 'https://demo.example/contact' ),
		),
	),
);

$result = Travelfic_Template_Importer::travelfic_toolkit_create_menu_from_imported_data( $feed, '1' );
if ( 7 !== $result || 3 !== count( $menu_items ) || 10 !== $menu_items[12]->parent ||
	'User link' !== $menu_items[11]->title || 99 !== $menu_locations['primary_menu'] ) {
	fwrite( STDERR, "FAIL: Import did not preserve the existing menu and attach its missing child.\n" );
	exit( 1 );
}

Travelfic_Template_Importer::travelfic_toolkit_create_menu_from_imported_data( $feed, '1' );
if ( 3 !== count( $menu_items ) ) {
	fwrite( STDERR, "FAIL: Repeated import duplicated menu items.\n" );
	exit( 1 );
}

echo "Demo menu preservation checks passed.\n";
