<?php

function travelfic_design2_render_header($travelfic_header)
{
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
                        <span>Address</span>
                    </div>

                    <div class="tft-site-top-bar-left-item">
                        <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/email.svg') ?>" alt="mail">
                        <span>
                            <a href="mailto:

                        ">
                                info@example.com
                            </a>
                        </span>
                    </div>
                    <div class="tft-site-top-bar-left-item">
                        <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/phone.svg') ?>" alt="phone">
                        <span>
                            <a href="tel:(245) 2156 21453">
                                (245) 2156 21453
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
