<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Travelfic_Toolkit_Template_SYNC {

    private $api_url = 'https://api.themefic.com/tourfic/api/';
    public function __construct() { 
        add_action( 'wp_ajax_travelfic-template-list-sync', array( $this, 'travelfic_template_sync__schudle_callback' ) );
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
            return $response;
        }

        if ( 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
            return new WP_Error( 'travelfic_toolkit_template_sync_failed', __( 'The template library is unavailable.', 'travelfic-toolkit' ) );
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( ! is_array( $data ) || empty( $data ) ) {
            return new WP_Error( 'travelfic_toolkit_template_sync_invalid', __( 'The template library returned invalid data.', 'travelfic-toolkit' ) );
        }

        $templates = array();
        foreach ( $data as $template ) {
            if ( ! is_array( $template ) || ! isset( $template['title'], $template['template_type'] ) ||
                ! is_string( $template['title'] ) || ! is_string( $template['template_type'] ) ) {
                continue;
            }

            $coming_soon = ! empty( $template['coming_soon'] );
            $demo = isset( $template['demo'] ) && is_scalar( $template['demo'] )
                ? sanitize_key( (string) $template['demo'] ) : '';
            if ( ! $coming_soon && '' === $demo ) {
                continue;
            }

            $templates[] = array(
                'title'              => sanitize_text_field( $template['title'] ),
                'template_type'      => sanitize_text_field( $template['template_type'] ),
                'demo'               => $demo,
                'template_image_url' => isset( $template['template_image_url'] ) && is_string( $template['template_image_url'] ) ? esc_url_raw( $template['template_image_url'] ) : '',
                'demo_url'           => isset( $template['demo_url'] ) && is_string( $template['demo_url'] ) ? esc_url_raw( $template['demo_url'] ) : '',
                'featured_title'     => isset( $template['featured_title'] ) && is_scalar( $template['featured_title'] ) ? sanitize_text_field( (string) $template['featured_title'] ) : '',
                'coming_soon'        => $coming_soon,
            );
        }

        if ( ! $templates ) {
            return new WP_Error( 'travelfic_toolkit_template_sync_invalid', __( 'The template library returned invalid data.', 'travelfic-toolkit' ) );
        }

        update_option( 'travelfic_template_sync__schudle_data', $templates );

        return $templates;
    }

    public function travelfic_template_sync__schudle_callback() {  
        check_ajax_referer( 'travelfic_toolkit_template_sync', '_ajax_nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You cannot sync the template library.', 'travelfic-toolkit' ), 403 );
        }

        $result = $this->travelfic_toolkit_get_api_response();
        if ( is_wp_error( $result ) ) {
            wp_send_json_error( $result->get_error_message(), 502 );
        }

        wp_send_json_success( $result );
    }
 
}

new Travelfic_Toolkit_Template_SYNC();
