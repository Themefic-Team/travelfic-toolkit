<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Popular Tours Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Popular Tours widgets. Both builders call:
 *
 *   PopularTours::render( $settings, 'elementor' );
 *   PopularTours::render( $settings, 'bricks' );
 */
class PopularTours {

	/**
	 * Render the popular tours widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];
		if ( in_array( 'tour', $tf_disable_services ) ) {
			return;
		}

		$post_type = ! empty( $settings['tf_post_type'] ) ? $settings['tf_post_type'] : 'tf_tours';
		$args      = array(
			'post_type' => $post_type,
		);

		// Display posts in category.
		if ( ! empty( $settings['post_category'] ) ) {
			$args['category_name'] = $settings['post_category'];
		}

		// Items per page
		if ( ! empty( $settings['post_items'] ) ) {
			$args['posts_per_page'] = $settings['post_items'];
		} else {
			$args['posts_per_page'] = 4;
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

		<div class="tft-popular-tour-design__one tft-customizer-typography">
			<div class="tft-popular-tour-items tft-popular-tour-selector">

				<?php if ( $query->have_posts() ) : ?>
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<?php
						// Review Query
						$review_args    = array(
							'post_id' => get_the_ID(),
							'status'  => 'approve',
							'type'    => 'comment',
						);
						$comments_query = new \WP_Comment_Query( $review_args );
						$comments       = $comments_query->comments;

						$option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );

						$disable_review_sec = ! empty( $option_meta['t-review'] ) ? $option_meta['t-review'] : '';
						?>
						<div class="tft-popular-single-item">
							<div class="tft-popular-single-item-inner">
								<div class="tft-popular-thumbnail">

									<a id="post-<?php the_ID(); ?>" <?php post_class( 'single-blog' ); ?>
										href="<?php echo esc_url( get_permalink() ); ?>">
										<?php
										$tf_tour_thumbnail = ! empty( get_the_post_thumbnail_url( get_the_ID() ) ) ? get_the_post_thumbnail_url( get_the_ID() ) : TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
										?>
										<img src="<?php echo esc_url( $tf_tour_thumbnail ); ?>" alt="<?php esc_html_e( 'Tour Image', 'travelfic-toolkit' ); ?>">
									</a>

									<?php if ( $comments && ! ( '1' === $disable_review_sec ) ) { ?>
										<div class="tft-ratings">
											<span>
												<i class="fas fa-star"></i>
												<span>
												<?php echo ( class_exists( '\Tourfic\App\TF_Review' ) ) ? esc_html( \Tourfic\App\TF_Review::tf_total_avg_rating( $comments ) ) : esc_html( tf_total_avg_rating( $comments ) ); ?>
												</span>
												( <?php class_exists( '\Tourfic\App\TF_Review' ) ? esc_html( \Tourfic\App\TF_Review::tf_based_on_text( count( $comments ) ) ) : esc_html( tf_based_on_text( count( $comments ) ) ); ?>)
											</span>
										</div>

									<?php } ?>

								</div>
								<div class="tft-popular-item-info">
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<h3 class="tft-title">
											<?php the_title(); ?>
										</h3>
									</a>
									<div class="tft-popular-sub-info">
										<div class="tft-popular-tour-address">
											<p class="tft-content">
												<i class="fas fa-location-arrow"></i>
												<?php
												$tour_location_address = (isset($option_meta['location']) && ! empty( tf_data_types( $option_meta['location'] ) )) ? tf_data_types( $option_meta['location'] )['address'] : '';
												if ( ! empty( $tour_location_address ) ) {
													echo esc_html( travelfic_character_limit( $tour_location_address, 45 ) );
												}
												?>
											</p>
										</div>
										<?php if ( ! empty( $option_meta['duration'] ) ) { ?>
											<div class="tft-popular-tour-duration">
												<p class="tft-content">
													<i class="fas fa-calendar-alt"></i>
													<?php
													echo esc_html( $option_meta['duration'] ) . ' ';

													if ( $option_meta['duration'] > 1 ) {
														echo esc_html( $option_meta['duration_time'] ) . 's';
													} else {
														echo esc_html( $option_meta['duration_time'] );
													}
													?>
												</p>
											</div>
										<?php } ?>
									</div>
									<div class="tft-popular-item-price">
										<?php
										$pricing_rule  = ! empty( $option_meta['pricing'] ) ? $option_meta['pricing'] : '';
										$adult_pricing = ! empty( $option_meta['adult_price'] ) ? $option_meta['adult_price'] : '';
										$group_pricing = ! empty( $option_meta['group_price'] ) ? $option_meta['group_price'] : '';
										?>
										<div class="tft-pricing-info">
											<?php
											if ( 'person' === $pricing_rule ) {
												if ( ! empty( $adult_pricing ) ) {
													?>
													<span class="tft-content"> <?php echo esc_html__( 'from ', 'travelfic-toolkit' ); ?> </span>
													<span class="tft-pricing"><?php echo wp_kses_post( wc_price( esc_html( $adult_pricing ) ) ); ?></span>
													<?php
												}
											} else {
												if ( ! empty( $group_pricing ) ) {
													?>
													<span class="tft-pricing"> <?php echo wp_kses_post( wc_price( esc_html( $group_pricing ) ) ); ?> </span>
													<?php
												}
											}
											?>
										</div>
									</div>

								</div>
							</div>
						</div>

					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>

		</div>

		<script>
		//Popular Tours
		;(function ($) {
			"use strict";
			$(document).ready(function () {
				$(".tft-popular-tour-selector").slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 1,
					arrows: true,
					centerMode: true,
					dots: false,
					pauseOnHover: true,
					autoplay: true,
					autoplaySpeed: 7000,
					prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa-solid fa-angle-left' aria-hidden='true'></i></button>",
					nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa-solid fa-angle-right' aria-hidden='true'></i></button>",
					speed: 700,
					responsive: [{
							breakpoint: 1024,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 1,
							},
						},
						{
							breakpoint: 991,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
							},
						},
						{
							breakpoint: 480,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
							},
						},
					],
				});
			});
		}(jQuery));

		</script>
		<?php
	}
}
