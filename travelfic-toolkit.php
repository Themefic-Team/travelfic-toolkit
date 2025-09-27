<?php
/**
 * Plugin Name: Tourfic Toolkit
 * Plugin URI: https://tourfic.site/travelfic/
 * Description: A companion plugin to the Travelfic Theme with which you can easily build your own Hotel, Accommodation, Tour & Travel Booking website on WordPress.
 * Author: Themefic
 * Version: 1.3.1
 * Tested up to: 6.8
 * Text Domain: travelfic-toolkit
 * Domain Path: /lang/
 * Author URI: https://themefic.com
 * Elementor tested up to: 3.31
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// don't load directly
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define( 'TRAVELFIC_TOOLKIT_URL', plugin_dir_url( __FILE__ ) );
define( 'TRAVELFIC_TOOLKIT_PATH', plugin_dir_path( __FILE__ ) );
define( 'TRAVELFIC_TOOLKIT_ASSETS', TRAVELFIC_TOOLKIT_URL . 'assets/' );
define( 'TRAVELFIC_TOOLKIT_VERSION', '1.3.1' );

/**
 * Include file from plugin if it is not available in theme
 */
function travelfic_toolkit_settings() {
    $current_active_theme = !empty(get_option('stylesheet')) ? get_option('stylesheet') : 'No';
    if($current_active_theme == 'travelfic' || $current_active_theme == 'travelfic-child'){
        $theme_folder = wp_get_theme( 'travelfic' );
    }elseif($current_active_theme == 'ultimate-hotel-booking' || $current_active_theme == 'ultimate-hotel-booking-child'){
        $theme_folder = wp_get_theme( 'ultimate-hotel-booking' );
    }else{
        $theme_folder = wp_get_theme( 'travelfic' );
    }
    
    if ( $theme_folder->exists() ) {
        if ( $current_active_theme != 'travelfic' && $current_active_theme != 'travelfic-child' && $current_active_theme != 'ultimate-hotel-booking' && $current_active_theme != 'ultimate-hotel-booking-child' ) {
            add_action( 'admin_notices', 'travelfic_active' );
        }
    } else {
        add_action( 'admin_notices', 'travelfic_install' );
    }
}
add_action( 'admin_init', 'travelfic_toolkit_settings' );

if ( !function_exists( 'travelfic_get_theme_filepath' ) ) {
    function travelfic_get_theme_filepath( $path, $file ) {
        if ( !file_exists( $path ) ) {
            $plugin_path = plugin_dir_path( __FILE__ ) . $file;
            if ( file_exists( $plugin_path ) ) {
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
add_action( 'init', 'travelfic_toolkit_plugin_loaded_action', 10, 2 );

function travelfic_toolkit_plugin_loaded_action() {
    load_plugin_textdomain( 'travelfic-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}

/**
 *    Customizer Settings
*/
require_once dirname( __FILE__ ) . '/inc/customizer/customizer-settings.php';

/**
 *    Customizer Migrator
*/
require_once dirname( __FILE__ ) . '/inc/customizer/customizer-migrator.php';


/**
 *    Customizer Apply
*/
require_once dirname( __FILE__ ) . '/inc/customizer/customizer-apply.php';

/**
 *    Customizer Header Apply 
*/
require_once dirname(__FILE__) . '/inc/customizer/customizer-header-rander.php';

/**
 *    Customizer Footer Apply 
*/
require_once dirname(__FILE__) . '/inc/customizer/customizer-footer-rander.php';

/**
 * Elementor Widgets
*/
require_once dirname( __FILE__ ) . '/inc/elementor-widgets.php';
/**
 * Plugin Functions
*/
require_once dirname( __FILE__ ) . '/inc/functions.php';

/**
 * Template Sync Class
*/
if ( file_exists( dirname( __FILE__ ) . '/inc/class/class-template-sync.php' ) ) {
    require_once dirname( __FILE__ ) . '/inc/class/class-template-sync.php';
}

/**
 * Template List Class
 */
if(is_admin()){
	if ( file_exists( dirname( __FILE__ ) . '/inc/class/class-template-list.php' ) ) {
		require_once dirname( __FILE__ ) . '/inc/class/class-template-list.php';
	}

    if ( file_exists( dirname( __FILE__ ) . '/inc/class/class-importer.php' ) ) {
		require_once dirname( __FILE__ ) . '/inc/class/class-importer.php';
	}
}
/**
 *    Admin & Customizer Enqueue
 */

function travelfic_toolkit_enqueue_customizer_scripts() {
    // Select2 Lib
    wp_enqueue_style( 'travelfic-toolkit-select2', TRAVELFIC_TOOLKIT_URL . 'assets/admin/lib/select2/select2.min.css', array(), TRAVELFIC_TOOLKIT_VERSION );
    wp_enqueue_script( 'travelfic-toolkit-select2', TRAVELFIC_TOOLKIT_URL . 'assets/admin/lib/select2/select2.min.js', array('jquery'), TRAVELFIC_TOOLKIT_VERSION, true );

    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_TOOLKIT_URL . 'assets/admin/css/style.css', array(), TRAVELFIC_TOOLKIT_VERSION );
    wp_enqueue_script( 'travelfic-toolkit-script', TRAVELFIC_TOOLKIT_URL . 'assets/admin/js/customizer.js', array( 'jquery', 'customize-controls' ), time(), true );
}
add_action( 'customize_controls_enqueue_scripts', 'travelfic_toolkit_enqueue_customizer_scripts' );

function travelfic_toolkit_enqueue_customizer_preview_scripts() {
    wp_enqueue_style( 'travelfic-toolkit-select2', TRAVELFIC_TOOLKIT_URL . 'assets/admin/lib/select2/select2.min.css', array(), TRAVELFIC_TOOLKIT_VERSION );
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_TOOLKIT_URL . 'assets/admin/css/style.css', array(), TRAVELFIC_TOOLKIT_VERSION );
}
add_action( 'customize_preview_init', 'travelfic_toolkit_enqueue_customizer_preview_scripts' );

/**
 *    Front-End Enqueue
 */

add_action( 'wp_enqueue_scripts', 'travelfic_toolkit_front_page_script');
function travelfic_toolkit_front_page_script() {
    wp_enqueue_script( 'travelfic-toolkit-fontend', TRAVELFIC_TOOLKIT_URL . 'assets/app/js/main.js', array( 'jquery'), TRAVELFIC_TOOLKIT_VERSION, true );
    wp_enqueue_style( 'travelfic-toolkit-css', TRAVELFIC_TOOLKIT_URL . 'assets/app/css/style.min.css', false, TRAVELFIC_TOOLKIT_VERSION );
}

/**
 *    Admin Enqueue
 */

 add_action( 'admin_enqueue_scripts', 'travelfic_toolkit_admin_page_script' );
 function travelfic_toolkit_admin_page_script($screen) {
    $travelfic_toolkit_active_plugins = [];
    if ( ! is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
        $travelfic_toolkit_active_plugins[] = "contact-form-7";
    }
    if ( ! is_plugin_active( 'tourfic/tourfic.php' ) ) {
        $travelfic_toolkit_active_plugins[] = "tourfic";
    }
    if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
        $travelfic_toolkit_active_plugins[] = "elementor";
    }
    if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        $travelfic_toolkit_active_plugins[] = "woocommerce";
    }

    $travelfic_toolkit_facts = [
        __("According to Statista, 81% of global travelers believe that sustainable travel is important for the world", "travelfic-toolkit"),
        __("France is the most visited country in the world, reporting 89.4 million tourists annually", "travelfic-toolkit"),
        __("The shortest flight in the world is a 1 minute 14-second connecting flight between Westray and Papa Westray in Scotland’s Orkney Islands", "travelfic-toolkit"),
        __("Paris, London, and Rome are the top 3 trending and most preferred travel destinations (based on the latest data)", "travelfic-toolkit"),
        __("Exploring new places together is the main priority for 49% of families planning to travel", "travelfic-toolkit"),
        __("Travelers usually tend to book accommodation and flight tickets roughly three months prior to the trip date", "travelfic-toolkit"),
        __("A majority of travelers say that they expect to spend more on travel than other aspects of their life such as car insurance, healthcare, etc", "travelfic-toolkit"),
        __("Children born after 2010, also known as Generation Alpha, are said to show the most influence over a family’s travel plans", "travelfic-toolkit")
    ];
    shuffle($travelfic_toolkit_facts);

    wp_enqueue_style( 'travelfic-toolkit-admin-css', TRAVELFIC_TOOLKIT_URL . 'assets/admin/css/template-setup.css', false, TRAVELFIC_TOOLKIT_VERSION );
    wp_enqueue_script( 'travelfic-toolkit-admin-js', TRAVELFIC_TOOLKIT_URL . 'assets/admin/js/template-setup.js', array( 'jquery'), TRAVELFIC_TOOLKIT_VERSION, true );
    wp_localize_script( 'travelfic-toolkit-admin-js', 'travelfic_toolkit_script_params',
        array(
            'travelfic_toolkit_nonce'   => wp_create_nonce( 'updates' ),
            'ajax_url'       => admin_url( 'admin-ajax.php' ),
            'installing'     => __( 'Plugin Installing & Activating...', 'travelfic-toolkit' ),
            'installed'      => __( 'Installed', 'travelfic-toolkit' ),
            'activated'      => __( 'Activated', 'travelfic-toolkit' ),
            'install_failed' => __( 'Install failed', 'travelfic-toolkit' ),
            'actives_plugins' => $travelfic_toolkit_active_plugins,
            'facts' => $travelfic_toolkit_facts
        )
    );

    if(!empty($screen) && 'admin_page_travelfic-template-list'==$screen){
        wp_enqueue_style( 'travelfic-toolkit-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap', array(), TRAVELFIC_TOOLKIT_VERSION );
    }
 }

/**
 *    Admin Notice If Travelfic Not Active
 */

if ( !function_exists( 'travelfic_active' ) ) {
    function travelfic_active() {
        ?>
		<div id="message" class="error">
			<p>
                <?php
                /* translators: %s is replaced with "theme name & link" */
                printf( esc_html__( 'Travelfic Toolkit recommend %s to be activated.', 'travelfic-toolkit' ), '<strong><a href="https://wordpress.org/themes/travelfic/" target="_blank" rel="noopener noreferrer">Travelfic Theme</a></strong>' ); ?>
            </p>
            <p><a class="install-now button" href="<?php echo esc_url(wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=travelfic' ), 'switch-theme_travelfic')); ?>"><?php echo esc_html__( 'Active Now', 'travelfic-toolkit' );?></a></p>
		</div>
	<?php
    }
}

/**
 *    Admin Notice If Travelfic Not Exits
 */

if ( !function_exists( 'travelfic_install' ) ) {
    function travelfic_install() {
        ?>
		<div id="message" class="error">
			<p>
                <?php 
                /* translators: %s is replaced with "theme name & link" */
                printf( esc_html__( 'Travelfic Toolkit recommend %s to be activated.', 'travelfic-toolkit' ), '<strong><a href="https://wordpress.org/themes/travelfic/" target="_blank" rel="noopener noreferrer">Travelfic Theme</a></strong>' ); ?>
            </p>
			<p><a class="install-now button" href="<?php echo esc_url( admin_url( '/theme-install.php?search=travelfic' ) ); ?>"> <?php echo esc_html__( 'Install Now', 'travelfic-toolkit');?> </a></p>
		</div>
	<?php
    }
}

/**
 *    Admin See Template Action
*/

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'travelfic_toolkit_template_list');
function travelfic_toolkit_template_list( $links ) {
    $link = sprintf( "<a href='%s' style='color:#2271b1;'>%s</a>", admin_url( 'admin.php?page=travelfic-template-list'), __( 'See Library', 'travelfic-toolkit' ) );
    array_push( $links, $link );
    return $links;
}
