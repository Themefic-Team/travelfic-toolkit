<?php

define( 'ABSPATH', '/' );

function add_action() {}
function add_filter() {}
function wp_parse_url( $url ) { return parse_url( $url ); }
function esc_url_raw( $url ) { return $url; }

require dirname( __DIR__, 2 ) . '/inc/class/class-menu-data-parser.php';
require dirname( __DIR__, 2 ) . '/inc/class/class-background-css.php';
require dirname( __DIR__, 2 ) . '/inc/class/class-year-shortcode-migration.php';

$checks = array(
	'legacy menu array parses' => is_array( Travelfic_Toolkit_Menu_Data_Parser::parse( 'a:1:{i:0;a:2:{s:5:"title";s:4:"Home";s:3:"url";s:1:"#";}}' ) ),
	'object cannot be constructed' => false === Travelfic_Toolkit_Menu_Data_Parser::parse( 'a:1:{i:0;O:8:"stdClass":0:{}}' ),
	'trailing serialized payload rejected' => false === Travelfic_Toolkit_Menu_Data_Parser::parse( 'a:0:{}i:1;' ),
	'malformed string length rejected' => false === Travelfic_Toolkit_Menu_Data_Parser::parse( 'a:1:{i:0;s:9:"bad";}' ),
	'safe image rule preserved' => false !== strpos( Travelfic_Toolkit_Background_CSS::sanitize_rules( Travelfic_Toolkit_Background_CSS::rule( 'abc123', 'https://example.org/image.jpg' ) ), 'image.jpg' ),
	'CSS injection rejected' => '' === Travelfic_Toolkit_Background_CSS::sanitize_rules( '[data-id="abc"] { background-image: url("https://example.org/a.jpg"); color: red; }' ),
	'unsafe CSS URL rejected' => '' === Travelfic_Toolkit_Background_CSS::rule( 'abc', 'javascript:alert(1)' ),
	'legacy background selector constrained' => '' === Travelfic_Toolkit_Background_CSS::legacy_element_rule( 'abc};body', 'https://example.org/image.jpg' ),
	'old shortcode replaced' => '© [travelfic_toolkit_year]' === Travelfic_Toolkit_Year_Shortcode_Migration::replace_legacy_tag( '© [year]' ),
	'escaped shortcode untouched' => '[[year]]' === Travelfic_Toolkit_Year_Shortcode_Migration::replace_legacy_tag( '[[year]]' ),
);

foreach ( $checks as $name => $passed ) {
	if ( ! $passed ) {
		fwrite( STDERR, "FAIL: {$name}\n" );
		exit( 1 );
	}
}

echo count( $checks ) . " compliance data-guard checks passed.\n";
