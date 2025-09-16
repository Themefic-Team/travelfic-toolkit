<?php

if (! defined('ABSPATH')) exit; // Exit if accessed directly 

// Travelfic Header 
add_filter('travelfic_header', 'travelfic_toolkit_header_callback', 11);
add_filter('ultimate_hotel_booking_header', 'travelfic_toolkit_header_callback', 11);
function travelfic_toolkit_header_callback($travelfic_header)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_check = get_theme_mod($travelfic_prefix . 'header_design_select', 'design1');

    if ($travelfic_header_check == "design1") {
        return $travelfic_header;
    } elseif ($travelfic_header_check == "design2") {
        $header_design2 =  Travelfic_Customizer_Header::travelfic_toolkit_header_second_design($travelfic_header);
        return $header_design2;
    } elseif ($travelfic_header_check == "design3") {
        $header_design3 =  Travelfic_Customizer_Header::travelfic_toolkit_header_third_design($travelfic_header);
        return $header_design3;
    }
}

// Travelfic Footer

add_filter('travelfic_footer', 'travelfic_toolkit_footer_callback', 11);
add_filter('ultimate_hotel_booking_footer', 'travelfic_toolkit_footer_callback', 11);
function travelfic_toolkit_footer_callback($travelfic_footer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_check = get_theme_mod($travelfic_prefix . 'footer_design_select', 'design1');
    if ($travelfic_footer_check == "design1") {
        return $travelfic_footer;
    } elseif ($travelfic_footer_check == "design2") {
        $footer_design2 =  Travelfic_Customizer_Footer::travelfic_toolkit_footer_second_design($travelfic_footer);
        return $footer_design2;
    } elseif ($travelfic_footer_check == "design3") {
        $footer_design3 =  Travelfic_Customizer_Footer::travelfic_toolkit_footer_third_design($travelfic_footer);
        return $footer_design3;
    }
}


// Travelfic Page tft-container Controller
add_filter('travelfic_page_tftcontainer', 'travelfic_toolkit_page_tftcontainer_callback', 11);
add_filter('hotelic_page_tftcontainer', 'travelfic_toolkit_page_tftcontainer_callback', 11);
function travelfic_toolkit_page_tftcontainer_callback($travelfic_tftcontainer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_page_width = get_theme_mod($travelfic_prefix . 'page_width', 'default');

    if ($travelfic_page_width == "default") {
        return $travelfic_tftcontainer;
    } else {
        return 'tft-fullwidth-container';
    }
}


// Page Loader
add_action('wp_footer', 'travelfic_toolkit_page_loader');
function travelfic_toolkit_page_loader()
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $page_loader = get_theme_mod($travelfic_prefix . 'page_loader', 1);
    if ($page_loader):
        $page_loader_background = get_theme_mod($travelfic_prefix . 'page_loader_background', '#fff');
        $page_loader_color = get_theme_mod($travelfic_prefix . 'page_loader_color', '#FA6400');

    ?>
        <div id="loader" class="tft-page__loader" style="background-color: <?php echo esc_attr($page_loader_background); ?>">
            <svg class="svg-calLoader" xmlns="http://www.w3.org/2000/svg" width="230" height="230">
                <path class="cal-loader__path" d="M86.429 40c63.616-20.04 101.511 25.08 107.265 61.93 6.487 41.54-18.593 76.99-50.6 87.643-59.46 19.791-101.262-23.577-107.142-62.616C29.398 83.441 59.945 48.343 86.43 40z" fill="none" stroke="<?php echo esc_attr($page_loader_color); ?>" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="10 10 10 10 10 10 10 432" stroke-dashoffset="77" />
                <path class="cal-loader__plane" d="M141.493 37.93c-1.087-.927-2.942-2.002-4.32-2.501-2.259-.824-3.252-.955-9.293-1.172-4.017-.146-5.197-.23-5.47-.37-.766-.407-1.526-1.448-7.114-9.773-4.8-7.145-5.344-7.914-6.327-8.976-1.214-1.306-1.396-1.378-3.79-1.473-1.036-.04-2-.043-2.153-.002-.353.1-.87.586-1 .952-.139.399-.076.71.431 2.22.241.72 1.029 3.386 1.742 5.918 1.644 5.844 2.378 8.343 2.863 9.705.206.601.33 1.1.275 1.125-.24.097-10.56 1.066-11.014 1.032a3.532 3.532 0 0 1-1.002-.276l-.487-.246-2.044-2.613c-2.234-2.87-2.228-2.864-3.35-3.309-.717-.287-2.82-.386-3.276-.163-.457.237-.727.644-.737 1.152-.018.39.167.805 1.916 4.373 1.06 2.166 1.964 4.083 1.998 4.27.04.179.004.521-.076.75-.093.228-1.109 2.064-2.269 4.088-1.921 3.34-2.11 3.711-2.123 4.107-.008.25.061.557.168.725.328.512.72.644 1.966.676 1.32.029 2.352-.236 3.05-.762.222-.171 1.275-1.313 2.412-2.611 1.918-2.185 2.048-2.32 2.45-2.505.241-.111.601-.232.82-.271.267-.058 2.213.201 5.912.8 3.036.48 5.525.894 5.518.914 0 .026-.121.306-.27.638-.54 1.198-1.515 3.842-3.35 9.021-1.029 2.913-2.107 5.897-2.4 6.62-.703 1.748-.725 1.833-.594 2.286.137.46.45.833.872 1.012.41.177 3.823.24 4.37.085.852-.25 1.44-.688 2.312-1.724 1.166-1.39 3.169-3.948 6.771-8.661 5.8-7.583 6.561-8.49 7.387-8.702.233-.065 2.828-.056 5.784.011 5.827.138 6.64.09 8.62-.5 2.24-.67 4.035-1.65 5.517-3.016 1.136-1.054 1.135-1.014.207-1.962-.357-.38-.767-.777-.902-.893z" class="cal-loader__plane" fill="<?php echo esc_attr($page_loader_color); ?>" />
            </svg>
        </div>
<?php endif;
}

// travelfic Customizer Options
function travelfic_toolkit_customizer_style()
{
    $travelfic_kit_pre = 'travelfic_customizer_settings_';
    $travelfic_current_active_theme =  wp_get_theme()->get_stylesheet();


    /**
     * 
     * Global Color Settings 
     * 
    */
    $travelfic_primary_color = get_theme_mod($travelfic_kit_pre . 'primary_color', '#0E3DD8');
    $travelfic_secondary_color = get_theme_mod($travelfic_kit_pre . 'secondary_color', '#003C7A');
    $travelfic_body_text_color = get_theme_mod($travelfic_kit_pre . 'body_text_color', '#686E7A');
    $travelfic_heading_color = get_theme_mod($travelfic_kit_pre . 'heading_color', '#060D1C');
    $travelfic_box_shadow_color = get_theme_mod($travelfic_kit_pre . 'box_shadow_color', '#e0e8ee');
    $travelfic_border_color = get_theme_mod($travelfic_kit_pre . 'border_color', '#f4f4f4');

    /**
     * 
     * Header Settings 
     * 
     */

    // header menu
    $travelfic_menu_font_weight = get_theme_mod($travelfic_kit_pre . 'menu_font_weight', '');
    $travelfic_menu_font_size = get_theme_mod($travelfic_kit_pre . 'menu_font_size', []);
    $travelfic_desktop_menu_size = isset( $travelfic_menu_font_size['desktop'] ) && $travelfic_menu_font_size['desktop'] !== 'NaN' ? $travelfic_menu_font_size['desktop'] : '';
    $travelfic_tablet_menu_size  = isset( $travelfic_menu_font_size['tablet'] ) && $travelfic_menu_font_size['tablet'] !== 'NaN' ? $travelfic_menu_font_size['tablet'] : '';
    $travelfic_mobile_menu_size  = isset( $travelfic_menu_font_size['mobile'] ) && $travelfic_menu_font_size['mobile'] !== 'NaN' ? $travelfic_menu_font_size['mobile'] : '';

    $travelfic_menu_line_height = get_theme_mod($travelfic_kit_pre . 'menu_font_line_height', '');
    $travelfic_menu_letter_space = get_theme_mod($travelfic_kit_pre . 'menu_font_letter_space', '');
    $travelfic_menu_texttransform = get_theme_mod($travelfic_kit_pre . 'menu_font_transform', '');
    $travelfic_menu_decoration = get_theme_mod($travelfic_kit_pre . 'menu_font_decoration', '');
    $travelfic_menu_colors = get_theme_mod($travelfic_kit_pre . 'header_menu_color', []);
    if (is_array($travelfic_menu_colors) && !empty($travelfic_menu_colors)) {
        $travelfic_menu_color = isset($travelfic_menu_colors['normal']) ? $travelfic_menu_colors['normal'] : '';
        $travelfic_menu_color_hover = isset($travelfic_menu_colors['hover']) ? $travelfic_menu_colors['hover'] : '';
    }

    // header submenu
    $travelfic_submenu_font_weight = get_theme_mod($travelfic_kit_pre . 'submenu_font_weight', '');
    $travelfic_submenu_font_size = get_theme_mod($travelfic_kit_pre . 'submenu_font_size', []);
    $travelfic_desktop_submenu_size = isset( $travelfic_submenu_font_size['desktop'] ) && $travelfic_submenu_font_size['desktop'] !== 'NaN' ? $travelfic_submenu_font_size['desktop'] : '';
    $travelfic_tablet_submenu_size  = isset( $travelfic_submenu_font_size['tablet'] ) && $travelfic_submenu_font_size['tablet'] !== 'NaN' ? $travelfic_submenu_font_size['tablet'] : '';
    $travelfic_mobile_submenu_size  = isset( $travelfic_submenu_font_size['mobile'] ) && $travelfic_submenu_font_size['mobile'] !== 'NaN' ? $travelfic_submenu_font_size['mobile'] : '';

    $travelfic_submenu_line_height = get_theme_mod($travelfic_kit_pre . 'submenu_font_line_height', '');
    $travelfic_submenu_letter_space = get_theme_mod($travelfic_kit_pre . 'submenu_font_letter_space', '');
    $travelfic_submenu_texttransform = get_theme_mod($travelfic_kit_pre . 'submenu_font_transform', '');
    $travelfic_submenu_decoration = get_theme_mod($travelfic_kit_pre . 'submenu_font_decoration', '');
    $travelfic_submenu_bg = get_theme_mod($travelfic_kit_pre . 'submenu_bg', '');
    $travelfic_submenu_colors = get_theme_mod($travelfic_kit_pre . 'header_submenu_color', []);
    if (is_array($travelfic_submenu_colors) && !empty($travelfic_submenu_colors)) {
        $travelfic_submenu_text = isset($travelfic_submenu_colors['normal']) ? $travelfic_submenu_colors['normal'] : '';
        $travelfic_submenu_hover = isset($travelfic_submenu_colors['hover']) ? $travelfic_submenu_colors['hover'] : '';
    }


    // header button
    $travelfic_header_button_colors = get_theme_mod($travelfic_kit_pre . 'header_button_background_color', []);
    if (is_array($travelfic_header_button_colors) && !empty($travelfic_header_button_colors)) {
        $travelfic_header_btn_bg_color = isset($travelfic_header_button_colors['normal']) ? $travelfic_header_button_colors['normal'] : '';
        $travelfic_header_btn_hover_bg_color = isset($travelfic_header_button_colors['hover']) ? $travelfic_header_button_colors['hover'] : '';
    }

    $travelfic_header_button_text_colors = get_theme_mod($travelfic_kit_pre . 'header_button_text_colors', []);
    if (is_array($travelfic_header_button_text_colors) && !empty($travelfic_header_button_text_colors)) {
        $travelfic_header_btn_text_color = isset($travelfic_header_button_text_colors['normal']) ? $travelfic_header_button_text_colors['normal'] : '';
        $travelfic_header_btn_hover_text_color = isset($travelfic_header_button_text_colors['hover']) ? $travelfic_header_button_text_colors['hover'] : '';
    }

    // topbar
    $travelfic_design_topbar = get_theme_mod($travelfic_kit_pre . 'header_topbar_background', '');
    $travelfic_design_topbar_color = get_theme_mod($travelfic_kit_pre . 'header_topbar_color', '');

    // transparent header 
    $travelfic_transparent_header_bg = get_theme_mod($travelfic_kit_pre . 'transparent_header_bg_color');
    $travelfic_transparent_header_colors = get_theme_mod($travelfic_kit_pre . 'transparent_header_menu_color', []);
    if (is_array($travelfic_transparent_header_colors) && !empty($travelfic_transparent_header_colors)) {
        $travelfic_transparent_menu_color = isset($travelfic_transparent_header_colors['normal']) ? $travelfic_transparent_header_colors['normal'] : '';
        $travelfic_transparent_menu_hover_color = isset($travelfic_transparent_header_colors['hover']) ? $travelfic_transparent_header_colors['hover'] : '';
    }

    $travelfic_transparent_header_blur = get_theme_mod($travelfic_kit_pre . 'transparent_header_blur');

    // transparent header
    $travelfic_transparent_submenu_bg = get_theme_mod($travelfic_kit_pre . 'transparent_submenu_bg');
    $travelfic_transparent_submenu_color = get_theme_mod($travelfic_kit_pre . 'transparent_submenu_color', []);
    if (is_array($travelfic_transparent_submenu_color) && !empty($travelfic_transparent_submenu_color)) {
        $travelfic_transparent_submenu_text = isset($travelfic_transparent_submenu_color['normal']) ? $travelfic_transparent_submenu_color['normal'] : '';
        $travelfic_transparent_submenu_hover = isset($travelfic_transparent_submenu_color['hover']) ? $travelfic_transparent_submenu_color['hover'] : '';
    }

    // mobile header
    $travelfic_mobile_menu_color = get_theme_mod($travelfic_kit_pre . 'mobile_header_menu_color');
    $travelfic_mobile_submenu_color = get_theme_mod($travelfic_kit_pre . 'mobile_header_submenu_color', []);


    /**
     * 
     * Footer Settings
     */
    $travelfic_footer_back_image = get_theme_mod($travelfic_kit_pre . 'footer_3_bg_image');
    $travelfic_footer_back_overlay = get_theme_mod($travelfic_kit_pre . 'footer_3_bg_overlay_color');
    $travelfic_footer_btm_left_bg = get_theme_mod($travelfic_kit_pre . 'footer_bottom_left_bg_color');
    $travelfic_footer_btm_right_bg = get_theme_mod($travelfic_kit_pre . 'footer_bottom_right_bg_color');
    empty($travelfic_footer_back_image) ? $travelfic_footer_back_overlay = 'transparent' : $travelfic_footer_back_overlay;

?>

    <style>
        <?php if ('travelfic' !== $travelfic_current_active_theme && 'travelfic-child' !== $travelfic_current_active_theme): ?>
                :root {
                    --tf-color-white: #ffffff;
                    --tf-primary: <?php echo esc_attr($travelfic_primary_color); ?> ;
                    --tf-brand-dark: <?php echo esc_attr($travelfic_secondary_color); ?> ;
                    --tf-text-paragraph: <?php echo esc_attr($travelfic_body_text_color); ?> ;
                    --tf-text-heading: <?php echo esc_attr($travelfic_heading_color); ?> ;
                    --tf-box-shadow-color: <?php echo esc_attr($travelfic_box_shadow_color) ?> ;
                    --tf-border-lite: <?php echo esc_attr($travelfic_border_color) ?> ;
                }
        
        <?php endif; 
        
        ?>
    
        /* header menu typography */
        <?php if (!empty($travelfic_menu_color) || !empty($travelfic_menu_font_weight) || !empty($travelfic_desktop_menu_size) ||  !empty($travelfic_menu_line_height) || !empty($travelfic_menu_texttransform) || !empty($travelfic_menu_letter_space) || !empty($travelfic_menu_decoration)): ?>
            #tft-site-main-body header .tft-site-navigation ul > li > a,
            #tft-site-main-body header .tft-site-navigation ul > li > a:after,
            #tft-site-main-body .menu-item-has-children > a:after {
                <?php if (!empty($travelfic_menu_color)): ?>
                    color: <?php echo esc_attr($travelfic_menu_color); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_menu_font_weight)): ?>
                    font-weight: <?php echo esc_attr($travelfic_menu_font_weight); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_desktop_menu_size)): ?>
                    font-size: <?php echo esc_attr($travelfic_desktop_menu_size); ?>px;
                <?php endif; ?>
                <?php if (!empty($travelfic_menu_line_height)): ?>
                    line-height: <?php echo esc_attr($travelfic_menu_line_height); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_menu_texttransform)): ?>
                    text-transform: <?php echo esc_attr($travelfic_menu_texttransform); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_menu_letter_space)): ?>
                    letter-spacing: <?php echo esc_attr($travelfic_menu_letter_space); ?>px;
                <?php endif; ?>
                <?php if (!empty($travelfic_menu_decoration)): ?>
                    <?php if ($travelfic_menu_decoration === 'italic'): ?>
                        font-style: <?php echo esc_attr($travelfic_menu_decoration); ?>;
                    <?php else: ?>
                        text-decoration: <?php echo esc_attr($travelfic_menu_decoration); ?>;
                    <?php endif; ?>
                <?php endif; ?>
            }
        <?php endif; ?>
        
        
        /* header menu hover color */
        <?php if(!empty($travelfic_menu_color_hover)): ?>
            #tft-site-main-body header .tft-site-navigation ul>li:hover>a,
            #tft-site-main-body header .tft-site-navigation ul>li:hover .travelfic-dropdown>a,
            #tft-site-main-body header .menu-item-has-children:hover::after,
            #tft-site-main-body header .menu-item-has-children:hover a::after{
                color: <?php echo !empty($travelfic_menu_color_hover) ? esc_attr($travelfic_menu_color_hover) : esc_attr(''); ?>;
            }
        <?php endif; ?>

        /* header submenu background */
        <?php if(!empty($travelfic_submenu_bg)): ?>
            #tft-site-main-body header .tft-site-navigation ul li > ul.sub-menu,
            #tft-site-main-body header .tft-site-navigation ul li > ul.children,
            #tft-site-main-body header .tft-header-mobile .tft-site-navigation {
                border-color: <?php echo !empty($travelfic_submenu_bg) ? esc_attr($travelfic_submenu_bg) : esc_attr(''); ?>;
                background: <?php echo !empty($travelfic_submenu_bg) ? esc_attr($travelfic_submenu_bg) : esc_attr(''); ?>;
            }
        <?php endif; ?>

        /* header submenu typography */
        <?php if ( !empty($travelfic_submenu_text) || !empty($travelfic_submenu_font_weight) || !empty($travelfic_desktop_submenu_size) || !empty($travelfic_submenu_line_height) || !empty($travelfic_submenu_texttransform) || !empty($travelfic_submenu_letter_space) || !empty($travelfic_submenu_decoration)): ?>
            #tft-site-main-body header .tft-site-navigation ul li > ul.sub-menu li a,
            #tft-site-main-body header .tft-header-mobile .tft-site-navigation ul.sub-menu > li > a,
             #tft-site-main-body header .tft-header-mobile .tft-site-navigation ul.sub-menu > li > a::after {
                <?php if (!empty($travelfic_submenu_text)): ?>
                    color: <?php echo esc_attr($travelfic_submenu_text); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_submenu_font_weight)): ?>
                    font-weight: <?php echo esc_attr($travelfic_submenu_font_weight); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_desktop_submenu_size)): ?>
                    font-size: <?php echo esc_attr($travelfic_desktop_submenu_size); ?>px;
                <?php endif; ?>
                <?php if (!empty($travelfic_submenu_line_height)): ?>
                    line-height: <?php echo esc_attr($travelfic_submenu_line_height); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_submenu_texttransform)): ?>
                    text-transform: <?php echo esc_attr($travelfic_submenu_texttransform); ?>;
                <?php endif; ?>
                <?php if (!empty($travelfic_submenu_letter_space)): ?>
                    letter-spacing: <?php echo esc_attr($travelfic_submenu_letter_space); ?>px;
                <?php endif; ?>
                <?php if (!empty($travelfic_submenu_decoration)): ?>
                    <?php if ($travelfic_submenu_decoration === 'italic'): ?>
                        font-style: <?php echo esc_attr($travelfic_submenu_decoration); ?>;
                    <?php else: ?>
                        text-decoration: <?php echo esc_attr($travelfic_submenu_decoration); ?>;
                    <?php endif; ?>
                <?php endif; ?>
            }
        <?php endif; ?>

        /* header submenu hover color */
        <?php if(!empty($travelfic_submenu_hover)): ?>
            #tft-site-main-body header .tft-site-navigation ul.sub-menu>li:hover>a{
                color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr($travelfic_submenu_hover) : esc_attr(''); ?>;
            }
        <?php endif; ?>

  
        /* header button background */
        <?php if(!empty($travelfic_header_btn_bg_color)): ?>
            #tft-site-main-body #page header :is(a.tft-btn, .tft-account a) {
                background: <?php echo !empty($travelfic_header_btn_bg_color) ? esc_attr($travelfic_header_btn_bg_color) : ''; ?>;
            }    
        <?php endif; ?>

        /* header button hover background  */
        <?php if(!empty($travelfic_header_btn_hover_bg_color)): ?>
            #tft-site-main-body #page header :is(.tft-header-design__three__bottom__right__button .tft-btn:hover, .tft-account a:hover) {
                background: <?php echo !empty($travelfic_header_btn_hover_bg_color) ? esc_attr($travelfic_header_btn_hover_bg_color) : ''; ?>;
            }    
        <?php endif; ?>

        <?php if(!empty($travelfic_header_btn_text_color)): ?>
            #tft-site-main-body #page header :is(a.tft-btn, .tft-account a) {
                color: <?php echo !empty($travelfic_header_btn_text_color) ? esc_attr($travelfic_header_btn_text_color) : ''; ?>;
            }    
        <?php endif; ?>

        /* header button hover color  */
        <?php if(!empty($travelfic_header_btn_hover_text_color)): ?>
            #tft-site-main-body #page header :is(.tft-header-design__three__bottom__right__button .tft-btn:hover, .tft-account a:hover){
                color: <?php echo !empty($travelfic_header_btn_hover_text_color) ? esc_attr($travelfic_header_btn_hover_text_color) : ''; ?>;
            }    
        <?php endif; ?>



        /**
         * Transparent Header Start 
        */

        /* header transparent background */
        <?php if(!empty($travelfic_transparent_header_bg || ($travelfic_transparent_header_blur && $travelfic_transparent_header_blur > 0))): ?>
            #tft-site-main-body .tft_has_transparent {
                <?php if ( ! empty( $travelfic_transparent_header_bg ) ) : ?>
                    background: <?php echo esc_attr( $travelfic_transparent_header_bg ); ?>;
                <?php endif; ?>

                <?php if ( ! empty( $travelfic_transparent_header_blur ) ) :
                    $blur = (int) $travelfic_transparent_header_blur; ?>
                    backdrop-filter: blur(<?php echo $blur; ?>px);
                    -webkit-backdrop-filter: blur(<?php echo $blur; ?>px);
                <?php endif; ?>
            }
        <?php endif; ?>

        /* header transparent menu color */
        <?php if(!empty($travelfic_transparent_menu_color)): ?>
            #tft-site-main-body .tft_has_transparent :is(.main--header-menu > li > a, .tft-site-navigation > ul > li a, a i, .logo-text a),
            #tft-site-main-body header .tft_has_transparent .tft-site-navigation ul > li > a:after, 
            #tft-site-main-body .tft_has_transparent .menu-item-has-children > a:after{
                color: <?php echo !empty($travelfic_transparent_menu_color) ? esc_attr($travelfic_transparent_menu_color) : ''; ?>;
            }
        <?php endif; ?>

        /* header transparent menu hover color */
        <?php if(!empty($travelfic_transparent_menu_hover_color)): ?>
            #tft-site-main-body header .tft_has_transparent :is(.main--header-menu > li > a:hover, .logo-text a:hover),
            #tft-site-main-body header .tft_has_transparent .tft-site-navigation ul > li > a:hover:after, 
            #tft-site-main-body .tft_has_transparent .menu-item-has-children > a:hover:after {
                color: <?php echo !empty($travelfic_transparent_menu_hover_color) ? esc_attr($travelfic_transparent_menu_hover_color) : ''; ?>;
            }
        <?php endif; ?>

        /* header transparent submenu background */
        <?php if(!empty($travelfic_transparent_submenu_bg)): ?>
            #tft-site-main-body .tft_has_transparent .tft-site-navigation ul.sub-menu{
                background: <?php echo !empty($travelfic_transparent_submenu_bg) ? esc_attr($travelfic_transparent_submenu_bg) : ''; ?>;
            }
        <?php endif; ?>

        /* header transparent submenu color */
        <?php if(!empty($travelfic_transparent_submenu_text)): ?>
            #tft-site-main-body .tft_has_transparent .tft-site-navigation ul.sub-menu li a{
                color: <?php echo !empty($travelfic_transparent_submenu_text) ? esc_attr($travelfic_transparent_submenu_text) : ''; ?>;
            }
        <?php endif; ?>

        /* header transparent submenu hover color */
        <?php if(!empty($travelfic_transparent_submenu_hover)): ?>
            #tft-site-main-body .tft_has_transparent .tft-site-navigation ul.sub-menu>li:hover>a{
                color: <?php echo !empty($travelfic_transparent_submenu_hover) ? esc_attr($travelfic_transparent_submenu_hover) : ''; ?>;
            }
        <?php endif; ?>


        /* header topbar */
        <?php if(!empty($travelfic_design_topbar)): ?>
            #tft-site-main-body .tft-top-header,
            #tft-site-main-body .tft-top-header::after {
                background: <?php echo esc_attr($travelfic_design_topbar); ?>;
            }
        <?php endif; ?>

        /* header topbar color */
        <?php if(!empty($travelfic_design_topbar_color)): ?>
            #tft-site-main-body .tft-top-header a {
                color: <?php echo esc_attr($travelfic_design_topbar_color); ?>;
            }   
            #tft-site-main-body .tft-top-header svg :is(path, circle, ellipse) {
                fill: <?php echo esc_attr($travelfic_design_topbar_color); ?>;
                stroke: <?php echo esc_attr($travelfic_design_topbar_color); ?>;
            }   
        <?php endif; ?>

        /**
         * Footer Start
        */

        /* footer overlay */
        <?php if(!empty($travelfic_footer_back_overlay)): ?>
            #tft-site-main-body footer.tft-site-footer::after {
                background: <?php echo esc_attr($travelfic_footer_back_overlay); ?>;
            }
        <?php endif; ?>

        /* footer bottom left background */
        <?php if(!empty($travelfic_footer_btm_left_bg)): ?>
            #tft-site-main-body .tft-footer-bottom__three__copyright,
            #tft-site-main-body .tft-footer-bottom__three__copyright::after {
                background: <?php echo esc_attr($travelfic_footer_btm_left_bg); ?>;
            }
        <?php endif; ?>
        
        /* footer bottom right background */
        <?php if(!empty($travelfic_footer_btm_right_bg)): ?>
            #tft-site-main-body .tft-footer-bottom__three__menu,
            #tft-site-main-body .tft-footer-bottom__three__menu::after {
                background: <?php echo esc_attr($travelfic_footer_btm_right_bg); ?>;
            }    
        <?php endif;

    

        // mobile header
        if(!empty($travelfic_mobile_menu_color)): ?>
            @media screen and (max-width: 1199px) {
                #tft-site-main-body .mobile-sidenav ul li a,
                #tft-site-main-body .menu-item-has-children > a:after{
                    color: <?php echo esc_attr($travelfic_mobile_menu_color); ?>;
                }
            }
            @media screen and (max-width: 991px) {
                #tft-site-main-body .tft-site-navigation ul > li > a,
                #tft-site-main-body .tft-site-navigation > div > ul > li > a,
                #tft-site-main-body .tft-site-navigation ul > li .travelfic-dropdown > a,

                #tft-site-main-body header :is(.main--header-menu > li > a, .tft-site-navigation button.toggle i, .tft-site-navigation > ul > li > a),
                #tft-site-main-body .menu-item-has-children > a:after{
                    color: <?php echo esc_attr($travelfic_mobile_menu_color); ?>;
                }
            }
            @media screen and (max-width: 767px) {
                #tft-site-main-body .tft-header-design__three ul li a path{
                    fill: <?php echo esc_attr($travelfic_mobile_menu_color); ?>;
                }
                #tft-site-main-body .tft-header-design__two ul li a :is(path, circle, ellipse){
                    stroke: <?php echo esc_attr($travelfic_mobile_menu_color); ?>;
                }
            }
                
        <?php endif;

        if(!empty($travelfic_mobile_submenu_color)): ?>
            @media screen and (max-width: 1199px) {
                #tft-site-main-body .mobile-sidenav ul.sub-menu li a {
                    color: <?php echo esc_attr($travelfic_mobile_submenu_color); ?>;
                }
            }

            @media screen and (max-width: 991px) {
                #tft-site-main-body ul.sub-menu > li > a,
                #tft-site-main-body header .tft-site-navigation ul li > ul.sub-menu li a  {
                    color: <?php echo esc_attr($travelfic_mobile_submenu_color); ?>;
                }
            }
                
        <?php endif;



        /**
         * 
         * Customizer responsive styles
         * 
        */
        
        if(function_exists('tf_tablet_responsive_styles') && function_exists('tf_mobile_responsive_styles')){
            // Selectors
            $travelfic_logo_selector = '#tft-site-main-body header .tft-logo a';
            $travelfic_menu_selector = '#tft-site-main-body .tft-site-navigation > ul > li > a, #tft-site-main-body .menu-item-has-children > a:after, #tft-site-main-body .tft-site-navigation > div > ul > li > a';
            $travelfic_submenu_selector = '#tft-site-main-body header .tft-site-navigation ul li > ul.sub-menu li a';


            // logo responsive styles
            $logo_tablet_styles = tf_tablet_responsive_styles([], [], [], '', $travelfic_tablet_logo_width ?? '');
            $logo_mobile_styles = tf_mobile_responsive_styles([], [], [], '', $travelfic_mobile_logo_width ?? '');

            // menu responsive styles
            $menu_tablet_styles = tf_tablet_responsive_styles([], [], [], $travelfic_tablet_menu_size ?? '');
            $menu_mobile_styles = tf_mobile_responsive_styles([], [], [], $travelfic_mobile_menu_size ?? '');

            // submenu responsive styles
            $submenu_tablet_styles = tf_tablet_responsive_styles([], [], [], $travelfic_tablet_submenu_size ?? '');
            $submenu_mobile_styles = tf_mobile_responsive_styles([], [], [], $travelfic_mobile_submenu_size ?? '');


            // logo tablet & mobile styles
            if($logo_tablet_styles){
                echo "@media only screen and (max-width: 992px) {
                    {$travelfic_logo_selector} {
                        {$logo_tablet_styles}
                    }
                }";
            }
            if($logo_mobile_styles){
                echo "@media only screen and (max-width: 600px) {
                    {$travelfic_logo_selector} {
                        {$logo_mobile_styles}
                    }
                }";
            }

            // menu tablet & mobile styles
            if($menu_tablet_styles){
                echo "@media only screen and (max-width: 992px) {
                    {$travelfic_menu_selector} {
                        {$menu_tablet_styles}
                    }
                }";
            }
            if($menu_mobile_styles){
                echo "@media only screen and (max-width: 600px) {
                    {$travelfic_menu_selector} {
                        {$menu_mobile_styles}
                    }
                }";
            }

            // submenu tablet & mobile styles
            if($submenu_tablet_styles){
                echo "@media only screen and (max-width: 992px) {
                    {$travelfic_submenu_selector} {
                        {$submenu_tablet_styles}
                    }
                }";
            }
            if($submenu_mobile_styles){
                echo "@media only screen and (max-width: 600px) {
                    {$travelfic_submenu_selector} {
                        {$submenu_mobile_styles}
                    }
                }";
            }
        }

        ?>
    </style>

<?php
}
add_action('wp_head', 'travelfic_toolkit_customizer_style', 12);
