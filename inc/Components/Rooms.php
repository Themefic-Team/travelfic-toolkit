<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Rooms Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Rooms widgets. Both builders call:
 *
 *   Rooms::render( $settings, 'elementor' );
 *   Rooms::render( $settings, 'bricks' );
 */
class Rooms {

	/**
	 * Render the rooms widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$tft_design          = ! empty( $settings['tft_rooms_style'] ) ? $settings['tft_rooms_style'] : 'design-1';
		$tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];

		if ( in_array( 'hotel', $tf_disable_services ) ) {
			return;
		}

		$args = array(
			'post_type' => 'tf_room',
		);

		// Items per page
		if ( ! empty( $settings['post_items'] ) ) {
			$args['posts_per_page'] = $settings['post_items'];
		} else {
			$args['posts_per_page'] = 6;
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

		// Normalize slider settings
		$room_slider_nav    = ! empty( $settings['tft_room_slider_navigation'] ) ? $settings['tft_room_slider_navigation'] : 'arrows';
		$room_slider_arrows = ( 'arrows' === $room_slider_nav ) ? 'true' : 'false';
		$room_slider_dots   = ( 'dots' === $room_slider_nav ) ? 'true' : 'false';

		// Autoplay Checkbox/Switcher normalization
		$autoplay = false;
		if ( 'elementor' === $builder ) {
			$autoplay = ! empty( $settings['tft_room_slider_autoplay'] ) && 'yes' === $settings['tft_room_slider_autoplay'];
		} else {
			$autoplay = ! empty( $settings['tft_room_slider_autoplay'] );
		}
		$room_slider_autoplay = $autoplay ? 'true' : 'false';

		$loop = false;
		if ( 'elementor' === $builder ) {
			$loop = ! empty( $settings['tft_room_slider_loop'] ) && 'yes' === $settings['tft_room_slider_loop'];
		} else {
			$loop = ! empty( $settings['tft_room_slider_loop'] );
		}
		$room_slider_loop = $loop ? 'true' : 'false';

		$pause_on_hover = false;
		if ( 'elementor' === $builder ) {
			$pause_on_hover = ! empty( $settings['tft_room_slider_pause_on_hover'] ) && 'yes' === $settings['tft_room_slider_pause_on_hover'];
		} else {
			$pause_on_hover = ! empty( $settings['tft_room_slider_pause_on_hover'] );
		}
		$room_slider_pause_on_hover = $pause_on_hover ? 'true' : 'false';

		$pause_on_focus = false;
		if ( 'elementor' === $builder ) {
			$pause_on_focus = ! empty( $settings['tft_room_slider_pause_on_focus'] ) && 'yes' === $settings['tft_room_slider_pause_on_focus'];
		} else {
			$pause_on_focus = ! empty( $settings['tft_room_slider_pause_on_focus'] );
		}
		$room_slider_pause_on_focus = $pause_on_focus ? 'true' : 'false';

		$draggable = false;
		if ( 'elementor' === $builder ) {
			$draggable = ! empty( $settings['tft_room_slider_draggable'] ) && 'yes' === $settings['tft_room_slider_draggable'];
		} else {
			$draggable = ! empty( $settings['tft_room_slider_draggable'] );
		}
		$room_slider_draggable = $draggable ? 'true' : 'false';

		// Normalizing slider speed/interval values
		$autoplay_speed = 2000;
		if ( isset( $settings['tft_room_slider_autoplay_speed'] ) ) {
			if ( is_array( $settings['tft_room_slider_autoplay_speed'] ) ) {
				$autoplay_speed = isset( $settings['tft_room_slider_autoplay_speed']['size'] ) ? $settings['tft_room_slider_autoplay_speed']['size'] : 2000;
			} else {
				$autoplay_speed = $settings['tft_room_slider_autoplay_speed'];
			}
		}

		$autoplay_interval = 1500;
		if ( isset( $settings['tft_room_slider_autoplay_interval'] ) ) {
			if ( is_array( $settings['tft_room_slider_autoplay_interval'] ) ) {
				$autoplay_interval = isset( $settings['tft_room_slider_autoplay_interval']['size'] ) ? $settings['tft_room_slider_autoplay_interval']['size'] : 1500;
			} else {
				$autoplay_interval = $settings['tft_room_slider_autoplay_interval'];
			}
		}

		$card_title_type = ! empty( $settings['card_title_type'] ) ? $settings['card_title_type'] : 'Split';

		if ( 'design-1' === $tft_design ) :
			?>
			<div class="tft-room-section tft-customizer-typography">
				<div class="tft-room-items">
					<div class="tft-room-slider"
						data-loop="<?php echo esc_attr( $room_slider_loop ); ?>"
						data-autoplay="<?php echo esc_attr( $room_slider_autoplay ); ?>"
						data-autoplay-speed="<?php echo esc_attr( $autoplay_speed ); ?>"
						data-speed="<?php echo esc_attr( $autoplay_interval ); ?>"
						data-dots="<?php echo esc_attr( $room_slider_dots ); ?>"
						data-arrows="<?php echo esc_attr( $room_slider_arrows ); ?>"
						data-pause-on-hover="<?php echo esc_attr( $room_slider_pause_on_hover ); ?>"
						data-pause-on-focus="<?php echo esc_attr( $room_slider_pause_on_focus ); ?>"
						data-draggable="<?php echo esc_attr( $room_slider_draggable ); ?>">
						<?php
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								$post_id             = get_the_ID();
								$room                = get_post_meta( $post_id, 'tf_room_opt', true );
								$adult_number        = ! empty( $room['adult'] ) ? $room['adult'] : '0';
								$child_number        = ! empty( $room['child'] ) ? $room['child'] : '0';
								$footage             = ! empty( $room['footage'] ) ? $room['footage'] : '';
								$min_price_arr       = \Tourfic\Classes\Room\Pricing::instance( $post_id )->get_min_price( '' );
								$min_discount_type   = ! empty( $min_price_arr['min_discount_type'] ) ? $min_price_arr['min_discount_type'] : 'none';
								$min_discount_amount = ! empty( $min_price_arr['min_discount_amount'] ) ? $min_price_arr['min_discount_amount'] : 0;
								?>
								<div class="tft-single-room">
									<div class="tft-room-thumbnail">
										<?php $tft_hotel_image = ! empty( get_the_post_thumbnail_url( get_the_ID() ) ) ? esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) : esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' ); ?>
										<img src="<?php echo esc_url( $tft_hotel_image ); ?>" alt="post thumbnail">

										<?php if ( ! empty( $min_discount_amount ) ) : ?>
											<div class="tf-room-off">
												<span>
													<?php echo 'percent' === $min_discount_type ? esc_html( $min_discount_amount ) . '%' : wp_kses_post( wc_price( $min_discount_amount ) ); ?><?php esc_html_e( ' Off ', 'tourfic' ); ?>
												</span>
											</div>
										<?php endif; ?>
									</div>
									<div class="tft-room-content">
										<div class="tft-room-title-wrap">
											<h2 class="tft-room-title">
												<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="tft-color-hover-primary">
													<?php
													if ( 'Split' === $card_title_type ) {
														echo esc_html( travelfic_character_limit( get_the_title(), 20 ) );
													} else {
														the_title();
													}
													?>
												</a>
											</h2>
											<div class="tf-room-price"><?php \Tourfic\Classes\Room\Pricing::instance( $post_id )->get_per_price_html( '', 'design-3' ); ?></div>
										</div>
										<ul>
											<?php if ( $footage ) { ?>
												<li><?php echo esc_html( $footage ); ?> /</li>
											<?php } ?>

											<?php if ( $adult_number ) { ?>
											<li>
												<?php
												// Adult count with singular/plural translation
												$adult_count = intval( $adult_number );
												echo esc_html( sprintf( ' %d %s', $adult_count, _n( 'Adult', 'Adults', $adult_count, 'travelfic-toolkit' ) ) );
												?> / 
											</li>
											<?php } ?>

											<?php if ( $child_number ) { ?>
											<li>
												<?php
												// Child count with singular/plural translation
												$child_count = intval( $child_number );
												echo esc_html( sprintf( '%d %s', $child_count, _n( 'Child', 'Children', $child_count, 'travelfic-toolkit' ) ) );
												?>
											</li>
											<?php } ?>
										</ul>

										<div class="tft-room-btn">
											<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="tft-btn">
												<?php esc_html_e( 'Book Now', 'travelfic-toolkit' ); ?>
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 7H17M17 7V17M17 7L7 17" stroke="#F5FFFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</a>
										</div>
									</div>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
					<!-- room slider navigation -->
					<?php if ( 'true' === $room_slider_arrows ) : ?>
						<div class="tft-destination-slider-nav">
							<button type="button" class="tft-prev-slide tft-bg-hover-primary">
								<i class="ri-arrow-left-line"></i>
							</button>
							<button type="button" class="tft-next-slide tft-bg-hover-primary">
								<i class="ri-arrow-right-line"></i>
							</button>
						</div>
					<?php endif; ?>
				</div>

				<script>
					// room Slider
					(function($) {
						$(document).ready(function() {
							$('.tft-room-section .tft-room-slider').slick({
								slidesToShow: 3,
								slidesToScroll: 1,
								infinite: <?php echo esc_attr( $room_slider_loop ); ?>,
								autoplay: <?php echo esc_attr( $room_slider_autoplay ); ?>,
								autoplaySpeed: <?php echo esc_attr( $room_slider_autoplay_speed ); ?>,
								speed: <?php echo esc_attr( $room_slider_autoplay_interval ); ?>,
								dots: <?php echo esc_attr( $room_slider_dots ); ?>,
								arrows: <?php echo esc_attr( $room_slider_arrows ); ?>,
								pauseOnHover: <?php echo esc_attr( $room_slider_pause_on_hover ); ?>,
								pauseOnFocus: <?php echo esc_attr( $room_slider_pause_on_focus ); ?>,
								draggable: <?php echo esc_attr( $room_slider_draggable ); ?>,
								cssEase: 'linear',
								prevArrow: '.tft-room-section .tft-prev-slide',
								nextArrow: '.tft-room-section .tft-next-slide',
								variableWidth: true,
								adaptiveHeight: true,
								responsive: [{
										breakpoint: 1024,
										settings: {
											slidesToShow: 2,
											slidesToScroll: 1
										}
									},
									{
										breakpoint: 640,
										settings: {
											variableWidth: false,
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
		endif;
	}
}
