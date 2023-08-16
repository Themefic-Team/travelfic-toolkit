<?php

class Travelfic_Customizer_render
{

    public static function travelfic_toolkit_header_second_design($travelfic_header)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
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
                            <span id="tft-site-address">
                                <?php
                                echo get_theme_mod($travelfic_prefix . 'site_address', '
                                    Address');
                                ?>
                            </span>
                        </div>

                        <div class="tft-site-top-bar-left-item">
                            <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/email.svg') ?>" alt="mail">
                            <span>
                                <a href="mailto:info@example.com " id="tft-site-email">
                                    <?php
                                    echo get_theme_mod($travelfic_prefix . 'site_email', '
                                        info@example.com');
                                    ?>
                                </a>
                            </span>
                        </div>
                        <div class="tft-site-top-bar-left-item">
                            <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/phone.svg') ?>" alt="phone">
                            <span>
                                <a href="tel:(245) 2156 21453" id="tft-site-phone">
                                    <?php
                                    echo get_theme_mod($travelfic_prefix . 'site_phone', '(245) 2156 21453');
                                    ?>
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

    public static function travelfic_toolkit_footer_second_design($travelfic_footer)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        ob_start();
    ?>
        <footer>
            <div class="tft-site-footer-top">
                <div class="tft-site-container">
                    <div class="tft-site-footer-wrapper">
                        <div class="tft-site-footer-item">
                            <div class="tft-footer-site-info">
                                <div class=" tft-footer-logo">
                                    <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/design2-logo.svg') ?>" alt="logo">
                                </div>
                                <div class="tft-footer-contact-info">
                                    <a href="tel:(245) 2156 21453">
                                        (245) 2156 21453
                                    </a>
                                    <a href="mailto:info@example.com">
                                        info@example.com
                                    </a>
                                </div>
                                <div class="tft-footer-location">
                                    <h3>Our Office Location:</h3>
                                    <p>512 Hilton Street, EDT Corss</p>
                                    <p>
                                        Boston. United State</p>

                                </div>
                            </div>
                        </div>

                        <!-- 
                            TODO: Will be implemented later

                            - add social media links
                            - add footer menu
                            - add footer widgets
                            
                         -->
                        <div class="tft-site-footer-item">

                            <div class="tft-site-footer-item-title">
                                <h3>Services</h3>
                            </div>
                            <div class="tft-site-footer-item-content">
                                <ul>
                                    <li><a href="#">Web design</a></li>
                                    <li><a href="#">Development</a></li>
                                    <li><a href="#">Hosting</a></li>
                                    <li><a href="#">Search engine optimization</a></li>
                                    <li><a href="#">Social media marketing</a></li>
                                    <li><a href="#">Graphic design</a></li>
                                </ul>
                            </div>

                        </div>

                        <div class="tft-site-footer-item">
                            <div class="tft-site-footer-item-title">
                                <h3>Support</h3>
                            </div>
                            <div class="tft-site-footer-item-content">
                                <ul>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Privacy policy</a></li>
                                    <li><a href="#">Terms of service</a></li>
                                    <li><a href="#">Contact us</a></li>
                                    <li><a href="#">Online support</a></li>
                                </ul>
                            </div>

                        </div>

                        <div class="tft-site-footer-item">
                            <div class="tft-site-footer-item-title">
                                <h3>Newsletter</h3>
                            </div>
                            <div class="tft-site-footer-item-content">
                                <p>Subscribe our weekly newsletter</p>
                                <form class="tft-site-footer-newsletter-form" action="">
                                    <div class="tft-site-footer-newsletter">
                                        <input type="text" placeholder="Enter Email Address">
                                        <img src=<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/mail.svg') ?> alt="arrow">

                                    </div>
                                    <button>Subscribe now</button>
                                </form>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
            <div class="tft-footer-bottom">
                <div class="tft-site-container">
                    <div class="tft-footer-bottom-wrapper">
                        <div class="tft-site-copy-right">
                            <p>© 2023 <a href="#">ThemeTags</a>. All Rights Reserved.</p>
                        </div>
                        <div class="tft-footer-bottom-links">
                            <ul>
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">View on map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
<?php
        $travelfic_footer = ob_get_clean();
        return $travelfic_footer;
    }
}
