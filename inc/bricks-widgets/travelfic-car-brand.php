<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Car Brands Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_CarBrands extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-car-brands';
	public $icon     = 'ti-carousel';
	public $scripts  = [ 'tftBricksCarBrands' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/car-brand.js';

		wp_register_script(
			'tft-bricks-car-brands',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/car-brand.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-cars-brand' );
		wp_enqueue_script( 'tft-bricks-car-brands' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Car Brands', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['carrental_brand'] = [
			'title' => esc_html__( 'Car Brand', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['tour_destination_style'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// Car categories
		$categories = get_categories( array(
			'taxonomy'   => 'carrental_brand',
			'hide_empty' => true,
		) );

		$category_options = array();
		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		$this->controls['des_title'] = [
			'tab'         => 'content',
			'group'       => 'carrental_brand',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Browse by Brand', 'travelfic-toolkit' ),
		];

		$this->controls['des_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'carrental_brand',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Find the ideal vehicle for your specific needs by exploring our diverse range of car types. Whether it’s a solo business trip, a family vacation, or an off-road adventure, we have the perfect ride waiting for you.', 'travelfic-toolkit' ),
		];

		$this->controls['categories_id'] = [
			'tab'      => 'content',
			'group'    => 'carrental_brand',
			'label'    => esc_html__( 'Select Car Brand', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => $category_options,
			'multiple' => true,
		];

		$this->controls['post_per_page'] = [
			'tab'     => 'content',
			'group'   => 'carrental_brand',
			'label'   => esc_html__( 'Item Limit', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 4,
			'min'     => 1,
			'max'     => 100,
		];

		$this->controls['cat_style'] = [
			'tab'     => 'content',
			'group'   => 'carrental_brand',
			'label'   => esc_html__( 'Style', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'slider' => esc_html__( 'Slider', 'travelfic-toolkit' ),
				'grid'   => esc_html__( 'Grid', 'travelfic-toolkit' ),
			],
			'default' => 'slider',
		];

		$this->controls['cat_order'] = [
			'tab'     => 'content',
			'group'   => 'carrental_brand',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
			'default' => 'DESC',
		];

		// ========== STYLE GROUP ==========
		$this->controls['car_brand_header'] = [
			'tab'    => 'style',
			'group'  => 'tour_destination_style',
			'label'  => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'   => 'separator',
		];

		$this->controls['popular_car_item_title'] = [
			'tab'     => 'style',
			'group'   => 'tour_destination_style',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-brands-design__one .tft-section-heading .tft-section-title',
				],
			],
		];

		$this->controls['popular_subtitle_head'] = [
			'tab'    => 'style',
			'group'  => 'tour_destination_style',
			'label'  => esc_html__( 'Sub Title', 'travelfic-toolkit' ),
			'type'   => 'separator',
		];

		$this->controls['popular_car_item_sub_title'] = [
			'tab'     => 'style',
			'group'   => 'tour_destination_style',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-brands-design__one .tft-section-heading p',
				],
			],
		];

		$this->controls['popular_card_head'] = [
			'tab'    => 'style',
			'group'  => 'tour_destination_style',
			'label'  => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'   => 'separator',
		];

		$this->controls['popular_car_item_card_title_typo'] = [
			'tab'     => 'style',
			'group'   => 'tour_destination_style',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-brands-design__one .tft-brands-title a',
				],
			],
		];

		$this->controls['popular_car_item_card_title_bg'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.tft-brands-design__one .tft-brands-title a',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;
		$this->set_attribute( '_root', 'style', 'width: 100%;' );

		echo '<div ' . $this->render_attributes( '_root' ) . '>';
		\Travelfic_Toolkit\Components\CarBrands::render( $settings, 'bricks' );
		echo '</div>';
	}
}
