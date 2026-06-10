<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Cars Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_Cars extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-popular-cars';
	public $icon     = 'ti-car';
	public $scripts  = [];

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-popular-cars' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Cars', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['popular_cars'] = [
			'title' => esc_html__( 'Popular Cars', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['popular_tour_style_section'] = [
			'title' => esc_html__( 'Section Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['car_style'] = [
			'tab'     => 'content',
			'group'   => 'popular_cars',
			'label'   => esc_html__( 'Car Style', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'grid',
			'options' => [
				'grid' => esc_html__( 'Grid', 'travelfic-toolkit' ),
				'list' => esc_html__( 'List', 'travelfic-toolkit' ),
			],
		];

		$this->controls['post_items'] = [
			'tab'     => 'content',
			'group'   => 'popular_cars',
			'label'   => esc_html__( 'Item Per page', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 6,
		];

		$this->controls['sec_title'] = [
			'tab'     => 'content',
			'group'   => 'popular_cars',
			'label'   => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'    => 'text',
		];

		$this->controls['sub_title'] = [
			'tab'     => 'content',
			'group'   => 'popular_cars',
			'label'   => esc_html__( 'Sub Title', 'travelfic-toolkit' ),
			'type'    => 'text',
		];

		// ========== STYLE GROUP ==========
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
					'selector' => '.tf-archive-template__one .tf-car-lists-widgets .tf-heading h2',
				],
			],
		];

		$this->controls['popular_subtitle_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Sub Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_tour_item_sub_title'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tf-archive-template__one .tf-car-lists-widgets .tf-heading p',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\Cars::render( $settings, 'bricks' );

		echo '</div>';
	}
}
