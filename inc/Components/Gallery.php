<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Gallery Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Gallery widgets. Both builders call:
 *
 *   Gallery::render( $settings, 'elementor' );
 *   Gallery::render( $settings, 'bricks' );
 */
class Gallery {

	/**
	 * Render the gallery widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		// Design
		$tft_design       = ! empty( $settings['gallery_style'] ) ? $settings['gallery_style'] : 'design-1';
		$tft_sec_title    = ! empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$tft_sec_subtitle = ! empty( $settings['section_subtitle'] ) ? $settings['section_subtitle'] : '';
		$galleries        = ! empty( $settings['galleries'] ) ? $settings['galleries'] : [];

		// Normalize slider settings
		$gallery_slider_nav    = ! empty( $settings['gallery_slider_navigation'] ) ? $settings['gallery_slider_navigation'] : 'arrows';
		$gallery_slider_arrows = ( 'arrows' === $gallery_slider_nav ) ? 'true' : 'false';
		$gallery_slider_dots   = ( 'dots' === $gallery_slider_nav ) ? 'true' : 'false';

		// Normalizing boolean checkbox/switcher values
		$autoplay = false;
		if ( 'elementor' === $builder ) {
			$autoplay = ! empty( $settings['gallery_slider_autoplay'] ) && 'yes' === $settings['gallery_slider_autoplay'];
		} else {
			$autoplay = ! empty( $settings['gallery_slider_autoplay'] );
		}
		$gallery_slider_autoplay = $autoplay ? 'true' : 'false';

		$loop = false;
		if ( 'elementor' === $builder ) {
			$loop = ! empty( $settings['gallery_slider_loop'] ) && 'yes' === $settings['gallery_slider_loop'];
		} else {
			$loop = ! empty( $settings['gallery_slider_loop'] );
		}
		$gallery_slider_loop = $loop ? 'true' : 'false';

		$pause_on_hover = false;
		if ( 'elementor' === $builder ) {
			$pause_on_hover = ! empty( $settings['gallery_slider_pause_on_hover'] ) && 'yes' === $settings['gallery_slider_pause_on_hover'];
		} else {
			$pause_on_hover = ! empty( $settings['gallery_slider_pause_on_hover'] );
		}
		$gallery_slider_pause_on_hover = $pause_on_hover ? 'true' : 'false';

		$pause_on_focus = false;
		if ( 'elementor' === $builder ) {
			$pause_on_focus = ! empty( $settings['gallery_slider_pause_on_focus'] ) && 'yes' === $settings['gallery_slider_pause_on_focus'];
		} else {
			$pause_on_focus = ! empty( $settings['gallery_slider_pause_on_focus'] );
		}
		$gallery_slider_pause_on_focus = $pause_on_focus ? 'true' : 'false';

		$draggable = false;
		if ( 'elementor' === $builder ) {
			$draggable = ! empty( $settings['gallery_slider_draggable'] ) && 'yes' === $settings['gallery_slider_draggable'];
		} else {
			$draggable = ! empty( $settings['gallery_slider_draggable'] );
		}
		$gallery_slider_draggable = $draggable ? 'true' : 'false';

		// Normalizing slider speed values (Elementor has range array, Bricks has simple number value)
		$gallery_slider_autoplay_speed = 3000;
		if ( isset( $settings['gallery_slider_autoplay_speed'] ) ) {
			if ( is_array( $settings['gallery_slider_autoplay_speed'] ) ) {
				$gallery_slider_autoplay_speed = isset( $settings['gallery_slider_autoplay_speed']['size'] ) ? $settings['gallery_slider_autoplay_speed']['size'] : 3000;
			} else {
				$gallery_slider_autoplay_speed = $settings['gallery_slider_autoplay_speed'];
			}
		}

		$gallery_slider_autoplay_interval = 1500;
		if ( isset( $settings['gallery_slider_autoplay_interval'] ) ) {
			if ( is_array( $settings['gallery_slider_autoplay_interval'] ) ) {
				$gallery_slider_autoplay_interval = isset( $settings['gallery_slider_autoplay_interval']['size'] ) ? $settings['gallery_slider_autoplay_interval']['size'] : 1500;
			} else {
				$gallery_slider_autoplay_interval = $settings['gallery_slider_autoplay_interval'];
			}
		}

		if ( ! empty( $galleries ) && 'design-1' === $tft_design ) {
			?>
			<div class="tft-gallery-design__one tft-customizer-typography">
				<div class="tft-gallery-top-header">
					<div class="gallery-header-shape tft-heading-content">
						<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $tft_sec_title ) ) : ?>
							<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php endif; ?>
					</div>
					<!-- gallery slider navigation -->
					<?php if ( 'true' === $gallery_slider_arrows ) : ?>
						<div class="tft-slider-arrows tft-slider-arrows--mobile">
							<button type='button' class='slick-prev'>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M6 8L2 12M2 12L6 16M2 12L22 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
							<button type='button' class='slick-next'>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M18 8L22 12M22 12L18 16M22 12L2 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
						</div>
					<?php endif; ?>
				</div>
				<div class="tft-gallery-selector tft-slide-default" 
					data-loop="<?php echo esc_attr( $gallery_slider_loop ); ?>"
					data-autoplay="<?php echo esc_attr( $gallery_slider_autoplay ); ?>"
					data-autoplay-speed="<?php echo esc_attr( $gallery_slider_autoplay_speed ); ?>"
					data-speed="<?php echo esc_attr( $gallery_slider_autoplay_interval ); ?>"
					data-dots="<?php echo esc_attr( $gallery_slider_dots ); ?>"
					data-arrows="<?php echo esc_attr( $gallery_slider_arrows ); ?>"
					data-pause-on-hover="<?php echo esc_attr( $gallery_slider_pause_on_hover ); ?>"
					data-pause-on-focus="<?php echo esc_attr( $gallery_slider_pause_on_focus ); ?>"
					data-draggable="<?php echo esc_attr( $gallery_slider_draggable ); ?>">
					<?php
					foreach ( $galleries as $item ) {
						$image_url = '';
						if ( ! empty( $item['image']['url'] ) ) {
							$image_url = $item['image']['url'];
						} elseif ( is_string( $item['image'] ) ) {
							$image_url = $item['image'];
						}
						?>
						<div class="tft-single-gallery">
							<div class="tft-single-thumb">
								<?php if ( ! empty( $image_url ) ) : ?>
									<img src="<?php echo esc_url( $image_url ); ?>" alt="Image"/>
								<?php endif; ?>
							</div>
							<h3><?php echo esc_html( $item['title'] ); ?></h3>
						</div>
					<?php } ?>
				</div>
				<!-- gallery slider navigation -->
				<?php if ( 'true' === $gallery_slider_arrows ) : ?>
					<div class="tft-gallery-mobile-slider-arrow">
						<div class="tft-slider-arrows tft-slider-arrows--mobile">
							<button type='button' class='slick-prev'>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M6 8L2 12M2 12L6 16M2 12L22 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
							<button type='button' class='slick-next'>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M18 8L22 12M22 12L18 16M22 12L2 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<script>
				(function($) {
					"use strict";
					$(document).ready(function() {
						$('.tft-gallery-design__one .tft-gallery-selector').slick({
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: <?php echo esc_attr( $gallery_slider_loop ); ?>,
							autoplay: <?php echo esc_attr( $gallery_slider_autoplay ); ?>,
							autoplaySpeed: <?php echo esc_attr( $gallery_slider_autoplay_speed ); ?>,
							speed: <?php echo esc_attr( $gallery_slider_autoplay_interval ); ?>,
							dots: <?php echo esc_attr( $gallery_slider_dots ); ?>,
							arrows: <?php echo esc_attr( $gallery_slider_arrows ); ?>,
							pauseOnHover: <?php echo esc_attr( $gallery_slider_pause_on_hover ); ?>,
							pauseOnFocus: <?php echo esc_attr( $gallery_slider_pause_on_focus ); ?>,
							draggable: <?php echo esc_attr( $gallery_slider_draggable ); ?>,
							prevArrow: ".tft-gallery-design__one .slick-prev",
							nextArrow: ".tft-gallery-design__one .slick-next",
							variableWidth: true,
							adaptiveHeight: true,
							responsive: [
								{
									breakpoint: 991,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 2
									}
								},
								{
									breakpoint: 767,
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
			<?php
		}
	}
}
