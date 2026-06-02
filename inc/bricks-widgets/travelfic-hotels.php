<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Hotels Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_Hotels extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-hotels';
	public $icon     = 'ti-layout-grid3'; // Generic grid icon matching hotels
	public $scripts  = [ 'tftBricksHotels' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/hotels.js';

		wp_register_script(
			'tft-bricks-hotels',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/hotels.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-hotels' );
		wp_enqueue_script( 'tft-bricks-hotels' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Hotels, Tours & Apartment', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['tft_hotels'] = [
			'title' => esc_html__( 'Hotels, Tours & Apartment Section', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['team_slider_control'] = [
			'title'    => esc_html__( 'Slider Control', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		// Style Tabs
		$this->control_groups['popular_tour_style_section'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['popular_design2_card_tab'] = [
			'title'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->control_groups['popular_design2_hotel_nav'] = [
			'title'    => esc_html__( 'Nav', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];
	}

	public function set_controls() {
		// Group: Hotels, Tours & Apartment Section
		$this->controls['tft_hotels_style'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
			],
			'default' => 'design-1',
		];

		$this->controls['tft_posts_section_bg'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Section Background', 'travelfic-toolkit' ),
			'type'    => 'image',
		];

		$this->controls['tft_posts_type'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Type', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'alls'     => esc_html__( '*', 'travelfic-toolkit' ),
				'all'      => esc_html__( 'All', 'travelfic-toolkit' ),
				'featured' => esc_html__( 'Featured', 'travelfic-toolkit' ),
			],
			'default' => 'alls',
		];

		$this->controls['tft_section_title'] = [
			'tab'         => 'content',
			'group'       => 'tft_hotels',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'The best hotels to explore', 'travelfic-toolkit' ),
		];

		$this->controls['tft_section_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'tft_hotels',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Hotels', 'travelfic-toolkit' ),
		];

		$this->controls['tf_post_type'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Post Type', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'tf_hotel'     => esc_html__( 'Hotels', 'travelfic-toolkit' ),
				'tf_tours'     => esc_html__( 'Tours', 'travelfic-toolkit' ),
				'tf_apartment' => esc_html__( 'Apartments', 'travelfic-toolkit' ),
			],
			'default' => 'tf_hotel',
		];

		$this->controls['post_order_by'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Order by', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'date'     => esc_html__( 'Date', 'travelfic-toolkit' ),
				'title'    => esc_html__( 'Title', 'travelfic-toolkit' ),
				'modified' => esc_html__( 'Modified date', 'travelfic-toolkit' ),
			],
			'default' => 'date',
		];

		$this->controls['post_items'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Item Per page', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 6,
		];

		$this->controls['post_order'] = [
			'tab'     => 'content',
			'group'   => 'tft_hotels',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
			'default' => 'DESC',
		];

		$this->controls['card_title_type'] = [
			'tab'      => 'content',
			'group'    => 'tft_hotels',
			'label'    => esc_html__( 'Card Title', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => [
				'Split' => esc_html__( 'Split', 'travelfic-toolkit' ),
				'Full'  => esc_html__( 'Full Title', 'travelfic-toolkit' ),
			],
			'default'  => 'Split',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['view_all_link'] = [
			'tab'      => 'content',
			'group'    => 'tft_hotels',
			'label'    => esc_html__( 'View ALL URL', 'travelfic-toolkit' ),
			'type'     => 'link',
			'default'  => [
				'url' => '#',
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		// Group: Slider Control
		$this->controls['tft_hotels_design2_slider_slidetoshow'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Slide To Show', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 1,
			'max'      => 15,
			'step'     => 1,
			'default'  => 3,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_slidetoscroll'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Slide To Scroll', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 1,
			'max'      => 10,
			'step'     => 1,
			'default'  => 1,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_navigation'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => [
				'none'   => esc_html__( 'None', 'travelfic-toolkit' ),
				'dots'   => esc_html__( 'Dots', 'travelfic-toolkit' ),
				'arrows' => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			],
			'default'  => 'arrows',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_autoplay'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Autoplay', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_autoplay_speed'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Autoplay Speed', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 100,
			'max'      => 1000,
			'step'     => 100,
			'default'  => 3000,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_autoplay_interval'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Autoplay Interval', 'travelfic-toolkit' ),
			'type'     => 'number',
			'min'      => 100,
			'max'      => 1000,
			'step'     => 100,
			'default'  => 1500,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_loop'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Loop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_pause_on_hover'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Pause On Hover', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_pause_on_focus'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Pause On Focus', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_hotels_design2_slider_rtl'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'RTL', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => false,
			'required' => [
				[ 'tft_hotels_style', '=', 'design-2' ],
				[ 'tft_hotels_design2_slider_loop', '!=', true ],
			],
		];

		$this->controls['tft_hotels_design2_slider_draggable'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Draggable', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		// Group: Style (Design-1 Style Controls)
		$this->controls['popular_section_title_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_button_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_button_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .read-more .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_design1_hotel_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-popular-hotels-design__one .read-more .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_design1_hotel_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-popular-hotels-design__one .read-more .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_design1_hotel_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.tft-popular-hotels-design__one .read-more .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_button_bg'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__one .read-more .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_list_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'List', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_list_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_list_item_bg'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_list_active_item_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Active Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn.active',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_section_list_active_item_bg'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Active Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn.active',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_card_heading'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-popular-thumbnail',
				],
				[
					'property' => '--popular-hotel-card-padding',
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_card_review_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Review', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_review_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-ratings span',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_card_title_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_card_location_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Location', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_location_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations span',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_card_feature_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Features', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_features_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_card_button_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_button_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];

		$this->controls['popular_hotel_card_button_bg'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-1' ],
		];


		// Group: Style (Design-2 Style Controls)
		$this->controls['popular_section_design2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_section_design2_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_section_design2_title_backdrop'] = [
			'tab'      => 'content',
			'group'    => 'tft_hotels',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'default'  => true,
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_section_design2_title_backdrop_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [
				[ 'tft_hotels_style', '=', 'design-2' ],
				[ 'popular_section_design2_title_backdrop', '=', true ],
			],
		];

		$this->controls['popular_section_design2_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-heading-content .tft-section-title::after',
				],
			],
			'required' => [
				[ 'tft_hotels_style', '=', 'design-2' ],
				[ 'popular_section_design2_title_backdrop', '=', true ],
			],
		];

		$this->controls['popular_section_design2_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_section_design2_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_tour_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];


		// Group: Card (Style)
		$this->controls['popular_design2_hotel_card_background'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_image_heading'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Image', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];
		
		$this->controls['popular_design2_hotel_card_image_border'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail img',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_featured_heading'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Featured', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_featured_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail .tft-destination-featured .tft-featured',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_featured_back_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail .tft-destination-featured .tft-featured',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_title_heading'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['icon-popular_design2_hotel_card_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-title',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_review_meta_heading'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Review', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_review_icon_meta_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_design2_card_tab',
			'label'   => esc_html__( 'Size', 'travelfic-toolkit' ),
			'type'    => 'number',
			'min'     => 1,
			'max'     => 100,
			'step'    => 1,
			'css'     => [
				[
					'property' => 'font-size',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-rating i',
				],
			],
		];

		$this->controls['popular_design2_hotel_review_icon_meta_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-rating i',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_meta_heading'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Location', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_meta_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location span',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_card_icon_meta_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_design2_card_tab',
			'label'   => esc_html__( 'Icon Size', 'travelfic-toolkit' ),
			'type'    => 'number',
			'min'     => 1,
			'max'     => 100,
			'step'    => 1,
			'units'   => true,
			'css'     => [
				[
					'property' => 'font-size',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location i',
				],
			],
		];

		$this->controls['popular_design2_hotel_card_icon_meta_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Icon Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location i',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_price_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Price', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_price_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-price .tft-destination-price-value',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_price_label_typo'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Label Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-price .tft-destination-price-title',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_button_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_button_typography'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['popular_design2_hotel_button_background_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_card_tab',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];


		// Group: Nav (Style)
		$this->controls['popular_design2_hotel_nav_arrow_width'] = [
			'tab'     => 'style',
			'group'   => 'popular_design2_hotel_nav',
			'label'   => esc_html__( 'Size', 'travelfic-toolkit' ),
			'type'    => 'number',
			'min'     => 0,
			'step'    => 1,
			'units'   => true,
			'css'     => [
				[
					'property' => 'width',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider-nav button, .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li button',
				],
				[
					'property' => 'height',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider-nav button, .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li button',
				],
			],
		];

		$this->controls['popular_design2_hotel_nav_border_width'] = [
			'tab'     => 'style',
			'group'   => 'popular_design2_hotel_nav',
			'label'   => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'    => 'number',
			'min'     => 0,
			'max'     => 10,
			'step'    => 1,
			'units'   => true,
			'css'     => [
				[
					'property' => 'border-width',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider-nav button, .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li',
				],
			],
		];

		$this->controls['popular_design2_hotel_nav_border_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_hotel_nav',
			'label'    => esc_html__( 'Border Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider-nav button',
				],
				[
					'property' => 'border-color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .slick-dots li.slick-active',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_popular_design2_hotel_nav_icon_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_hotel_nav',
			'label'    => esc_html__( 'Icon', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['testimonials_icon_nav_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_hotel_nav',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider-nav button i',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['testimonials_icon_nav_icon_bg'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_hotel_nav',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider-nav button',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];

		$this->controls['tft_popular_design2_hotel_nav_head'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_hotel_nav',
			'label'    => esc_html__( 'Nav', 'travelfic-toolkit' ),
			'type'     => 'separator',
		];

		$this->controls['popular_design2_hotel_nav_color'] = [
			'tab'      => 'style',
			'group'    => 'popular_design2_hotel_nav',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-popular-hotels-design__two .tft-destination-slider .slick-dots li button',
				],
			],
			'required' => [ 'tft_hotels_style', '=', 'design-2' ],
		];
	}

	public function render() {
		$settings = $this->settings;

		// Wrapper – required by Bricks so CSS/style controls apply to the root element.
		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		// Unique element selector for custom styling
		$element_selector = \Bricks\Query::is_looping() ? ".brxe-{$this->id}" : "#brxe-{$this->id}";
		if ( ! empty( $settings['_cssId'] ) ) {
			$element_selector = '#' . \Bricks\Helpers::get_element_attribute_id( $this->id, $settings );
		}

		echo '<style>';
		echo esc_html( $element_selector ) . ' .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details {';
		echo 'left: var(--popular-hotel-card-padding-left, 56px);';
		echo 'right: var(--popular-hotel-card-padding-right, 56px);';
		echo '}';
		echo '</style>';

		\Travelfic_Toolkit\Components\Hotels::render( $settings, 'bricks' );

		echo '</div>';
	}
}
