<?php
defined( 'ABSPATH' ) || exit;
/**
 * Travelfic Importer Class
 * @since 1.0.0
 * @author Jahid
 */
if ( ! class_exists( 'Travelfic_Template_Importer' ) ) {
	class Travelfic_Template_Importer {

		private static $instance = null;

		/**
		 * Singleton instance
		 * @since 1.0.0
		 */
		public static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function __construct() {
			add_action( 'wp_ajax_travelfic-global-settings-import', array( $this, 'prepare_travelfic_global_settings' ) );
			add_action( 'wp_ajax_travelfic-customizer-settings-import', array( $this, 'prepare_travelfic_customizer_settings' ) );
			add_action( 'wp_ajax_travelfic-customizer-hotel-import', array( $this, 'prepare_travelfic_hotel_imports' ) );
		}

		/**
		 * Tourfic Global Settings
		 */
		public function prepare_travelfic_global_settings() {
            $settings_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/settings.json';
            if (file_exists($settings_files)) {
                $imported_data = file_get_contents($settings_files);
                $imported_data = unserialize( $imported_data );
                update_option( 'tf_settings', $imported_data );
                wp_send_json_success($imported_data);
                die();
            }
		}

        /**
		 * Tourfic Customizer Settings
		 */
		public function prepare_travelfic_customizer_settings() {
            // $customizer_data = get_theme_mods();

            // // Output or use the retrieved data
            // var_dump(json_encode($customizer_data));

            $customizers_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/customizer.json';
            if (file_exists($customizers_files)) {
                $imported_data = file_get_contents($customizers_files);
                $imported_data = json_decode( $imported_data, true );
                // var_dump($imported_data);
                foreach ($imported_data as $key => $value) {
                    set_theme_mod($key, $value);
                }
                die();
            }
		}

        /**
		 * Tourfic Customizer Settings
		 */
		public function prepare_travelfic_hotel_imports() {

            $dummy_hotels_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/hotel-data.csv';
            if (file_exists($dummy_hotels_files)) {
                $imported_data = file_get_contents($dummy_hotels_files);
                
            }
		}

	}
}

new Travelfic_Template_Importer();