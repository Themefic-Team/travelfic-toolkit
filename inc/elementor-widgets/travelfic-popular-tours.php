<?php
class PopularTours extends \Elementor\Widget_Base
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
	public function get_title()
	{
		return esc_html__('TFT Popular Tours', 'travelfic-toolkit');
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
		return ['travelfic-popular-tours'];
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
				'label' => esc_html__('Popular Tours', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tf_post_type',
			[
				'label' => esc_html__('Post Type', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tf_tours',
				'options' => [
					'post' => esc_html__('Post', 'travelfic-toolkit'),
					'tf_tours' => esc_html__('Tours', 'travelfic-toolkit')
				],
			]
		);

		// Order by.
		$this->add_control(
			'post_order_by',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__('Order by', 'travelfic-toolkit'),
				'default' => 'date',
				'options' => [
					'date' => esc_html__('Date', 'travelfic'),
					'title' => esc_html__('Title', 'travelfic'),
					'modified' => esc_html__('Modified date', 'travelfic'),
					'comment_count' => esc_html__('Comment count', 'travelfic'),
					'rand' => esc_html__('Random', 'travelfic'),
				],
			]
		);
		// Order
		$this->add_control(
			'post_order',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__('Order', 'travelfic-toolkit'),
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__('Descending', 'travelfic-toolkit'),
					'ASC' => esc_html__('Ascending', 'travelfic-toolkit'),
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type' => $settings['tf_post_type']
		);

		// Display posts in category.
		if (!empty($settings['post_category'])) {
			$args['category_name'] = $settings['post_category'];
		}

		// Items per page
		if (!empty($settings['post_items'])) {
			$args['posts_per_page'] = $settings['post_items'];
		}

		// Items Order By
		if (!empty($settings['post_order_by'])) {
			$args['orderby'] = $settings['post_order_by'];
		}

		// Items Order
		if (!empty($settings['post_order'])) {
			$args['order'] = $settings['post_order'];
		}

		$query = new \WP_Query($args);

		?>

		<div class="tft-popular-tour-wrapper tft-customizer-typography">
			<div class="tft-popular-tour-items tft-popular-tour-selector">

				<?php if ($query->have_posts()): ?>
					<?php while ($query->have_posts()):
						$query->the_post(); ?>
						<?php
						// Review Query 
						$args = array(
							'post_id' => get_the_ID(),
							'status' => 'approve',
							'type' => 'comment',
						);
						$comments_query = new WP_Comment_Query($args);
						$comments = $comments_query->comments;

						$option_meta = travelfic_get_meta('tf_tours_opt');

						$disable_review_sec = !empty($meta['t-review']) ? $meta['t-review'] : '';
						?>
						<div class="tft-popular-single-item">
							<div class="tft-popular-single-item-inner">
								<div class="tft-popular-thumbnail">

									<a id="post-<?php the_ID(); ?>" <?php post_class('single-blog'); ?>
										href="<?php echo esc_url(get_permalink()); ?>">
										<?php the_post_thumbnail('blog-thumb'); ?>
									</a>

									<?php if ($comments && !$disable_review_sec == '1') { ?>
										<div class="tft-ratings">
											<span>
												<i class="fas fa-star"></i>
												<span>
													<?php echo tf_total_avg_rating($comments); ?>
												</span>
												( <?php tf_based_on_text(count($comments)); ?>)
											</span>
										</div>

									<?php } ?>

								</div>
								<div class="tft-popular-item-info">
									<a href="<?php echo esc_url(get_permalink()); ?>">
										<h3>
											<?php the_title() ?>
										</h3>
									</a>
									<div class="tft-popular-sub-info">
										<div class="tft-popular-tour-address">
											<p>
												<i class="fas fa-location-arrow"></i>
												<?php 
													if( isset( $option_meta['text_location'] ) ){
														echo esc_html( $option_meta['text_location'] );
													}
												?>
											</p>
										</div>
										<?php
										if ( $option_meta['duration'] != '') { ?>
											<div class="tft-popular-tour-duration">
												<p>
													<i class="fas fa-calendar-alt"></i>
													<?php echo esc_html( $option_meta['duration'] );?>
												</p>
											</div>
										<?php }
										?>
									</div>
									<div class="tft-popular-item-price">
										<?php
											$pricing_rule = !empty( $option_meta['pricing'] ) ? $option_meta['pricing'] : '';
											$adult_pricing = !empty( $option_meta['adult_price'] ) ? $option_meta['adult_price'] : '';
											$group_pricing = !empty( $option_meta['group_price'] ) ? $option_meta['group_price'] : '';
										?>
										<h3>
											<?php
												if ( $pricing_rule == 'person' ) {
													echo '<span> from </span>' . get_woocommerce_currency_symbol() . esc_html( $adult_pricing );
												} else {
													$group_pricing = get_post_meta( get_the_ID(), "tf_tours_opt", true )['group_price'];
													echo get_woocommerce_currency_symbol() . esc_html( $group_pricing );
												}
											?>
										</h3>
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
							pauseOnHover: true,
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