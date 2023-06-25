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


    // Image Select Class
    class Travelfic_Image_Select_Control extends WP_Customize_Control {
        public $type = 'image_select';
    
        public function render_content() {
            $image_options = $this->choices;
            $value = $this->value();
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <ul class="image-select-container">
                <?php foreach ( $image_options as $key => $image_url ) : ?>
                    <li>
                    <label>
                        <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $value, $key ); ?>/>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $key ); ?>"/>
                    </label>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php
        }
    }

    // Tab Select Class
    class Travelfic_Tab_Select_Control extends WP_Customize_Control {
        public $type = 'tab_select';
    
        public function render_content() {
            $tab_options = $this->choices;
            $value = $this->value();
            ?>
                <ul class="tab-select-container">
                <?php foreach ( $tab_options as $key => $label ) : ?>
                    <li>
                    <label>
                        <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $value, $key ); ?>/>
                        <span><?php echo esc_html($label); ?></span>
                    </label>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php
        }
    }

    // Section Heading Class
    class Travelfic_Sec_Section_Control extends WP_Customize_Control {
        public $type = 'sec_section';
    
        public function render_content() {
        ?>
            <span class="travelfic-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php
        }
    }

    /* Header Tab Selection */

    // Add a setting for header image
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_tab_select', array(
        'default'           => 'settings',
        'sanitize_callback' => 'sanitize_text_field',
        "transport" => "refresh",
    ));

    // Add a control for header image
    $wp_customize->add_control(new Travelfic_Tab_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_tab_select', array(
        'label'    => __('Header Design Option', 'travelfic'),
        'section'  => 'travelfic_customizer_header', // Specify the existing section ID or create a new section
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
        'section'  => 'travelfic_customizer_header', // Specify the existing section ID or create a new section
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

    //menu Font Size
    $wp_customize->add_setting($travelfic_toolkit_prefix . "menu_font_size", [
        "transport" => "refresh",
        "sanitize_callback" => "absint",
        "default" => '18'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "menu_font_size", [
        "label" => __("Menu Font Size", "travelfic"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "number",
    ]);

    //Menu Line Height
    $wp_customize->add_setting($travelfic_toolkit_prefix . "menu_line_height", [
        "transport" => "refresh",
        "sanitize_callback" => "absint",
        "default" => '18'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "menu_line_height", [
        "label" => __("Submenu Line Height", "travelfic"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "number",
    ]);

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

    //Submenu Font Size
    $wp_customize->add_setting($travelfic_toolkit_prefix . "submenu_font_size", [
        "transport" => "refresh",
        "sanitize_callback" => "absint",
        "default" => '18'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "submenu_font_size", [
        "label" => __("Submenu Font Size", "travelfic"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "number",
    ]);

    //Submenu Line Height
    $wp_customize->add_setting($travelfic_toolkit_prefix . "submenu_line_height", [
        "transport" => "refresh",
        "sanitize_callback" => "absint",
        "default" => '18'
    ]);
    $wp_customize->add_control($travelfic_toolkit_prefix . "submenu_line_height", [
        "label" => __("Submenu Line Height", "travelfic"),
        'priority' => 20,
        "section" => "travelfic_customizer_header",
        "type" => "number",
    ]);

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