<?php
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

// travelfic Customizer Options
function travelfic_kit_customizer_style()
{
$travelfic_kit_pre = 'travelfic_customizer_settings_';
$travelfic_menu_color = get_theme_mod($travelfic_kit_pre.'menu_color', '#222');
$travelfic_menu_font_size = get_theme_mod($travelfic_kit_pre.'menu_font_size', '18');
$travelfic_menu_color_hover = get_theme_mod($travelfic_kit_pre.'menu_hover_color', '#F15D30');
$travelfic_submenu_font_size = get_theme_mod($travelfic_kit_pre.'submenu_font_size', '18');
$travelfic_submenu_bg = get_theme_mod($travelfic_kit_pre.'submenu_bg', '#fff');
$travelfic_submenu_text = get_theme_mod($travelfic_kit_pre.'submenu_text_color', '#222');
$travelfic_submenu_hover = get_theme_mod($travelfic_kit_pre.'submenu_text_hover_color', '#F15D30');
?>

<style>
    .tft-site-header .tft-site-navigation > ul > li a {
        color: <?php echo !empty($travelfic_menu_color) ? esc_attr( $travelfic_menu_color ) : '#222'; ?>;
        font-size: <?php echo !empty($travelfic_menu_font_size) ? esc_attr( $travelfic_menu_font_size ).'px !important' : '18px !important'; ?>;
    }
    .tft-site-header .tft-site-navigation > ul > li:hover > a {
        color: <?php echo !empty($travelfic_menu_color_hover) ? esc_attr( $travelfic_menu_color_hover ). ' !important' : '#F15D30 !important'; ?>;
    }
    .tft-site-navigation ul.sub-menu{
        background: <?php echo !empty($travelfic_submenu_bg) ? esc_attr( $travelfic_submenu_bg ) : '#fff'; ?>;
    }
    .tft-site-navigation ul.sub-menu li a{
        color: <?php echo !empty($travelfic_submenu_text) ? esc_attr( $travelfic_submenu_text ).' !important' : '#222 !important'; ?>;
        font-size: <?php echo !empty($travelfic_submenu_font_size) ? esc_attr( $travelfic_submenu_font_size ).'px !important' : '18px !important'; ?>;
    }
    .tft-site-navigation ul.sub-menu > li:hover > a{
        color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr( $travelfic_submenu_hover ).' !important' : '#F15D30 !important'; ?>;
    }
</style>

<?php
}
add_action('wp_head', 'travelfic_kit_customizer_style');
