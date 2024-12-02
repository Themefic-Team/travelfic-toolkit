<?php
class Travelfic_Toolkit_Cars extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve  widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'tft-popular-cars';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve  widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Travelfic Cars', 'travelfic-toolkit');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve  widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-handle';
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
	 * Retrieve the list of categories the widget belongs to.
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
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['travelfic', 'tourfic', 'cars', 'tft'];
	}

	public function get_style_depends()
	{
		return ['travelfic-toolkit-popular-cars'];
	}
	/**
	 * Register widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'popular_cars',
			[
				'label' => __('Popular Cars', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'car_style',
			[
				'label' => __('Car Style', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => __('Grid', 'travelfic-toolkit'),
					'list' => __('List', 'travelfic-toolkit')
				]
			]
		);


		$this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __( 'Item Per page', 'travelfic-toolkit' ),
                'placeholder' => __( '6', 'travelfic-toolkit' ),
                'default'     => 6,
            ]
        );

		// Title
		$this->add_control(
			'sec_title',
            [
                'label'       => __( 'Title', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
		);

        // Sub Title
		$this->add_control(
			'sub_title',
            [
                'label'       => __( 'Sub Title', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
		);

		$this->end_controls_section();

		// Style Section
        $this->start_controls_section(
            'popular_tour_style_section',
            [
                'label' => __( 'Section Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'popular_title_head',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_item_title',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tf-car-archive-result .tf-heading h2',
            ]
        );
		$this->add_control(
            'popular_tour_item_title_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#27333f',
                'selectors' => [
                    '{{WRAPPER}} .tf-car-archive-result .tf-heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popular_subtitle_head',
            [
                'label'     => __( 'Sub Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_item_sub_title',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tf-car-archive-result .tf-heading p',
            ]
        );
		$this->add_control(
            'popular_tour_item_sub_title_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#566676',
                'selectors' => [
                    '{{WRAPPER}} .tf-car-archive-result .tf-heading p' => 'color: {{VALUE}}',
                ],
            ]
        );
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

        $style = !empty($settings['car_style']) ? $settings['car_style'] : '';
        $per_pages = !empty($settings['post_items']) ? $settings['post_items'] : '';
        $sec_title = !empty($settings['sec_title']) ? $settings['sec_title'] : '';
        $sub_title = !empty($settings['sub_title']) ? $settings['sub_title'] : '';

		echo do_shortcode( '[tf_cars style="' . $style . '" count="' . $per_pages . '" title="' . $sec_title . '" subtitle="' . $sub_title . '" ]' );
		
	}
}