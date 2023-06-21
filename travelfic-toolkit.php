<?php
/**
 * Plugin Name: Travelfic Toolkit
 * Plugin URI: https://psdtowpservice.com/plugins
 * Description: Toolkit for travelfic Theme which containing widgets and some extra functions.
 * Author: AWEB-Squad
 * Text Domain: travelfic
 * Domain Path: /lang/
 * Author URI: https://themeforest.net/user/aweb-squad
 * Version: 1.0.0
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'TRAVELFIC_URL', plugin_dir_url( __FILE__ ) );

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


/**
 *	Customizer Settings
 */
require_once( dirname( __FILE__ ) . '/inc/customizer-settings.php' );

/**
 *	Customizer Apply
 */
require_once( dirname( __FILE__ ) . '/inc/customizer-apply.php' );


function enqueue_customizer_scripts() {
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_URL . 'assets/css/style.css');
	wp_enqueue_script( 'travelfic-toolkit-script', TRAVELFIC_URL . 'assets/js/customizer.js', array( 'jquery', 'customize-controls' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'enqueue_customizer_scripts' );

function enqueue_customizer_preview_scripts() {
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_URL . 'assets/css/style.css');
}
add_action( 'customize_preview_init', 'enqueue_customizer_preview_scripts' );
