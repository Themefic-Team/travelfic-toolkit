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
}
if ( ! is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	add_action('wp_ajax_contact-form-7_ajax_install_plugin', 'wp_ajax_install_plugin');
}
if ( ! is_plugin_active( 'tourfic/tourfic.php' ) ) {
	add_action('wp_ajax_tourfic_ajax_install_plugin', 'wp_ajax_install_plugin');
}

if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
	add_action('wp_ajax_elementor_ajax_install_plugin', 'wp_ajax_install_plugin');
}

add_action('wp_ajax_travelfic_toolkit_ajax_active_plugin', 'install_activate_plugin_demo_import_callback');

function install_activate_plugin_demo_import_callback() {

    check_ajax_referer('updates', '_ajax_nonce');
    // Check user capabilities
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('Permission denied');
    }

    // activate the plugin
    $plugin_slug = sanitize_text_field( wp_unslash($_POST['slug']) );
    if("contact-form-7"==$plugin_slug){
        $result = activate_plugin($plugin_slug.'/wp-'.$plugin_slug.'.php');
    }else{
        $result = activate_plugin($plugin_slug.'/'.$plugin_slug.'.php');
    }

    if (is_wp_error($result)) {
        wp_send_json_error('Error: ' . $result->get_error_message());
    } else {
        wp_send_json_success('Plugin installed and activated successfully!');
    }

    wp_die();

}