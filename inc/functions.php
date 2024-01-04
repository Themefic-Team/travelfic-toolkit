<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

//option function
if( ! function_exists('travelfic_get_meta') ){
    function travelfic_get_meta( $id, $key, $attr=''){
        if( !empty($attr)){
            $data = get_post_meta( $id, $key, true )[$attr];
        }else{
            $data = get_post_meta( $id, $key, true );
        }
        return $data;
    }
}

// Text Limit 
if( ! function_exists('travelfic_character_limit') ){
    function travelfic_character_limit($str, $limit)
    {
        if(strlen($str) > $limit ){
        	return substr($str, 0, $limit) . '...';
		}else{
			return $str;
		}
    }
}

if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	add_action('wp_ajax_woocommerce_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_woocommerce_ajax_active_plugin', 'travelfic_toolkit_woocommerce_activate_plugin_callback');
}
if ( ! is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	add_action('wp_ajax_contact-form-7_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_contact-form-7_ajax_active_plugin', 'travelfic_toolkit_cf7_activate_plugin_callback');
}
if ( ! is_plugin_active( 'tourfic/tourfic.php' ) ) {
	add_action('wp_ajax_tourfic_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_tourfic_ajax_active_plugin', 'travelfic_toolkit_tourfic_activate_plugin_callback');
}

if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
	add_action('wp_ajax_elementor_ajax_install_plugin', 'wp_ajax_install_plugin');
    add_action('wp_ajax_elementor_ajax_active_plugin', 'travelfic_toolkit_elementor_activate_plugin_callback');
}

function travelfic_toolkit_cf7_activate_plugin_callback() {
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }

    // activate the plugin
    $activate_plugin = activate_plugin('contact-form-7/wp-contact-form-7.php');
    $cf7_activate_plugin = activate_plugin('contact-form-7/wp-contact-form-7.php');

    if(is_plugin_active( 'contact-form-7/wp-contact-form-7.php' )){
        wp_send_json_success('contact-form-7 activated successfully.');
    }else{
        $result = activate_plugin('contact-form-7/wp-contact-form-7.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('contact-form-7 activated successfully!');
        }
    }
    wp_die();
}

function travelfic_toolkit_tourfic_activate_plugin_callback() {
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }
    //Activation
    $activate_plugin = activate_plugin('tourfic/tourfic.php');
    $tourfic_activate_plugin = activate_plugin('tourfic/tourfic.php');

    if(is_plugin_active( 'tourfic/tourfic.php' )){
        wp_send_json_success('tourfic activated successfully.');
    }else{
        $result = activate_plugin('tourfic/tourfic.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('tourfic activated successfully!');
        }
    }
    wp_die();
}

function travelfic_toolkit_elementor_activate_plugin_callback() {
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }
    //Activation
    $activate_plugin = activate_plugin('elementor/elementor.php');
    $elementor_activate_plugin = activate_plugin('elementor/elementor.php');

    if(is_plugin_active( 'elementor/elementor.php' )){
        wp_send_json_success('elementor activated successfully.');
    }else{
        $result = activate_plugin('elementor/elementor.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('elementor activated successfully!');
        }
    }
    wp_die();
}

function travelfic_toolkit_woocommerce_activate_plugin_callback() {
    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }
    //Activation
    $activate_plugin = activate_plugin('woocommerce/woocommerce.php');
    $woocommerce_activate_plugin = activate_plugin('woocommerce/woocommerce.php');

    if(is_plugin_active( 'woocommerce/woocommerce.php' )){
        wp_send_json_success('woocommerce activated successfully.');
    }else{
        $result = activate_plugin('woocommerce/woocommerce.php');
        if (is_wp_error($result)) {
            wp_send_json_error('Error: ' . $result->get_error_message());
        } else {
            wp_send_json_success('woocommerce activated successfully!');
        }
    }
    wp_die();
}