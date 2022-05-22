<?php
class TeamMembers extends \Elementor\Widget_Base
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
		return 'tf-team-members';
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
		return esc_html__('TFT Team Members', 'travelfic');
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
				'label' => __('Team Members', 'travelfic'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'member_img',
			[
				'label' => __('Member Image', 'travelfic'),
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
				'label' => esc_html__('Member Name', 'travelfic'),
				'default' => 'John Doe'
			]
		);
		$repeater->add_control(
			'member_designation',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__('Member Designation', 'travelfic'),
				'default' => 'CEO'
			]
		);
		$repeater->add_control(
			'member_details',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__('Member Details', 'travelfic'),
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
				'label' => esc_html__( 'Social Media', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$repeater->add_control(
			'member_social_fb',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__('Facebook', 'travelfic'),
				'default' => '#'
			]
		);
		$repeater->add_control(
			'member_social_ld',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__('Linkedin', 'travelfic'),
				'default' => '#'
			]
		);
		$repeater->add_control(
			'member_social_tw',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__('Twitter', 'travelfic'),
				'default' => '#'
			]
		);
		$repeater->add_control(
			'member_social_insta',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__('Twitter', 'travelfic'),
				'default' => '#'
			]
		);
		$this->add_control(
			'members_list',
			[
				'label' => __('Members List', 'travelfic'),
				'show_label' => false,
				'prevent_empty' => false,
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ member_name }}}',
			]
		);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display(); ?>



		<?php if ($settings['members_list']) : ?>
			<div class="tft_team_wrapper">
				<div class="tft-team-members tf-flex tft-f-cg-40 tft-f-rw-40 tft-f-sb">
					<?php foreach ($settings['members_list'] as $item) : ?>
						<div class="tft-single-member tft-card-default">
							<div class="team-members-inner tf-flex align-center">
								<div class="member_img">
									<img src="<?php echo esc_url($item['member_img']['url']);  ?>" alt="">
								</div>
								<div class="member-details">
									<h3> <?php echo esc_html($item['member_name']); ?> </h3>
									<p><?php echo esc_html($item['member_designation']); ?></p>
									<p><?php echo esc_html($item['member_details']); ?></p>

									<div class="social-media">
									<?php if( $item['member_social_fb'] !== '') {?>										<a href="<?php echo esc_url($item['member_social_fb']); ?>"> <i class="fab fa-facebook-f"></i> </a>
									<?php }?>
									<?php if( $item['member_social_ld'] !== '') {?>										<a href="<?php echo esc_url($item['member_social_ld']); ?>"> <i class="fab fa-linkedin-in"></i> </a>
									<?php }?>
									<?php if( $item['member_social_tw'] !== '') {?>										<a href="<?php echo esc_url($item['member_social_tw']); ?>"> <i class="fab fa-twitter"></i> </a>
									<?php }?>
									<?php if( $item['member_social_insta'] !== '') {?>										<a href="<?php echo esc_url($item['member_social_insta']); ?>"> <i class="fab fa-instagram"></i> </a>
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
