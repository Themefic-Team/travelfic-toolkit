<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Travelfic_Toolkit_Template_SYNC {

    private $api_url = 'https://api.themefic.com/tourfic/api/';
    private $args = array();
    private $responsed = false; 
    private $error_message = ''; 


    public function __construct() { 
    
        add_action( 'wp_ajax_travelfic-template-list-sync', array( $this, 'travelfic_template_sync__schudle_callback' ) );
        
        if( empty(get_option('travelfic_template_sync__schudle_data')) ){
            add_action('init', array($this, 'travelfic_template_sync__schudle_callback'));
        }
    }

    public function travelfic_toolkit_get_api_response(){
        $query_params = array(
            'plugin' => 'travelfic_toolkit', 
        );
        $response = wp_remote_post($this->api_url, array(
            'body'    => wp_json_encode($query_params),
            'headers' => array('Content-Type' => 'application/json'),
        )); 
        if (is_wp_error($response)) {
            // Handle API request error
            $this->responsed = false;
            $this->error_message = esc_html($response->get_error_message());
 
        } else {
            // API request successful, handle the response content
            $data = wp_remote_retrieve_body($response);
            $this->responsed = json_decode($data, true); 
            update_option( 'travelfic_template_sync__schudle_data', $this->responsed);
            
        } 
    }

    public function travelfic_template_sync__schudle_callback() {  
        // Only check nonce during AJAX
        if ( wp_doing_ajax() ) {
            check_ajax_referer( 'updates', '_ajax_nonce' );

            if ( ! current_user_can( 'manage_options' ) ) {
                wp_send_json_error( 'Unauthorized', 403 );
            }
        }
        
        $this->travelfic_toolkit_get_api_response();
    }
 
}

new Travelfic_Toolkit_Template_SYNC();