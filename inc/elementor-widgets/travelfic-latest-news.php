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
		return esc_html__( 'TFT Latest News', 'travelfic-toolkit' );
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
		$this->end_controls_section();

		// Style
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
            ]
        );

		$this->add_control(
            'news_card_radius',
            [
                'label'   => __( 'Border Radius', 'travelfic-toolkit' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
            ],
        );

		$this->add_control(
            'news_card_gradient',
            [
                'label'     => __( 'Card Gradient', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->start_controls_tabs( 'news_hover_style' );

        // Normal state tab
        $this->start_controls_tab(
            'search_button_normal',
            [
                'label' => __( 'Normal', 'travelfic-toolkit' ),
            ]
        );

        $this->add_control(
            'news_item_card_gradient_1',
            [
                'label'     => __( 'Background Gradient 1', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B'
            ]
        );

		$this->add_control(
            'news_item_card_gradient_2',
            [
                'label'     => __( 'Background Gradient 2', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1d2a3b00'
            ]
        );
        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'search_button_hover',
            [
                'label' => __( 'Hover', 'travelfic-toolkit' ),
            ]
        );

        $this->add_control(
            'news_item_card_gradient_1_hover',
            [
                'label'     => __( 'Background Gradient 1', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30'
            ]
        );

		$this->add_control(
            'news_item_card_gradient_2_hover',
            [
                'label'     => __( 'Background Gradient 2', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#eb390300'
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
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_title_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap .tft-title',
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
                ],
            ]
        );
		$this->add_control(
            'news_meta_head',
            [
                'label'     => __( 'Meta', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_meta_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-latest-posts .tft-post-content-wrap .tft-meta-wrap .tft-meta',
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
            ]
        );

		$this->add_control(
            'news_hover_head',
            [
                'label'     => __( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_control(
            'news_title_typo_color_hover',
            [
                'label'     => __( 'Titile', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-latest-posts .tft-post-thumbnail a:hover  .tft-title' => 'color: {{VALUE}}',
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
            ]
        );
		
	}

	protected function render() {
	$settings = $this->get_settings_for_display(); 

		$args = array(
			'post_type'   => 'post'
		);

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
		
	?>

		<style>
			.tft-latest-posts .tft-post-thumbnail a::before {
				background: linear-gradient(360deg, <?php echo esc_html( $settings['news_item_card_gradient_1'] ); ?> -9.6%, <?php echo esc_html( $settings['news_item_card_gradient_2'] ); ?> 109.78%);
			}
			.tft-latest-posts .tft-post-thumbnail a:hover::before  {
				background: linear-gradient(360deg, <?php echo esc_html( $settings['news_item_card_gradient_1_hover'] ); ?> -9.6%, <?php echo esc_html( $settings['news_item_card_gradient_2_hover'] ); ?> 109.78%);
			}
			.tft-latest-posts .tft-post-thumbnail img{
				border-radius: <?php echo esc_html( $settings['news_card_radius'] ); ?>px;
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
											<div class="tft-post-titile">
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

    <?php
	}
}