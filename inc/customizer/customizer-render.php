<?php

class Travelfic_Customizer_render
{

    public static function travelfic_toolkit_header_second_design($travelfic_header)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        ob_start();
?>
        <header class="tft-design-2">
            <div class="tft-top-header tft-w-padding">
                <div class="tft-flex">
                    <div class="tft-contact-info">
                        <ul>
                            <li>
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.3333 7.70297C11.3333 7.47256 11.3333 7.35735 11.368 7.25465C11.4687 6.95629 11.7344 6.84051 12.0006 6.71926C12.2999 6.58295 12.4495 6.51479 12.5978 6.5028C12.7661 6.48919 12.9347 6.52545 13.0786 6.60619C13.2693 6.71323 13.4023 6.91662 13.5385 7.08201C14.1674 7.8459 14.4819 8.22784 14.5969 8.64904C14.6898 8.98894 14.6898 9.34439 14.5969 9.6843C14.4291 10.2986 13.8989 10.8136 13.5064 11.2903C13.3057 11.5341 13.2053 11.656 13.0786 11.7271C12.9347 11.8079 12.7661 11.8441 12.5978 11.8305C12.4495 11.8185 12.2999 11.7504 12.0006 11.6141C11.7344 11.4928 11.4687 11.377 11.368 11.0787C11.3333 10.976 11.3333 10.8608 11.3333 10.6304V7.70297Z" stroke="#FDF9F4" stroke-width="1.5"/>
                                <path d="M4.6665 7.70308C4.6665 7.41291 4.65836 7.15214 4.42378 6.94813C4.33846 6.87393 4.22534 6.82241 3.99911 6.71937C3.69984 6.58306 3.55021 6.5149 3.40194 6.50291C2.95711 6.46693 2.71778 6.77054 2.46125 7.08212C1.83234 7.84601 1.51788 8.22795 1.40281 8.64915C1.30996 8.98905 1.30996 9.3445 1.40281 9.68441C1.57064 10.2987 2.10085 10.8137 2.49331 11.2904C2.7407 11.5908 2.97702 11.865 3.40194 11.8306C3.55021 11.8187 3.69984 11.7505 3.99911 11.6142C4.22534 11.5111 4.33846 11.4596 4.42378 11.3854C4.65836 11.1814 4.6665 10.9206 4.6665 10.6305V7.70308Z" stroke="#FDF9F4" stroke-width="1.5"/>
                                <path d="M3.33325 6.5C3.33325 4.29086 5.42259 2.5 7.99992 2.5C10.5772 2.5 12.6666 4.29086 12.6666 6.5" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"/>
                                <path d="M12.6665 11.832V12.3654C12.6665 13.5436 11.4726 14.4987 9.99984 14.4987H8.6665" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                +88 00 123 456
                            </li>
                            <li>
                                <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector" d="M4.6665 4.16406L6.62785 5.32368C7.77132 5.99974 8.22836 5.99974 9.37183 5.32368L11.3332 4.16406" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path id="Vector_2" d="M1.34376 7.48245C1.38735 9.52614 1.40914 10.548 2.16322 11.3049C2.91731 12.0619 3.96681 12.0883 6.0658 12.141C7.35946 12.1735 8.64038 12.1735 9.93404 12.141C12.033 12.0883 13.0825 12.0619 13.8366 11.3049C14.5907 10.548 14.6125 9.52613 14.6561 7.48245C14.6701 6.82532 14.6701 6.17208 14.6561 5.51496C14.6125 3.47127 14.5907 2.44943 13.8366 1.69247C13.0825 0.935519 12.033 0.909149 9.93404 0.85641C8.64038 0.823906 7.35946 0.823905 6.0658 0.856406C3.9668 0.90914 2.91731 0.935508 2.16322 1.69246C1.40913 2.44942 1.38734 3.47126 1.34376 5.51495C1.32975 6.17208 1.32975 6.82532 1.34376 7.48245Z" stroke="#FDF9F4" stroke-width="1.5" stroke-linejoin="round"/>
                                </g>
                                </svg>
                                travello@outlook.com
                            </li>
                        </ul>
                    </div>

                    <div class="tft-social-share">
                        <ul>
                            <li>
                                <a href="">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.33276 13.6693V8.33594C4.33276 7.87 4.33276 7.63703 4.25664 7.45325C4.15515 7.20823 3.96047 7.01355 3.71545 6.91206C3.53168 6.83594 3.29871 6.83594 2.83276 6.83594C2.36682 6.83594 2.13385 6.83594 1.95008 6.91206C1.70505 7.01355 1.51038 7.20823 1.40888 7.45325C1.33276 7.63703 1.33276 7.87 1.33276 8.33594V13.6693C1.33276 14.1352 1.33276 14.3682 1.40888 14.552C1.51038 14.797 1.70505 14.9917 1.95008 15.0932C2.13385 15.1693 2.36682 15.1693 2.83276 15.1693C3.29871 15.1693 3.53168 15.1693 3.71545 15.0932C3.96047 14.9917 4.15515 14.797 4.25664 14.552C4.33276 14.3682 4.33276 14.1352 4.33276 13.6693Z" stroke="#FDF9F4"/>
                                    <path d="M4.33276 3.33594C4.33276 4.16436 3.66119 4.83594 2.83276 4.83594C2.00434 4.83594 1.33276 4.16436 1.33276 3.33594C1.33276 2.50751 2.00434 1.83594 2.83276 1.83594C3.66119 1.83594 4.33276 2.50751 4.33276 3.33594Z" stroke="#FDF9F4"/>
                                    <path d="M8.2168 6.83594H7.6661C7.03756 6.83594 6.72329 6.83594 6.52803 7.0312C6.33276 7.22646 6.33276 7.54073 6.33276 8.16927V13.8359C6.33276 14.4645 6.33276 14.7787 6.52803 14.974C6.72329 15.1693 7.03756 15.1693 7.6661 15.1693H7.99944C8.62798 15.1693 8.94224 15.1693 9.13751 14.974C9.33277 14.7788 9.33277 14.4645 9.33278 13.836L9.3328 11.5027C9.3328 10.3981 9.68484 9.50268 10.7247 9.50268C11.2446 9.50268 11.6661 9.9504 11.6661 10.5027V13.5027C11.6661 14.1312 11.6661 14.4455 11.8613 14.6408C12.0566 14.836 12.3709 14.836 12.9994 14.836H13.3319C13.9603 14.836 14.2745 14.836 14.4698 14.6408C14.665 14.4456 14.6651 14.1314 14.6653 13.503L14.6661 9.8361C14.6661 8.17924 13.0904 6.8361 11.5306 6.8361C10.6427 6.8361 9.85053 7.27133 9.3328 7.95191C9.33279 7.5319 9.33278 7.32189 9.24153 7.16593C9.18375 7.06718 9.10153 6.98496 9.00277 6.92718C8.84681 6.83594 8.63681 6.83594 8.2168 6.83594Z" stroke="#FDF9F4" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="content">
                                    <path id="Path" fill-rule="evenodd" clip-rule="evenodd" d="M2.12064 6.38759C1.4688 6.38759 1.33276 6.51549 1.33276 7.12833V8.23944C1.33276 8.85228 1.4688 8.98018 2.12064 8.98018H3.6964V13.4246C3.6964 14.0375 3.83244 14.1654 4.48428 14.1654H6.06004C6.71187 14.1654 6.84792 14.0375 6.84792 13.4246V8.98018H8.61725C9.11162 8.98018 9.23901 8.88984 9.37482 8.44294L9.71248 7.33183C9.94513 6.56627 9.80177 6.38759 8.95492 6.38759H6.84792V4.53573C6.84792 4.12664 7.20066 3.79499 7.63579 3.79499H9.87822C10.5301 3.79499 10.6661 3.66709 10.6661 3.05425V1.57277C10.6661 0.959932 10.5301 0.832031 9.87822 0.832031H7.63579C5.46013 0.832031 3.6964 2.49024 3.6964 4.53573V6.38759H2.12064Z" stroke="#FDF9F4" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="content">
                                    <path id="Vector" d="M1.33276 10.8346C2.50946 11.5153 3.87561 11.8346 5.33276 11.8346C9.65329 11.8346 13.1739 8.40964 13.3275 4.12662L14.6661 1.5013L12.43 1.83464C11.9599 1.41973 11.3424 1.16797 10.6661 1.16797C8.95117 1.16797 7.66656 2.84619 8.08005 4.48799C5.71132 4.64082 3.56521 3.18217 2.32405 1.23812C1.50041 4.03587 2.26362 7.40537 4.33276 9.48166C4.33276 10.2659 2.33276 10.7338 1.33276 10.8346Z" stroke="#FDF9F4" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                </a>
                            </li>
                            
                            <li>
                                <a href="">
                                    <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="content">
                                    <path id="Vector" d="M7.99943 12.1654C9.20589 12.1654 10.3628 12.0462 11.4351 11.8276C12.7743 11.5546 13.444 11.4181 14.055 10.6324C14.6661 9.84679 14.6661 8.94488 14.6661 7.14106V5.85633C14.6661 4.05252 14.6661 3.15061 14.055 2.36495C13.444 1.57928 12.7743 1.44278 11.4351 1.16978C10.3628 0.951214 9.20589 0.832031 7.99943 0.832031C6.79297 0.832031 5.63602 0.951214 4.5638 1.16978C3.22453 1.44278 2.5549 1.57928 1.94383 2.36495C1.33276 3.15061 1.33276 4.05252 1.33276 5.85633V7.14106C1.33276 8.94488 1.33276 9.84679 1.94383 10.6324C2.5549 11.4181 3.22453 11.5546 4.5638 11.8276C5.63602 12.0462 6.79297 12.1654 7.99943 12.1654Z" stroke="#FDF9F4"/>
                                    <path id="Vector 3642" d="M10.6414 6.70598C10.5425 7.10988 10.0161 7.39995 8.96324 7.98011C7.81817 8.61109 7.24562 8.92659 6.78187 8.80504C6.6248 8.76387 6.48013 8.69149 6.35866 8.59328C6 8.30331 6 7.70134 6 6.4974C6 5.29345 6 4.69148 6.35866 4.40151C6.48013 4.30331 6.6248 4.23092 6.78187 4.18975C7.24562 4.0682 7.81816 4.3837 8.96324 5.01468C10.0161 5.59484 10.5425 5.88492 10.6414 6.28881C10.6751 6.42623 10.6751 6.56856 10.6414 6.70598Z" stroke="#FDF9F4" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tft-menus-section tft-w-padding">
                <div class="tft-flex">
                    <div class="tft-menu">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary_menu',
                                'menu_id'        => 'navigation',
                                'container'      => 'ul',
                                'menu_class'     => 'main--header-menu tft-flex'
                            ));
                        ?>
                    </div>
                    <div class="tft-logo">
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
                    <div class="tft-account">
                        <ul>
                            <li>
                                <a href="#"><?php echo __("Register", "travelfic-toolkit"); ?></a>
                            </li>
                            <li>
                                <a href="#" class="login"><?php echo __("Login", "travelfic-toolkit"); ?></a>
                            </li>
                        </ul>
                    </div>
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