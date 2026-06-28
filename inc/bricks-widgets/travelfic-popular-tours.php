<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Popular Tours Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_PopularTours extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-popular-tours';
	public $icon     = 'ti-direction-alt';
	public $scripts  = [ 'tftBricksPopularTours' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/popular-tours.js';

		wp_register_script(
			'tft-bricks-popular-tours',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/popular-tours.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-popular-tours' );
		wp_enqueue_script( 'tft-bricks-popular-tours' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Popular Tours', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['popular_tours'] = [
			'title' => esc_html__( 'Popular Tours', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['popular_tour_style_section'] = [
			'title' => esc_html__( 'Item List', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['tf_post_type'] = [
			'tab'     => 'content',
			'group'   => 'popular_tours',
			'label'   => esc_html__( 'Post Type', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'tf_tours',
			'options' => [
				'tf_tours' => esc_html__( 'Tours', 'travelfic-toolkit' ),
			],
		];

		$this->controls['post_order_by'] = [
			'tab'     => 'content',
			'group'   => 'popular_tours',
			'label'   => esc_html__( 'Order by', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'comment_count',
			'options' => [
				'date'          => esc_html__( 'Date', 'travelfic-toolkit' ),
				'title'         => esc_html__( 'Title', 'travelfic-toolkit' ),
				'modified'      => esc_html__( 'Modified date', 'travelfic-toolkit' ),
				'comment_count' => esc_html__( 'Comment count', 'travelfic-toolkit' ),
				'rand'          => esc_html__( 'Random', 'travelfic-toolkit' ),
			],
		];

		$this->controls['post_items'] = [
			'tab'     => 'content',
			'group'   => 'popular_tours',
			'label'   => esc_html__( 'Item Per page', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 4,
		];

		$this->controls['post_order'] = [
			'tab'     => 'content',
			'group'   => 'popular_tours',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'DESC',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
		];

		// ========== STYLE GROUP ==========
		$this->controls['popular_tour_item_card_padding'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-popular-tour-items .tft-popular-item-info',
				],
			],
		];

		$this->controls['popular_title_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_tour_item_title'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-popular-tour-items .tft-popular-item-info .tft-title',
				],
			],
		];

		$this->controls['popular_meta_heading'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Meta', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_tour_item_meta'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-popular-tour-items .tft-popular-item-info .tft-content',
				],
			],
		];

		$this->controls['popular_tour_price'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Price', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_tour_price_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-popular-tour-items .tft-pricing',
				],
			],
		];

		$this->controls['popular_icon_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Icon', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_tour_item_icon_color'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.tft-popular-tour-items .tft-popular-item-info .tft-popular-sub-info p i',
				],
				[
					'property' => 'color',
					'selector' => '.tft-popular-tour-items .slick-arrow i',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\PopularTours::render( $settings, 'bricks' );

		echo '</div>';
	}
}
