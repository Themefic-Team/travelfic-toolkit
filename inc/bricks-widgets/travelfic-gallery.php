<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Gallery Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_Gallery extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-gallery';
	public $icon     = 'ti-image';
	public $scripts  = [ 'tftBricksGallery' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/gallery.js';

		wp_register_script(
			'tft-bricks-gallery',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/gallery.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-gallery' );
		wp_enqueue_script( 'tft-bricks-gallery' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Gallery', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['tft_gallery'] = [
			'title' => esc_html__( 'Gallery', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['gallery_slider_control'] = [
			'title' => esc_html__( 'Slider Control', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['tft_style_section'] = [
			'title' => esc_html__( 'Section', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['gallery_style_section'] = [
			'title' => esc_html__( 'Items', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['gallery_style'] = [
			'tab'     => 'content',
			'group'   => 'tft_gallery',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
			],
		];

		$this->controls['section_title'] = [
			'tab'     => 'content',
			'group'   => 'tft_gallery',
			'label'   => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'    => 'textarea',
			'default' => esc_html__( 'Book your stay today', 'travelfic-toolkit' ),
		];

		$this->controls['section_subtitle'] = [
			'tab'     => 'content',
			'group'   => 'tft_gallery',
			'label'   => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'    => 'textarea',
			'default' => esc_html__( 'GALLERY', 'travelfic-toolkit' ),
		];

		$this->controls['galleries'] = [
			'tab'    => 'content',
			'group'  => 'tft_gallery',
			'type'   => 'repeater',
			'label'  => esc_html__( 'Gallery List', 'travelfic-toolkit' ),
			'fields' => [
				'image' => [
					'type'  => 'image',
					'label' => esc_html__( 'Image', 'travelfic-toolkit' ),
				],
				'title' => [
					'type'    => 'text',
					'label'   => esc_html__( 'Title', 'travelfic-toolkit' ),
					'default' => esc_html__( 'Swimming Pool', 'travelfic-toolkit' ),
				],
			],
		];

		// ========== SLIDER CONTROL GROUP ==========
		$this->controls['gallery_slider_navigation'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'arrows',
			'options' => [
				'none'   => esc_html__( 'None', 'travelfic-toolkit' ),
				'dots'   => esc_html__( 'Dots', 'travelfic-toolkit' ),
				'arrows' => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			],
		];

		$this->controls['gallery_slider_autoplay'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Autoplay', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => true,
		];

		$this->controls['gallery_slider_autoplay_speed'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Autoplay Speed', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 3000,
			'min'     => 100,
			'max'     => 1000,
			'step'    => 100,
		];

		$this->controls['gallery_slider_autoplay_interval'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Autoplay Interval', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 1500,
			'min'     => 100,
			'max'     => 1000,
			'step'    => 100,
		];

		$this->controls['gallery_slider_loop'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Loop', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => true,
		];

		$this->controls['gallery_slider_pause_on_hover'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Pause On Hover', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => false,
		];

		$this->controls['gallery_slider_pause_on_focus'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Pause On Focus', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => false,
		];

		$this->controls['gallery_slider_draggable'] = [
			'tab'     => 'content',
			'group'   => 'gallery_slider_control',
			'label'   => esc_html__( 'Draggable', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => true,
		];

		// ========== SECTION STYLE GROUP ==========
		$this->controls['tft_gallery_title_head'] = [
			'tab'   => 'style',
			'group' => 'tft_style_section',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['tft_gallery_sec_title_typo'] = [
			'tab'     => 'style',
			'group'   => 'tft_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-gallery-design__one .tft-gallery-top-header .tft-section-title',
				],
			],
		];

		$this->controls['tft_gallery_sub_title_head'] = [
			'tab'   => 'style',
			'group' => 'tft_style_section',
			'label' => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['tft_gallery_sec_subtitle_typo'] = [
			'tab'     => 'style',
			'group'   => 'tft_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-gallery-design__one .tft-gallery-top-header .tft-section-subtitle',
				],
			],
		];

		// ========== ITEMS STYLE GROUP ==========
		$this->controls['gallery_image_head'] = [
			'tab'   => 'style',
			'group' => 'gallery_style_section',
			'label' => esc_html__( 'Image', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['gallery_image_width'] = [
			'tab'   => 'style',
			'group' => 'gallery_style_section',
			'label' => esc_html__( 'Image width', 'travelfic-toolkit' ),
			'type'  => 'number',
			'min'   => 0,
			'max'   => 1000,
			'units' => true,
			'css'   => [
				[
					'property' => 'width',
					'selector' => '.tft-gallery-design__one .tft-single-gallery img',
				],
				[
					'property' => 'width',
					'selector' => '.tft-gallery-design__one .slick-list .slick-slide',
				],
			],
		];

		$this->controls['gallery_image_height'] = [
			'tab'   => 'style',
			'group' => 'gallery_style_section',
			'label' => esc_html__( 'Image height', 'travelfic-toolkit' ),
			'type'  => 'number',
			'min'   => 0,
			'max'   => 500,
			'units' => true,
			'css'   => [
				[
					'property' => 'height',
					'selector' => '.tft-gallery-design__one .tft-single-gallery img',
				],
			],
		];

		$this->controls['gallery_title_head'] = [
			'tab'   => 'style',
			'group' => 'gallery_style_section',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['gallery_title'] = [
			'tab'     => 'style',
			'group'   => 'gallery_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-gallery-design__one .tft-single-gallery h3',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\Gallery::render( $settings, 'bricks' );

		echo '</div>';
	}
}
