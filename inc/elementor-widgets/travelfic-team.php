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
		return esc_html__('TFT Team Members', 'travelfic-toolkit');
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
	public function get_style_depends() {
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
				'default' => 'A There are many variatio of passage of Lorem for a Ipsum available '
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
				'label' => __( 'Social Media', 'travelfic-toolkit' ),
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

		$this->start_controls_section(
            'team_style_section',
            [
                'label' => __( 'Item List', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'team_card_head',
            [
                'label'     => __( 'Card Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_responsive_control(
            'team_card_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .member-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'team_card_border_radius',
            [
                'label'     => __( 'Border Radius', 'travelfic-toolkit' ),
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
                ],
            ]
        );
		$this->add_control(
            'team_card_title',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon-team_card_title_typo',
                'selector' => '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-title',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
            ]
        );
		$this->add_control(
            'team_card_title_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-title' => 'color: {{VALUE}} !important',
                ],
            ]
        );
		$this->add_control(
            'team_card_subtitle',
            [
                'label'     => __( 'Sub Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon-team_card_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-subtitle',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
            ]
        );
		$this->add_control(
            'team_card_subtitle_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'team_card_content',
            [
                'label'     => __( 'Content', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'team_card_content_typo',
                'selector' => '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-content',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
            ]
        );
		$this->add_control(
            'team_card_content_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft_team_wrapper .tft-single-member .member-details .tft-content' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
            'team_icon',
            [
                'label' => __( 'Social Icons', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'team_icon_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft_team_wrapper .tft-single-member .social-media a' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'team_icon_color_bg',
            [
                'label'     => __( 'Color Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft_team_wrapper .tft-single-member .social-media a' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>



		<?php if ($settings['members_list']) : ?>
			<div class="tft_team_wrapper tft-customizer-typography">
				<div class="tft-team-members tft-flex tft-f-cg-40 tft-f-rw-40 tft-f-sb">
					<?php foreach ($settings['members_list'] as $item) : ?>
						<div class="tft-single-member tft-card-default">
							<div class="team-members-inner tft-flex align-center">
								<?php 
								if(!empty($item['member_img']['url'])){ ?>
								<div class="member_img">
									<img src="<?php echo esc_url($item['member_img']['url']);  ?>" alt="">
								</div>
								<?php } ?>
								<div class="member-details">
									<h3 class="tft-title"> <?php echo esc_html($item['member_name']); ?> </h3>
									<p class="tft-subtitle"><?php echo esc_html($item['member_designation']); ?></p>
									<p class="tft-content"><?php echo esc_html($item['member_details']); ?></p>

									<div class="social-media">
										<?php if ( $item['member_social_fb'] !== '' ) {?>
											<a href="<?php echo esc_url( $item['member_social_fb'] ); ?>">
												<i class="fab fa-facebook-f"></i>
											</a>
										<?php }?>
										<?php if ( $item['member_social_ld'] !== '' ) {?>
											<a href="<?php echo esc_url( $item['member_social_ld'] ); ?>">
												<i class="fab fa-linkedin-in"></i>
											</a>
										<?php }?>
										<?php if ( $item['member_social_tw'] !== '' ) {?>
											<a href="<?php echo esc_url( $item['member_social_tw'] ); ?>">
											<i class="fab fa-twitter"></i>
											</a>
										<?php }?>
										<?php if ( $item['member_social_insta'] !== '' ) {?>
											<a href="<?php echo esc_url( $item['member_social_insta'] ); ?>">
											<i class="fab fa-instagram"></i>
											</a>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>

				</div>
			</div>
		<?php endif ?>

<?php }
}
