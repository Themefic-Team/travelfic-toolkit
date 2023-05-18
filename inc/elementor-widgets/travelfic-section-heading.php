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
		return 'tft-section-header';
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
		return esc_html__( 'TFT Heading', 'travelfic-toolkit' );
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
		return [ 'travelfic', 'title', 'heading', 'tft' ];
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
				'label' => esc_html__( 'TFT Heading', 'travelfic-toolkit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tf_heading',
			[
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Subscribe to ', 'travelfic-toolkit' )
			]
		);

		$this->add_control(
			'tf_heading_details',
			[
				'label' => esc_html__( 'Content', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'travelfic-toolkit' )
			]
		);

		$this->add_control(
			'title_suffix',
			[
				'label' => esc_html__( 'Show Suffix', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travelfic-toolkit' ),
				'label_off' => esc_html__( 'Hide', 'travelfic-toolkit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'suffix_title',
			[
				'label' => esc_html__( 'Title Suffix', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Our Newsletter',
				'label_block' => true,
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'travelfic-toolkit' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'travelfic-toolkit' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'travelfic-toolkit' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selector' => '{{WRAPPER}} .tft-section-head',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
            'tft_heading_style_section',
            [
                'label' => esc_html__( 'Heading Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'tft_section_head',
            [
                'label'     => esc_html__( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_section_title_typo',
                'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-section-head .section-title',
            ]
        );
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-section-head .section-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
            'tft_section_content',
            [
                'label'     => esc_html__( 'Content', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_section_content_typo',
                'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-section-head .subtitle',
            ]
        );
		$this->add_control(
			'section_content_color',
			[
				'label' => esc_html__( 'Color', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tft-section-head .subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
            'spacing_margin',
            [
                'label'      => esc_html__( 'Margin', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-section-head .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'tft_section_suffix_head',
            [
                'label'     => esc_html__( 'Suffix', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'suffix_typo',
                'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-section-head .section-title-suffix',
            ]
        );
		$this->add_control(
			'suffix_title_color',
			[
				'label' => esc_html__( 'Title Suffix Color', 'travelfic-toolkit' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} .tft-section-head .section-title-suffix' => 'color: {{VALUE}}',
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
				
				<span class="section-title-suffix">
				<?php if($settings['title_suffix'] ){
					echo esc_html( $settings['suffix_title'] );
				 }?></span>
			</h2>
            <p class="subtitle"><?php echo esc_html( $settings['tf_heading_details'] ); ?><p>
        </div>
    <?php
	}
}