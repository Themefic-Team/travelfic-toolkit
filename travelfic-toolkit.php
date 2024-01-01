<?php
/**
 * Plugin Name: Travelfic Toolkit
 * Plugin URI: https://themefic.com/
 * Description: Travelfic Toolkit allows you to add extra functionality to the Travelfic WordPress theme's Customizer, Widgets Section, Single Tour, Single Hotel area etc. This toolkit improves the overall design and performance of your hotel or travel booking website developed using the Travelfic theme.
 * Author: themefic
 * Version: 1.0.0
 * Tested up to: 6.3
 * Text Domain: travelfic-toolkit
 * Domain Path: /lang/
 * Author URI: https://themefic.com
 * Elementor tested up to: 3.16.4
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
define( 'TRAVELFIC_TOOLKIT_VERSION', '1.0.0' );

/**
 * Include file from plugin if it is not available in theme
 */
function travelfic_toolkit_settings() {
    if ( ! get_option( 'tf_setup_wizard' ) && ! get_option( 'tf_settings' ) ) {
        update_option( 'tf_setup_wizard', 'active' );
        update_option( 'tf_settings', 'active' );
    }
    $theme_folder = wp_get_theme( 'travelfic' );
    if ( $theme_folder->exists() ) {
        $theme = wp_get_theme();
        if ( $theme->get( 'Name' ) !== 'Travelfic' ) {
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
add_action( 'plugins_loaded', 'travelfic_toolkit_plugin_loaded_action', 10, 2 );

function travelfic_toolkit_plugin_loaded_action() {
    load_plugin_textdomain( 'travelfic-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}

/**
 *    Customizer Settings
 */
require_once dirname( __FILE__ ) . '/inc/customizer-settings.php';

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
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_TOOLKIT_URL . 'assets/admin/css/style.css', array(), '1.0.0' );
    wp_enqueue_script( 'travelfic-toolkit-script', TRAVELFIC_TOOLKIT_URL . 'assets/admin/js/customizer.js', array( 'jquery', 'customize-controls' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'travelfic_toolkit_enqueue_customizer_scripts' );

function travelfic_toolkit_enqueue_customizer_preview_scripts() {
    wp_enqueue_style( 'travelfic-toolkit', TRAVELFIC_TOOLKIT_URL . 'assets/admin/css/style.css', array(), '1.0.0' );
}
add_action( 'customize_preview_init', 'travelfic_toolkit_enqueue_customizer_preview_scripts' );

/**
 *    Front-End Enqueue
 */

add_action( 'wp_enqueue_scripts', 'travelfic_toolkit_front_page_script' );
function travelfic_toolkit_front_page_script() {
    wp_enqueue_script( 'travelfic-toolkit-fontend', TRAVELFIC_TOOLKIT_URL . 'assets/app/js/main.js', array( 'jquery'), '1.0.0', true );
    wp_enqueue_style( 'travelfic-toolkit-css', TRAVELFIC_TOOLKIT_URL . 'assets/app/css/style.css', false, '1.0.0' );
    wp_enqueue_style( 'travelfic-toolkit-desgin-2', TRAVELFIC_TOOLKIT_URL . 'assets/app/css/design-2.css', false, '1.0.0' );
}

/**
 *    Admin Enqueue
 */

 add_action( 'admin_enqueue_scripts', 'travelfic_toolkit_admin_page_script' );
 function travelfic_toolkit_admin_page_script() {
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
     wp_enqueue_style( 'travelfic-toolkit-admin-css', TRAVELFIC_TOOLKIT_URL . 'assets/admin/css/template-setup.css', false, '1.0.0' );
     wp_enqueue_script( 'travelfic-toolkit-admin-js', TRAVELFIC_TOOLKIT_URL . 'assets/admin/js/template-setup.js', array( 'jquery'), '1.0.0', true );
     wp_localize_script( 'travelfic-toolkit-admin-js', 'travelfic_toolkit_script_params',
        array(
            'travelfic_toolkit_nonce'   => wp_create_nonce( 'updates' ),
            'ajax_url'       => admin_url( 'admin-ajax.php' ),
            'installing'     => __( 'Plugin Installing & Activating...', 'travelfic' ),
            'installed'      => __( 'Installed', 'travelfic' ),
            'activated'      => __( 'Activated', 'travelfic' ),
            'install_failed' => __( 'Install failed', 'travelfic' ),
            'actives_plugins' => $travelfic_toolkit_active_plugins
        )
    );
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
                printf( esc_html__( 'Travelfic Toolkit requires %s to be activated.', 'travelfic-toolkit' ), '<strong><a href="https://wordpress.org/themes/travelfic/" target="_blank">Travelfic Theme</a></strong>' ); ?>
            </p>
            <p><a class="install-now button" href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=travelfic' ), 'switch-theme_travelfic'); ?>"><?php echo esc_html__( 'Active Now', 'travelfic-toolkit' );?></a></p>
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
                printf( esc_html__( 'Travelfic Toolkit requires %s to be activated.', 'travelfic-toolkit' ), '<strong><a href="https://wordpress.org/themes/travelfic/" target="_blank">Travelfic Theme</a></strong>' ); ?>
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