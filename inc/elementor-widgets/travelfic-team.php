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
				'default' => 'John Doe'
			]
		);
		$repeater->add_control(
			'member_designation',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Member Designation', 'travelfic-toolkit'),
				'default' => 'CEO'
			]
		);
		$repeater->add_control(
			'member_details',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => __('Member Details', 'travelfic-toolkit'),
				'default' => 'A There are many variatio of passage of Lorem for a Ipsum available ',
				'condition' => [
					'tft_team_style' => 'design-1',
				],
			]
		);
		$repeater->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'more_options',
			[
				'label' => __('Social Media', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
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
				'label' => __('Twitter', 'travelfic-toolkit'),
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
				'min' => 1,
				'max' => 15,
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
				'selector' => '{{WRAPPER}} .tft-heading-content h2',
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
					'{{WRAPPER}} .tft-heading-content h2' => 'color: {{VALUE}} !important',
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
					'{{WRAPPER}} .tft-heading-content h2::after' => 'background: {{VALUE}}',
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
				'label'     => __('Sub Title', 'travelfic-toolkit'),
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
				'selector' => '{{WRAPPER}} .tft-heading-content h3',
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
					'{{WRAPPER}} .tft-heading-content h3' => 'color: {{VALUE}} !important',
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
				'label'     => __('Card Style', 'travelfic-toolkit'),
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
					'{{WRAPPER}} .member-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .tft-single-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'team_card_border_radius',
			[
				'label'     => __('Border Radius', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .tft_team_wrapper .tft-single-member' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .tft-single-member' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'team_card_title',
			[
				'label'     => __('Title', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		// design 1
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_title_typo',
				'selectors' => '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-title',

				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-1',
				]
			]
		);
		// design 2
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_title_typo_design_2',
				'selector' => '{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .tft-single-member .member-details p',
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
					'{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-title' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .tft-single-member .member-details p' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'team_card_subtitle',
			[
				'label'     => __('Sub Title', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		// design 1
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_subtitle_typo',
				'selector' => '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-subtitle',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-1',
				],
			]
		);

		// design 2
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon-team_card_subtitle_typo_desing_2',
				'selector' => '{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .tft-single-member .member-details h3',
				'label'    => __('Typography', 'travelfic-toolkit'),
				'condition' => [
					'tft_team_style' => 'design-2',
				]
			]
		);
		$this->add_control(
			'team_card_subtitle_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#1D2A3B',
				'selectors' => [
					'{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-subtitle' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .tft-single-member .member-details h3' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-content',
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
				'default'   => '#1D2A3B',
				'selectors' => [
					'{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-content' => 'color: {{VALUE}}',
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
				'label' => __('Social Icons', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_icon_color',
			[
				'label'     => __('Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .tft_team_wrapper .tft-single-member .social-media a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .tft-team-wrapper-v2 .social-media-icons button i' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .tft-team-wrapper-v2 .social-media-icons .social-media a' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'team_icon_color_bg',
			[
				'label'     => __('Color Background', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} .tft_team_wrapper .tft-single-member .social-media a' => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .tft-team-wrapper-v2 .social-media-icons button' => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .tft-team-wrapper-v2 .social-media-icons button' => 'background-color: {{VALUE}} !important',
				],
			]
		);
		$this->end_controls_section();

		// navigations
		$this->start_controls_section(
			'team_slider_nav',
			[
				'label' => __('Slider Navigation', 'travelfic-toolkit'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);

		$this->add_control(
			'team_slider_nav_button',
			[
				'label'     => __('Nav Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .slick-dots li button' => 'background-color: {{VALUE}} !important;',
				],
				'condition' => [
					'tft_team_style' => ['design-2'],
				],
			]
		);
		$this->add_control(
			'team_slider_nav_button_active',
			[
				'label'     => __('Nav Active Color', 'travelfic-toolkit'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .slick-dots li.slick-active button' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tft-team-wrapper-v2 .tft-team-members .slick-dots li.slick-active' => 'border-color: {{VALUE}} !important;',
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

		if (!empty($settings['tft_team_style'])) {
			$tft_design = $settings['tft_team_style'];
		}
		if (!empty($settings['team_title'])) {
			$tft_sec_title = $settings['team_title'];
		}
		$section_title_backdrop = $settings['team_sec_title_backdrop'] !== 'yes' ? ' tft-no-backdrop' : '';
		if (!empty($settings['team_subtitle'])) {
			$tft_sec_subtitle = $settings['team_subtitle'];
		}


		// Items per page
		$slideToShow = !empty($settings['team_design2_slider_slidetoshow']) ? $settings['team_design2_slider_slidetoshow'] : 3;
		$postCount = isset($settings['members_list']) ? count($settings['members_list']) : 0;

		// Disable slider class
		$tftSliderDisable = false;
		$tftDisableClass = '';
		if ($postCount <= $slideToShow) {
			$tftSliderDisable = true;
			$tftDisableClass = 'tft-slider-disable';
		}

		// slider control settings check
		$design2_slide_to_scroll = !empty($settings['team_design2_slider_slidetoscroll']) ? $settings['team_design2_slider_slidetoscroll'] : 1;

		$design2_slider_nav = $settings['team_design2_slider_navigation'];

		$design2_slider_arrows = ("arrows" === $design2_slider_nav) ? 'true' : 'false';
		$design2_slider_dots = ("dots" === $design2_slider_nav) ? 'true' : 'false';

		$slider_box_hidden = ("true" === $design2_slider_arrows) ? ' tft-box-hidden' : '';
		$container_max_width = ("true" === $design2_slider_arrows) ? ' tft-container-width' : '';

		$design2_slider_autoplay = ("yes" === $settings['team_design2_slider_autoplay']) ? 'true' : 'false';
		$design2_slider_autoplay_speed = !empty($settings['team_design2_slider_autoplay_speed']) ? $settings['team_design2_slider_autoplay_speed']['size'] : 0;
		$design2_slider_autoplay_interval = !empty($settings['team_design2_slider_autoplay_interval']) ? $settings['team_design2_slider_autoplay_interval']['size'] : 0;
		$design2_slider_loop = ('yes' === $settings['team_design2_slider_loop']) ? 'true' : 'false';
		$design2_slider_pause_on_hover = ('yes' === $settings['team_design2_slider_pause_on_hover']) ? 'true' : 'false';
		$design2_slider_pause_on_focus = ('yes' === $settings['team_design2_slider_pause_on_focus']) ? 'true' : 'false';
		$design2_slider_rtl = ('yes' === $settings['team_design2_slider_rtl']) ? 'true' : 'false';
		$design2_slider_draggable = ('yes' === $settings['team_design2_slider_draggable']) ? 'true' : 'false';
	
?>

		<?php if ('design-1' == $tft_design) : ?>
			<div class="tft_team_wrapper tft-customizer-typography">
				<div class="tft-team-members tft-flex tft-f-cg-40 tft-f-rw-40 tft-f-sb">
					<?php foreach ($settings['members_list'] as $item) : ?>
						<div class="tft-single-member tft-card-default">
							<div class="team-members-inner tft-flex align-center">
								<?php
								if (!empty($item['member_img']['url'])) { ?>
									<div class="member_img">
										<img src="<?php echo esc_url($item['member_img']['url']);  ?>" alt="">
									</div>
								<?php } ?>
								<div class="member-details">
									<h3 class="tft-title"> <?php echo esc_html($item['member_name']); ?> </h3>
									<p class="tft-subtitle"><?php echo esc_html($item['member_designation']); ?></p>
									<p class="tft-content"><?php echo esc_html($item['member_details']); ?></p>

									<div class="social-media">
										<?php if ($item['member_social_fb'] !== '') { ?>
											<a href="<?php echo esc_url($item['member_social_fb']); ?>">
												<i class="fab fa-facebook-f"></i>
											</a>
										<?php } ?>
										<?php if ($item['member_social_ld'] !== '') { ?>
											<a href="<?php echo esc_url($item['member_social_ld']); ?>">
												<i class="fab fa-linkedin-in"></i>
											</a>
										<?php } ?>
										<?php if ($item['member_social_tw'] !== '') { ?>
											<a href="<?php echo esc_url($item['member_social_tw']); ?>">
												<i class="fab fa-twitter"></i>
											</a>
										<?php } ?>
										<?php if ($item['member_social_insta'] !== '') { ?>
											<a href="<?php echo esc_url($item['member_social_insta']); ?>">
												<i class="fab fa-instagram"></i>
											</a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					
				</div>
			</div>
		<?php elseif ('design-2' == $tft_design):  ?>
			<div class="tft-team-wrapper-v2 tft-customizer-typography tft-section-space-top">
				<div class="container<?php echo esc_attr($tftDisableClass . $container_max_width); ?>">
					<div class="tft-heading-content">
						<?php if (!empty($tft_sec_subtitle)) { ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
						<?php }
						if (!empty($tft_sec_title)) { ?>
							<h2 class="tft-section-title<?php echo esc_attr($section_title_backdrop); ?>"><?php echo esc_html($tft_sec_title); ?></h2>
						<?php } ?>
					</div>
					<div class="tft-team-content">
						<div class="tft-team-members <?php echo esc_attr($slider_box_hidden); ?>">
							<?php foreach ($settings['members_list'] as $item) : ?>
								<div class="tft-single-member tft-card-default">
									<div class="team-members-inner">
										<?php
										if (!empty($item['member_img']['url'])) { ?>
											<div class="member_img">
												<img src="<?php echo esc_url($item['member_img']['url']);  ?>" alt="">
											</div>
										<?php } ?>
										<div class="member-details">
											<div class="social-media-icons">
												<button class="share-btn" id="shareButons">
													<i class="ri-share-line"></i>
												</button>
												<div class="social-media">
													<?php if ($item['member_social_fb'] !== '') { ?>
														<a href="<?php echo esc_url($item['member_social_fb']); ?>">
															<i class="fab fa-facebook-f"></i>
														</a>
													<?php } ?>
													<?php if ($item['member_social_ld'] !== '') { ?>
														<a href="<?php echo esc_url($item['member_social_ld']); ?>">
															<i class="fab fa-linkedin-in"></i>
														</a>
													<?php } ?>
													<?php if ($item['member_social_tw'] !== '') { ?>
														<a href="<?php echo esc_url($item['member_social_tw']); ?>">
															<i class="fab fa-twitter"></i>
														</a>
													<?php } ?>
													<?php if ($item['member_social_insta'] !== '') { ?>
														<a href="<?php echo esc_url($item['member_social_insta']); ?>">
															<i class="fab fa-instagram"></i>
														</a>
													<?php } ?>
												</div>
											</div>
											<h3 class="tft-subtitle"> <?php echo esc_html($item['member_designation']); ?> </h3>
											<p class="tft-title"><?php echo esc_html($item['member_name']); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach ?>
						</div>
						<!-- slider navigation -->
						<?php if ($tftSliderDisable == false && 'true' === $design2_slider_arrows): ?>
							<div class="tft-team-slider-nav">
								<button type="button" class="tft-prev-slide">
									<i class="ri-arrow-left-line"></i>
								</button>
								<button type="button" class="tft-next-slide">
									<i class="ri-arrow-right-line"></i>
								</button>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="tft_team_bottom_shape">
					<img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/app/img/team-banner-shape.png'); ?>" alt="Team background shape">
				</div>
			</div>
		<?php endif; ?>

		<script>
			jQuery(document).ready(function($) {
				<?php if ($tftSliderDisable == false) : ?>
					$(".tft-team-wrapper-v2 .tft-team-members").slick({
						slidesToShow: <?php echo esc_attr($slideToShow); ?>,
						slidesToScroll: <?php echo esc_attr($design2_slide_to_scroll); ?>,
						infinite: <?php echo esc_attr($design2_slider_loop); ?>,
						autoplay: <?php echo esc_attr($design2_slider_autoplay); ?>,
						autoplaySpeed: <?php echo esc_attr($design2_slider_autoplay_speed); ?>,
						speed: <?php echo esc_attr($design2_slider_autoplay_interval); ?>,
						dots: <?php echo esc_attr($design2_slider_dots); ?>,
						arrows: <?php echo esc_attr($design2_slider_arrows); ?>,
						pauseOnHover: <?php echo esc_attr($design2_slider_pause_on_hover); ?>,
						pauseOnFocus: <?php echo esc_attr($design2_slider_pause_on_focus); ?>,
						rtl: <?php echo esc_attr($design2_slider_rtl); ?>,
						draggable: <?php echo esc_attr($design2_slider_draggable); ?>,
						prevArrow: '.tft-team-wrapper-v2 .tft-prev-slide',
						nextArrow: '.tft-team-wrapper-v2 .tft-next-slide',
						responsive: [{
								breakpoint: 991,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2,
								}
							},
							{
								breakpoint: 640,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerMode: true,
									adaptiveHeight: false,
								}
							},
						]
					});

				<?php endif; ?>
			})
		</script>

<?php }
}
