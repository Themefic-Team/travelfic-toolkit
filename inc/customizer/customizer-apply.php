<?php
// Travelfic Header 

add_filter('travelfic_header', 'travelfic_toolkit_header_callback', 11);
function travelfic_toolkit_header_callback($travelfic_header){
	$travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_check = get_theme_mod($travelfic_prefix.'header_design_select', 'design1');
    if($travelfic_header_check=="design1"){
        return $travelfic_header;
    }elseif($travelfic_header_check=="design2"){
        $header_design2 =  Travelfic_Customizer_Header::travelfic_toolkit_header_second_design($travelfic_header);
        return $header_design2;
    }
}


// Travelfic Footer

add_filter('travelfic_footer', 'travelfic_toolkit_footer_callback', 11);
function travelfic_toolkit_footer_callback($travelfic_footer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_check = get_theme_mod($travelfic_prefix.'footer_design_select', 'design1');
    if($travelfic_footer_check=="design1"){
        return $travelfic_footer;
    }elseif($travelfic_footer_check=="design2"){
        $footer_design2 =  Travelfic_Customizer_Footer::travelfic_toolkit_footer_second_design($travelfic_footer);
        return $footer_design2;
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

// Travelfic Header design 2 tft-container Controller

add_filter('travelfic_header_2_tftcontainer', 'travelfic_toolkit_header_2_tftcontainer_callback', 11);
function travelfic_toolkit_header_2_tftcontainer_callback($travelfic_tftcontainer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_header_width = get_theme_mod($travelfic_prefix.'header_width', 'default');

    if($travelfic_header_width=="default"){
        return $travelfic_tftcontainer;
    }else{
        return 'tft-fullwidth-container'; 
    }
}

// Travelfic Footer design 2 tft-container Controller

add_filter('travelfic_footer_2_tftcontainer', 'travelfic_toolkit_footer_2_tftcontainer_callback', 11);
function travelfic_toolkit_footer_2_tftcontainer_callback($travelfic_tftcontainer){
    $travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_footer_width = get_theme_mod($travelfic_prefix.'footer_width', 'default');

    if($travelfic_footer_width=="default"){
        return $travelfic_tftcontainer;
    }else{
        return 'tft-fullwidth-container'; 
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

$travelfic_sticky_bg_color = get_theme_mod($travelfic_kit_pre.'stiky_header_bg_color', '#FDF9F3');
$travelfic_sticky_bg_blur = get_theme_mod($travelfic_kit_pre.'stiky_header_blur', '24');
$travelfic_sticky_menu_color = get_theme_mod($travelfic_kit_pre.'stiky_header_menu_text_color', '#595349');

$travelfic_design1_topbar = get_theme_mod($travelfic_kit_pre.'design_2_top_header_bg', '#595349');

?>

<style>
    .tft-site-header .tft-site-navigation > ul > li a {
        color: <?php echo !empty($travelfic_menu_color) ? esc_attr( $travelfic_menu_color ) : '#222'; ?>;
        font-size: <?php echo !empty($travelfic_menu_font_size) ? esc_attr( $travelfic_menu_font_size ).'px !important' : '18px !important'; ?>;
        line-height: <?php echo !empty($travelfic_menu_line_height) ? esc_attr( $travelfic_menu_line_height ).'px !important' : '24px !important'; ?>;
        text-transform: <?php echo !empty($travelfic_menu_texttransform) ? esc_attr( $travelfic_menu_texttransform ) : 'none'; ?>;
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
        line-height: <?php echo !empty($travelfic_submenu_line_height) ? esc_attr( $travelfic_submenu_line_height ).'px !important' : '24px !important'; ?>;
        text-transform: <?php echo !empty($travelfic_submenu_texttransform) ? esc_attr( $travelfic_submenu_texttransform ) : 'none'; ?>;
    }
    .tft-site-navigation ul.sub-menu > li:hover > a{
        color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr( $travelfic_submenu_hover ).' !important' : '#F15D30 !important'; ?>;
    }
    .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft_has_transparent{
        background-color: <?php echo esc_attr( $travelfic_sticky_bg_color ); ?>;
        backdrop-filter: blur(<?php echo esc_attr( $travelfic_sticky_bg_blur ); ?>);
    }
    .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft_has_transparent .tft-menu ul li a,
    .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft_has_transparent .tft-logo a,
    .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft_has_transparent .tft-account ul li a,
    .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft-header-mobile .tft-main-header-wrapper .tft-header-left .logo-text a,
    .tft_has_sticky.tft-navbar-shrink .tft-menus-section.tft-header-mobile .tft-main-header-wrapper .tft-header-center .tft-mobile_menubar i{
        color: <?php echo esc_attr( $travelfic_sticky_menu_color ); ?>;
    }

    .tft-design-2 .tft-top-header{
        background-color: <?php echo esc_attr( $travelfic_design1_topbar ); ?>;
    }
</style>

<?php
}
add_action('wp_head', 'travelfic_toolkit_customizer_style');
