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
add_action('init', function(){
    
    // return if Kirki doesn't exist
    if(!class_exists('travelfic_Kirki')){
        return;
    }

    // prefix
    $prefix = 'travelfic_customizer_settings_';


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
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'radio-image',
        'settings'    => $prefix . 'header_design_select',
        'label'       => esc_html__('Design Presets', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'default'     => 'design1',
        'priority' => 11,
        'choices'     => [
            'design1' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-1.png'),
            'design2' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-2.png'),
            'design3' => esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/header-3.png'),
        ],
    ]);


    // transparent header
    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'radio-buttonset',
        'settings'    => $prefix . 'transparent_showing',
        'label'    => esc_html__('Display On', 'travelfic'),
        'section'     => 'travelfic_customizer_header',
        'default'     => 'both',
        'choices'     => [
            'desktop'   => esc_html__('Desktop', 'travelfic'),
            'mobile' => esc_html__('Mobile', 'travelfic'),
            'both' => esc_html__('Desktop + Mobile', 'travelfic'),
        ],
        'required' => [
            [
                'setting'  => $prefix . 'transparent_showing',
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

    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_twitter_before_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    //twitter
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_twitter',
        'label'       => esc_html__('Twitter', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',
    
    ));

    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'social_twitter_after_separator_line',
        'section'     => 'travelfic_customizer_social',
        'default'     => '<div class="border-dashed border-bottom tf-mb-12 tf-pt-12"></div>',
    ]);

    //twitter
    travelfic_Kirki::add_field('travelfic_customizer_options', array(
        'type'        => 'url',
        'settings'    => $prefix . 'social_youtube',
        'label'       => esc_html__('Youtube', 'travelfic'),
        'section'     => 'travelfic_customizer_social',
        'default'     => '#',
    
    ));

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

    // separator
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

    // separator
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

    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'text',
        'settings'    => $prefix . 'footer_menu_label_2',
        'section'     => 'travelfic_customizer_footer',
        'label'       => esc_html__('Menu Label 2', 'travelfic'),
        'default'     =>  __('Privacy Policy', 'travelfic-toolkit'),
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

    // separator
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

   

    //Footer Background Color
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


    travelfic_Kirki::add_field('travelfic_customizer_options', [
        'type'        => 'custom',
        'settings'    => $prefix . 'footer_bg_color_separator_line',
        'section'     => 'travelfic_customizer_footer',
        'default'     => '<div class="border-dashed border-bottom tf-pt-12 tf-mb-12"></div>',
        'tab'         => 'design',
       
    ]);

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