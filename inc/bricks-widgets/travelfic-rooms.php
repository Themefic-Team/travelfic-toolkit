<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Rooms Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_Rooms extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-rooms';
	public $icon     = 'ti-home';
	public $scripts  = [ 'tftBricksRooms' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/rooms.js';

		wp_register_script(
			'tft-bricks-rooms',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/rooms.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-rooms' );
		wp_enqueue_script( 'tft-bricks-rooms' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Rooms', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['tft_rooms'] = [
			'title' => esc_html__( 'Rooms Section', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['team_slider_control'] = [
			'title' => esc_html__( 'Slider Control', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['popular_tour_style_section'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['tft_rooms_style'] = [
			'tab'     => 'content',
			'group'   => 'tft_rooms',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
			],
		];

		$this->controls['post_order_by'] = [
			'tab'     => 'content',
			'group'   => 'tft_rooms',
			'label'   => esc_html__( 'Order by', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'date',
			'options' => [
				'date'     => esc_html__( 'Date', 'travelfic-toolkit' ),
				'title'    => esc_html__( 'Title', 'travelfic-toolkit' ),
				'modified' => esc_html__( 'Modified date', 'travelfic-toolkit' ),
			],
		];

		$this->controls['post_items'] = [
			'tab'     => 'content',
			'group'   => 'tft_rooms',
			'label'   => esc_html__( 'Item Per page', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 6,
		];

		$this->controls['post_order'] = [
			'tab'     => 'content',
			'group'   => 'tft_rooms',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'DESC',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
		];

		$this->controls['card_title_type'] = [
			'tab'     => 'content',
			'group'   => 'tft_rooms',
			'label'   => esc_html__( 'Card Title', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'Split',
			'options' => [
				'Split' => esc_html__( 'Split', 'travelfic-toolkit' ),
				'Full'  => esc_html__( 'Full Title', 'travelfic-toolkit' ),
			],
		];

		// ========== SLIDER CONTROL GROUP ==========
		$this->controls['tft_room_slider_navigation'] = [
			'tab'     => 'content',
			'group'   => 'team_slider_control',
			'label'   => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'type'    => 'select',
			'default' => 'arrows',
			'options' => [
				'none'   => esc_html__( 'None', 'travelfic-toolkit' ),
				'dots'   => esc_html__( 'Dots', 'travelfic-toolkit' ),
				'arrows' => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			],
		];

		$this->controls['tft_room_slider_autoplay'] = [
			'tab'     => 'content',
			'group'   => 'team_slider_control',
			'label'   => esc_html__( 'Autoplay', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => true,
		];

		$this->controls['tft_room_slider_autoplay_speed'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Autoplay Speed', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 2000,
			'min'      => 100,
			'max'      => 5000,
			'step'     => 100,
			'required' => [ 'tft_room_slider_autoplay', '=', true ],
		];

		$this->controls['tft_room_slider_autoplay_interval'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'label'    => esc_html__( 'Autoplay Interval', 'travelfic-toolkit' ),
			'type'     => 'number',
			'default'  => 1500,
			'min'      => 100,
			'max'      => 5000,
			'step'     => 100,
			'required' => [ 'tft_room_slider_autoplay', '=', true ],
		];

		$this->controls['tft_room_slider_loop'] = [
			'tab'     => 'content',
			'group'   => 'team_slider_control',
			'label'   => esc_html__( 'Loop', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => false,
		];

		$this->controls['tft_room_slider_pause_on_hover'] = [
			'tab'     => 'content',
			'group'   => 'team_slider_control',
			'label'   => esc_html__( 'Pause On Hover', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => false,
		];

		$this->controls['tft_room_slider_pause_on_focus'] = [
			'tab'     => 'content',
			'group'   => 'team_slider_control',
			'label'   => esc_html__( 'Pause On Focus', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => false,
		];

		$this->controls['tft_room_slider_draggable'] = [
			'tab'     => 'content',
			'group'   => 'team_slider_control',
			'label'   => esc_html__( 'Draggable', 'travelfic-toolkit' ),
			'type'    => 'checkbox',
			'default' => true,
		];

		// ========== STYLE GROUP ==========
		$this->controls['popular_card_heading'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Card', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_hotel_card_padding'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room',
				],
			],
		];

		$this->controls['popular_hotel_card_color'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room',
				],
				[
					'property' => 'background',
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content',
				],
			],
		];

		$this->controls['popular_card_title_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_hotel_card_title_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-title',
				],
			],
		];

		$this->controls['popular_card_feature_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Features', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_hotel_card_features_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content ul li',
				],
			],
		];

		$this->controls['popular_card_price_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Price', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_hotel_card_price_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-room-content .tf-room-price .discount-price, .tft-room-content .tf-room-price .sale-price',
				],
			],
		];

		$this->controls['popular_card_button_head'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['popular_hotel_card_button_typo'] = [
			'tab'     => 'style',
			'group'   => 'popular_tour_style_section',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn',
				],
			],
		];

		$this->controls['popular_hotel_card_button_margin_'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'margin',
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn',
				],
			],
		];

		$this->controls['popular_hotel_card_button_padding_'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn',
				],
			],
		];

		$this->controls['popular_hotel_card_button_bg'] = [
			'tab'   => 'style',
			'group' => 'popular_tour_style_section',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\Rooms::render( $settings, 'bricks' );

		echo '</div>';
	}
}
