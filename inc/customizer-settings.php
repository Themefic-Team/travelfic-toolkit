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

    class JH_Image_Select_Control extends WP_Customize_Control {
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

    // Add a setting for header image
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_select', array(
        'default'           => 'design2',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for header image
    $wp_customize->add_control(new JH_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_select', array(
        'label'    => __('Header Design Option', 'your-textdomain'),
        'section'  => 'travelfic_customizer_header', // Specify the existing section ID or create a new section
        'choices'  => array(
            'design1' => TRAVELFIC_URL.'assets/img/header-1.png',
            'design2' => TRAVELFIC_URL.'assets/img/header-1.png',
        ),
    )));

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
        'default'           => 'design2',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for footer image
    $wp_customize->add_control(new JH_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'footer_design_select', array(
        'label'    => __('Footer Design Option', 'your-textdomain'),
        'section'  => 'travelfic_customizer_footer', // Specify the existing section ID or create a new section
        'choices'  => array(
            'design1' => TRAVELFIC_URL.'assets/img/header-1.png',
            'design2' => TRAVELFIC_URL.'assets/img/header-1.png',
        ),
    )));

}

add_action("customize_register", "travelfic_toolkit_customize_register");