<?php
class Travelfic_Toolkit_Hotels extends \Elementor\Widget_Base
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
		return 'tft-hotels';
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
		return esc_html__('Travelfic Hotels, Tours & Apartment', 'travelfic-toolkit');
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
		return ['travelfic', 'popular', 'hotels', 'tours', 'apartment', 'tft'];
	}

	public function get_style_depends()
	{
		return ['travelfic-toolkit-hotels'];
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
			'tft_hotels',
			[
				'label' => __('Hotels, Tours & Apartment Section', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'tft_posts_section_bg',
			[
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Section Background', 'travelfic-toolkit' ),
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL.'assets/app/img/hotel-lists-bg.png',
                ],
			]
		);
        $this->add_control(
            'tft_posts_type',
            [
                'type'     => \Elementor\Controls_Manager::SELECT,
                'label'    => __( 'Type', 'travelfic-toolkit' ),
                'options'  => array(
                    'alls'   => __( '*', 'travelfic-toolkit' ),
                    'all' => __( 'All', 'travelfic-toolkit' ),
                    'featured'  => __( 'Featured', 'travelfic-toolkit' ),
                ),
                'default'  => 'alls',
            ]
        );
        $this->add_control(
			'tft_section_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
                'default' => __( 'The best hotels to explore', 'travelfic-toolkit' ),
			]
		);
        $this->add_control(
			'tft_section_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'Hotels', 'travelfic-toolkit' ),
			]
		);

		$this->add_control(
			'tf_post_type',
			[
				'label' => __('Post Type', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tf_hotel',
				'options' => [
					'tf_hotel' => __('Hotels', 'travelfic-toolkit'),
					'tf_tours' => __('Tours', 'travelfic-toolkit'),
					'tf_apartment' => __('Apartments', 'travelfic-toolkit')
				]
			]
		);

		// Order by.
		$this->add_control(
			'post_order_by',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __('Order by', 'travelfic-toolkit'),
				'default' => 'date',
				'options' => [
					'date' => __('Date', 'travelfic-toolkit'),
					'title' => __('Title', 'travelfic-toolkit'),
					'modified' => __('Modified date', 'travelfic-toolkit'),
				],
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
        // Card Title
		$this->add_control(
			'card_title_type',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __('Card Title', 'travelfic-toolkit'),
				'default' => 'Split',
				'options' => [
					'Split' => __('Split', 'travelfic-toolkit'),
					'Full' => __('Full Title', 'travelfic-toolkit')
				],
			]
		);

        $this->add_control(
			'view_all_link',
			[
				'type' => \Elementor\Controls_Manager::URL,
				'label' => esc_html__( 'View ALL URL', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter Link', 'travelfic-toolkit' ),
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Style Section
        $this->start_controls_section(
            'popular_tour_style_section',
            [
                'label' => __( 'Section Styles', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_title_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header h3',
                'label'    => __( 'Section Title Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ]
            ]
        );
		$this->add_control(
            'popular_section_title_color',
            [
                'label'     => __( 'Section Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header h6',
                'label'    => __( 'Section Subtitle Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_section_subtitle_color',
            [
                'label'     => __( 'Section Subtitle Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_button_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a',
                'label'    => __( 'Section Button Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_section_button_color',
            [
                'label'     => __( 'Section Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a span svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_button_bg',
            [
                'label'     => __( 'Section Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_button_hover_color',
            [
                'label'     => __( 'Section Button Hover Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a:hover span svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_button_hover_bg',
            [
                'label'     => __( 'Section Button Hover Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#917242',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .read-more a:hover' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_list_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header ul li',
                'label'    => __( 'List Item Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_section_list_item_bg',
            [
                'label'     => __( 'List Item Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header ul li' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_list_item_color',
            [
                'label'     => __( 'List Item Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_list_active_item_bg',
            [
                'label'     => __( 'Active List Item Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header ul li.active' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_list_active_item_color',
            [
                'label'     => __( 'Active List Item Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotel-header ul li.active' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_card_heading',
            [
                'label'     => __( 'Card Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'popular_hotel_card_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-popular-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details' => 'left: {{LEFT}}{{UNIT}};right: {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'popular_hotel_card_color',
            [
                'label'     => __( 'Card Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FCF4E8',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_review_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-ratings span',
                'label'    => __( 'Review Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
		$this->add_control(
            'popular_hotel_card_review_color',
            [
                'label'     => __( 'Review Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-ratings span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_title_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3',
                'label'    => __( 'Title Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_hotel_card_title_color',
            [
                'label'     => __( 'Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_location_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations span',
                'label'    => __( 'Location Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_hotel_card_location_color',
            [
                'label'     => __( 'Location Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_features_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li',
                'label'    => __( 'Features Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_hotel_card_features_color',
            [
                'label'     => __( 'Features Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_button_typo',
                'selector' => '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details',
                'label'    => __( 'Button Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_color',
            [
                'label'     => __( 'Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_bg',
            [
                'label'     => __( 'Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_hover_color',
            [
                'label'     => __( 'Button Hover Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_hover_bg',
            [
                'label'     => __( 'Button Hover Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#917242',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-hotels-wrapper .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details:hover' => 'background: {{VALUE}} !important',
                ],
            ]
        );

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type' => $settings['tf_post_type']
		);

        $featured_args = array(
			'post_type' => $settings['tf_post_type']
		);

		// Display posts in category.
		if ( !empty( $settings['post_category'] ) ) {
			$args['category_name'] = $settings['post_category'];
			$featured_args['category_name'] = $settings['post_category'];
		}

		// Items per page
		if ( !empty( $settings['post_items'] ) ) {
			$args['posts_per_page'] = $settings['post_items'];
			$featured_args['posts_per_page'] = -1;
		}

		// Items Order By
		if ( !empty( $settings['post_order_by'] ) ) {
			$args['orderby'] = $settings['post_order_by'];
			$featured_args['orderby'] = $settings['post_order_by'];
		}

		// Items Order
		if ( !empty( $settings['post_order'] ) ) {
    		$args['order'] = $settings['post_order'];
    		$featured_args['order'] = $settings['post_order'];
		}

		$query = new \WP_Query ( $args );
		$featured_query = new \WP_Query ( $featured_args );

        if ( !empty( $settings['tft_section_title'] ) ) {
            $tft_sec_title = $settings['tft_section_title'];
        }
        if ( !empty( $settings['tft_section_subtitle'] ) ) {
            $tft_sec_subtitle = $settings['tft_section_subtitle'];
        }
        if ( !empty( $settings['tft_posts_section_bg'] ) ) {
            $tft_posts_sec_bg = $settings['tft_posts_section_bg'];
        }

        $tft_posts_tabs = !empty( $settings['tft_posts_type'] ) ? $settings['tft_posts_type'] : 'alls';

		?>

		<div class="tft-popular-hotels-wrapper tft-customizer-typography" style="background-image: url(<?php echo !empty($tft_posts_sec_bg['url']) ? esc_url( $tft_posts_sec_bg['url'] ) : ''; ?>);">
            <div class="tft-popular-hotel-header">
                <div class="tft-hotel-header">
                    <?php 
                    if(!empty($tft_sec_subtitle)){ ?>
                        <h6><?php echo esc_html($tft_sec_subtitle); ?></h6>
                    <?php }
                    if(!empty($tft_sec_title)){
                    ?>
                        <h3><?php echo esc_html($tft_sec_title); ?></h3>
                    <?php } ?>

                    <ul>
                        <?php 
                        if("alls"==$tft_posts_tabs){ ?>
                        <li class="active" data-id="all">
                            <?php echo __("All", "travelfic-toolkit"); ?>
                        </li>
                        <li data-id="featured">
                            <?php echo __("Featured", "travelfic-toolkit"); ?>
                        </li>
                        <?php }elseif("all"==$tft_posts_tabs){ ?>
                        <li class="active" data-id="all">
                            <?php echo __("All", "travelfic-toolkit"); ?>
                        </li>
                        <?php }elseif("featured"==$tft_posts_tabs){ ?>
                        <li class="active" data-id="featured">
                            <?php echo __("Featured", "travelfic-toolkit"); ?>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="read-more">
                    <a href="<?php echo esc_url($settings['view_all_link']['url']); ?>">
                        <?php echo __("View All", "travelfic-toolkit"); ?>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
                            <path d="M56.7071 8.70711C57.0976 8.31658 57.0976 7.68342 56.7071 7.29289L50.3431 0.928932C49.9526 0.538408 49.3195 0.538408 48.9289 0.928932C48.5384 1.31946 48.5384 1.95262 48.9289 2.34315L54.5858 8L48.9289 13.6569C48.5384 14.0474 48.5384 14.6805 48.9289 15.0711C49.3195 15.4616 49.9526 15.4616 50.3431 15.0711L56.7071 8.70711ZM0 9H56V7H0V9Z" fill="#FDF9F4"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
			<div class="tft-popular-hotels-items tft-popular-hotels-selector tf-widget-all-post" style="<?php echo "alls"==$tft_posts_tabs || "all"==$tft_posts_tabs ? esc_attr("display: grid") : esc_attr("display: none") ?>">

				<?php if ($query->have_posts()): ?>
					<?php while ($query->have_posts()):
						$query->the_post(); ?>
						<?php
						// Review Query 
						$args = array(
							'post_id' => get_the_ID(),
							'status'  => 'approve',
							'type'    => 'comment',
						);
						$comments_query = new WP_Comment_Query( $args );
						$comments = $comments_query->comments;
                        if("tf_hotel"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
                            $disable_review_sec = !empty($option_meta['h-review']) ? $option_meta['h-review'] : '';
                        }
                        if("tf_tours"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
                            $disable_review_sec = !empty($option_meta['t-review']) ? $option_meta['t-review'] : '';

                            $tour_duration = ! empty( $option_meta['duration'] ) ? $option_meta['duration'] : '';
                            $duration_time = ! empty( $option_meta['duration_time'] ) ? $option_meta['duration_time'] : '';
                            $night         = ! empty( $option_meta['night'] ) ? $option_meta['night'] : false;
                            $night_count   = ! empty( $option_meta['night_count'] ) ? $option_meta['night_count'] : '';
                        }
                        if("tf_apartment"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_apartment_opt' );
                            $disable_review_sec = !empty($option_meta['disable-apartment-review']) ? $option_meta['disable-apartment-review'] : '';
                        }
						?>
						<div class="tft-popular-single-item">
							<div class="tft-popular-single-item-inner">
                                <?php 
                                $tft_hotel_image = !empty(get_the_post_thumbnail_url( get_the_ID() )) ? esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) : esc_url(site_url().'/wp-content/plugins/elementor/assets/images/placeholder.png');
                                ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="tft-popular-thumbnail" style="background-image: url(<?php echo $tft_hotel_image ?>);">
                                    
                                </a>
                                <div class="tft-hotel-details">
                                    <?php if ($comments && !$disable_review_sec == '1') { ?>
                                        <div class="tft-ratings">
                                            <span>
                                                <i class="fas fa-star"></i>
                                                <span>
                                                    <?php echo esc_html(tf_total_avg_rating($comments)); ?>
                                                </span>
                                                out of <?php tf_based_on_text(count($comments)); ?>
                                            </span>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="tft-ratings">
                                            <span>
                                                <i class="fas fa-star"></i>
                                                <span>
                                                    0.0
                                                </span>
                                                out of 0 review
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <h3 class="tft-title">
                                        <a href="<?php echo  esc_url(get_the_permalink())?>">
                                            <?php 
                                            if("Split"==$settings['card_title_type']){
                                                echo travelfic_character_limit(get_the_title(), 40);
                                            }else{
                                                the_title();
                                            } 
                                            ?>
                                        </a>
                                    </h3>
                                    <p class="tft-locations">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <g clip-path="url(#clip0_1443_3217)">
                                        <path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1443_3217">
                                        <rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                        <span>
                                            <?php 
                                            if("tf_hotel"==$settings['tf_post_type']){
                                                echo !empty( tf_data_types($option_meta['map'])['address'] ) ? esc_html( travelfic_character_limit( tf_data_types($option_meta['map'])['address'], 40 ) ) : '';
                                            }
                                            if("tf_tours"==$settings['tf_post_type']){
                                                echo !empty( tf_data_types($option_meta['location'])['address'] ) ? esc_html( travelfic_character_limit( tf_data_types($option_meta['location'])['address'], 40 ) ) : '';
                                            }
                                            if("tf_apartment"==$settings['tf_post_type']){
                                                echo !empty( tf_data_types($option_meta['map'])['address'] ) ? esc_html( travelfic_character_limit( tf_data_types($option_meta['map'])['address'], 40 ) ) : '';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                    
                                    <div class="tf-others-details" style="<?php echo "tf_tours"==$settings['tf_post_type'] ? esc_attr( 'margin-top: 0px' ) : ''; ?>">
                                        <?php 
                                        if("tf_tours"==$settings['tf_post_type']){
                                        if($tour_duration){
                                        ?>
                                        <p class="tour-time">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <path d="M10.0001 2.16406C14.6024 2.16406 18.3334 5.89502 18.3334 10.4974C18.3334 15.0997 14.6024 18.8307 10.0001 18.8307C5.39771 18.8307 1.66675 15.0997 1.66675 10.4974H3.33341C3.33341 14.1793 6.31818 17.1641 10.0001 17.1641C13.682 17.1641 16.6667 14.1793 16.6667 10.4974C16.6667 6.8155 13.682 3.83073 10.0001 3.83073C7.7086 3.83073 5.68714 4.98685 4.48717 6.7476L6.66675 6.7474V8.41406H1.66675V3.41406H3.33341L3.33332 5.49671C4.8537 3.47302 7.27402 2.16406 10.0001 2.16406ZM10.8334 6.33073L10.8332 10.1516L13.5356 12.8544L12.3571 14.0329L9.16658 10.8416L9.16675 6.33073H10.8334Z" fill="#595349"/>
                                        </svg>
                                        <?php echo esc_html( $tour_duration ); ?>
                                            <?php
                                            if ( $tour_duration > 1 ) {
                                                $dur_string         = 's';
                                                $duration_time_html = $duration_time . $dur_string;
                                            } else {
                                                $duration_time_html = $duration_time;
                                            }
                                            echo " " . esc_html( $duration_time_html );
                                            ?>
                                            <?php if ( $night ) { ?>
                                                <span>
                                                    <?php echo esc_html( $night_count ); ?>
                                                    <?php
                                                    if ( ! empty( $night_count ) ) {
                                                        if ( $night_count > 1 ) {
                                                            echo esc_html__( 'Nights', 'tourfic' );
                                                        } else {
                                                            echo esc_html__( 'Night', 'tourfic' );
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            <?php } ?>
                                        </p>
                                        <?php } } ?>
                                        <?php 
                                        if("tf_hotel"==$settings['tf_post_type']){
                                            $rooms = !empty($option_meta['room']) ? $option_meta['room'] : '';
                                            if(!empty($rooms)){
                                                $rm_features = [];
                                                foreach ( $rooms as $key => $room ) {
                                                    //merge for each room's selected features
                                                    if(!empty($room['features'])){
                                                        $rm_features = array_unique(array_merge( $rm_features, $room['features'])) ;
                                                    }
                                                }
                                                if(!empty($rm_features)){ ?>
                                                <ul>
                                                    <?php
                                                    $tft_limit = 1;
                                                    foreach ( $rm_features as $feature ) {
                                                        if($tft_limit<7){
                                                            $term = get_term_by( 'id', $feature, 'hotel_feature' );

                                                            $room_f_meta = get_term_meta( $feature, 'tf_hotel_feature', true );
                                                            if ( ! empty( $room_f_meta ) ) {
                                                                $room_icon_type = ! empty( $room_f_meta['icon-type'] ) ? $room_f_meta['icon-type'] : '';
                                                            }
                                                            if ( ! empty( $room_icon_type ) && $room_icon_type == 'fa' && !empty($room_f_meta['icon-fa']) ) {
                                                                $room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
                                                            } elseif ( ! empty( $room_icon_type ) && $room_icon_type == 'c' && ! empty( $room_f_meta['icon-c'] )) {
                                                                $room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
                                                            }
                                                            ?>
                                                            <li>
                                                                <?php echo ! empty( $room_feature_icon ) ? $room_feature_icon : ''; ?>
                                                                <?php echo !empty($term->name) ? $term->name : ''; ?>
                                                            </li>
                                                        <?php
                                                        }
                                                    $tft_limit++;
                                                    } ?>
                                                </ul>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php 
                                        if("tf_apartment"==$settings['tf_post_type']){
                                            $amenitiess = !empty($option_meta['amenities']) ? tf_data_types($option_meta['amenities']) : '';
                                            if(!empty($amenitiess)){
                                                $rm_features = [];
                                                foreach ( $amenitiess as $key => $apartment ) {
                                                    //merge for each room's selected features
                                                    if(!empty($apartment['feature'])){
                                                        $rm_features[] = $apartment['feature'] ;
                                                    }
                                                }
                                                if(!empty($rm_features)){ ?>
                                                <ul>
                                                    <?php
                                                    $tft_limit = 1;
                                                    foreach ( $rm_features as $feature ) {
                                                        if($tft_limit<7){
                                                            $term = get_term_by( 'id', $feature, 'apartment_feature' );

                                                            $apartment_f_meta = get_term_meta( $feature, 'tf_apartment_feature', true );
                                                            if ( ! empty( $apartment_f_meta ) ) {
                                                                $apartment_icon_type = ! empty( $apartment_f_meta['icon-type'] ) ? $apartment_f_meta['icon-type'] : '';
                                                            }
                                                            if ( ! empty( $apartment_icon_type ) && $apartment_icon_type == 'fa' && !empty($apartment_f_meta['icon-fa']) ) {
                                                                $apartment_feature_icon = '<i class="' . $apartment_f_meta['icon-fa'] . '"></i>';
                                                            } elseif ( ! empty( $apartment_icon_type ) && $apartment_icon_type == 'c' && ! empty( $apartment_f_meta['icon-c'] )) {
                                                                $apartment_feature_icon = '<img src="' . $apartment_f_meta['icon-c'] . '" style="min-width: ' . $apartment_f_meta['dimention'] . 'px; height: ' . $apartment_f_meta['dimention'] . 'px;" />';
                                                            }
                                                            ?>
                                                            <li>
                                                                <?php echo ! empty( $apartment_feature_icon ) ? $apartment_feature_icon : ''; ?>
                                                                <?php echo $term->name; ?>
                                                            </li>
                                                        <?php
                                                        }
                                                    $tft_limit++;
                                                    } ?>
                                                </ul>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>

                                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-view-details"><?php echo __("View details", "travelfic-toolkit"); ?></a>
                                    </div>
                                </div>
							</div>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>
			</div>

            <div class="tft-popular-hotels-items tft-popular-hotels-selector tf-widget-featured-post" style="<?php echo "featured"==$tft_posts_tabs ? esc_attr("display: grid") : esc_attr("display: none") ?>">

				<?php 
                $featured_posts = [];
                if ($featured_query->have_posts()): ?>
					<?php while ($featured_query->have_posts()):
						$featured_query->the_post(); 
                        if("tf_hotel"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
                            $tf_featured_post = !empty($option_meta['featured']) ? $option_meta['featured'] : '';
                        }
                        if("tf_tours"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
                            $tf_featured_post = !empty($option_meta['tour_as_featured']) ? $option_meta['tour_as_featured'] : '';
                        }
                        if("tf_apartment"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_apartment_opt' );
                            $disable_review_sec = !empty($option_meta['disable-apartment-review']) ? $option_meta['disable-apartment-review'] : '';
                        }
                        if($tf_featured_post){
                            $featured_posts[] = get_the_ID();
                        }
                    ?>
						
					<?php endwhile; ?>
				<?php endif; 
                $filter_args = array(
                    'post_type'      => $settings['tf_post_type'],
                    'post_status'    => 'publish',
                    'posts_per_page' => $settings['post_items'],
                    'post__in'       => $featured_posts,
                );
                $result_query = new WP_Query( $filter_args );
                ?>
                <?php if ($result_query->have_posts()): ?>
					<?php while ($result_query->have_posts()):
						$result_query->the_post(); ?>
						<?php
						// Review Query 
						$args = array(
							'post_id' => get_the_ID(),
							'status'  => 'approve',
							'type'    => 'comment',
						);
						$comments_query = new WP_Comment_Query( $args );
						$comments = $comments_query->comments;

						if("tf_hotel"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
                            $disable_review_sec = !empty($option_meta['h-review']) ? $option_meta['h-review'] : '';
                        }
                        if("tf_tours"==$settings['tf_post_type']){
                            $option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
                            $disable_review_sec = !empty($option_meta['t-review']) ? $option_meta['t-review'] : '';

                            $tour_duration = ! empty( $option_meta['duration'] ) ? $option_meta['duration'] : '';
                            $duration_time = ! empty( $option_meta['duration_time'] ) ? $option_meta['duration_time'] : '';
                            $night         = ! empty( $option_meta['night'] ) ? $option_meta['night'] : false;
                            $night_count   = ! empty( $option_meta['night_count'] ) ? $option_meta['night_count'] : '';
                        }
						?>
						<div class="tft-popular-single-item">
							<div class="tft-popular-single-item-inner">
                                <?php 
                                $tft_hotel_image = !empty(get_the_post_thumbnail_url( get_the_ID() )) ? esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) : esc_url(site_url().'/wp-content/plugins/elementor/assets/images/placeholder.png');
                                ?>
                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="tft-popular-thumbnail" style="background-image: url(<?php echo $tft_hotel_image ?>);">
                                </a>
                                <div class="tft-hotel-details">
                                    <?php if ($comments && !$disable_review_sec == '1') { ?>
                                        <div class="tft-ratings">
                                            <span>
                                                <i class="fas fa-star"></i>
                                                <span>
                                                    <?php echo esc_html(tf_total_avg_rating($comments)); ?>
                                                </span>
                                                out of <?php tf_based_on_text(count($comments)); ?>
                                            </span>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="tft-ratings">
                                            <span>
                                                <i class="fas fa-star"></i>
                                                <span>
                                                    0.0
                                                </span>
                                                out of 0 review
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <h3 class="tft-title">
                                        <?php 
                                        if("Split"==$settings['card_title_type']){
                                            echo get_the_permalink();
                                            echo travelfic_character_limit(get_the_title(), 15);
                                        }else{
                                            the_title();
                                            the_permalink();
                                        } 
                                        ?>
                                    </h3>
                                    <p class="tft-locations">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <g clip-path="url(#clip0_1443_3217)">
                                        <path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1443_3217">
                                        <rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                        <span>
                                            <?php 
                                            if("tf_hotel"==$settings['tf_post_type']){
                                                echo !empty( tf_data_types($option_meta['map'])['address'] ) ? esc_html( travelfic_character_limit( tf_data_types($option_meta['map'])['address'], 40 ) ) : '';
                                            }
                                            if("tf_tours"==$settings['tf_post_type']){
                                                echo !empty( tf_data_types($option_meta['location'])['address'] ) ? esc_html( travelfic_character_limit( tf_data_types($option_meta['location'])['address'], 40 ) ) : '';
                                            }
                                            if("tf_apartment"==$settings['tf_post_type']){
                                                echo !empty( tf_data_types($option_meta['map'])['address'] ) ? esc_html( travelfic_character_limit( tf_data_types($option_meta['map'])['address'], 40 ) ) : '';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                    
                                    <div class="tf-others-details" style="<?php echo "tf_tours"==$settings['tf_post_type'] ? esc_attr( 'margin-top: 0px' ) : ''; ?>">
                                        <?php 
                                        if("tf_tours"==$settings['tf_post_type']){
                                        if($tour_duration){
                                        ?>
                                        <p class="tour-time">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <path d="M10.0001 2.16406C14.6024 2.16406 18.3334 5.89502 18.3334 10.4974C18.3334 15.0997 14.6024 18.8307 10.0001 18.8307C5.39771 18.8307 1.66675 15.0997 1.66675 10.4974H3.33341C3.33341 14.1793 6.31818 17.1641 10.0001 17.1641C13.682 17.1641 16.6667 14.1793 16.6667 10.4974C16.6667 6.8155 13.682 3.83073 10.0001 3.83073C7.7086 3.83073 5.68714 4.98685 4.48717 6.7476L6.66675 6.7474V8.41406H1.66675V3.41406H3.33341L3.33332 5.49671C4.8537 3.47302 7.27402 2.16406 10.0001 2.16406ZM10.8334 6.33073L10.8332 10.1516L13.5356 12.8544L12.3571 14.0329L9.16658 10.8416L9.16675 6.33073H10.8334Z" fill="#595349"/>
                                        </svg>
                                        <?php echo esc_html( $tour_duration ); ?>
                                            <?php
                                            if ( $tour_duration > 1 ) {
                                                $dur_string         = 's';
                                                $duration_time_html = $duration_time . $dur_string;
                                            } else {
                                                $duration_time_html = $duration_time;
                                            }
                                            echo " " . esc_html( $duration_time_html );
                                            ?>
                                            <?php if ( $night ) { ?>
                                                <span>
                                                    <?php echo esc_html( $night_count ); ?>
                                                    <?php
                                                    if ( ! empty( $night_count ) ) {
                                                        if ( $night_count > 1 ) {
                                                            echo esc_html__( 'Nights', 'tourfic' );
                                                        } else {
                                                            echo esc_html__( 'Night', 'tourfic' );
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            <?php } ?>
                                        </p>
                                        <?php } } ?>
                                        <?php 
                                        if("tf_hotel"==$settings['tf_post_type']){
                                            $rooms = !empty($option_meta['room']) ? $option_meta['room'] : '';
                                            if(!empty($rooms)){
                                                $rm_features = [];
                                                foreach ( $rooms as $key => $room ) {
                                                    //merge for each room's selected features
                                                    if(!empty($room['features'])){
                                                        $rm_features = array_unique(array_merge( $rm_features, $room['features'])) ;
                                                    }
                                                }
                                                if(!empty($rm_features)){ ?>
                                                <ul>
                                                    <?php
                                                    $tft_limit = 1;
                                                    foreach ( $rm_features as $feature ) {
                                                        if($tft_limit<7){
                                                            $term = get_term_by( 'id', $feature, 'hotel_feature' );

                                                            $room_f_meta = get_term_meta( $feature, 'tf_hotel_feature', true );
                                                            if ( ! empty( $room_f_meta ) ) {
                                                                $room_icon_type = ! empty( $room_f_meta['icon-type'] ) ? $room_f_meta['icon-type'] : '';
                                                            }
                                                            if ( ! empty( $room_icon_type ) && $room_icon_type == 'fa' && !empty($room_f_meta['icon-fa']) ) {
                                                                $room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
                                                            } elseif ( ! empty( $room_icon_type ) && $room_icon_type == 'c' && ! empty( $room_f_meta['icon-c'] )) {
                                                                $room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
                                                            }
                                                            ?>
                                                            <li>
                                                                <?php echo ! empty( $room_feature_icon ) ? $room_feature_icon : ''; ?>
                                                                <?php echo $term->name; ?>
                                                            </li>
                                                        <?php
                                                        }
                                                    $tft_limit++;
                                                    } ?>
                                                </ul>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <a class="btn-view-details" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo __("View details", "travelfic-toolkit"); ?></a>
                                    </div>
                                </div>
								
							</div>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>
			</div>

			<script>
                (function($) {
                    $(document).ready(function () {
                        $(document).on('click', '.tft-hotel-header ul li', function () {
                            let $this = $(this).closest('.tft-popular-hotels-wrapper');
                            let tab_type = $(this).attr('data-id');
                            $this.find('.tft-hotel-header ul li').each(function() {
                                $(this).removeClass('active');
                            })
                            $(this).addClass('active');
                            $this.find('.tft-popular-hotels-items').hide();
                            $this.find('.tf-widget-'+tab_type+'-post').css('display', 'grid');
                        });
                    });
                }(jQuery));
            </script>

		</div>

		<?php
	}
}