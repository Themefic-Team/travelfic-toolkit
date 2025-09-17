<?php
defined( 'ABSPATH' ) || exit;
/**
 * Travelfic Importer Class
 * @since 1.0.0
 * @author Jahid
 */
if ( ! class_exists( 'Travelfic_Template_Importer' ) ) {
	class Travelfic_Template_Importer {

		private static $instance = null;
        private $generated_css = '';
        private $processed_ids = [];

		/**
		 * Singleton instance
		 * @since 1.0.0
		 */
		public static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function __construct() {
			add_action( 'wp_ajax_travelfic-global-settings-import', array( $this, 'prepare_travelfic_global_settings' ) );
			add_action( 'wp_ajax_travelfic-customizer-settings-import', array( $this, 'prepare_travelfic_customizer_settings' ) );
			add_action( 'wp_ajax_travelfic-demo-hotel-import', array( $this, 'prepare_travelfic_hotel_imports' ) );
			add_action( 'wp_ajax_travelfic-demo-tour-import', array( $this, 'prepare_travelfic_tour_imports' ) );
			add_action( 'wp_ajax_travelfic-demo-car-import', array( $this, 'prepare_travelfic_car_imports' ) );
			add_action( 'wp_ajax_travelfic-demo-pages-import', array( $this, 'prepare_travelfic_pages_imports' ) );
			add_action( 'wp_ajax_travelfic-demo-widget-import', array( $this, 'prepare_travelfic_widgets_imports' ) );
			add_action( 'wp_ajax_travelfic-demo-menu-import', array( $this, 'prepare_travelfic_menus_imports' ) );
			add_action( 'wp_head', array( $this, 'prepare_travelfic_elementor_background_images' ));
		}

		/**
		 * Tourfic Global Settings
		 */
		public function prepare_travelfic_global_settings() {
            check_ajax_referer('updates', '_ajax_nonce');
            $template_key = !empty($_POST['template_version']) ? sanitize_key( $_POST['template_version'] ) : 1;
            $demo_data_url = 'https://api.themefic.com/tourfic/demos/v'.$template_key.'/settings-v2.json';
            $settings_files = wp_remote_get( $demo_data_url );
            $imported_data = wp_remote_retrieve_body($settings_files);

            if (!empty($imported_data)) {
                $imported_data = json_decode( $imported_data, true );
                $tf_search_page = get_page_by_path('tf-search');
                if($tf_search_page && !empty($tf_search_page->ID)){
                    if(isset($imported_data['search-result-page'])){
                        $imported_data['search-result-page'] = $tf_search_page->ID;
                    }
                }
                update_option( 'tf_settings', $imported_data );
                wp_send_json_success($imported_data);
                die();
            }
		}

        /**
		 * Tourfic Customizer Importer Settings
		 */
		public function prepare_travelfic_customizer_settings() {
            check_ajax_referer('updates', '_ajax_nonce');
            remove_theme_mods();
            $prefix = 'travelfic_customizer_settings_';
            $template_key = !empty($_POST['template_version']) ? sanitize_key( $_POST['template_version'] ) : 1;
            $demo_data_url = 'https://api.themefic.com/tourfic/demos/v'.$template_key.'/customizer.json';
            $customizers_files = wp_remote_get( $demo_data_url );
            $imported_data = wp_remote_retrieve_body($customizers_files);

            // tourfic color palette
            $tf_settings = ! empty( get_option( 'tf_settings') ) ? get_option( 'tf_settings') : [];
            $tf_color_palette = isset($tf_settings['color-palette-template']) ? $tf_settings['color-palette-template'] : '';


            if (!empty($imported_data)) {
                $imported_data = json_decode( $imported_data, true );

                // site title
                if (isset($imported_data['blogname']) && !empty($imported_data['blogname'])) {
                    update_option('blogname', $imported_data['blogname']);
                }

                // site tagline
                if (isset($imported_data['blogdescription']) && !empty($imported_data['blogdescription'])) {
                    update_option('blogdescription', $imported_data['blogdescription']); 
                }

                // site icon
                if (isset($imported_data['site_icon_url']) && !empty($imported_data['site_icon_url'])) {
                    $icon_id = $this->travelfic_import_image($imported_data['site_icon_url']);
                    if ($icon_id) {
                        update_option('site_icon', $icon_id);
                    }
                }

                if (isset($imported_data[ $prefix . 'design_2_login_url' ]) && !empty($imported_data[ $prefix . 'design_2_login_url' ])) {
                    $imported_data[ $prefix . 'design_2_login_url' ] = trailingslashit(site_url()) . ltrim($imported_data[ $prefix . 'design_2_login_url' ], '/');
                }

                if (isset($imported_data[ $prefix . 'design_2_registration_url' ]) && !empty($imported_data[ $prefix . 'design_2_registration_url' ])) {
                    $imported_data[ $prefix . 'design_2_registration_url' ] = trailingslashit(site_url()) . ltrim($imported_data[ $prefix . 'design_2_registration_url' ], '/');
                }

                if (isset($imported_data[ $prefix . 'design_3_login_url' ]) && !empty($imported_data[ $prefix . 'design_3_login_url' ])) {
                    $imported_data[ $prefix . 'design_3_login_url' ] = trailingslashit(site_url()) . ltrim($imported_data[ $prefix . 'design_3_login_url' ], '/');
                }


                // // header menu color
                // if(isset($imported_data['travelfic_customizer_settings_menu_color'])){
                //     $imported_data['travelfic_customizer_settings_header_menu_color']['normal'] = $imported_data['travelfic_customizer_settings_menu_color'];
                // }
                // if(isset($imported_data['travelfic_customizer_settings_menu_hover_color'])){
                //     $imported_data['travelfic_customizer_settings_header_menu_color']['hover'] = $imported_data['travelfic_customizer_settings_menu_hover_color'];
                // }

                // // header submenu color
                // if(isset($imported_data['travelfic_customizer_settings_submenu_text_color'])){
                //     $imported_data['travelfic_customizer_settings_header_submenu_color']['normal'] = $imported_data['travelfic_customizer_settings_submenu_text_color'];
                // }
                // if(isset($imported_data['travelfic_customizer_settings_submenu_text_hover_color'])){
                //     $imported_data['travelfic_customizer_settings_header_submenu_color']['hover'] = $imported_data['travelfic_customizer_settings_submenu_text_hover_color'];
                // }

                // // transparent menu color
                // if(isset($imported_data['travelfic_customizer_settings_transparent_menu_color'])){
                //     $imported_data['travelfic_customizer_settings_transparent_header_menu_color']['normal'] = $imported_data['travelfic_customizer_settings_transparent_menu_color'];
                // }
                // if(isset($imported_data['travelfic_customizer_settings_transparent_menu_hover_color'])){
                //     $imported_data['travelfic_customizer_settings_transparent_header_menu_color']['hover'] = $imported_data['travelfic_customizer_settings_transparent_menu_hover_color'];
                // }

                // // transparent submenu color
                // if(isset($imported_data['travelfic_customizer_settings_transparent_submenu_text_color'])){
                //     $imported_data['travelfic_customizer_settings_transparent_submenu_color']['normal'] = $imported_data['travelfic_customizer_settings_transparent_submenu_text_color'];
                // }
                // if(isset($imported_data['travelfic_customizer_settings_transparent_submenu_text_hover_color'])){
                //     $imported_data['travelfic_customizer_settings_transparent_submenu_color']['hover'] = $imported_data['travelfic_customizer_settings_transparent_submenu_text_hover_color'];
                // }

                // // Archive transparent header
                // if( isset($imported_data['travelfic_customizer_settings_archive_transparent_header']) && $imported_data['travelfic_customizer_settings_archive_transparent_header'] === 'disabled'){
                //     $imported_data['travelfic_customizer_settings_archive_transparent_header'] = false;
                // }else{
                //     $imported_data['travelfic_customizer_settings_archive_transparent_header'] = true;
                // }

                // // transparent header
                // if(isset($imported_data['travelfic_customizer_settings_transparent_header']) && $imported_data['travelfic_customizer_settings_transparent_header'] === 'disabled'){
                //     $imported_data['travelfic_customizer_settings_transparent_header'] = false;
                // }else{
                //     $imported_data['travelfic_customizer_settings_transparent_header'] = true;
                // }

                // // footer heading color
                // if(isset($imported_data['travelfic_customizer_settings_footer_text_color'])){
                //     $imported_data['travelfic_customizer_settings_footer_heading_color'] = $imported_data['travelfic_customizer_settings_footer_text_color'];
                // }

                // color palette
                $palette_choices = array(
                    'design-1' => ['#0E3DD8', '#003C7A', '#686E7A', '#060D1C'],
                    'design-2' => ['#B58E53', '#917242', '#99948D', '#595349'],
                    'custom' => ['#fa6400', '#0e3dd8', '#686e7a', '#060d1c'],
                );

                $color_palette_key = $prefix . 'color_palette';
                
                switch ($template_key) {
                    case '4':
                        $selected_palette = 'design-1';
                        $tf_color_palette = 'design-1';
                        break;
                    case '5':
                        $selected_palette = 'custom';
                        $tf_color_palette = 'custom';
                        break;
                    default:
                        $selected_palette = 'design-2';
                        $tf_color_palette = 'design-2';
                        break;
                }

                $imported_data[$color_palette_key] = $selected_palette;

                if( isset($palette_choices[$selected_palette]) ){
                    $imported_data[$prefix .'primary_color']    = $palette_choices[$selected_palette][0];
                    $imported_data[$prefix .'secondary_color']  = $palette_choices[$selected_palette][1];
                    $imported_data[$prefix .'body_text_color']  = $palette_choices[$selected_palette][2];
                    $imported_data[$prefix .'heading_color']    = $palette_choices[$selected_palette][3];
                }

                foreach ($imported_data as $key => $value) {
                    set_theme_mod($key, $value);
                }

                $tf_settings['color-palette-template'] = $tf_color_palette;
                update_option('tf_settings', $tf_settings);

                die();
            }
		}

        /**
         * Import image from URL but prevent duplicates
         */
        function travelfic_import_image( $image_url, $post_id = 0 ) {
            if ( empty( $image_url ) ) {
                return false;
            }

            // Extract filename
            $filename = basename( parse_url( $image_url, PHP_URL_PATH ) );

            $tmp = download_url( $image_url );
            if ( is_wp_error( $tmp ) ) {
                return false;
            }

            $file_hash = md5_file( $tmp );
            $existing = get_posts( array(
                'post_type'   => 'attachment',
                'post_status' => 'inherit',
                'meta_key'    => '_file_hash',
                'meta_value'  => $file_hash,
                'numberposts' => 1,
                'fields'      => 'ids',
            ) );

            if ( ! empty( $existing ) ) {
                @unlink( $tmp ); // cleanup temp file
                return $existing[0];
            }

            $file_array = array(
                'name'     => $filename,
                'tmp_name' => $tmp,
            );

            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';

            $attach_id = media_handle_sideload( $file_array, $post_id );

            if ( is_wp_error( $attach_id ) ) {
                @unlink( $file_array['tmp_name'] );
                return false;
            }

            // Save file hash for future duplicate checks
            update_post_meta( $attach_id, '_file_hash', $file_hash );

            return $attach_id;
        }

        /**
		 * Tourfic Pages Importer Settings
		 */
		public function prepare_travelfic_pages_imports() {

            check_ajax_referer('updates', '_ajax_nonce');
            $template_key = !empty($_POST['template_version']) ? sanitize_key( $_POST['template_version'] ) : 1;

            update_option('travelfic_template_version', $template_key);
            $demo_forms_data_url = 'https://api.themefic.com/tourfic/demos/v'.$template_key.'/forms.json';
            $forms_files = wp_remote_get( $demo_forms_data_url );
            $forms_imported_data = wp_remote_retrieve_body($forms_files);
            if (!empty($forms_imported_data)) {
                $forms_imported_data = json_decode( $forms_imported_data, true );
                foreach($forms_imported_data as $form){

                    $form_title = !empty($form['title']) ? $form['title'] : '';
                    $form_properties = !empty($form['properties']) ? json_decode($form['properties'],true) : '';
                    // tf_var_dump($form_properties);
                    if ( class_exists( 'WPCF7' ) ) {
                        $contact_form = WPCF7_ContactForm::get_template(
                            array( 
                                'title' => $form_title,
                            )
                        ); 
                        $contact_form->set_properties($form_properties);
                        $contact_form->save();
                    }
                }
            }
            
            $demo_data_url = 'https://api.themefic.com/tourfic/demos/v'.$template_key.'/pages.json';
            $pages_files = wp_remote_get( $demo_data_url );
            $imported_data = wp_remote_retrieve_body($pages_files);

            // existing pages to delete
            if (!empty($imported_data)) {
                $imported_data = json_decode( $imported_data, true );
                foreach ($imported_data as $page) {
                    $title = !empty($page['title']) ? $page['title'] : '';
                    if (!empty($title)) {
                        // Find any existing pages with this title
                        $existing_pages = get_posts(array(
                            'post_type' => 'page',
                            'title' => $title,
                            'post_status' => 'any',
                            'numberposts' => -1
                        ));
                        
                        // Delete all found pages
                        foreach ($existing_pages as $existing_page) {
                            if (get_option('page_on_front') == $existing_page->ID) {
                                update_option('page_on_front', 0);
                            }
                            if (get_option('page_for_posts') == $existing_page->ID) {
                                update_option('page_for_posts', 0);
                            }
                            wp_delete_post($existing_page->ID, true);
                        }
                    }
                }

                foreach($imported_data as $page){
                    $is_front = !empty($page['is_front']) ? $page['is_front'] : '';
                    $is_blog = !empty($page['is_blog']) ? $page['is_blog'] : '';
                    $title = !empty($page['title']) ? $page['title'] : '';
                    $content = !empty($page['content']) ? $page['content'] : '';
                    $tft_header_bg =  !empty($page['tft-pmb-background-img']) ? $page['tft-pmb-background-img'] : '';
                    $pages_images = $page['media_urls'];

                    $elementor_data = !empty($page['_elementor_data']) ? $page['_elementor_data'] : [];
                
                    $elementor_content =  !empty($page['_elementor_data']) ? wp_slash(wp_json_encode($page['_elementor_data'])) : '';

                    if(!empty($pages_images)){
                        $media_urls = explode(", ", $pages_images);
                        $update_media_url = [];

                        foreach($media_urls as $media){
                            if(!empty($media)){

                                // Download the image file
                                $page_image_data = file_get_contents( $media );
                                $page_filename   = basename( $media );
                                $page_upload_dir = wp_upload_dir();
                                $page_image_path = $page_upload_dir['path'] . '/' . $page_filename;
                        
                                // Save the image file to the uploads directory
                                file_put_contents( $page_image_path, $page_image_data );
                                
                                if (file_exists($page_image_path)) {
                                    // Create the attachment for the uploaded image
                                    $page_attachment = array(
                                        'guid'           => $page_upload_dir['url'] . '/' . $page_filename,
                                        'post_mime_type' => mime_content_type($page_upload_dir['path'] . '/' . $page_filename),
                                        'post_title'     => preg_replace( '/\.[^.]+$/', '', $page_filename ),
                                        'post_content'   => '',
                                        'post_status'    => 'inherit'
                                    );
                                    // Insert the attachment
                                    $page_attachment_id = wp_insert_attachment( $page_attachment, $page_image_path );                       
                        
                                    // Include the necessary file for media_handle_sideload().
                                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                        
                                    // Generate the attachment metadata
                                    $page_attachment_data = wp_generate_attachment_metadata( $page_attachment_id, $page_image_path );
                                    wp_update_attachment_metadata( $page_attachment_id, $page_attachment_data );
                        
                                    $update_media_url[wp_get_attachment_url($page_attachment_id)] = $media;
                                }
                            }
                        }
                        foreach ($update_media_url as $local_url => $old_url) {
                            $elementor_content = str_replace($old_url, $local_url, $elementor_content);
                        }
                    }
                    
                    // Process Elementor data to find and replace background images
                    if (!empty($elementor_data)) {
                        foreach ($elementor_data as &$element) {
                          $this->prepare_travelfic_elementor_background_images($element);
                        }
                    }
    

                    if(!empty($tft_header_bg)){
                        // Download the image file
                        $page_image_data = file_get_contents( $tft_header_bg );
                        $page_filename   = basename( $tft_header_bg );
                        $page_upload_dir = wp_upload_dir();
                        $page_image_path = $page_upload_dir['path'] . '/' . $page_filename;
                
                        // Save the image file to the uploads directory
                        file_put_contents( $page_image_path, $page_image_data );
                        
                        if (file_exists($page_image_path)) {
                            // Create the attachment for the uploaded image
                            $page_attachment = array(
                                'guid'           => $page_upload_dir['url'] . '/' . $page_filename,
                                'post_mime_type' => mime_content_type($page_upload_dir['path'] . '/' . $page_filename),
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', $page_filename ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert the attachment
                            $page_attachment_id = wp_insert_attachment( $page_attachment, $page_image_path );                       
                
                            // Include the necessary file for media_handle_sideload().
                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                
                            // Generate the attachment metadata
                            $page_attachment_data = wp_generate_attachment_metadata( $page_attachment_id, $page_image_path );
                            wp_update_attachment_metadata( $page_attachment_id, $page_attachment_data );
                
                            $tft_header_bg = wp_get_attachment_url($page_attachment_id);
                        }
                    }


                    // Create a new page programmatically
                    $new_page = array(
                        'post_title' => $title,
                        'post_content' => $content,
                        'post_status' => 'publish',
                        'post_type' => 'page'
                    );


                 
                    // Insert the page into the database
                    $new_page_id = wp_insert_post($new_page);
                    if(!empty($is_front)){
                        update_option( 'page_on_front', $new_page_id );
                        update_option( 'show_on_front', 'page' );
                    }

                    if(!empty($is_blog)){
                        update_option( 'page_for_posts', $new_page_id );
                    }

                    if(!empty($page['_wp_page_template'])){
                        update_post_meta($new_page_id, 'tft-pmb-disable-sidebar', $page['tft-pmb-disable-sidebar']);
                        update_post_meta($new_page_id, 'tft-pmb-banner', $page['tft-pmb-banner']);
                        update_post_meta($new_page_id, 'tft-pmb-transfar-header', $page['tft-pmb-transfar-header']);
                        update_post_meta($new_page_id, '_wp_page_template', $page['_wp_page_template']);
                        update_post_meta($new_page_id, 'tft-pmb-background-img', $tft_header_bg);
                        update_post_meta($new_page_id, 'tft-pmb-subtitle', $page['tft-pmb-subtitle']);
                        update_post_meta($new_page_id, '_elementor_template_type', $page['_elementor_template_type']);
                        update_post_meta($new_page_id, '_elementor_data', $elementor_content);
                        update_post_meta($new_page_id, '_elementor_page_assets', $page['_elementor_page_assets']);
                        update_post_meta($new_page_id, '_elementor_edit_mode', $page['_elementor_edit_mode']);
                    }
                }
                
                delete_option('_elementor_global_css');
		        delete_option('elementor-custom-breakpoints-files');
            }

            // Update the elementor global colors
            $elementor_kit_id = get_option('elementor_active_kit');
            $settings = get_post_meta($elementor_kit_id, '_elementor_page_settings', true);

            // Ensure settings is an array
            if (!is_array($settings)) {
                $settings = [];
            }

            // Define palettes
            $color_palette = [
                'design-1' => ['#B58E53', '#917242', '#99948D', '#B58E53'],
                'design-2' => ['#0E3DD8', '#003C7A', '#686E7A', '#0E3DD8'],
                'design-3' => ['#fa6400', '#0e3dd8', '#686e7a', '#fa6400'],
            ];

            // Fallback to design-1
            switch ($template_key) {
                case '5':
                    $selected = 'design-3';
                    break;
                case '4':
                    $selected = 'design-2';
                    break;
                default:
                    $selected = 'design-1';
            }

            list($primary_color, $secondary_color, $text_color, $accent_color) = $color_palette[$selected];

            // Update colors
            $settings['system_colors'] = [
                ['_id' => 'primary',   'title' => 'Primary',   'color' => $primary_color],
                ['_id' => 'secondary', 'title' => 'Secondary', 'color' => $secondary_color],
                ['_id' => 'text',      'title' => 'Text',      'color' => $text_color],
                ['_id' => 'accent',    'title' => 'Accent',    'color' => $accent_color],
            ];

            update_post_meta($elementor_kit_id, '_elementor_page_settings', $settings);
            die();

		}

        public function prepare_travelfic_elementor_background_images($element) {
            $this->generated_css = '';
            $this->check_element_for_background($element);
        
            if (!empty($this->generated_css)) {
                // Get existing data
                $existing_data = get_option('travelfic_elementor_background_images', array());
                
                // If no existing data, create new structure
                if (empty($existing_data)) {
                    $background_data = array(
                        'css_rules' => $this->generated_css,
                        'timestamp' => current_time('mysql'),
                    );
                } else {
                    // Process existing CSS rules to remove duplicates for the same element IDs
                    $existing_rules = $this->remove_duplicate_rules($existing_data['css_rules'], $this->generated_css);
                    
                    $background_data = array(
                        'css_rules' => $existing_rules . "\n" . $this->generated_css,
                        'timestamp' => current_time('mysql'),
                    );
                }

                update_option('travelfic_elementor_background_images', $background_data, false);
            }
        }

        // Helper function to remove duplicate rules for the same element IDs
        private function remove_duplicate_rules($existing_css, $new_css) {
            // Extract all element IDs from the new CSS
            preg_match_all('/\[data-id="([^"]+)"/', $new_css, $matches);
            $new_ids = array_unique($matches[1]);
            
            if (empty($new_ids)) {
                return $existing_css;
            }
            
            // Split existing rules into lines
            $existing_rules = explode('}', $existing_css);
            $filtered_rules = array();
            
            foreach ($existing_rules as $rule) {
                $keep_rule = true;
                
                // Check if this rule contains any of the new IDs
                foreach ($new_ids as $id) {
                    if (strpos($rule, '[data-id="' . $id . '"') !== false) {
                        $keep_rule = false;
                        break;
                    }
                }
                
                if ($keep_rule && trim($rule)) {
                    $filtered_rules[] = $rule . '}';
                }
            }
            
            return implode(' ', $filtered_rules);
        }

        // Recursive function to check for background images
        private function check_element_for_background($element) {
            if (!isset($element['id'])) {
                return false;
            }

            $element_id = $element['id'];

            $background_image = isset($element['settings']['background_image']['url']) ? $element['settings']['background_image']['url'] : '';
            $overlay_image = isset($element['settings']['background_overlay_image']['url'])  ? $element['settings']['background_overlay_image']['url'] : '';
            $selected_icon = isset($element['settings']['selected_icon']['value']['url']) ? $element['settings']['selected_icon']['value']['url'] : '';

            $has_background = !empty($background_image) || !empty($overlay_image) || !empty($selected_icon);

            if ($has_background) {
                // Generate CSS for main background
                if (!empty($background_image)) {
                    $this->generated_css .= sprintf(
                        '[data-id="%s"] { background-image: url("%s"); } ',
                        $element_id,
                        esc_url($background_image)
                    );
                }

                // Generate CSS for overlay
                if (!empty($overlay_image)) {
                    $this->generated_css .= sprintf(
                        '[data-id="%s"] { background-image: url("%s"); } ',
                        $element_id,
                        esc_url($overlay_image)
                    );
                }

                // Generate CSS for selected icon
                if (!empty($selected_icon)) {
                    $this->generated_css .= sprintf(
                        '[data-id="%s"] .elementor-icon { background-image: url("%s"); background-repeat: no-repeat; background-position: center center; } ',
                        $element_id,
                        esc_url($selected_icon)
                    );
                }
            }

            // Check nested elements
            if (isset($element['elements'])) {
                foreach ($element['elements'] as $child_element) {
                    $this->check_element_for_background($child_element);
                }
            }

            return true;
        }
      
        /**
		 * Tourfic Menu importer Settings
		 */
		public function prepare_travelfic_menus_imports() {
            check_ajax_referer('updates', '_ajax_nonce');
            $template_key = !empty($_POST['template_version']) ? sanitize_key( $_POST['template_version'] ) : 1;
            $demo_data_url = 'https://api.themefic.com/tourfic/demos/v'.$template_key.'/menu.txt';
            $serialized_menu = wp_remote_get( $demo_data_url );
            $serialized_menu = wp_remote_retrieve_body($serialized_menu);
            if (!empty($serialized_menu)) {
                $menu_items = unserialize($serialized_menu);
                self::travelfic_toolkit_create_menu_from_imported_data($menu_items, $template_key);
            }

            update_option('permalink_structure', '/%postname%/');
            flush_rewrite_rules();
            
            die();
        }
        public static function travelfic_toolkit_create_menu_from_imported_data($menu_data, $template_key) {
            $menu_name = 'Imported Main Menu';
            $menu_exists = wp_get_nav_menu_object($menu_name);
            if (!$menu_exists) {
                $menu_id = wp_create_nav_menu($menu_name);
            } else {
                $menu_id = $menu_exists->term_id;

                // Delete existing menu items
                $existing_items = wp_get_nav_menu_items($menu_id);
                if(!empty($existing_items)){
                    foreach ($existing_items as $item) {
                        wp_delete_post($item->ID, true);
                    }
                }
            }

            // Get the current site's URL and protocol
            $site_url = site_url();

            $template_key = $template_key;
            foreach ($menu_data as $menu_item) {
                // Process the URL
                $menu_item_url = $menu_item['url'];
                
                if ($menu_item_url !== '#') {
                    $menu_item_path = parse_url($menu_item_url, PHP_URL_PATH);
                    $menu_item_url  = rtrim($site_url, '/') . $menu_item_path;
                }

                $item_key = md5($menu_item['title'] . $menu_item_url);
                if(isset($added_items[$item_key])){
                    continue;
                }
                // Add top-level menu items.
                $menu_item_data = array(
                    'menu-item-title' => $menu_item['title'],
                    'menu-item-url' => $menu_item_url,
                    'menu-item-object' => 'custom',
                    'menu-item-parent' => 0,
                    'menu-item-type' => 'custom',
                    'menu-item-status' => 'publish'
                );

                // Insert the top-level menu item.
                $menu_item_id = wp_update_nav_menu_item($menu_id, 0, $menu_item_data);
                $added_items[$item_key] = $menu_item_id;
        
                if (!empty($menu_item['sub_menu'])) {
                    foreach ($menu_item['sub_menu'] as $sub_menu_item) {
                        // Process sub-menu URL
                        $sub_menu_item_url = $sub_menu_item['url'];
                        if ($sub_menu_item_url !== '#') {
                            $sub_menu_item_path = parse_url($sub_menu_item_url, PHP_URL_PATH);
                            $sub_menu_item_url  = rtrim($site_url, '/') . $sub_menu_item_path;
                        }

                        $sub_item_key = md5($sub_menu_item['title'] . $sub_menu_item_url);
                        if(isset($added_items[$sub_item_key])){
                            continue;
                        }

                        // Prepare data for sub-menu items.
                        $sub_menu_item_data = array(
                            'menu-item-title' => $sub_menu_item['title'],
                            'menu-item-url' => $sub_menu_item_url,
                            'menu-item-object' => 'custom',
                            'menu-item-parent-id' => $menu_item_id,
                            'menu-item-type' => 'custom',
                            'menu-item-status' => 'publish'
                        );
        
                        // Insert the sub-menu items.
                        wp_update_nav_menu_item($menu_id, 0, $sub_menu_item_data);
                        $added_items[$sub_item_key] = $menu_item_id;
                    }
                }
            }
        
            // Assign the created menu to a menu location.
            $locations = get_theme_mod('nav_menu_locations');
            $locations['primary_menu'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }

        function replace_menu_url($menu_item_url) {
            $parsed_url = parse_url($menu_item_url);
            $site_url = parse_url(site_url());

            // Replace scheme and host
            $parsed_url['scheme'] = $site_url['scheme'];
            $parsed_url['host'] = $site_url['host'];

            // Optional: Replace port if present in site_url
            if (isset($site_url['port'])) {
                $parsed_url['port'] = $site_url['port'];
            }

            return $this->build_url($parsed_url);
        }

        // Helper to rebuild URL from parsed parts
        function build_url($parts) {
            return (isset($parts['scheme']) ? "{$parts['scheme']}://" : '') .
                (isset($parts['user']) ? "{$parts['user']}" . (isset($parts['pass']) ? ":{$parts['pass']}" : '') . '@' : '') .
                (isset($parts['host']) ? $parts['host'] : '') .
                (isset($parts['port']) ? ":{$parts['port']}" : '') .
                (isset($parts['path']) ? $parts['path'] : '') .
                (isset($parts['query']) ? "?{$parts['query']}" : '') .
                (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
        }

        /**
		 * Tourfic Widget importer Settings
		 */
		public function prepare_travelfic_widgets_imports() {
            check_ajax_referer('updates', '_ajax_nonce');
            
            self::travelfic_toolkit_clear_widgets();
            $template_key = !empty($_POST['template_version']) ? sanitize_key( $_POST['template_version'] ) : 1;
            $demo_data_url = 'https://api.themefic.com/tourfic/demos/v'.$template_key.'/widget.json';

            $import_file = wp_remote_get( $demo_data_url );
            $imported_data = wp_remote_retrieve_body($import_file);
            $json_data = json_decode( $imported_data, true );

            $sidebar_data = $json_data[0];
            $widget_data = $json_data[1];

            $widgets = [];
            foreach ($sidebar_data as $key => $value) {
                foreach ($value as $item) {
                    // Adjusted regular expression to match underscores
                    preg_match('/^([a-zA-Z_]+)-(\d+)$/', $item, $matches);

                    if (count($matches) === 3) {
                        $prefix = $matches[1];
                        $number = (int) $matches[2];

                        if (!isset($widgets[$prefix])) {
                            $widgets[$prefix] = [];
                        }

                        $widgets[$prefix][$number] = 'on';
                    }
                }
            }
            foreach ( $sidebar_data as $title => $sidebar ) {
                $count = count( $sidebar );
                for ( $i = 0; $i < $count; $i++ ) {
                    $widget = array( );
                    $widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
                    $widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
                    if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
                        unset( $sidebar_data[$title][$i] );
                    }
                }
                $sidebar_data[$title] = array_values( $sidebar_data[$title] );
            }
    
            foreach ( $widgets as $widget_title => $widget_value ) {
                foreach ( $widget_value as $widget_key => $widget_value ) {
                    $widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
                }
            }
            $sidebar_data = is_array( $sidebar_data ) ? array_filter($sidebar_data) : array();
            $sidebar_data = array($sidebar_data, $widgets);
            $response['id'] = ( self::travelfic_toolkit_parse_import_data( $sidebar_data ) ) ? true : new WP_Error( 'widget_import_submit', 'Unknown Error' );
    
            $response = new WP_Ajax_Response( $response );
            $response->send();
        }

        
        public static function travelfic_toolkit_clear_widgets() {
            $sidebars = wp_get_sidebars_widgets();
            $inactive = isset($sidebars['wp_inactive_widgets']) ? $sidebars['wp_inactive_widgets'] : array();

            unset($sidebars['wp_inactive_widgets']);

            foreach ( $sidebars as $sidebar => $widgets ) {
                $inactive = array_merge($inactive, $widgets);
                $sidebars[$sidebar] = array();
            }

            $sidebars['wp_inactive_widgets'] = $inactive;
            wp_set_sidebars_widgets( $sidebars );
        }

        public static function travelfic_toolkit_parse_import_data( $import_array ) {
            $sidebars_data = $import_array[0];
            $widget_data = $import_array[1];

            $sidebars_widget_data = array(
                "tf-sidebar" => array(),
                "footer_widgets" => array(),
                "tf_archive_booking_sidebar" => array(),
                "tf_search_result" => array(),
                "wp_inactive_widgets" => array(),
                "array_version" => 3
            );
            update_option('sidebars_widgets', $sidebars_widget_data);
            
            $current_sidebars = get_option( 'sidebars_widgets' );
            $new_widgets = array( );

            foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

                foreach ( $import_widgets as $import_widget ) :
                    //if the sidebar exists
                    if ( isset( $current_sidebars[$import_sidebar] ) ) :
                        $title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
                        $index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
                        $current_widget_data = get_option( 'widget_' . $title );
                        $new_widget_name = self::travelfic_toolkit_get_new_widget_name( $title, $index );
                        $new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

                        if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
                            while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
                                $new_index++;
                            }
                        }
                        $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
                        if ( array_key_exists( $title, $new_widgets ) ) {
                            $new_widgets[$title][$new_index] = $widget_data[$title][$index];
                            $multiwidget = $new_widgets[$title]['_multiwidget'];
                            unset( $new_widgets[$title]['_multiwidget'] );
                            $new_widgets[$title]['_multiwidget'] = $multiwidget;
                        } else {
                            $current_widget_data[$new_index] = $widget_data[$title][$index];
                            $current_multiwidget = $current_widget_data['_multiwidget'];
                            $new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
                            $multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
                            unset( $current_widget_data['_multiwidget'] );
                            $current_widget_data['_multiwidget'] = $multiwidget;
                            $new_widgets[$title] = $current_widget_data;
                        }

                    endif;
                endforeach;
            endforeach;

            if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
                update_option( 'sidebars_widgets', $current_sidebars );

                foreach ( $new_widgets as $title => $content ) {
                    $content = apply_filters( 'widget_data_import', $content, $title );
                    update_option( 'widget_' . $title, $content );
                }

                return true;
            }

            return false;
        }

        public static function travelfic_toolkit_get_new_widget_name( $widget_name, $widget_index ) {
            $current_sidebars = get_option( 'sidebars_widgets' );
            $all_widget_array = array( );
            foreach ( $current_sidebars as $sidebar => $widgets ) {
                if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
                    foreach ( $widgets as $widget ) {
                        $all_widget_array[] = $widget;
                    }
                }
            }
            while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
                $widget_index++;
            }
            $new_widget_name = $widget_name . '-' . $widget_index;
            return $new_widget_name;
        }

        /**
		 * Tourfic Hotel importer Settings
		 */
		public function prepare_travelfic_hotel_imports() {

            check_ajax_referer('updates', '_ajax_nonce');

            $hotels_post = array(
                'post_type' => 'tf_hotel',
                'posts_per_page' => -1,
            );
            
            $hotels_query = new WP_Query($hotels_post);
            if(!empty($hotels_query)){
                $hotels_count = $hotels_query->post_count;
                if($hotels_count>=5){
                    return;
                }
            }

            $dummy_hotels_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/hotel-data.csv';
            if (file_exists($dummy_hotels_files)) {
                $dummy_hotel_fields = array(
                    'id',
                    'post_title',
                    'slug',
                    'content',
                    'thumbnail',
                    'address',
                    '[map][address]',
                    '[map][latitude]',
                    '[map][longitude]',
                    '[map][zoom]',
                    'gallery',
                    'video',
                    'featured',
                    'featured_text',
                    'tf_single_hotel_layout_opt',
                    'tf_single_hotel_template',
                    'room-section-title',
                    'room',
                    'room_gallery',
                    'features',
                    'avail_date',
                    'hotel_feature',
                    'features_icon',
                    'hotel_location',
                    'hotel_type',
                    'airport_service',
                    'airport_service_type',
                    '[airport_pickup_price][airport_pickup_price_type]',
                    '[airport_pickup_price][airport_service_fee_adult]',
                    '[airport_pickup_price][airport_service_fee_children]',
                    '[airport_pickup_price][airport_service_fee_fixed]',
                    '[airport_dropoff_price][airport_pickup_price_type]',
                    '[airport_dropoff_price][airport_service_fee_adult]',
                    '[airport_dropoff_price][airport_service_fee_children]',
                    '[airport_dropoff_price][airport_service_fee_fixed]',
                    '[airport_pickup_dropoff_price][airport_pickup_price_type]',
                    '[airport_pickup_dropoff_price][airport_service_fee_adult]',
                    '[airport_pickup_dropoff_price][airport_service_fee_children]',
                    '[airport_pickup_dropoff_price][airport_service_fee_fixed]',
                    'faq-section-title',
                    'faq',
                    'h-enquiry-section',
                    'h-enquiry-option-icon',
                    'h-enquiry-option-title',
                    'h-enquiry-option-content',
                    'h-enquiry-option-btn',
                    'h-review',
                    'h-share',
                    'h-wishlist',
                    'popular-section-title',
                    'review-section-title',
                    'tc-section-title',
                    'tc',
                    'post_date'
                );
                

                //save column mapping data
                if( isset( $dummy_hotel_fields ) ){
                    $column_mapping_data = $dummy_hotel_fields;
                    $csv_data            = array_map( 'str_getcsv', file( $dummy_hotels_files ) );
                    
                    //skip the first row
                    array_shift( $csv_data );
                    $post_meta     = array();

                    /**
                     * loop thorugh each row
                     */
                    foreach( $csv_data as $row_index => $row ){ 
                        $post_id = '';
                        $post_title = '';
                        $post_default_slug   = '';
                        $post_slug   = '';
                        $post_content = '';
                        $post_date = '';
                        $taxonomies = array();
                        $features_icons = array();

                        foreach( $column_mapping_data as $column_index => $field ){
                            //assign the taxonomies values to $taxonomies array
                            if( ( $field === 'hotel_feature' || $field === 'hotel_location' || $field === 'hotel_type' ) && ! empty( $row[$column_index] ) ){
                                $taxonomies[$field] = $row[$column_index];
                            } 
                            if( $field === 'features_icon' && ! empty( $row[$column_index] ) ){
                                $field == 'features_icon' ? $field = 'hotel_feature' : '';
                                $features_icons[$field] = $row[$column_index];
                            }
                        }

                        // Assign taxonomies to the post
                        if (!empty($taxonomies)) {
                            foreach ($taxonomies as $taxonomy => $values) {
                                // Extract the taxonomy terms from the CSV row
                                $taxonomy_terms = explode(',', $values);
                                foreach ($taxonomy_terms as $taxonomy_term) {
                                    // Get the taxonomy name based on the column name
                                    $taxonomy_name = $taxonomy; // Assuming the column names match the taxonomy names

                                    // Check if ">" string is present in the text
                                    if (strpos($taxonomy_term, '>') !== false) {
                                        $taxonomy_parts = explode('>', $taxonomy_term);
                                        $parent_name = trim($taxonomy_parts[0]);
                                        if (strpos($taxonomy_parts[1], '+') !== false) {
                                            $child_terms = explode('+', $taxonomy_parts[1]);
                                        } else {
                                            $child_terms = array($taxonomy_parts[1]);
                                        }

                                        // Get or create the parent term
                                        $parent_term = get_term_by('name', $parent_name, $taxonomy_name);
                                        if (!$parent_term) {
                                            $parent_result = wp_insert_term($parent_name, $taxonomy_name);
                                            if (!is_wp_error($parent_result)) {
                                                $parent_term_id = $parent_result['term_id'];
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating parent term: ' . wp_kses_post($parent_result->get_error_message());
                                                continue;
                                            }
                                        } else {
                                            $parent_term_id = $parent_term->term_id;

                                            // Check if the parent term is already assigned to the post
                                            $assigned_terms = wp_get_post_terms($post_id, $taxonomy_name, array('fields' => 'ids'));
                                            if (!in_array($parent_term_id, $assigned_terms)) {
                                                // Parent term is not assigned to the post, assign it
                                                wp_set_post_terms($post_id, $parent_term_id, $taxonomy_name, true);
                                            }
                                        }

                                        // Get or create the child terms under the parent term
                                        foreach ($child_terms as $child_name) {
                                            $child_name = trim($child_name);

                                            $child_term = get_term_by('name', $child_name, $taxonomy_name);
                                            if (!$child_term) {
                                                $child_result = wp_insert_term($child_name, $taxonomy_name, array('parent' => $parent_term_id));
                                                if (!is_wp_error($child_result)) {
                                                    $child_term_id = $child_result['term_id'];
                                                } else {
                                                    // Handle error if necessary
                                                    echo 'Error creating child term: ' . wp_kses_post($child_result->get_error_message());
                                                    continue;
                                                }
                                            } else {
                                                $child_term_id = $child_term->term_id;
                                            }

                                            // Assign the child term to the post
                                            wp_set_post_terms($post_id, $child_term_id, $taxonomy_name, true);
                                        }
                                    } else {
                                        // No hierarchy, it's a standalone term
                                        $term_name = trim($taxonomy_term);

                                        // Get or create the term by name and taxonomy
                                        $term = get_term_by('name', $term_name, $taxonomy_name);

                                        if (!$term) {
                                            // Term does not exist, create a new one
                                            $term_result = wp_insert_term($term_name, $taxonomy_name);

                                            if (!is_wp_error($term_result)) {
                                                // Term already exists, assign it to the post
                                                $term_id = $term_result['term_id'];
                                                wp_set_post_terms($post_id, $term_id, $taxonomy_name, true);
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating term: ' . wp_kses_post($term_result->get_error_message());
                                            }
                                        } else {
                                            wp_set_post_terms($post_id, $term->term_id, $taxonomy_name, true);
                                        }
                                    }
                                }
                            }
                        }

                        //assign features icons
                        if( ! empty( $features_icons ) ){
                            foreach( $features_icons as $feature => $values ){

                                // Parse the data format to extract term names and icons (image URLs).
                                $terms_with_icons = explode( ',', $values );
                                foreach ( $terms_with_icons as $term_with_icon ) {
                                    $parts = explode('(', $term_with_icon);
                                    $term_name = trim($parts[0]);
                                    $icon_value = trim(str_replace(')', '', $parts[1]));

                                    // Get the term ID for the given term name.
                                    $term = get_term_by( 'name', $term_name, $feature );
                                    if ($term) {
                                        $term_id = $term->term_id;

                                        // Check if the icon value is an image URL or FontAwesome icon class.
                                        if ( filter_var( $icon_value, FILTER_VALIDATE_URL ) ) {
                                            // Update the custom field (icon) with the image URL for the term.
                                            update_term_meta( $term_id, 'tf_hotel_feature[icon-type]', 'c' );
                                            update_term_meta( $term_id, 'tf_hotel_feature[icon-c]', $icon_value );
                                        } else {
                                            // Update the custom field (icon) with the FontAwesome icon class for the term.
                                            update_term_meta( $term_id, 'tf_hotel_feature[icon-type]', 'fa' );
                                            update_term_meta( $term_id, 'tf_hotel_feature[icon-fa]', $icon_value );
                                        }
                                    }
                                }
                            }
                        } 
                        
                        foreach( $column_mapping_data as $column_index => $field ){
                            if( $field == 'id' ){
                                $post_id = $row[$column_index];
                            }elseif( $field == 'post_title' ){
                                $post_default_slug = $row[$column_index];
                                $post_title = ucwords(str_replace('-', ' ', $row[$column_index]));
                                if( empty( $post_title ) ){
                                    $post_title = 'No Title';
                                }
                            }elseif( $field == 'content' ){
                                $post_content = $row[$column_index];
                                if( empty( $post_content ) ){
                                    $post_content = 'No Content';
                                }
                            }
                            if ( $field == 'slug' ) {
                                $post_slug = $row[$column_index];
                            }
                            if( $field == 'post_date' ){
                                $post_date = $row[$column_index];
                            }

                            if( $field == 'thumbnail' ){
                                $attach_id = $this->travelfic_import_image( $row[$column_index], $post_id );
                                if ( $attach_id ) {
                                    $post_meta['_thumbnail_id'] = $attach_id;
                                }
                            } else if( $field == 'airport_service_type' && ! empty( $row[$column_index] ) ){
                                $airport_service_type = explode( ',', $row[$column_index] );
                                $post_meta['tf_hotels_opt']['airport_service_type'] = $airport_service_type;
                            }else if( $field == 'faq' && ! empty( $row[$column_index] ) ){
                                $faqs = json_decode( $row[$column_index], true );
                                //$faqs = $row[$column_index];
                                $post_meta['tf_hotels_opt'][$field] = serialize( $faqs );

                            }else if( $field === 'gallery' && ! empty( $row[ $column_index ] ) ) {
                                // Extract the image URLs from the CSV row
                                $image_urls     = explode( ',', $row[$column_index] );
                                $gallery_images = array();

                                foreach ( $image_urls as $image_url ) {
                                    $attach_id = $this->travelfic_import_image( $image_url, $post_id );
                                    if ( $attach_id ) {
                                        $gallery_images[] = $attach_id;
                                    }
                                }

                                // Combine the attachment IDs into a comma-separated string
                                $gallery_ids_string = implode( ',', $gallery_images );
                                // Assign the gallery IDs string to the tour_gallery meta field
                                $post_meta['tf_hotels_opt']['gallery'] = $gallery_ids_string;
                            }else {
                                $post_meta['tf_hotels_opt'][$field] = $row[$column_index];
                            }
                            if( $field == 'tc-section-title' ){
                                $post_meta['tf_hotels_opt']['tc-section-title'] =  $row[$column_index]; 
                            }

                            if( $field == 'room_gallery' && ! empty( $row[ $column_index ] ) ){
                                $room_gall_gallery_array = json_decode( $row[ $column_index ], true );
                                $total_gall = count( $room_gall_gallery_array ) - 1;
                                for( $room_gall = 0; $room_gall <= $total_gall; $room_gall++ ){
                                    // Extract the image URLs from the CSV row                           
                                    $gallery_images = array();
                                    $gallery_index     = $room_gall + 1;
                                    $image_urls        = explode( ',', $room_gall_gallery_array[$gallery_index] );
                
                                    foreach ( $image_urls as $image_url ) {
                                        $attach_id = $this->travelfic_import_image( $image_url, $post_id );
                                        if ( $attach_id ) {
                                            $gallery_images[] = $attach_id;
                                        }
                                    }
                                    
                                    if( !empty($post_meta['tf_hotels_opt']['room']) && gettype($post_meta['tf_hotels_opt']['room'])=="string" ){
                                        $tf_hotel_exc_value = preg_replace_callback ( '!s:(\d+):"(.*?)";!', function($match) {
                                            return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                                        }, $post_meta['tf_hotels_opt']['room'] );
                                        $room = unserialize( $tf_hotel_exc_value );
                                    }
                                    // Combine the attachment IDs into a comma-separated string
                                    $gallery_ids_string = implode( ',', $gallery_images );
                                    // Assign the gallery IDs string to the tour_gallery meta field
                                    $room[$room_gall]['gallery'] = $gallery_ids_string;
                                    
                                    $post_meta['tf_hotels_opt']['room'] = serialize($room );
                                }

                            }
                            

                            if ( strpos( $field, '[' ) !== false && strpos( $field, ']' ) !== false ) {
                                //exclude title, post content, features from adding into the array
                                // Field is a multidimensional array key, e.g., [location][latitude]
                                $nested_keys = explode( '][', trim($field, '[]' ) );
                                $meta_value = &$post_meta['tf_hotels_opt'];
                            
                                // Iterate through nested keys except the last one
                                for ( $i = 0; $i < count( $nested_keys ) - 1; $i++ ) {
                                    $nested_key = $nested_keys[$i];
                            
                                    // Create the nested array if it doesn't exist
                                    if ( !isset( $meta_value[$nested_key] ) ) {
                                        $meta_value[$nested_key] = array();
                                    }
                            
                                    $meta_value = &$meta_value[$nested_key];
                                }
                            
                                // Assign the value to the last nested key
                                $last_nested_key = end( $nested_keys );
                                $meta_value[$last_nested_key] = $row[$column_index];

                            }

                            if( $field == 'features' ){

                                if( !empty($post_meta['tf_hotels_opt']['room']) && gettype($post_meta['tf_hotels_opt']['room'])=="string" ){
                                    $tf_hotel_exc_value = preg_replace_callback ( '!s:(\d+):"(.*?)";!', function($match) {
                                        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                                    }, $post_meta['tf_hotels_opt']['room'] );
                                    $room = unserialize( $tf_hotel_exc_value );
                                }

                                $features = json_decode ( $row[$column_index], true );
                                $room_features = array();
                                foreach( $features as $fkey => $feature ){
                                    foreach( $feature as $key => $value ){
                                        $term = get_term_by( 'name', $value, 'hotel_feature' );
                                        if ( $term && ! is_wp_error( $term ) ) {
                                            $term_id = $term->term_id;
                                            $room_features[$fkey][$key] = $term_id;
                                        }
                                    }
                                }
                                if(!empty($room)){
                                    for( $room_key = 0; $room_key <= count($room) -1; $room_key++ ){
                                        $room[$room_key]['features'] = $room_features[$room_key];
                                    }
                                    
                                $post_meta['tf_hotels_opt']['room'] = serialize( $room );
                                }

                            }

                            if( $field == 'avail_date' ){

                                if( !empty($post_meta['tf_hotels_opt']['room']) && gettype($post_meta['tf_hotels_opt']['room'])=="string" ){
                                    $tf_hotel_exc_value = preg_replace_callback ( '!s:(\d+):"(.*?)";!', function($match) {
                                        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                                    }, $post_meta['tf_hotels_opt']['room'] );
                                    $room = unserialize( $tf_hotel_exc_value );
                                }

                                $field_values = explode( '|', $row[$column_index] );
                                $room_available_data = array();
                                foreach( $field_values as $fkey => $feature ){
                                    $room_available_data[$fkey] = $feature;
                                }
                                if(!empty($room)){
                                    for( $room_key = 0; $room_key <= count($room) -1; $room_key++ ){
                                        $room[$room_key]['avail_date'] = $room_available_data[$room_key];
                                    }
                                    $post_meta['tf_hotels_opt']['room'] = $room;
                                }
                            }

                        }
                        //update or insert hotels
                        if ( ! function_exists( 'post_exists' ) ) {
                            require_once ABSPATH . 'wp-includes/post.php';
                        }

                        // Create an array to store the post data for the current row
                        $post_data = array(
                            'post_type'    => 'tf_hotel',
                            'post_title'   => $post_title,
                            'post_content' => $post_content,
                            'post_status'  => 'publish',
                            'author'  => get_current_user_id(),
                            'post_date'    => $post_date,
                            'meta_input'   => $post_meta,
                            'post_name'    => !empty($post_slug) ? $post_slug : $post_default_slug,
                        );

                        $post_id = wp_insert_post( $post_data );

                        // Assign taxonomies to the post
                        if (!empty($taxonomies)) {
                            foreach ($taxonomies as $taxonomy => $values) {
                                // Extract the taxonomy terms from the CSV row
                                $taxonomy_terms = explode(',', $values);
                                foreach ($taxonomy_terms as $taxonomy_term) {
                                    // Get the taxonomy name based on the column name
                                    $taxonomy_name = $taxonomy; // Assuming the column names match the taxonomy names

                                    // Check if ">" string is present in the text
                                    if (strpos($taxonomy_term, '>') !== false) {
                                        $taxonomy_parts = explode('>', $taxonomy_term);
                                        $parent_name = trim($taxonomy_parts[0]);
                                        if (strpos($taxonomy_parts[1], '+') !== false) {
                                            $child_terms = explode('+', $taxonomy_parts[1]);
                                        } else {
                                            $child_terms = array($taxonomy_parts[1]);
                                        }

                                        // Get or create the parent term
                                        $parent_term = get_term_by('name', $parent_name, $taxonomy_name);
                                        if (!$parent_term) {
                                            $parent_result = wp_insert_term($parent_name, $taxonomy_name);
                                            if (!is_wp_error($parent_result)) {
                                                $parent_term_id = $parent_result['term_id'];
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating parent term: ' . wp_kses_post($parent_result->get_error_message());
                                                continue;
                                            }
                                        } else {
                                            $parent_term_id = $parent_term->term_id;

                                            // Check if the parent term is already assigned to the post
                                            $assigned_terms = wp_get_post_terms($post_id, $taxonomy_name, array('fields' => 'ids'));
                                            if (!in_array($parent_term_id, $assigned_terms)) {
                                                // Parent term is not assigned to the post, assign it
                                                wp_set_post_terms($post_id, $parent_term_id, $taxonomy_name, true);
                                            }
                                        }

                                        // Get or create the child terms under the parent term
                                        foreach ($child_terms as $child_name) {
                                            $child_name = trim($child_name);

                                            $child_term = get_term_by('name', $child_name, $taxonomy_name);
                                            if (!$child_term) {
                                                $child_result = wp_insert_term($child_name, $taxonomy_name, array('parent' => $parent_term_id));
                                                if (!is_wp_error($child_result)) {
                                                    $child_term_id = $child_result['term_id'];
                                                } else {
                                                    // Handle error if necessary
                                                    echo 'Error creating child term: ' . wp_kses_post($child_result->get_error_message());
                                                    continue;
                                                }
                                            } else {
                                                $child_term_id = $child_term->term_id;
                                            }

                                            // Assign the child term to the post
                                            wp_set_post_terms($post_id, $child_term_id, $taxonomy_name, true);
                                        }
                                    } else {
                                        // No hierarchy, it's a standalone term
                                        $term_name = trim($taxonomy_term);

                                        // Get or create the term by name and taxonomy
                                        $term = get_term_by('name', $term_name, $taxonomy_name);

                                        if (!$term) {
                                            // Term does not exist, create a new one
                                            $term_result = wp_insert_term($term_name, $taxonomy_name);

                                            if (!is_wp_error($term_result)) {
                                                // Term already exists, assign it to the post
                                                $term_id = $term_result['term_id'];
                                                wp_set_post_terms($post_id, $term_id, $taxonomy_name, true);
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating term: ' . wp_kses_post($term_result->get_error_message());
                                            }
                                        } else {
                                            wp_set_post_terms($post_id, $term->term_id, $taxonomy_name, true);
                                        }
                                    }
                                }
                            }
                        }

                        //reset the post meta array
                        $post_meta = array();
                    }
                    
                }

	            $this->travelfic_regenerate_room_meta();
                wp_die();
            }


		}

        /**
		 * Tourfic Tour importer Settings
		 */
		public function prepare_travelfic_tour_imports() {

            check_ajax_referer('updates', '_ajax_nonce');

            $tours_post = array(
                'post_type' => 'tf_tours',
                'posts_per_page' => -1,
            );
            
            $tours_query = new WP_Query($tours_post);
            if(!empty($tours_query)){
                $tours_count = $tours_query->post_count;
                if($tours_count>=5){
                    return;
                }
            }
            
            $dummy_tours_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/tour-data.csv';
            $dummy_tours_fields = array(
                'id',
                'post_title',
                'slug',
                'post_content',
                'thumbnail',
                'adult_price',
                'child_price',
                'infant_price',
                'tour_as_featured',
                'tf_single_tour_layout_opt',
                'tf_single_tour_template',
                'tour_types',
                'refund_des',
                'highlights-section-title',
                'contact-info-section-title',
                'tour-traveller-info',
                'booking-by',
                'booking-url',
                'booking-attribute',
                'booking-query',
                'itinerary-section-title',
                'faq-section-title',
                't-enquiry-section',
                't-enquiry-option-icon',
                't-enquiry-option-title',
                't-enquiry-option-content',
                't-enquiry-option-btn',
                'tc-section-title',
                'booking-section-title',
                'description-section-title',
                'map-section-title',
                'review-section-title',
                't-wishlist',
                'type',
                'pricing',
                'discount_type',
                'discount_price',
                'disable_adult_price',
                'disable_child_price',
                'disable_infant_price',
                'allow_deposit',
                'deposit_type',
                'deposit_amount',
                'text_location',
                '[location][address]',
                '[location][latitude]',
                '[location][longitude]',
                '[location][zoom]',
                'group_price',
                'allowed_time',
                'min_days_before_book',
                'disable_same_day',
                'disable_range',
                'disabled_day',
                'disable_specific',
                'cont_min_people',
                'cont_max_people',
                'custom_avail',
                'custom_pricing_by',
                'cont_custom_date',
                'min_seat',
                'max_seat',
                '[fixed_availability][date][from]',
                '[fixed_availability][date][to]',
                'max_capacity',
                'itinerary-downloader',
                'itinerary-downloader-title',
                'itinerary-downloader-desc',
                'itinerary-downloader-button',
                'tour_thumbnail_height',
                'tour_thumbnail_width',
                'company_logo',
                'company_desc',
                'company_email',
                'company_address',
                'company_phone',
                'itinerary-expert',
                'expert_label',
                'expert_name',
                'expert_email',
                'expert_phone',
                'expert_logo',
                'itinerary-expert-viber',
                'itinerary-expert-whatsapp',
                't-review',
                't-share',
                't-wishlist',
                't-related',
                'tour-traveler-info',
                'cont_max_capacity',
                'tour_destination',
                'destinations_icon',
                'tour_features',
                'features_icon',
                'tour_activities',
                'activities_icon',
                'tour_attraction',
                'attraction_icon',
                'tour_gallery',
                'tour_video',
                'additional_information',
                'hightlights_thumbnail',
                'duration',
                'duration_time',
                'night',
                'night_count',
                'group_size',
                'language',
                'email',
                'phone',
                'fax',
                'website',
                'tour-extra',
                'faqs',
                'included',
                'excluded',
                'included_icon',
                'excluded_icon',
                'inc_exc_bg',
                'itinerary',
                'itinerary_gallery',
                'terms_conditions',
                'post_date',
            );
            if ( isset( $dummy_tours_files ) ) {
                $column_mapping_data = $dummy_tours_fields;
                $csv_data            = array_map( 'str_getcsv', file( $dummy_tours_files ) );
                
                //skip the first row
                array_shift( $csv_data );
                $post_meta     = array();
        
                foreach ( $csv_data as $row_index => $row ) {
                    $post_id      = '';
                    $post_title   = '';
                    $post_default_slug   = '';
                    $post_slug   = '';
                    $post_content = '';
                    $post_date    = '';
                    //$disable_day = array();
                    $taxonomies   = array();
                    $tax_icons    = array();
        
                    foreach ( $column_mapping_data as $column_index => $field ) {
                        if( ( $field == 'tour_destination' || $field == 'tour_activities' || $field == 'tour_attraction' || $field == 'tour_features' || $field == 'tour_types' ) && ! empty( $row[$column_index] ) ){
                            if($field == 'tour_types'){
                                $taxonomies['tour_type'] = $row[$column_index];
                            }else{
                                $taxonomies[$field] = $row[$column_index];
                            }
                        }
                    }
        
                    if (!empty($taxonomies)) {
                        foreach ($taxonomies as $taxonomy => $values) {
                            // Extract the taxonomy terms from the CSV row
                            $taxonomy_terms = explode(',', $values);
        
                            foreach ($taxonomy_terms as $taxonomy_term) {
                                // Get the taxonomy name based on the column name
                                $taxonomy_name = $taxonomy; // Assuming the column names match the taxonomy names
        
                                // Check if ">" string is present in the text
                                if (strpos($taxonomy_term, '>') !== false) {
                                    $taxonomy_parts = explode('>', $taxonomy_term);
                                    $parent_name    = trim($taxonomy_parts[0]);
                                    if(  strpos( $taxonomy_parts[1], '+' ) !== false ){
                                        $child_terms = explode('+', $taxonomy_parts[1]);
                                    }else{
                                        $child_terms = array( $taxonomy_parts[1] );
                                    }
        
                                    // Get or create the parent term
                                    $parent_term = get_term_by('name', $parent_name, $taxonomy_name);
                                    if (!$parent_term) {
                                        $parent_result = wp_insert_term($parent_name, $taxonomy_name);
                                        if (!is_wp_error($parent_result)) {
                                            $parent_term_id = $parent_result['term_id'];
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating parent term: ' . wp_kses_post($parent_result->get_error_message());
                                            continue;
                                        }
                                    } else {
                                        $parent_term_id = $parent_term->term_id;
                                        //check if parrent term is already assigned to the post
                                        $assigned_terms = wp_get_post_terms( $post_id, $taxonomy_name, array( 'fields' => 'ids' ) );
                                        if( ! in_array( $parent_term_id, $assigned_terms ) ){
                                            wp_set_post_terms( $post_id, $parent_term_id, $taxonomy_name, true );
                                        }
                                    }
        
                                    // Get or create the child terms under the parent term
                                    $child_term_ids = array();
                                    foreach ($child_terms as $child_name) {
                                        $child_name = trim($child_name);
        
                                        $child_term = get_term_by('name', $child_name, $taxonomy_name);
                                        if (!$child_term) {
                                            $child_result = wp_insert_term($child_name, $taxonomy_name, array('parent' => $parent_term_id));
                                            if (!is_wp_error($child_result)) {
                                                $child_term_ids[] = $child_result['term_id'];
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating child term: ' . wp_kses_post($child_result->get_error_message());
                                                continue;
                                            }
                                        } else {
                                            $child_term_ids[] = $child_term->term_id;
                                        }
                                    }
        
                                    // Assign the parent and child terms to the post
                                    wp_set_post_terms($post_id, array_merge(array($parent_term_id), $child_term_ids), $taxonomy_name, true);
                                } else {
                                    // No hierarchy, it's a standalone term
                                    $term_name = trim($taxonomy_term);
        
                                    // Get or create the term by name and taxonomy
                                    $term = get_term_by('name', $term_name, $taxonomy_name);
        
                                    if (!$term) {
                                        // Term does not exist, create a new one
                                        $term_result = wp_insert_term($term_name, $taxonomy_name);
        
                                        if (!is_wp_error($term_result)) {
                                            // Term already exists, assign it to the post
                                            $term_id = $term_result['term_id'];
                                            wp_set_post_terms($post_id, $term_id, $taxonomy_name, true);
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating term: ' . wp_kses_post($term_result->get_error_message());
                                        }
                                    } else {
                                        wp_set_post_terms($post_id, $term->term_id, $taxonomy_name, true);
                                    }
                                }
                            }
                        }
                    }
        
                    //update all the custom taxonomies icons if has any
                    if( ! empty( $tax_icons ) ){
                        foreach( $tax_icons as $tax => $values ){
                            // Parse the data format to extract term names and icons (image URLs).
                            $terms_with_icons = explode( ',', $values );
        
                            foreach ( $terms_with_icons as $term_with_icon ) {
                                $parts = explode('(', $term_with_icon);
                                $term_name = trim($parts[0]);
                                $icon_value = trim(str_replace(')', '', $parts[1]));
        
                                // Get the term ID for the given term name.
                                $term = get_term_by( 'name', $term_name, $tax );
                                if ($term) {
                                    $term_id = $term->term_id;
        
                                    // Check if the icon value is an image URL or FontAwesome icon class.
                                    if ( filter_var( $icon_value, FILTER_VALIDATE_URL ) ) {
                                        // Step 3a: Update the custom field (icon) with the image URL for the term.
                                        update_term_meta( $term_id, 'tour_features[icon-c]', $icon_value );
                                    } else {
                                        // Step 3b: Update the custom field (icon) with the FontAwesome icon class for the term.
                                        update_term_meta( $term_id, 'tour_features[icon-c]', $icon_value );
                                    }
                                }
                            }
        
        
                        } 
                    }
        
                    foreach ( $column_mapping_data as $column_index => $field ) {
                        if( $field == 'id' ){
                            $post_id = $row[$column_index];
                        }
                        if ( $field == 'post_title' ) {
                            $post_default_slug = $row[$column_index];
                            $post_title = ucwords(str_replace('-', ' ', $row[$column_index]));
                            if( empty( $post_title ) ){
                                $post_title = 'No Title';
                            }
                        } else if ( $field == 'post_content' ) {
                            $post_content = $row[$column_index];
                            if( empty( $post_content ) ){
                                $post_content = 'No Content';
                            }
                        }
                        if ( $field == 'slug' ) {
                            $post_slug = $row[$column_index];
                        }
                        if( $field == 'thumbnail' ){
                            $attach_id = $this->travelfic_import_image( $row[$column_index], $post_id );
                            if ( $attach_id ) {
                                $post_meta['_thumbnail_id'] = $attach_id;
                            }
                        }
                        if( $field == 'post_date' ){
                            $post_date = $row[$column_index];
                        }
        
                        if( $field == 'longitude' ){
                            $post_meta['tf_tours_opt']['location'][$field] = $row[$column_index];
                        }else if( $field == 'latitude' ){
                            $post_meta['tf_tours_opt']['location'][$field] = $row[$column_index];
                        }else if( $field == 'min_seat' ){
                            $post_meta['tf_tours_opt']['fixed_availability'][$field] = $row[$column_index];
                        }else if( $field == 'max_seat' ){
                            $post_meta['tf_tours_opt']['fixed_availability'][$field] = $row[$column_index];
                        }else if ( $field === 'tour_gallery' && ! empty( $row[ $column_index ] ) ) {
                            // Extract the image URLs from the CSV row
                            $image_urls = explode( ',', $row[ $column_index] );
            
                            $gallery_images = array();
        
                            //include image.php for wp_generate_attachment_metadata() function
                            if( ! function_exists( 'wp_crop_image' ) ){
                                require_once ABSPATH . 'wp-admin/includes/image.php';
                            }
        
                            foreach ( $image_urls as $image_url ) {
                                $attach_id = $this->travelfic_import_image( $image_url, $post_id );
                                if ( $attach_id ) {
                                    $gallery_images[] = $attach_id;
                                }
                            }
        
                            // Combine the attachment IDs into a comma-separated string
                            $gallery_ids_string = implode( ',', $gallery_images );
            
                            // Assign the gallery IDs string to the tour_gallery meta field
                            $post_meta['tf_tours_opt']['tour_gallery'] = $gallery_ids_string;
        
                        } else if ( strpos( $field, '[' ) !== false && strpos( $field, ']' ) !== false ) {
                            //exclude title, post content, features from adding into the array
                            // Field is a multidimensional array key, e.g., [location][latitude]
                            $nested_keys = explode( '][', trim($field, '[]' ) );
                            $meta_value = &$post_meta['tf_tours_opt'];
                        
                            // Iterate through nested keys except the last one
                            for ( $i = 0; $i < count( $nested_keys ) - 1; $i++ ) {
                                $nested_key = $nested_keys[$i];
                        
                                // Create the nested array if it doesn't exist
                                if ( !isset( $meta_value[$nested_key] ) ) {
                                    $meta_value[$nested_key] = array();
                                }
                        
                                $meta_value = &$meta_value[$nested_key];
                            }
                        
                            // Assign the value to the last nested key
                            $last_nested_key = end( $nested_keys );
                            $meta_value[$last_nested_key] = $row[$column_index];
        
        
                        } else if( $field == 'tour_features' ){
                            $features = explode( ',', $row[$column_index] );
                            $tf_tour_features = array();
                            foreach( $features as $feature ){
                                $term = get_term_by( 'name', $feature, 'tour_features' );
                                $term_id = $term->term_id;
                                $tf_tour_features[] = $term_id;
                            }
                            $post_meta['tf_tours_opt']['features'] = $tf_tour_features;
        
                        } else if( $field == 'tour_types' ){
                            $tour_types = explode( ',', $row[$column_index] );
                            $tf_tour_types = array();
                            foreach( $tour_types as $feature ){
                                $term = get_term_by( 'name', $feature, 'tour_type' );
                                $term_id = $term->term_id;
                                $tf_tour_types[] = $term_id;
                            }
                            $post_meta['tf_tours_opt']['tour_types'] = $tf_tour_types;
        
                        }else if( $field == 'features_icon' || $field == 'destinations_icon' || $field == 'activities_icon' || $field == 'attraction_icon' ){
                            $field == 'features_icon' ? $field = 'tour_features' : '';
                            $field == 'destinations_icon' ? $field = 'tour_destination' : '';
                            $field == 'activities_icon' ? $field = 'tour_activities' : '';
                            $field == 'attraction_icon' ? $field = 'tour_attraction' : '';
                            $tax_icons[$field] = $row[$column_index];
                        
                        } else if( $field == 'included' && ! empty( $row[$column_index] ) ){
                            $includes  = explode(',', $row[$column_index] );
                            $total_includes = count( $includes ) - 1;
                            for( $inc = 0; $inc <= $total_includes; $inc++ ){
                                $inc_index = $inc;
                                $post_meta['tf_tours_opt']['inc'][$inc_index]['inc'] = $includes[$inc_index];
                            }
                        } else if( $field == 'excluded' && ! empty( $row[$column_index] ) ){
                            $excludes  = explode(',', $row[$column_index] );
                            $total_excludes = count( $excludes ) - 1;
                            for( $exc = 0; $exc <= $total_excludes; $exc++ ){
                                $exc_index = $exc;
                                $post_meta['tf_tours_opt']['exc'][$exc_index]['exc'] = $excludes[$exc_index];
                            }
                        } else if( $field == 'included_icon' && ! empty( $row[$column_index] ) ){
                            $inc_icon  = !empty($row[$column_index]) ? $row[$column_index] : '';
                            $post_meta['tf_tours_opt']['inc_icon'] = $inc_icon;
                        } else if( $field == 'excluded_icon' && ! empty( $row[$column_index] ) ){
                            $exc_icon  = !empty($row[$column_index]) ? $row[$column_index] : '';
                            $post_meta['tf_tours_opt']['exc_icon'] = $exc_icon;
                        } else if( $field == 'cont_custom_date' && ! empty( $row[$column_index] ) ){
                            $cont_custom_date = json_decode( $row[$column_index], true );
                            $response['cont_custom_date'] = $cont_custom_date;
                            $post_meta['tf_tours_opt']['cont_custom_date'] = $cont_custom_date;
        
                        } else {
                            // Create an array to store post meta for the current row
                            $post_meta['tf_tours_opt'][$field] = $row[$column_index];
                        }    
        
                        if( $field == 'faqs' && ! empty( $row[$column_index] ) ){
                            $faqs = json_decode( $row[$column_index], true );
                            //$faqs = $row[$column_index];
                            $post_meta['tf_tours_opt'][$field] = serialize( $faqs );
        
                        }
        
                        if( $field == 'disabled_day'  && ! empty( $row[$column_index] ) ){
                            $post_meta['tf_tours_opt']['disabled_day'] = unserialize( $row[$column_index] );
                        }
        
                        if( $field == 'tc-section-title' ){
                            $post_meta['tf_tours_opt']['tc-section-title'] =  $row[$column_index]; 
                        }
                        if( $field == 't-enquiry-option-icon' ){
                            $post_meta['tf_tours_opt']['t-enquiry-option-icon'] = $row[$column_index];
                        }
                        if( $field == 'itinerary_gallery' && ! empty( $row[ $column_index ] ) ){
                            $itn_gallery_array = json_decode( $row[ $column_index ], true );
                            $total_itn = count( $itn_gallery_array ) - 1;
                            for( $itn = 0; $itn <= $total_itn; $itn++ ){
                                // Extract the image URLs from the CSV row                           
                                $gallery_index     = $itn + 1;
                                $image_urls        = explode( ',', $itn_gallery_array[$gallery_index] );
                
                                $gallery_images = array();
            
                                //include image.php for wp_generate_attachment_metadata() function
                                if( ! function_exists( 'wp_crop_image' ) ){
                                    require_once ABSPATH . 'wp-admin/includes/image.php';
                                }
            
                                foreach ( $image_urls as $image_url ) {
                                    $attach_id = $this->travelfic_import_image( $image_url, $post_id );
                                    if ( $attach_id ) {
                                        $gallery_images[] = $attach_id;
                                    }
                                }
                                
                                if( !empty($post_meta['tf_tours_opt']['itinerary']) && gettype($post_meta['tf_tours_opt']['itinerary'])=="string" ){
                                    $tf_hotel_exc_value = preg_replace_callback ( '!s:(\d+):"(.*?)";!', function($match) {
                                        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                                    }, $post_meta['tf_tours_opt']['itinerary'] );
                                    $itinerary = unserialize( $tf_hotel_exc_value );
                                }
                                
                                // Combine the attachment IDs into a comma-separated string
                                $gallery_ids_string = implode( ',', $gallery_images );
                                // Assign the gallery IDs string to the tour_gallery meta field
                                $itinerary[$itn]['gallery_image'] = $gallery_ids_string;
                                $post_meta['tf_tours_opt']['itinerary'] = serialize($itinerary );
                            }
        
                        }
                        
                    }      
        
                    if ( ! function_exists( 'post_exists' ) ) {
                        require_once ABSPATH . 'wp-includes/post.php';
                    }
                   
                    // Create an array to store the post data for the current row
                    $post_data = array(
                        'post_type'    => 'tf_tours',
                        'post_title'   => $post_title,
                        'post_content' => $post_content,
                        'post_status'  => 'publish',
                        'author'  => get_current_user_id(),
                        'post_date'    => $post_date,
                        'meta_input'   => $post_meta,
                        'post_name'    => !empty($post_slug) ? $post_slug : $post_default_slug,
                    );
    
                    $post_id = wp_insert_post( $post_data );
        
                    //assign or create taxonomies to the imported tours
                    if (!empty($taxonomies)) {
                        foreach ($taxonomies as $taxonomy => $values) {
                            // Extract the taxonomy terms from the CSV row
                            $taxonomy_terms = explode(',', $values);
        
                            foreach ($taxonomy_terms as $taxonomy_term) {
                                // Get the taxonomy name based on the column name
                                $taxonomy_name = $taxonomy; // Assuming the column names match the taxonomy names
        
                                // Check if ">" string is present in the text
                                if (strpos($taxonomy_term, '>') !== false) {
                                    $taxonomy_parts = explode('>', $taxonomy_term);
                                    $parent_name    = trim($taxonomy_parts[0]);
                                    if(  strpos( $taxonomy_parts[1], '+' ) !== false ){
                                        $child_terms = explode('+', $taxonomy_parts[1]);
                                    }else{
                                        $child_terms = array( $taxonomy_parts[1] );
                                    }
        
                                    // Get or create the parent term
                                    $parent_term = get_term_by('name', $parent_name, $taxonomy_name);
                                    if (!$parent_term) {
                                        $parent_result = wp_insert_term($parent_name, $taxonomy_name);
                                        if (!is_wp_error($parent_result)) {
                                            $parent_term_id = $parent_result['term_id'];
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating parent term: ' . wp_kses_post($parent_result->get_error_message());
                                            continue;
                                        }
                                    } else {
                                        $parent_term_id = $parent_term->term_id;
                                        //check if parrent term is already assigned to the post
                                        $assigned_terms = wp_get_post_terms( $post_id, $taxonomy_name, array( 'fields' => 'ids' ) );
                                        if( ! in_array( $parent_term_id, $assigned_terms ) ){
                                            wp_set_post_terms( $post_id, $parent_term_id, $taxonomy_name, true );
                                        }
                                    }
        
                                    // Get or create the child terms under the parent term
                                    $child_term_ids = array();
                                    foreach ($child_terms as $child_name) {
                                        $child_name = trim($child_name);
        
                                        $child_term = get_term_by('name', $child_name, $taxonomy_name);
                                        if (!$child_term) {
                                            $child_result = wp_insert_term($child_name, $taxonomy_name, array('parent' => $parent_term_id));
                                            if (!is_wp_error($child_result)) {
                                                $child_term_ids[] = $child_result['term_id'];
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating child term: ' . wp_kses_post($child_result->get_error_message());
                                                continue;
                                            }
                                        } else {
                                            $child_term_ids[] = $child_term->term_id;
                                        }
                                    }
        
                                    // Assign the parent and child terms to the post
                                    wp_set_post_terms($post_id, array_merge(array($parent_term_id), $child_term_ids), $taxonomy_name, true);
                                } else {
                                    // No hierarchy, it's a standalone term
                                    $term_name = trim($taxonomy_term);
        
                                    // Get or create the term by name and taxonomy
                                    $term = get_term_by('name', $term_name, $taxonomy_name);
        
                                    if (!$term) {
                                        // Term does not exist, create a new one
                                        $term_result = wp_insert_term($term_name, $taxonomy_name);
        
                                        if (!is_wp_error($term_result)) {
                                            // Term already exists, assign it to the post
                                            $term_id = $term_result['term_id'];
                                            wp_set_post_terms($post_id, $term_id, $taxonomy_name, true);
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating term: ' . wp_kses_post($term_result->get_error_message());
                                        }
                                    } else {
                                        wp_set_post_terms($post_id, $term->term_id, $taxonomy_name, true);
                                    }
                                }
                            }
                        }
                    }
                    //reset the post meta array
                    $post_meta = array();           
                }
        
                wp_die();
            }
        }

        /**
		 * Tourfic Car importer Settings
		 */
        public function prepare_travelfic_car_imports() {
            check_ajax_referer('updates', '_ajax_nonce');

            $tours_post = array(
                'post_type' => 'tf_carrental',
                'posts_per_page' => -1,
            );
            
            $tours_query = new WP_Query($tours_post);
            if(!empty($tours_query)){
                $tours_count = $tours_query->post_count;
                if($tours_count>=3){
                    return;
                }
            }
            
            $dummy_cars_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/car-data.csv';
            $dummy_cars_fields = array(
                'id',
                'post_title',
                'post_slug',
                'post_content',
                'thumbnail',
                'car_gallery',
                'tf_single_car_layout_opt',
                'tf_single_car_template',
                'location_title',
                '[map][address]',
                '[map][latitude]',
                '[map][longitude]',
                '[map][zoom]',
                'car_info_sec_title',
                'car_as_featured',
                'passengers',
                'baggage',
                'auto_transmission',
                'pay_pickup',
                'shuttle_car',
                'shuttle_car_fee_type',
                'shuttle_car_fee',
                'fuel_included',
                'unlimited_mileage',
                'mileage_type',
                'mileage',
                'car_custom_info',
                'driver_included',
                'car_driverinfo_section',
                'driver_sec_title',
                'driver_name',
                'driver_email',
                'driver_phone',
                'driver_age',
                'driver_address',
                'driver_image',
                'benefits_section',
                'benefits_sec_title',
                'benefits',
                'inc_exc_section',
                'inc_sec_title',
                'inc',
                'inc_icon',
                'exc_sec_title',
                'exc',
                'exc_icon',
                'badge',
                'information_section',
                'owner_sec_title',
                'owner_name',
                'email',
                'phone',
                'website',
                'fax',
                'owner_image',
                'price_by',
                'car_rent',
                'custom_availability',
                'pricing_type',
                'day_prices',
                'date_prices',
                'discount_type',
                'discount_price',
                'car_numbers',
                'allow_deposit',
                'deposit_type',
                'deposit_amount',
                'car_extra_sec_title',
                'extras',
                'protection_section',
                'protection_tab_title',
                'protections',
                'instructions_section',
                'instructions_content',
                'cancellation_section',
                'calcellation_policy',
                'booking-by',
                'booking-url',
                'booking-attribute',
                'booking-query',
                'is_taxable',
                'taxable_class',
                'faq_sec_title',
                'faq',
                'car-tc-section-title',
                'terms_conditions',
                'review_sec_title',
                'c-share',
                'c-wishlist',
                'locations',
                'categories',
                'brands',
                'fuel_types',
                'engine_years',
                'post_date',
            );
            
            if ( isset( $dummy_cars_files ) ) {
                $column_mapping_data = $dummy_cars_fields;
                $csv_data            = array_map( 'str_getcsv', file( $dummy_cars_files ) );
                
                //skip the first row
                array_shift( $csv_data );
                $post_meta     = array();
        
                foreach ( $csv_data as $row_index => $row ) {
                    $post_id      = '';
                    $post_title   = '';
                    $post_default_slug   = '';
                    $post_slug   = '';
                    $post_content = '';
                    $post_date    = '';
                    $taxonomies   = array();
                    $tax_icons    = array();
        
                    foreach ( $column_mapping_data as $column_index => $field ) {
                        if( ( $field == 'locations' || $field == 'categories' || $field == 'brands' || $field == 'fuel_types' || $field == 'engine_years' ) && ! empty( $row[$column_index] ) ){
                            if($field == 'locations'){
                                $taxonomies['carrental_location'] = $row[$column_index];
                            }elseif($field == 'categories'){
                                $taxonomies['carrental_category'] = $row[$column_index];
                            }elseif($field == 'brands'){
                                $taxonomies['carrental_brand'] = $row[$column_index];
                            }elseif($field == 'fuel_types'){
                                $taxonomies['carrental_fuel_type'] = $row[$column_index];
                            }elseif($field == 'engine_years'){
                                $taxonomies['carrental_engine_year'] = $row[$column_index];
                            }else{
                                $taxonomies[$field] = $row[$column_index];
                            }
                        }
                    }
        
                    if (!empty($taxonomies)) {
                        foreach ($taxonomies as $taxonomy => $values) {
                            // Extract the taxonomy terms from the CSV row
                            $taxonomy_terms = explode(',', $values);
        
                            foreach ($taxonomy_terms as $taxonomy_term) {
                                // Get the taxonomy name based on the column name
                                $taxonomy_name = $taxonomy; // Assuming the column names match the taxonomy names
        
                                // Check if ">" string is present in the text
                                if (strpos($taxonomy_term, '>') !== false) {
                                    $taxonomy_parts = explode('>', $taxonomy_term);
                                    $parent_name    = trim($taxonomy_parts[0]);
                                    if(  strpos( $taxonomy_parts[1], '+' ) !== false ){
                                        $child_terms = explode('+', $taxonomy_parts[1]);
                                    }else{
                                        $child_terms = array( $taxonomy_parts[1] );
                                    }
        
                                    // Get or create the parent term
                                    $parent_term = get_term_by('name', $parent_name, $taxonomy_name);
                                    if (!$parent_term) {
                                        $parent_result = wp_insert_term($parent_name, $taxonomy_name);
                                        if (!is_wp_error($parent_result)) {
                                            $parent_term_id = $parent_result['term_id'];
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating parent term: ' . esc_html($parent_result->get_error_message());
                                            continue;
                                        }
                                    } else {
                                        $parent_term_id = $parent_term->term_id;
                                        //check if parrent term is already assigned to the post
                                        $assigned_terms = wp_get_post_terms( $post_id, $taxonomy_name, array( 'fields' => 'ids' ) );
                                        if( ! in_array( $parent_term_id, $assigned_terms ) ){
                                            wp_set_post_terms( $post_id, $parent_term_id, $taxonomy_name, true );
                                        }
                                    }
        
                                    // Get or create the child terms under the parent term
                                    $child_term_ids = array();
                                    foreach ($child_terms as $child_name) {
                                        $child_name = trim($child_name);
        
                                        $child_term = get_term_by('name', $child_name, $taxonomy_name);
                                        if (!$child_term) {
                                            $child_result = wp_insert_term($child_name, $taxonomy_name, array('parent' => $parent_term_id));
                                            if (!is_wp_error($child_result)) {
                                                $child_term_ids[] = $child_result['term_id'];
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating child term: ' . esc_html($child_result->get_error_message());
                                                continue;
                                            }
                                        } else {
                                            $child_term_ids[] = $child_term->term_id;
                                        }
                                    }
        
                                    // Assign the parent and child terms to the post
                                    wp_set_post_terms($post_id, array_merge(array($parent_term_id), $child_term_ids), $taxonomy_name, true);
                                } else {
                                    // No hierarchy, it's a standalone term
                                    $term_name = trim($taxonomy_term);
        
                                    // Get or create the term by name and taxonomy
                                    $term = get_term_by('name', $term_name, $taxonomy_name);
        
                                    if (!$term) {
                                        // Term does not exist, create a new one
                                        $term_result = wp_insert_term($term_name, $taxonomy_name);
        
                                        if (!is_wp_error($term_result)) {
                                            // Term already exists, assign it to the post
                                            $term_id = $term_result['term_id'];
                                            wp_set_post_terms($post_id, $term_id, $taxonomy_name, true);
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating term: ' . esc_html($term_result->get_error_message());
                                        }
                                    } else {
                                        wp_set_post_terms($post_id, $term->term_id, $taxonomy_name, true);
                                    }
                                }
                            }
                        }
                    }     

                    foreach ( $column_mapping_data as $column_index => $field ) {
                        if( $field == 'id' ){
                            $post_id = $row[$column_index];
                        }
                        if ( $field == 'post_title' ) {
                            $post_default_slug = $row[$column_index];
                            $post_title = ucwords(str_replace('-', ' ', $row[$column_index]));
                            if( empty( $post_title ) ){
                                $post_title = 'No Title';
                            }
                        } else if ( $field == 'post_content' ) {
                            $post_content = $row[$column_index];
                            if( empty( $post_content ) ){
                                $post_content = 'No Content';
                            }
                        }
                        if ( $field == 'slug' ) {
                            $post_slug = $row[$column_index];
                        }
                        if( $field == 'thumbnail' ){
                            $attach_id = $this->travelfic_import_image( $row[$column_index], $post_id );
                            if ( $attach_id ) {
                                $post_meta['_thumbnail_id'] = $attach_id;
                            }
                        }
                        if( $field == 'post_date' ){
                            $post_date = $row[$column_index];
                        }
        
                        if( $field == 'longitude' ){
                            $post_meta['tf_carrental_opt']['map'][$field] = $row[$column_index];
                        }else if( $field == 'latitude' ){
                            $post_meta['tf_carrental_opt']['map'][$field] = $row[$column_index];
                        }else if( $field == 'zoom' ){
                            $post_meta['tf_carrental_opt']['map'][$field] = $row[$column_index];
                        } else if ( strpos( $field, '[' ) !== false && strpos( $field, ']' ) !== false ) {
                            //exclude title, post content, features from adding into the array
                            // Field is a multidimensional array key, e.g., [location][latitude]
                            $nested_keys = explode( '][', trim($field, '[]' ) );
                            $meta_value = &$post_meta['tf_carrental_opt'];
                        
                            // Iterate through nested keys except the last one
                            for ( $i = 0; $i < count( $nested_keys ) - 1; $i++ ) {
                                $nested_key = $nested_keys[$i];
                        
                                // Create the nested array if it doesn't exist
                                if ( !isset( $meta_value[$nested_key] ) ) {
                                    $meta_value[$nested_key] = array();
                                }
                        
                                $meta_value = &$meta_value[$nested_key];
                            }
                            // Assign the value to the last nested key
                            $last_nested_key = end( $nested_keys );
                            $meta_value[$last_nested_key] = $row[$column_index];
        
                        } else if( $field == 'brands' ){
                            $features = explode( ',', $row[$column_index] );
                            $tf_carrental_brand = array();
                            foreach( $features as $feature ){
                                $term = get_term_by( 'name', $feature, 'carrental_brand' );
                                $term_id = $term ? $term->term_id : '';
                                $tf_carrental_brand[] = !empty($term_id) ? $term_id : '';
                            }
                            $post_meta['tf_carrental_opt']['brands'] = $tf_carrental_brand;
        
                        } else if( $field == 'fuel_types' ){
                            $carrental_fuel_type = explode( ',', $row[$column_index] );
                            $tf_carrental_fuel_type = array();
                            foreach( $carrental_fuel_type as $feature ){
                                $term = get_term_by( 'name', $feature, 'carrental_fuel_type' );
                                $term_id = $term ? $term->term_id : '';
                                $tf_carrental_fuel_type[] = !empty($term_id) ? $term_id : '';
                            }
                            $post_meta['tf_carrental_opt']['fuel_types'] = $tf_carrental_fuel_type;
        
                        }else if( $field == 'engine_years' ){
                            $carrental_engine_year = explode( ',', $row[$column_index] );
                            $tf_carrental_engine_year = array();
                            foreach( $carrental_engine_year as $feature ){
                                $term = get_term_by( 'name', $feature, 'carrental_engine_year' );
                                $term_id = $term ? $term->term_id : '';
                                $tf_carrental_engine_year[] = !empty($term_id) ? $term_id : '';
                            }
                            $post_meta['tf_carrental_opt']['engine_year'] = $tf_carrental_engine_year;
        
                        }else {
                            // Create an array to store post meta for the current row
                            $post_meta['tf_carrental_opt'][$field] = !empty($row[$column_index]) ? $row[$column_index] : '';
                        }    
        
                        if( $field == 'car_custom_info' && ! empty( $row[$column_index] ) ){
                            $car_custom_info = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $car_custom_info;
                        }
        
                        if ( $field === 'car_gallery' && ! empty( $row[ $column_index ] ) ) {
                            // Extract the image URLs from the CSV row
                            $image_urls = explode( ',', $row[ $column_index] );
                            $gallery_images = array();
                            
                            //include image.php for wp_generate_attachment_metadata() function
                            if( ! function_exists( 'wp_crop_image' ) ){
                                require_once ABSPATH . 'wp-admin/includes/image.php';
                            }
        
                            foreach ( $image_urls as $image_url ) {
                                $attach_id = $this->travelfic_import_image( $image_url, $post_id );
                                if ( $attach_id ) {
                                    $gallery_images[] = $attach_id;
                                }
                            }
        
                            // Combine the attachment IDs into a comma-separated string
                            $gallery_ids_string = implode( ',', $gallery_images );
            
                            // Assign the gallery IDs string to the tour_gallery meta field
                            $post_meta['tf_carrental_opt']['car_gallery'] = $gallery_ids_string;
                        }
        
                        if( $field == 'inc' && ! empty( $row[$column_index] ) ){
                            $inc = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $inc;
                        }
        
                        if( $field == 'day_prices' && ! empty( $row[$column_index] ) ){
                            $day_prices = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $day_prices;
                        }
        
                        if( $field == 'date_prices' && ! empty( $row[$column_index] ) ){
                            $date_prices = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $date_prices;
                        }
        
                        if( $field == 'exc' && ! empty( $row[$column_index] ) ){
                            $exc = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $exc;
                        }
        
                        if( $field == 'benefits' && ! empty( $row[$column_index] ) ){
                            $benefits = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $benefits;
                        }
        
                        if( $field == 'badge' && ! empty( $row[$column_index] ) ){
                            $badge = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $badge;
                        }
        
                        if( $field == 'extras' && ! empty( $row[$column_index] ) ){
                            $extras = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $extras;
                        }
        
                        if( $field == 'protections' && ! empty( $row[$column_index] ) ){
                            $protections = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $protections;
                        }
        
                        if( $field == 'cancellation_type' && ! empty( $row[$column_index] ) ){
                            $cancellation_types = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $cancellation_types;
                        }
        
                        if( $field == 'faq' && ! empty( $row[$column_index] ) ){
                            $faqs = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $faqs;
                        }
        
                        if( $field == 'terms_conditions' && ! empty( $row[$column_index] ) ){
                            $terms_conditions = json_decode( $row[$column_index], true );
                            $post_meta['tf_carrental_opt'][$field] = $terms_conditions;
                        }
                        
                    }
        
                    if ( ! function_exists( 'post_exists' ) ) {
                        require_once ABSPATH . 'wp-includes/post.php';
                    }
                   
                    // Create an array to store the post data for the current row
                    $post_data = array(
                        'post_type'    => 'tf_carrental',
                        'post_title'   => $post_title,
                        'post_content' => $post_content,
                        'post_status'  => 'publish',
                        'author'  => get_current_user_id(),
                        'post_date'    => $post_date,
                        'meta_input'   => $post_meta,
                        'post_name'    => !empty($post_slug) ? $post_slug : $post_default_slug,
                    );
    
                    $post_id = wp_insert_post( $post_data );
                    if(!empty($post_id)){
                        update_post_meta($post_id, 'tf_search_car_rent', 120);
                        update_post_meta($post_id, 'tf_search_driver_age', 24);
                    }
        
                    //assign or create taxonomies to the imported cars
                    if (!empty($taxonomies)) {
                        foreach ($taxonomies as $taxonomy => $values) {
                            // Extract the taxonomy terms from the CSV row
                            $taxonomy_terms = explode(',', $values);

                            foreach ($taxonomy_terms as $taxonomy_term) {
                                // Get the taxonomy name based on the column name
                                $taxonomy_name = $taxonomy; // Assuming the column names match the taxonomy names

                                // Check if ">" string is present in the text
                                if (strpos($taxonomy_term, '>') !== false) {
                                    $taxonomy_parts = explode('>', $taxonomy_term);
                                    $parent_name    = trim($taxonomy_parts[0]);
                                    if(  strpos( $taxonomy_parts[1], '+' ) !== false ){
                                        $child_terms = explode('+', $taxonomy_parts[1]);
                                    }else{
                                        $child_terms = array( $taxonomy_parts[1] );
                                    }

                                    // Get or create the parent term
                                    $parent_term = get_term_by('name', $parent_name, $taxonomy_name);
                                    if (!$parent_term) {
                                        $parent_result = wp_insert_term($parent_name, $taxonomy_name);
                                        if (!is_wp_error($parent_result)) {
                                            $parent_term_id = $parent_result['term_id'];
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating parent term: ' . esc_html($parent_result->get_error_message());
                                            continue;
                                        }
                                    } else {
                                        $parent_term_id = $parent_term->term_id;
                                        //check if parrent term is already assigned to the post
                                        $assigned_terms = wp_get_post_terms( $post_id, $taxonomy_name, array( 'fields' => 'ids' ) );
                                        if( ! in_array( $parent_term_id, $assigned_terms ) ){
                                            wp_set_post_terms( $post_id, $parent_term_id, $taxonomy_name, true );
                                        }
                                    }

                                    // Get or create the child terms under the parent term
                                    $child_term_ids = array();
                                    foreach ($child_terms as $child_name) {
                                        $child_name = trim($child_name);

                                        $child_term = get_term_by('name', $child_name, $taxonomy_name);
                                        if (!$child_term) {
                                            $child_result = wp_insert_term($child_name, $taxonomy_name, array('parent' => $parent_term_id));
                                            if (!is_wp_error($child_result)) {
                                                $child_term_ids[] = $child_result['term_id'];
                                            } else {
                                                // Handle error if necessary
                                                echo 'Error creating child term: ' . esc_html($child_result->get_error_message());
                                                continue;
                                            }
                                        } else {
                                            $child_term_ids[] = $child_term->term_id;
                                        }
                                    }

                                    // Assign the parent and child terms to the post
                                    wp_set_post_terms($post_id, array_merge(array($parent_term_id), $child_term_ids), $taxonomy_name, true);
                                } else {
                                    // No hierarchy, it's a standalone term
                                    $term_name = trim($taxonomy_term);

                                    // Get or create the term by name and taxonomy
                                    $term = get_term_by('name', $term_name, $taxonomy_name);

                                    if (!$term) {
                                        // Term does not exist, create a new one
                                        $term_result = wp_insert_term($term_name, $taxonomy_name);

                                        if (!is_wp_error($term_result)) {
                                            // Term already exists, assign it to the post
                                            $term_id = $term_result['term_id'];
                                            wp_set_post_terms($post_id, $term_id, $taxonomy_name, true);
                                        } else {
                                            // Handle error if necessary
                                            echo 'Error creating term: ' . esc_html($term_result->get_error_message());
                                        }
                                    } else {
                                        wp_set_post_terms($post_id, $term->term_id, $taxonomy_name, true);
                                    }
                                }
                            }
                        }
                    }
                    //reset the post meta array
                    $post_meta = array();           
                }
        
                wp_die();
            }
        }

		function travelfic_regenerate_room_meta() {

			$args  = array(
				'post_type'      => 'tf_hotel',
				'post_status'    => 'publish',
				'posts_per_page' => - 1
			);
			$posts = new \WP_Query( $args );
			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();
					$post_id = get_the_ID();
					$meta    = get_post_meta( $post_id, 'tf_hotels_opt', true );

					$rooms = ! empty( $meta['room'] ) ? $meta['room'] : '';
					if ( ! empty( $rooms ) && gettype( $rooms ) == "string" ) {
						$tf_hotel_rooms_value = preg_replace_callback( '!s:(\d+):"(.*?)";!', function ( $match ) {
							return ( $match[1] == strlen( $match[2] ) ) ? $match[0] : 's:' . strlen( $match[2] ) . ':"' . $match[2] . '";';
						}, $rooms );
						$rooms                = unserialize( $tf_hotel_rooms_value );
					}

					$current_user_id = get_current_user_id();
                    $room_ids = array();
					foreach ( $rooms as $room ) {
						$post_data        = array(
							'post_type'    => 'tf_room',
							'post_title'   => ! empty( $room['title'] ) ? $room['title'] : 'No Title',
							'post_status'  => 'publish',
							'post_author'  => $current_user_id,
							'post_content' => ! empty( $room['description'] ) ? $room['description'] : '',
						);
						$room['tf_hotel'] = $post_id;

						$room_post_id = wp_insert_post( $post_data );
						update_post_meta( $room_post_id, 'tf_room_opt', $room );
                        $room_ids[] = $room_post_id;

						// Import thumbnail (prevent duplicates)
                        if ( ! empty( $room['room_preview_img'] ) ) {
                            $attachment_id = $this->travelfic_import_image( $room['room_preview_img'], $room_post_id );
                            if ( $attachment_id ) {
                                set_post_thumbnail( $room_post_id, $attachment_id );
                            }
                        }
					}

                    $meta['tf_rooms'] = $room_ids;
                    update_post_meta( $post_id, 'tf_hotels_opt', $meta );
				}
			}
		}
	}


}

new Travelfic_Template_Importer();