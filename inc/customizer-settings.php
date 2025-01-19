<?php

if (! defined('ABSPATH')) exit; // Exit if accessed directly 

/**
 * travelfic Theme Customizer
 *
 * @package travelfic
 *
 *
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
// Define a custom control for image selection


function travelfic_toolkit_customize_register($wp_customize)
{
    $travelfic_toolkit_prefix = "travelfic_customizer_settings_";

    $travelfic_theme_style = !empty(get_option('stylesheet')) ? get_option('stylesheet') : 'No';

    // Customizer Class Include
    require_once(dirname(__FILE__) . '/customizer/customizer-class.php');


    /* Header Tab Selection Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_tab_select', array(
        'default'           => 'settings',
        'sanitize_callback' => 'travelfic_toolkit_sanitize_radio',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Tab_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_tab_select', array(
        'label'    => __('Header Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'settings' => __('Settings', 'travelfic-toolkit'),
            'design' => __('Design', 'travelfic-toolkit'),
        ),
        'priority' => 10,
    )));

    /* Header Tab Selection End*/

    /* Header Image Selection Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_select', array(
        'default'           => 'design1',
        'sanitize_callback' => 'travelfic_toolkit_sanitize_radio',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_select', array(
        'label'    => __('Header Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'design1' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-1.png'),
            'design2' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-2.png'),
            'design3' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-3.png'),

        ),
        'priority' => 10,
    )));

    /* Header Image Selection End*/


    /* Header Layout Selection Start*/

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_width', array(
        'sanitize_callback' => 'travelfic_toolkit_sanitize_select',
        'default' => 'default',
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'header_width', array(
        'type' => 'select',
        'section' => 'travelfic_customizer_header',
        'label' => __('Header Template Width', 'travelfic-toolkit'),
        'description' => __('This is a Header Template Width.', 'travelfic-toolkit'),
        'choices' => array(
            'default' => __('Default', 'travelfic-toolkit'),
            'full' => __('Full Width', 'travelfic-toolkit'),
        ),
        'priority' => 10,
    ));

    /* Header Layout Selection End*/

    /* ---------------------- */
    /* Design 2 Settings Start*/
    /* ---------------------- */

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_2_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_2_section_opt', array(
        'label'    => __('Design 2 Settings', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 11,
    )));



    // Topbar Enable/Disable

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_2_topbar', array(
        'default'           => 'design1',
        'sanitize_callback' => $travelfic_theme_style == 'travelfic' || $travelfic_theme_style == 'travelfic-child' ? 'travelfic_checkbox_sanitize' : 'ultimate_hotel_booking_checkbox_sanitize',
        "transport" => "refresh",
        "default" => 1
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Switcher_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_2_topbar', array(
        'label'    => __('Enable Topbar?', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 11,
    )));

    // Topbar Backgournd
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_top_header_bg", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#595349'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_top_header_bg", [
        "label" => __("Topbar Background Color", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Topbar color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_top_header_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#FDF9F3'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_top_header_color", [
        "label" => __("Topbar Text Color", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Header background color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "header_bg_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        'default' => '#07245f',
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "header_bg_color", [
        "label" => __("Header Background", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Header Button background color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_header_btn_bg_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        'default' => '#fa6400',
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_header_btn_bg_color", [
        "label" => __("Header Button Background", "travelfic-toolkit"),
        'priority' => 12,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

      // Header Button Hover background color
      $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_header_btn_hover_bg_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        'default' => '#0e3dd8',
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_header_btn_hover_bg_color", [
        "label" => __("Header Button Hover", "travelfic-toolkit"),
        'priority' => 13,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Phone
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_phone", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => '+88 00 123 456'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_phone", [
        "label" => __("Phone Number", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Email
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_email", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => 'travello@outlook.com'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_email", [
        "label" => __("Email", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Register URL
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_registration_url", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_registration_url", [
        "label" => __("Register URL", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    // Login URL
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_login_url", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_login_url", [
        "label" => __("Login URL", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    /* ---------------------- */
    /* Design 2 Settings End  */
    /* ---------------------- */

    /* ---------------------- */
    /* Design 3 Settings Start*/
    /* ---------------------- */

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_3_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_3_section_opt', array(
        'label'    => __('Design 3 Settings', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 11,
    )));



    // Topbar Enable/Disable

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_3_topbar', array(
        'default'           => 'design3',
        'sanitize_callback' => $travelfic_theme_style == 'travelfic' || $travelfic_theme_style == 'travelfic-child' ? 'travelfic_checkbox_sanitize' : 'ultimate_hotel_booking_checkbox_sanitize',
        "transport" => "refresh",
        "default" => 1
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Switcher_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_3_topbar', array(
        'label'    => __('Enable Topbar?', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 11,
    )));

    // Topbar Backgournd
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_top_header_bg", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#1342E0'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_top_header_bg", [
        "label" => __("Topbar Background Color", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Topbar color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_top_header_text_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#fff'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_top_header_text_color", [
        "label" => __("Topbar Text Color", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Header background color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "header_bg_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "header_bg_color", [
        "label" => __("Header Background", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Location
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_location", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => '4b, Walse Street , USA'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_location", [
        "label" => __("Location", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Email
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_email", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => 'info@example.com'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_email", [
        "label" => __("Email", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Phone
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_phone", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => '(245) 2156 21453'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_phone", [
        "label" => __("Phone Number", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Login Label
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_login_label", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => 'Login Now'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_login_label", [
        "label" => __("Login Label", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Login URL
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_login_url", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_login_url", [
        "label" => __("Login URL", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    // Discover Label
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_discover_label", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "default" => 'discover Now'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_discover_label", [
        "label" => __("Discover More", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "text",
    ]);

    // Discover URL
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_3_discover_url", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_3_discover_url", [
        "label" => __("Discover URL", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    /* ---------------------- */
    /* Design 2 Settings End  */
    /* ---------------------- */


    /* Header Sticky Section Title Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_sticky_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'header_sticky_section_opt', array(
        'label'    => __('Sticky Settings', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 11,
    )));
    /* Header Sticky Section Title End*/

    /* Transparent Header Showing Option Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'transparent_showing', array(
        'default'           => 'both',
        'sanitize_callback' => 'travelfic_toolkit_sanitize_radio',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Tab_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'transparent_showing', array(
        'label'    => __('Enable On', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'desktop' => __('Desktop', 'travelfic-toolkit'),
            'mobile' => __('Mobile', 'travelfic-toolkit'),
            'both' => __('Desktop+Mobile', 'travelfic-toolkit'),
        ),
        'input_attrs' => array(
            'data-not-tab' => "true", // Encode the not_tab attribute as JSON data
        ),
        'priority' => 21,
    )));
    /* Transparent Header Showing Option Start*/

    /* Transparent Header image Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . "trasnparent_logo", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_url"
    ]);

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            $travelfic_toolkit_prefix . "trasnparent_logo",
            [
                "label" => __("Transparent Header Logo", "travelfic-toolkit"),
                "section" => "travelfic_customizer_header",
                "settings" => $travelfic_toolkit_prefix . "trasnparent_logo",
                'priority' => 21,
            ]
        )
    );
    /* Transparent Header image End*/

    /* Header Menu Section Title Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'header_section_opt', array(
        'label'    => __('Menu Settings', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 19,
        'sec'  => array(
            'sections' => __('Menu Settings', 'travelfic-toolkit'),
        ),
    )));

    /* Header Menu Section Title End*/

    /* Header Menu Typography Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_menu_typo', array(
        'default'           => array(
            'font-size'      => '16',
            'line-height'      => '24',
            'text-transform' => 'capitalize',
        ),
        'sanitize_callback' => 'travelfic_toolkit_sanitize_typography'
    ));
    $wp_customize->add_control(new Travelfic_Toolkit_typography_Control(
        $wp_customize,
        $travelfic_toolkit_prefix . 'header_menu_typo',
        array(
            'label'   => __('Menu Typography', 'travelfic-toolkit'),
            'section' => 'travelfic_customizer_header',
            'priority' => 20,
        )
    ));
    /* Header Menu Typography End */

    /* Header Menu Color Start */
    //menu Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "menu_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#222'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "menu_color", [
        "label" => __("Menu Color", "travelfic-toolkit"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //menu hover Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "menu_hover_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#F15D30'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "menu_hover_color", [
        "label" => __("Menu Hover Color", "travelfic-toolkit"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    /* Header Menu Color End */

    /* Header SubMenu Typography Start */
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_submenu_typo', array(
        'default'           => array(
            'font-size'      => '16',
            'line-height'      => '24',
            'text-transform' => 'capitalize',
        ),
        'sanitize_callback' => 'travelfic_toolkit_sanitize_typography'
    ));
    $wp_customize->add_control(new Travelfic_Toolkit_typography_Control(
        $wp_customize,
        $travelfic_toolkit_prefix . 'header_submenu_typo',
        array(
            'label'   => __('Submenu Typography', 'travelfic-toolkit'),
            'section' => 'travelfic_customizer_header',
            'priority' => 20,
        )
    ));

    /* Header SubMenu Typography End */

    /* Header SubMenu Colors Start */

    //Submenu Background Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "submenu_bg", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#fff'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "submenu_bg", [
        "label" => __("Submenu Background", "travelfic-toolkit"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //Submenu Default Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "submenu_text_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#222'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "submenu_text_color", [
        "label" => __("Submenu Text Color", "travelfic-toolkit"),
        'priority' => 21,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //Submenu Hover Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "submenu_text_hover_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#F15D30'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "submenu_text_hover_color", [
        "label" => __("Submenu Text Hover Color", "travelfic-toolkit"),
        'priority' => 22,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    /* Header SubMenu Colors End */

    /* Transparent Header Menu Section Title Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'transparent_header_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'transparent_header_section_opt', array(
        'label'    => __('Transparent Header Settings', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 23,
        'sec'  => array(
            'sections' => __('Transparent Header Settings', 'travelfic-toolkit'),
        ),
    )));

    // Transparent Header background color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "transparent_header_bg_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "transparent_header_bg_color", [
        "label" => __("Header Background", "travelfic-toolkit"),
        'priority' => 24,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //menu Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "transparent_menu_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "transparent_menu_color", [
        "label" => __("Menu Color", "travelfic-toolkit"),
        'priority' => 25,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //menu Hover Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "transparent_menu_hover_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "transparent_menu_hover_color", [
        "label" => __("Menu Hover Color", "travelfic-toolkit"),
        'priority' => 25,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //Submenu Background
    $wp_customize->add_setting($travelfic_toolkit_prefix . "transparent_submenu_bg", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "transparent_submenu_bg", [
        "label" => __("Submenu Background", "travelfic-toolkit"),
        'priority' => 25,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //Submenu Default Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "transparent_submenu_text_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "transparent_submenu_text_color", [
        "label" => __("Submenu Text Color", "travelfic-toolkit"),
        'priority' => 26,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    //Submenu Hover Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "transparent_submenu_text_hover_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color"
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "transparent_submenu_text_hover_color", [
        "label" => __("Submenu Text Hover Color", "travelfic-toolkit"),
        'priority' => 27,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    /* Transparent Header Menu Section Title End*/


    /* Footer Tab Selection Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_tab_select', array(
        'default'           => 'settings',
        'sanitize_callback' => 'travelfic_toolkit_sanitize_radio',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Tab_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_tab_select', array(
        'label'    => __('Footer Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_footer',
        'choices'  => array(
            'settings' => __('Settings', 'travelfic-toolkit'),
            'design' => __('Design', 'travelfic-toolkit'),
        ),
        'priority' => 10,
    )));

    /* Footer Tab Selection End*/

    /* Footer Selection Start */

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_design_select', array(
        'default'           => 'design1',
        "sanitize_callback" => "travelfic_toolkit_sanitize_radio",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_design_select', array(
        'label'    => __('Footer Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_footer',
        'choices'  => array(
            'design1' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/footer-1.png'),
            'design2' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/footer-2.png'),
            'design3' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/footer-3.png')
        ),
    )));

    /* Footer Selection End */

    /* Footer Layout Selection Start*/

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_width', array(
        'sanitize_callback' => 'travelfic_toolkit_sanitize_select',
        'default' => 'default',
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'footer_width', array(
        'type' => 'select',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Footer Template Width', 'travelfic-toolkit'),
        'description' => __('This is a Footer Template Width.', 'travelfic-toolkit'),
        'choices' => array(
            'default' => __('Default', 'travelfic-toolkit'),
            'full' => __('Full Width', 'travelfic-toolkit'),
        ),
        'priority' => 10,
    ));

    // Footer background image upload
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_3_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_3_bg_image', array(
        'label'       => __('Footer Background Image', 'travelfic-toolkit'),
        'section'     => 'travelfic_customizer_footer',
    )));

    // Footer background overlay color
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_3_bg_overlay_color', array(
        'default'           => '#101F36',
        'sanitize_callback' => 'sanitize_hex_color',

    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_3_bg_overlay_color', array(
        'label'       => __('Background Overlay Color', 'travelfic-toolkit'),
        'section'     => 'travelfic_customizer_footer',
    )));

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'copyright_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => __('© Copyright 2024 Tourfic Development Site by Themefic All Rights Reserved.', 'travelfic-toolkit'),
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'copyright_text', array(
        'type' => 'textarea',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Footer Copyright Text', 'travelfic-toolkit'),
        'description' => __('You are able to change footer Copyright text.', 'travelfic-toolkit'),
        'priority' => 10,
    ));


    // Footer background image option
    // $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_bg_image_toggle', array(
    //     'default'           => false,
    //     'sanitize_callback' => 'sanitize_text_field',
    // ));

    // $wp_customize->add_control($travelfic_toolkit_prefix . 'footer_bg_image_toggle', array(
    //     'type'        => 'checkbox',
    //     'section'     => 'travelfic_customizer_footer',
    //     'label'       => __('Enable Footer Background Image', 'travelfic-toolkit'),
    //     'description' => __('Check to show the footer background image upload field.', 'travelfic-toolkit'),
    // ));

    // // Footer background image upload
    // $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_bg_image', array(
    //     'default'           => '',
    //     'sanitize_callback' => 'esc_url_raw',
    // ));

    // $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_bg_image', array(
    //     'label'       => __('Footer Background Image', 'travelfic-toolkit'),
    //     'section'     => 'travelfic_customizer_footer',
    //     'settings' => $travelfic_toolkit_prefix . 'footer_bg_image',
    // )));

    // // Footer background overlay color
    // $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_bg_overlay_color', array(
    //     'default'           => '#000000', // Default black
    //     'sanitize_callback' => 'sanitize_hex_color',

    // ));

    // $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_bg_overlay_color', array(
    //     'label'       => __('Footer Background Overlay Color', 'travelfic-toolkit'),
    //     'section'     => 'travelfic_customizer_footer',
    //     'settings' => $travelfic_toolkit_prefix . 'footer_bg_overlay_color',
    // )));

    // footer bottom menu
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'copyright_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => __('© Copyright 2024 Tourfic Development Site by Themefic All Rights Reserved.', 'travelfic-toolkit'),
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'copyright_text', array(
        'type' => 'textarea',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Footer Copyright Text', 'travelfic-toolkit'),
        'description' => __('You are able to change footer Copyright text.', 'travelfic-toolkit'),
        'priority' => 10,
    ));

    // footer design 3
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_3_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_3_section_opt', array(
        'label'    => __('Footer Bottom Settings', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_footer',
    )));

    // footer bottom menu 1
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_menu_label_1', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => __('Privacy Policy', 'travelfic-toolkit'),
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'footer_menu_label_1', array(
        'type' => 'text',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Menu Label 1', 'travelfic-toolkit'),
        'description' => __('Set the label for the first menu.', 'travelfic-toolkit'),
    ));

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_menu_url_1', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#',
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'footer_menu_url_1', array(
        'type' => 'url',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Menu URL 1', 'travelfic-toolkit'),
        'description' => __('Add the first footer URL.', 'travelfic-toolkit'),
    ));

    // Adding URL Field 2
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_menu_label_2', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => __('View on Maps', 'travelfic-toolkit'),
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'footer_menu_label_2', array(
        'type' => 'text',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Menu Label 2', 'travelfic-toolkit'),
        'description' => __('Set the label for the second menu.', 'travelfic-toolkit'),
    ));
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_menu_url_2', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#',
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'footer_menu_url_2', array(
        'type' => 'url',
        'section' => 'travelfic_customizer_footer',
        'label' => __('Menu URL 2', 'travelfic-toolkit'),
        'description' => __('Add the second footer URL.', 'travelfic-toolkit'),
    ));

    /* Footer Layout Selection End*/

    /* Page Layout Selection Start*/

    $wp_customize->add_setting($travelfic_toolkit_prefix . 'page_width', array(
        'sanitize_callback' => 'travelfic_toolkit_sanitize_select',
        'default' => 'default',
    ));

    $wp_customize->add_control($travelfic_toolkit_prefix . 'page_width', array(
        'type' => 'select',
        'section' => 'travelfic_customizer_page',
        'label' => __('Page Template Width', 'travelfic-toolkit'),
        'description' => __('This is a Page Template Width.', 'travelfic-toolkit'),
        'choices' => array(
            'default' => __('Default', 'travelfic-toolkit'),
            'full' => __('Full Width', 'travelfic-toolkit'),
        ),
        'priority' => 10,
    ));

    // Loader Enable/Disable
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'page_loader', array(
        'sanitize_callback' => $travelfic_theme_style == 'travelfic' || $travelfic_theme_style == 'travelfic-child' ? 'travelfic_checkbox_sanitize' : 'ultimate_hotel_booking_checkbox_sanitize',
        "transport" => "refresh",
        "default" => true
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Switcher_Control($wp_customize, $travelfic_toolkit_prefix . 'page_loader', array(
        'label'    => __('Enable Loader?', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_page',
        'priority' => 11,
    )));

    // Loader background
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'page_loader_background', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $travelfic_toolkit_prefix . 'page_loader_background', array(
        'label'    => __('Background Color', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_page',
        'priority' => 11,
        'active_callback' => function() use ($wp_customize, $travelfic_toolkit_prefix) {
            return $wp_customize->get_setting($travelfic_toolkit_prefix . 'page_loader')->value();
        },
    )));

    // Loader background
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'page_loader_color', array(
        'default' => '#FA6400',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $travelfic_toolkit_prefix . 'page_loader_color', array(
        'label'    => __('Loader Color', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_page',
        'priority' => 11,
        'active_callback' => function() use ($wp_customize, $travelfic_toolkit_prefix) {
        return $wp_customize->get_setting($travelfic_toolkit_prefix . 'page_loader')->value();
    },
    )));


    /* Page Layout Selection End*/

    /* -------------------*/
    /* Social Share Start */
    /* ------------------ */
    $wp_customize->add_section("travelfic_social_share", [
        "title" => __("Social Share", "travelfic"),
        "panel" => "travelfic_customizer_settings",
        "priority" => 999,
    ]);

    // Facebook
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_facebook", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_facebook", [
        "label" => __("Facebook", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);

    // Twitter
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_twitter", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_twitter", [
        "label" => __("Twitter", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);

    // Youtube
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_youtube", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_youtube", [
        "label" => __("Youtube", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);

    // Linkedin
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_linkedin", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_linkedin", [
        "label" => __("Linkedin", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);

    // Instagram
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_instagram", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_instagram", [
        "label" => __("Instagram", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);

    // Pinterest
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_pinterest", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_pinterest", [
        "label" => __("Pinterest", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);

    // Reddit
    $wp_customize->add_setting($travelfic_toolkit_prefix . "social_reddit", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "social_reddit", [
        "label" => __("Reddit", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_social_share",
        "type" => "url",
    ]);


    /* Typography Sanitization Start */

    function travelfic_toolkit_sanitize_typography($value)
    {
        $sanitized_value = is_array($value) ? $value : array();

        $sanitized_value['line-height'] = !empty($value['line-height']) ? absint($value['line-height']) : '';
        $sanitized_value['font-size'] = !empty($value['font-size']) ? absint($value['font-size']) : '';
        $sanitized_value['text-transform'] = !empty($value['text-transform']) ? $value['text-transform'] : '';
        return $sanitized_value;
    }

    /* Typography Sanitization End */

    /* Template Width Sanitization Start */

    function travelfic_toolkit_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    /* Template Width Sanitization End */


    /* Travelfic Radio Sanitization Start */

    function travelfic_toolkit_sanitize_radio($input, $setting)
    {

        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible radio box options 
        $choices = $setting->manager->get_control($setting->id)->choices;

        //return input if valid or return default option
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    /* Travelfic Radio Sanitization End */
}

add_action("customize_register", "travelfic_toolkit_customize_register");
