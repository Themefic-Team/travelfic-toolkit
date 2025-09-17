<?php

class Travelfic_Customizer_Footer
{

    public static function travelfic_toolkit_footer_second_design($travelfic_footer)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        $design_2_copyright = get_theme_mod($travelfic_prefix . 'copyright_text', '© Copyright [year] Tourfic Development Site by Themefic All Rights Reserved.');
        ob_start();
?>
        <footer class="tft-footer-design__two tft-site-footer">
            <div class="<?php echo esc_attr( apply_filters( 'travelfic_page_tftcontainer', $travelfic_tftcontainer = '') ); ?>">
                <div class="tft-footer-widgets">
                    <div class="tft-grid">
                        <?php if (is_active_sidebar('footer_widgets')) : ?>
                            <?php dynamic_sidebar('footer_widgets'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tft-footer-bottom__two tft-footer-bottom">
                    <p><?php echo do_shortcode(esc_html($design_2_copyright)); ?></p>
                </div>
                <div class="tft-footer-shape"></div>
            </div>
        </footer>
    <?php
        $travelfic_footer = ob_get_clean();
        return $travelfic_footer;
    }

    public static function travelfic_toolkit_footer_third_design($travelfic_footer)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        $travelfic_footer_back_image = !empty(get_theme_mod($travelfic_prefix . 'footer_3_bg_image')) ? get_theme_mod($travelfic_prefix . 'footer_3_bg_image') : '';
        
        $travelfic_copyright = get_theme_mod($travelfic_prefix . 'copyright_text', '© Copyright [year] Tourfic Development Site by Themefic All Rights Reserved.');
        $travelfic_menu_1_label = get_theme_mod($travelfic_prefix . 'footer_menu_label_1', 'Privacy Policy');
        $travelfic_menu_1_url = get_theme_mod($travelfic_prefix . 'footer_menu_url_2', '#');
        $travelfic_menu_2_label = get_theme_mod($travelfic_prefix . 'footer_menu_label_2', 'View on Maps');
        $travelfic_menu_2_url = get_theme_mod($travelfic_prefix . 'footer_menu_url_2', '#');

        ob_start();
    ?>
        <!-- footer -->
        <footer class="tft-footer-design__three tft-site-footer" style="background-image: url(<?php echo esc_url($travelfic_footer_back_image); ?>);">
            <div class="<?php echo esc_attr( apply_filters( 'travelfic_page_tftcontainer', $travelfic_tftcontainer = '') ); ?>">
                <div class="footer-widget">
                    <div class="footer-widget-inner">
                        <?php if (is_active_sidebar('footer_widgets')) : ?>
                            <?php dynamic_sidebar('footer_widgets'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>

        <!-- footer bottom -->
        <div class="tft-footer-bottom__three tft-footer-bottom">
            <div class="<?php echo esc_attr( apply_filters( 'travelfic_page_tftcontainer', $travelfic_tftcontainer = '') ); ?>">
                <div class="tft-footer-bottom__three__inner">
                    <div class="tft-footer-bottom__three__copyright">
                        <p class="tft-color-white"><?php echo do_shortcode(esc_html($travelfic_copyright)); ?></p>
                    </div>
                    <div class="tft-footer-bottom__three__menu">
                        <ul class="tft-footer-bottom__three__nav">
                            <?php if (!empty($travelfic_menu_1_label)): ?>
                                <li>
                                    <a href="<?php echo esc_url($travelfic_menu_1_url); ?>">
                                        <?php echo esc_html($travelfic_menu_1_label); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($travelfic_menu_2_label)): ?>
                                <li>
                                    <a href="<?php echo esc_url($travelfic_menu_2_url); ?>">
                                        <?php echo esc_html($travelfic_menu_2_label); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php
        $travelfic_footer = ob_get_clean();
        return $travelfic_footer;
    }
}
