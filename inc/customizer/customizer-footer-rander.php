<?php

class Travelfic_Customizer_Footer
{

    public static function travelfic_toolkit_footer_second_design($travelfic_footer)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        $design_2_copyright = get_theme_mod($travelfic_prefix . 'copyright_text', '© Copyright 2023 Tourfic Development Site by Themefic All Rights Reserved.');
        ob_start();
?>
        <footer class="tft-design-2">
            <div class="tft-footer-sections tft-w-padding <?php echo esc_attr(apply_filters('travelfic_footer_2_tftcontainer', $travelfic_tftcontainer = '')); ?>">
                <div class="tft-grid">
                    <?php dynamic_sidebar('footer_sideabr'); ?>
                </div>
                <div class="tft-footer-copyright">
                    <p>
                        <?php echo esc_html($design_2_copyright); ?>
                    </p>
                </div>
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
        
        $travelfic_copyright = get_theme_mod($travelfic_prefix . 'copyright_text', '© Copyright 2024 Tourfic Development Site by Themefic All Rights Reserved.');
        $travelfic_menu_1_label = get_theme_mod($travelfic_prefix . 'footer_menu_label_1', 'Privacy Policy');
        $travelfic_menu_1_url = get_theme_mod($travelfic_prefix . 'footer_menu_url_2', '#');
        $travelfic_menu_2_label = get_theme_mod($travelfic_prefix . 'footer_menu_label_2', 'View on Maps');
        $travelfic_menu_2_url = get_theme_mod($travelfic_prefix . 'footer_menu_url_2', '#');
        ob_start();
    ?>
        <!-- footer -->
        <footer class="footer tft-footer-design-3" style="background-image: url(<?php echo esc_url($travelfic_footer_back_image); ?>);">
            <div class="container <?php echo esc_attr(apply_filters('travelfic_footer_2_tftcontainer', $travelfic_tftcontainer = '')); ?>">
                <div class="footer__widget">
                    <div class="footer__widget__row">
                        <?php if (is_active_sidebar('footer_sideabr  ')) : ?>
                            <?php dynamic_sidebar('footer_sideabr  '); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>

        <!-- footer bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom__inner">
                    <div class="footer-bottom__copyright">
                        <p><?php echo esc_html($travelfic_copyright); ?></p>
                    </div>
                    <div class="footer-bottom__menu">
                        <ul class="footer-bottom__nav">
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
