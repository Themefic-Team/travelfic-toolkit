<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Apartment Location Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_ApartmentLocation extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-apartment-location';
	public $icon     = 'ti-map-alt';
	public $scripts  = [ 'tftBricksApartmentLocation' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/apartment-location.js';

		wp_register_script(
			'tft-bricks-apartment-location',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/apartment-location.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function get_label() {
		return esc_html__( 'Travelfic Apartment Location', 'travelfic-toolkit' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-tour-destination' );
		wp_enqueue_script( 'tft-bricks-apartment-location' );
	}

	public function set_control_groups() {
		// Content Tab
		$this->control_groups['apartments_locations'] = [
			'title' => esc_html__( 'Apartment Location', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tab
		$this->control_groups['apartments_locations_style'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// Fetch category options dynamically
		$categories = get_categories( array(
			'taxonomy'   => 'apartment_location',
			'hide_empty' => true,
		) );
		$category_options = array();
		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		// ========== CONTENT GROUP ==========
		$this->controls['aprt_location_style'] = [
			'tab'     => 'content',
			'group'   => 'apartments_locations',
			'type'    => 'select',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
			],
		];

		$this->controls['location_section_bg'] = [
			'tab'      => 'content',
			'group'    => 'apartments_locations',
			'label'    => esc_html__( 'Section Background', 'travelfic-toolkit' ),
			'type'     => 'image',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['des_title'] = [
			'tab'         => 'content',
			'group'       => 'apartments_locations',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Next level of living', 'travelfic-toolkit' ),
			'required'    => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['des_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'apartments_locations',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Destinations', 'travelfic-toolkit' ),
			'required'    => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['categories_id'] = [
			'tab'      => 'content',
			'group'    => 'apartments_locations',
			'label'    => esc_html__( 'Select Apartment Location', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => $category_options,
			'default'  => '',
			'multiple' => true,
		];

		$this->controls['post_per_page'] = [
			'tab'     => 'content',
			'group'   => 'apartments_locations',
			'label'   => esc_html__( 'Item Limit', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 4,
		];

		$this->controls['cat_order'] = [
			'tab'     => 'content',
			'group'   => 'apartments_locations',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'DESC',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
		];

		// ========== STYLE: DESIGN 1 ==========

		// Title (Design 1)
		$this->controls['apartments_locations_title_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-1' ],
		];

		// Note: typography includes color in Bricks — no separate color control
		$this->controls['apartments_locations_title'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__one .tft-destination-title a',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-1' ],
		];

		// ========== STYLE: DESIGN 2 ==========

		// Section Title (Design 2)
		$this->controls['apartments_locations_design_2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Note: typography includes color in Bricks — no separate color control
		$this->controls['apartments_locations_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-destination-header h3',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Subtitle (Design 2)
		$this->controls['apartments_locations_design_2_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Note: typography includes color in Bricks — no separate color control
		$this->controls['apartments_locations_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Card (Design 2)
		$this->controls['apartments_locations_design_2_card_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['apartment_location_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3, .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['apartment_destination_card_opacity'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Overlay', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-thumbnail::before',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Card Title (Design 2)
		$this->controls['single_destination_title_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Note: typography includes color in Bricks — no separate color control
		$this->controls['single_destination_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content h3',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Card Button (Design 2)
		$this->controls['single_destination_button_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Note: typography includes color in Bricks — no separate color control
		$this->controls['single_destination_button_typo'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['about_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_color'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
				[
					'property' => 'stroke',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span svg path',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_button_bg'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-destination-design__two .tft-single-destination .tft-destination-content span',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		// Arrows (Design 2)
		$this->controls['apartments_locations_design_2_arrows_head'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];

		$this->controls['single_destination_arrows_color'] = [
			'tab'      => 'style',
			'group'    => 'apartments_locations_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'fill',
					'selector' => '.tft-destination-design__two .tft-destination-content .tft-destination-slides .slick-arrow path',
				],
			],
			'required' => [ 'aprt_location_style', '=', 'design-2' ],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\ApartmentLocation::render( $settings, 'bricks' );

		echo '</div>';
	}
}
