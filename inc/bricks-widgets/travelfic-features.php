<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Features Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_Features extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-features';
	public $icon     = 'ti-layout-grid2';
	public $scripts  = [ 'tftBricksFeatures' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/features.js';

		wp_register_script(
			'tft-bricks-features',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/features.js',
			[ 'bricks-scripts', 'jquery' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-features' );
		wp_enqueue_script( 'tft-bricks-features' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Features', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['tft_features'] = [
			'title' => esc_html__( 'Feature Items', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['features_style_section'] = [
			'title' => esc_html__( 'Item List', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['feature_style'] = [
			'tab'     => 'content',
			'group'   => 'tft_features',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
			],
		];

		$this->controls['features_section'] = [
			'tab'    => 'content',
			'group'  => 'tft_features',
			'type'   => 'repeater',
			'label'  => esc_html__( 'Features List', 'travelfic-toolkit' ),
			'fields' => [
				'image'       => [
					'type'  => 'image',
					'label' => esc_html__( 'Image', 'travelfic-toolkit' ),
				],
				'icon'        => [
					'type'    => 'icon',
					'label'   => esc_html__( 'Icon', 'travelfic-toolkit' ),
					'default' => 'fas fa-star',
				],
				'title'       => [
					'type'    => 'text',
					'label'   => esc_html__( 'Title', 'travelfic-toolkit' ),
					'default' => esc_html__( 'Swimming pool', 'travelfic-toolkit' ),
				],
				'description' => [
					'type'    => 'textarea',
					'label'   => esc_html__( 'Description', 'travelfic-toolkit' ),
					'default' => esc_html__( 'Our trained and experienced staff is capable of handling a number of pool features', 'travelfic-toolkit' ),
				],
			],
		];

		$this->controls['feature_interaction'] = [
			'tab'     => 'content',
			'group'   => 'tft_features',
			'label'   => esc_html__( 'Interaction', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'click',
			'options' => [
				'click' => esc_html__( 'Click', 'travelfic-toolkit' ),
				'hover' => esc_html__( 'Hover', 'travelfic-toolkit' ),
			],
		];

		// ========== STYLE GROUP ==========
		$this->controls['features_card_head'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'List', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['features_card_color'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature',
				],
			],
		];

		$this->controls['features_card_color_active'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Active Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature.active',
				],
			],
		];

		$this->controls['features_tour_item_card_padding'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature',
				],
			],
		];

		$this->controls['features_title_head'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['features_title'] = [
			'tab'     => 'style',
			'group'   => 'features_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature h3',
				],
			],
		];

		$this->controls['features_title_color_active'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Active Color', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature.active h3',
				],
			],
		];

		$this->controls['features_content_head'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['features_content'] = [
			'tab'     => 'style',
			'group'   => 'features_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature p',
				],
			],
		];

		$this->controls['features_content_color_active'] = [
			'tab'   => 'style',
			'group' => 'features_style_section',
			'label' => esc_html__( 'Active Color', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature.active p',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\Features::render( $settings, 'bricks' );

		echo '</div>';
	}
}
