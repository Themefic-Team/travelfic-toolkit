<?php

class Travelfic_Customizer_Header
{

    public static function travelfic_toolkit_header_second_design($travelfic_header)
    {
        $travelfic_prefix = 'travelfic_customizer_settings_';
        // Sticky Settings Checked
        $travelfic_sticky_settings = get_theme_mod($travelfic_prefix.'stiky_header', 'disabled');
        if( isset( $travelfic_sticky_settings ) ){
            if( $travelfic_sticky_settings != 'disabled' ){
                $travelfic_sticky_class = 'tft_has_sticky';
            }else{        
                $travelfic_sticky_class = '';
            }
        }

        // Transparent Header Settings Checked
        $travelfic_transparent_settings = get_theme_mod($travelfic_prefix.'transparent_header', 'disabled');
        $travelfic_transparent_showing = get_theme_mod($travelfic_prefix.'transparent_showing', 'both');
        if( isset( $travelfic_transparent_settings ) ){
            if( $travelfic_transparent_settings != 'disabled' ){
                if("both"==$travelfic_transparent_showing || "desktop"==$travelfic_transparent_showing){
                    $travelfic_desktop_transparent_class = 'tft_has_transparent';
                }
                if("both"==$travelfic_transparent_showing || "mobile"==$travelfic_transparent_showing){
                    $travelfic_mobile_transparent_class = 'tft_has_transparent';
                }
            }else{        
                $travelfic_desktop_transparent_class = '';
                $travelfic_mobile_transparent_class = '';
            }
        }
        $travelfic_archive_transparent_showing = get_theme_mod($travelfic_prefix.'archive_transparent_header', 'disabled');
        if(is_archive()  || is_single() || is_404() || is_search()){
            if("disabled"==$travelfic_archive_transparent_showing ){
                $travelfic_desktop_transparent_class = '';
                $travelfic_mobile_transparent_class = '';
            }else{
                $travelfic_desktop_transparent_class = 'tft_has_transparent';
                $travelfic_mobile_transparent_class = 'tft_has_transparent';
            }
        }
        $design_2_topbar = get_theme_mod($travelfic_prefix.'header_design_2_topbar', '1');
        $design_2_phone = get_theme_mod($travelfic_prefix.'design_2_phone', '+88 00 123 456');
        $design_2_email = get_theme_mod($travelfic_prefix.'design_2_email', 'travello@outlook.com');
        $design_2_registration_url = get_theme_mod($travelfic_prefix.'design_2_registration_url', '#');
        $design_2_login_url = get_theme_mod($travelfic_prefix.'design_2_login_url', '#');
        $social_facebook = get_theme_mod($travelfic_prefix.'social_facebook', '#');
        $social_twitter = get_theme_mod($travelfic_prefix.'social_twitter', '#');
        $social_youtube = get_theme_mod($travelfic_prefix.'social_youtube', '#');
        $social_linkedin = get_theme_mod($travelfic_prefix.'social_linkedin', '#');
        $social_instagram = get_theme_mod($travelfic_prefix.'social_instagram', '#');
        $social_pinterest = get_theme_mod($travelfic_prefix.'social_pinterest', '#');
        $social_reddit = get_theme_mod($travelfic_prefix.'social_reddit', '#');
        ob_start();
    ?>
        <header class="tft-design-2 <?php echo esc_attr( $travelfic_sticky_class ); ?>">
            <?php if(!empty($design_2_topbar)){ ?>
            <div class="tft-top-header tft-w-padding <?php echo esc_attr( apply_filters( 'travelfic_header_2_tftcontainer', $travelfic_tftcontainer = '') ); ?>">
                <div class="tft-flex">
                    <div class="tft-contact-info">
                        <ul>
                            <?php 
                            if(!empty($design_2_phone)){ ?>
                            <li>
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.3333 7.70297C11.3333 7.47256 11.3333 7.35735 11.368 7.25465C11.4687 6.95629 11.7344 6.84051 12.0006 6.71926C12.2999 6.58295 12.4495 6.51479 12.5978 6.5028C12.7661 6.48919 12.9347 6.52545 13.0786 6.60619C13.2693 6.71323 13.4023 6.91662 13.5385 7.08201C14.1674 7.8459 14.4819 8.22784 14.5969 8.64904C14.6898 8.98894 14.6898 9.34439 14.5969 9.6843C14.4291 10.2986 13.8989 10.8136 13.5064 11.2903C13.3057 11.5341 13.2053 11.656 13.0786 11.7271C12.9347 11.8079 12.7661 11.8441 12.5978 11.8305C12.4495 11.8185 12.2999 11.7504 12.0006 11.6141C11.7344 11.4928 11.4687 11.377 11.368 11.0787C11.3333 10.976 11.3333 10.8608 11.3333 10.6304V7.70297Z" stroke="#FDF9F4" stroke-width="1.5"/>
                                <path d="M4.6665 7.70308C4.6665 7.41291 4.65836 7.15214 4.42378 6.94813C4.33846 6.87393 4.22534 6.82241 3.99911 6.71937C3.69984 6.58306 3.55021 6.5149 3.40194 6.50291C2.95711 6.46693 2.71778 6.77054 2.46125 7.08212C1.83234 7.84601 1.51788 8.22795 1.40281 8.64915C1.30996 8.98905 1.30996 9.3445 1.40281 9.68441C1.57064 10.2987 2.10085 10.8137 2.49331 11.2904C2.7407 11.5908 2.97702 11.865 3.40194 11.8306C3.55021 11.8187 3.69984 11.7505 3.99911 11.6142C4.22534 11.5111 4.33846 11.4596 4.42378 11.3854C4.65836 11.1814 4.6665 10.9206 4.6665 10.6305V7.70308Z" stroke="#FDF9F4" stroke-width="1.5"/>
                                <path d="M3.33325 6.5C3.33325 4.29086 5.42259 2.5 7.99992 2.5C10.5772 2.5 12.6666 4.29086 12.6666 6.5" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"/>
                                <path d="M12.6665 11.832V12.3654C12.6665 13.5436 11.4726 14.4987 9.99984 14.4987H8.6665" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <?php echo esc_html( $design_2_phone ); ?>
                            </li>
                            <?php } 
                            if(!empty($design_2_email)){
                            ?>
                            <li>
                                <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector" d="M4.6665 4.16406L6.62785 5.32368C7.77132 5.99974 8.22836 5.99974 9.37183 5.32368L11.3332 4.16406" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path id="Vector_2" d="M1.34376 7.48245C1.38735 9.52614 1.40914 10.548 2.16322 11.3049C2.91731 12.0619 3.96681 12.0883 6.0658 12.141C7.35946 12.1735 8.64038 12.1735 9.93404 12.141C12.033 12.0883 13.0825 12.0619 13.8366 11.3049C14.5907 10.548 14.6125 9.52613 14.6561 7.48245C14.6701 6.82532 14.6701 6.17208 14.6561 5.51496C14.6125 3.47127 14.5907 2.44943 13.8366 1.69247C13.0825 0.935519 12.033 0.909149 9.93404 0.85641C8.64038 0.823906 7.35946 0.823905 6.0658 0.856406C3.9668 0.90914 2.91731 0.935508 2.16322 1.69246C1.40913 2.44942 1.38734 3.47126 1.34376 5.51495C1.32975 6.17208 1.32975 6.82532 1.34376 7.48245Z" stroke="#FDF9F4" stroke-width="1.5" stroke-linejoin="round"/>
                                </g>
                                </svg>
                                <?php echo esc_html( $design_2_email ); ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="tft-social-share">
                        <ul>
                            <?php if(!empty($social_linkedin)){ ?>
                            <li>
                                <a href="<?php echo esc_url($social_linkedin); ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                <path d="M3.33203 12.6673V7.33398C3.33203 6.86804 3.33203 6.63507 3.25591 6.4513C3.15442 6.20627 2.95974 6.0116 2.71471 5.9101C2.53094 5.83398 2.29797 5.83398 1.83203 5.83398C1.36609 5.83398 1.13312 5.83398 0.949348 5.9101C0.70432 6.0116 0.509646 6.20627 0.408152 6.4513C0.332031 6.63507 0.332031 6.86804 0.332031 7.33399V12.6673C0.332031 13.1333 0.332031 13.3662 0.408152 13.55C0.509646 13.795 0.70432 13.9897 0.949348 14.0912C1.13312 14.1673 1.36609 14.1673 1.83203 14.1673C2.29797 14.1673 2.53094 14.1673 2.71471 14.0912C2.95974 13.9897 3.15442 13.795 3.25591 13.55C3.33203 13.3662 3.33203 13.1333 3.33203 12.6673Z" fill="#FDF9F4"/>
                                <path d="M3.33203 2.33398C3.33203 3.16241 2.66046 3.83398 1.83203 3.83398C1.0036 3.83398 0.332031 3.16241 0.332031 2.33398C0.332031 1.50556 1.0036 0.833984 1.83203 0.833984C2.66046 0.833984 3.33203 1.50556 3.33203 2.33398Z" fill="#FDF9F4"/>
                                <path d="M7.21606 5.83398H6.66536C6.03683 5.83398 5.72256 5.83398 5.52729 6.02925C5.33203 6.22451 5.33203 6.53878 5.33203 7.16732V12.834C5.33203 13.4625 5.33203 13.7768 5.52729 13.9721C5.72256 14.1673 6.03683 14.1673 6.66536 14.1673H6.99871C7.62725 14.1673 7.94151 14.1673 8.13677 13.9721C8.33204 13.7768 8.33204 13.4625 8.33205 12.834L8.33207 10.5007C8.33207 9.39616 8.68411 8.50073 9.72394 8.50073C10.2439 8.50073 10.6653 8.94845 10.6653 9.50073V12.5007C10.6653 13.1293 10.6653 13.4435 10.8606 13.6388C11.0559 13.8341 11.3701 13.8341 11.9987 13.8341H12.3312C12.9596 13.8341 13.2738 13.8341 13.469 13.6389C13.6643 13.4437 13.6644 13.1295 13.6645 12.5011L13.6654 8.83414C13.6654 7.17729 12.0896 5.83414 10.5299 5.83414C9.64198 5.83414 8.8498 6.26938 8.33207 6.94995C8.33206 6.52994 8.33205 6.31994 8.2408 6.16398C8.18302 6.06523 8.10079 5.98301 8.00204 5.92523C7.84608 5.83398 7.63607 5.83398 7.21606 5.83398Z" fill="#FDF9F4"/>
                                </svg>
                                </a>
                            </li>
                            <?php }
                            if(!empty($social_facebook)){
                            ?>
                            <li>
                                <a href="<?php echo esc_url($social_facebook); ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.11991 6.38563C0.468072 6.38563 0.332031 6.51353 0.332031 7.12637V8.23749C0.332031 8.85033 0.468071 8.97823 1.11991 8.97823H2.69567V13.4227C2.69567 14.0355 2.83171 14.1634 3.48355 14.1634H5.0593C5.71114 14.1634 5.84718 14.0355 5.84718 13.4227V8.97823H7.61652C8.11089 8.97823 8.23827 8.88789 8.37409 8.44098L8.71175 7.32987C8.9444 6.56432 8.80104 6.38563 7.95418 6.38563H5.84718V4.53378C5.84718 4.12468 6.19993 3.79304 6.63506 3.79304H8.87749C9.52932 3.79304 9.66536 3.66514 9.66536 3.0523V1.57082C9.66536 0.957979 9.52932 0.830078 8.87749 0.830078H6.63506C4.45939 0.830078 2.69567 2.48828 2.69567 4.53378V6.38563H1.11991Z" fill="#FDF9F4"/>
                                </svg>
                                </a>
                            </li>
                            <?php } 
                            if(!empty($social_twitter)){
                            ?>
                            <li>
                                <a href="<?php echo esc_url($social_twitter); ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="11" viewBox="0 0 14 11" fill="none">
                                <path d="M0.332031 9.83659C1.50872 10.5173 2.87488 10.8366 4.33203 10.8366C8.65256 10.8366 12.1731 7.41159 12.3268 3.12857L13.6654 0.503255L11.4292 0.836589C10.9592 0.42168 10.3417 0.169922 9.66536 0.169922C7.95044 0.169922 6.66582 1.84815 7.07932 3.48994C4.71059 3.64277 2.56448 2.18412 1.32332 0.240072C0.499677 3.03782 1.26289 6.40732 3.33203 8.48361C3.33203 9.2679 1.33203 9.7358 0.332031 9.83659Z" fill="#FDF9F4"/>
                                </svg>
                                </a>
                            </li>
                            <?php } 
                            if(!empty($social_youtube)){
                            ?>
                            <li>
                                <a href="<?php echo esc_url($social_youtube); ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                <path d="M6.9987 12.1634C8.20516 12.1634 9.3621 12.0442 10.4343 11.8257C11.7736 11.5527 12.4432 11.4162 13.0543 10.6305C13.6654 9.84483 13.6654 8.94292 13.6654 7.13911V5.85438C13.6654 4.05057 13.6654 3.14866 13.0543 2.36299C12.4432 1.57733 11.7736 1.44083 10.4343 1.16783C9.3621 0.949261 8.20516 0.830078 6.9987 0.830078C5.79224 0.830078 4.63529 0.949261 3.56307 1.16783C2.2238 1.44083 1.55417 1.57733 0.9431 2.36299C0.332031 3.14866 0.332031 4.05057 0.332031 5.85438V7.13911C0.332031 8.94292 0.332031 9.84483 0.9431 10.6305C1.55417 11.4162 2.2238 11.5527 3.56307 11.8257C4.63529 12.0442 5.79224 12.1634 6.9987 12.1634Z" fill="#FDF9F4"/>
                                <path d="M9.64142 6.70793C9.54249 7.11183 9.01607 7.40191 7.96324 7.98206C6.81817 8.61305 6.24562 8.92854 5.78187 8.80699C5.6248 8.76583 5.48013 8.69344 5.35866 8.59523C5 8.30527 5 7.70329 5 6.49935C5 5.2954 5 4.69343 5.35866 4.40347C5.48013 4.30526 5.6248 4.23287 5.78187 4.19171C6.24562 4.07016 6.81816 4.38565 7.96324 5.01663C9.01607 5.59679 9.54249 5.88687 9.64142 6.29076C9.67508 6.42819 9.67508 6.57051 9.64142 6.70793Z" fill="#595349"/>
                                </svg>
                                </a>
                            </li>
                            <?php } 
                            if(!empty($social_pinterest)){
                            ?>
                            <li>
                                <a href="<?php echo esc_url($social_pinterest); ?>" target="_blank">
                                                                    
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8.00065" cy="8.4987" r="6.66667" fill="#FDF9F4"/>
                                <path d="M8.00065 7.83203L5.33398 14.4987" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.65042 11.5476C7.06334 11.7309 7.52043 11.8327 8.0013 11.8327C9.84225 11.8327 11.3346 10.3403 11.3346 8.49935C11.3346 6.6584 9.84225 5.16602 8.0013 5.16602C6.16035 5.16602 4.66797 6.6584 4.66797 8.49935C4.66797 9.10654 4.83042 9.67573 5.11411 10.166" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                </a>
                            </li>
                            <?php } 
                            if(!empty($social_reddit)){
                            ?>
                            <li>
                                <a href="<?php echo esc_url($social_reddit); ?>" target="_blank">
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                <ellipse cx="8" cy="9.83333" rx="6" ry="4.33333" fill="#FDF9F4"/>
                                <path d="M10.3346 10.6855C9.67789 11.1974 8.87209 11.4988 8.0013 11.4988C7.13051 11.4988 6.32471 11.1974 5.66797 10.6855" stroke="#595349" stroke-linecap="round"/>
                                <ellipse cx="12.6673" cy="2.16536" rx="1.33333" ry="1.33333" stroke="#FDF9F4"/>
                                <path d="M12 6.2129C12.2458 5.78702 12.7089 5.5 13.2397 5.5C14.0278 5.5 14.6667 6.13281 14.6667 6.91342C14.6667 7.45799 14.3557 7.93063 13.9001 8.16667" stroke="#FDF9F4" stroke-linecap="round"/>
                                <path d="M4.00065 6.2129C3.75482 5.78702 3.29174 5.5 2.76097 5.5C1.97287 5.5 1.33398 6.13281 1.33398 6.91342C1.33398 7.45799 1.64491 7.93063 2.10053 8.16667" stroke="#FDF9F4" stroke-linecap="round"/>
                                <path d="M11.3333 2.16602C9.76198 2.16602 8.97631 2.16602 8.48816 2.65417C8 3.14233 8 3.928 8 5.49935" stroke="#FDF9F4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.00599 8.16602L6 8.16602" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.006 8.16602L10 8.16602" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                </a>
                            </li>
                            <?php } 
                            if(!empty($social_instagram)){
                            ?>
                            <li>
                                <a href="<?php echo esc_url($social_instagram); ?>" target="_blank">
                                   
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                <path d="M0.666016 6.5013C0.666016 3.51574 0.666016 2.02296 1.59351 1.09546C2.52101 0.167969 4.01379 0.167969 6.99935 0.167969C9.98491 0.167969 11.4777 0.167969 12.4052 1.09546C13.3327 2.02296 13.3327 3.51574 13.3327 6.5013C13.3327 9.48686 13.3327 10.9796 12.4052 11.9071C11.4777 12.8346 9.98491 12.8346 6.99935 12.8346C4.01379 12.8346 2.52101 12.8346 1.59351 11.9071C0.666016 10.9796 0.666016 9.48686 0.666016 6.5013Z" fill="#FDF9F4"/>
                                <path d="M10 6.5C10 8.15685 8.65685 9.5 7 9.5C5.34315 9.5 4 8.15685 4 6.5C4 4.84315 5.34315 3.5 7 3.5C8.65685 3.5 10 4.84315 10 6.5Z" fill="#FDF9F4" stroke="#595349"/>
                                <path d="M10.6719 2.83398L10.6659 2.83398" stroke="#595349" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="tft-menus-section tft-header-desktop tft-w-padding <?php echo esc_attr( $travelfic_desktop_transparent_class ); ?>  <?php echo esc_attr( apply_filters( 'travelfic_header_2_tftcontainer', $travelfic_tftcontainer = '') ); ?>">
                <div class="tft-flex">
                    <div class="tft-menu">
                        <nav class="tft-site-navigation">
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary_menu',
                                    'menu_id'        => 'navigation',
                                    'container'      => 'ul',
                                    'menu_class'     => 'main--header-menu'
                                ));
                            ?>
                        </nav>
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
                            <?php 
                            if ( is_user_logged_in() ) {
                            ?>
                            <li>
                                <a href="<?php echo site_url( 'my-account/' ); ?>" class="login"><?php echo __("Profile", "travelfic-toolkit"); ?></a>
                            </li>
                            <?php
                            }else{
                            if(!empty($design_2_registration_url)){ ?>
                            <li>
                                <a href="<?php echo esc_url( $design_2_registration_url ); ?>"><?php echo __("Register", "travelfic-toolkit"); ?></a>
                            </li>
                            <?php } if(!empty($design_2_login_url)){ ?>
                            <li>
                                <a href="<?php echo esc_url( $design_2_login_url ); ?>" class="login"><?php echo __("Login", "travelfic-toolkit"); ?></a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>

            
                
            <div class="tft-menus-section tft-header-mobile <?php echo esc_attr( $travelfic_mobile_transparent_class ); ?>">
                <div class="tft-main-header-wrapper <?php echo esc_attr( apply_filters( 'travelfic_header_tftcontainer', $travelfic_tftcontainer = '') ); ?> tft-container-flex align-center justify-sp-between tft-w-padding">
                
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

                <div class="<?php echo esc_attr( apply_filters( 'travelfic_header_tftcontainer', $travelfic_tftcontainer = '') ); ?> site-header-section tft-mobile-main-menu">
                    <nav class="tft-site-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary_menu',
                            'menu_id'        => 'navigation',
                            'container' => 'ul',
                            'menu_class' => 'main--header-menu tft-flex',
                            'walker' => has_nav_menu('primary_menu') ? new Travelfic_Custom_Nav_Walker() : '',
                        ));
                        ?>
                        <div class="tft-social-share">
                            <ul>
                                <?php if(!empty($social_linkedin)){ ?>
                                <li>
                                    <a href="<?php echo esc_url($social_linkedin); ?>" target="_blank">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="content">
                                        <path id="Vector 6810" d="M4.41602 15.4596V8.79297C4.41602 7.9711 4.41602 7.56016 4.18903 7.28358C4.14747 7.23294 4.10104 7.18651 4.05041 7.14496C3.77382 6.91797 3.36289 6.91797 2.54102 6.91797C1.71915 6.91797 1.30821 6.91797 1.03162 7.14496C0.980988 7.18651 0.934559 7.23294 0.893005 7.28358C0.666016 7.56016 0.666016 7.9711 0.666016 8.79297V15.4596C0.666016 16.2815 0.666016 16.6924 0.893005 16.969C0.934559 17.0197 0.980988 17.0661 1.03162 17.1076C1.30821 17.3346 1.71915 17.3346 2.54102 17.3346C3.36289 17.3346 3.77382 17.3346 4.05041 17.1076C4.10104 17.0661 4.14747 17.0197 4.18903 16.969C4.41602 16.6924 4.41602 16.2815 4.41602 15.4596Z" stroke="#595349"/>
                                        <path id="Ellipse 1922" d="M4.41602 2.54297C4.41602 3.5785 3.57655 4.41797 2.54102 4.41797C1.50548 4.41797 0.666016 3.5785 0.666016 2.54297C0.666016 1.50743 1.50548 0.667969 2.54102 0.667969C3.57655 0.667969 4.41602 1.50743 4.41602 2.54297Z" stroke="#595349"/>
                                        <path id="Vector" d="M9.27106 6.91797H8.58268C7.79701 6.91797 7.40417 6.91797 7.16009 7.16205C6.91602 7.40612 6.91602 7.79896 6.91602 8.58464V15.668C6.91602 16.4536 6.91602 16.8465 7.16009 17.0906C7.40417 17.3346 7.79701 17.3346 8.58268 17.3346H8.99937C9.78503 17.3346 10.1779 17.3346 10.4219 17.0906C10.666 16.8465 10.666 16.4537 10.666 15.668L10.6661 12.7514C10.6661 11.3707 11.1061 10.2514 12.4059 10.2514C13.0558 10.2514 13.5827 10.811 13.5827 11.5014V15.2514C13.5827 16.0371 13.5827 16.4299 13.8267 16.674C14.0708 16.9181 14.4636 16.9181 15.2493 16.9181H15.665C16.4505 16.9181 16.8432 16.9181 17.0873 16.6741C17.3313 16.4301 17.3314 16.0373 17.3316 15.2518L17.3327 10.6682C17.3327 8.5971 15.363 6.91817 13.4133 6.91817C12.3035 6.91817 11.3132 7.46221 10.6661 8.31293C10.666 7.78792 10.666 7.52541 10.552 7.33047C10.4797 7.20702 10.377 7.10425 10.2535 7.03202C10.0586 6.91797 9.79607 6.91797 9.27106 6.91797Z" stroke="#595349" stroke-linejoin="round"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li>
                                <?php }
                                if(!empty($social_facebook)){
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($social_facebook); ?>" target="_blank">                                       
                                        <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="content">
                                        <path id="Path" fill-rule="evenodd" clip-rule="evenodd" d="M2.15086 7.60851C1.33607 7.60851 1.16602 7.76838 1.16602 8.53443V9.92332C1.16602 10.6894 1.33607 10.8492 2.15086 10.8492H4.12056V16.4048C4.12056 17.1709 4.29061 17.3307 5.10541 17.3307H7.07511C7.8899 17.3307 8.05996 17.1709 8.05996 16.4048V10.8492H10.2716C10.8896 10.8492 11.0488 10.7363 11.2186 10.1777L11.6407 8.78881C11.9315 7.83186 11.7523 7.60851 10.6937 7.60851H8.05996V5.29369C8.05996 4.78232 8.50089 4.36777 9.0448 4.36777H11.8478C12.6626 4.36777 12.8327 4.20789 12.8327 3.44184V1.58999C12.8327 0.823939 12.6626 0.664062 11.8478 0.664062H9.0448C6.32522 0.664063 4.12056 2.73682 4.12056 5.29369V7.60851H2.15086Z" stroke="#595349" stroke-linejoin="round"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li>
                                <?php } 
                                if(!empty($social_twitter)){
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($social_twitter); ?>" target="_blank">                                        
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="content">
                                        <path id="Vector" d="M0.666016 13.4193C2.13688 14.2701 3.84458 14.6693 5.66602 14.6693C11.0667 14.6693 15.4674 10.388 15.6595 5.03425L17.3327 1.7526L14.5375 2.16927C13.9499 1.65063 13.1781 1.33594 12.3327 1.33594C10.189 1.33594 8.58326 3.43372 9.10013 5.48596C6.13921 5.677 3.45657 3.85369 1.90512 1.42363C0.875573 4.92081 1.82959 9.13268 4.41602 11.7281C4.41602 12.7084 1.91602 13.2933 0.666016 13.4193Z" stroke="#595349" stroke-linejoin="round"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li>
                                <?php } 
                                if(!empty($social_youtube)){
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($social_youtube); ?>" target="_blank">
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="content">
                                        <path id="Vector" d="M8.99935 15.0807C10.5074 15.0807 11.9536 14.9318 13.2939 14.6585C14.968 14.3173 15.805 14.1467 16.5688 13.1646C17.3327 12.1825 17.3327 11.0551 17.3327 8.80035V7.19444C17.3327 4.93967 17.3327 3.81229 16.5688 2.83021C15.805 1.84813 14.968 1.6775 13.2939 1.33625C11.9536 1.06304 10.5074 0.914062 8.99935 0.914062C7.49128 0.914062 6.04509 1.06304 4.70481 1.33625C3.03073 1.6775 2.19369 1.84813 1.42985 2.83021C0.666016 3.81229 0.666016 4.93967 0.666016 7.19444V8.80035C0.666016 11.0551 0.666016 12.1825 1.42985 13.1646C2.19369 14.1467 3.03073 14.3173 4.70481 14.6585C6.04509 14.9318 7.49128 15.0807 8.99935 15.0807Z" stroke="#595349"/>
                                        <path id="Vector 3642" d="M12.3018 8.25943C12.1781 8.7643 11.5201 9.12689 10.204 9.85209C8.77271 10.6408 8.05703 11.0352 7.47733 10.8833C7.281 10.8318 7.10017 10.7413 6.94832 10.6186C6.5 10.2561 6.5 9.50363 6.5 7.9987C6.5 6.49377 6.5 5.7413 6.94832 5.37884C7.10017 5.25609 7.281 5.1656 7.47733 5.11414C8.05703 4.96221 8.7727 5.35657 10.204 6.14531C11.5201 6.8705 12.1781 7.2331 12.3018 7.73797C12.3439 7.90975 12.3439 8.08765 12.3018 8.25943Z" stroke="#595349" stroke-linejoin="round"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li>
                                <?php } 
                                if(!empty($social_pinterest)){
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($social_pinterest); ?>" target="_blank">
                                        
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="content">
                                        <path id="Vector" d="M8.00004 6.83594L5.33337 13.5026" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path id="Vector_2" d="M6.6492 10.5495C7.06212 10.7328 7.51921 10.8346 8.00008 10.8346C9.84103 10.8346 11.3334 9.34225 11.3334 7.5013C11.3334 5.66035 9.84103 4.16797 8.00008 4.16797C6.15913 4.16797 4.66675 5.66035 4.66675 7.5013C4.66675 8.10849 4.8292 8.67769 5.11289 9.16797" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle id="Ellipse 1794" cx="8.00004" cy="7.5026" r="6.66667" stroke="#595349"/>
                                        </g>
                                        </svg>

                                    </a>
                                </li>
                                <?php } 
                                if(!empty($social_reddit)){
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($social_reddit); ?>" target="_blank">
                                        
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="content">
                                        <ellipse id="Ellipse 1794" cx="8" cy="9.83333" rx="6" ry="4.33333" stroke="#595349"/>
                                        <path id="Ellipse 1796" d="M10.3334 10.6875C9.67667 11.1993 8.87087 11.5008 8.00008 11.5008C7.12929 11.5008 6.32349 11.1993 5.66675 10.6875" stroke="#595349" stroke-linecap="round"/>
                                        <ellipse id="Ellipse 1795" cx="12.6667" cy="2.16927" rx="1.33333" ry="1.33333" stroke="#595349"/>
                                        <path id="Vector" d="M12 6.2129C12.2458 5.78702 12.7089 5.5 13.2397 5.5C14.0278 5.5 14.6667 6.13281 14.6667 6.91342C14.6667 7.45799 14.3557 7.93063 13.9001 8.16667" stroke="#595349" stroke-linecap="round"/>
                                        <path id="Vector_2" d="M4.00004 6.2129C3.75421 5.78702 3.29113 5.5 2.76036 5.5C1.97226 5.5 1.33337 6.13281 1.33337 6.91342C1.33337 7.45799 1.6443 7.93063 2.09991 8.16667" stroke="#595349" stroke-linecap="round"/>
                                        <path id="Vector 6379" d="M11.3333 2.16797C9.76198 2.16797 8.97631 2.16797 8.48816 2.65612C8 3.14428 8 3.92995 8 5.5013" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path id="Vector_3" d="M6.00538 8.16797L5.99939 8.16797" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path id="Vector_4" d="M10.0054 8.16797L9.99939 8.16797" stroke="#595349" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        </svg>

                                    </a>
                                </li>
                                <?php } 
                                if(!empty($social_instagram)){
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($social_instagram); ?>" target="_blank">
                                    
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="content">
                                    <path id="Vector" d="M0.666626 7.4974C0.666626 4.51183 0.666626 3.01905 1.59412 2.09156C2.52162 1.16406 4.0144 1.16406 6.99996 1.16406C9.98552 1.16406 11.4783 1.16406 12.4058 2.09156C13.3333 3.01905 13.3333 4.51183 13.3333 7.4974C13.3333 10.483 13.3333 11.9757 12.4058 12.9032C11.4783 13.8307 9.98552 13.8307 6.99996 13.8307C4.0144 13.8307 2.52162 13.8307 1.59412 12.9032C0.666626 11.9757 0.666626 10.483 0.666626 7.4974Z" stroke="#595349" stroke-linejoin="round"/>
                                    <path id="Ellipse 1794" d="M10 7.5C10 9.15685 8.65685 10.5 7 10.5C5.34315 10.5 4 9.15685 4 7.5C4 5.84315 5.34315 4.5 7 4.5C8.65685 4.5 10 5.84315 10 7.5Z" stroke="#595349"/>
                                    <path id="Vector_2" d="M10.6724 3.83203L10.6664 3.83203" stroke="#595349" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>

                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            
        </header>

    <?php
        $travelfic_header = ob_get_clean();
        return $travelfic_header;
    }

}