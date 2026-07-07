<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

final class Travelfic_Toolkit_Bricks_Extensions {

	/**
	 * Instance
	 *
	 * @var Travelfic_Toolkit_Bricks_Extensions The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Travelfic_Toolkit_Bricks_Extensions An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'init' ], 11 );
		add_filter( 'bricks/builder/i18n', [ $this, 'register_bricks_category' ] );
	}

	/**
	 * Initialize the extensions
	 */
	public function init() {
		// If Bricks Elements API is not available, skip registering elements.
		if ( ! class_exists( 'Bricks\Elements' ) ) {
			return;
		}

		// Include and register widgets
		$this->register_widgets();
	}

	/**
	 * Register a category for Travelfic widgets
	 */
	public function register_bricks_category( $i18n ) {
		$i18n['travelfic'] = esc_html__( 'Travelfic', 'travelfic-toolkit' );
		return $i18n;
	}

	/**
	 * Helper: get PHP files from a subdirectory safely
	 */
	private function get_php_files( $subdir ) {
		$base     = plugin_dir_path( __FILE__ );
		$subdir   = trim( $subdir, "\/" );
		$pattern  = $base . ( $subdir ? $subdir . '/' : '' ) . '*.php';
		$files    = glob( $pattern ) ?: [];

		natsort( $files );

		$safe     = [];
		$base_real = realpath( $base );

		foreach ( $files as $file ) {
			$real = realpath( $file );
			if ( $real && strpos( $real, $base_real ) === 0 ) {
				$safe[] = $real;
			}
		}

		return $safe;
	}

	/**
	 * Register Bricks widgets
	 */
	public function register_widgets() {
		$widget_dir = 'bricks-widgets';
		$files = $this->get_php_files( $widget_dir );

		foreach ( $files as $file ) {
			// Use Bricks API to register element files so Bricks can handle them properly
			\Bricks\Elements::register_element( $file );
		}
	}
}

Travelfic_Toolkit_Bricks_Extensions::instance();
