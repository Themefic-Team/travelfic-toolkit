<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Hotel Location Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_HotelLocation extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-locations-hotel';
	public $icon     = 'ti-map-alt';
	public $scripts  = [ 'tftBricksHotelLocation' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/hotel-location.js';

		wp_register_script(
			'tft-bricks-hotel-location',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/hotel-location.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-tour-destination' );
		wp_enqueue_script( 'tft-bricks-hotel-location' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Hotel Location', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['hotel_location'] = [
			'title' => esc_html__( 'Hotel Locations', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['hotel_location_style_tab'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// Fetch category options dynamically
		$categories = get_categories( array(
			'taxonomy'   => 'hotel_location',
			'hide_empty' => true,
		) );
		$category_options = array();
		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		$this->controls['hotel_location_style'] = [
			'tab'     => 'content',
			'group'   => 'hotel_location',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
			],
			'default' => 'design-1',
		];

		$this->controls['location_section_bg'] = [
			'tab'      => 'content',
			'group'    => 'hotel_location',
			'label'    => esc_html__( 'Section Background', 'travelfic-toolkit' ),
			'type'     => 'image',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['des_title'] = [
			'tab'         => 'content',
			'group'       => 'hotel_location',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Top Hotel Locations', 'travelfic-toolkit' ),
			'required'    => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['des_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'hotel_location',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Locations', 'travelfic-toolkit' ),
			'required'    => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_categories_id'] = [
			'tab'      => 'content',
			'group'    => 'hotel_location',
			'label'    => esc_html__( 'Select Hotel Location', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => $category_options,
			'default'  => '',
			'multiple' => true,
		];

		$this->controls['post_per_page'] = [
			'tab'     => 'content',
			'group'   => 'hotel_location',
			'label'   => esc_html__( 'Item Limit', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 4,
		];

		$this->controls['hotel_cat_order'] = [
			'tab'     => 'content',
			'group'   => 'hotel_location',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
			'default' => 'DESC',
		];

		// Design 1 Style Controls
		$this->controls['hotel_location_title_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-1' ],
		];

		$this->controls['hotel_location_title'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__one .tft-destination-title a',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-1' ],
		];

		$this->controls['hotel_location_image_border'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Image Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'selector' => '.tft-destination-design__one .tft-destination-thumbnail img',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-1' ],
		];

		// Design 2 Style Controls
		$this->controls['hotel_locations_design_2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_locations_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-destination-header h3',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_locations_design_2_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_locations_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_locations_design_2_card_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['apartment_location_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3, .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['apartment_destination_card_opacity'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Overlay', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail::before',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_location_design2_image_border'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Image Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_title_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content h3',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_typo'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_bg'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['hotel_locations_design_2_arrows_head'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_arrows_color'] = [
			'tab'      => 'style',
			'group'    => 'hotel_location_style_tab',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'fill',
					'selector' => '.tft-destination-design__two .tft-destination-header .tft-destination-slides-arrows button svg path',
				],
			],
			'required' => [ 'hotel_location_style', '=', 'design-2' ],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\HotelLocation::render( $settings, 'bricks' );

		echo '</div>';
	}
}
