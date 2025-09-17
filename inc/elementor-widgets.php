<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

final class Travelfic_Toolkit_Elementor_Extensions {

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var Elementor_Travelfic_Extension The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return Elementor_Travelfic_Extension An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct() {
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n() {
        load_plugin_textdomain( 'travelfic-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init() {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            return;
        }
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_category') , 10, 1);

        // Add Plugin actions
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets'], 10, 1);

    }


    /**
     *  Category for Theme Widgets.
     */
    function add_elementor_category( $elements_manager ) {
        $elements_manager->add_category(
            'travelfic',
            [
                'title' => __( 'Travelfic Addons', 'travelfic-toolkit' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets() {
        // Include Widget files
        require_once(__DIR__ . '/elementor-widgets/travelfic-slider-hero.php');
        require_once( __DIR__ . '/elementor-widgets/travelfic-icon-with-text.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-popular-tours.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-testimonials.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-latest-news.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-section-heading.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-team.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-tour-destination.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-hotel-location.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-cf7-form.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-about-us.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-hotels.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-apartment-location.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-cars.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-car-brand.php' );


        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register(new \Travelfic_Toolkit_SliderHero());
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_IconWithText() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_PopularTours() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_Testimonials() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_LatestNews() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_SectionHeading() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_TeamMembers() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_TourDestinaions() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_HotelLocation() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_CF7_Form() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_AboutUs() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_Hotels() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_ApartmentLocation() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_Cars() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Travelfic_Toolkit_CarBrands() );
       
    }
}

Travelfic_Toolkit_Elementor_Extensions::instance();
