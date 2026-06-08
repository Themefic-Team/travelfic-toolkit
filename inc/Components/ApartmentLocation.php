<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Apartment Location Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Apartment Location widgets. Both builders call:
 *
 *   ApartmentLocation::render( $settings, 'elementor' );
 *   ApartmentLocation::render( $settings, 'bricks' );
 */
class ApartmentLocation {

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( array $settings = [], string $builder = '' ): void {
		$tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];
		if ( in_array( 'apartment', $tf_disable_services ) ) {
			return;
		}

		$order         = ! empty( $settings['cat_order'] ) ? $settings['cat_order'] : 'DESC';
		$post_per_page = ! empty( $settings['post_per_page'] ) ? $settings['post_per_page'] : 4;
		$cat_ids       = ! empty( $settings['categories_id'] ) ? $settings['categories_id'] : '';

		// Design
		$tft_design              = ! empty( $settings['aprt_location_style'] ) ? $settings['aprt_location_style'] : 'design-1';
		$tft_sec_title           = ! empty( $settings['des_title'] ) ? $settings['des_title'] : '';
		$tft_sec_subtitle        = ! empty( $settings['des_subtitle'] ) ? $settings['des_subtitle'] : '';
		$tft_location_section_bg = self::get_image_url( $settings, 'location_section_bg', TRAVELFIC_TOOLKIT_URL . 'assets/app/img/destination-bg.png' );

		$taxonomy     = 'apartment_location';
		$show_count   = 0;
		$orderby      = 'name';
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';
		$empty        = 0;
		$included     = $cat_ids;

		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'order'        => $order,
			'number'       => $post_per_page,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'include'      => $included,
			'hide_empty'   => $empty,
		);

		$all_categories = get_categories( $args );

		if ( 'design-1' == $tft_design ) {
			?>
			<div class="tft-destination-design__one tft-customizer-typography">
				<div class="tft-destination tft-row">
					<?php
					foreach ( $all_categories as $cat ) {
						if ( $cat->category_parent == 0 ) {
							$category_id = $cat->term_id;
							$meta        = get_term_meta( $cat->term_id, 'tf_apartments_locations', true );
							if ( ! empty( $meta['image'] ) ) {
								$cat_image = $meta['image'];
							} else {
								$cat_image = TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
							}
							?>
							<div class="tft-single-destination tft-col">
								<div class="tft-destination-thumbnail tft-thumbnail">
									<a href="<?php echo esc_url( get_term_link( $cat->slug, 'apartment_location' ) ); ?>">
										<img src="<?php echo esc_url( $cat_image ); ?>" alt="<?php esc_html_e( 'Apartment Location Image', 'travelfic-toolkit' ); ?>">
									</a>
								</div>
								<div class="tft-destination-title">
									<?php echo '<a href="' . esc_url( get_term_link( $cat->slug, 'apartment_location' ) ) . '">' . esc_html( $cat->name ) . '</a>'; ?>
								</div>

								<div class="tft-destination-details">
									<div class="tft-destination-details">
										<ul>
											<?php
											$args2 = array(
												'taxonomy'     => $taxonomy,
												'child_of'     => 0,
												'parent'       => $category_id,
												'orderby'      => $orderby,
												'show_count'   => $show_count,
												'pad_counts'   => $pad_counts,
												'hierarchical' => $hierarchical,
												'title_li'     => $title,
												'hide_empty'   => $empty,
											);
											$sub_cats = get_categories( $args2 );
											if ( $sub_cats ) {
												foreach ( $sub_cats as $sub_category ) {
													?>
													<li>
														<a href="<?php echo esc_url( get_term_link( $sub_category->slug, 'apartment_location' ) ); ?>">
															<?php echo esc_html( $sub_category->name ); ?>
														</a>
													</li>
													<?php
												}
											}
											?>
										</ul>
									</div>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
		} elseif ( 'design-2' == $tft_design ) {
			$rand_number = wp_rand( 8, 10 );
			?>
			<div class="tft-destination-design__two tft-aprt-location-design-2"
			     style="background-image: url(<?php echo esc_url( $tft_location_section_bg ); ?>);">
				<div class="tft-destination-header">
					<div class="tft-heading-content">
						<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $tft_sec_title ) ) : ?>
							<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php endif; ?>
					</div>
					<div class="tft-apartment-location-slider-arrows">
						<button type="button" class="slick-prev">
							<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
								<path d="M7.82843 11.0009H44V13.0009H7.82843L13.1924 18.3648L11.7782 19.779L4 12.0009L11.7782 4.22266L13.1924 5.63687L7.82843 11.0009Z" fill="#B58E53" />
							</svg>
						</button>
						<button type="button" class="slick-next">
							<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
								<path d="M40.1716 11.0009H4V13.0009H40.1716L34.8076 18.3648L36.2218 19.779L44 12.0009L36.2218 4.22266L34.8076 5.63687L40.1716 11.0009Z" fill="#B58E53" />
							</svg>
						</button>
					</div>
				</div>

				<div class="tft-destination-content">
					<div class="tft-destination-slides tft-apart-destination-slide-<?php echo esc_attr( $rand_number ); ?>">
						<?php
						foreach ( $all_categories as $cat ) {
							if ( $cat->category_parent == 0 ) {
								$category_id = $cat->term_id;
								$meta        = get_term_meta( $cat->term_id, 'tf_apartments_locations', true );
								if ( ! empty( $meta['image'] ) ) {
									$cat_image = $meta['image'];
								} else {
									$cat_image = 'https://theme-demo.themefic.com/wp-content/uploads/2025/01/placeholder-450x600-1.jpg';
								}
								?>
								<div class="tft-single-destination">
									<div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url( $cat_image ); ?>);">
										<a href="<?php echo esc_url( get_term_link( $cat->slug, 'apartment_location' ) ); ?>" class="tft-destination-content">
											<h3><?php echo esc_html( $cat->name ); ?></h3>
											<span class="tft-w-100 tft-btn tft-wh-auto tft-btn_sharp tft-gap-0">
												<?php esc_html_e( 'Explore now', 'travelfic-toolkit' ); ?>
												<svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
													<g id="content">
														<path id="Vector" d="M17.0001 6L1.00012 6" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
														<path id="Vector_2" d="M12.0003 11C12.0003 11 17.0002 7.31756 17.0002 5.99996C17.0003 4.68237 12.0002 1 12.0002 1" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													</g>
												</svg>
											</span>
										</a>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<script>
					// Apartment Destination Slider
					(function($) {
						$(document).ready(function() {
							$('.tft-apart-destination-slide-<?php echo esc_attr( $rand_number ); ?>').slick({
								dots: false,
								arrows: true,
								infinite: true,
								speed: 300,
								autoplaySpeed: 2000,
								slidesToShow: 3,
								slidesToScroll: 1,
								prevArrow: '.tft-aprt-location-design-2 .tft-apartment-location-slider-arrows .slick-prev',
								nextArrow: '.tft-aprt-location-design-2 .tft-apartment-location-slider-arrows .slick-next',
								responsive: [
									{
										breakpoint: 1024,
										settings: {
											slidesToShow: 2,
											slidesToScroll: 1,
											infinite: true,
										}
									},
									{
										breakpoint: 580,
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

	/**
	 * Safe image URL helper.
	 */
	private static function get_image_url( array $settings, string $key, string $default = '' ): string {
		$val = $settings[ $key ] ?? '';
		if ( is_array( $val ) ) {
			return ! empty( $val['url'] ) ? $val['url'] : $default;
		}
		return is_string( $val ) && ! empty( $val ) ? $val : $default;
	}
}
