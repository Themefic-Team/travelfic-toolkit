<?php
/**
 * Plugin Name: Travelfic Toolkit
 * Plugin URI: https://themefic.com/
 * Description: Toolkit for travelfic Theme which containing widgets and some extra functions.
 * Author: themefic
 * Text Domain: travelfic
 * Domain Path: /lang/
 * Author URI: https://themefic.com
 * Version: 1.0.0
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'TRAVELFIC_URL', plugin_dir_url( __FILE__ ) );

/**
 * Include file from plugin if it is not available in theme
 */
function travelfic_kit_settings() {
    $theme = wp_get_theme();
	if ($theme->get('Name') !== 'Travelfic') {
		add_action( 'admin_notices', 'is_travelfic_active' );
	}
}
add_action( 'admin_init', 'travelfic_kit_settings' );

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
require_once( dirname( __FILE__ ) . '/inc/customizer/customizer-apply.php' );

/**
 *	Admin & Customizer Enqueue
 */

function travelfic_enqueue_customizer_scripts() {
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_URL . 'assets/admin/css/style.css');
	wp_enqueue_script( 'travelfic-toolkit-script', TRAVELFIC_URL . 'assets/admin/js/customizer.js', array( 'jquery', 'customize-controls' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'travelfic_enqueue_customizer_scripts' );

function travelfic_enqueue_customizer_preview_scripts() {
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_URL . 'assets/admin/css/style.css');
}
add_action( 'customize_preview_init', 'travelfic_enqueue_customizer_preview_scripts' );

/**
 *	Front-End Enqueue
 */

add_action('wp_enqueue_scripts', 'travelfic_front_page_script');
function travelfic_front_page_script(){

	wp_enqueue_style( 'travelfic-toolkit-css', TRAVELFIC_URL . 'assets/app/css/style.css', false, '1.0.0');

}

/**
 *	Admin Notice If Travelfic Not Active
 */

if( !function_exists('is_travelfic_active') ){
	function is_travelfic_active() {
	?>	
		<div id="message" class="error">
			<p><?php printf( __( 'Travelfic Toolkit requires %1$s Travelfic Theme %2$s to be activated.', 'travelfic' ), '<strong><a href="https://wordpress.org/themes/travelfic/" target="_blank">', '</a></strong>' ); ?></p>
			<p><a class="install-now button" href="<?php echo esc_url( admin_url( '/theme-install.php?search=travelfic' ) ); ?>"><?php _e( 'Install Now', 'travelfic' ); ?></a></p>
		</div>
	<?php
	}	
}
