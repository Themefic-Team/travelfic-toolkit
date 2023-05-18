<?php
final class Travelfic_Elementor_Extensions
{

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
    public static function instance()
    {
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
    public function __construct()
    {

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
    public function i18n()
    {
        load_plugin_textdomain('travelfic-toolkit');
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
    public function init()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            return;
        }
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_category'));

        // Add Plugin actions
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);

        add_action('wp_enqueue_scripts', [$this, 'elementor_assets_dependencies']);
    }

    function elementor_assets_dependencies()
    {

        /* Styles */
        wp_register_style('travelfic-slider-hero', TRAVELFIC_PLUGIN_URL . 'assets/widgets/css/travelfic-slider-hero.css', array(), TRAVELFIC_PLUGIN_VERSION, 'all');
        wp_register_style('travelfic-icon-text', TRAVELFIC_PLUGIN_URL . 'assets/widgets/css/travelfic-icon-text.css', array(), TRAVELFIC_PLUGIN_VERSION, 'all');
        wp_register_style('travelfic-popular-tours', TRAVELFIC_PLUGIN_URL . 'assets/widgets/css/travelfic-popular-tours.css', array(), TRAVELFIC_PLUGIN_VERSION, 'all');
        wp_register_style('travelfic-testimonials', TRAVELFIC_PLUGIN_URL . 'assets/widgets/css/travelfic-testimonials.css', array(), TRAVELFIC_PLUGIN_VERSION, 'all');
        wp_register_style('travelfic-latest-news', TRAVELFIC_PLUGIN_URL . 'assets/widgets/css/travelfic-latest-news.css', array(), TRAVELFIC_PLUGIN_VERSION, 'all');
    }

    /**
     * Add the Category for Theme Widgets.
     */
    function add_elementor_category($elements_manager)
    {

        $elements_manager->add_category(
            'travelfic',
            [
                'title' => __('Travelfic Addons', 'travelfic-toolkit'),
                'icon' => 'fa fa-plug',
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
    public function init_widgets()
    {

        // Include Widget files
        require_once(__DIR__ . '/elementor-widgets/travelfic-slider-hero.php');
        require_once( __DIR__ . '/elementor-widgets/travelfic-icon-with-text.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-popular-tours.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-testimonials.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-latest-news.php' );
        require_once( __DIR__ . '/elementor-widgets/travelfic-section-heading.php' );


        // require_once( __DIR__ . '/elementor-widgets/travelfic-destinaions.php' );
        // require_once( __DIR__ . '/elementor-widgets/travelfic-team.php' );
        // require_once( __DIR__ . '/elementor-widgets/travelfic-hero-slider.php' );


        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \TravelficSliderHero());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \IconWithText() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PopularTours() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Testimonials() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \LatestNews() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SectionHeading() );

        
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Destinaions() );
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TeamMembers() );
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \TravelFicSlider2() );

    }
}

Travelfic_Elementor_Extensions::instance();
