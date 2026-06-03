<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic About Us Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_AboutUs extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-about-us';
	public $icon     = 'ti-info-alt';

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-about-us' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic About Us', 'travelfic-toolkit' );
	}

	public function set_control_groups() {
		// Content Group
		$this->control_groups['tft_about_us'] = [
			'title' => esc_html__( 'About Us', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Group
		$this->control_groups['about_us_style'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'style',
		];
	}

	public function set_controls() {
		$this->controls['tft_about_style'] = [
			'tab'     => 'content',
			'group'   => 'tft_about_us',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
			],
			'default' => 'design-1',
		];

		$this->controls['about_us_title'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Enjoy an extraordinary retreat with us', 'travelfic-toolkit' ),
		];

		$this->controls['about_us_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'about us', 'travelfic-toolkit' ),
		];

		$this->controls['about_us_experience'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'Years of Experience', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter Years of Experience', 'travelfic-toolkit' ),
			'default'     => esc_html__( '15+', 'travelfic-toolkit' ),
			'required'    => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_image'] = [
			'tab'   => 'content',
			'group' => 'tft_about_us',
			'label' => esc_html__( 'About Us Image', 'travelfic-toolkit' ),
			'type'  => 'image',
		];

		$this->controls['about_us_circle_image'] = [
			'tab'      => 'content',
			'group'    => 'tft_about_us',
			'label'    => esc_html__( 'About Us Circle Image', 'travelfic-toolkit' ),
			'type'     => 'image',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_content'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'Descriptions', 'travelfic-toolkit' ),
			'type'        => 'editor',
			'placeholder' => esc_html__( 'Enter your descriptions', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Welcome to VICTORIA, where comfort meets elegance. Personalized service and attention to detail ensure a truly exceptional stay. Stay in luxury, dine exquisitely, and relax in the spa. With us, you can create unforgettable memories.
"Creating memorable moments is our passion. Welcome to our hotel, where comfort, elegance, and genuine hospitality meet."', 'travelfic-toolkit' ),
		];

		$this->controls['about_us_quotes'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'Quotes', 'travelfic-toolkit' ),
			'type'        => 'editor',
			'placeholder' => esc_html__( 'Enter your descriptions', 'travelfic-toolkit' ),
			'default'     => esc_html__( '"Creating memorable moments is our passion. Welcome to our hotel, where comfort, elegance, and genuine hospitality meet."', 'travelfic-toolkit' ),
			'required'    => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_author'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'Author Details', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Add Author Details', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'CEO of VICTORIA', 'travelfic-toolkit' ),
			'required'    => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_list_content'] = [
			'tab'           => 'content',
			'group'         => 'tft_about_us',
			'label'         => esc_html__( 'About List Content', 'travelfic-toolkit' ),
			'type'          => 'repeater',
			'titleProperty' => 'about_list_title',
			'fields'        => [
				'about_list_title' => [
					'label'   => esc_html__( 'About List Title', 'travelfic-toolkit' ),
					'type'    => 'text',
					'default' => esc_html__( 'Easy & Modern Customer Solution', 'travelfic-toolkit' ),
				],
			],
			'default'       => [
				[
					'about_list_title' => esc_html__( 'Easy & Modern Customer Solution', 'travelfic-toolkit' ),
				],
			],
			'required'      => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['readme_label'] = [
			'tab'         => 'content',
			'group'       => 'tft_about_us',
			'label'       => esc_html__( 'Read More Label', 'travelfic-toolkit' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'Enter read more label', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'About Us', 'travelfic-toolkit' ),
			'required'    => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['readme_link'] = [
			'tab'     => 'content',
			'group'   => 'tft_about_us',
			'label'   => esc_html__( 'Read More URL', 'travelfic-toolkit' ),
			'type'    => 'link',
			'default' => [
				'url' => '#',
			],
		];

		// Style Controls
		$this->controls['about_content_positon'] = [
			'tab'     => 'style',
			'group'   => 'about_us_style',
			'label'   => esc_html__( 'Content Position', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'left'   => esc_html__( 'Left', 'travelfic-toolkit' ),
				'center' => esc_html__( 'Center', 'travelfic-toolkit' ),
				'right'  => esc_html__( 'Right', 'travelfic-toolkit' ),
			],
			'default' => 'left',
			'css'     => [
				[
					'property' => 'text-align',
					'selector' => '.tft-about-us-content',
				],
				[
					'property' => 'justify-content',
					'selector' => '.tft-about-us-design__two .tft-about-us-content .tft-about-us-list ul li',
				],
			],
		];

		$this->controls['about_us_title_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sub_title_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Sub Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_content_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_content_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-content p',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_Quotes_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Quotes', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_quotes_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-content p.tft-about-us-quotes',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_author_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Author', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_author_alignment'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Alignment', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => [
				'left'   => esc_html__( 'Left', 'travelfic-toolkit' ),
				'center' => esc_html__( 'Center', 'travelfic-toolkit' ),
				'right'  => esc_html__( 'Right', 'travelfic-toolkit' ),
			],
			'default'  => 'right',
			'css'      => [
				[
					'property' => 'text-align',
					'selector' => '.tft-heading-content .tft-section-content p.tft-about-us-author',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_author_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-content p.tft-about-us-author',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_experience_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Experience', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_sec_years_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-grid .years-of-experience .tft-experience-years h2',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_design2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content h2',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_title_backdrop'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_title_backdrop_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Title Backdrop Style', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [
				[ 'tft_about_style', '=', 'design-2' ],
				[ 'about_us_design2_title_backdrop', '=', true ],
			],
		];

		$this->controls['about_us_design2_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-about-us-design__two .tft-heading-content h2::after',
				],
			],
			'required' => [
				[ 'tft_about_style', '=', 'design-2' ],
				[ 'about_us_design2_title_backdrop', '=', true ],
			],
		];

		$this->controls['about_us_design2_sub_title_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Sub Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-design__two .tft-heading-content h3',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_content_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_sec_content_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-design__two .tft-heading-content p',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_button_design1_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Button Design 1', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['button_typography'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Button Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-design__one .tft-about-us-grid .tft-about-us-content .read-more a',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-1' ],
		];

		$this->controls['about_us_button_design2_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Button Design 2', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_button_typography'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Button Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-button a',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_button_margin_'] = [
			'tab'    => 'style',
			'group'  => 'about_us_style',
			'label'  => esc_html__( 'Button Margin', 'travelfic-toolkit' ),
			'type'   => 'dimensions',
			'css'    => [
				[
					'property' => 'margin',
					'selector' => '.tft-about-us-design__one .tft-about-us-grid .tft-about-us-content .read-more a, .tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-button a',
				],
			],
		];

		$this->controls['about_button_padding_'] = [
			'tab'    => 'style',
			'group'  => 'about_us_style',
			'label'  => esc_html__( 'Button Padding', 'travelfic-toolkit' ),
			'type'   => 'dimensions',
			'css'    => [
				[
					'property' => 'padding',
					'selector' => '.tft-about-us-design__one .tft-about-us-grid .tft-about-us-content .read-more a, .tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-button a',
				],
			],
		];

		$this->controls['about_button_border_'] = [
			'tab'    => 'style',
			'group'  => 'about_us_style',
			'label'  => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'   => 'border',
			'css'    => [
				[
					'selector' => '.tft-about-us-design__one .tft-about-us-grid .tft-about-us-content .read-more a, .tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-button a',
				],
			],
		];

		$this->controls['about_us_button_background_color'] = [
			'tab'    => 'style',
			'group'  => 'about_us_style',
			'label'  => esc_html__( 'Button Background', 'travelfic-toolkit' ),
			'type'   => 'color',
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.tft-about-us-design__one .tft-about-us-grid .tft-about-us-content .read-more a, .tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-button a',
				],
			],
		];

		$this->controls['about_us_section_list'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'List', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_design2_sec_list_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'List Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .icon i',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_sec_list_color'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'List Text Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .text',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_sec_list_icon_head'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Icon', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_sec_list_icon_typo'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Icon Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-about-us-design__two .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .icon i',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_section_shape'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Shape', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_sec_shape_1'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Shape 1 Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-about-us-design__two .tft-about-us-grid .tft-about-image::before',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];

		$this->controls['about_us_sec_shape_2'] = [
			'tab'      => 'style',
			'group'    => 'about_us_style',
			'label'    => esc_html__( 'Shape 2 Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-about-us-design__two .tft-about-us-grid .tft-about-image::after',
				],
			],
			'required' => [ 'tft_about_style', '=', 'design-2' ],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\AboutUs::render( $settings, 'bricks' );

		echo '</div>';
	}
}
