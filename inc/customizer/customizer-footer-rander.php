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
        $design_2_copyright = get_theme_mod($travelfic_prefix . 'copyright_text', '© Copyright 2024 Tourfic Development Site by Themefic All Rights Reserved.');
        ob_start();
    ?>
        <!-- footer -->
        <footer class="footer" style="background-image: url();">
            <div class="container">
                <?php if (is_active_sidebar('footer_sideabr  ')) : ?>
                    <?php dynamic_sidebar('footer_sideabr  '); ?>
                <?php endif; ?>
            </div>
        </footer>

        <!-- footer bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom__inner">
                    <div class="footer-bottom__copyright">
                        <p><?php echo esc_html($design_2_copyright); ?></p>
                    </div>
                    <div class="footer-bottom__menu">
                        <ul class="footer-bottom__nav">
                            <li>
                                <a href="#">
                                    <?php echo __('Privacy Policy', 'travelfic-toolkit') ?>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <?php echo __('View on Maps', 'travelfic-toolkit') ?>
                                </a>
                            </li>
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
