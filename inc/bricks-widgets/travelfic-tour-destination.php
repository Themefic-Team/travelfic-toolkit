<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Tour Destinations Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_TourDestinations extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-destinations-tours';
	public $icon     = 'ti-location-pin'; // Matching tour destination icon
	public $scripts  = [ 'tftBricksTourDestinations' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/tour-destination.js';

		wp_register_script(
			'tft-bricks-tour-destination',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/tour-destination.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-tour-destination' );
		wp_enqueue_script( 'tft-bricks-tour-destination' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Tour Destinations', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['tour_destination'] = [
			'title' => esc_html__( 'Tour Destinations', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['tour_destination_style'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// tour destination get categories
		$categories = get_categories( array(
			'taxonomy'   => 'tour_destination',
			'hide_empty' => true,
		) );

		$category_options = array();
		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		// tour attractions get categories
		$attraction_categories = get_categories( array(
			'taxonomy'   => 'tour_attraction',
			'hide_empty' => true,
		) );

		// tour attractions store categories in array
		$attractions_cat_options = array();
		foreach ( $attraction_categories as $cat ) {
			$attractions_cat_options[ $cat->term_id ] = $cat->name;
		}

		// ========== CONTENT GROUP ==========
		// Design
		$this->controls['des_style'] = [
			'tab'     => 'content',
			'group'   => 'tour_destination',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
				'design-3' => esc_html__( 'Design 3', 'travelfic-toolkit' ),
			],
			'default' => 'design-1',
		];

		// Design 2 fields
		$this->controls['location_section_bg'] = [
			'tab'      => 'content',
			'group'    => 'tour_destination',
			'label'    => esc_html__( 'Section Background', 'travelfic-toolkit' ),
			'type'     => 'image',
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['des_title'] = [
			'tab'         => 'content',
			'group'       => 'tour_destination',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Top destinations', 'travelfic-toolkit' ),
			'required'    => [ 'des_style', '!=', 'design-1' ],
		];

		$this->controls['des_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'tour_destination',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Destinations', 'travelfic-toolkit' ),
			'required'    => [ 'des_style', '!=', 'design-1' ],
		];

		$this->controls['des_description'] = [
			'tab'         => 'content',
			'group'       => 'tour_destination',
			'label'       => esc_html__( 'Destination Descriptions', 'travelfic-toolkit' ),
			'type'        => 'editor',
			'placeholder' => esc_html__( 'Enter your descriptions', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'We offer amazing properties that are full of character, situated in beautiful neighborhoods so you can feel right at home anywhere in the world travel society for healthy life backup.', 'travelfic-toolkit' ),
			'required'    => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['readme_label'] = [
			'tab'         => 'content',
			'group'       => 'tour_destination',
			'label'       => esc_html__( 'Button Label', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter button label', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'View All Destination', 'travelfic-toolkit' ),
			'required'    => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['readme_url'] = [
			'tab'      => 'content',
			'group'    => 'tour_destination',
			'label'    => esc_html__( 'Button URL', 'travelfic-toolkit' ),
			'type'     => 'link',
			'default'  => [
				'url' => '#',
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_destination_head'] = [
			'group' => 'tour_destination',
			'label' => esc_html__( 'Destination Lists', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		// Tour
		$this->controls['categories_id'] = [
			'tab'      => 'content',
			'group'    => 'tour_destination',
			'label'    => esc_html__( 'Select Tour Destinations', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => $category_options,
			'multiple' => true,
			'required' => [
				[ 'des_style', '=', 'design-1' ],
				[ 'des_style', '=', 'design-2' ],
				[ 'des_style', '=', 'design-3' ],
			],
		];

		$this->controls['attractions_cat_id'] = [
			'tab'      => 'content',
			'group'    => 'tour_destination',
			'label'    => esc_html__( 'Select Tour Attractions', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => $attractions_cat_options,
			'multiple' => true,
			'required' => [ 'des_style', '=', 'design-4' ],
		];

		$this->controls['post_per_page'] = [
			'tab'     => 'content',
			'group'   => 'tour_destination',
			'label'   => esc_html__( 'Item Limit', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 4,
			'min'     => 1,
			'max'     => 100,
		];

		$this->controls['cat_order'] = [
			'tab'     => 'content',
			'group'   => 'tour_destination',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
			'default' => 'DESC',
		];

		// ========== STYLE GROUP ==========
		// Design 2 Styles - Title
		$this->controls['tour_destination_design2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['tour_destination_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		// Design 2 Styles - Subtitle
		$this->controls['tour_destination_design2_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['tour_destination_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		// Design 2 Styles - Card
		$this->controls['tour_destination_card_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['tour_destination_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['tour_destination_card_opacity'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Overlay', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail::before',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		// Design 2 Styles - Single Destination Title
		$this->controls['single_destination_title_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Card Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content h3',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		// Design 2 Styles - Single Destination Button
		$this->controls['single_destination_button_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_color'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Icon Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'stroke',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span svg path',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_bg'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span',
				],
			],
			'required' => [ 'des_style', '=', 'design-2' ],
		];

		// Design 1 Styles - Title
		$this->controls['tour_destination_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-1' ],
		];

		$this->controls['tour_destination_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__one .tft-destination-title a',
				],
			],
			'required' => [ 'des_style', '=', 'design-1' ],
		];

		// Design 1 Styles - Subtitle
		$this->controls['tour_destination_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-1' ],
		];

		$this->controls['tour_destination_sub_list_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__one .tft-destination-details ul li a',
				],
			],
			'required' => [ 'des_style', '=', 'design-1' ],
		];

		// Design 3 Styles - Title
		$this->controls['tour_destination_header_design_3'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_design_3_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__three .tft-destination-content .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		// Design 3 Title Backdrop
		$this->controls['tour_destination_design3_title_backdrop'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_design3_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Backdrop Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-destination-design__three .tft-heading-content .tft-section-title::after',
				],
			],
			'required' => [
				[ 'des_style', '=', 'design-3' ],
				[ 'tour_destination_design3_title_backdrop', '=', true ],
			],
		];

		// Design 3 Styles - Subtitle
		$this->controls['tour_destination_subtitle_design3'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_sub_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		// Design 3 Styles - Content
		$this->controls['tour_destination_content_design_3'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_content_design_3_typo'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-content p',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		// Design 3 Styles - Button
		$this->controls['tour_destination_buttons_style'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_button_typography'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__three .tft-btn',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_button_margin_design3'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-destination-design__three .tft-btn',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_button_padding_design3'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__three .tft-btn',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_button_border_design3'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.tft-destination-design__three .tft-btn',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_button_background_color'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-destination-design__three .tft-btn',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		// Design 3 Styles - Card
		$this->controls['tour_destination_card_heading'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_design3_card_opacity'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Overlay', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail::after',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		// Design 3 Styles - Card Title
		$this->controls['tour_destination_card_title_heading'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Card Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_card_title_typography'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3 a',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		// Design 3 Styles - Card Content
		$this->controls['tour_destination_card_para_heading'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Card Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'des_style', '=', 'design-3' ],
		];

		$this->controls['tour_destination_card_para_typography'] = [
			'tab'      => 'style',
			'group'    => 'tour_destination_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__three .tft-destination-content p',
				],
			],
			'required' => [ 'des_style', '=', 'design-3' ],
		];
	}

	public function render() {
		$settings = $this->settings;
		$this->set_attribute( '_root', 'style', 'width: 100%;' );

		echo '<div ' . $this->render_attributes( '_root' ) . '>';
		\Travelfic_Toolkit\Components\TourDestinations::render( $settings, 'bricks' );
		echo '</div>';
	}
}
