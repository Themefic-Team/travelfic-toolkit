<?php
// Travelfic Header 

add_filter('travelfic_header', 'travelfic_toolkit_header_callback', 11);
function travelfic_toolkit_header_callback($travelfic_header){
	$travelfic_prefix = 'travelfic_customizer_settings_';
    $travelfic_transparentHeader = get_theme_mod($travelfic_prefix.'transparent_header', 'disabled');
    if(is_archive()  || is_single() || is_404() || is_search()){
        $travelfic_transparentHeader = 'disabled';
    }

    $travelfic_banner = get_theme_mod($travelfic_prefix . 'page_banner', 'banner');
    $travelfic_disable_banner = get_post_meta( get_the_ID(), 'tft-pmb-banner', true );
    $travelfic_stiky = get_theme_mod($travelfic_prefix.'stiky_header', 'disabled');
    if( isset( $travelfic_stiky ) ){
        if( $travelfic_stiky != 'disabled' ){
            $travelfic_stiky_class = 'has_stiky';
        }else{        
            $travelfic_stiky_class = '';
        }
    }

    if (is_page()) {  
        $disable_single_page = get_post_meta( get_the_ID(), 'tft-pmb-transfar-header', true );
        if(!empty($disable_single_page)){
            $travelfic_transparentHeader = 'disabled';
        }
    }
    if (is_page('tf-search')) {  
        $travelfic_transparentHeader = 'disabled';
    }
	ob_start();
	?>
	<header class="tft-site-header tft-customizer-typography <?php echo !empty($travelfic_transparentHeader) && $travelfic_transparentHeader == 'enabled' ? 'tft-theme-transparent-header' : ''; ?>">
    <div class="tft-header-inner <?php echo esc_attr( $travelfic_stiky_class ); ?>">
        <div class="tft-header-desktop">
            <div class="tft-main-header-wrapper tft-container tft-container-grid align-center justify-sp-between">

                <!-- Site Branding/Logo -->
                <div class="tft-header-left site-header-section justify-content-start">
                    <div class="site--brand-logo">
                        <?php
                        if (has_custom_logo()) {
                            if (function_exists('the_custom_logo')) {
                                the_custom_logo();
                            }
                        } else {
                        ?>
                        <div class="logo-text">
                            <a href="<?php echo esc_url(home_url('/')) ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Site Navigation Menu -->
                <div class="tft-header-center site-header-section justify-content-center">
                    <nav class="tft-site-navigation">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary_menu',
                                'menu_id'        => 'navigation',
                                'container'      => 'ul',
                                'menu_class'     => 'main--header-menu tft-flex'
                            ));
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tft-header-mobile">
            <div class="tft-main-header-wrapper tft-container tft-container-flex align-center justify-sp-between">
                <!-- Site Branding/Logo -->
                <div class="tft-header-left site-header-section">
                    <div class="site--brand-logo">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else { ?>
                        <div class="logo-text">
                            <a href="<?php echo esc_url(home_url('/')) ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                        </div>
                        <?php  } ?>
                    </div>
                </div>
                <!-- Site Search Bar -->
                <div class="tft-header-center site-header-section">
                    <a href="#" class="tft-mobile_menubar">
                        <div class="tft-menubar-active">
                            <i class="fas fa-bars"></i>
                        </div>
                        <div class="tft-menubar-close">
                            <i class="fas fa-times"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="tft-container site-header-section tft-mobile-main-menu">
                <nav class="tft-site-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary_menu',
                        'menu_id'        => 'navigation',
                        'container' => 'ul',
                        'menu_class' => 'main--header-menu tft-flex',
                        'walker' => new Travelfic_Custom_Nav_Walker(),
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </div>
    <?php
    if( isset( $travelfic_stiky ) ){
        if( $travelfic_stiky != 'disabled' ){
           ?>
           <div class="tft-stiky-header-cover"></div>
           <?php 
        }
    }
    ?>
</header>
<?php
$travelfic_header_data = ob_get_clean();
return $travelfic_header_data;
}


// Travelfic Footer

add_filter('travelfic_footer', 'travelfic_toolkit_footer_callback', 11);
function travelfic_toolkit_footer_callback($travelfic_footer){
	ob_start();
?>
	<footer class="tft-site-footer tft-customizer-typography">
        <div class="tft-container">
            <?php if ( is_active_sidebar( 'footer_sideabr' ) ) { ?>
                <div class="tft-footer-inner tft-container-grid tft-grid-clmn-4">
                    <?php dynamic_sidebar( 'footer_sideabr' ); ?>
                </div>
            <?php } ?>
            
            <div class="tft-footer-copyright">
                <div class="tft-copyrgith-inner">
                    <p class="tft-center">
                    <?php
                        $current_year = date('Y');
                        printf( esc_html__('© Copyright %1$s %2$s by %3$s All Rights Reserved.', 'travelfic'), esc_html($current_year), esc_html( get_bloginfo('name') ), '<a target="_blank" href="'.esc_url("https://themefic.com/").'">Themefic</a>');
                    ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
<?php
	$travelfic_footer_data = ob_get_clean();
	return $travelfic_footer_data;
} 

// travelfic Customizer Options
function travelfic_kit_customizer_style()
{
$travelfic_kit_pre = 'travelfic_customizer_settings_';
$travelfic_menu_color = get_theme_mod($travelfic_kit_pre.'menu_color', '#222');
$travelfic_menu_color_hover = get_theme_mod($travelfic_kit_pre.'menu_hover_color', '#F15D30');
$travelfic_submenu_bg = get_theme_mod($travelfic_kit_pre.'submenu_bg', '#fff');
$travelfic_submenu_text = get_theme_mod($travelfic_kit_pre.'submenu_text_color', '#222');
$travelfic_submenu_hover = get_theme_mod($travelfic_kit_pre.'submenu_text_hover_color', '#F15D30');
?>

<style>
    .tft-site-header .tft-site-navigation > ul > li a {
        color: <?php echo !empty($travelfic_menu_color) ? esc_attr( $travelfic_menu_color ) : '#222'; ?>;
    }
    .tft-site-header .tft-site-navigation > ul > li:hover > a {
        color: <?php echo !empty($travelfic_menu_color_hover) ? esc_attr( $travelfic_menu_color_hover ). ' !important' : '#F15D30 !important'; ?>;
    }
    .tft-site-navigation ul.sub-menu{
        background: <?php echo !empty($travelfic_submenu_bg) ? esc_attr( $travelfic_submenu_bg ) : '#fff'; ?>;
    }
    .tft-site-navigation ul.sub-menu li a{
        color: <?php echo !empty($travelfic_submenu_text) ? esc_attr( $travelfic_submenu_text ).' !important' : '#222 !important'; ?>;
    }
    .tft-site-navigation ul.sub-menu > li:hover > a{
        color: <?php echo !empty($travelfic_submenu_hover) ? esc_attr( $travelfic_submenu_hover ).' !important' : '#F15D30 !important'; ?>;
    }
</style>

<?php
}
add_action('wp_head', 'travelfic_kit_customizer_style');
