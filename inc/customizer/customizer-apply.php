<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

// Travelfic Header 

add_filter('travelfic_header', 'travelfic_toolkit_header_callback', 11);
function travelfic_toolkit_header_callback($travelfic_header){
	$travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_check = get_theme_mod($travelfic_prefix.'header_design_select', 'design1');
    if($travelfic_header_check=="design1"){
        return $travelfic_header;
    }
}


// Travelfic Footer

add_filter('travelfic_footer', 'travelfic_toolkit_footer_callback', 11);
function travelfic_toolkit_footer_callback($travelfic_footer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_check = get_theme_mod($travelfic_prefix.'footer_design_select', 'design1');
    if($travelfic_footer_check=="design1"){
        return $travelfic_footer;
    }
}

// Travelfic Header tft-container Controller

add_filter('travelfic_header_tftcontainer', 'travelfic_toolkit_header_tftcontainer_callback', 11);
function travelfic_toolkit_header_tftcontainer_callback($travelfic_tftcontainer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_width = get_theme_mod($travelfic_prefix.'header_width', 'default');

    if($travelfic_header_width=="default"){
        return $travelfic_tftcontainer;
    }else{
        return 'travelfic-kit-container'; 
    }
}

// Travelfic Footer tft-container Controller

add_filter('travelfic_footer_tftcontainer', 'travelfic_toolkit_footer_tftcontainer_callback', 11);
function travelfic_toolkit_footer_tftcontainer_callback($travelfic_tftcontainer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_width = get_theme_mod($travelfic_prefix.'footer_width', 'default');

    if($travelfic_footer_width=="default"){
        return $travelfic_tftcontainer;
    }else{
        return 'travelfic-kit-container'; 
    }
}


// Travelfic Page tft-container Controller

add_filter('travelfic_page_tftcontainer', 'travelfic_toolkit_page_tftcontainer_callback', 11);
function travelfic_toolkit_page_tftcontainer_callback($travelfic_tftcontainer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_page_width = get_theme_mod($travelfic_prefix.'page_width', 'default');

    if($travelfic_page_width=="default"){
        return $travelfic_tftcontainer;
    }else{
        return 'travelfic-kit-container'; 
    }
}

// travelfic Customizer Options
function travelfic_toolkit_customizer_style()
{
$travelfic_kit_pre = 'travelfic_customizer_settings_';
$travelfic_menu_color = get_theme_mod($travelfic_kit_pre.'menu_color', '#222');

$menu_typo_values = get_theme_mod($travelfic_kit_pre . 'header_menu_typo', array(
    'line-height' => '24',
    'font-size' => '18',
    'text-transform' => 'none',
));
$travelfic_menu_line_height = $menu_typo_values['line-height'];
$travelfic_menu_font_size = $menu_typo_values['font-size'];
$travelfic_menu_texttransform = $menu_typo_values['text-transform'];

$travelfic_menu_color_hover = get_theme_mod($travelfic_kit_pre.'menu_hover_color', '#F15D30');

$submenu_typo_values = get_theme_mod($travelfic_kit_pre . 'header_submenu_typo', array(
    'line-height' => '24',
    'font-size' => '18',
    'text-transform' => 'none',
));
$travelfic_submenu_line_height = $submenu_typo_values['line-height'];
$travelfic_submenu_font_size = $submenu_typo_values['font-size'];
$travelfic_submenu_texttransform = $submenu_typo_values['text-transform'];

$travelfic_submenu_bg = get_theme_mod($travelfic_kit_pre.'submenu_bg', '#fff');
$travelfic_submenu_text = get_theme_mod($travelfic_kit_pre.'submenu_text_color', '#222');
$travelfic_submenu_hover = get_theme_mod($travelfic_kit_pre.'submenu_text_hover_color', '#F15D30');
?>

<style>
    .tft-site-header .tft-site-navigation > ul > li a {
        color: <?php echo !empty($travelfic_menu_color) ? esc_attr( $travelfic_menu_color ) : esc_attr('#222'); ?>;
        font-size: <?php echo !empty($travelfic_menu_font_size) ? esc_attr( $travelfic_menu_font_size.'px !important' ) : esc_attr('18px !important'); ?>;
        line-height: <?php echo !empty($travelfic_menu_line_height) ? esc_attr( $travelfic_menu_line_height.'px !important' ) : esc_attr('24px !important'); ?>;
        text-transform: <?php echo !empty($travelfic_menu_texttransform) ? esc_attr( $travelfic_menu_texttransform ) : esc_attr('none'); ?>;
    }
    .tft-site-header .tft-site-navigation > ul > li:hover > a {
        color: <?php echo !empty($travelfic_menu_color_hover) ? esc_attr( $travelfic_menu_color_hover. ' !important' ) : esc_attr('#F15D30 !important'); ?>;
    }
    .tft-site-navigation ul.sub-menu{
        background: <?php echo !empty($travelfic_submenu_bg) ? esc_attr( $travelfic_submenu_bg ) : esc_attr('#fff'); ?>;
    }
    .tft-site-navigation ul.sub-menu li a{
        color: <?php echo !empty($travelfic_submenu_text) ? esc_attr( $travelfic_submenu_text.' !important' ) : esc_attr('#222 !important'); ?>;
        font-size: <?php echo !empty($travelfic_submenu_font_size) ? esc_attr( $travelfic_submenu_font_size.'px !important' ) : esc_attr('18px !important'); ?>;
        line-height: <?php echo !empty($travelfic_submenu_line_height) ? esc_attr( $travelfic_submenu_line_height.'px !important' ) : esc_attr('24px !important'); ?>;
        text-transform: <?php echo !empty($travelfic_submenu_texttransform) ? esc_attr( $travelfic_submenu_texttransform ) : esc_attr('none'); ?>;
    }
    .tft-site-navigation ul.sub-menu > li:hover > a{
        color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr( $travelfic_submenu_hover.' !important' ) : esc_attr('#F15D30 !important'); ?>;
    }
</style>

<?php
}
add_action('wp_head', 'travelfic_toolkit_customizer_style');
