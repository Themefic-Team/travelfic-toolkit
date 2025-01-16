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

// Travelfic Header tft-container Controller

add_filter('travelfic_header_tftcontainer', 'travelfic_toolkit_header_tftcontainer_callback', 11);
add_filter('ultimate_hotel_booking_header_tftcontainer', 'travelfic_toolkit_header_tftcontainer_callback', 11);
function travelfic_toolkit_header_tftcontainer_callback($travelfic_tftcontainer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_width = get_theme_mod($travelfic_prefix . 'header_width', 'default');

    if ($travelfic_header_width == "default") {
        return $travelfic_tftcontainer;
    } else {
        return 'travelfic-kit-container';
    }
}

// Travelfic Footer tft-container Controller

add_filter('travelfic_footer_tftcontainer', 'travelfic_toolkit_footer_tftcontainer_callback', 11);
add_filter('ultimate_hotel_booking_footer_tftcontainer', 'travelfic_toolkit_footer_tftcontainer_callback', 11);
function travelfic_toolkit_footer_tftcontainer_callback($travelfic_tftcontainer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_width = get_theme_mod($travelfic_prefix . 'footer_width', 'default');

    if ($travelfic_footer_width == "default") {
        return $travelfic_tftcontainer;
    } else {
        return 'travelfic-kit-container';
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
        return 'travelfic-kit-container';
    }
}

// Travelfic Header design 2 tft-container Controller

add_filter('travelfic_header_2_tftcontainer', 'travelfic_toolkit_header_2_tftcontainer_callback', 11);
function travelfic_toolkit_header_2_tftcontainer_callback($travelfic_tftcontainer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_width = get_theme_mod($travelfic_prefix . 'header_width', 'default');

    if ($travelfic_header_width == "default") {
        return $travelfic_tftcontainer;
    } else {
        return 'tft-fullwidth-container';
    }
}

// Travelfic Footer design 2 tft-container Controller

add_filter('travelfic_footer_2_tftcontainer', 'travelfic_toolkit_footer_2_tftcontainer_callback', 11);
function travelfic_toolkit_footer_2_tftcontainer_callback($travelfic_tftcontainer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_width = get_theme_mod($travelfic_prefix . 'footer_width', 'default');

    if ($travelfic_footer_width == "default") {
        return $travelfic_tftcontainer;
    } else {
        return 'tft-fullwidth-container';
    }
}

// travelfic Customizer Options
function travelfic_toolkit_customizer_style()
{
    $travelfic_kit_pre = 'travelfic_customizer_settings_';
    $travelfic_menu_color = get_theme_mod($travelfic_kit_pre . 'menu_color', '#222');

    $menu_typo_values = get_theme_mod($travelfic_kit_pre . 'header_menu_typo', array(
        'line-height' => '24',
        'font-size' => '16',
        'text-transform' => 'none',
    ));
    $travelfic_menu_line_height = $menu_typo_values['line-height'];
    $travelfic_menu_font_size = $menu_typo_values['font-size'];
    $travelfic_menu_texttransform = $menu_typo_values['text-transform'];

    $travelfic_menu_color_hover = get_theme_mod($travelfic_kit_pre . 'menu_hover_color', '#F15D30');

    $submenu_typo_values = get_theme_mod($travelfic_kit_pre . 'header_submenu_typo', array(
        'line-height' => '24',
        'font-size' => '16',
        'text-transform' => 'none',
    ));
    $travelfic_submenu_line_height = $submenu_typo_values['line-height'];
    $travelfic_submenu_font_size = $submenu_typo_values['font-size'];
    $travelfic_submenu_texttransform = $submenu_typo_values['text-transform'];

    $travelfic_submenu_bg = get_theme_mod($travelfic_kit_pre . 'submenu_bg', '#fff');
    $travelfic_submenu_text = get_theme_mod($travelfic_kit_pre . 'submenu_text_color', '#222');
    $travelfic_submenu_hover = get_theme_mod($travelfic_kit_pre . 'submenu_text_hover_color', '#F15D30');

    $travelfic_header_bg_color = get_theme_mod($travelfic_kit_pre . 'header_bg_color');
    $travelfic_header_btn_bg_color = get_theme_mod($travelfic_kit_pre . 'design_3_header_btn_bg_color');
    $travelfic_header_btn_hover_bg_color = get_theme_mod($travelfic_kit_pre . 'design_3_header_btn_hover_bg_color');

    $travelfic_sticky_bg_color = get_theme_mod($travelfic_kit_pre . 'stiky_header_bg_color', '#FDF9F3');
    $travelfic_sticky_bg_blur = get_theme_mod($travelfic_kit_pre . 'stiky_header_blur', '24');
    $travelfic_sticky_menu_color = get_theme_mod($travelfic_kit_pre . 'stiky_header_menu_text_color', '#595349');

    $travelfic_design1_topbar = get_theme_mod($travelfic_kit_pre . 'design_2_top_header_bg', '#595349');
    $travelfic_design1_topbar_color = get_theme_mod($travelfic_kit_pre . 'design_2_top_header_color', '#FDF9F3');

    $travelfic_design3_topbar = get_theme_mod($travelfic_kit_pre . 'design_3_top_header_bg', 'linear-gradient(0deg, #1342e0, #1342e0), linear-gradient(0deg, #0e3dd8, #0e3dd8)');
    $travelfic_design3_topbar_color = get_theme_mod($travelfic_kit_pre . 'design_3_top_header_text_color', '#FDF9F3');


    $travelfic_transparent_submenu_bg = get_theme_mod($travelfic_kit_pre . 'transparent_submenu_bg');
    $travelfic_transparent_submenu_text = get_theme_mod($travelfic_kit_pre . 'transparent_submenu_text_color');
    $travelfic_transparent_submenu_hover = get_theme_mod($travelfic_kit_pre . 'transparent_submenu_text_hover_color');
    $travelfic_transparent_menu_color = get_theme_mod($travelfic_kit_pre . 'transparent_menu_color');
    $travelfic_transparent_menu_hover_color = get_theme_mod($travelfic_kit_pre . 'transparent_menu_hover_color');

    // footer customizer style
    $travelfic_footer_back_image = get_theme_mod($travelfic_kit_pre . 'footer_3_bg_image');
    $travelfic_footer_back_overlay = get_theme_mod($travelfic_kit_pre . 'footer_3_bg_overlay_color');
    $travelfic_footer_bg_color = get_theme_mod($travelfic_kit_pre . 'footer_bg_color');
    $travelfic_footer_text_color = get_theme_mod($travelfic_kit_pre . 'footer_text_color');
    $travelfic_footer_btm_left_bg = get_theme_mod($travelfic_kit_pre . 'footer_bottom_left_bg_color');
    $travelfic_footer_btm_left_text = get_theme_mod($travelfic_kit_pre . 'footer_bottom_left_text_color');
    $travelfic_footer_btm_right_bg = get_theme_mod($travelfic_kit_pre . 'footer_bottom_right_bg_color');
    $travelfic_footer_btm_right_text = get_theme_mod($travelfic_kit_pre . 'footer_bottom_right_text_color');

    empty($travelfic_footer_back_image) ? $travelfic_footer_back_overlay = 'transparent' :  $travelfic_footer_bg_color = '';

?>

    <style>
        .tft-site-header .tft-site-navigation>ul>li a,
        .tft-design-2 .tft-menus-section .tft-site-navigation>ul>li a,
        .tft-design-3__bottom__nav--list .menu-item a {
            color: <?php echo !empty($travelfic_menu_color) ? esc_attr($travelfic_menu_color . ' !important') : esc_attr('#222'); ?>;
            font-size: <?php echo !empty($travelfic_menu_font_size) ? esc_attr($travelfic_menu_font_size . 'px !important') : esc_attr('16px !important'); ?>;
            line-height: <?php echo !empty($travelfic_menu_line_height) ? esc_attr($travelfic_menu_line_height . 'px !important') : esc_attr('24px !important'); ?>;
            text-transform: <?php echo !empty($travelfic_menu_texttransform) ? esc_attr($travelfic_menu_texttransform) : esc_attr('none'); ?>;
        }

        .tft-site-header .tft-site-navigation>ul>li:hover>a,
        .tft-design-2 .tft-menus-section .tft-site-navigation>ul>li:hover>a,
        .tft-design-3__bottom__nav>ul>li:hover>a {
            color: <?php echo !empty($travelfic_menu_color_hover) ? esc_attr($travelfic_menu_color_hover) : esc_attr('#F15D30 !important'); ?>;
        }

        .tft-site-header .tft-site-navigation ul.sub-menu,
        .tft-design-2 .tft-menus-section .tft-site-navigation ul.sub-menu,
        .tft-design-2 .tft-menus-section .tft-site-navigation ul.sub-menu li,
        .tft-design-3__bottom__nav--list .menu-item.menu-item-has-children .sub-menu {
            background: <?php echo !empty($travelfic_submenu_bg) ? esc_attr($travelfic_submenu_bg . ' !important') : esc_attr('#fff !important'); ?>;
        }

        .tft-site-header .tft-site-navigation ul.sub-menu li a,
        .tft-design-2 .tft-menus-section .tft-site-navigation ul.sub-menu li a,
        .tft-design-3__bottom__nav--list .menu-item.menu-item-has-children .sub-menu .menu-item a {
            color: <?php echo !empty($travelfic_submenu_text) ? esc_attr($travelfic_submenu_text . ' !important') : esc_attr('#222 !important'); ?>;
            font-size: <?php echo !empty($travelfic_submenu_font_size) ? esc_attr($travelfic_submenu_font_size . 'px !important') : esc_attr('16px !important'); ?>;
            line-height: <?php echo !empty($travelfic_submenu_line_height) ? esc_attr($travelfic_submenu_line_height . 'px !important') : esc_attr('24px !important'); ?>;
            text-transform: <?php echo !empty($travelfic_submenu_texttransform) ? esc_attr($travelfic_submenu_texttransform) : esc_attr('none'); ?>;
        }

        .tft-site-header .tft-site-navigation ul.sub-menu>li:hover>a,
        .tft-design-2 .tft-menus-section .tft-site-navigation ul.sub-menu>li:hover>a,
        .tft-design-3__bottom__nav--list .menu-item.menu-item-has-children .sub-menu .menu-item:hover a {
            color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr($travelfic_submenu_hover . ' !important') : esc_attr('#F15D30 !important'); ?>;
        }

        /* Transparent Header Start */
        header.tft-design-3 {
            background: <?php echo !empty($travelfic_header_bg_color) ? esc_attr($travelfic_header_bg_color) : ''; ?>;
        }

        header .tft-btn {
            background: <?php echo !empty($travelfic_header_btn_bg_color) ? esc_attr($travelfic_header_btn_bg_color) : ''; ?>;
        }

        header .tft-btn:hover {
            background: <?php echo !empty($travelfic_header_btn_hover_bg_color) ? esc_attr($travelfic_header_btn_hover_bg_color) : ''; ?>;
        }

        .tft-site-header.tft-theme-transparent-header,
        .tft-design-2 .tft-menus-section.tft_has_transparent {
            background: <?php echo !empty($travelfic_transparent_header_bg) ? esc_attr($travelfic_transparent_header_bg) : ''; ?>;
        }

        .tft-site-header.tft-theme-transparent-header .tft-site-navigation>ul>li a,
        .tft-design-2 .tft-menus-section.tft_has_transparent .tft-site-navigation>ul>li a {
            color: <?php echo !empty($travelfic_transparent_menu_color) ? esc_attr($travelfic_transparent_menu_color) : ''; ?>;
        }

        .tft-site-header.tft-theme-transparent-header .tft-site-navigation>ul>li:hover>a,
        .tft-design-2 .tft-menus-section.tft_has_transparent .tft-site-navigation>ul>li:hover>a {
            color: <?php echo !empty($travelfic_transparent_menu_hover_color) ? esc_attr($travelfic_transparent_menu_hover_color . ' !important') : ''; ?>;
        }

        .tft-site-header.tft-theme-transparent-header .tft-site-navigation ul.sub-menu,
        .tft-design-2 .tft-menus-section.tft_has_transparent .tft-site-navigation ul.sub-menu,
        .tft-design-2 .tft-menus-section.tft_has_transparent .tft-site-navigation ul.sub-menu li {
            background: <?php echo !empty($travelfic_transparent_submenu_bg) ? esc_attr($travelfic_transparent_submenu_bg . ' !important') : ''; ?>;
        }

        .tft-site-header.tft-theme-transparent-header .tft-site-navigation ul.sub-menu li a,
        .tft-design-2 .tft-menus-section.tft_has_transparent .tft-site-navigation ul.sub-menu li a {
            color: <?php echo !empty($travelfic_transparent_submenu_text) ? esc_attr($travelfic_transparent_submenu_text . ' !important') : ''; ?>;
        }

        .tft-site-header.tft-theme-transparent-header .tft-site-navigation ul.sub-menu>li:hover>a,
        .tft-design-2 .tft-menus-section.tft_has_transparent .tft-site-navigation ul.sub-menu>li:hover>a {
            color: <?php echo !empty($travelfic_transparent_submenu_hover) ? esc_attr($travelfic_transparent_submenu_hover . ' !important') : ''; ?>;
        }

        /* Transparent Header End */
        .tft_has_sticky.tft-navbar-shrink .tft-menus-section {
            background-color: <?php echo esc_attr($travelfic_sticky_bg_color . ' !important'); ?>;
            backdrop-filter: <?php echo 'blur(' . esc_attr($travelfic_sticky_bg_blur . 'px) !important'); ?>;
        }

        .tft_has_sticky.tft-navbar-shrink .tft-menus-section .tft-menu ul li a,
        .tft_has_sticky.tft-navbar-shrink .tft-menus-section .tft-logo a,
        .tft_has_sticky.tft-navbar-shrink .tft-menus-section .tft-account ul li a,
        .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft-header-mobile .tft-main-header-wrapper .tft-header-left .logo-text a,
        .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft-header-mobile .tft-main-header-wrapper .tft-header-center .tft-mobile_menubar i {
            color: <?php echo esc_attr($travelfic_sticky_menu_color . ' !important'); ?>;
        }

        .tft-design-2 .tft-top-header {
            background-color: <?php echo esc_attr($travelfic_design1_topbar); ?>;
        }

        .tft-design-2 .tft-top-header .tft-contact-info ul li a {
            color: <?php echo esc_attr($travelfic_design1_topbar_color) . ' !important'; ?>;
        }

        .tft-design-3__topbar,
        .tft-design-3__topbar::after {
            background: <?php echo esc_attr($travelfic_design3_topbar) . ' !important'; ?>;
        }


        .tft-design-3__topbar-list-link {
            color: <?php echo esc_attr($travelfic_design3_topbar_color) . ' !important'; ?>;
        }

        .tft-design-2 .tft-top-header .tft-contact-info ul li svg path,
        .tft-design-2 .tft-top-header .tft-social-share ul li svg path,
        .tft-design-2 .tft-top-header .tft-social-share ul li svg circle,
        .tft-design-2 .tft-top-header .tft-social-share ul li svg ellipse {
            fill: <?php echo esc_attr($travelfic_design1_topbar_color) . ' !important'; ?>;
            stroke: <?php echo esc_attr($travelfic_design1_topbar_color) . ' !important'; ?>;
        }


        /* Footer */
        footer.tft-footer-design-3 {
            background: <?php echo esc_attr($travelfic_footer_bg_color) . ' !important'; ?>;
        }

        footer.tft-footer-design-3::after {
            background: <?php echo esc_attr($travelfic_footer_back_overlay) . ' !important'; ?>;
        }

        footer.tft-footer-design-3 a,
        footer.tft-footer-design-3 p,
        footer.tft-footer-design-3 li,
        footer.tft-footer-design-3 span,
        footer.tft-footer-design-3 h1,
        footer.tft-footer-design-3 h2,
        footer.tft-footer-design-3 h3,
        footer.tft-footer-design-3 h4,
        footer.tft-footer-design-3 h5,
        footer.tft-footer-design-3 h6 {
            color: <?php echo esc_attr($travelfic_footer_text_color) . ' !important'; ?>;
        }

        .footer-bottom .footer-bottom__copyright,
        .footer-bottom__copyright::after {
            background: <?php echo esc_attr($travelfic_footer_btm_left_bg) . ' !important'; ?>;
        }

        .footer-bottom .footer-bottom__copyright p {
            color: <?php echo esc_attr($travelfic_footer_btm_left_text) . ' !important'; ?>;
        }

        .footer-bottom .footer-bottom__menu,
        .footer-bottom__menu::after {
            background: <?php echo esc_attr($travelfic_footer_btm_right_bg) . ' !important'; ?>;
        }

        .footer-bottom__nav a {
            color: <?php echo esc_attr($travelfic_footer_btm_right_text) . ' !important'; ?>;
        }
    </style>

    <?php
}
add_action('wp_head', 'travelfic_toolkit_customizer_style');


add_action('wp_footer', 'travelfic_toolkit_page_loader');

function travelfic_toolkit_page_loader()
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $page_loader = get_theme_mod($travelfic_prefix . 'page_loader', 0);
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
