<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Car Brands Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Car Brands widgets. Both builders call:
 *
 *   CarBrands::render( $settings, 'elementor' );
 *   CarBrands::render( $settings, 'bricks' );
 */
class CarBrands {

	/**
	 * Render the car brands widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		// Check if car rentals are disabled
		$tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];
		if ( in_array( 'carrentals', $tf_disable_services ) ) {
			return;
		}

		// Set defaults
		$order = ! empty( $settings['cat_order'] ) ? $settings['cat_order'] : 'DESC';
		$post_per_page = ! empty( $settings['post_per_page'] ) ? $settings['post_per_page'] : 4;
		$cat_ids = ! empty( $settings['categories_id'] ) ? $settings['categories_id'] : [];
		$tft_sec_title = ! empty( $settings['des_title'] ) ? $settings['des_title'] : '';
		$tft_sec_subtitle = ! empty( $settings['des_subtitle'] ) ? $settings['des_subtitle'] : '';
		$style = ! empty( $settings['cat_style'] ) ? $settings['cat_style'] : 'slider';

		$taxonomy = 'carrental_brand';
		$show_count = 0;
		$orderby = 'name';
		$pad_counts = 0;
		$hierarchical = 1;
		$title = '';
		$empty = 0;
		$included = $cat_ids;

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

		$all_brands_categories = get_categories( $args );

		// Render
		self::render_brands( $all_brands_categories, $tft_sec_title, $tft_sec_subtitle, $style );
	}

	/**
	 * Render car brands layout
	 *
	 * @param array  $categories All brand categories.
	 * @param string $title Section title.
	 * @param string $subtitle Section subtitle.
	 * @param string $style Display style (slider or grid).
	 * @return void
	 */
	private static function render_brands( $categories, $title, $subtitle, $style ) {
		$rand_number = wp_rand( 100, 99999999 );
		$style_class = 'slider' === $style ? 'tft-brands-slider-selector-' . $rand_number : 'tft-brands-grid';

		$item_count = 0;
		foreach ( $categories as $cat ) {
			if ( $cat->category_parent == 0 ) {
				$item_count++;
			}
		}
		?>
		<div class="tft-brands-design__one tft-customizer-typography">
			<div class="tft-brands-inner">
				<div class="tft-brands-header tft-section-heading">
					<?php if ( ! empty( $title ) ) { ?>
						<h2 class="tft-section-title"><?php echo esc_html( $title ); ?></h2>
					<?php } ?>
					<?php if ( ! empty( $subtitle ) ) { ?>
						<div class="tft-section-content">
							<p><?php echo esc_html( $subtitle ); ?></p>
						</div>
					<?php } ?>
				</div>
				<div class="tft-brands <?php echo esc_attr( $style_class ); ?>">
					<?php
					foreach ( $categories as $cat ) {
						if ( $cat->category_parent == 0 ) {
							$category_id = $cat->term_id;
							$meta = get_term_meta( $cat->term_id, 'tf_carrental_brand', true );
							if ( ! empty( $meta['image'] ) ) {
								$cat_image = $meta['image'];
							} else {
								$cat_image = TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
							}
							?>
							<div class="tft-single-brands">
								<div class="tft-brands-thumbnail tft-thumbnail">
									<a href="<?php echo esc_url( get_term_link( $cat->slug, 'carrental_brand' ) ); ?>"><img src="<?php echo esc_url( $cat_image ); ?>" alt="<?php esc_html_e( 'Car brands Image', 'travelfic-toolkit' ); ?>"></a>
									<div class="tft-brands-title">
										<?php echo '<a href="' . esc_url( get_term_link( $cat->slug, 'carrental_brand' ) ) . '">' . esc_html( $cat->name ) . '</a>'; ?>
									</div>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php if ( 'slider' === $style ) { ?>
				<?php if ( $item_count === 1 ) { ?>
					<style>
						.tft-brands-slider-selector-<?php echo esc_attr( $rand_number ); ?> .slick-track {
							display: flex !important;
							justify-content: center !important;
							transform: none !important;
						}
					</style>
				<?php } elseif ( $item_count === 2 ) { ?>
					<style>
						@media (min-width: 1025px) {
							.tft-brands-slider-selector-<?php echo esc_attr( $rand_number ); ?> .slick-track {
								display: flex !important;
								justify-content: center !important;
								transform: none !important;
							}
						}
					</style>
				<?php } ?>
				<script>
					// Car Brands Slider
					(function($) {
						$(document).ready(function() {
							$('.tft-brands-slider-selector-<?php echo esc_attr( $rand_number ); ?>').slick({
								slidesToShow: 3,
								slidesToScroll: 1,
								dots: false,
								arrows: false,
								centerMode: <?php echo $item_count > 2 ? 'true' : 'false'; ?>,
								focusOnSelect: true,
								infinite: <?php echo $item_count > 2 ? 'true' : 'false'; ?>,
								autoplay: <?php echo $item_count > 2 ? 'true' : 'false'; ?>,
								speed: 900,
								autoplaySpeed: 6000,
								responsive: [{
										breakpoint: 1024,
										settings: {
											slidesToShow: 2,
											slidesToScroll: 1,
											infinite: <?php echo $item_count > 2 ? 'true' : 'false'; ?>,
										}
									},
									{
										breakpoint: 767,
										settings: {
											slidesToShow: 2,
											slidesToScroll: 1,
											margin: '10px'
										}
									},
									{
										breakpoint: 580,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
											infinite: <?php echo $item_count > 1 ? 'true' : 'false'; ?>,
											autoplay: <?php echo $item_count > 1 ? 'true' : 'false'; ?>
										}
									}
								]
							});
						});
					}(jQuery));
				</script>
			<?php } ?>
		</div>
		<?php
	}
}
