<?php

define( 'ABSPATH', '/' );

$options = array();
$posts = array( 1 => 'Before [year] after', 2 => 'No shortcode' );
$post_meta = array( 1 => array( '_elementor_data' => '[{"text":"[year]"}]' ) );
$writes = 0;

function add_action() {}
function add_filter() {}
function current_user_can() { return true; }
function wp_doing_ajax() { return false; }
function get_theme_mods() { return array(); }
function get_option( $name, $default = false ) { return $GLOBALS['options'][ $name ] ?? $default; }
function update_option( $name, $value ) { $GLOBALS['options'][ $name ] = $value; return true; }
function absint( $value ) { return abs( (int) $value ); }
function wp_slash( $value ) { return addslashes( $value ); }
function is_wp_error() { return false; }
function metadata_exists( $type, $id, $key ) { return isset( $GLOBALS['post_meta'][ $id ][ $key ] ); }
function add_post_meta( $id, $key, $value ) { $GLOBALS['post_meta'][ $id ][ $key ] = stripslashes( $value ); return true; }
function get_post_meta( $id, $key ) { return $GLOBALS['post_meta'][ $id ][ $key ] ?? ''; }
function update_post_meta( $id, $key, $value ) { $GLOBALS['post_meta'][ $id ][ $key ] = stripslashes( $value ); return true; }
function get_post( $id ) { return isset( $GLOBALS['posts'][ $id ] ) ? (object) array( 'ID' => $id, 'post_content' => $GLOBALS['posts'][ $id ] ) : null; }
function wp_update_post( $record ) { $GLOBALS['posts'][ $record['ID'] ] = stripslashes( $record['post_content'] ); $GLOBALS['writes']++; return $record['ID']; }

$wpdb = new class {
	public $posts = 'wp_posts';
	public function prepare( $query, $id ) { return array( $query, $id ); }
	public function get_col( $query ) { return 0 === $query[1] ? array( 1, 2 ) : array(); }
};

require dirname( __DIR__, 2 ) . '/inc/class/class-year-shortcode-migration.php';

Travelfic_Toolkit_Year_Shortcode_Migration::migrate_batch();

if ( 'Before [travelfic_toolkit_year] after' !== $posts[1] ||
	'Before [year] after' !== $post_meta[1]['_travelfic_toolkit_year_shortcode_backup_v1'] ||
	'[{' . '"text":"[travelfic_toolkit_year]"' . '}]' !== $post_meta[1]['_elementor_data'] ||
	'[{' . '"text":"[year]"' . '}]' !== $post_meta[1]['_travelfic_toolkit_year_elementor_backup_v1'] ||
	empty( $options['travelfic_toolkit_year_shortcode_migration_v1']['complete'] ) ) {
	fwrite( STDERR, "FAIL: Migration did not preserve and update content as expected.\n" );
	exit( 1 );
}

Travelfic_Toolkit_Year_Shortcode_Migration::migrate_batch();
if ( 1 !== $writes ) {
	fwrite( STDERR, "FAIL: Completed migration ran more than once.\n" );
	exit( 1 );
}

echo "Year-shortcode migration and backup checks passed.\n";
