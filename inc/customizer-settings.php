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


    /* Header Tab Selection Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_tab_select', array(
        'default'           => 'settings',
        'sanitize_callback' => 'travelfic_kit_sanitize_radio',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Tab_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_tab_select', array(
        'label'    => __('Header Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'settings' => __( 'Settings', 'travelfic-toolkit'),
            'design' => __( 'Design', 'travelfic-toolkit'),
        ),
        'priority' => 10,
    )));

    /* Header Tab Selection End*/

    /* Header Image Selection Start*/
    
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_select', array(
        'default'           => 'design1',
        'sanitize_callback' => 'travelfic_kit_sanitize_radio',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_select', array(
        'label'    => __('Header Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_header',
        'choices'  => array(
            'design1' => esc_url( TRAVELFIC_TOOLKIT_URL.'assets/admin/img/header-1.png' ),
            'design2' => esc_url( TRAVELFIC_TOOLKIT_URL.'assets/admin/img/header-2.png' )

        ),
        'priority' => 10,
    )));

    /* Header Image Selection End*/

    
    /* Header Layout Selection Start*/

    $wp_customize->add_setting( $travelfic_toolkit_prefix .'header_width', array(
        'sanitize_callback' => 'travelfic_sanitize_select',
        'default' => 'default',
      ) );
      
      $wp_customize->add_control( $travelfic_toolkit_prefix .'header_width', array(
        'type' => 'select',
        'section' => 'travelfic_customizer_header',
        'label' => __( 'Header Template Width', 'travelfic-toolkit' ),
        'description' => __( 'This is a Header Template Width.', 'travelfic-toolkit' ),
        'choices' => array(
          'default' => __( 'Default', 'travelfic-toolkit' ),
          'full' => __( 'Full Width', 'travelfic-toolkit' ),
        ),
        'priority' => 10,
      ) );

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
        'sanitize_callback' => 'travelfic_checkbox_sanitize',
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

    // Facebook
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_facebook", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_facebook", [
        "label" => __("Facebook", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    // Twitter
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_twitter", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_twitter", [
        "label" => __("Twitter", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    // Youtube
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_youtube", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_youtube", [
        "label" => __("Youtube", "travelfic-toolkit"),
        'priority' => 11,
        "section" => "travelfic_customizer_header",
        "type" => "url",
    ]);

    // Linkedin
    $wp_customize->add_setting($travelfic_toolkit_prefix . "design_2_linkedin", [
        "transport" => "refresh",
        "sanitize_callback" => "esc_url_raw",
        "default" => '#'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "design_2_linkedin", [
        "label" => __("Linkedin", "travelfic-toolkit"),
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
    $wp_customize->add_setting($travelfic_toolkit_prefix .'header_menu_typo', array(
        'default'           => array(
            'font-size'      => '18',
            'line-height'      => '24',
            'text-transform' => 'capitalize',
        ),
        'sanitize_callback' => 'travelfic_sanitize_typography'
    ));
    $wp_customize->add_control(new Travelfic_Toolkit_typography_Control(
        $wp_customize,
        $travelfic_toolkit_prefix .'header_menu_typo',
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
    $wp_customize->add_setting($travelfic_toolkit_prefix .'header_submenu_typo', array(
        'default'           => array(
            'font-size'      => '18',
            'line-height'      => '24',
            'text-transform' => 'capitalize',
        ),
        'sanitize_callback' => 'travelfic_sanitize_typography'
    ));
    $wp_customize->add_control(new Travelfic_Toolkit_typography_Control(
        $wp_customize,
        $travelfic_toolkit_prefix .'header_submenu_typo',
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


    /* Footer Tab Selection Start*/
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'footer_tab_select', array(
        'default'           => 'settings',
        'sanitize_callback' => 'travelfic_kit_sanitize_radio',
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
        "sanitize_callback" => "travelfic_kit_sanitize_radio",
    ));

    $wp_customize->add_control(new Travelfic_Toolkit_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_design_select', array(
        'label'    => __('Footer Design Option', 'travelfic-toolkit'),
        'section'  => 'travelfic_customizer_footer',
        'choices'  => array(
            'design1' => esc_url( TRAVELFIC_TOOLKIT_URL.'assets/admin/img/footer-1.png' ),
            'design2' => esc_url( TRAVELFIC_TOOLKIT_URL.'assets/admin/img/footer-2.png' )
        ),
    )));

    /* Footer Selection End */

    /* Footer Layout Selection Start*/

    $wp_customize->add_setting( $travelfic_toolkit_prefix .'footer_width', array(
        'sanitize_callback' => 'travelfic_sanitize_select',
        'default' => 'default',
      ) );
      
      $wp_customize->add_control( $travelfic_toolkit_prefix .'footer_width', array(
        'type' => 'select',
        'section' => 'travelfic_customizer_footer',
        'label' => __( 'Footer Template Width', 'travelfic-toolkit' ),
        'description' => __( 'This is a Footer Template Width.', 'travelfic-toolkit' ),
        'choices' => array(
          'default' => __( 'Default', 'travelfic-toolkit' ),
          'full' => __( 'Full Width', 'travelfic-toolkit' ),
        ),
        'priority' => 10,
      ) );

    /* Footer Layout Selection End*/

    /* Page Layout Selection Start*/

    $wp_customize->add_setting( $travelfic_toolkit_prefix .'page_width', array(
        'sanitize_callback' => 'travelfic_sanitize_select',
        'default' => 'default',
    ) );
    
    $wp_customize->add_control( $travelfic_toolkit_prefix .'page_width', array(
        'type' => 'select',
        'section' => 'travelfic_customizer_page',
        'label' => __( 'Page Template Width', 'travelfic-toolkit' ),
        'description' => __( 'This is a Page Template Width.', 'travelfic-toolkit' ),
        'choices' => array(
        'default' => __( 'Default', 'travelfic-toolkit' ),
        'full' => __( 'Full Width', 'travelfic-toolkit' ),
        ),
        'priority' => 10,
    ) );

    /* Page Layout Selection End*/

    /* Typography Sanitization Start */

    function travelfic_sanitize_typography($value) {
        $sanitized_value = array();

        $sanitized_value['line-height'] = absint($value['line-height']);
        $sanitized_value['font-size'] = absint($value['font-size']);
        $sanitized_value['text-transform'] = sanitize_text_field($value['text-transform']);
    
        return $sanitized_value;
    }

    /* Typography Sanitization End */

    /* Template Width Sanitization Start */

    function travelfic_sanitize_select( $input, $setting ) {
        $input = sanitize_key( $input );
        $choices = $setting->manager->get_control( $setting->id )->choices;
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    /* Template Width Sanitization End */

    
    /* Travelfic Radio Sanitization Start */

    function travelfic_kit_sanitize_radio( $input, $setting ){

        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible radio box options 
        $choices = $setting->manager->get_control( $setting->id )->choices;
                          
        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
          
    }

    /* Travelfic Radio Sanitization End */
}

add_action("customize_register", "travelfic_toolkit_customize_register");