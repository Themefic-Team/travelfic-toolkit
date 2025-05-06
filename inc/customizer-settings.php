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


// add Kirki fields
add_action('init', function () {

    // return if Kirki doesn't exist
    if (!class_exists('travelfic_Kirki')) {
        return;
    }

    // prefix
    $prefix = 'travelfic_customizer_settings_';


    /**
     * 
     * Tagline Theme Options
     * 
     */

    //  transparent logo
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'image',
        'settings'    => $prefix . 'trasnparent_logo',
        'label'       => esc_html__('Transparent Logo', 'travelfic'),
        'section'     => 'title_tagline',
        'priority'    => 10,
        'transport'   => 'refresh',
    ]);

    /**
     * 
     * Global Theme Options
     * 
     */

    /* scroll to top section start*/

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'custom',
        'settings' => $prefix . 'page_loader_separator_line',
        'section'  => 'travelfic_customizer_scroll_to_top',
        'default'  => '<hr style="border-top: 1px solid #D1D5DB; margin: 18px -22px 20px;">',
        'tab' => 'general',
        'priority'    => 14,
    ));


    // Loader Enable/Disable
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'page_loader',
        'label'    => esc_html__('Loader', 'travelfic'),
        'section'  => 'travelfic_customizer_scroll_to_top',
        'tab' => 'general',
        'default'  => true,
        'priority'    => 15,
    ]);

    // loader head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'page_loader_head',
        'section'     => 'travelfic_customizer_scroll_to_top',
        'default'     => '<h2 class="travelfic-customizer-heading tf-mb-12">' . esc_html__('Loader', 'travelfic') . '</h2>',
        'priority'    => 14,
        'tab'         => 'design',
    ]);

    // icon background color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'page_loader_background',
        'label'       => esc_html__('Background', 'travelfic'),
        'section'     => 'travelfic_customizer_scroll_to_top',
        'tab'         => 'design',
        'priority'    => 16,
        'default'     => '#ffffff',

    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'page_loader_background_separator_line',
        'section'     => 'travelfic_customizer_scroll_to_top',
        'tab'         => 'design',
        'priority'    => 16,
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
    ]);

    // icon color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'page_loader_color',
        'label'       => esc_html__('Color', 'travelfic'),
        'section'     => 'travelfic_customizer_scroll_to_top',
        'tab'         => 'design',
        'priority'    => 17,
        'default'     => '#FA6400',

    ));

    /**
     * 
     * Header Theme Options
     * 
     */

    // header tab
    travelfic_Kirki::add_section('travelfic_customizer_header', [
        'title' => esc_html__('Header Builder', 'travelfic'),
        'priority' => 11,
        'default' => 'settings',
        'tabs'  => [
            'settings' => [
                'label' => esc_html__('Settings', 'travelfic'),
            ],
            'design'  => [
                'label' => esc_html__('Design', 'travelfic'),
            ],
        ],
    ]);

    // header design presets
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'radio-image',
        'settings'    => $prefix . 'header_design_select',
        'label'       => esc_html__('Design Presets', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'default'     => 'design1',
        'priority'    => 10,
        'tab'         => 'settings',
        'choices'     => [
            'design1' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-1.png'),
            'design2' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-2.png'),
            'design3' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-3.png'),
        ],
    ]);

    // header width
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'radio-image',
        'settings'    => $prefix . 'header_width',
        'label'       => esc_html__('Header Width', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'default'     => 'default',
        'tab'         => 'settings',
        'priority'    => 11,
        'choices'     => array(
            'default'    => get_template_directory_uri() . '/assets/admin/img/customizer/container-normal.svg',
            'full' => get_template_directory_uri() . '/assets/admin/img/customizer/container-fullwidth.svg',
        ),
    ));

    // design settings head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_settings_head',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Design Settings', 'travelfic') . '</h2>',
        'tab'         => 'settings',
        'priority'    => 12,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '!=',
                'value'    => 'design1',
            ],
        ],
    ]);

    /** design 2 settings */

    // topbar
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'header_design_2_topbar',
        'label'    => esc_html__('Topbar', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'settings',
        'default'  => true,
        'priority'    => 13,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_design_2_topbar_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 14,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // phone
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_2_phone',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Phone Number', 'travelfic'),
        'priority'    => 15,
        'tab'         => 'settings',
        'default'     => '+88 00 123 456',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_2_phone_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 16,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // email
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_2_email',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Email', 'travelfic'),
        'priority'    => 17,
        'tab'         => 'settings',
        'default'     => 'travello@outlook.com',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_2_email_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 18,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
        ],
    ]);

    // my account switcher
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'header_design_2_my_account',
        'label'    => esc_html__('My Account', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'settings',
        'default'  => true,
        'priority'    => 19,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_design_2_my_account_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 20,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_my_account',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);


    // registration url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_2_registration_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Register URL', 'travelfic'),
        'priority'    => 21,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_my_account',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_2_registration_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 22,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_my_account',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // login url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_2_login_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Login URL', 'travelfic'),
        'priority'    => 23,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
            [
                'setting'  => $prefix . 'header_design_2_my_account',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_2_login_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 24,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design2',
            ],
          
        ],
    ]);

    // topbar
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'header_design_3_topbar',
        'label'    => esc_html__('Topbar', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'settings',
        'default'  => true,
        'priority'    => 25,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_design_3_topbar_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 25,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // location
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_location',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Location', 'travelfic'),
        'priority'    => 26,
        'tab'         => 'settings',
        'default'     => '4b, Walse Street , USA',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_location_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 26,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // email
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_email',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Email', 'travelfic'),
        'priority'    => 27,
        'tab'         => 'settings',
        'default'     => 'info@example.com',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_email_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 27,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // phone
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_phone',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Phone Number', 'travelfic'),
        'priority'    => 28,
        'tab'         => 'settings',
        'default'     => '(245) 2156 21453',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_phone_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 28,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // login label
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_login_label',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Login Label', 'travelfic'),
        'priority'    => 29,
        'tab'         => 'settings',
        'default'     => 'Login Now',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_login_label_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 29,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // login url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_3_login_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Login URL', 'travelfic'),
        'priority'    => 30,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_login_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 30,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // search
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'header_design_3_search',
        'label'    => esc_html__('Search', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'settings',
        'default'  => true,
        'priority' => 31,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_design_3_search_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 31,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // cart
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'header_design_3_cart',
        'label'    => esc_html__('Cart', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'settings',
        'default'  => true,
        'priority' => 32,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_design_3_cart_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 32,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);


    // button
    new \Kirki\Pro\Field\HeadlineToggle([
        'settings' => $prefix . 'header_design_3_button',
        'label'    => esc_html__('Button', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'settings',
        'default'  => true,
        'priority' => 33,
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_design_3_button_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 33,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_button',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // discover label
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_button_label',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Button Label', 'travelfic'),
        'priority'    => 34,
        'tab'         => 'settings',
        'default'     => 'Discover Now',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_button',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_button_label_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 34,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_button',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // discover url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_3_button_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Button URL', 'travelfic'),
        'priority'    => 35,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
            [
                'setting'  => $prefix . 'header_design_3_button',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_button_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 35,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);


    // transparent header display
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'radio-buttonset',
        'settings'    => $prefix . 'transparent_showing',
        'label'       => esc_html__('Display On', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'default'     => 'both',
        'priority'    => 52,
        'tab'         => 'settings',
        'choices'     => [
            'desktop'   => esc_html__('Desktop', 'travelfic'),
            'mobile' => esc_html__('Mobile', 'travelfic'),
            'both' => esc_html__('Desktop + Mobile', 'travelfic'),
        ],
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'transparent_showing_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'   => 53,
        'tab'      => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',

        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // transparent logo redirect
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'      => 'custom',
        'settings'  => $prefix . 'header_transparent_logo_redirect',
        'priority'  => 54,
        'section'   => 'travelfic_customizer_header',
        'tab'       => 'settings',
        'default'   => '<a href="' . esc_url(admin_url('customize.php?autofocus[section]=title_tagline')) . '" class="tf-redirect-btn ">' . esc_html__('Transparent Logo', 'travelfic') . '</a>',
        'required'  => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_transparent_logo_redirect_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 54,
        'tab'         => 'settings',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',

        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    //Sticky Header Background Blur
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'kirki-input-slider',
        'settings' => $prefix . 'transparent_header_blur',
        'section'  => 'travelfic_customizer_header',
        'label'    => esc_html__('Background Blur', 'travelfic'),
        'priority'    => 55,
        'tab'      => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));


    // header design settings

    // header background color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type' => 'color',
        'settings' => $prefix . 'header_bg_color',
        'label'    => esc_html__('Background', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'design',
        'priority' => 10,
    ));


    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_bg_color_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 11,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // header button background
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'multicolor',
        'settings'    => $prefix . 'header_button_colors',
        'label'       => esc_html__('Button Background', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 12,
        'choices'     => [
            'normal' => esc_html__('Normal', 'travelfic'),
            'hover'  => esc_html__('Hover', 'travelfic'),
        ],
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_button_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 13,
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '!=',
                'value'    => 'design3',
            ],
        ],
    ]);

    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_topbar_head',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Topbar', 'travelfic') . '</h2>',
        'tab'         => 'design',
        'priority'    => 14,
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '!=',
                'value'    => 'design1',
            ],
        ],
    ]);

    // Topbar Backgournd
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'color',
        'settings' => $prefix . 'header_topbar_background',
        'label'    => esc_html__('Background', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'design',
        'priority' => 15,
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '!=',
                'value'    => 'design1',
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_topbar_background_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 16,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '!=',
                'value'    => 'design1',
            ],
        ],
    ]);
    // Topbar color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'color',
        'settings' => $prefix . 'header_topbar_color',
        'label'    => esc_html__('Color', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'design',
        'priority' => 17,
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '!=',
                'value'    => 'design1',
            ],
        ],
    ));

    // menu head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_menu_head',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Menu', 'travelfic') . '</h2>',
        'tab'         => 'design',
        'priority'    => 18,
    ]);

    //  h4 font fields
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_menu_typography',
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 19,
        'default'     => '
            <div class="d-flex justify-content-between tf-customizer-subtitle-wrapper tf-pt-12">
                <span class="tf-heading-font-title tf-customizer-subtitle">' . esc_html__('Typography', 'travelfic') . '</span>
                <div class="tf-menu-font-edit tf-edit">
                    <i class="dashicons dashicons-edit"></i>
                    <i class="dashicons dashicons-no-alt"></i>
                </div>
            </div>
        ',
    ]);

    // font wrapper
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<div class="travelfic-menu-font-wrapper"></div>',
        'tab'         => 'design',
        'priority'    => 20,
    ]);
    travelfic_add_font_weight_field($prefix . 'menu_font_weight', 'Font Weight', 'travelfic_customizer_header');
    travelfic_add_font_size_field($prefix . 'menu_font_size', 'Font Size', 'travelfic_customizer_header');
    travelfic_add_line_height_field($prefix . 'menu_font_line_height', 'travelfic_customizer_header');
    travelfic_add_letter_spacing_field($prefix . 'menu_font_letter_space', 'travelfic_customizer_header');
    travelfic_add_section_divider($prefix . 'section_divider', 'travelfic_customizer_header');
    travelfic_add_text_transform_field($prefix . 'menu_font_transform', 'travelfic_customizer_header');
    travelfic_add_text_decoration_field($prefix . 'menu_font_decoration', 'travelfic_customizer_header');


    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_menu_typography_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 21,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12"></div>',
    ]);

    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'multicolor',
        'settings'    => $prefix . 'header_menu_colors',
        'label'       => esc_html__('Color', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 22,
        'choices'     => [
            'normal' => esc_html__('Normal', 'travelfic'),
            'hover'  => esc_html__('Hover', 'travelfic'),
        ],
    ));


    // submenu head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_submenu_head',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Sub Menu', 'travelfic') . '</h2>',
        'tab'         => 'design',
        'priority'    => 23,
    ]);

    // header background color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type' => 'color',
        'settings' => $prefix . 'submenu_bg',
        'label'    => esc_html__('Background', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'design',
        'priority' => 24,
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'submenu_bg_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 25,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12"></div>',
    ]);

    //  h4 font fields
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_submenu_typography',
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 26,
        'default'     => '
            <div class="d-flex justify-content-between tf-customizer-subtitle-wrapper tf-pt-12">
                <span class="tf-submenu-font-title tf-customizer-subtitle">' . esc_html__('Typography', 'travelfic') . '</span>
                <div class="tf-submenu-font-edit tf-edit">
                    <i class="dashicons dashicons-edit"></i>
                    <i class="dashicons dashicons-no-alt"></i>
                </div>
            </div>
        ',
    ]);

    // font wrapper
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<div class="travelfic-submenu-font-wrapper"></div>',
        'tab'         => 'design',
        'priority'    => 27,
    ]);

    travelfic_add_font_weight_field($prefix . 'submenu_font_weight', 'Font Weight', 'travelfic_customizer_header');
    travelfic_add_font_size_field($prefix . 'submenu_font_size', 'Font Size', 'travelfic_customizer_header');
    travelfic_add_line_height_field($prefix . 'submenu_font_line_height', 'travelfic_customizer_header');
    travelfic_add_letter_spacing_field($prefix . 'submenu_font_letter_space', 'travelfic_customizer_header');
    travelfic_add_section_divider($prefix . 'section_divider', 'travelfic_customizer_header');
    travelfic_add_text_transform_field($prefix . 'submenu_font_transform', 'travelfic_customizer_header');
    travelfic_add_text_decoration_field($prefix . 'submenu_font_decoration', 'travelfic_customizer_header');


    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'header_submenu_color_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 28,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12"></div>',
    ]);

    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'multicolor',
        'settings'    => $prefix . 'header_submenu_color',
        'label'       => esc_html__('Color', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 29,
        'choices'     => [
            'normal' => esc_html__('Normal', 'travelfic'),
            'hover'  => esc_html__('Hover', 'travelfic'),
        ],
    ));


    // transparent header head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'transparent_header_head',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Transparent Header', 'travelfic') . '</h2>',
        'tab'         => 'design',
        'priority'    => 30,
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // transparent header bg
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'color',
        'settings' => $prefix . 'transparent_header_bg',
        'label'    => esc_html__('Background', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'design',
        'priority' => 31,
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'transparent_header_bg_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 32,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // transparent header submenu color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'multicolor',
        'settings'    => $prefix . 'transparent_header_menu_color',
        'label'       => esc_html__('Color', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 33,
        'choices'     => [
            'normal' => esc_html__('Normal', 'travelfic'),
            'hover'  => esc_html__('Hover', 'travelfic'),
        ],
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'transparent_header_menu_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 34,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // transparent header bg
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'color',
        'settings' => $prefix . 'transparent_submenu_bg',
        'label'    => esc_html__('Submenu Background', 'travelfic'),
        'section'  => 'travelfic_customizer_header',
        'tab'      => 'design',
        'priority' => 35,
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'transparent_submenu_bg_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 36,
        'tab'         => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // transparent header submenu color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'multicolor',
        'settings'    => $prefix . 'transparent_submenu_colors',
        'label'       => esc_html__('Submenu Color', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'tab'         => 'design',
        'priority'    => 37,
        'choices'     => [
            'normal' => esc_html__('Normal', 'travelfic'),
            'hover'  => esc_html__('Hover', 'travelfic'),
        ],
        'required' => [
            [
                'setting'  => $prefix . 'transparent_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));


    // transparent header head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'sticky_header_head',
        'section'     => 'travelfic_customizer_header',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Sticky Header', 'travelfic') . '</h2>',
        'tab'         => 'design',
        'priority'    => 38,
        'required' => [
            [
                'setting'  => $prefix . 'sticky_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    //Sticky Header Background color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'sticky_header_bg_color',
        'label'       => esc_html__('Background', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'priority'    => 39,
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'sticky_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'sticky_background_blur_before_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'   => 40,
        'tab'      => 'design',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12"></div>',
        'required' => [
            [
                'setting'  => $prefix . 'sticky_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'sticky_header_menu_text_color_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'   => 41,
        'tab'      => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'sticky_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]);

    // Sticky Header Menu Color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'sticky_header_menu_text_color',
        'label'       => esc_html__('Menu', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'priority'    => 42,
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'sticky_header',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ));

    /**
     * 
     * Social Theme Options
     * 
     */

    //  social head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_head',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<h2 class="travelfic-customizer-heading tf-mb-12">' . esc_html__('Social Content', 'travelfic') . '</h2>',
        'priority'    => 10,
    ]);

    //facebook
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_facebook',
        'label'       => esc_html__('Facebook', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',

    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_twitter_before_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    // twitter
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_twitter',
        'label'       => esc_html__('Twitter', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',

    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_twitter_after_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    // youtube
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_youtube',
        'label'       => esc_html__('Youtube', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',

    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_linkedin_before_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    //linkedin
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_linkedin',
        'label'       => esc_html__('Linkedin', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_linkedin_after_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    //instagram
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_instagram',
        'label'       => esc_html__('Instagram', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_pinterest_before_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    //pinterest
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_pinterest',
        'label'       => esc_html__('Pinterest', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_pinterest_after_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    //instagram
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_reddit',
        'label'       => esc_html__('Reddit', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',
    ));

    /**
     * 
     * Footer Builder Theme Options
     * 
     */

    travelfic_Kirki::add_section('travelfic_customizer_footer', [
        'title' => esc_html__('Footer Builder', 'travelfic'),
        'priority' => 18,
        'default' => 'settings',
        'tabs'  => [
            'settings' => [
                'label' => esc_html__('Settings', 'travelfic'),
            ],
            'design'  => [
                'label' => esc_html__('Design', 'travelfic'),
            ],
        ],
    ]);

    // footer design presets
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'radio-image',
        'settings'    => $prefix . 'footer_design_select',
        'label'       => esc_html__('Design Presets', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'default'     => 'design1',
        'tab'         => 'settings',
        'priority' => 10,
        'choices'     => [
            'design1' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/footer-1.png'),
            'design2' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/footer-2.png'),
            'design3' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/footer-3.png'),
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'custom',
        'settings' => $prefix . 'footer_design_select_separator_line',
        'section'  => 'travelfic_customizer_footer',
        'default'  => '<hr style="border-top: 1px solid #D1D5DB; margin: 12px -22px 12px;">',
        'priority' => 11,
        'tab'      => 'settings',
    ));


    // footer width
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'radio-image',
        'settings'    => $prefix . 'footer_width',
        'label'       => esc_html__('Footer Layout', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'default'     => 'default',
        'priority'    => 11,
        'tab'         => 'settings',
        'choices'     => array(
            'default'    => get_template_directory_uri() . '/assets/admin/img/customizer/container-normal.svg',
            'full' => get_template_directory_uri() . '/assets/admin/img/customizer/container-fullwidth.svg',
        ),
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_3_bg_image_before_separator_line',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'priority'    => 12,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // footer 3 bg image
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'image',
        'settings'    => $prefix . 'footer_3_bg_image',
        'label'       => esc_html__('Background Image', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'priority'    => 13,
        'transport'   => 'refresh',
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // footer bottom head
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_bottom_head',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<h2 class="travelfic-customizer-heading">' . esc_html__('Footer Bottom Settings', 'travelfic') . '</h2>',
        'priority'    => 16,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // footer menu label
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'footer_menu_label_1',
        'section'     => 'travelfic_customizer_footer',
        'label'       => esc_html__('Menu Label 1', 'travelfic'),
        'default'     =>  __('Privacy Policy', 'travelfic-toolkit'),
        'priority'    => 17,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // footer menu url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'footer_menu_url_1',
        'section'     => 'travelfic_customizer_footer',
        'label'       => esc_html__('Menu URL 1', 'travelfic'),
        'default'     =>  '#',
        'priority'    => 18,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'custom',
        'settings' => $prefix . 'footer_menu_url_1_separator_line',
        'section'  => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'priority'    => 19,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ));

    // footer menu label
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'footer_menu_label_2',
        'section'     => 'travelfic_customizer_footer',
        'label'       => esc_html__('Menu Label 2', 'travelfic'),
        'default'     =>  __('View on Maps', 'travelfic-toolkit'),
        'priority'    => 20,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // footer menu url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'footer_menu_url_2',
        'section'     => 'travelfic_customizer_footer',
        'label'       => esc_html__('Menu URL 2', 'travelfic'),
        'default'     =>  '#',
        'priority'    => 21,
        'tab'         => 'settings',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'     => 'custom',
        'settings' => $prefix . 'footer_width_separator_line',
        'section'  => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'priority'    => 22,
        'tab'         => 'settings',
    ));

    // footer copyright
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'textarea',
        'settings'    => $prefix . 'copyright_text',
        'label'       => esc_html__('Copyright Text', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'default'     => '&copy; ' . esc_html('Copyright ', 'travelfic') . date('Y') . ' ' . esc_html__('Tourfic Development Site by Themefic All Rights Reserved.', 'travelfic'),
        'priority'    => 23,
        'tab'         => 'settings',
    ));

    // footer Background Color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'footer_bg_color',
        'label'       => esc_html__('Background Color', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'   => 'refresh',
        'tab'         => 'design',
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_bg_color_separator_line',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'tab'         => 'design',

    ]);

    // footer background overlay
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'      => 'color',
        'settings' => $prefix . 'footer_3_bg_overlay_colors',
        'label'    => esc_html__('Background Overlay', 'travelfic'),
        'section'  => 'travelfic_customizer_footer',
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_3_bg_overlay_colors_separator_line',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    //Footer Text Color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'footer_text_color',
        'label'       => esc_html__('Footer Text Color', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'   => 'refresh',
        'tab'         => 'design',
    ));

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_text_color_separator_line',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    //Footer Text Color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'footer_bottom_left_bg_color',
        'label'       => esc_html__('Bottom Left Background', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ));
    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_bottom_left_bg_color_separator_line',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    //Footer Text Color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'footer_bottom_right_bg_color',
        'label'       => esc_html__('Bottom Right Background', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'tab'         => 'design',
        'required' => [
            [
                'setting'  => $prefix . 'footer_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],

    ));
});
