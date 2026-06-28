<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Testimonials Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_Testimonials extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-testimonials';
	public $icon     = 'ti-comments';
	public $scripts  = [ 'tftBricksTestimonials' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/testimonials.js';

		wp_register_script(
			'tft-bricks-testimonials',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/testimonials.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-testimonials' );
		wp_enqueue_script( 'tft-bricks-testimonials' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Testimonials', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		$this->control_groups['tft-testimonials'] = [
			'title' => esc_html__( 'Slider Items', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['testimonial_slider_control'] = [
			'title'    => esc_html__( 'Slider Control', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->control_groups['tft_style_section'] = [
			'title'    => esc_html__( 'Section', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-3', 'design-5' ] ],
		];

		$this->control_groups['testimonials_style_section'] = [
			'title'    => esc_html__( 'Item List', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-2', 'design-4', 'design-5' ] ],
		];

		$this->control_groups['testimonials_style_3_section'] = [
			'title'    => esc_html__( 'Items', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->control_groups['testimonials_nav_style'] = [
			'title'    => esc_html__( 'Nav', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'testimonial_style', '!=', 'design-5' ],
		];
	}

	public function set_controls() {
		$ratings = [
			'1' => esc_html__( '&#9733;', 'travelfic-toolkit' ),
			'2' => esc_html__( '&#9733;&#9733;', 'travelfic-toolkit' ),
			'3' => esc_html__( '&#9733;&#9733;&#9733;', 'travelfic-toolkit' ),
			'4' => esc_html__( '&#9733;&#9733;&#9733;&#9733;', 'travelfic-toolkit' ),
			'5' => esc_html__( '&#9733;&#9733;&#9733;&#9733;&#9733;', 'travelfic-toolkit' ),
		];

		$testimonial_fields = [
			'person_image' => [
				'label' => esc_html__( 'Image', 'travelfic-toolkit' ),
				'type'  => 'image',
			],
			'person_name' => [
				'label'   => esc_html__( 'Name', 'travelfic-toolkit' ),
				'type'    => 'text',
				'default' => esc_html__( 'John Doe', 'travelfic-toolkit' ),
			],
			'designation' => [
				'label'   => esc_html__( 'Designation', 'travelfic-toolkit' ),
				'type'    => 'text',
				'default' => esc_html__( 'CEO', 'travelfic-toolkit' ),
			],
			'testimonials_review' => [
				'label'   => esc_html__( 'Review Details', 'travelfic-toolkit' ),
				'type'    => 'textarea',
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', 'travelfic-toolkit' ),
			],
			'rate' => [
				'label'   => esc_html__( 'Rattings', 'travelfic-toolkit' ),
				'type'    => 'select',
				'default' => '5',
				'options' => $ratings,
			],
		];

		$testimonial_fields_design_3 = $testimonial_fields;
		unset( $testimonial_fields_design_3['rate'] );

		$testimonial_fields_design_4               = $testimonial_fields;
		$testimonial_fields_design_4['post_date'] = [
			'label'   => esc_html__( 'Date', 'travelfic-toolkit' ),
			'type'    => 'text',
			'default' => date( 'd M, Y' ),
		];

		$testimonial_fields_design_5 = [
			'person_image' => [
				'label' => esc_html__( 'Image', 'travelfic-toolkit' ),
				'type'  => 'image',
			],
			'person_name' => [
				'label'   => esc_html__( 'Name', 'travelfic-toolkit' ),
				'type'    => 'text',
				'default' => esc_html__( 'John Doe', 'travelfic-toolkit' ),
			],
			'designation' => [
				'label'   => esc_html__( 'Designation', 'travelfic-toolkit' ),
				'type'    => 'text',
				'default' => esc_html__( 'from New York', 'travelfic-toolkit' ),
			],
			'testimonials_review_title' => [
				'label'   => esc_html__( 'Title', 'travelfic-toolkit' ),
				'type'    => 'text',
				'default' => esc_html__( 'Amazing service and beautiful rooms!', 'travelfic-toolkit' ),
			],
			'testimonials_review' => [
				'label'   => esc_html__( 'Review Details', 'travelfic-toolkit' ),
				'type'    => 'textarea',
				'default' => esc_html__( 'We celebrated our anniversary here, and the staff went above and beyond to make it special. The room was stunning, and the view was breathtaking. Highly recommend!', 'travelfic-toolkit' ),
			],
			'rate' => [
				'label'   => esc_html__( 'Rattings', 'travelfic-toolkit' ),
				'type'    => 'select',
				'default' => '5',
				'options' => $ratings,
			],
		];

		$this->controls['testimonial_style'] = [
			'tab'     => 'content',
			'group'   => 'tft-testimonials',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
				'design-3' => esc_html__( 'Design 3', 'travelfic-toolkit' ),
				'design-4' => esc_html__( 'Design 4', 'travelfic-toolkit' ),
				'design-5' => esc_html__( 'Design 5', 'travelfic-toolkit' ),
			],
		];

		$this->controls['testimonial_bg'] = [
			'tab'      => 'content',
			'group'    => 'tft-testimonials',
			'label'    => esc_html__( 'Testimonial Background', 'travelfic-toolkit' ),
			'type'     => 'image',
			'default'  => [
				'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/testimonial-bg.png',
			],
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-3' ] ],
		];

		$this->controls['des_title'] = [
			'tab'         => 'content',
			'group'       => 'tft-testimonials',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'What client’s say?', 'travelfic-toolkit' ),
			'required'    => [ 'testimonial_style', '=', [ 'design-2', 'design-3', 'design-5' ] ],
		];

		$this->controls['des_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'tft-testimonials',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Testimonials', 'travelfic-toolkit' ),
			'required'    => [ 'testimonial_style', '=', [ 'design-2', 'design-3', 'design-5' ] ],
		];

		$this->controls['des_content'] = [
			'tab'         => 'content',
			'group'       => 'tft-testimonials',
			'label'       => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'        => 'editor',
			'placeholder' => esc_html__( 'Enter your Content', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Competently predominate client based intsafgerfaces whereas cuttinadg edge niche markets  re engineer internal sources without installed.', 'travelfic-toolkit' ),
			'required'    => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonials_section'] = [
			'tab'           => 'content',
			'group'         => 'tft-testimonials',
			'label'         => esc_html__( 'Testimonials List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'person_name',
			'fields'        => $testimonial_fields,
			'required'      => [ 'testimonial_style', '=', [ 'design-1', 'design-2' ] ],
		];

		$this->controls['testimonials_design3_section'] = [
			'tab'           => 'content',
			'group'         => 'tft-testimonials',
			'label'         => esc_html__( 'Testimonials List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'person_name',
			'fields'        => $testimonial_fields_design_3,
			'required'      => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonials_design4_list'] = [
			'tab'           => 'content',
			'group'         => 'tft-testimonials',
			'label'         => esc_html__( 'Testimonials List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'person_name',
			'fields'        => $testimonial_fields_design_4,
			'required'      => [ 'testimonial_style', '=', 'design-4' ],
		];

		$this->controls['testimonials_design5_list'] = [
			'tab'           => 'content',
			'group'         => 'tft-testimonials',
			'label'         => esc_html__( 'Testimonials List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'person_name',
			'fields'        => $testimonial_fields_design_5,
			'required'      => [ 'testimonial_style', '=', 'design-5' ],
		];

		$this->controls['testimonial_design3_slider_slidetoshow'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Slide To Show', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 1,
			'max'      => 15,
			'step'     => 1,
			'default'  => 2,
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonial_design3_slider_slidetoscroll'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Slide To Scroll', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 1,
			'max'      => 10,
			'step'     => 1,
			'default'  => 1,
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonial_design3_slider_navigation'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'type'     => 'select',
			'default'  => 'arrows',
			'options'  => [
				'none'   => esc_html__( 'None', 'travelfic-toolkit' ),
				'dots'   => esc_html__( 'Dots', 'travelfic-toolkit' ),
				'arrows' => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			],
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_autoplay'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Autoplay', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_autoplay_speed'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Autoplay Speed', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 3000,
			'min'      => 100,
			'max'      => 1000,
			'step'     => 100,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_autoplay_interval'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Autoplay Interval', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 1500,
			'min'      => 100,
			'max'      => 1000,
			'step'     => 100,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_loop'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Loop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_pause_on_hover'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Pause On Hover', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_pause_on_focus'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Pause On Focus', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		$this->controls['testimonial_design3_slider_rtl'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'RTL', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [
				[ 'testimonial_style', '=', 'design-3' ],
				[ 'testimonial_design3_slider_loop', '!=', true ],
			],
		];

		$this->controls['testimonial_design3_slider_draggable'] = [
			'tab'      => 'content',
			'group'    => 'testimonial_slider_control',
			'label'    => esc_html__( 'Draggable', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'testimonial_style', '=', [ 'design-3', 'design-5' ] ],
		];

		// Style: Section
		$this->controls['tft_testimonial_section_bg'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-3' ] ],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__two' ],
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__three' ],
			],
		];

		$this->controls['tft_testimonials_title_head'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-5' ] ],
		];

		$this->controls['tft_testimonials_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-5' ] ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__two .tft-testimonial-top-header .tft-section-title, .tft-testimonials-design__five .tft-testimonial-top-header .tft-section-title' ],
			],
		];

		$this->controls['tft_testimonials_sub_title_head'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-5' ] ],
		];

		$this->controls['tft_testimonials_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-5' ] ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__two .tft-testimonial-top-header .tft-section-subtitle, .tft-testimonials-design__five .tft-testimonial-top-header .tft-section-subtitle' ],
			],
		];

		$this->controls['tft_design_3_title_head'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['tft_design_3_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'selector' => '.tft-heading-content h2' ],
			],
		];

		$this->controls['tft_design_3_title_backdrop'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['tft_design_3_title_backdrop_head'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [
				[ 'testimonial_style', '=', 'design-3' ],
				[ 'tft_design_3_title_backdrop', '=', true ],
			],
		];

		$this->controls['tft_design_3_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [
				[ 'testimonial_style', '=', 'design-3' ],
				[ 'tft_design_3_title_backdrop', '=', true ],
			],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-heading-content h2::after' ],
			],
		];

		$this->controls['tft_design_3_sub_title_head'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['tft_design_3_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__three .tft-heading-content .tft-section-subtitle' ],
			],
		];

		$this->controls['tft_design_3_content_head'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['tft_design_3_sec_content_typo'] = [
			'tab'      => 'style',
			'group'    => 'tft_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__three .tft-heading-content p' ],
			],
		];

		// Style: Item List
		$this->controls['testimonials_card_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'List', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4' ] ],
		];

		$this->controls['testimonials_card_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__one .tft-testimonials-inner' ],
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__four .tft-testimonials-inner' ],
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__five .tft-single-testimonial' ],
			],
		];

		$this->controls['testimonials_title_space_bellow'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Heading Space', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__one .testimonial-header' ],
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__four .testimonial-header' ],
			],
		];

		$this->controls['testimonials_tour_item_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
			'css'      => [
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__one .tft-testimonials-inner' ],
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__four .tft-testimonials-inner' ],
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__five .tft-single-testimonial' ],
			],
		];

		$this->controls['testimonials_title_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
		];

		$this->controls['testimonials_title'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__one .person-name, .tft-testimonials-design__four .person-name, .tft-testimonials-design__five .tft-single-testimonial .testimonial-header h3' ],
			],
		];

		$this->controls['testimonials_designation'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Designation', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
		];

		$this->controls['testimonials_designation_typo'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__one .designation, .tft-testimonials-design__four .designation, .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .user-info .person-name, .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .user-info .designation' ],
			],
		];

		$this->controls['testimonials_content_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
		];

		$this->controls['testimonials_content'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__one .testimonial-body .tft-content, .tft-testimonials-design__four .testimonial-body .tft-content, .tft-testimonials-design__five .tft-single-testimonial .testimonial-body .tft-content' ],
			],
		];

		$this->controls['testimonials_icon_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Icon', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
		];

		$this->controls['testimonials_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4', 'design-5' ] ],
			'css'      => [
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__one .testimonial-footer i' ],
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__four .testimonial-footer i' ],
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .testimonial-rating i' ],
			],
		];

		$this->controls['testimonials_posted_date_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Posted Date', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-4' ],
		];

		$this->controls['testimonials_posted_date_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', 'design-4' ],
			'css'      => [
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__four .testimonial-header .testimonial-date' ],
			],
		];

		$this->controls['testimonials_rating_number_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Rating Number', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-4' ],
		];

		$this->controls['testimonials_rating_number_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', 'design-4' ],
			'css'      => [
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__four .testimonial-rating h5' ],
			],
		];

		$this->controls['testimonials_quote_icon_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Quote Icon', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-4' ],
		];

		$this->controls['testimonials_quote_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', 'design-4' ],
			'css'      => [
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__four .quote-icon i' ],
			],
		];

		$this->controls['testimonials_2_card_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'List', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-2' ],
		];

		$this->controls['testimonials_2_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'required' => [ 'testimonial_style', '=', 'design-2' ],
			'css'      => [
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial' ],
			],
		];

		$this->controls['testimonials_2_card_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', 'design-2' ],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial' ],
			],
		];

		$this->controls['testimonials_2_author'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Author', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-2' ],
		];

		$this->controls['testimonials_2_author_typo'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-2' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name' ],
			],
		];

		$this->controls['testimonials_2_designation'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Designation', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-2' ],
		];

		$this->controls['testimonials_2_designation_typo'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-2' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation' ],
			],
		];

		$this->controls['testimonials_2_content_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-2' ],
		];

		$this->controls['testimonials_2_content'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-2' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-review p' ],
			],
		];

		// Style: Design 3 Items
		$this->controls['testimonials_card_3_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' ],
			],
		];

		$this->controls['testimonials_tour_item_card_3_padding'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'spacing',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'property' => 'padding', 'selector' => '.tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' ],
			],
		];

		$this->controls['testimonials_title_head_3'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonials_title_3'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4' ],
			],
		];

		$this->controls['testimonials_designation_3'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Designation', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonials_designation_3_typo'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p' ],
			],
		];

		$this->controls['testimonials_content_head_3'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonials_content_3'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p' ],
			],
		];

		$this->controls['testimonials_image_3_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Image', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', 'design-3' ],
		];

		$this->controls['testimonials_image_3_size'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_style_3_section',
			'label'    => esc_html__( 'Image Size', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 0,
			'step'     => 1,
			'units'    => true,
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'property' => 'width', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-image' ],
				[ 'property' => 'height', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-image' ],
			],
		];

		// Style: Nav
		$this->controls['tft_testimonials_nav_icon_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4' ] ],
		];

		$this->controls['testimonials_icon_nav_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[ 'property' => 'stroke', 'selector' => '.tft-testimonials-design__one button.slick-arrow path' ],
				[ 'property' => 'stroke', 'selector' => '.tft-testimonials-design__four button.slick-arrow path' ],
			],
		];

		$this->controls['testimonials_icon_nav_icon_background_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'testimonial_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__one button.slick-arrow' ],
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__four button.slick-arrow' ],
			],
		];

		$this->controls['testimonials_nav__arrow_width'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Size', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 70,
			'min'      => 0,
			'step'     => 1,
			'units'    => true,
			'required' => [ 'testimonial_style', '=', 'design-3' ],
			'css'      => [
				[ 'property' => 'width', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' ],
				[ 'property' => 'height', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' ],
				[ 'property' => 'width', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow' ],
				[ 'property' => 'height', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow' ],
			],
		];

		$this->controls['testimonials_nav__arrow_border'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'required' => [ 'testimonial_style', '=', [ 'design-2', 'design-3' ] ],
			'css'      => [
				[ 'property' => 'border', 'selector' => '.tft-testimonials-design__one button.slick-arrow, .tft-testimonials-design__two .slick-dots li.slick-active button::before, .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li.slick-active, .tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow' ],
			],
		];

		$this->controls['tft_testimonials_3_icon_nav_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [
				[ 'testimonial_style', '=', 'design-3' ],
				[ 'testimonial_design3_slider_navigation', '=', 'arrows' ],
			],
			'css'      => [
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__three .tft-slider-arrows .tft-arrow i' ],
			],
		];

		$this->controls['tft_testimonials_3_icon_nav_icon_background_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [
				[ 'testimonial_style', '=', 'design-3' ],
				[ 'testimonial_design3_slider_navigation', '=', 'arrows' ],
			],
			'css'      => [
				[ 'property' => 'background', 'selector' => '.tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-arrow' ],
			],
		];

		$this->controls['tft_testimonials_nav_head'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Dots', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [
				[ 'testimonial_style', '=', [ 'design-2', 'design-3' ] ],
				[ 'testimonial_design3_slider_navigation', '=', 'dots' ],
			],
		];

		$this->controls['testimonials_nav_color'] = [
			'tab'      => 'style',
			'group'    => 'testimonials_nav_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [
				[ 'testimonial_style', '=', [ 'design-2', 'design-3' ] ],
				[ 'testimonial_design3_slider_navigation', '=', 'dots' ],
			],
			'css'      => [
				[ 'property' => 'color', 'selector' => '.tft-testimonials-design__two .slick-dots li button::before' ],
				[ 'property' => 'background-color', 'selector' => '.tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' ],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\Testimonials::render( $settings, 'bricks' );

		echo '</div>';
	}
}
