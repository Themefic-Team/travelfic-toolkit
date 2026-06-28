<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Icon With Text Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_IconWithText extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-icon-with-text';
	public $icon     = 'ti-info-alt';
	public $scripts  = [];

	public function get_label() {
		return esc_html__( 'Travelfic Icon With Text', 'travelfic-toolkit' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-icon-text' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['icon_with_text'] = [
			'title' => esc_html__( 'Items', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['icon_text_section_style'] = [
			'title' => esc_html__( 'Section', 'travelfic-toolkit' ),
			'tab'   => 'content',
            'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->control_groups['icon_text_item_style'] = [
			'title' => esc_html__( 'Item List', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['tft_icon_style'] = [
			'tab'     => 'content',
			'group'   => 'icon_with_text',
			'type'    => 'select',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
			],
		];

		$this->controls['sec_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'icon_with_text',
			'type'        => 'textarea',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Work Process', 'travelfic-toolkit' ),
			'required'    => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['sec_title'] = [
			'tab'         => 'content',
			'group'       => 'icon_with_text',
			'type'        => 'textarea',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'How IT Works', 'travelfic-toolkit' ),
			'required'    => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['icon_text_list'] = [
			'tab'    => 'content',
			'group'  => 'icon_with_text',
			'type'   => 'repeater',
			'label'  => esc_html__( 'Repeater List', 'travelfic-toolkit' ),
			'fields' => [
				'image_icon_switcher' => [
					'type'     => 'select',
					'label'    => esc_html__( 'Choose Type', 'travelfic-toolkit' ),
					'options'  => [
						'image' => esc_html__( 'Image', 'travelfic-toolkit' ),
						'icon'  => esc_html__( 'Icon', 'travelfic-toolkit' ),
					],
					'default'  => 'icon',
				],
				'box_image'           => [
					'type'       => 'image',
					'label'      => esc_html__( 'Image', 'travelfic-toolkit' ),
					'required'   => [ 'image_icon_switcher', '=', 'image' ],
				],
				'box_icon'            => [
					'type'     => 'icon',
					'label'    => esc_html__( 'Icon', 'travelfic-toolkit' ),
					'required' => [ 'image_icon_switcher', '=', 'icon' ],
				],
				'box_title'           => [
					'type'        => 'text',
					'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
					'default'     => esc_html__( 'Your Heading Text Here', 'travelfic-toolkit' ),
				],
				'box_details'         => [
					'type'    => 'textarea',
					'label'   => esc_html__( 'Descriptions', 'travelfic-toolkit' ),
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'travelfic-toolkit' ),
				],
				'active_gap'          => [
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Active Gap Item', 'travelfic-toolkit' ),
					'default'    => false,
					'required'   => [ 'tft_icon_style', '=', 'design-1' ],
				],
			],
		];

		$this->controls['items_gap'] = [
			'tab'      => 'content',
			'group'    => 'icon_with_text',
			'type'     => 'number',
			'label'    => esc_html__( 'Middle item gap', 'travelfic-toolkit' ),
			'default'  => 70,
			'min'      => 0,
			'max'      => 500,
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		// ========== STYLE GROUP: SECTION STYLE ==========
		$this->controls['sec_title_style'] = [
			'tab'    => 'style',
			'group'  => 'icon_text_section_style',
			'type'   => 'separator',
			'label'  => esc_html__( 'Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['sec_title_typography'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_section_style',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-icon-text-design__two .tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['sec_title_backdrop'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_section_style',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'default'  => true,
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['sec_title_backdrop_head'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_section_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-2', 'sec_title_backdrop', '=', true ],
		];

		$this->controls['sec_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_section_style',
			'type'     => 'color',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-heading-content .tft-section-title::after',
				],
			],
			'required' => [ 
                ['tft_icon_style', '=', 'design-2' ],
                ['sec_title_backdrop', '=', true ],
            ],
		];

		$this->controls['sec_sub_title_style'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_section_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Sub Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['sec_sub_title_typography'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_section_style',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-icon-text-design__two .tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		// ========== STYLE GROUP: ITEM STYLE ==========
		$this->controls['icon_text_card'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Card', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['item_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'spacing',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-icon-text-design__one .tft-icon-text-single-inner',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['list_card_bg_color'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'color',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-icon-text-design__one .tft-icon-text-items .tft-icon-text-single',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['icon_id'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Icon', 'travelfic-toolkit' ),
		];

		$this->controls['icon_size'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'number',
			'label'    => esc_html__( 'Size', 'travelfic-toolkit' ),
			'default'  => 50,
			'min'      => 0,
			'max'      => 200,
            'units' => true,
			'css'      => [
				[
					'property' => 'font-size',
					'selector' => '.tft-icon-text-design__one .tft-icon i, .tft-icon-text-design__two .tft-icon-text-items .tft-icon-text-single .icon_outter .img-box i',
				],
				[
					'property' => 'width',
					'selector' => '.tft-icon-text-design__one .tft-icon img, .tft-icon-text-design__one .tft-icon svg, .tft-icon-text-design__two .tft-icon-text-items .tft-icon-text-single .icon_outter .img-box img, .tft-icon-text-design__two .tft-icon-text-items .tft-icon-text-single .icon_outter .img-box svg',
				],
				[
					'property' => 'height',
					'selector' => '.tft-icon-text-design__one .tft-icon img, .tft-icon-text-design__one .tft-icon svg, .tft-icon-text-design__two .tft-icon-text-items .tft-icon-text-single .icon_outter .img-box img, .tft-icon-text-design__two .tft-icon-text-items .tft-icon-text-single .icon_outter .img-box svg',
				],
			],
		];

		$this->controls['icon_image_box'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Icon Box', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['icon_box_inner'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'number',
			'label'    => esc_html__( 'Icon Inner Width & Height', 'travelfic-toolkit' ),
			'default'  => 100,
			'min'      => 0,
			'max'      => 200,
            'units' => true,
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.tft-icon-text-design__two .container .icon_outter .img-box',
				],
				[
					'property' => 'height',
					'selector' => '.tft-icon-text-design__two .container .icon_outter .img-box',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['icon_outter_width'] = [
			'tab'     => 'style',
			'group'   => 'icon_text_item_style',
			'type'    => 'number',
			'label'   => esc_html__( 'Icon outter Width', 'travelfic-toolkit' ),
			'default' => 120,
			'min'     => 1,
			'max'     => 200,
            'units' => true,
			'css'     => [
				[
					'property' => 'width',
					'selector' => '.tft-icon-text-design__one .icon_outter',
				],
				[
					'property' => 'width',
					'selector' => '.tft-icon-text-design__two .container .icon_outter',
				],
			],
		];

		$this->controls['icon_outter_height'] = [
			'tab'     => 'style',
			'group'   => 'icon_text_item_style',
			'type'    => 'number',
			'label'   => esc_html__( 'Icon outter height', 'travelfic-toolkit' ),
			'default' => 120,
			'min'     => 1,
			'max'     => 200,
            'units' => true,
			'css'     => [
				[
					'property' => 'height',
					'selector' => '.tft-icon-text-design__one .icon_outter',
				],
				[
					'property' => 'height',
					'selector' => '.tft-icon-text-design__two .container .icon_outter',
				],
			],
		];

		$this->controls['icon_color'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'color',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-icon-text-design__one .tft-icon i',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['icon_color_outter_gradient_1'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'color',
			'label'    => esc_html__( 'Icon Outter Gradient 1', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['icon_color_outter_gradient_2'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'color',
			'label'    => esc_html__( 'Icon Outter Gradient 2', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['heading_id'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['icon-text_title'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-icon-text-design__one .tft-title',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['content_id'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		$this->controls['icon-text_content'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-icon-text-design__one .tft-details',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-1' ],
		];

		// Design 2 specific styles
		$this->controls['heading_id_design_2'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['icon-text_title_design_2'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-icon-text-design__two .container .tft-icon-text-items .tft-icon-text-single h3.tft-title',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['content_id_design_2'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];

		$this->controls['icon-text_content_design_2'] = [
			'tab'      => 'style',
			'group'    => 'icon_text_item_style',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-icon-text-design__two .tft-icon-text-single p',
				],
			],
			'required' => [ 'tft_icon_style', '=', 'design-2' ],
		];
	}

	public function render() {
		$settings = $this->settings;
		$this->set_attribute( '_root', 'style', 'width: 100%;' );

		echo '<div ' . $this->render_attributes( '_root' ) . '>';
		\Travelfic_Toolkit\Components\IconWithText::render( $settings, 'bricks' );
		echo '</div>';
	}
}
