<?php
class SectionHeading extends \Elementor\Widget_Base {

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
		return 'tf-section-header';
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
		return esc_html__( 'Tft Heading', 'travelfic' );
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
		return 'eicon-heading';
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
		return [ 'travelfic', 'title', 'header', 'tft' ];
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
			'section_heading',
			[
				'label' => esc_html__( 'Slider Items', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tf_heading',
			[
				'label' => esc_html__( 'Title', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html( 'Type your title here', 'travelfic' )
			]
		);

		$this->add_control(
			'tf_heading_details',
			[
				'label' => esc_html__( 'Details', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html( 'Type your description here', 'travelfic' )
			]
		);

		$this->add_control(
			'title_suffix',
			[
				'label' => esc_html__( 'Show Suffix', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travelfic' ),
				'label_off' => esc_html__( 'Hide', 'travelfic' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'suffix_title',
			[
				'label' => esc_html__( 'Title Suffix', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'suffix_title_color',
			[
				'label' => esc_html__( 'Title Suffix Color', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-section-head span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'travelfic' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'travelfic' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'travelfic' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'travelfic' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-section-head h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'details_color',
			[
				'label' => esc_html__( 'Details Color', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-section-head p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
	$settings = $this->get_settings_for_display(); ?>
		<div class="tft-section-head" style="text-align: <?php echo esc_attr( $settings['text_align'] ); ?>;">
            <h2 class="title section-title"> 
				<?php echo esc_html( $settings['tf_heading'] ); ?> 
				
				<span class="section-title-suffix" style="color: <?php echo esc_attr( $settings['suffix_title_color'] ); ?>;">
				<?php if($settings['title_suffix'] ){
					echo esc_html( $settings['suffix_title'] );
				 }?></span>
			</h2>
            <p class="subtitle" style="color: <?php echo esc_attr( $settings['details_color'] ); ?>;"><?php echo esc_html( $settings['tf_heading_details'] ); ?><p>
        </div>
    <?php
	}
}