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
        'default'  => '<hr style="border-top: 1px solid #D1D5DB; margin: 0 -22px 20px;">',
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
        'default'     => '#fff',
        'priority'    => 16,

    ));

    // icon color
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'color',
        'settings'    => $prefix . 'page_loader_color',
        'label'       => esc_html__('Color', 'travelfic'),
        'section'     => 'travelfic_customizer_scroll_to_top',
        'tab'         => 'design',
        'default'     => '#FA6400',
        'priority'    => 17,

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

    // registration url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_2_registration_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Register URL', 'travelfic'),
        'priority'    => 19,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
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
        'settings'    => $prefix . 'design_2_registration_url_separator_line',
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
        ],
    ]);

    // login url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_2_login_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Login URL', 'travelfic'),
        'priority'    => 21,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
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
        'settings'    => $prefix . 'design_2_login_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 22,
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
        'priority'    => 23,
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
        'priority'    => 24,
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

    // location
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_location',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Location', 'travelfic'),
        'priority'    => 25,
        'tab'         => 'settings',
        'default'     => '4b, Walse Street , USA',
        'required'    => [
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
        ],
    ]);

    // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'design_3_email_separator_line',
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
        ],
    ]);

    // phone
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_phone',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Phone Number', 'travelfic'),
        'priority'    => 29,
        'tab'         => 'settings',
        'default'     => '(245) 2156 21453',
        'required'    => [
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
        'settings'    => $prefix . 'design_3_phone_separator_line',
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

    // login label
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_login_label',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Login Label', 'travelfic'),
        'priority'    => 31,
        'tab'         => 'settings',
        'default'     => 'Login Now',
        'required'    => [
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
        'settings'    => $prefix . 'design_3_login_label_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 32,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // login url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_3_login_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Login URL', 'travelfic'),
        'priority'    => 33,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
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
        'settings'    => $prefix . 'design_3_login_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 34,
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

    // discover label
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'design_3_discover_label',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Discover Label', 'travelfic'),
        'priority'    => 35,
        'tab'         => 'settings',
        'default'     => 'Discover Now',
        'required'    => [
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
        'settings'    => $prefix . 'design_3_discover_label_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 36,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);

    // discover url
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'url',
        'settings'    => $prefix . 'design_3_discover_url',
        'section'     => 'travelfic_customizer_header',
        'label'       => esc_html__('Discover URL', 'travelfic'),
        'priority'    => 37,
        'tab'         => 'settings',
        'default'     => '#',
        'required'    => [
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
        'settings'    => $prefix . 'design_3_discover_url_separator_line',
        'section'     => 'travelfic_customizer_header',
        'priority'    => 38,
        'tab'         => 'settings',
        'required'    => [
            [
                'setting'  => $prefix . 'header_design_select',
                'operator' => '==',
                'value'    => 'design3',
            ],
        ],
    ]);


    // transparent header
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


    /**
     * 
     * Tourfic Theme Options
     * 
     */

     // separator line
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'tourfic_border_radius_separator_line',
        'section'     => 'travelfic_customizer_tourfic',
        'default'     => '<div class="tf-mb-12"></div>',
    ]);
    //  tourfic border radius
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'       => 'kirki-padding',
        'settings'   => $prefix . 'tourfic_border_radius',
        'section'    => 'travelfic_customizer_tourfic',
        'label'      => esc_html__('Border Radius', 'travelfic'),
        'default'     => [
            'top'    => 3,
            'right'  => 3,
            'bottom' => 3,
            'left'   => 3,
        ],
        'choices'    => [
            'units' => "PX",
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
        'label'       => esc_html__('Footer Background Color', 'travelfic'),
        'section'     => 'travelfic_customizer_footer',
        'default'     => '#ffffff',
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
        'default'     => '#101F36',
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
        'default'     => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'   => 'refresh',
        'tab'         => 'design',
    ));
});
