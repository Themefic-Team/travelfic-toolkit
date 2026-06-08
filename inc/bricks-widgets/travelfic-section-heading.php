<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Section Heading Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_SectionHeading extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-section-header';
	public $icon     = 'ti-paragraph'; // using a suitable text heading icon
	public $scripts  = [];

	public function get_label() {
		return esc_html__( 'Travelfic Heading', 'travelfic-toolkit' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-section-heading' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['section_heading'] = [
			'title' => esc_html__( 'TFT Heading', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['tft_heading_style_section'] = [
			'title' => esc_html__( 'Heading Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['tft_heading_style'] = [
			'tab'     => 'content',
			'group'   => 'section_heading',
			'type'    => 'select',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
			],
		];

		$this->controls['tf_heading'] = [
			'tab'     => 'content',
			'group'   => 'section_heading',
			'type'    => 'text',
			'label'   => esc_html__( 'Title', 'travelfic-toolkit' ),
			'default' => esc_html__( 'Subscribe to ', 'travelfic-toolkit' ),
		];

		$this->controls['tf_heading_details'] = [
			'tab'      => 'content',
			'group'    => 'section_heading',
			'type'     => 'textarea',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'travelfic-toolkit' ),
			'required' => [ 'tft_heading_style', '=', 'design-1' ],
		];

		$this->controls['title_suffix'] = [
			'tab'     => 'content',
			'group'   => 'section_heading',
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show Suffix', 'travelfic-toolkit' ),
			'default' => true,
		];

		$this->controls['suffix_title'] = [
			'tab'     => 'content',
			'group'   => 'section_heading',
			'type'    => 'text',
			'label'   => esc_html__( 'Title Suffix', 'travelfic-toolkit' ),
			'default' => esc_html__( 'Our Newsletter', 'travelfic-toolkit' ),
		];

		$this->controls['text_align'] = [
			'tab'     => 'content',
			'group'   => 'section_heading',
			'type'    => 'select',
			'label'   => esc_html__( 'Alignment', 'travelfic-toolkit' ),
			'options' => [
				'left'   => esc_html__( 'Left', 'travelfic-toolkit' ),
				'center' => esc_html__( 'Center', 'travelfic-toolkit' ),
				'right'  => esc_html__( 'Right', 'travelfic-toolkit' ),
			],
			'default' => 'center',
		];

		// ========== STYLE GROUP ==========
		$this->controls['tft_section_head'] = [
			'tab'   => 'style',
			'group' => 'tft_heading_style_section',
			'type'  => 'separator',
			'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
		];

		$this->controls['tft_section_title_typo'] = [
			'tab'     => 'style',
			'group'   => 'tft_heading_style_section',
			'type'    => 'typography',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-section-head .section-title',
				],
			],
		];

		// Note: 'title_color' control is omitted because of rule 9 (typography includes color in Bricks)

		$this->controls['tft_section_content'] = [
			'tab'      => 'style',
			'group'    => 'tft_heading_style_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'required' => [ 'tft_heading_style', '=', 'design-1' ],
		];

		$this->controls['tft_section_content_typo'] = [
			'tab'      => 'style',
			'group'    => 'tft_heading_style_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-section-head .subtitle',
				],
			],
			'required' => [ 'tft_heading_style', '=', 'design-1' ],
		];

		// Note: 'section_content_color' control is omitted because of rule 9

		$this->controls['spacing_margin'] = [
			'tab'      => 'style',
			'group'    => 'tft_heading_style_section',
			'type'     => 'dimensions',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-section-head .subtitle',
				],
			],
			'required' => [ 'tft_heading_style', '=', 'design-1' ],
		];

		$this->controls['tft_section_suffix_head'] = [
			'tab'   => 'style',
			'group' => 'tft_heading_style_section',
			'type'  => 'separator',
			'label' => esc_html__( 'Suffix', 'travelfic-toolkit' ),
		];

		$this->controls['suffix_typo'] = [
			'tab'     => 'style',
			'group'   => 'tft_heading_style_section',
			'type'    => 'typography',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-section-head .section-title-suffix',
				],
			],
		];

		// Note: 'suffix_title_color' control is omitted because of rule 9
	}

	public function render() {
		$settings = $this->settings;
		$this->set_attribute( '_root', 'style', 'width: 100%;' );

		echo '<div ' . $this->render_attributes( '_root' ) . '>';
		\Travelfic_Toolkit\Components\SectionHeading::render( $settings, 'bricks' );
		echo '</div>';
	}
}
