<?php
class Travelfic_Toolkit_TeamMembers extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'tft-team-members';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Travelfic Team Members', 'travelfic-toolkit');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-user-circle-o';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url()
	{
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['travelfic'];
	}
	public function get_style_depends()
	{
		return ['travelfic-toolkit-team'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['travelfic', 'team', 'member', 'tft'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'team_members',
			[
				'label' => __('Team Members', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tft_team_style',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => __('Design', 'travelfic-toolkit'),
				'default' => 'design-1',
				'options' => [
					'design-1' => __('Design 1', 'travelfic-toolkit'),
					'design-2' => __('Design 2', 'travelfic-toolkit'),
					'design-3' => __('Design 3', 'travelfic-toolkit'),
				],
			]
		);

		$this->add_control(
			'team_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__('Title', 'travelfic-toolkit'),
				'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
				'default' => __('Meet Our Tour Guide', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);
		$this->add_control(
			'team_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
				'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
				'default' => __('Our Professional Teams', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'member_img',
			[
				'label' => __('Member Image', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'member_name',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Member Name', 'travelfic-toolkit'),
				'label_block' => true,
				'default' => 'John Doe'
			]
		);
		$repeater->add_control(
			'member_designation',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Member Designation', 'travelfic-toolkit'),
				'label_block' => true,
				'default' => 'CEO'
			]
		);
		$repeater->add_control(
			'member_details',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => __('Member Details', 'travelfic-toolkit'),
				'label_block' => true,
				'default' => 'A There are many variatio of passage of Lorem for a Ipsum available ',
			]
		);

		$repeater->add_control(
			'more_options',
			[
				'label' => __('Social Media', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'member_social_fb',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Facebook', 'travelfic-toolkit'),
				'default' => '#'
			]
		);
		$repeater->add_control(
			'member_social_ld',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Linkedin', 'travelfic-toolkit'),
				'default' => '#'
			]
		);
		$repeater->add_control(
			'member_social_tw',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Twitter', 'travelfic-toolkit'),
				'default' => '#'
			]
		);
		$repeater->add_control(
			'member_social_insta',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Instagram', 'travelfic-toolkit'),
				'default' => '#'
			]
		);
		$this->add_control(
			'members_list',
			[
				'label' => __('Members List', 'travelfic-toolkit'),
				'show_label' => false,
				'prevent_empty' => false,
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ member_name }}}',
			]
		);
		$this->end_controls_section();

		// slider control settings check
		$this->start_controls_section(
			'team_slider_control',
			[
				'label' => __('Slider Control', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tft_team_style' => ['design-2'],
				],

			]
		);
		$this->add_control(
			'team_design2_slider_slidetoshow',
			[
				'label'       => __('Slide To Show', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min' 		  => 1,
				'max' 		  => 15,
				'step' => 1,
				'default' => 3,
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);

		$this->add_control(
			'team_design2_slider_slidetoscroll',
			[
				'label'       => __('Slide To Scroll', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_navigation',
			[
				'label'       => __('Navigation', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'dots',
				'options'     => [
					'none' => __('None', 'travelfic-toolkit'),
					'dots' => __('Dots', 'travelfic-toolkit'),
					'arrows' => __('Arrows', 'travelfic-toolkit'),
				],
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_autoplay',
			[
				'label'       => __('Autoplay', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'yes',
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_autoplay_speed',
			[
				'label' => esc_html__('Autoplay Speed', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 3000,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 100
					],
				],
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_autoplay_interval',
			[
				'label' => esc_html__('Autoplay Interval', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 1500,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 100
					],
				],
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_loop',
			[
				'label' => esc_html__('Loop', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'no',
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);

		$this->add_control(
			'team_design2_slider_pause_on_hover',
			[
				'label' => esc_html__('Pause On Hover', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'no',
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_pause_on_focus',
			[
				'label' => esc_html__('Pause On Focus', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'no',
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_rtl',
			[
				'label' => esc_html__('RTL', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'no',
				'condition'   => [
					'tft_team_style' => 'design-2',
					'team_design2_slider_loop!' => 'yes',
				],
			]
		);
		$this->add_control(
			'team_design2_slider_draggable',
			[
				'label' => esc_html__('Draggable', 'travelfic-toolkit'),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'yes',
				'condition'   => [
					'tft_team_style' => 'design-2',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'team_top_section',
			[
				'label' => __('Top Section', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);

		$this->add_control(
			'team_sec_title',
			[
				'label'     => __('Title', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'team_sec_title_typo',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-title',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_sec_title_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);

		// Title Backdrop
		$this->add_control(
			'team_sec_title_backdrop',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => esc_html__('Title Backdrop', 'travelfic-toolkit'),
				'default' => 'yes',
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_sec_title_backdrop_head',
			[
				'label'     => __('Title Backdrop', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => ['design-2'],
					'team_sec_title_backdrop' => 'yes',
				]
			]
		);
		$this->add_control(
			'team_sec_title_backdrop_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-title::after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'tft_team_style' => 'design-2',
					'team_sec_title_backdrop' => 'yes',
				],
			]
		);

		// Sub Title
		$this->add_control(
			'team_sec_subtitle',
			[
				'label'     => __('Subtitle', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'team_sec_subtitle_typo',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);
		$this->add_control(
			'team_sec_subtitle_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
				],
				'condition' => [
					'tft_team_style' => 'design-2',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'team_style_section',
			[
				'label' => __('Item List', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_card_head',
			[
				'label'     => __('Card', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'team_card_padding',
			[
				'label'      => __('Padding', 'travelfic-toolkit'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'#tft-site-main-body #page {{WRAPPER}} .member-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .tft-single-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// $this->add_responsive_control(
		// 	'team_card_border_radius',
		// 	[
		// 		'label'      => __('Border Radius', 'travelfic-toolkit'),
		// 		'type'       => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => ['px', '%', 'em'],
		// 		'selectors' => [
		// 			'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member' => 'border-radius: {{SIZE}}{{UNIT}};',
		// 			'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .tft-single-member' => 'border-radius: {{SIZE}}{{UNIT}};',
		// 			'#tft-site-main-body #page {{WRAPPER}} .tft-single-member' => 'border-radius: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
		$this->add_control(
            'team_card_border_radius',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-single-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'team_card_title',
			[
				'label'     => __('Title', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => ['design-1', 'design-3'],
				]
			]
		);
		// design 1
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_title_typo',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .member-details .tft-title, 
							   #tft-site-main-body #page {{WRAPPER}} .tft-team-design__three .tft-team-members .tft-single-member .member-details .tft-title',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => ['design-1', 'design-3']
				]
			]
		);

		$this->add_control(
			'team_card_title_design_2',
			[
				'label'     => __('Title', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => 'design-2',
				]
			]
		);
		// design 2
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_title_typo_design_2',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .tft-single-member .member-details .tft-title',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-2',
				]
			]
		);
		$this->add_control(
			'team_card_title_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .member-details .tft-title' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .tft-single-member .member-details .tft-title' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__three .tft-team-members .tft-single-member .member-details .tft-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'team_card_subtitle',
			[
				'label'     => __('Subtitle', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => 'design-1',
				]
			]
		);

		// design 1
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_subtitle_typo',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .member-details .tft-subtitle',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-1',
				],
			]
		);


		$this->add_control(
			'team_card_subtitle_design_2',
			[
				'label'     => __('Subtitle', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => ['design-2', 'design-3']
				]
			]
		);

		// design 2
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_subtitle_typo_desing_2',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .tft-single-member .member-details h3,
							   #tft-site-main-body #page {{WRAPPER}} .tft-team-design__three .tft-team-members .tft-single-member .member-details span',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => ['design-2', 'design-3'],
				]
			]
		);
		$this->add_control(
			'team_card_subtitle_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .member-details .tft-subtitle' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .tft-single-member .member-details h3' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__three .tft-team-members .tft-single-member .member-details span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'team_card_content',
			[
				'label'     => __('Content', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'tft_team_style' => 'design-1',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'team_card_content_typo',
				'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .member-details .tft-content',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-1',
				],
			]
		);
		$this->add_control(
			'team_card_content_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .member-details .tft-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'tft_team_style' => 'design-1',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'team_icon',
			[
				'label' => __('Social', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_icon_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .social-media a' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .social-media-icons button i' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .social-media-icons .social-media a' => 'color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__three .social-media a svg path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'team_icon_color_bg',
			[
				'label'     => __('Background', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__one .tft-single-member .social-media a' => 'background-color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .social-media-icons button' => 'background-color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .social-media-icons button' => 'background-color: {{VALUE}}',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__three .social-media a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		// navigations
		$this->start_controls_section(
			'team_slider_nav',
			[
				'label' => __('Navigation', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);

		$this->add_control(
			'team_slider_nav_button',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .slick-dots li button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);
		$this->add_control(
			'team_slider_nav_button_active',
			[
				'label'     => __('Active Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
					'#tft-site-main-body #page {{WRAPPER}} .tft-team-design__two .tft-team-members .slick-dots li.slick-active' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		\Travelfic_Toolkit\Components\TeamMembers::render( $settings, 'elementor' );
	}
}
