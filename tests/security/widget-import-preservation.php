<?php
/**
 * Isolated regression checks for demo widget import preservation.
 *
 * Run: php tests/security/widget-import-preservation.php
 */

define( 'ABSPATH', __DIR__ . '/' );

$options = array();

function get_option( $key, $default = false ) {
	global $options;
	return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
}

function update_option( $key, $value ) {
	global $options;
	$options[ $key ] = $value;
	return true;
}

function apply_filters( $name, $value ) {
	return $value;
}

function add_action() {
	return true;
}

function assert_import( $condition, $message ) {
	if ( ! $condition ) {
		fwrite( STDERR, "FAIL: {$message}\n" );
		exit( 1 );
	}
}

require dirname( __DIR__, 2 ) . '/inc/class/class-importer.php';

$options['sidebars_widgets'] = array(
	'tf-sidebar'    => array(),
	'footer_widgets' => array( 'block-2' ),
);
$options['widget_block'] = array(
	2              => array( 'content' => 'Existing sidebar widget' ),
	15             => array( 'content' => 'Unassigned user widget' ),
	'_multiwidget' => 1,
);

$feed = array(
	array(
		'tf-sidebar'    => array( 'block-15' ),
		'footer_widgets' => array( 'block-16' ),
	),
	array(
		'block' => array(
			15 => array( 'content' => 'Demo widget' ),
			16 => array( 'content' => 'Demo footer widget' ),
			'_multiwidget' => 1,
		),
	),
);

assert_import( Travelfic_Template_Importer::travelfic_toolkit_parse_import_data( $feed ), 'Initial widget import failed.' );
assert_import( array( 'block-16' ) === $options['sidebars_widgets']['tf-sidebar'], 'Empty sidebar was not populated safely.' );
assert_import( array( 'block-2' ) === $options['sidebars_widgets']['footer_widgets'], 'Existing footer sidebar was changed.' );
assert_import( 'Unassigned user widget' === $options['widget_block'][15]['content'], 'Unassigned widget was overwritten.' );
assert_import( 'Demo widget' === $options['widget_block'][16]['content'], 'Demo widget was not imported.' );

$after_first_import = serialize( $options );
assert_import( Travelfic_Template_Importer::travelfic_toolkit_parse_import_data( $feed ), 'Repeated widget import failed.' );
assert_import( $after_first_import === serialize( $options ), 'Repeated import changed existing widgets.' );

echo "Demo widget preservation checks passed.\n";
