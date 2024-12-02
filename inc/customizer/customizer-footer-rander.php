<?php

class Travelfic_Customizer_Footer
{

    public static function travelfic_toolkit_footer_second_design($travelfic_footer)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        $design_2_copyright = get_theme_mod($travelfic_prefix.'copyright_text', '© Copyright 2023 Tourfic Development Site by Themefic All Rights Reserved.');
        ob_start();
    ?>
        <footer class="tft-design-2">
            <div class="tft-footer-sections tft-w-padding <?php echo esc_attr( apply_filters( 'travelfic_footer_2_tftcontainer', $travelfic_tftcontainer = '') ); ?>">
                <div class="tft-grid">
                <?php dynamic_sidebar( 'footer_sideabr' ); ?>
                </div>
                <div class="tft-footer-copyright">
                    <p>
                    <?php echo esc_html( $design_2_copyright ); ?>
                    </p>
                </div>
            </div>
        </footer>
    <?php
    $travelfic_footer = ob_get_clean();
    return $travelfic_footer;
    }
}