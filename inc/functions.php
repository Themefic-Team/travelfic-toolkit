<?php

if (! defined('ABSPATH')) exit; // Exit if accessed directly 

//option function
if (! function_exists('travelfic_get_meta')) {
    function travelfic_get_meta($id, $key, $attr = '')
    {
        if (!empty($attr)) {
            $data = get_post_meta($id, $key, true)[$attr];
        } else {
            $data = get_post_meta($id, $key, true);
        }
        return $data;
    }
}

// Text Limit 
if (! function_exists('travelfic_character_limit')) {
    function travelfic_character_limit($str, $limit)
    {
        if (strlen($str) > $limit) {
            return substr($str, 0, $limit) . '...';
        } else {
            return $str;
        }
    }
}

if (! is_plugin_active('woocommerce/woocommerce.php')) {
    add_action('wp_ajax_woocommerce_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_woocommerce_ajax_active_plugin', 'travelfic_toolkit_woocommerce_activate_plugin_callback');
}
if (! is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
    add_action('wp_ajax_contact-form-7_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_contact-form-7_ajax_active_plugin', 'travelfic_toolkit_cf7_activate_plugin_callback');
}
if (! is_plugin_active('tourfic/tourfic.php')) {
    add_action('wp_ajax_tourfic_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_tourfic_ajax_active_plugin', 'travelfic_toolkit_tourfic_activate_plugin_callback');
}

if (! is_plugin_active('elementor/elementor.php')) {
    add_action('wp_ajax_elementor_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_elementor_ajax_active_plugin', 'travelfic_toolkit_elementor_activate_plugin_callback');
}

function travelfic_toolkit_cf7_activate_plugin_callback()
{
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }

    // activate the plugin
    $activate_plugin = activate_plugin('contact-form-7/wp-contact-form-7.php');
    $cf7_activate_plugin = activate_plugin('contact-form-7/wp-contact-form-7.php');

    if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
        wp_send_json_success('contact-form-7 activated successfully.');
    } else {
        $result = activate_plugin('contact-form-7/wp-contact-form-7.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('contact-form-7 activated successfully!');
        }
    }
    wp_die();
}

function travelfic_toolkit_tourfic_activate_plugin_callback()
{
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }
    //Activation
    $activate_plugin = activate_plugin('tourfic/tourfic.php');
    $tourfic_activate_plugin = activate_plugin('tourfic/tourfic.php');

    if (is_plugin_active('tourfic/tourfic.php')) {
        wp_send_json_success('tourfic activated successfully.');
    } else {
        $result = activate_plugin('tourfic/tourfic.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('tourfic activated successfully!');
        }
    }
    wp_die();
}

function travelfic_toolkit_elementor_activate_plugin_callback()
{
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }
    //Activation
    $activate_plugin = activate_plugin('elementor/elementor.php');
    $elementor_activate_plugin = activate_plugin('elementor/elementor.php');

    if (is_plugin_active('elementor/elementor.php')) {
        wp_send_json_success('elementor activated successfully.');
    } else {
        $result = activate_plugin('elementor/elementor.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('elementor activated successfully!');
        }
    }
    wp_die();
}

function travelfic_toolkit_woocommerce_activate_plugin_callback()
{
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }
    //Activation
    $activate_plugin = activate_plugin('woocommerce/woocommerce.php');
    $woocommerce_activate_plugin = activate_plugin('woocommerce/woocommerce.php');

    if (is_plugin_active('woocommerce/woocommerce.php')) {
        wp_send_json_success('woocommerce activated successfully.');
    } else {
        $result = activate_plugin('woocommerce/woocommerce.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('woocommerce activated successfully!');
        }
    }
    wp_die();
}

if (!function_exists('travelfic_transparent_header_class')) {
    function travelfic_transparent_header_class($classes)
    {
        $activated_theme = !empty(get_option('stylesheet')) ? get_option('stylesheet') : '';
        if ($activated_theme == 'travelfic' || $activated_theme == 'travelfic-child') {
            $archive_transparent_header = get_theme_mod('travelfic_customizer_settings_archive_transparent_header');
            if ($archive_transparent_header == "enabled") {
                $classes[] = 'tft-archive-transparent-header';
            }
        }

        return $classes;
    }
}

add_filter("body_class", "travelfic_transparent_header_class");

if (!class_exists("\Tourfic\App\TF_Review")) {
    if (!function_exists('tf_based_on_text')) {
        function tf_based_on_text($number)
        {
            $comments_title = apply_filters(
                'tf_comment_form_title',
                sprintf( // WPCS: XSS OK.
                    /* translators: 1: number of comments */
                    esc_html(_nx('%1$s review', '%1$s reviews', $number, 'comments title', 'tourfic')),
                    number_format_i18n($number)
                )
            );
            echo esc_html($comments_title);
        }
    }

    if (!function_exists('tf_total_avg_rating')) {
        function tf_total_avg_rating($comments)
        {

            foreach ($comments as $comment) {
                $tf_comment_meta = get_comment_meta($comment->comment_ID, TF_COMMENT_META, true);
                $tf_base_rate    = get_comment_meta($comment->comment_ID, TF_BASE_RATE, true);

                if ($tf_comment_meta) {
                    $total_rate[] = tf_average_rating_change_on_base(tf_average_ratings($tf_comment_meta), $tf_base_rate);
                }
            }

            return tf_average_ratings($total_rate);
        }
    }

    if (!function_exists('tf_average_rating_change_on_base')) {
        function tf_average_rating_change_on_base($rating, $base_rate = 5)
        {

            $settings_base = ! empty(tfopt('r-base')) ? tfopt('r-base') : 5;
            $base_rate     = ! empty($base_rate) ? $base_rate : 5;

            if ($settings_base != $base_rate) {
                if ($settings_base > 5) {
                    $rating = $rating * 2;
                } else {
                    $rating = $rating / 2;
                }
            }

            return $rating;
        }
    }

    if (!function_exists('tf_average_ratings')) {
        function tf_average_ratings($ratings = [])
        {

            if (! $ratings) {
                return 0;
            }

            // No sub collection of ratings
            if (count($ratings) == count($ratings, COUNT_RECURSIVE)) {
                $average = array_sum($ratings) / count($ratings);
            } else {
                $average = 0;
                foreach ($ratings as $rating) {
                    $average += array_sum($rating) / count($rating);
                }
                $average = $average / count($ratings);
            }

            return sprintf('%.1f', $average);
        }
    }
}


/**
 * Function to display star rating
 * @param float $tf_rating
 * @return string
 */
if (!function_exists('tf_review_star_rating')) {
    function tf_review_star_rating($tf_rating)
    {
        $full_star = floor($tf_rating);
        $half_star = ($tf_rating - $full_star) >= 0.5 ? 1 : 0; 
        $empty_star = 5 - $full_star - $half_star; 

        $output = '<span class="tft-desination-rating">';
        for ($i = 0; $i < $full_star; $i++) {
            $output .= '<i class="ri-star-fill"></i>';
        }
        if ($half_star) {
            $output .= '<i class="ri-star-half-line"></i>'; 
        }
        for ($i = 0; $i < $empty_star; $i++) {
            $output .= '<i class="ri-star-line"></i>'; 
        }
        $output .= '</span>';
        return $output;
    }
}


// travel form shortcode
add_shortcode('tf_travel_form', 'tf_travel_form');


function tf_travel_form()
{
    ob_start();
?>
    <div class="tft-travel">
        <div class="container">
            <form class="tft-travel__form" action="#" method="post" aria-label="<?php echo esc_attr__('Travel Booking Form', 'travelfic-toolkit'); ?>">
                <fieldset class="tft-travel__form__fieldset">
                    <!-- Destination -->
                    <div class="tft-travel__form__fieldset__left">
                        <label for="tft-travel__form-destination" class="tft-travel__form__label">
                            <?php echo __('Destinations', 'travelfic-toolkit'); ?>
                        </label>
                        <div class="tft-travel__form__field" id="locationField">
                            <input type="text" id="tft-travel__form-destination" class="tft-travel__form__input" name="destination" placeholder="<?php echo esc_attr__('Where are you going?', 'travelfic-toolkit'); ?>" required>
                            <span class="tft-travel__form__field__icon icon--location">
                                <svg width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.25 15.625C3.625 13.5938 0 8.75 0 6C0 2.6875 2.65625 0 6 0C9.3125 0 12 2.6875 12 6C12 8.75 8.34375 13.5938 6.71875 15.625C6.34375 16.0938 5.625 16.0938 5.25 15.625ZM6 8C7.09375 8 8 7.125 8 6C8 4.90625 7.09375 4 6 4C4.875 4 4 4.90625 4 6C4 7.125 4.875 8 6 8Z" fill="white" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="tft-travel__form__fieldset__middle">
                        <!-- Check-in -->
                        <div class="tft-travel__form__group">
                            <label for="tft-travel__form-checkin" class="tft-travel__form__label">
                                <?php echo __('Check-in', 'travelfic-toolkit'); ?>
                            </label>
                            <div class="tft-travel__form__field" id="checkinField">
                                <input type="hidden" id="tft-travel__form-checkin" class="tft-travel__form__input" name="checkin" required>
                                <div class="tft-travel__form__field__icon">
                                    <svg width="42" height="48" viewBox="0 0 42 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 3V6H27V3C27 1.40625 28.3125 0 30 0C31.5938 0 33 1.40625 33 3V6H37.5C39.9375 6 42 8.0625 42 10.5V15H0V10.5C0 8.0625 1.96875 6 4.5 6H9V3C9 1.40625 10.3125 0 12 0C13.5938 0 15 1.40625 15 3ZM0 18H42V43.5C42 46.0312 39.9375 48 37.5 48H4.5C1.96875 48 0 46.0312 0 43.5V18ZM6 28.5C6 29.3438 6.65625 30 7.5 30H10.5C11.25 30 12 29.3438 12 28.5V25.5C12 24.75 11.25 24 10.5 24H7.5C6.65625 24 6 24.75 6 25.5V28.5ZM18 28.5C18 29.3438 18.6562 30 19.5 30H22.5C23.25 30 24 29.3438 24 28.5V25.5C24 24.75 23.25 24 22.5 24H19.5C18.6562 24 18 24.75 18 25.5V28.5ZM31.5 24C30.6562 24 30 24.75 30 25.5V28.5C30 29.3438 30.6562 30 31.5 30H34.5C35.25 30 36 29.3438 36 28.5V25.5C36 24.75 35.25 24 34.5 24H31.5ZM6 40.5C6 41.3438 6.65625 42 7.5 42H10.5C11.25 42 12 41.3438 12 40.5V37.5C12 36.75 11.25 36 10.5 36H7.5C6.65625 36 6 36.75 6 37.5V40.5ZM19.5 36C18.6562 36 18 36.75 18 37.5V40.5C18 41.3438 18.6562 42 19.5 42H22.5C23.25 42 24 41.3438 24 40.5V37.5C24 36.75 23.25 36 22.5 36H19.5ZM30 40.5C30 41.3438 30.6562 42 31.5 42H34.5C35.25 42 36 41.3438 36 40.5V37.5C36 36.75 35.25 36 34.5 36H31.5C30.6562 36 30 36.75 30 37.5V40.5Z" fill="white" fill-opacity="0.2" />
                                    </svg>
                                </div>
                                <div class="tft-travel__form__field__date field--title"><?php echo __('21', 'travelfic-toolkit'); ?></div>
                                <div class="tft-travel__form__field__mthyr">
                                    <span class="tft-travel__form__field__mthyr__mth form--span"><?php echo __('Aug', 'travelfic-toolkit'); ?></span>
                                    <span class="tft-travel__form__field__mthyr__yr form--span form--span__bold"><?php echo __('2022', 'travelfic-toolkit'); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="tft-travel__form__divider"></div>

                        <!-- Check-out -->
                        <div class="tft-travel__form__group">
                            <label for="tft-travel__form-checkout" class="tft-travel__form__label">
                                <?php echo __('Check-out', 'travelfic-toolkit'); ?>
                            </label>
                            <div class="tft-travel__form__field" id="checkoutField">
                                <input type="hidden" id="tft-travel__form-checkout" class="tft-travel__form__input" name="checkout" required>
                                <div class="tft-travel__form__field__icon">
                                    <svg width="42" height="48" viewBox="0 0 42 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 3V6H27V3C27 1.40625 28.3125 0 30 0C31.5938 0 33 1.40625 33 3V6H37.5C39.9375 6 42 8.0625 42 10.5V15H0V10.5C0 8.0625 1.96875 6 4.5 6H9V3C9 1.40625 10.3125 0 12 0C13.5938 0 15 1.40625 15 3ZM0 18H42V43.5C42 46.0312 39.9375 48 37.5 48H4.5C1.96875 48 0 46.0312 0 43.5V18ZM6 28.5C6 29.3438 6.65625 30 7.5 30H10.5C11.25 30 12 29.3438 12 28.5V25.5C12 24.75 11.25 24 10.5 24H7.5C6.65625 24 6 24.75 6 25.5V28.5ZM18 28.5C18 29.3438 18.6562 30 19.5 30H22.5C23.25 30 24 29.3438 24 28.5V25.5C24 24.75 23.25 24 22.5 24H19.5C18.6562 24 18 24.75 18 25.5V28.5ZM31.5 24C30.6562 24 30 24.75 30 25.5V28.5C30 29.3438 30.6562 30 31.5 30H34.5C35.25 30 36 29.3438 36 28.5V25.5C36 24.75 35.25 24 34.5 24H31.5ZM6 40.5C6 41.3438 6.65625 42 7.5 42H10.5C11.25 42 12 41.3438 12 40.5V37.5C12 36.75 11.25 36 10.5 36H7.5C6.65625 36 6 36.75 6 37.5V40.5ZM19.5 36C18.6562 36 18 36.75 18 37.5V40.5C18 41.3438 18.6562 42 19.5 42H22.5C23.25 42 24 41.3438 24 40.5V37.5C24 36.75 23.25 36 22.5 36H19.5ZM30 40.5C30 41.3438 30.6562 42 31.5 42H34.5C35.25 42 36 41.3438 36 40.5V37.5C36 36.75 35.25 36 34.5 36H31.5C30.6562 36 30 36.75 30 37.5V40.5Z" fill="white" fill-opacity="0.2" />
                                    </svg>
                                </div>
                                <div class="tft-travel__form__field__date field--title"><?php echo __('21', 'travelfic-toolkit'); ?></div>
                                <div class="tft-travel__form__field__mthyr">
                                    <span class="tft-travel__form__field__mthyr__mth form--span"><?php echo __('Aug', 'travelfic-toolkit'); ?></span>
                                    <span class="tft-travel__form__field__mthyr__yr form--span form--span__bold"><?php echo __('2022', 'travelfic-toolkit'); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="tft-travel__form__divider"></div>

                        <!-- Adult Person -->
                        <div class="tft-travel__form__group">
                            <label for="tft-travel__form-adult" class="tft-travel__form__label">
                                <?php echo __('Adult Person', 'travelfic-toolkit'); ?>
                            </label>
                            <div class="tft-travel__form__field" id="adultField">
                                <input type="hidden" id="tft-travel__form-adult" class="tft-travel__form__input" name="adults" min="1" value="5" required>
                                <div class="tft-travel__form__field__icon">
                                    <svg width="42" height="48" viewBox="0 0 42 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M33 12C33 18.6562 27.5625 24 21 24C14.3438 24 9 18.6562 9 12C9 5.4375 14.3438 0 21 0C27.5625 0 33 5.4375 33 12ZM28.7812 28.7812C36.2812 30 42 36.4688 42 44.25V45C42 46.6875 40.5938 48 39 48H3C1.3125 48 0 46.6875 0 45V44.25C0 36.4688 5.625 30 13.125 28.7812L21 40.5L28.7812 28.7812Z" fill="white" fill-opacity="0.2" />
                                    </svg>
                                </div>
                                <div class="tft-travel__form__field__date field--title"><?php echo __('5', 'travelfic-toolkit'); ?></div>
                                <div class="tft-travel__form__field__incdec">
                                    <span class="tft-travel__form__field__incdre__inc form--span" id="incFieldVal">+</span>
                                    <span class="tft-travel__form__field__incdre__dec form--span" id="decFieldVal">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="tft-travel__form__divider"></div>

                        <!-- Children -->
                        <div class="tft-travel__form__group">
                            <label for="tft-travel__form-children" class="tft-travel__form__label">
                                <?php echo __('Children', 'travelfic-toolkit'); ?>
                            </label>
                            <div class="tft-travel__form__field" id="childrenField">
                                <input type="hidden" id="tft-travel__form-children" class="tft-travel__form__input" name="children" min="1" value="2">
                                <div class="tft-travel__form__field__icon">
                                    <svg width="42" height="48" viewBox="0 0 42 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M33 12C33 18.6562 27.5625 24 21 24C14.3438 24 9 18.6562 9 12C9 5.4375 14.3438 0 21 0C27.5625 0 33 5.4375 33 12ZM28.7812 28.7812C36.2812 30 42 36.4688 42 44.25V45C42 46.6875 40.5938 48 39 48H3C1.3125 48 0 46.6875 0 45V44.25C0 36.4688 5.625 30 13.125 28.7812L21 40.5L28.7812 28.7812Z" fill="white" fill-opacity="0.2" />
                                    </svg>
                                </div>
                                <div class="tft-travel__form__field__date field--title"><?php echo __('2', 'travelfic-toolkit'); ?></div>
                                <div class="tft-travel__form__field__incdec">
                                    <span class="tft-travel__form__field__incdre__inc form--span" id="incFieldVal">+</span>
                                    <span class="tft-travel__form__field__incdre__dec form--span" id="decFieldVal">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tft-travel__form__fieldset__right">
                        <!-- Submit Button -->
                        <button type="submit" class="tft-travel__form__submit tft-btn">
                            <?php echo __('Search Now', 'travelfic-toolkit'); ?>
                            <svg class="tft-travel__form__submit__icon" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.75 14.7188L11.5625 10.5312C12.4688 9.4375 12.9688 8.03125 12.9688 6.5C12.9688 2.9375 10.0312 0 6.46875 0C2.875 0 0 2.9375 0 6.5C0 10.0938 2.90625 13 6.46875 13C7.96875 13 9.375 12.5 10.5 11.5938L14.6875 15.7812C14.8438 15.9375 15.0312 16 15.25 16C15.4375 16 15.625 15.9375 15.75 15.7812C16.0625 15.5 16.0625 15.0312 15.75 14.7188ZM1.5 6.5C1.5 3.75 3.71875 1.5 6.5 1.5C9.25 1.5 11.5 3.75 11.5 6.5C11.5 9.28125 9.25 11.5 6.5 11.5C3.71875 11.5 1.5 9.28125 1.5 6.5Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

<?php
}
