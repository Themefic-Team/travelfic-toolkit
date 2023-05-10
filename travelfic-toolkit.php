<?php
/**
 * Plugin Name: Travelfic Toolkit
 * Plugin URI: https://themefic.com
 * Description: Toolkit for travelfic Theme which containing widgets and some extra functions.
 * Author: Travelfic
 * Text Domain: travelfic
 * Domain Path: /lang/
 * Author URI: https://themefic.com
 * Version: 1.0.1
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


final class TravelFic_toolKit {

	public function __construct() {
		
		define( 'TRAVELFIC_TOOLKIT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
        define( 'TRAVELFIC_TOOLKIT_PLUGIN_VERSION', '1.0.1' );

		add_action('plugins_loaded', array($this, 'travelfic_toolkit_plugin_loaded_action'), 10, 2);
	}

	function travelfic_toolkit_plugin_loaded_action() {
		//Internationalization 
		load_plugin_textdomain( 'travelfic', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
		/**
		*Elementor Widgets
		*/
		require_once( dirname( __FILE__ ) . '/inc/elementor-widgets.php' );
	}
}

$TravelFic_toolKit = new TravelFic_toolKit();




