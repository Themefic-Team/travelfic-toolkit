<?php
// Travelfic Header 

add_filter('travelfic_header', 'travelfic_toolkit_header_callback', 11);
function travelfic_toolkit_header_callback($travelfic_header)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_check = get_theme_mod($travelfic_prefix . 'header_design_select', 'design1');
    if ($travelfic_header_check == "design2") {
        $header_design2 =  travelfic_design2_render_header($travelfic_header);
        return $header_design2;
    } else {
        return $travelfic_header;
    }
}


function travelfic_design2_render_header($travelfic_header)
{
    ob_start();
?>
    <header>
        <div class="tft-site-logo-container">
            <div class="tft-site-img-logo">
                <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/design2-logo.svg') ?>" alt="logo">
            </div>
        </div>
        <div class="tft-site-menu-container">
            <!-- top bar -->
            <div class="tft-site-top-bar">
                <div class="tft-site-top-bar-left">
                    <div class="tft-site-top-bar-left-item">
                        <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/map.svg') ?>" alt="location">
                        <span>Address</span>
                    </div>

                    <div class="tft-site-top-bar-left-item">
                        <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/email.svg') ?>" alt="mail">
                        <span>
                            <a href="mailto:

                        ">
                                info@example.com
                            </a>
                        </span>
                    </div>
                    <div class="tft-site-top-bar-left-item">
                        <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/phone.svg') ?>" alt="phone">
                        <span>
                            <a href="tel:(245) 2156 21453">
                                (245) 2156 21453
                            </a>
                        </span>

                    </div>

                </div>

                <div class="tft-site-top-bar-right">
                    <div class="tft-site-languages">
                        <select name="language" id="language">
                            <option value="en">English</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="it">Italian</option>
                        </select>
                    </div>

                    <div class="tft-site-login">
                        <a href="#">Login Now</a>
                    </div>

                </div>




            </div>
            <!-- menu -->
            <div class="tft-site-menu">
                <ul>
                    <?php

                    wp_nav_menu(array(
                        'theme_location' => 'primary_menu',
                        'container' => 'ul',
                        'items_wrap' => '%3$s',
                        'fallback_cb' => false,
                    ));

                    ?>
                </ul>

                <!-- menu buttons -->

                <div class="tft-site-menu-buttons">
                    <div class="tft-site-menu-buttons-item">
                        <a href="#" class="tft-menu-cart">
                            <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/cart.svg') ?>" alt="cart">
                        </a>
                    </div>
                    <div class="tft-site-menu-buttons-item">
                        <a href="#" class="tft-menu-search">
                            <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/search.svg') ?>" alt=" search">
                        </a>
                    </div>
                    <div class="tft-site-menu-discover">
                        <a class="tfc-site-menu-discover-btn" href="#">Discover More</a>
                    </div>
                    <div class="tft-site-menu-buttons-item">
                        <a href="#" class="tft-menu-bars">
                            <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/bar.svg') ?>" alt="bars">
                        </a>
                    </div>

                </div>
    </header>

<?php
    $travelfic_header = ob_get_clean();
    return $travelfic_header;
}
// Travelfic Footer

add_filter('travelfic_footer', 'travelfic_toolkit_footer_callback', 11);
function travelfic_toolkit_footer_callback($travelfic_footer)
{
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_check = get_theme_mod($travelfic_prefix . 'footer_design_select', 'design1');
    if ($travelfic_footer_check == "design1") {
        return $travelfic_footer;
    }
}

// Travelfic Header tft-container Controller

add_filter('travelfic_header_tftcontainer', 'travelfic_toolkit_header_tftcontainer_callback', 11);
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

// travelfic Customizer Options
function travelfic_toolkit_customizer_style()
{
    $travelfic_kit_pre = 'travelfic_customizer_settings_';
    $travelfic_menu_color = get_theme_mod($travelfic_kit_pre . 'menu_color', '#222');

    $menu_typo_values = get_theme_mod($travelfic_kit_pre . 'header_menu_typo', array(
        'line-height' => '24',
        'font-size' => '18',
        'text-transform' => 'none',
    ));
    $travelfic_menu_line_height = $menu_typo_values['line-height'];
    $travelfic_menu_font_size = $menu_typo_values['font-size'];
    $travelfic_menu_texttransform = $menu_typo_values['text-transform'];

    $travelfic_menu_color_hover = get_theme_mod($travelfic_kit_pre . 'menu_hover_color', '#F15D30');

    $submenu_typo_values = get_theme_mod($travelfic_kit_pre . 'header_submenu_typo', array(
        'line-height' => '24',
        'font-size' => '18',
        'text-transform' => 'none',
    ));
    $travelfic_submenu_line_height = $submenu_typo_values['line-height'];
    $travelfic_submenu_font_size = $submenu_typo_values['font-size'];
    $travelfic_submenu_texttransform = $submenu_typo_values['text-transform'];

    $travelfic_submenu_bg = get_theme_mod($travelfic_kit_pre . 'submenu_bg', '#fff');
    $travelfic_submenu_text = get_theme_mod($travelfic_kit_pre . 'submenu_text_color', '#222');
    $travelfic_submenu_hover = get_theme_mod($travelfic_kit_pre . 'submenu_text_hover_color', '#F15D30');
?>

    <style>
        .tft-site-header .tft-site-navigation>ul>li a {
            color: <?php echo !empty($travelfic_menu_color) ? esc_attr($travelfic_menu_color) : '#222'; ?>;
            font-size: <?php echo !empty($travelfic_menu_font_size) ? esc_attr($travelfic_menu_font_size) . 'px !important' : '18px !important'; ?>;
            line-height: <?php echo !empty($travelfic_menu_line_height) ? esc_attr($travelfic_menu_line_height) . 'px !important' : '24px !important'; ?>;
            text-transform: <?php echo !empty($travelfic_menu_texttransform) ? esc_attr($travelfic_menu_texttransform) : 'none'; ?>;
        }

        .tft-site-header .tft-site-navigation>ul>li:hover>a {
            color: <?php echo !empty($travelfic_menu_color_hover) ? esc_attr($travelfic_menu_color_hover) . ' !important' : '#F15D30 !important'; ?>;
        }

        .tft-site-navigation ul.sub-menu {
            background: <?php echo !empty($travelfic_submenu_bg) ? esc_attr($travelfic_submenu_bg) : '#fff'; ?>;
        }

        .tft-site-navigation ul.sub-menu li a {
            color: <?php echo !empty($travelfic_submenu_text) ? esc_attr($travelfic_submenu_text) . ' !important' : '#222 !important'; ?>;
            font-size: <?php echo !empty($travelfic_submenu_font_size) ? esc_attr($travelfic_submenu_font_size) . 'px !important' : '18px !important'; ?>;
            line-height: <?php echo !empty($travelfic_submenu_line_height) ? esc_attr($travelfic_submenu_line_height) . 'px !important' : '24px !important'; ?>;
            text-transform: <?php echo !empty($travelfic_submenu_texttransform) ? esc_attr($travelfic_submenu_texttransform) : 'none'; ?>;
        }

        .tft-site-navigation ul.sub-menu>li:hover>a {
            color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr($travelfic_submenu_hover) . ' !important' : '#F15D30 !important'; ?>;
        }
    </style>

<?php
}
add_action('wp_head', 'travelfic_toolkit_customizer_style');
