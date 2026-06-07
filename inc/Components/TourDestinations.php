<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Tour Destinations Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Tour Destinations widgets. Both builders call:
 *
 *   TourDestinations::render( $settings, 'elementor' );
 *   TourDestinations::render( $settings, 'bricks' );
 */
class TourDestinations {

	/**
	 * Render the tour destinations widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		// Check if tours are disabled
		$tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];
		if ( in_array( 'tour', $tf_disable_services ) ) {
			return;
		}

		// Set defaults
		$order = ! empty( $settings['cat_order'] ) ? $settings['cat_order'] : 'DESC';
		$post_per_page = ! empty( $settings['post_per_page'] ) ? $settings['post_per_page'] : 4;
		$cat_ids = ! empty( $settings['categories_id'] ) ? $settings['categories_id'] : [];
		$attraction_cat_ids = ! empty( $settings['attractions_cat_id'] ) ? $settings['attractions_cat_id'] : [];
		$tft_design = ! empty( $settings['des_style'] ) ? $settings['des_style'] : 'design-1';
		$tft_sec_title = ! empty( $settings['des_title'] ) ? $settings['des_title'] : '';
		$tft_sec_subtitle = ! empty( $settings['des_subtitle'] ) ? $settings['des_subtitle'] : '';
		$tft_sec_content = ! empty( $settings['des_description'] ) ? $settings['des_description'] : '';
		$tft_readme_url = ! empty( $settings['readme_url'] ) ? $settings['readme_url'] : [ 'url' => '#' ];
		$tft_location_section_bg = ! empty( $settings['location_section_bg'] ) ? $settings['location_section_bg'] : '';

		// Handle title backdrop
		$section_title_backdrop = isset( $settings['tour_destination_design3_title_backdrop'] ) && $settings['tour_destination_design3_title_backdrop'] ? '' : ' tft-no-backdrop';

		$taxonomy = 'design-4' === $tft_design ? 'tour_attraction' : 'tour_destination';
		$included = 'design-4' === $tft_design ? $attraction_cat_ids : $cat_ids;

		$show_count = 0;
		$orderby = 'name';
		$pad_counts = 0;
		$hierarchical = 1;
		$title = '';
		$empty = 0;

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

		// Get all posts based on the taxonomy
		if ( 'design-4' === $tft_design ) {
			$tax_query = [];
			if ( ! empty( $included ) ) {
				$tax_query[] = [
					'taxonomy' => 'tour_attraction',
					'field' => 'term_id',
					'terms' => $included,
					'include_children' => false,
				];
			}

			$args = [
				'post_type' => 'tf_tours',
				'order_by' => $orderby ?? 'name',
				'order' => $order ?? 'DESC',
				'post_per_page' => $post_per_page ?? 5,
				'tax_query' => $tax_query,
			];

			$all_destination_categories = get_posts( $args );
		} else {
			$all_destination_categories = get_categories( $args );
		}

		// Render based on design
		if ( 'design-1' === $tft_design ) {
			self::render_design_1( $all_destination_categories, $taxonomy, $orderby, $show_count, $pad_counts, $hierarchical, $title, $empty );
		} elseif ( 'design-2' === $tft_design ) {
			self::render_design_2( $all_destination_categories, $tft_sec_title, $tft_sec_subtitle, $tft_location_section_bg );
		} elseif ( 'design-3' === $tft_design ) {
			self::render_design_3( $all_destination_categories, $tft_sec_title, $tft_sec_subtitle, $tft_sec_content, $section_title_backdrop, $tft_readme_url, $settings );
		}
	}

	/**
	 * Render design 1 layout
	 *
	 * @param array  $categories All categories.
	 * @param string $taxonomy Taxonomy type.
	 * @param string $orderby Order by.
	 * @param int    $show_count Show count.
	 * @param int    $pad_counts Pad counts.
	 * @param int    $hierarchical Hierarchical.
	 * @param string $title Title.
	 * @param int    $empty Empty.
	 * @return void
	 */
	private static function render_design_1( $categories, $taxonomy, $orderby, $show_count, $pad_counts, $hierarchical, $title, $empty ) {
		?>
		<div class="tft-destination-design__one tft-customizer-typography">
			<div class="tft-destination tft-row">
				<?php
				foreach ( $categories as $cat ) {
					if ( $cat->category_parent == 0 ) {
						$category_id = $cat->term_id;
						$meta = get_term_meta( $cat->term_id, 'tf_tour_destination', true );
						if ( ! empty( $meta['image'] ) ) {
							$cat_image = $meta['image'];
						} else {
							$cat_image = TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
						}
						?>
						<div class="tft-single-destination tft-col">
							<div class="tft-destination-thumbnail tft-thumbnail">
								<a href="<?php echo esc_url( get_term_link( $cat->slug, 'tour_destination' ) ); ?>"><img src="<?php echo esc_url( $cat_image ); ?>" alt="<?php esc_html_e( 'Tour Destination Image', 'travelfic-toolkit' ); ?>"></a>
							</div>
							<div class="tft-destination-title">
								<?php echo '<a href="' . esc_url( get_term_link( $cat->slug, 'tour_destination' ) ) . '" class="tft-color-text">' . esc_html( $cat->name ) . '</a>'; ?>
							</div>

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
											<li><a href="<?php echo esc_url( get_term_link( $sub_category->slug, 'tour_destination' ) ); ?>"><?php echo esc_html( $sub_category->name ); ?></a></li>
											<?php
										}
									}
									?>
								</ul>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render design 2 layout
	 *
	 * @param array  $categories All categories.
	 * @param string $title Section title.
	 * @param string $subtitle Section subtitle.
	 * @param array  $bg_image Background image.
	 * @return void
	 */
	private static function render_design_2( $categories, $title, $subtitle, $bg_image ) {
		$bg_url = '';
		if ( is_array( $bg_image ) && ! empty( $bg_image['url'] ) ) {
			$bg_url = $bg_image['url'];
		} elseif ( is_object( $bg_image ) && ! empty( $bg_image->url ) ) {
			$bg_url = $bg_image->url;
		}

		$rand_number = wp_rand( 8, 10 );
		?>
		<div class="tft-destination-design__two" style="background-image: url(<?php echo ! empty( $bg_url ) ? esc_url( $bg_url ) : ''; ?>);">
			<div class="tft-destination-header">
				<div class="tft-heading-content">
					<?php if ( ! empty( $subtitle ) ) { ?>
						<h3 class="tft-section-subtitle"><?php echo esc_html( $subtitle ); ?></h3>
					<?php }
					if ( ! empty( $title ) ) {
						?>
						<h2 class="tft-section-title"><?php echo esc_html( $title ); ?></h2>
					<?php } ?>
				</div>
				<div class="tft-tour-destination-slides-arrows">
					<button type="button" class="slick-prev">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
							<path d="M7.82843 11.0009H44V13.0009H7.82843L13.1924 18.3648L11.7782 19.779L4 12.0009L11.7782 4.22266L13.1924 5.63687L7.82843 11.0009Z" fill="#B58E53"/>
						</svg>
					</button>
					<button type="button" class="slick-next">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
							<path d="M40.1716 11.0009H4V13.0009H40.1716L34.8076 18.3648L36.2218 19.779L44 12.0009L36.2218 4.22266L34.8076 5.63687L40.1716 11.0009Z" fill="#B58E53"/>
						</svg>
					</button>
				</div>
			</div>
			<div class="tft-destination-content">
				<div class="tft-destination-slides tft-destination-slide-<?php echo esc_attr( $rand_number ); ?>">
					<?php
					foreach ( $categories as $cat ) {
						if ( $cat->category_parent == 0 ) {
							$category_id = $cat->term_id;
							$meta = get_term_meta( $cat->term_id, 'tf_tour_destination', true );
							if ( ! empty( $meta['image'] ) ) {
								$cat_image = $meta['image'];
							} else {
								$cat_image = TRAVELFIC_TOOLKIT_ASSETS . 'app/img/location.jpeg';
							}
							?>
							<div class="tft-single-destination">
								<div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url( $cat_image ); ?>);">
									<a href="<?php echo esc_url( get_term_link( $cat->slug, 'tour_destination' ) ); ?>" class="tft-destination-content">
										<div class="tft-content-box">
											<h3><?php echo esc_html( $cat->name ); ?></h3>
										</div>
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
				// Destination Slider
				(function($) {
					$(document).ready(function() {
						$('.tft-destination-slide-<?php echo esc_attr( $rand_number ); ?>').slick({
							dots: false,
							arrows: true,
							infinite: true,
							speed: 300,
							autoplaySpeed: 2000,
							slidesToShow: 3,
							slidesToScroll: 1,
							prevArrow: '.tft-tour-destination-slides-arrows .slick-prev',
							nextArrow: '.tft-tour-destination-slides-arrows .slick-next',
							responsive: [{
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

	/**
	 * Render design 3 layout
	 *
	 * @param array  $categories All categories.
	 * @param string $title Section title.
	 * @param string $subtitle Section subtitle.
	 * @param string $content Section content.
	 * @param string $section_title_backdrop Backdrop class.
	 * @param array  $readme_url Button URL.
	 * @param array  $settings Widget settings.
	 * @return void
	 */
	private static function render_design_3( $categories, $title, $subtitle, $content, $section_title_backdrop, $readme_url, $settings ) {
		$bg_url = '';
		if ( is_array( $readme_url ) && ! empty( $readme_url['url'] ) ) {
			$btn_url = $readme_url['url'];
		} else {
			$btn_url = '#';
		}

		// Get background image
		$bg_image = ! empty( $settings['location_section_bg'] ) ? $settings['location_section_bg'] : '';
		if ( is_array( $bg_image ) && ! empty( $bg_image['url'] ) ) {
			$bg_url = $bg_image['url'];
		} elseif ( is_object( $bg_image ) && ! empty( $bg_image->url ) ) {
			$bg_url = $bg_image->url;
		}

		?>
		<div class="tft-destination-design__three tft-section-space" style="background-image: url(<?php echo ! empty( $bg_url ) ? esc_url( $bg_url ) : ''; ?>);">
			<div class="tft-destination-content">
				<div class="tft-heading-content">
					<?php if ( ! empty( $subtitle ) ) { ?>
						<h3 class="tft-section-subtitle"><?php echo esc_html( $subtitle ); ?></h3>
					<?php }
					if ( ! empty( $title ) ) {
						?>
						<h2 class="tft-section-title tft-title-shape <?php echo esc_attr( $section_title_backdrop ); ?>"><?php echo esc_html( $title ); ?></h2>
					<?php }
					if ( ! empty( $content ) ) {
						?>
						<div class="tft-section-content">
							<?php echo wp_kses_post( $content ); ?>
						</div>
					<?php }
					if ( ! empty( $settings['readme_label'] ) ) {
						?>
						<a href="<?php echo esc_url( $btn_url ); ?>" class="tft-btn" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html( $settings['readme_label'] ); ?>
							<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
						</a>
					<?php } ?>
				</div>
				<?php
				foreach ( $categories as $cat ) {
					if ( $cat->category_parent == 0 ) {
						$category_id = $cat->term_id;
						$meta = get_term_meta( $cat->term_id, 'tf_tour_destination', true );
						if ( ! empty( $meta['image'] ) ) {
							$cat_image = $meta['image'];
						} else {
							$cat_image = TRAVELFIC_TOOLKIT_ASSETS . 'app/img/destination-placeholder.png';
						}
						?>
						<div class="tft-single-destination">
							<div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url( $cat_image ); ?>);">
								<div class="tft-destination-content tft-content-box">
									<h3>
										<a href="<?php echo esc_url( get_term_link( $cat->slug, 'tour_destination' ) ); ?>" class="tft-destination-content-title">
											<?php echo esc_html( $cat->name ); ?>
										</a>
									</h3>
									<p class="tft-color-white"><?php echo esc_html( $cat->count ); ?> <span><?php echo esc_html__( 'Destination', 'travelfic-toolkit' ); ?></span></p>
								</div>
							</div>
						</div>
						<?php
					}
				}
				if ( ! empty( $settings['readme_label'] ) ) {
					?>
					<a href="<?php echo esc_url( $btn_url ); ?>" class="tft-btn tft-btn--mobile tft-btn-transparent" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( $settings['readme_label'] ); ?>
						<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
					</a>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
