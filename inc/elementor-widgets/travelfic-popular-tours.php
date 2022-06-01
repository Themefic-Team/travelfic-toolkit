<?php
class PopularTours extends \Elementor\Widget_Base {

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
		return 'tf-popular-tours';
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
		return esc_html__( 'TFT Popular Tours', 'travelfic' );
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
		return [ 'travelfic', 'popular', 'tours','tft' ];
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
			'popular_tours',
			[
				'label' => esc_html__( 'Popular Tours', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tf_post_type',
			[
				'label' => esc_html__( 'Post Type', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tf_tours',
				'options' => [
					'post'  => esc_html__( 'Post', 'travelfic' ),
					'tf_tours' => esc_html__( 'Tours', 'travelfic' )
				],
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
			'post_type'   => $settings['tf_post_type']
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

		// //Comments for review
		// $disable_review_sec = !empty($meta['t-review']) ? $meta['t-review'] : '';
		// $argss = array( 
		// 	'status'  => 'approve',
		// 	'type'    => 'comment',
		// );
		// $comments_query = new WP_Comment_Query( $argss ); 
		// $comments = $comments_query->comments;

	
	?>

		<div class="tft-popular-tour-wrapper tft-customizer-typography">
            <div class="tft-popular-tour-items tft-popular-tour-selector">
			
			
			<?php if( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php 
				/**
				 * Review query
				 */
				$args = array( 
					'post_id' => get_the_ID(  ),
					'status'  => 'approve',
					'type'    => 'comment',
				);
				$comments_query = new WP_Comment_Query( $args ); 
				$comments = $comments_query->comments;

				

				/**
				 * Show/hide sections
				 */
				$disable_review_sec = !empty($meta['t-review']) ? $meta['t-review'] : '';
			?>
				

                <div class="tft-popular-single-item">
                    <div class="tft-popular-single-item-inner">
                        <div class="tft-popular-thumbnail">

							<a id="post-<?php the_ID(); ?>" 
							<?php post_class('single-blog'); ?> href="<?php echo esc_url( get_permalink() ); ?>">
								<?php the_post_thumbnail( 'blog-thumb' ); ?>
							</a>
                            

							<?php if($comments && !$disable_review_sec == '1') { ?>
								<div class="tft-ratings">
									<span> 
										<i class="fas fa-star"></i> 
										<span><?php echo tf_total_avg_rating($comments); ?></span>
										(<?php tf_based_on_text(count($comments)); ?>)
									</span>
								</div>
								
							<?php  } ?>
							
                        </div>
                        <div class="tft-popular-item-info">
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<h3><?php the_title() ?></h3>
							</a>
                            <div class="tft-popular-sub-info">
								<p>
									<i class="fas fa-location-arrow"></i> 
									<?php 
										echo get_post_meta(get_the_ID(), "tf_tours_option", true)['text_location'];
									?>
								</p>
								<?php 
								if( get_post_meta(get_the_ID(), "tf_tours_option", true)['duration'] != '' ){ ?>
									<p>
										<i class="fas fa-calendar-alt"></i> 
										<?php echo get_post_meta(get_the_ID(), "tf_tours_option", true)['duration']; ?>
									</p>
								<?php }
								?>
                            </div>
                            <div class="tft-popular-item-price">
                                <h3><span>from </span><?php echo get_post_meta(get_the_ID(), "tf_tours_option", true)['adult_price']; ?> </h3>
                            </div>
							
                        </div>
                    </div>
                </div>

				<?php endwhile; ?>
			<?php endif; ?>

            </div>


			<script>

			(function ($) {
            "use strict";
            $(document).ready(function () {
				$('.tft-popular-tour-selector').slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 1,
					arrows: true,
					centerMode: true,
					dots: false,
					pauseOnHover:true,
					autoplay: true,
					autoplaySpeed: 7000,
					speed: 500,
					responsive: [
						{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
						},
						{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
						},
						{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
						}
					]
				});
            });
        	}(jQuery)); 

			</script>
        </div>
    <?php
	}
}