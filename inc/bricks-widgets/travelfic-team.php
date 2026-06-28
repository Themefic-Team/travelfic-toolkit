<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Team Members Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_TeamMembers extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-team-members';
	public $icon     = 'ti-user'; // using Themify user icon
	public $scripts  = [ 'tftBricksTeam' ];

	public function add_actions() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ], 12 );
	}

	public function register_script() {
		$path = TRAVELFIC_TOOLKIT_PATH . 'assets/app/js/bricks/team.js';

		wp_register_script(
			'tft-bricks-team',
			TRAVELFIC_TOOLKIT_URL . 'assets/app/js/bricks/team.js',
			[ 'bricks-scripts', 'jquery', 'tf-slick' ],
			file_exists( $path ) ? (string) filemtime( $path ) : TRAVELFIC_TOOLKIT_VERSION,
			true
		);
	}

	public function get_label() {
		return esc_html__( 'Travelfic Team Members', 'travelfic-toolkit' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-team' );
		wp_enqueue_script( 'tft-bricks-team' );
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['team_members'] = [
			'title' => esc_html__( 'Team Members', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['team_slider_control'] = [
			'title'    => esc_html__( 'Slider Control', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		// Style Tabs (but registered in 'content' tab in set_control_groups)
		$this->control_groups['team_top_section'] = [
			'title'    => esc_html__( 'Top Section', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->control_groups['team_style_section'] = [
			'title' => esc_html__( 'Item List', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['team_icon'] = [
			'title' => esc_html__( 'Social', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['team_slider_nav'] = [
			'title'    => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'tab'      => 'content',
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['tft_team_style'] = [
			'tab'     => 'content',
			'group'   => 'team_members',
			'type'    => 'select',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'default' => 'design-1',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
				'design-3' => esc_html__( 'Design 3', 'travelfic-toolkit' ),
			],
		];

		$this->controls['team_title'] = [
			'tab'         => 'content',
			'group'       => 'team_members',
			'type'        => 'textarea',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Meet Our Tour Guide', 'travelfic-toolkit' ),
			'required'    => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'team_members',
			'type'        => 'textarea',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'Our Professional Teams', 'travelfic-toolkit' ),
			'required'    => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['members_list'] = [
			'tab'    => 'content',
			'group'  => 'team_members',
			'type'   => 'repeater',
			'label'  => esc_html__( 'Members List', 'travelfic-toolkit' ),
			'fields' => [
				'member_img'         => [
					'type'  => 'image',
					'label' => esc_html__( 'Member Image', 'travelfic-toolkit' ),
				],
				'member_name'        => [
					'type'    => 'text',
					'label'   => esc_html__( 'Member Name', 'travelfic-toolkit' ),
					'default' => esc_html__( 'John Doe', 'travelfic-toolkit' ),
				],
				'member_designation' => [
					'type'    => 'text',
					'label'   => esc_html__( 'Member Designation', 'travelfic-toolkit' ),
					'default' => esc_html__( 'CEO', 'travelfic-toolkit' ),
				],
				'member_details'     => [
					'type'    => 'textarea',
					'label'   => esc_html__( 'Member Details', 'travelfic-toolkit' ),
					'default' => esc_html__( 'A There are many variatio of passage of Lorem for a Ipsum available ', 'travelfic-toolkit' ),
				],
				'more_options'       => [
					'type'  => 'separator',
					'label' => esc_html__( 'Social Media', 'travelfic-toolkit' ),
				],
				'member_social_fb'   => [
					'type'    => 'text',
					'label'   => esc_html__( 'Facebook', 'travelfic-toolkit' ),
					'default' => '#',
				],
				'member_social_ld'   => [
					'type'    => 'text',
					'label'   => esc_html__( 'Linkedin', 'travelfic-toolkit' ),
					'default' => '#',
				],
				'member_social_tw'   => [
					'type'    => 'text',
					'label'   => esc_html__( 'Twitter', 'travelfic-toolkit' ),
					'default' => '#',
				],
				'member_social_insta'=> [
					'type'    => 'text',
					'label'   => esc_html__( 'Instagram', 'travelfic-toolkit' ),
					'default' => '#',
				],
			],
		];

		// ========== SLIDER CONTROL ==========
		$this->controls['team_design2_slider_slidetoshow'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'number',
			'label'    => esc_html__( 'Slide To Show', 'travelfic-toolkit' ),
			'min'      => 1,
			'max'      => 15,
			'step'     => 1,
			'default'  => 3,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_slidetoscroll'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'number',
			'label'    => esc_html__( 'Slide To Scroll', 'travelfic-toolkit' ),
			'min'      => 1,
			'max'      => 10,
			'step'     => 1,
			'default'  => 1,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_navigation'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'select',
			'label'    => esc_html__( 'Navigation', 'travelfic-toolkit' ),
			'default'  => 'dots',
			'options'  => [
				'none'   => esc_html__( 'None', 'travelfic-toolkit' ),
				'dots'   => esc_html__( 'Dots', 'travelfic-toolkit' ),
				'arrows' => esc_html__( 'Arrows', 'travelfic-toolkit' ),
			],
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_autoplay'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Autoplay', 'travelfic-toolkit' ),
			'default'  => true,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_autoplay_speed'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'number',
			'label'    => esc_html__( 'Autoplay Speed', 'travelfic-toolkit' ),
			'default'  => 3000,
			'min'      => 100,
			'max'      => 1000,
			'step'     => 100,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_autoplay_interval'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'number',
			'label'    => esc_html__( 'Autoplay Interval', 'travelfic-toolkit' ),
			'default'  => 1500,
			'min'      => 100,
			'max'      => 1000,
			'step'     => 100,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_loop'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Loop', 'travelfic-toolkit' ),
			'default'  => false,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_pause_on_hover'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Pause On Hover', 'travelfic-toolkit' ),
			'default'  => false,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_pause_on_focus'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Pause On Focus', 'travelfic-toolkit' ),
			'default'  => false,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_design2_slider_rtl'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'RTL', 'travelfic-toolkit' ),
			'default'  => false,
			'required' => [
				[ 'tft_team_style', '=', 'design-2' ],
				[ 'team_design2_slider_loop', '!=', true ],
			],
		];

		$this->controls['team_design2_slider_draggable'] = [
			'tab'      => 'content',
			'group'    => 'team_slider_control',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Draggable', 'travelfic-toolkit' ),
			'default'  => true,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		// ========== STYLE: TOP SECTION ==========
		$this->controls['team_sec_title'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_sec_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-title',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		// Note: 'team_sec_title_color' control is omitted because of rule 9 (typography includes color in Bricks)

		$this->controls['team_sec_title_backdrop'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'default'  => true,
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_sec_title_backdrop_head'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'required' => [
				[ 'tft_team_style', '=', 'design-2' ],
				[ 'team_sec_title_backdrop', '=', true ],
			],
		];

		$this->controls['team_sec_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'color',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-heading-content .tft-section-title::after',
				],
			],
			'required' => [
				[ 'tft_team_style', '=', 'design-2' ],
				[ 'team_sec_title_backdrop', '=', true ],
			],
		];

		$this->controls['team_sec_subtitle'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_sec_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'team_top_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content .tft-section-subtitle',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		// Note: 'team_sec_subtitle_color' control is omitted because of rule 9

		// ========== STYLE: ITEM LIST ==========
		$this->controls['team_card_head'] = [
			'tab'   => 'style',
			'group' => 'team_style_section',
			'type'  => 'separator',
			'label' => esc_html__( 'Card', 'travelfic-toolkit' ),
		];

		$this->controls['team_card_padding'] = [
			'tab'   => 'style',
			'group' => 'team_style_section',
			'type'  => 'spacing',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.member-details, .tft-team-design__two .tft-team-members .tft-single-member',
				],
			],
		];

		// Note: 'team_card_border_radius' control is omitted because of rule 11

		$this->controls['team_card_title'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', [ 'design-1', 'design-3' ] ],
		];

		$this->controls['icon-team_card_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-team-design__one .tft-single-member .member-details .tft-title, .tft-team-design__three .tft-team-members .tft-single-member .member-details .tft-title',
				],
			],
			'required' => [ 'tft_team_style', '=', [ 'design-1', 'design-3' ] ],
		];

		$this->controls['team_card_title_design_2'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['icon-team_card_title_typo_design_2'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-team-design__two .tft-team-members .tft-single-member .member-details .tft-title',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		// Note: 'team_card_title_color' control is omitted because of rule 9

		$this->controls['team_card_subtitle'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', 'design-1' ],
		];

		$this->controls['icon-team_card_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-team-design__one .tft-single-member .member-details .tft-subtitle',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-1' ],
		];

		$this->controls['team_card_subtitle_design_2'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', [ 'design-2', 'design-3' ] ],
		];

		$this->controls['icon-team_card_subtitle_typo_desing_2'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-team-design__two .tft-team-members .tft-single-member .member-details h3, .tft-team-design__three .tft-team-members .tft-single-member .member-details span',
				],
			],
			'required' => [ 'tft_team_style', '=', [ 'design-2', 'design-3' ] ],
		];

		// Note: 'team_card_subtitle_color' control is omitted because of rule 9

		$this->controls['team_card_content'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'separator',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'required' => [ 'tft_team_style', '=', 'design-1' ],
		];

		$this->controls['team_card_content_typo'] = [
			'tab'      => 'style',
			'group'    => 'team_style_section',
			'type'     => 'typography',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-team-design__one .tft-single-member .member-details .tft-content',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-1' ],
		];

		// Note: 'team_card_content_color' control is omitted because of rule 9

		// ========== STYLE: SOCIAL ICONS ==========
		$this->controls['team_icon_color'] = [
			'tab'   => 'style',
			'group' => 'team_icon',
			'type'  => 'color',
			'label' => esc_html__( 'Color', 'travelfic-toolkit' ),
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.tft-team-design__one .tft-single-member .social-media a, .tft-team-design__two .social-media-icons button i, .tft-team-design__two .social-media-icons .social-media a',
				],
				[
					'property' => 'stroke',
					'selector' => '.tft-team-design__three .social-media a svg path',
				],
			],
		];

		$this->controls['team_icon_color_bg'] = [
			'tab'   => 'style',
			'group' => 'team_icon',
			'type'  => 'color',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.tft-team-design__one .tft-single-member .social-media a, .tft-team-design__two .social-media-icons button, .tft-team-design__three .social-media a',
				],
			],
		];

		// ========== STYLE: SLIDER NAVIGATION ==========
		$this->controls['team_slider_nav_button'] = [
			'tab'      => 'style',
			'group'    => 'team_slider_nav',
			'type'     => 'color',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-team-design__two .tft-team-members .slick-dots li button',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];

		$this->controls['team_slider_nav_button_active'] = [
			'tab'      => 'style',
			'group'    => 'team_slider_nav',
			'type'     => 'color',
			'label'    => esc_html__( 'Active Color', 'travelfic-toolkit' ),
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-team-design__two .tft-team-members .slick-dots li.slick-active button',
				],
				[
					'property' => 'border-color',
					'selector' => '.tft-team-design__two .tft-team-members .slick-dots li.slick-active',
				],
			],
			'required' => [ 'tft_team_style', '=', 'design-2' ],
		];
	}

	public function render() {
		$settings = $this->settings;
		$this->set_attribute( '_root', 'style', 'width: 100%;' );

		echo '<div ' . $this->render_attributes( '_root' ) . '>';
		\Travelfic_Toolkit\Components\TeamMembers::render( $settings, 'bricks' );
		echo '</div>';
	}
}
