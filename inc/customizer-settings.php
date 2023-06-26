<?php
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


function travelfic_toolkit_customize_register($wp_customize) {
    $travelfic_toolkit_prefix = "travelfic_customizer_settings_";


    // Customizer Class Include
    require_once( dirname( __FILE__ ) . '/customizer/customizer-class.php' );


    /* Header Tab Selection */
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_tab_select', array(
        'default'           => 'settings',
        'sanitize_callback' => 'sanitize_text_field',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Tab_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_tab_select', array(
        'label'    => __('Header Design Option', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'settings' => 'Settings',
            'design' => 'Design',
        ),
        'priority' => 10,
    )));

    /* Header Tab Selection */

    // Add a setting for header image
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_select', array(
        'default'           => 'design1',
        'sanitize_callback' => 'sanitize_text_field',
        "transport" => "refresh",
    ));

    // Add a control for header image
    $wp_customize->add_control(new Travelfic_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_select', array(
        'label'    => __('Header Design Option', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'design1' => TRAVELFIC_URL.'assets/img/header-1.png',
            'design2' => TRAVELFIC_URL.'assets/img/header-1.png',
        ),
        'priority' => 10,
    )));

    // Sticky Settings Title
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_sticky_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'header_sticky_section_opt', array(
        'label'    => __('Sticky Settings', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 11,
    )));

    // Menu Settings Title
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_section_opt', array(
        'default'           => 'sections',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new Travelfic_Sec_Section_Control($wp_customize, $travelfic_toolkit_prefix . 'header_section_opt', array(
        'label'    => __('Menu Settings', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'priority' => 19,
        'sec'  => array(
            'sections' => 'Menu Settings',
        ),
    )));

    // Add a setting for Menu typography
    $wp_customize->add_setting($travelfic_toolkit_prefix .'header_menu_typo', array(
        'default'           => array(
            'font-size'      => '18',
            'line-height'      => '18',
            'text-transform' => 'capitalize',
        )
    ));
    $wp_customize->add_control(new Travelfic_typography_Control(
        $wp_customize,
        $travelfic_toolkit_prefix .'header_menu_typo',
        array(
            'label'   => __('Menu Typography', 'travelfic'),
            'section' => 'travelfic_customizer_header',
            'priority' => 20,
        )
    ));

    //menu Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "menu_color", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#222'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "menu_color", [
        "label" => __("Menu Color", "travelfic"),
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
        "label" => __("Menu Hover Color", "travelfic"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);


    // Add a setting for Submenu typography
    $wp_customize->add_setting($travelfic_toolkit_prefix .'header_submenu_typo', array(
        'default'           => array(
            'font-size'      => '18',
            'line-height'      => '18',
            'text-transform' => 'capitalize',
        )
    ));
    $wp_customize->add_control(new Travelfic_typography_Control(
        $wp_customize,
        $travelfic_toolkit_prefix .'header_submenu_typo',
        array(
            'label'   => __('Submenu Typography', 'travelfic'),
            'section' => 'travelfic_customizer_header',
            'priority' => 20,
        )
    ));

    //Submenu Background Color
    $wp_customize->add_setting($travelfic_toolkit_prefix . "submenu_bg", [
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_hex_color",
        "default" => '#fff'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "submenu_bg", [
        "label" => __("Submenu Background", "travelfic"),
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
        "label" => __("Submenu Text Color", "travelfic"),
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
        "label" => __("Submenu Text Hover Color", "travelfic"),
        'priority' => 22,
        "section" => "travelfic_customizer_header",
        "type" => "color",
    ]);

    // Add a setting for footer image
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_design_select', array(
        'default'           => 'design1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for footer image
    $wp_customize->add_control(new Travelfic_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_design_select', array(
        'label'    => __('Footer Design Option', 'travelfic'),
        'section'  => 'travelfic_customizer_footer', // Specify the existing section ID or create a new section
        'choices'  => array(
            'design1' => TRAVELFIC_URL.'assets/img/footer-1.png',
            'design2' => TRAVELFIC_URL.'assets/img/footer-1.png',
        ),
    )));

}

add_action("customize_register", "travelfic_toolkit_customize_register");