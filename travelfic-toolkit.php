<?php

/**
 * Plugin Name: Travelfic Toolkit
 * Plugin URI: https://psdtowpservice.com/plugins
 * Description: Toolkit for travelfic Theme which containing widgets and some extra functions.
 * Author: AWEB-Squad
 * Text Domain: travelfic-toolkit
 * Domain Path: /lang/
 * Author URI: https://themeforest.net/user/aweb-squad
 * Version: 1.0.0
 */

// don't load directly
if (!defined('ABSPATH')) {
	exit;
}

final class Travelfic_Toolkit
{
	/**
	 * Constructor
	 */

	public function __construct()
	{

		// Const Variables
		define('TRAVELFIC_PLUGIN_URL', plugin_dir_url(__FILE__));
		define('TRAVELFIC_PLUGIN_VERSION', '1.0.1');

		add_action('plugins_loaded', array($this, 'travelfic_toolkit_loaded_action'), 10, 2);
		$this->include_elementor_widgets();
	}

	/**
	 * Loading Text Domain
	 */
	public function travelfic_toolkit_loaded_action()
	{
		// Internationalization
		load_plugin_textdomain('travelfic-toolkit', false, dirname(plugin_basename(__FILE__)) . '/lang/');
	}

	/**
	 * Include Elementor Widgets
	 */
	private function include_elementor_widgets()
	{
		require_once(dirname(__FILE__) . '/inc/elementor-widgets.php');
	}
}

// Instantiate the Travelfic_Toolkit class
$toolKit = new Travelfic_Toolkit();
