<?php
class Travelfic_Toolkit_LatestNews extends \Elementor\Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve  widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tft-latest-news';
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
	public function get_title() {
		return esc_html__( 'Travelfic Latest News', 'travelfic-toolkit' );
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
	public function get_icon() {
		return 'eicon-posts-grid';
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
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'travelfic' ];
	}

	public function grid_get_all_post_type_categories($post_type){
		$options = array();

	   if ( $post_type == 'post' ) {
		   $taxonomy = 'category';
	   }

	   if ( ! empty( $taxonomy ) ) {
		   // Get categories for post type.
		   $terms = get_terms(
			   array(
				   'taxonomy'   => $taxonomy,
				   'hide_empty' => false,
			   )
		   );
		   if ( ! empty( $terms ) ) {
			   foreach ( $terms as $term ) {
				   if ( isset( $term ) ) {
					   if ( isset( $term->slug ) && isset( $term->name ) ) {
						   $options[ $term->slug ] = $term->name;
					   }
				   }
			   }
			}
		}

	   return $options;
	   
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
	public function get_keywords() {
		return [ 'travelfic', 'blog', 'latest', 'tft' ];
	}
	public function get_style_depends()
	{
		return ['travelfic-toolkit-latest-news'];
	}
	/**
	 * Register widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'blog_news',
			[
				'label' => __( 'Blog News', 'travelfic-toolkit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        // Design
        $this->add_control(
            'blog_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Design', 'travelfic-toolkit' ),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __( 'Design 1', 'travelfic-toolkit' ),
                    'design-2'  => __( 'Design 2', 'travelfic-toolkit' ),
                ],
            ]
        );
        $this->add_control(
			'tft_section_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
                'default' => __( 'We share our experiences, tips and travel stories to inspire', 'travelfic-toolkit' ),
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
			]
		);
        $this->add_control(
			'tft_section_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'BLOG & NEWS', 'travelfic-toolkit' ),
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
			]
		);
		// Category name
		$this->add_control(
            'post_category',
            [
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'label'     => __( 'Category', 'travelfic-toolkit' ),
                'options'   => $this->grid_get_all_post_type_categories( 'post' ),
				'multiple' => true,
            ]
        );
		// posts items per page
		$this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __( 'Items', 'travelfic-toolkit' ),
                'placeholder' => __( 'How many items?', 'travelfic-toolkit' ),
                'default'     => 4,
            ]
        );

		// Order by.
        $this->add_control(
            'post_order_by',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Order by', 'travelfic-toolkit' ),
                'default' => 'date',
                'options' => [
                    'date'          => __( 'Date', 'travelfic-toolkit' ),
                    'title'         => __( 'Title', 'travelfic-toolkit' ),
                    'modified'      => __( 'Modified date', 'travelfic-toolkit' ),
                    'comment_count' => __( 'Comment count', 'travelfic-toolkit' ),
                    'rand'          => __( 'Random', 'travelfic-toolkit' ),
                ],
            ]
        );
        // Order
        $this->add_control(
            'post_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Order', 'travelfic-toolkit' ),
                'default' => 'DESC',
                'options' => [
                    'DESC'        => __( 'Descending', 'travelfic-toolkit' ),
                    'ASC'         => __( 'Ascending', 'travelfic-toolkit' ),
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
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
			]
		);
		$this->end_controls_section();


        // Style Section
        $this->start_controls_section(
            'blog_design_2_section_style',
            [
                'label' => __( 'Section Styles', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_title_typo',
                'selector' => '{{WRAPPER}} .tft-design-2-blog .tft-blog-header h3',
                'label'    => __( 'Section Title Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ],
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
		$this->add_control(
            'blog_section_title_color',
            [
                'label'     => __( 'Section Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-design-2-blog .tft-blog-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-design-2-blog .tft-blog-header h6',
                'label'    => __( 'Section Subtitle Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'blog_section_subtitle_color',
            [
                'label'     => __( 'Section Subtitle Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-design-2-blog .tft-blog-header h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_button_typo',
                'selector' => '{{WRAPPER}} .tft-design-2-blog .read-more a',
                'label'    => __( 'Section Button Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'blog_section_button_color',
            [
                'label'     => __( 'Section Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-design-2-blog .read-more a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-design-2-blog .read-more a span svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'news_style_section',
            [
                'label' => __( 'News List', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'news_item_card_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

		$this->add_control(
            'news_card_radius',
            [
                'label'   => __( 'Border Radius', 'travelfic-toolkit' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ],
        );

		$this->add_control(
            'news_card_gradient',
            [
                'label'     => __( 'Card Gradient', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->start_controls_tabs( 'news_hover_style' );

        // Normal state tab
        $this->start_controls_tab(
            'search_button_normal',
            [
                'label' => __( 'Normal', 'travelfic-toolkit' ),
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'news_item_card_gradient_1',
            [
                'label'     => __( 'Background Gradient 1', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

		$this->add_control(
            'news_item_card_gradient_2',
            [
                'label'     => __( 'Background Gradient 2', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1d2a3b00',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'search_button_hover',
            [
                'label' => __( 'Hover', 'travelfic-toolkit' ),
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'news_item_card_gradient_1_hover',
            [
                'label'     => __( 'Background Gradient 1', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

		$this->add_control(
            'news_item_card_gradient_2_hover',
            [
                'label'     => __( 'Background Gradient 2', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#eb390300',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_control(
            'news_title_head',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_title_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap .tft-title',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->add_control(
            'news_title_typo_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap .tft-title' => 'color: {{VALUE}}',
                    'condition' => [
                        'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                    ],
                ],
            ]
        );
		$this->add_control(
            'news_meta_head',
            [
                'label'     => __( 'Meta', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_meta_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap .tft-meta-wrap .tft-meta',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->add_control(
            'news_meta_typo_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap .tft-meta-wrap .tft-meta' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

		$this->add_control(
            'news_hover_head',
            [
                'label'     => __( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->add_control(
            'news_title_typo_color_hover',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-latest-posts .tft-post-thumbnail a:hover  .tft-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
		$this->add_control(
            'news_meta_typo_color_hover',
            [
                'label'     => __( 'Meta', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-latest-posts .tft-post-thumbnail a:hover .tft-meta' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-1', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );

        // Design 2 News Field

        $this->add_control(
            'news_design2_title_head',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design2_title_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-design-2-blog .tft-blog-gird-section .tft-post-single-item a h3',
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ]
            ]
        );
		$this->add_control(
            'news_design2_title_typo_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-design-2-blog .tft-blog-gird-section .tft-post-single-item a h3' => 'color: {{VALUE}}',
                    'condition' => [
                        'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                    ],
                ],
            ]
        );

        $this->add_control(
            'news_design2_date_head',
            [
                'label'     => __( 'Date', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design2_time_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-design-2-blog .tft-blog-gird-section .tft-post-single-item a p.tft-meta',
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
		$this->add_control(
            'news_design2_time_typo_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-design-2-blog .tft-blog-gird-section .tft-post-single-item a p.tft-meta' => 'color: {{VALUE}}',
                    'condition' => [
                        'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                    ],
                ],
            ]
        );

        $this->add_control(
            'news_design2_content_head',
            [
                'label'     => __( 'Content', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design2_content_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-design-2-blog .tft-blog-gird-section .tft-post-single-item p.content',
                'condition' => [
                    'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
		$this->add_control(
            'news_design2_content_typo_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-design-2-blog .tft-blog-gird-section .tft-post-single-item p.content' => 'color: {{VALUE}}',
                    'condition' => [
                        'blog_style' => 'design-2', // Show this control only when blog_style is 'design-2'
                    ],
                ],
            ]
        );
		
	}

	protected function render() {
	$settings = $this->get_settings_for_display(); 

		$args = array(
			'post_type'   => 'post'
		);

        // Design
        if ( ! empty( $settings['blog_style'] ) ) {
            $design = $settings['blog_style'];
        }

		// Display posts in category.
        if ( ! empty( $settings['post_category'] ) ) {
            $args['category_name'] = implode( ',', $settings['post_category'] ) ;
        }

		// Items per page
        if ( ! empty( $settings['post_items'] ) ) {
            $args['posts_per_page'] = $settings['post_items'];
        }

		// Items Order By
        if ( ! empty( $settings['post_order_by'] ) ) {
            $args['orderby'] = $settings['post_order_by'];
        }

        // Items Order
        if ( ! empty( $settings['post_order'] ) ) {
            $args['order'] = $settings['post_order'];
        }

		$query = new \WP_Query ( $args );
		$items_count = $settings['post_items'];

        if ( !empty( $settings['tft_section_title'] ) ) {
            $tft_sec_title = $settings['tft_section_title'];
        }
        if ( !empty( $settings['tft_section_subtitle'] ) ) {
            $tft_sec_subtitle = $settings['tft_section_subtitle'];
        }
		if("design-2"==$design){
	    ?>
        <div class="tft-design-2-blog tft-w-padding">
            <div class="tft-blog-header">
                <div class="tft-news-header">
                    <?php 
                    if(!empty($tft_sec_subtitle)){ ?>
                        <h6><?php echo esc_html($tft_sec_subtitle); ?></h6>
                    <?php }
                    if(!empty($tft_sec_title)){
                    ?>
                        <h3><?php echo esc_html($tft_sec_title); ?></h3>
                    <?php } ?>
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

            <div class="tft-blog-gird-section blog-grid-item-<?php echo $items_count; ?>">
                <?php if( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					
						<div class="tft-col-item tft-post-single-item">
                            <a id="post-<?php the_ID(); ?>" href="<?php echo esc_url( get_permalink() ); ?>">
                                
                                <div class="tft-blog-thumbnail">
                                    <?php 
                                    if( get_the_post_thumbnail_url( get_the_ID() ) ){
                                        the_post_thumbnail( 'blog-thumb' );
                                    }else{ ?>
                                        <img src="<?php echo esc_url(site_url().'/wp-content/plugins/elementor/assets/images/placeholder.png'); ?>" alt="Post">
                                    <?php } ?>
                                </div>
                                <div class="tft-content-details">
                                    <p class="tft-meta"><i class="fas fa-clock"></i> <?php the_date(); ?></p>
                                    <h3 class="tft-title">
                                        <?php 
                                        echo travelfic_character_limit(get_the_title(), 15);
                                        ?>
                                    </h3>
                                    <?php 
                                    $travelfic_blog_content = wp_trim_words(get_the_content(), 5, '<span> ...Read more</span>');
                                    echo '<p class="content">' . wp_kses_post( $travelfic_blog_content ) . '</p>';
                                    ?>
                                </div>
                            </a>
						</div>
					
					<?php endwhile; ?>
				<?php endif; ?>
            </div>
        </div>
        <?php 
        }else{ ?>
		<style>
			.tft-latest-posts .tft-post-thumbnail a::before {
				background: linear-gradient(360deg, <?php echo esc_attr( $settings['news_item_card_gradient_1'] ); ?> -9.6%, <?php echo esc_attr( $settings['news_item_card_gradient_2'] ); ?> 109.78%);
			}
			.tft-latest-posts .tft-post-thumbnail a:hover::before  {
				background: linear-gradient(360deg, <?php echo esc_attr( $settings['news_item_card_gradient_1_hover'] ); ?> -9.6%, <?php echo esc_attr( $settings['news_item_card_gradient_2_hover'] ); ?> 109.78%);
			}
			.tft-latest-posts .tft-post-thumbnail img{
				border-radius: <?php echo esc_attr( $settings['news_card_radius'] ); ?>px;
			}
		</style>

		<div class="tft-latest-posts-wrapper tft-customizer-typography">
            <div class="tft-latest-posts">
                <div id="items-count-<?php echo esc_html($items_count); ?>" class="tft-latest-post-items">
					
				<?php if( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					
						<div class="tft-col-item tft-post-single-item">
							<div class="tft-post-thumbnail tft-thumbnail">
								<div class="tft-thumbnail-url">
									<a id="post-<?php the_ID(); ?>" <?php post_class('single-blog'); ?> href="<?php echo esc_url( get_permalink() ); ?>">
									<?php the_post_thumbnail( 'blog-thumb' ); ?>
										<div class="tft-post-content-wrap">
												<div class="tft-meta-wrap">
													<p class="tft-meta"><i class="fas fa-clock"></i> <?php the_date(); ?></p>
												</div>
											<div class="tft-post-title">
												<h3 class="tft-title"><?php the_title(); ?></h3>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					
					<?php endwhile; ?>
				<?php endif; ?>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php
	}
}