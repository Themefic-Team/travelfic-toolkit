<?php
class LatestNews extends \Elementor\Widget_Base {

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
		return 'tf-latest-news';
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
		return esc_html__( 'TFT Latest News', 'travelfic' );
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
				'label' => esc_html__( 'Blog News', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// Category name
		$this->add_control(
            'post_category',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => __( 'Category', 'travelfic' ),
                'options'   => $this->grid_get_all_post_type_categories( 'post' ),
            ]
        );
		// posts items per page
		$this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __( 'Items', 'travelfic' ),
                'placeholder' => __( 'How many items?', 'travelfic' ),
                'default'     => 4,
            ]
        );

		// Order by.
        $this->add_control(
            'post_order_by',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Order by', 'travelfic' ),
                'default' => 'date',
                'options' => [
                    'date'          => __( 'Date', 'travelfic' ),
                    'title'         => __( 'Title', 'travelfic' ),
                    'modified'      => __( 'Modified date', 'travelfic' ),
                    'comment_count' => __( 'Comment count', 'travelfic' ),
                    'rand'          => __( 'Random', 'travelfic' ),
                ],
            ]
        );
        // Order
        $this->add_control(
            'post_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Order', 'travelfic' ),
                'default' => 'DESC',
                'options' => [
                    'DESC'          => __( 'Descending', 'travelfic' ),
                    'ASC'         => __( 'Ascending', 'travelfic' ),
                ],
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {
	$settings = $this->get_settings_for_display(); 

		$args = array(
			'post_type'   => 'post'
		);

		// Display posts in category.
        if ( ! empty( $settings['post_category'] ) ) {
            $args['category_name'] = $settings['post_category'];
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

		$query = new \WP_Query( $args );
	
	?>

		<div class="tft-popular-tour-wrapper">
            <div class="tft-latest-posts">
                <div class="tft-latest-post-items tf-flex">
					
				<?php if( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					
						<div class="tft-col-item tft-post-single-item">
							<div class="tft-post-thumbnail tft-thumbnail">
								<div class="tft-thumbnail-url">
									<a id="post-<?php the_ID(); ?>" <?php post_class('single-blog'); ?> href="<?php echo esc_url( get_permalink() ); ?>">
									<?php the_post_thumbnail( 'blog-thumb' ); ?>
										<div class="tft-post-content-wrap">
												<div class="tft-meta-wrap">
													<p><i class="fas fa-clock"></i> Dec 01, 2021 </p>
												</div>
											<div class="tft-post-titile">
												<h3><?php the_title(); ?></h3>
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