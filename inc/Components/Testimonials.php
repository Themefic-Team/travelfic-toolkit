<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Testimonials Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Testimonials widgets. Both builders call:
 *
 *   Testimonials::render( $settings, 'elementor' );
 *   Testimonials::render( $settings, 'bricks' );
 */
class Testimonials {

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( array $settings = [], string $builder = '' ): void {
		// Design style
		$tft_design = ! empty( $settings['testimonial_style'] ) ? $settings['testimonial_style'] : 'design-1';

		// Resolve texts
		$tft_sec_title    = ! empty( $settings['des_title'] ) ? $settings['des_title'] : '';
		$tft_sec_subtitle = ! empty( $settings['des_subtitle'] ) ? $settings['des_subtitle'] : '';
		$tft_sec_content  = ! empty( $settings['des_content'] ) ? $settings['des_content'] : '';

		// Resolve backdrop
		$has_backdrop           = tft_get_switcher_value( $settings, 'tft_design_3_title_backdrop', 'yes', $builder );
		$section_title_backdrop = 'yes' !== $has_backdrop ? ' tft-no-backdrop' : '';

		// Resolve background image
		$tft_testimonial_bg_url = self::get_image_url( $settings, 'testimonial_bg' );

		// Resolve slider control settings
		$slideToShow             = self::get_number( $settings, 'testimonial_design3_slider_slidetoshow', 2 );
		$design3_slide_to_scroll = self::get_number( $settings, 'testimonial_design3_slider_slidetoscroll', 1 );
		$design3_slider_nav      = ! empty( $settings['testimonial_design3_slider_navigation'] ) ? $settings['testimonial_design3_slider_navigation'] : 'arrows';

		$design3_slider_arrows = ( 'arrows' === $design3_slider_nav ) ? 'true' : 'false';
		$design3_slider_dots   = ( 'dots' === $design3_slider_nav ) ? 'true' : 'false';

		$design3_slider_autoplay          = tft_get_switcher_value( $settings, 'testimonial_design3_slider_autoplay', 'yes', $builder ) === 'yes' ? 'true' : 'false';
		$design3_slider_autoplay_speed    = self::get_number( $settings, 'testimonial_design3_slider_autoplay_speed', 3000 );
		$design3_slider_autoplay_interval = self::get_number( $settings, 'testimonial_design3_slider_autoplay_interval', 1500 );
		$design3_slider_loop              = tft_get_switcher_value( $settings, 'testimonial_design3_slider_loop', 'yes', $builder ) === 'yes' ? 'true' : 'false';
		$design3_slider_pause_on_hover    = tft_get_switcher_value( $settings, 'testimonial_design3_slider_pause_on_hover', 'no', $builder ) === 'yes' ? 'true' : 'false';
		$design3_slider_pause_on_focus    = tft_get_switcher_value( $settings, 'testimonial_design3_slider_pause_on_focus', 'no', $builder ) === 'yes' ? 'true' : 'false';
		$design3_slider_rtl              = tft_get_switcher_value( $settings, 'testimonial_design3_slider_rtl', 'no', $builder ) === 'yes' ? 'true' : 'false';
		$design3_slider_draggable         = tft_get_switcher_value( $settings, 'testimonial_design3_slider_draggable', 'yes', $builder ) === 'yes' ? 'true' : 'false';

		// Post counts to determine slider disable class
		$postCount = 0;
		if ( 'design-3' === $tft_design && isset( $settings['testimonials_design3_section'] ) && is_array( $settings['testimonials_design3_section'] ) ) {
			$postCount = count( $settings['testimonials_design3_section'] );
		} elseif ( isset( $settings['testimonials_section'] ) && is_array( $settings['testimonials_section'] ) ) {
			$postCount = count( $settings['testimonials_section'] );
		}

		$tftSliderDisable = false;
		$tftDisableClass  = '';
		if ( $postCount <= $slideToShow ) {
			$tftSliderDisable = true;
			$tftDisableClass  = 'tft-slider-disable';
		}

		// Rendering based on design
		if ( 'design-1' === $tft_design && ! empty( $settings['testimonials_section'] ) ) {
			?>
			<div class="tft-testimonials-design__one tft-customizer-typography">
				<div class="tft-testimonials-selector tft-slide-default">
					<?php foreach ( $settings['testimonials_section'] as $item ) : ?>
						<div class="tft-single-testimonial">
							<div class="tft-testimonials-inner">
								<div class="testimonial-header">
									<div class="person-avatar">
										<?php $img_url = self::get_image_url( $item, 'person_image' ); ?>
										<?php if ( ! empty( $img_url ) ) : ?>
											<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['person_name'] ?? '' ); ?>">
										<?php endif; ?>
									</div>
									<div class="person-info">
										<h3 class="person-name"><?php echo esc_html( $item['person_name'] ?? '' ); ?></h3>
										<h4 class="designation"><?php echo esc_html( $item['designation'] ?? '' ); ?></h4>
									</div>
								</div>
								<div class="testimonial-body">
									<p class="tft-content"><?php echo esc_html( $item['testimonials_review'] ?? '' ); ?></p>
								</div>
								<div class="testimonial-footer">
									<?php self::testimonials_rattings( $item['rate'] ?? '' ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="tft-slider-arrows tft-slider-arrows--mobile">
					<button type='button' class='slick-prev'>
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
							<path d="M15.9999 21.3334L5.33325 32M5.33325 32L15.9999 42.6667M5.33325 32L58.6666 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<button type='button' class='slick-next'>
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
							<path d="M47.9999 21.3334L58.6666 32M58.6666 32L47.9999 42.6667M58.6666 32L5.33325 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
			</div>
			<script>
				(function($) {
					"use strict";
					$(document).ready(function() {
						$(".tft-testimonials-design__one .tft-testimonials-selector").slick({
							slidesToShow: 3,
							slidesToScroll: 1,
							autoplay: true,
							autoplaySpeed: 6000,
							speed: 700,
							dots: false,
							pauseOnHover: true,
							infinite: true,
							cssEase: "linear",
							arrows: true,
							prevArrow: ".tft-testimonials-design__one .slick-prev",
							nextArrow: ".tft-testimonials-design__one .slick-next",
							responsive: [{
									breakpoint: 991,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										infinite: true,
										dots: false,
									},
								},
								{
									breakpoint: 767,
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
		} elseif ( 'design-2' === $tft_design && ! empty( $settings['testimonials_section'] ) ) {
			?>
			<div class="tft-testimonials-design__two">
				<div class="tft-testimonial-top-header">
					<div class="testimonial-header-shape tft-heading-content">
						<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $tft_sec_title ) ) : ?>
							<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php endif; ?>
					</div>
				</div>
				<div class="tft-testimonials-sliders" style="background-image: url(<?php echo esc_url( $tft_testimonial_bg_url ); ?>);">
					<div class="tft-testimonials-slides">
						<?php foreach ( $settings['testimonials_section'] as $item ) : ?>
							<div class="tft-single-testimonial">
								<div class="tft-testimonials-inner">
									<div class="testimonial-author-image">
										<?php $img_url = self::get_image_url( $item, 'person_image' ); ?>
										<?php if ( ! empty( $img_url ) ) : ?>
											<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['person_name'] ?? '' ); ?>">
										<?php else : ?>
											<img src="<?php echo esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' ); ?>" alt="Placeholder">
										<?php endif; ?>
										<svg width="61" height="49" viewBox="0 0 61 49" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g id="content">
												<path id="Rectangle 2190" d="M36.4167 36.3333C36.4167 30.755 36.4167 27.9659 38.1497 26.233C39.8827 24.5 42.6718 24.5 48.2501 24.5C53.8284 24.5 56.6175 24.5 58.3505 26.233C60.0834 27.9659 60.0834 30.755 60.0834 36.3333C60.0834 41.9116 60.0834 44.7008 58.3505 46.4337C56.6175 48.1667 53.8284 48.1667 48.2501 48.1667C42.6718 48.1667 39.8827 48.1667 38.1497 46.4337C36.4167 44.7008 36.4167 41.9116 36.4167 36.3333Z" stroke="#99948D" stroke-width="1.5" />
												<path id="Rectangle 2191" d="M36.4167 36.3359V24.0963C36.4167 13.2482 43.8591 4.04822 54.1667 0.835938" stroke="#99948D" stroke-width="1.5" stroke-linecap="round" />
												<path id="Rectangle 2192" d="M0.916748 36.3333C0.916748 30.755 0.916748 27.9659 2.6497 26.233C4.38265 24.5 7.17179 24.5 12.7501 24.5C18.3284 24.5 21.1175 24.5 22.8505 26.233C24.5834 27.9659 24.5834 30.755 24.5834 36.3333C24.5834 41.9116 24.5834 44.7008 22.8505 46.4337C21.1175 48.1667 18.3284 48.1667 12.7501 48.1667C7.17179 48.1667 4.38265 48.1667 2.6497 46.4337C0.916748 44.7008 0.916748 41.9116 0.916748 36.3333Z" stroke="#99948D" stroke-width="1.5" />
												<path id="Rectangle 2193" d="M0.916748 36.3359V24.0963C0.916748 13.2482 8.35906 4.04822 18.6667 0.835938" stroke="#99948D" stroke-width="1.5" stroke-linecap="round" />
											</g>
										</svg>
									</div>
									<div class="testimonial-review">
										<p class="tft-content"><?php echo wp_kses_post( travelfic_character_limit( $item['testimonials_review'] ?? '', 100 ) ); ?></p>
									</div>
									<div class="testimonial-author">
										<h3 class="person-name"><?php echo esc_html( $item['person_name'] ?? '' ); ?></h3>
										<h4 class="designation"><?php echo esc_html( $item['designation'] ?? '' ); ?></h4>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<script>
				(function($) {
					$(document).ready(function() {
						$('.tft-testimonials-design__two .tft-testimonials-slides').slick({
							dots: true,
							arrows: false,
							infinite: true,
							speed: 1000,
							autoplaySpeed: 3000,
							slidesToShow: 3,
							slidesToScroll: 1,
							centerMode: <?php echo ! empty( $settings['testimonials_section'] ) && count( $settings['testimonials_section'] ) > 3 ? 'true' : 'false'; ?>,
							responsive: [{
									breakpoint: 1280,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										infinite: true,
									}
								},
								{
									breakpoint: 866,
									settings: {
										slidesToShow: 1,
										slidesToScroll: 1
									}
								},
								{
									breakpoint: 480,
									settings: {
										slidesToShow: 1,
										slidesToScroll: 1,
										centerMode: false
									}
								}
							]
						});
					});
				}(jQuery));
			</script>
			<?php
		} elseif ( 'design-3' === $tft_design && ! empty( $settings['testimonials_design3_section'] ) ) {
			?>
			<div class="tft-testimonials-design__three" style="background-image: url(<?php echo esc_url( $tft_testimonial_bg_url ); ?>);">
				<div class="container">
					<div class="tft-testimonials-content">
						<div class="tft-heading-content">
							<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
								<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $tft_sec_title ) ) : ?>
								<h2 class="tft-section-title tft-title-shape <?php echo esc_attr( $section_title_backdrop ); ?>"><?php echo esc_html( $tft_sec_title ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $tft_sec_content ) ) : ?>
								<div class="tft-section-content">
									<?php echo wp_kses_post( $tft_sec_content ); ?>
								</div>
							<?php endif; ?>

							<?php if ( ! $tftSliderDisable && 'true' === $design3_slider_arrows ) : ?>
								<div class="tft-slider-arrows tft-slider-arrows--desktop">
									<button type="button" class="tft-slider-prev tft-arrow tft-bg-hover-primary">
										<i class="ri-arrow-left-line"></i>
									</button>
									<button type="button" class="tft-slider-next tft-arrow tft-bg-hover-primary">
										<i class="ri-arrow-right-line"></i>
									</button>
								</div>
							<?php endif; ?>
						</div>
						<div class="tft-testimonials-sliders <?php echo esc_attr( $tftDisableClass ); ?>">
							<div class="tft-testimonials-slides"
								data-slides-to-show="<?php echo esc_attr( $slideToShow ); ?>"
								data-slides-to-scroll="<?php echo esc_attr( $design3_slide_to_scroll ); ?>"
								data-loop="<?php echo esc_attr( $design3_slider_loop ); ?>"
								data-autoplay="<?php echo esc_attr( $design3_slider_autoplay ); ?>"
								data-autoplay-speed="<?php echo esc_attr( $design3_slider_autoplay_speed ); ?>"
								data-speed="<?php echo esc_attr( $design3_slider_autoplay_interval ); ?>"
								data-dots="<?php echo esc_attr( $design3_slider_dots ); ?>"
								data-arrows="<?php echo esc_attr( $design3_slider_arrows ); ?>"
								data-pause-on-hover="<?php echo esc_attr( $design3_slider_pause_on_hover ); ?>"
								data-pause-on-focus="<?php echo esc_attr( $design3_slider_pause_on_focus ); ?>"
								data-rtl="<?php echo esc_attr( $design3_slider_rtl ); ?>"
								data-draggable="<?php echo esc_attr( $design3_slider_draggable ); ?>">
								<?php foreach ( $settings['testimonials_design3_section'] as $item ) : ?>
									<div class="tft-single-testimonial">
										<div class="tft-testimonials-inner">
											<div class="testimonial-review">
												<p><?php echo wp_kses_post( $item['testimonials_review'] ?? '' ); ?></p>
											</div>
											<div class="testimonial-author">
												<div class="testimonial-author-image">
													<?php $img_url = self::get_image_url( $item, 'person_image' ); ?>
													<?php if ( ! empty( $img_url ) ) : ?>
														<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['person_name'] ?? '' ); ?>">
													<?php else : ?>
														<img src="<?php echo esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' ); ?>" alt="Placeholder">
													<?php endif; ?>
												</div>
												<div class="testimonial-author-info">
													<h4 class="person-name"><?php echo esc_html( $item['person_name'] ?? '' ); ?></h4>
													<p class="designation"><?php echo esc_html( $item['designation'] ?? '' ); ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<!-- responsive view -->
						<?php if ( ! $tftSliderDisable && 'true' === $design3_slider_arrows ) : ?>
							<div class="tft-slider-arrows tft-slider-arrows--mobile">
								<button type="button" class="tft-slider-prev tft-arrow">
									<i class="ri-arrow-left-line"></i>
								</button>
								<button type="button" class="tft-slider-next tft-arrow">
									<i class="ri-arrow-right-line"></i>
								</button>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<script>
				(function($) {
					$(document).ready(function() {
						<?php if ( ! $tftSliderDisable ) : ?>
							$('.tft-testimonials-design__three .tft-testimonials-slides').slick({
								slidesToShow: <?php echo esc_attr( $slideToShow ); ?>,
								slidesToScroll: <?php echo esc_attr( $design3_slide_to_scroll ); ?>,
								infinite: <?php echo esc_attr( $design3_slider_loop ); ?>,
								autoplay: <?php echo esc_attr( $design3_slider_autoplay ); ?>,
								autoplaySpeed: <?php echo esc_attr( $design3_slider_autoplay_speed ); ?>,
								speed: <?php echo esc_attr( $design3_slider_autoplay_interval ); ?>,
								dots: <?php echo esc_attr( $design3_slider_dots ); ?>,
								arrows: <?php echo esc_attr( $design3_slider_arrows ); ?>,
								pauseOnHover: <?php echo esc_attr( $design3_slider_pause_on_hover ); ?>,
								pauseOnFocus: <?php echo esc_attr( $design3_slider_pause_on_focus ); ?>,
								rtl: <?php echo esc_attr( $design3_slider_rtl ); ?>,
								draggable: <?php echo esc_attr( $design3_slider_draggable ); ?>,
								prevArrow: $('.tft-testimonials-design__three .tft-slider-prev'),
								nextArrow: $('.tft-testimonials-design__three .tft-slider-next'),
								responsive: [{
										breakpoint: 1199,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1
										}
									},
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
									},
								]
							});
						<?php endif; ?>
					});
				}(jQuery));
			</script>
			<?php
		} elseif ( 'design-4' === $tft_design && ! empty( $settings['testimonials_design4_list'] ) ) {
			?>
			<div class="tft-testimonials-design__four tft-customizer-typography">
				<div class="tft-testimonials-selector tft-slide-default"
					data-loop="<?php echo esc_attr( $design3_slider_loop ); ?>"
					data-autoplay="<?php echo esc_attr( $design3_slider_autoplay ); ?>"
					data-autoplay-speed="<?php echo esc_attr( $design3_slider_autoplay_speed ); ?>"
					data-speed="<?php echo esc_attr( $design3_slider_autoplay_interval ); ?>"
					data-dots="<?php echo esc_attr( $design3_slider_dots ); ?>"
					data-arrows="<?php echo esc_attr( $design3_slider_arrows ); ?>"
					data-pause-on-hover="<?php echo esc_attr( $design3_slider_pause_on_hover ); ?>"
					data-pause-on-focus="<?php echo esc_attr( $design3_slider_pause_on_focus ); ?>"
					data-rtl="<?php echo esc_attr( $design3_slider_rtl ); ?>"
					data-draggable="<?php echo esc_attr( $design3_slider_draggable ); ?>">
					<?php foreach ( $settings['testimonials_design4_list'] as $item ) : ?>
						<div class="tft-single-testimonial">
							<div class="tft-testimonials-inner">
								<div class="testimonial-header">
									<div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
									<div class="testimonial-date"><?php echo esc_html( $item['post_date'] ?? '' ); ?></div>
								</div>
								<div class="testimonial-body">
									<h3 class="tft-content"><?php echo esc_html( $item['testimonials_review'] ?? '' ); ?></h3>
								</div>
								<div class="testimonial-footer">
									<div class="user-info">
										<div class="person-avatar">
											<?php $img_url = self::get_image_url( $item, 'person_image' ); ?>
											<?php if ( ! empty( $img_url ) ) : ?>
												<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['person_name'] ?? '' ); ?>">
											<?php endif; ?>
										</div>
										<div class="person-info">
											<div class="person-name"><?php echo esc_html( $item['person_name'] ?? '' ); ?></div>
											<div class="designation"><?php echo esc_html( $item['designation'] ?? '' ); ?></div>
										</div>
									</div>

									<div class="testimonial-rating">
										<h5><?php echo esc_html( $item['rate'] ?? '5' ) . '.0'; ?></h5>
										<span class="rating"><?php self::testimonials_rattings( $item['rate'] ?? '' ); ?></span>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="tft-slider-arrows tft-slider-arrows--mobile">
					<button type='button' class='slick-prev'>
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
							<path d="M15.9999 21.3334L5.33325 32M5.33325 32L15.9999 42.6667M5.33325 32L58.6666 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<button type='button' class='slick-next'>
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
							<path d="M47.9999 21.3334L58.6666 32M58.6666 32L47.9999 42.6667M58.6666 32L5.33325 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
			</div>
			<script>
				(function($) {
					"use strict";
					$(document).ready(function() {
						$(".tft-testimonials-design__four .tft-testimonials-selector").slick({
							slidesToShow: 3,
							slidesToScroll: 1,
							autoplay: true,
							centerMode: true,
							centerPadding: "100px",
							autoplaySpeed: 6000,
							speed: 700,
							dots: false,
							pauseOnHover: true,
							infinite: true,
							cssEase: "linear",
							arrows: true,
							prevArrow: ".tft-testimonials-design__four .slick-prev",
							nextArrow: ".tft-testimonials-design__four .slick-next",
							responsive: [{
									breakpoint: 1200,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										centerPadding: "40px",
									},
								},
								{
									breakpoint: 991,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										centerMode: false,
									},
								},
								{
									breakpoint: 600,
									settings: {
										slidesToShow: 1,
										slidesToScroll: 1,
										centerMode: false,
									},
								},
							],
						});
					});
				}(jQuery));
			</script>
			<?php
		} elseif ( 'design-5' === $tft_design && ! empty( $settings['testimonials_design5_list'] ) ) {
			?>
			<div class="tft-testimonials-design__five tft-customizer-typography">
				<div class="tft-testimonial-top-header">
					<div class="testimonial-header-shape tft-heading-content">
						<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $tft_sec_title ) ) : ?>
							<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php endif; ?>
					</div>
					<?php if ( 'true' === $design3_slider_arrows ) : ?>
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
				<div class="tft-testimonials-selector tft-slide-default">
					<?php foreach ( $settings['testimonials_design5_list'] as $item ) : ?>
						<div class="tft-single-testimonial">
							<div class="testimonial-header">
								<div class="quote-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="35" viewBox="0 0 19 35" fill="none">
										<path d="M18.5 0H0V35L18.5 0Z"/>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="35" viewBox="0 0 19 35" fill="none">
										<path d="M18.5 0H0V35L18.5 0Z"/>
									</svg>
								</div>
								<h3><?php echo wp_kses_post( $item['testimonials_review_title'] ?? '' ); ?></h3>
							</div>
							<div class="testimonial-body">
								<p class="tft-content"><?php echo esc_html( $item['testimonials_review'] ?? '' ); ?></p>
							</div>
							<div class="testimonial-footer">
								<div class="testimonial-rating">
									<span class="rating"><?php self::testimonials_rattings( $item['rate'] ?? '' ); ?></span>
								</div>
								<div class="user-info">
									<?php $img_url = self::get_image_url( $item, 'person_image' ); ?>
									<?php if ( ! empty( $img_url ) ) : ?>
										<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['person_name'] ?? '' ); ?>">
									<?php endif; ?>
									<div class="person-name"><?php echo esc_html( $item['person_name'] ?? '' ); ?></div>
									<div class="designation"><?php echo esc_html( $item['designation'] ?? '' ); ?></div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( 'true' === $design3_slider_arrows ) : ?>
					<div class="tft-testimonial-mobile-slider-arrow">
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
						$(".tft-testimonials-design__five .tft-testimonials-selector").slick({
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: <?php echo esc_attr( $design3_slider_loop ); ?>,
							autoplay: <?php echo esc_attr( $design3_slider_autoplay ); ?>,
							autoplaySpeed: <?php echo esc_attr( $design3_slider_autoplay_speed ); ?>,
							speed: <?php echo esc_attr( $design3_slider_autoplay_interval ); ?>,
							dots: <?php echo esc_attr( $design3_slider_dots ); ?>,
							arrows: <?php echo esc_attr( $design3_slider_arrows ); ?>,
							pauseOnHover: <?php echo esc_attr( $design3_slider_pause_on_hover ); ?>,
							pauseOnFocus: <?php echo esc_attr( $design3_slider_pause_on_focus ); ?>,
							rtl: <?php echo esc_attr( $design3_slider_rtl ); ?>,
							draggable: <?php echo esc_attr( $design3_slider_draggable ); ?>,
							cssEase: "linear",
							prevArrow: ".tft-testimonials-design__five .slick-prev",
							nextArrow: ".tft-testimonials-design__five .slick-next",
							variableWidth: true,
							adaptiveHeight: true,
							responsive: [
								{
									breakpoint: 991,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										centerMode: false,
									},
								},
								{
									breakpoint: 600,
									settings: {
										slidesToShow: 1,
										slidesToScroll: 1,
										centerMode: false,
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

	/**
	 * Render stars for ratings.
	 */
	private static function testimonials_rattings( $rate ) {
		if ( $rate ) {
			$rate_val = (int) $rate;
			for ( $i = 1; $i <= $rate_val; $i++ ) {
				echo '<i class="fas fa-star"></i>';
			}
		}
	}

	/**
	 * Safe number helper.
	 */
	private static function get_number( array $settings, string $key, int $default = 0 ): int {
		$val = $settings[ $key ] ?? $default;
		if ( is_array( $val ) && isset( $val['size'] ) ) {
			return (int) $val['size'];
		}
		return (int) $val;
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
