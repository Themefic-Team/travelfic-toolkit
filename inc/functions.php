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

    //Activation
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
            if ($archive_transparent_header) {
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
                    esc_html(_nx('%1$s review', '%1$s reviews', $number, 'comments title', 'travelfic-toolkit')),
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

        $output = '<span class="tft-destination-rating tft-color-primary">';
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

// Load elementor background image based on travelfic template version
$travelfic_template_version = get_option('travelfic_template_version');

if ('5' === $travelfic_template_version) {
    add_action('wp_head', 'travelfic_load_elementor_background_image');

    function travelfic_load_elementor_background_image()
    {

        global $post;
        if (!$post) return;

        // get elementor data and set section background image 
        $elementor_content = get_post_meta($post->ID, '_elementor_data', true);

        if (!empty($elementor_content)) {
            $decoded_elementor_data = json_decode($elementor_content, true);

            $custom_css = '';

            if (!function_exists('find_background_images_with_ids')) {
                function find_background_images_with_ids($section, &$styles = [],  $allowed_ids = [])
                {
                    // Check if the section has a background image
                    if (
                        isset($section['settings']['background_background']) && $section['settings']['background_background'] === 'classic' &&
                        isset($section['id']) &&
                        (empty($allowed_ids) || in_array($section['id'], $allowed_ids))
                    ) {
                        if (isset($section['settings']['background_image']['url'])) {
                            $styles[] = [
                                'id' => $section['id'],
                                'url' => $section['settings']['background_image']['url'],
                            ];
                        }
                    }

                    // Check for nested elements
                    if (isset($section['elements']) && is_array($section['elements'])) {
                        foreach ($section['elements'] as $element) {
                            find_background_images_with_ids($element, $styles, $allowed_ids);
                        }
                    }
                }
            }

            // Define allowed section IDs for background images
            $allowed_ids  = ['ee8cb50', '22c3630', '148ca43', '99b082f', '85c5d54', '8868479', '8635b55'];

            // Collect all background images with their IDs
            $styles = [];
            foreach ($decoded_elementor_data as $section) {
                find_background_images_with_ids($section, $styles, $allowed_ids);
            }

            // Generate CSS for each section
            foreach ($styles as $style) {
                $custom_css .= '.elementor-element-' . esc_attr($style['id']) . ' {
                background-image: url("' . esc_url($style['url']) . '");
            }';
            }

            // Output the generated CSS
            if (!empty($custom_css)) {
                echo '<style>' . $custom_css . '</style>';
            }
        }
    }
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tft_body_classes( $classes ) {
	
	$theme = wp_get_theme(); 
	if ( 'Travelfic' != $theme->name || 'Travelfic' != $theme->parent_theme ) {
		$classes[] = 'tft-site-main-body';
	}

	return $classes;
}
add_filter( 'body_class', 'tft_body_classes' );


/** 
 * 
 * Travelfic Current Year Shortcode
 * 
*/
function travelfic_current_year() {
    return date('Y');
}
add_shortcode('year', 'travelfic_current_year');


/** 
 * 
 * Travelfic Import Elementor Background Images
 * 
*/
add_action( 'wp_head', function () {
   $background_images = get_option('travelfic_elementor_background_images', array());
   if(isset($background_images['css_rules'])){
       $background_images['css_rules'] = str_replace("\n", '', $background_images['css_rules']);
       echo '<style type="text/css" id="travelfic_elementor_background_images">' . $background_images['css_rules'] . '</style>';
   }
});
