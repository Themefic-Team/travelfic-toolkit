<?php
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


function travelfic_toolkit_customize_register($wp_customize) {
    $travelfic_toolkit_prefix = "travelfic_customizer_settings_";

    class JH_Image_Select_Control extends WP_Customize_Control {
        public $type = 'image_select';
    
        public function render_content() {
            $image_options = $this->choices;
            $value = $this->value();
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <ul class="image-select-container">
                <?php foreach ( $image_options as $key => $image_url ) : ?>
                    <li>
                    <label>
                        <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $value, $key ); ?>/>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $key ); ?>"/>
                    </label>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php
        }
    }

    // Add a setting for the image selection
    $wp_customize->add_setting($travelfic_toolkit_prefix . 'header_design_select', array(
        'default'           => 'design2',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for the image selection
    $wp_customize->add_control(new JH_Image_Select_Control($wp_customize, $travelfic_toolkit_prefix . 'header_design_select', array(
        'label'    => __('Header Design Option', 'your-textdomain'),
        'section'  => 'travelfic_customizer_header', // Specify the existing section ID or create a new section
        'choices'  => array(
            'design1' => TRAVELFIC_URL.'assets/img/header-1.png',
            'design2' => TRAVELFIC_URL.'assets/img/header-1.png',
        ),
    )));
}

add_action("customize_register", "travelfic_toolkit_customize_register");

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