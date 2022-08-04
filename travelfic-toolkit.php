<?php
/**
 * Plugin Name: Travelfic Toolkit
 * Plugin URI: https://themefic.com/
 * Description: Toolkit for travelfic Theme which containing widgets and some extra functions.
 * Author: Themefic
 * Text Domain: travelfic
 * Domain Path: /lang/
 * Author URI: https://themefic.com/
 * Version: 1.0.0
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Include file from plugin if it is not available in theme
 * include( get_theme_file_path( 'includes/headers/breadcrumbs.php' ) );
 */
if( !function_exists('travelfic_get_theme_filepath') ){
function travelfic_get_theme_filepath($path, $file){
	if( !file_exists( $path ) ){
		$plugin_path = plugin_dir_path( __FILE__ ).$file;
		if( file_exists( $plugin_path ) ){
			$path = $plugin_path;
		}
	}
	return $path;
}
}
add_filter( 'theme_file_path', 'travelfic_get_theme_filepath', 10, 2 );

/**
 * Loading Text Domain
 * 
 */
add_action('plugins_loaded', 'travelfic_toolkit_plugin_loaded_action', 10, 2);

function travelfic_toolkit_plugin_loaded_action() {
	//Internationalization 
	load_plugin_textdomain( 'travelfic', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}


/**
 *	Elementor Widgets
 */
require_once( dirname( __FILE__ ) . '/inc/elementor-widgets.php' );

