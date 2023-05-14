<?php
class IconWithText extends \Elementor\Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tf-icon-with-text';
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
	public function get_title() {
		return esc_html__( 'TFT Icon With Text', 'travelfic-toolkit' );
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
	public function get_icon() {
		return 'eicon-info-box';
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
	public function get_custom_help_url() {
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
	public function get_categories() {
		return [ 'travelfic' ];
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
	public function get_keywords() {
		return [ 'travelfic', 'icon', 'icon with text', 'tft' ];
	}

	public function get_style_depends()
	{
		return ['travelfic-icon-text'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'icon_with_text',
			[
				'label' => esc_html__( 'Items', 'travelfic-toolkit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'box_icon', [
                'label' => esc_html__( 'Icon', 'travelfic-toolkit' ),
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
            'box_title', [
                'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Your Heading Text Here', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'box_details', [
                'label' => esc_html__( 'Descriptions', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'travelfic' ),
                'label_block' => true,
            ]
        );
		$repeater->add_control(
			'active_gap',
			[
				'label' => esc_html__( 'Active Gap Item', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'travelfic-toolkit' ),
				'label_off' => esc_html__( 'No', 'travelfic-toolkit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'icon_text_list',
			[
				'label' => esc_html__( 'Repeater List', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ box_title }}}',
			]
		);

		$this->add_control(
			'items_gap',
			[
				'label' => esc_html__( 'Middle item gap', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 70,
			]
		);

		$this->end_controls_section();


		// Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Item Content Typo', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon-text_title',
				'selector' => '{{WRAPPER}} .tft-icon-text-wrapper .tft-title',
				'label' => esc_html__('Title Style', 'travelfic-toolkit')
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __('Title Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .tft-icon-text-wrapper .tft-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon-text_details',
				'selector' => '{{WRAPPER}} .tft-icon-text-wrapper .tft-details',
				'label' => esc_html__('Title Style', 'travelfic-toolkit')
			]
		);

	}

	protected function render() {
	$settings = $this->get_settings_for_display(); ?>

    <?php if( $settings['icon_text_list'] ) : ?>
        <div class="tft-icon-text-wrapper tft-customizer-typography">
            <div class="tft-icon-text-items tf-flex">
            <?php foreach( $settings['icon_text_list'] as $item ) : ?>
				
                <div class="tft-icon-text-single" 
				
				<?php if($item['active_gap'] == 'yes'):?>
					style="margin-top:<?php echo $settings['items_gap'] ?>px;"
					<?php else : ?>
					style="margin-bottom:<?php echo $settings['items_gap'] ?>px;"
				<?php endif?>

				>
                    <div class="tft-icon-text-single-inner tft-center">
                        <div class="icon_outter">
                            <img src="<?php echo $item['box_icon']['url'] ?> " alt="">
                        </div>
                        <h3 class="tft-title"> <?php echo $item['box_title']; ?></h3>
                        <p class="tft-details"> <?php echo $item['box_details']; ?></p>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

    <?php
	}
}