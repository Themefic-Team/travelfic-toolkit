<?php
class Travelfic_Toolkit_PopularTours extends \Elementor\Widget_Base
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
		return 'tft-popular-tours';
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
		return esc_html__('Travelfic Popular Tours', 'travelfic-toolkit');
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
		return 'eicon-posts-ticker';
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
		return ['travelfic', 'popular', 'tours', 'tft'];
	}

	public function get_style_depends()
	{
		return ['travelfic-toolkit-popular-tours'];
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
			'popular_tours',
			[
				'label' => __('Popular Tours', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tf_post_type',
			[
				'label' => __('Post Type', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tf_tours',
				'options' => [
					'tf_tours' => __('Tours', 'travelfic-toolkit')
				]
			]
		);

		// Order by.
		$this->add_control(
			'post_order_by',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __('Order by', 'travelfic-toolkit'),
				'default' => 'comment_count',
				'options' => [
					'date' => __('Date', 'travelfic-toolkit'),
					'title' => __('Title', 'travelfic-toolkit'),
					'modified' => __('Modified date', 'travelfic-toolkit'),
					'comment_count' => __('Comment count', 'travelfic-toolkit'),
					'rand' => __('Random', 'travelfic-toolkit'),
				],
			]
		);

		$this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __( 'Item Per page', 'travelfic-toolkit' ),
                'placeholder' => __( '4', 'travelfic-toolkit' ),
                'default'     => 4,
            ]
        );
		// Order
		$this->add_control(
			'post_order',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __('Order', 'travelfic-toolkit'),
				'default' => 'DESC',
				'options' => [
					'DESC' => __('Descending', 'travelfic-toolkit'),
					'ASC' => __('Ascending', 'travelfic-toolkit')
				],
			]
		);
		$this->end_controls_section();

		// Style Section
        $this->start_controls_section(
            'popular_tour_style_section',
            [
                'label' => __( 'Item List', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'popular_tour_item_card_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-title',
            ]
        );
		$this->add_control(
            'popular_tour_item_title_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-title' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_meta_heading',
            [
                'label'     => __( 'Meta', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_item_meta',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-content',
            ]
        );
		$this->add_control(
            'popular_tour_item_meta_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-content' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_tour_price',
            [
                'label'     => __( 'Price', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_price_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-pricing',
            ]
        );
		$this->add_control(
            'popular_tour_price_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-pricing' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_icon_head',
            [
                'label'     => __( 'Icon', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_control(
            'popular_tour_item_icon_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-popular-sub-info p i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-tour-items  .slick-arrow i' => 'color: {{VALUE}}',
                ],
            ]
        );

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		\Travelfic_Toolkit\Components\PopularTours::render( $settings, 'elementor' );
	}
}