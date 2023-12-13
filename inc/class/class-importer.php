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
			add_action( 'wp_ajax_travelfic-customizer-hotel-import', array( $this, 'prepare_travelfic_hotel_imports' ) );
			add_action( 'wp_ajax_travelfic-customizer-tour-import', array( $this, 'prepare_travelfic_tour_imports' ) );
			add_action( 'wp_ajax_travelfic-customizer-pages-import', array( $this, 'prepare_travelfic_pages_imports' ) );
		}

		/**
		 * Tourfic Global Settings
		 */
		public function prepare_travelfic_global_settings() {
            $settings_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/settings.json';
            if (file_exists($settings_files)) {
                $imported_data = file_get_contents($settings_files);
                $imported_data = unserialize( $imported_data );
                update_option( 'tf_settings', $imported_data );
                wp_send_json_success($imported_data);
                die();
            }
		}

        /**
		 * Tourfic Customizer Settings
		 */
		public function prepare_travelfic_customizer_settings() {
            // $customizer_data = get_theme_mods();

            // // Output or use the retrieved data
            // var_dump(json_encode($customizer_data));

            $customizers_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/customizer.json';
            if (file_exists($customizers_files)) {
                $imported_data = file_get_contents($customizers_files);
                $imported_data = json_decode( $imported_data, true );
                foreach ($imported_data as $key => $value) {
                    set_theme_mod($key, $value);
                }
                die();
            }
		}

        /**
		 * Tourfic Customizer Settings
		 */
		public function prepare_travelfic_pages_imports() {
            
            // $response = wp_remote_get( 'https://websitedemos.net/love-nature-fse/wp-json/wp/v2/pages/282' );

			// if ( is_wp_error( $response ) ) {
			// 	wp_send_json_error( wp_remote_retrieve_body( $response ) );
			// }

			// $body = wp_remote_retrieve_body( $response );
			// $data = json_decode( $body, true );
            // $meta    = json_decode( $data['post-meta']['_elementor_data'], true );
            // // tf_var_dump($data);
            // tf_var_dump($data);

            $customizers_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/pages.json';
            if (file_exists($customizers_files)) {
                $imported_data = file_get_contents($customizers_files);
                $imported_data = json_decode( $imported_data, true );
                foreach($imported_data as $page){
                    $title = $page['title'];
                    $content = $page['content'];
                    $pages_images = $page['media_urls'];
                    $media_urls = explode(", ", $pages_images);
                    $update_media_url = [];
                    foreach($media_urls as $media){
                        if(!empty($media)){
                            // Download the image file
                            $page_image_data = file_get_contents( $media );
                            
                            // Create a unique filename for the image
                            $page_filename   = basename( $media );
                            $page_upload_dir = wp_upload_dir();
                            $page_image_path = $page_upload_dir['path'] . '/' . $page_filename;
                    
                            // Save the image file to the uploads directory
                            file_put_contents( $page_image_path, $page_image_data );
                            
                            if (file_exists($page_image_path)) {
                                // Create the attachment for the uploaded image
                                $page_attachment = array(
                                    'guid'           => $page_upload_dir['url'] . '/' . $page_filename,
                                    'post_mime_type' => 'image/jpeg',
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
                    
                                $update_media_url[$media] = wp_get_attachment_url($page_attachment_id);
                            }
                        }
                    }
                    // // Create a new page programmatically
                    // $new_page = array(
                    //     'post_title' => $title,
                    //     'post_content' => $content,
                    //     'post_status' => 'publish',
                    //     'post_type' => 'page'
                    // );

                    // // Insert the page into the database
                    // $new_page_id = wp_insert_post($new_page);

                    // update_post_meta($new_page_id, 'tft-pmb-disable-sidebar', $page['tft-pmb-disable-sidebar']);
                    // update_post_meta($new_page_id, 'tft-pmb-banner', $page['tft-pmb-banner']);
                    // update_post_meta($new_page_id, 'tft-pmb-transfar-header', $page['tft-pmb-transfar-header']);
                    // update_post_meta($new_page_id, '_wp_page_template', $page['_wp_page_template']);
                    // update_post_meta($new_page_id, 'tft-pmb-background-img', $page['tft-pmb-background-img']);
                    // update_post_meta($new_page_id, 'tft-pmb-subtitle', $page['tft-pmb-subtitle']);
                    // update_post_meta($new_page_id, '_elementor_template_type', $page['_elementor_template_type']);
                    // update_post_meta($new_page_id, '_elementor_data', $page['_elementor_data']);
                    // update_post_meta($new_page_id, '_elementor_page_assets', $page['_elementor_page_assets']);
                    // update_post_meta($new_page_id, '_elementor_edit_mode', $page['_elementor_edit_mode']);
                    // update_post_meta($new_page_id, '_elementor_css', $page['_elementor_css']);
                }
                die();
            }
		}

        /**
		 * Tourfic Hotel importer Settings
		 */
		public function prepare_travelfic_hotel_imports() {

            $dummy_hotels_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/hotel-data.csv';
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
                                                echo 'Error creating parent term: ' . $parent_result->get_error_message();
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
                                                    echo 'Error creating child term: ' . $child_result->get_error_message();
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
                                                echo 'Error creating term: ' . $term_result->get_error_message();
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
                                $thumbnail = $row[$column_index];
                                //set as the post thumbnail.
                                if (!empty( $thumbnail )) {
                                    // Get the file name from the URL.
                                    $filename = basename($thumbnail);

                                    // Download the image to the server.
                                    $upload_dir = wp_upload_dir();
                                    $image_path = $upload_dir['path'] . '/' . $filename;

                                    $image_data = file_get_contents($thumbnail);
                                    file_put_contents($image_path, $image_data);

                                    // Check if the image was downloaded successfully.
                                    if (file_exists($image_path)) {
                                        // Create the attachment in the media library.
                                        $attachment = array(
                                            'guid'           => $upload_dir['url'] . '/' . $filename,
                                            'post_mime_type' => 'image/jpeg', // Replace with the appropriate mime type if needed.
                                            'post_title'     => sanitize_file_name($filename),
                                            'post_content'   => '',
                                            'post_status'    => 'inherit',
                                        );

                                        $attach_id = wp_insert_attachment($attachment, $image_path, $post_id);

                                        // Include the necessary file for media_handle_sideload().
                                        require_once(ABSPATH . 'wp-admin/includes/image.php');

                                        // Set the image as the post thumbnail.
                                        $attach_data = wp_generate_attachment_metadata($attach_id, $image_path);
                                        wp_update_attachment_metadata($attach_id, $attach_data);

                                        $post_meta['_thumbnail_id'] = $attach_id;
                                    }
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

                                //include image.php for wp_generate_attachment_metadata() function
                                if( ! function_exists( 'wp_crop_image' ) ){
                                    require_once ABSPATH . 'wp-admin/includes/image.php';
                                }

                                foreach ( $image_urls as $image_url ) {
                                    if(!empty($image_url)){
                                        // Download the image file
                                        $image_data = file_get_contents( $image_url );
                                        //if not found image
                                        if( $image_data === false ){
                                            continue;
                                        }
                                        // Create a unique filename for the image
                                        $filename   = basename( $image_url );
                                        $upload_dir = wp_upload_dir();
                                        $image_path = $upload_dir['path'] . '/' . $filename;
                    
                                        // Save the image file to the uploads directory
                                        $result = file_put_contents( $image_path, $image_data );
                                        
                                        //failed to save image
                                        if( $result === false ){
                                            continue;
                                        }
                    
                                        // Create the attachment for the uploaded image
                                        $attachment = array(
                                            'guid'           => $upload_dir['url'] . '/' . $filename,
                                            'post_mime_type' => 'image/jpeg',
                                            'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
                                            'post_content'   => '',
                                            'post_status'    => 'inherit'
                                        );
                    
                                        // Insert the attachment
                                        $attachment_id = wp_insert_attachment( $attachment, $image_path );                       
                    
                                        // Generate the attachment metadata
                                        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $image_path );
                                        wp_update_attachment_metadata( $attachment_id, $attachment_data );
                    
                                        // Add the attachment ID to the gallery images array
                                        $gallery_images[] = $attachment_id;
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
                                    $gallery_index     = $room_gall + 1;
                                    $image_urls        = explode( ',', $room_gall_gallery_array[$gallery_index] );
                    
                                    $gallery_images = array();
                
                                    //include image.php for wp_generate_attachment_metadata() function
                                    if( ! function_exists( 'wp_crop_image' ) ){
                                        require_once ABSPATH . 'wp-admin/includes/image.php';
                                    }
                
                                    foreach ( $image_urls as $image_url ) {
                                        
                                        if(!empty($image_url)){
                                            // Download the image file
                                            $image_data = file_get_contents( $image_url );
                                            //if not found image
                                            if( $image_data === false ){
                                                continue;
                                            }
                                            // Create a unique filename for the image
                                            $filename   = basename( $image_url );
                                            $upload_dir = wp_upload_dir();
                                            $image_path = $upload_dir['path'] . '/' . $filename;
                        
                                            // Save the image file to the uploads directory
                                            $result = file_put_contents( $image_path, $image_data );
                                            
                                            //failed to save image
                                            if( $result === false ){
                                                continue;
                                            }
                        
                                            // Create the attachment for the uploaded image
                                            $attachment = array(
                                                'guid'           => $upload_dir['url'] . '/' . $filename,
                                                'post_mime_type' => 'image/jpeg',
                                                'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
                                                'post_content'   => '',
                                                'post_status'    => 'inherit'
                                            );
                        
                                            // Insert the attachment
                                            $attachment_id = wp_insert_attachment( $attachment, $image_path );                       
                        
                                            // Generate the attachment metadata
                                            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $image_path );
                                            wp_update_attachment_metadata( $attachment_id, $attachment_data );
                        
                                            // Add the attachment ID to the gallery images array
                                            $gallery_images[] = $attachment_id;
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
                                        $term_id = $term->term_id;
                                        $room_features[$fkey][$key] = $term_id;
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
                            'post_author'  => 1,
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
                                                echo 'Error creating parent term: ' . $parent_result->get_error_message();
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
                                                    echo 'Error creating child term: ' . $child_result->get_error_message();
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
                                                echo 'Error creating term: ' . $term_result->get_error_message();
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
                wp_die();
            }
		}

        /**
		 * Tourfic Tour importer Settings
		 */
		public function prepare_travelfic_tour_imports() {

            $dummy_tours_files = TRAVELFIC_TOOLKIT_PATH.'inc/demo/1/tour-data.csv';
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
                                            echo 'Error creating parent term: ' . $parent_result->get_error_message();
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
                                                echo 'Error creating child term: ' . $child_result->get_error_message();
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
                                            echo 'Error creating term: ' . $term_result->get_error_message();
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
                            $thumbnail = $row[$column_index];
                            //set as the post thumbnail.
                            if (!empty( $thumbnail )) {
                                // Get the file name from the URL.
                                $filename = basename($thumbnail);
        
                                // Download the image to the server.
                                $upload_dir = wp_upload_dir();
                                $image_path = $upload_dir['path'] . '/' . $filename;
        
                                $image_data = file_get_contents($thumbnail);
                                file_put_contents($image_path, $image_data);
        
                                // Check if the image was downloaded successfully.
                                if (file_exists($image_path)) {
                                    // Create the attachment in the media library.
                                    $attachment = array(
                                        'guid'           => $upload_dir['url'] . '/' . $filename,
                                        'post_mime_type' => 'image/jpeg', // Replace with the appropriate mime type if needed.
                                        'post_title'     => sanitize_file_name($filename),
                                        'post_content'   => '',
                                        'post_status'    => 'inherit',
                                    );
        
                                    $attach_id = wp_insert_attachment($attachment, $image_path, $post_id);
        
                                    // Include the necessary file 
                                    require_once(ABSPATH . 'wp-admin/includes/image.php');
        
                                    // Set the image as the post thumbnail.
                                    $attach_data = wp_generate_attachment_metadata($attach_id, $image_path);
                                    wp_update_attachment_metadata($attach_id, $attach_data);
        
                                    $post_meta['_thumbnail_id'] = $attach_id;
                                }
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
                                if(!empty($image_url)){
                                    // Download the image file
                                    $image_data = file_get_contents( $image_url );
                                    //if not found image
                                    if( $image_data === false ){
                                        continue;
                                    }
                                    // Create a unique filename for the image
                                    $filename = basename( $image_url );
                                    $upload_dir = wp_upload_dir();
                                    $image_path = $upload_dir['path'] . '/' . $filename;
                
                                    // Save the image file to the uploads directory
                                    $result = file_put_contents( $image_path, $image_data );
                                    
                                    //failed to save image
                                    if( $result === false ){
                                        continue;
                                    }
                
                                    // Create the attachment for the uploaded image
                                    $attachment = array(
                                        'guid'           => $upload_dir['url'] . '/' . $filename,
                                        'post_mime_type' => 'image/jpeg',
                                        'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
                                        'post_content'   => '',
                                        'post_status'    => 'inherit'
                                    );
                
                                    // Insert the attachment
                                    $attachment_id = wp_insert_attachment( $attachment, $image_path );                       
                
                                    // Generate the attachment metadata
                                    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $image_path );
                                    wp_update_attachment_metadata( $attachment_id, $attachment_data );
                
                                    // Add the attachment ID to the gallery images array
                                    $gallery_images[] = $attachment_id;
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
                                    if(!empty($image_url)){
                                        // Download the image file
                                        $image_data = file_get_contents( $image_url );
                                        //if not found image
                                        if( $image_data === false ){
                                            continue;
                                        }
                                        // Create a unique filename for the image
                                        $filename   = basename( $image_url );
                                        $upload_dir = wp_upload_dir();
                                        $image_path = $upload_dir['path'] . '/' . $filename;
                    
                                        // Save the image file to the uploads directory
                                        $result = file_put_contents( $image_path, $image_data );
                                        
                                        //failed to save image
                                        if( $result === false ){
                                            continue;
                                        }
                    
                                        // Create the attachment for the uploaded image
                                        $attachment = array(
                                            'guid'           => $upload_dir['url'] . '/' . $filename,
                                            'post_mime_type' => 'image/jpeg',
                                            'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
                                            'post_content'   => '',
                                            'post_status'    => 'inherit'
                                        );
                    
                                        // Insert the attachment
                                        $attachment_id = wp_insert_attachment( $attachment, $image_path );                       
                    
                                        // Generate the attachment metadata
                                        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $image_path );
                                        wp_update_attachment_metadata( $attachment_id, $attachment_data );
                    
                                        // Add the attachment ID to the gallery images array
                                        $gallery_images[] = $attachment_id;
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
                        'post_author'  => 1,
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
                                            echo 'Error creating parent term: ' . $parent_result->get_error_message();
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
                                                echo 'Error creating child term: ' . $child_result->get_error_message();
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
                                            echo 'Error creating term: ' . $term_result->get_error_message();
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
	}
}

new Travelfic_Template_Importer();