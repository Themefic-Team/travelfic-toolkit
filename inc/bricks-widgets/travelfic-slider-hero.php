<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Slider Hero Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_SliderHero extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-slider-hero';
	public $icon     = 'ti-layout-slider';

	public function get_label() {
		return esc_html__( 'Travelfic Hero', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['hero_slider'] = [
			'title' => esc_html__( 'Hero Content', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['social_content_section'] = [
			'title'    => esc_html__( 'Hero Social Content', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->control_groups['tf_serach_box'] = [
			'title'    => esc_html__( 'Search Box', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'slider_style', '!=', 'design-5' ],
		];

		$this->control_groups['slider_settings'] = [
			'title'    => esc_html__( 'Slider Control', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'slider_style', '!=', 'design-5' ],
		];

		// Style Tabs
		$this->control_groups['hero_style_section'] = [
			'title' => esc_html__( 'Slider', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['slider_social_style'] = [
			'title'    => esc_html__( 'Social', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->control_groups['hero_search_section'] = [
			'title' => esc_html__( 'Search', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		$this->tf_search_types();

		// Group: Hero Content
		$this->controls['slider_style'] = [
			'tab'     => 'content',
			'group'   => 'hero_slider',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
				'design-3' => esc_html__( 'Design 3', 'travelfic-toolkit' ),
				'design-4' => esc_html__( 'Design 4', 'travelfic-toolkit' ),
				'design-5' => esc_html__( 'Design 5', 'travelfic-toolkit' ),
			],
			'default' => 'design-1',
		];

		$this->controls['banner_title'] = [
			'tab'         => 'content',
			'group'       => 'hero_slider',
			'label'       => esc_html__( 'Banner Title', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Banner title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Embark on extraordinary voyages and explorations', 'travelfic-toolkit' ),
			'required'    => [ 'slider_style', '=', [ 'design-2', 'design-3', 'design-5' ] ],
		];

		$this->controls['banner_description'] = [
			'tab'         => 'content',
			'group'       => 'hero_slider',
			'label'       => esc_html__( 'Banner Description', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Banner description', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Discover luxurious hotel at unbeatable price Discover luxurious hotel at unbeatable price Discover luxurious hotel at unbeatable price Discover luxurious hotel at unbeatable', 'travelfic-toolkit' ),
			'required'    => [ 'slider_style', '=', 'design-5' ],
		];

		$this->controls['banner_image'] = [
			'tab'      => 'content',
			'group'    => 'hero_slider',
			'label'    => esc_html__( 'Banner Image', 'travelfic-toolkit' ),
			'type'     => 'image',
			'required' => [ 'slider_style', '=', [ 'design-2', 'design-3', 'design-4', 'design-5' ] ],
		];

		// Design-1 Repeater
		$this->controls['hero_slider_list'] = [
			'tab'           => 'content',
			'group'         => 'hero_slider',
			'label'         => esc_html__( 'Repeater List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'slider_title',
			'fields'        => [
				'slider_image' => [
					'label' => esc_html__( 'Slider Image', 'travelfic-toolkit' ),
					'type'  => 'image',
				],
				'slider_title' => [
					'label'   => esc_html__( 'Slider Title', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'It is Time To Explore The World', 'travelfic-toolkit' ),
				],
				'slider_subtitle' => [
					'label'   => esc_html__( 'Slider Subtitle', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'A There are many variatio of passage of Lorem for a Ipsum available  Lorem for a Ipsum available dummy lorem text.', 'travelfic-toolkit' ),
				],
				'slider_bttn_txt' => [
					'label'   => esc_html__( 'Slider Text', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'Explore Now', 'travelfic-toolkit' ),
				],
				'slider_bttn_url' => [
					'label'   => esc_html__( 'Button URL', 'travelfic-toolkit' ),
					'type'    => 'link',
					'default' => [
						'url' => '#',
					],
				],
			],
			'required'      => [ 'slider_style', '=', 'design-1' ],
		];

		// Design-4 Repeater
		$this->controls['design4_hero_slider_list'] = [
			'tab'           => 'content',
			'group'         => 'hero_slider',
			'label'         => esc_html__( 'Repeater List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'design4_slider_title',
			'fields'        => [
				'design4_slider_title' => [
					'label'   => esc_html__( 'Slider Title', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'Discover The World', 'travelfic-toolkit' ),
				],
				'design4_slider_subtitle' => [
					'label'   => esc_html__( 'Slider Subtitle', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'Experience Central Park via Air Trips', 'travelfic-toolkit' ),
				],
				'design4_slider_bttn_txt' => [
					'label'   => esc_html__( 'Slider Text', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'Explore Now', 'travelfic-toolkit' ),
				],
				'design4_slider_bttn_url' => [
					'label'   => esc_html__( 'Button URL', 'travelfic-toolkit' ),
					'type'    => 'link',
					'default' => [
						'url' => '#',
					],
				],
			],
			'required'      => [ 'slider_style', '=', 'design-4' ],
		];

		// Group: Hero Social Content
		$this->controls['social_media_switcher'] = [
			'tab'         => 'content',
			'group'       => 'social_content_section',
			'label'       => esc_html__( 'Enable Social Sharing?', 'travelfic-toolkit' ),
			'type'        => 'checkbox',
			'description' => esc_html__( 'Turn On to active the social media icons', 'travelfic-toolkit' ),
			'default'     => true,
		];

		$this->controls['social_media_list'] = [
			'tab'           => 'content',
			'group'         => 'social_content_section',
			'label'         => esc_html__( 'Social Media List', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'social_media_icon',
			'fields'        => [
				'social_media_label' => [
					'label' => esc_html__( 'Icon', 'travelfic-toolkit' ),
					'type'  => 'icon',
					'default' => [
						'library' => 'fa-solid',
						'icon'    => 'fab fa-wordpress-simple',
					],
				],
				'social_media_url' => [
					'label'   => esc_html__( 'Link', 'travelfic-toolkit' ),
					'type'    => 'link',
					'default' => [
						'url' => '#',
					],
				],
			],
			'default' => [
				[
					'social_media_label' => [
						'icon'    => 'fab fa-facebook-f',
						'library' => 'fa-brands',
					],
				],
				[
					'social_media_label' => [
						'icon'    => 'fab fa-x-twitter',
						'library' => 'fa-brands',
					],
				],
				[
					'social_media_label' => [
						'icon'    => 'fab fa-linkedin-in',
						'library' => 'fa-brands',
					],
				],
				[
					'social_media_label' => [
						'icon'    => 'fab fa-instagram',
						'library' => 'fa-brands',
					],
				],
				[
					'social_media_label' => [
						'icon'    => 'fab fa-tiktok',
						'library' => 'fa-brands',
					],
				],
			],
		];

		$this->controls['social_share_label'] = [
			'tab'     => 'content',
			'group'   => 'social_content_section',
			'label'   => esc_html__( 'Social Box Label', 'travelfic-toolkit' ),
			'type'    => 'text',
			'default' => esc_html__( 'Share', 'travelfic-toolkit' ),
		];

		// Group: Search Box
		$this->controls['search_box_switcher'] = [
			'tab'         => 'content',
			'group'       => 'tf_serach_box',
			'label'       => esc_html__( 'Enable Search Box?', 'travelfic-toolkit' ),
			'type'        => 'checkbox',
			'description' => esc_html__( 'Turn On to active the Searchbox', 'travelfic-toolkit' ),
			'default'     => true,
		];

		$this->controls['type'] = [
			'tab'      => 'content',
			'group'    => 'tf_serach_box',
			'label'    => esc_html__( 'Type', 'travelfic-toolkit' ),
			'type'     => 'select',
			'multiple' => true,
			'options'  => $this->tf_search_types(),
			'default'  => [ 'all' ],
		];

		$this->controls['hotel_tab_title'] = [
			'tab'      => 'content',
			'group'    => 'tf_serach_box',
			'label'    => esc_html__( 'Hotel Tab Title', 'travelfic-toolkit' ),
			'type'     => 'text',
			'default'  => esc_html__( 'Hotel', 'travelfic-toolkit' ),
			'required' => [ 'type', '=', [ 'all', 'hotel' ] ],
		];

		$this->controls['tour_tab_title'] = [
			'tab'      => 'content',
			'group'    => 'tf_serach_box',
			'label'    => esc_html__( 'Tour Tab Title', 'travelfic-toolkit' ),
			'type'     => 'text',
			'default'  => esc_html__( 'Tour', 'travelfic-toolkit' ),
			'required' => [ 'type', '=', [ 'all', 'tour' ] ],
		];

		$this->controls['apt_tab_title'] = [
			'tab'      => 'content',
			'group'    => 'tf_serach_box',
			'label'    => esc_html__( 'Apartment Tab Title', 'travelfic-toolkit' ),
			'type'     => 'text',
			'default'  => esc_html__( 'Apartment', 'travelfic-toolkit' ),
			'required' => [ 'type', '=', [ 'all', 'apartment' ] ],
		];

		$this->controls['car_tab_title'] = [
			'tab'      => 'content',
			'group'    => 'tf_serach_box',
			'label'    => esc_html__( 'Car Tab Title', 'travelfic-toolkit' ),
			'type'     => 'text',
			'default'  => esc_html__( 'Car', 'travelfic-toolkit' ),
			'required' => [ 'type', '=', [ 'all', 'carrentals' ] ],
		];

		// Group: Slider Control
		$this->controls['slider_height'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Slider Height', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 800,
			'min'      => 0,
			'max'      => 1000,
			'step'     => 1,
			'units'    => true,
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-2' ] ],
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img',
				],
				[
					'property' => 'height',
					'selector' => '.tft-hero-design__two',
				],
			],
		];

		$this->controls['design-3-slider_height'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Slider Height', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 540,
			'min'      => 0,
			'max'      => 1000,
			'step'     => 1,
			'units'    => true,
			'required' => [ 'slider_style', '=', 'design-3' ],
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.tft-hero-design__three',
				],
			],
		];

		$this->controls['design4_slider_height'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Slider Height', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 800,
			'min'      => 0,
			'max'      => 1000,
			'step'     => 1,
			'units'    => true,
			'required' => [ 'slider_style', '=', 'design-4' ],
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.tft-hero-design__four',
				],
			],
		];

		$this->controls['design4_slider_navigation'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'type'     => 'select',
			'default'  => 'dots',
			'options'  => [
				'none'   => esc_html__( 'None', 'travelfic-toolkit' ),
				'dots'   => esc_html__( 'Dots', 'travelfic-toolkit' ),
				'arrows' => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			],
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_autoplay'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Autoplay', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_autoplay_speed'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Autoplay Speed', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 3000,
			'min'      => 100,
			'max'      => 10000,
			'step'     => 100,
			'units'    => true,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_autoplay_interval'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Autoplay Interval', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 1500,
			'min'      => 100,
			'max'      => 10000,
			'step'     => 100,
			'units'    => true,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_loop'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Loop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_animation'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Animation (Fade)', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_pause_on_hover'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Pause On Hover', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_pause_on_focus'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Pause On Focus', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['design4_slider_rtl'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'RTL', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [
				[ 'slider_style', '=', 'design-4' ],
				[ 'design4_slider_loop', '!=', true ],
			],
		];

		$this->controls['design4_slider_draggable'] = [
			'tab'      => 'content',
			'group'    => 'slider_settings',
			'label'    => esc_html__( 'Draggable', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'slider_style', '=', 'design-4' ],
		];


		// STYLE CONTROLS
		// Group: Slider (Style)
		$this->controls['banner_bg_color'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-3' ] ],
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-hero-slider-selector .tft-hero-single-item::before',
				],
			],
		];

		$this->controls['banner_inner_padding'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'required' => [ 'slider_style', '=', 'design-2' ],
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-hero-design__two .tft-hero-content',
				],
			],
		];

		// Title Separator Heading
		$this->controls['slider_title_heading'] = [
			'tab'   => 'style',
			'group' => 'hero_style_section',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['slider_title_spacing'] = [
			'tab'   => 'style',
			'group' => 'hero_style_section',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-hero-content h1, .tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .tft-slider-title .title-large, .tft-hero-design__four__slider__item__content--title',
				],
			],
		];

		// Rule 9: Title Typography handles Color. No separate title_color control added.
		$this->controls['slider_title_typo'] = [
			'tab'     => 'style',
			'group'   => 'hero_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .tft-slider-title .title-large, .tft-hero-content h1, .tft-hero-design__three .tft-hero-content-box h1, .tft-hero-design__four__slider__item__content--title, .tft-hero-design__five .tft-hero-content h1, .tft-hero-content .tf-booking-form-tab button.active',
				],
			],
		];

		// Subtitle Separator Heading
		$this->controls['slider_subtitle_heading'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
		];

		// Rule 9: Subtitle Typography handles Color. No separate slider_sub_title_color control added.
		$this->controls['slider_sub_title'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .tft-slider-title .tft-sub-title p, .tft-hero-design__four__slider__item__content--subtitle',
				],
			],
		];

		// Description Separator Heading
		$this->controls['slider_description_heading'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Description', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '=', 'design-5' ],
		];

		// Rule 9: Description Typography handles Color. No separate slider_description_color control added.
		$this->controls['slider_description'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'slider_style', '=', 'design-5' ],
			'css'      => [
				[
					'selector' => '.tft-hero-content p',
				],
			],
		];

		// Button Separator Heading
		$this->controls['slider_buttons_style_heading'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
		];

		// Rule 9: Button Typography handles Color. No separate button_text_color control added.
		$this->controls['button_typography'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .slider-button .tft-btn, .tft-hero-design__four .tft-hero-design__four__slider__item__content--link.tft-btn',
				],
			],
		];

		$this->controls['slider_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .slider-button .tft-btn, .tft-hero-design__four .tft-hero-design__four__slider__item__content--link.tft-btn',
				],
			],
		];

		$this->controls['slider_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .slider-button .tft-btn, .tft-hero-design__four .tft-hero-design__four__slider__item__content--link.tft-btn',
				],
			],
		];

		$this->controls['slider_button_border'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .slider-button .tft-btn, .tft-hero-design__four .tft-hero-design__four__slider__item__content--link.tft-btn',
				],
			],
		];

		$this->controls['button_background_color'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Background Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .tft-hero-single-item .tft-slider-bg-img .tft-hero-single-item-inner .slider-inner-info .slider-button .tft-btn, .tft-hero-design__four .tft-hero-design__four__slider__item__content--link.tft-btn',
				],
			],
		];

		// Navigation Separator Heading
		$this->controls['slider_nav_style_heading'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
		];

		$this->controls['slider_nav_color'] = [
			'tab'      => 'style',
			'group'    => 'hero_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', [ 'design-1', 'design-4' ] ],
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector button.slick-arrow',
				],
				[
					'property' => 'color',
					'selector' => '.tft-hero-design__one .tft-hero-slider-selector .slider__counter',
				],
				[
					'property' => 'background-color',
					'selector' => '.tft-hero-design__four .slick-dots li button',
				],
				[
					'property' => 'border-color',
					'selector' => '.tft-hero-design__four .slick-dots li.slick-active',
				],
			],
		];

		// Group: Social (Style)
		$this->controls['slider_social_label_head_heading'] = [
			'tab'      => 'style',
			'group'    => 'slider_social_style',
			'label'    => esc_html__( 'Label', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['slider_social_label_color'] = [
			'tab'      => 'style',
			'group'    => 'slider_social_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', 'design-4' ],
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-hero-design__four__social__label',
				],
			],
		];

		$this->controls['slider_social_icon_head_heading'] = [
			'tab'      => 'style',
			'group'    => 'slider_social_style',
			'label'    => esc_html__( 'Icon', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '=', 'design-4' ],
		];

		$this->controls['slider_social_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'slider_social_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', 'design-4' ],
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-hero-design__four__social__list__item--link i',
				],
			],
		];

		$this->controls['slider_social_icon_back'] = [
			'tab'      => 'style',
			'group'    => 'slider_social_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', 'design-4' ],
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-hero-design__four__social__list__item--link',
				],
			],
		];

		$this->controls['slider_social_icon_border'] = [
			'tab'      => 'style',
			'group'    => 'slider_social_style',
			'label'    => esc_html__( 'Border Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '=', 'design-4' ],
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.tft-hero-design__four__social__list__item--link',
				],
			],
		];

		// Group: Search (Style)
		$this->controls['search_buttons_style_heading'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Tab', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'slider_style', '!=', 'design-5' ],
		];

		// Rule 9: Tab Typography handles Color. No separate search_button_text_color control added.
		$this->controls['search_button_typography'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn',
				],
			],
		];

		$this->controls['search_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn',
				],
			],
		];

		$this->controls['search_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn',
				],
			],
		];

		$this->controls['search_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn',
				],
			],
		];

		$this->controls['search_button_background_color'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Background Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn',
				],
			],
		];

		// Active Tab Settings (Rule 10: hover state omitted, active state is kept)
		$this->controls['search_button_active_color'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Active Text Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn.active, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn.active',
				],
			],
		];

		$this->controls['search_button_background_active_color'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Active Background Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn.active, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn.active',
				],
			],
		];

		$this->controls['search_button_active_border'] = [
			'tab'      => 'style',
			'group'    => 'hero_search_section',
			'label'    => esc_html__( 'Active Border Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'required' => [ 'slider_style', '!=', 'design-5' ],
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.tf-booking-form-tab .tf-tablinks.tf_btn.active, .tft-hero-design__two .tft-hero-content #tf-booking-search-tabs .tf-booking-form-tab button.tf_btn.active',
				],
			],
		];

		$this->controls['search_form_style_heading'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Form', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['search_form_background_color'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.tft-search-box',
				],
				[
					'property' => 'background-color',
					'selector' => '.tf-booking-forms-wrapper .default-form',
				],
				[
					'property' => 'background-color',
					'selector' => '.tf-search-tabs__design--5 .tf-archive-search-box-wrapper',
				],
			],
		];

		$this->controls['search_form_label_heading'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Label', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		// Rule 9: Typography handles color. No separate search_form_label_color control added.
		$this->controls['search_form_label_typography'] = [
			'tab'     => 'style',
			'group'   => 'hero_search_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tf_homepage-booking label, .tf-booking-forms-wrapper .tf-label, .tf-booking-forms-wrapper .tf-search__form__label, .tf-search-tabs__design--5 .tf-archive-search-box-wrapper label',
				],
			],
		];

		$this->controls['search_form_input_heading'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Input', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		// Rule 9: Typography handles color. No separate search_form_input_color control added.
		$this->controls['search_form_input_typography'] = [
			'tab'     => 'style',
			'group'   => 'hero_search_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tf_homepage-booking input, .tf-booking-forms-wrapper .tf_form-inner input, .tf-booking-forms-wrapper .field--title, .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field, .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field input, .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field .tf-guest',
				],
			],
		];

		$this->controls['search_form_input_background'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.tf_homepage-booking > div',
				],
				[
					'property' => 'background-color',
					'selector' => '.tf-booking-forms-wrapper .tf_form-inner',
				],
				[
					'property' => 'background-color',
					'selector' => '.tf-booking-forms-wrapper .tf-search__form__field #tf-location',
				],
				[
					'property' => 'background-color',
					'selector' => '.tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field',
				],
			],
		];

		$this->controls['search_form_buttons_style_heading'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		// Rule 9: Typography handles color. No separate search_form_button_text_color control added.
		$this->controls['search_form_button_typography'] = [
			'tab'     => 'style',
			'group'   => 'hero_search_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tf_homepage-booking .tf_btn.tf-submit, .tf_availability_checker_box button, .tf-booking-forms-wrapper .tf-submit-button .tf_btn, .tf-search__form__submit',
				],
			],
		];

		$this->controls['search_form_button_margin_'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'margin',
					'selector' => '.tf_homepage-booking .tf_btn.tf-submit, .tf_availability_checker_box button, .tf-booking-forms-wrapper .tf-submit-button .tf_btn, .tf-search__form__submit',
				],
			],
		];

		$this->controls['search_form_button_padding_'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tf_homepage-booking .tf_btn.tf-submit, .tf_availability_checker_box button, .tf-booking-forms-wrapper .tf-submit-button .tf_btn, .tf-search__form__submit',
				],
			],
		];

		$this->controls['search_form_button_border'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.tf_homepage-booking .tf_btn.tf-submit, .tf_availability_checker_box button, .tf-booking-forms-wrapper .tf-submit-button .tf_btn, .tf-search__form__submit',
				],
			],
		];

		$this->controls['search_form_button_background_color'] = [
			'tab'   => 'style',
			'group' => 'hero_search_section',
			'label' => esc_html__( 'Background Color', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.tf_homepage-booking .tf_btn.tf-submit, .tf_availability_checker_box button, .tf-booking-forms-wrapper .tf-submit-button .tf_btn, .tf-search__form__submit',
				],
			],
		];
	}

	public function tf_search_types() {
		$types = array(
			'all'       => esc_html__( 'All', 'travelfic-toolkit' ),
			'hotel'     => esc_html__( 'Hotel', 'travelfic-toolkit' ),
			'tour'      => esc_html__( 'Tour', 'travelfic-toolkit' ),
			'apartment' => esc_html__( 'Apartment', 'travelfic-toolkit' ),
			'carrentals' => esc_html__( 'Car', 'travelfic-toolkit' ),
		);

		if ( function_exists( 'is_tf_pro' ) && is_tf_pro() ) {
			$types['booking']   = esc_html__( 'Booking.com', 'travelfic-toolkit' );
			$types['tp-flight'] = esc_html__( 'TravelPayouts Flight', 'travelfic-toolkit' );
			$types['tp-hotel']  = esc_html__( 'TravelPayouts Hotel', 'travelfic-toolkit' );
		}

		return $types;
	}

	public function render() {
		$settings = $this->settings;

		// Wrapper – required by Bricks so CSS/style controls apply to the root element.
		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\SliderHero::render( $settings, 'bricks' );

		echo '</div>';
	}
}

