<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Slider Hero Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Hero widgets. Both builders call:
 *
 *   SliderHero::render( $settings, 'elementor' );
 *   SliderHero::render( $settings, 'bricks' );
 *
 * All builder-specific normalisation happens inside this class so that
 * the HTML output is maintained in a single place.
 */
class SliderHero {

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( array $settings = [], string $builder = '' ): void {

		$design = ! empty( $settings['slider_style'] ) ? $settings['slider_style'] : 'design-1';

		// Build the [tf_search_form] shortcode tab-title attributes.
		$tab_attrs  = self::get_tab_attrs( $settings );

		// Resolve the search-box enabled flag (differs per builder).
		$show_search = self::get_bool( $settings, 'search_box_switcher', $builder );

		// Resolve banner content.
		$banner_title       = ! empty( $settings['banner_title'] )       ? $settings['banner_title']       : '';
		$banner_description = ! empty( $settings['banner_description'] ) ? $settings['banner_description'] : '';
		$banner_image_url   = self::get_image_url( $settings, 'banner_image' );

		// Dispatch to per-design renderer.
		switch ( $design ) {
			case 'design-2':
				self::render_design_2( $settings, $builder, $banner_title, $banner_image_url, $show_search, $tab_attrs );
				break;
			case 'design-3':
				self::render_design_3( $settings, $builder, $banner_title, $banner_image_url, $show_search, $tab_attrs );
				break;
			case 'design-4':
				self::render_design_4( $settings, $builder, $banner_image_url, $show_search, $tab_attrs );
				break;
			case 'design-5':
				self::render_design_5( $settings, $builder, $banner_title, $banner_description, $banner_image_url );
				break;
			default: // design-1
				self::render_design_1( $settings, $builder, $show_search, $tab_attrs );
				break;
		}
	}

	// -------------------------------------------------------------------------
	// Design renderers
	// -------------------------------------------------------------------------

	/** Design 2 – full-width background image with centred title + search box */
	private static function render_design_2( array $settings, string $builder, string $banner_title, string $banner_image_url, bool $show_search, string $tab_attrs ): void {
		$type = self::get_type( $settings );
		?>
		<div class="tft-hero-design__two tft-hero-wrapper"
		     style="background-image: url(<?php echo esc_url( $banner_image_url ); ?>);">
			<div class="tft-hero-content">
				<?php if ( ! empty( $banner_title ) ) : ?>
					<div class="tft-content-box">
						<h1><?php echo wp_kses_post( $banner_title ); ?></h1>
					</div>
				<?php endif; ?>
				<?php if ( $show_search ) : ?>
					<div class="tft-search-form">
						<?php echo do_shortcode( '[tf_search_form type="' . esc_attr( $type ) . '" ' . $tab_attrs . 'design="2"]' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/** Design 3 – full-width background image with left-aligned hero content box + search */
	private static function render_design_3( array $settings, string $builder, string $banner_title, string $banner_image_url, bool $show_search, string $tab_attrs ): void {
		$type = self::get_type( $settings );
		?>
		<div class="tft-hero-design__three tft-hero-wrapper"
		     style="background-image: url(<?php echo esc_url( $banner_image_url ); ?>);">
			<div class="tft-hero-content-box">
				<?php if ( ! empty( $banner_title ) ) : ?>
					<div class="tft-content-box">
						<h1><?php echo wp_kses_post( $banner_title ); ?></h1>
					</div>
				<?php endif; ?>
				<?php if ( $show_search ) : ?>
					<div class="tft-search-form">
						<?php echo do_shortcode( '[tf_search_form type="' . esc_attr( $type ) . '" ' . $tab_attrs . 'design="3"]' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/** Design 4 – repeater-driven slider with social links + separate search row */
	private static function render_design_4( array $settings, string $builder, string $banner_image_url, bool $show_search, string $tab_attrs ): void {
		$type                = self::get_type( $settings );
		$social_enabled      = self::get_bool( $settings, 'social_media_switcher', $builder );

		// Slider JS options.
		$nav       = ! empty( $settings['design4_slider_navigation'] ) ? $settings['design4_slider_navigation'] : 'dots';
		$arrows    = ( 'arrows' === $nav ) ? 'true' : 'false';
		$dots      = ( 'dots'   === $nav ) ? 'true' : 'false';
		$autoplay  = self::get_bool( $settings, 'design4_slider_autoplay',       $builder ) ? 'true' : 'false';
		$ap_speed  = ! empty( $settings['design4_slider_autoplay_speed'] )    ? absint( self::get_number( $settings, 'design4_slider_autoplay_speed' ) )    : 3000;
		$ap_int    = ! empty( $settings['design4_slider_autoplay_interval'] )  ? absint( self::get_number( $settings, 'design4_slider_autoplay_interval' ) ) : 1500;
		$loop      = self::get_bool( $settings, 'design4_slider_loop',           $builder ) ? 'true' : 'false';
		$fade      = self::get_bool( $settings, 'design4_slider_animation',      $builder ) ? 'true' : 'false';
		$pause_h   = self::get_bool( $settings, 'design4_slider_pause_on_hover', $builder ) ? 'true' : 'false';
		$pause_f   = self::get_bool( $settings, 'design4_slider_pause_on_focus', $builder ) ? 'true' : 'false';
		$rtl       = self::get_bool( $settings, 'design4_slider_rtl',            $builder ) ? 'true' : 'false';
		$draggable = self::get_bool( $settings, 'design4_slider_draggable',      $builder ) ? 'true' : 'false';

		$slider_items = ! empty( $settings['design4_hero_slider_list'] ) ? $settings['design4_hero_slider_list'] : [];
		$social_items = ! empty( $settings['social_media_list'] )        ? $settings['social_media_list']        : [];
		$share_label  = ! empty( $settings['social_share_label'] )       ? $settings['social_share_label']       : '';
		?>
		<section class="tft-hero-design__four tft-hero-wrapper"
		         style="background-image: url(<?php echo esc_url( $banner_image_url ); ?>);">
			<div class="container tft-hero-design__four__container">

				<!-- Hero banner slider -->
				<div class="tft-hero-design__four__slider tft-content-box"
				     data-loop="<?php echo esc_attr( $loop ); ?>"
				     data-autoplay="<?php echo esc_attr( $autoplay ); ?>"
				     data-autoplay-speed="<?php echo absint( $ap_speed ); ?>"
				     data-speed="<?php echo absint( $ap_int ); ?>"
				     data-fade="<?php echo esc_attr( $fade ); ?>"
				     data-dots="<?php echo esc_attr( $dots ); ?>"
				     data-arrows="<?php echo esc_attr( $arrows ); ?>"
				     data-pause-on-hover="<?php echo esc_attr( $pause_h ); ?>"
				     data-pause-on-focus="<?php echo esc_attr( $pause_f ); ?>"
				     data-rtl="<?php echo esc_attr( $rtl ); ?>"
				     data-draggable="<?php echo esc_attr( $draggable ); ?>">
					<?php foreach ( $slider_items as $item ) : ?>
						<?php
						$btn_url      = self::get_link_url( $item, 'design4_slider_bttn_url' );
						$btn_target   = self::get_link_target( $item, 'design4_slider_bttn_url' );
						?>
						<div class="tft-hero-design__four__slider__item">
							<div class="tft-hero-design__four__slider__item__content">
								<?php if ( ! empty( $item['design4_slider_subtitle'] ) ) : ?>
									<h2 class="tft-hero-design__four__slider__item__content--subtitle">
										<?php echo esc_html( $item['design4_slider_subtitle'] ); ?>
									</h2>
								<?php endif; ?>
								<?php if ( ! empty( $item['design4_slider_title'] ) ) : ?>
									<h1 class="tft-hero-design__four__slider__item__content--title">
										<?php echo esc_html( $item['design4_slider_title'] ); ?>
									</h1>
								<?php endif; ?>
								<?php if ( ! empty( $item['design4_slider_bttn_txt'] ) ) : ?>
									<a href="<?php echo esc_url( $btn_url ); ?>"
									   class="tft-hero-design__four__slider__item__content--link tft-btn"
									   <?php echo esc_attr( $btn_target ); ?>>
										<?php echo esc_html( $item['design4_slider_bttn_txt'] ); ?>
										<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div><!-- /.tft-hero-design__four__slider -->

				<?php if ( 'true' === $arrows ) : ?>
					<div class="tft-hero-design__four__slider--nav">
						<button type="button" class="tft-prev-slide"><i class="ri-arrow-left-line"></i></button>
						<button type="button" class="tft-next-slide"><i class="ri-arrow-right-line"></i></button>
					</div>
				<?php endif; ?>

				<!-- Social links (design-4 only) -->
				<?php if ( $social_enabled ) : ?>
					<div class="tft-hero-design__four__social">
						<ul class="tft-hero-design__four__social__list">
							<?php foreach ( $social_items as $social ) :
								$s_url    = self::get_link_url( $social, 'social_media_url' );
								$s_target = self::get_link_target( $social, 'social_media_url' );
								$s_icon   = self::get_icon_class( $social, 'social_media_label', $builder );
								?>
								<li class="tft-hero-design__four__social__list__item">
									<a href="<?php echo esc_url( $s_url ); ?>"
									   class="tft-hero-design__four__social__list__item--link tft-bg-hover-primary"
									   <?php echo esc_attr( $s_target ); ?>>
										<span class="tft-hero-design__four__social-icon">
											<i class="<?php echo esc_attr( $s_icon ); ?>" aria-hidden="true"></i>
										</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<div class="tft-hero-design__four__social__divider"></div>
						<?php if ( ! empty( $share_label ) ) : ?>
							<div class="tft-hero-design__four__social__label">
								<?php echo esc_html( $share_label ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<!-- Mobile share label -->
				<div class="tft-hero-design__four__mobile--share">
					<?php if ( ! empty( $share_label ) ) : ?>
						<div class="tft-hero-design__four__social__label">
							<?php echo esc_html( $share_label ); ?>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</section>

		<?php if ( $show_search ) : ?>
			<div class="tft-search-form">
				<?php echo do_shortcode( '[tf_search_form type="' . esc_attr( $type ) . '" ' . $tab_attrs . 'design="4"]' ); ?>
			</div>
		<?php endif; ?>

		<!-- Slick init script for design-4 -->
		<script>
			(function ($) {
				"use strict";
				$(document).ready(function () {
					$(".tft-hero-design__four__slider").slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: <?php echo esc_js( $loop ); ?>,
						autoplay: <?php echo esc_js( $autoplay ); ?>,
						autoplaySpeed: <?php echo absint( $ap_speed ); ?>,
						speed: <?php echo absint( $ap_int ); ?>,
						fade: <?php echo esc_js( $fade ); ?>,
						dots: <?php echo esc_js( $dots ); ?>,
						arrows: <?php echo esc_js( $arrows ); ?>,
						pauseOnHover: <?php echo esc_js( $pause_h ); ?>,
						pauseOnFocus: <?php echo esc_js( $pause_f ); ?>,
						rtl: <?php echo esc_js( $rtl ); ?>,
						draggable: <?php echo esc_js( $draggable ); ?>,
						prevArrow: ".tft-hero-design__four__slider--nav .tft-prev-slide",
						nextArrow: ".tft-hero-design__four__slider--nav .tft-next-slide"
					});
				});
			}(jQuery));
		</script>
		<?php
	}

	/** Design 5 – hotel/room design with gradient overlay image and room search */
	private static function render_design_5( array $settings, string $builder, string $banner_title, string $banner_description, string $banner_image_url ): void {
		?>
		<section class="tft-hero-design__five"
		         style="background: linear-gradient(180deg, rgba(21, 61, 58, 0.30) 0%, #153D3A 100%), url(<?php echo esc_url( $banner_image_url ); ?>) lightgray 50% / cover no-repeat;">
			<div class="tft-hero-content">
				<?php if ( ! empty( $banner_title ) || ! empty( $banner_description ) ) : ?>
					<div class="tft-content-box">
						<h1><?php echo wp_kses_post( $banner_title ); ?></h1>
						<p><?php echo wp_kses_post( $banner_description ); ?></p>
					</div>
				<?php endif; ?>
				<div class="tft-search-form">
					<?php echo do_shortcode( '[tf_search_form type="room" design="5"]' ); ?>
				</div>
			</div>
		</section>
		<?php
	}

	/** Design 1 (default) – repeater slider with slick carousel + optional search row */
	private static function render_design_1( array $settings, string $builder, bool $show_search, string $tab_attrs ): void {
		$type        = self::get_type( $settings );
		$slider_list = ! empty( $settings['hero_slider_list'] ) ? $settings['hero_slider_list'] : [];

		if ( empty( $slider_list ) ) {
			return;
		}

		$rand = wp_rand( 100, 99999999 );
		$uid  = 'tft-hero-slider-selector-' . $rand;
		?>
		<!-- Slider Hero section – Design 1 -->
		<div class="tft-hero-design__one tft-hero-wrapper">
			<div class="tft-hero-slider-selector <?php echo esc_attr( $uid ); ?>">
				<?php foreach ( $slider_list as $item ) :
					$img_url  = self::get_image_url( $item, 'slider_image' );
					$btn_url  = self::get_link_url( $item, 'slider_bttn_url' );
					?>
					<div class="tft-hero-single-item">
						<div class="tft-slider-bg-img"
						     style="background-image: url(<?php echo esc_url( $img_url ); ?>);">
							<div class="tft-container tft-hero-single-item-inner tft-content-box">
								<div class="slider-inner-info">
									<div class="tft-slider-title">
										<h1 class="tft-title title-large">
											<?php echo ! empty( $item['slider_title'] ) ? esc_html( $item['slider_title'] ) : ''; ?>
										</h1>
										<?php if ( ! empty( $item['slider_subtitle'] ) ) : ?>
											<div class="tft-sub-title">
												<p class="tft-color-white"><?php echo esc_html( $item['slider_subtitle'] ); ?></p>
											</div>
										<?php endif; ?>
									</div>
									<div class="slider-button">
										<?php if ( ! empty( $btn_url ) ) : ?>
											<a class="tft-btn tft-btn_sharp tft-wh-auto tft-border-0"
											   href="<?php echo esc_url( $btn_url ); ?>">
												<div class="tft-custom-bttn">
													<span>
														<?php echo ! empty( $item['slider_bttn_txt'] ) ? esc_html( $item['slider_bttn_txt'] ) : ''; ?>
													</span>
												</div>
											</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div><!-- /.tft-hero-slider-selector -->
			<div class="slider-progress"><span></span></div>
		</div>

		<?php if ( $show_search ) : ?>
			<div class="tft-search-box tft-hero-design__one">
				<div class="tft-search-box-inner">
					<?php echo do_shortcode( '[tf_search_form type="' . esc_attr( $type ) . '" ' . $tab_attrs . ']' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<!-- Slick init script for design-1 -->
		<script>
			(function ($) {
				"use strict";
				$(document).ready(function () {
					$('.<?php echo esc_js( $uid ); ?>').slick({
						dots: false,
						infinite: true,
						slidesToShow: 1,
						fade: true,
						speed: 500,
						cssEase: 'ease-in-out',
						touchThreshold: 100,
						autoplay: false,
						arrows: true,
						prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
						nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
						autoplaySpeed: 2000
					});
				});

				// Slide counter
				var $slider = $('.<?php echo esc_js( $uid ); ?>');
				if ($slider.length) {
					var sliderCounter = document.createElement('div');
					sliderCounter.classList.add('slider__counter');
					var updateCounter = function (slick) {
						var current = slick.slickCurrentSlide() + 1;
						current = ('0000' + current).match(/\d{2}$/);
						$(sliderCounter).text(current);
					};
					$slider.on('init', function (e, slick) {
						$slider.append(sliderCounter);
						updateCounter(slick);
					});
					$slider.on('afterChange', function (e, slick) {
						updateCounter(slick);
					});
				}
			}(jQuery));
		</script>
		<?php
		do_action( 'slider_style', esc_html( $rand ) );
	}

	// -------------------------------------------------------------------------
	// Utility helpers
	// -------------------------------------------------------------------------

	/**
	 * Resolve a boolean setting that may be stored as boolean (Bricks checkbox)
	 * or as the string 'yes' (Elementor switcher).
	 */
	private static function get_bool( array $settings, string $key, string $builder ): bool {
		$val = $settings[ $key ] ?? null;
		if ( 'elementor' === $builder ) {
			return 'yes' === $val;
		}
		// Bricks: true | false
		return ! empty( $val );
	}

	/**
	 * Get a numeric value that may be stored as an integer (Bricks) or as an
	 * Elementor slider array [ 'size' => 123, 'unit' => 'px' ].
	 */
	private static function get_number( array $settings, string $key ): int {
		$val = $settings[ $key ] ?? 0;
		if ( is_array( $val ) && isset( $val['size'] ) ) {
			return (int) $val['size'];
		}
		return (int) $val;
	}

	/**
	 * Get an image URL from a setting key.
	 * Supports both array-with-url (Elementor/Bricks) and plain URL strings.
	 */
	private static function get_image_url( array $settings, string $key ): string {
		$val = $settings[ $key ] ?? '';
		if ( is_array( $val ) ) {
			return ! empty( $val['url'] ) ? $val['url'] : '';
		}
		return is_string( $val ) ? $val : '';
	}

	/**
	 * Get a link href from a nested item key.
	 * Supports both Elementor link arrays and Bricks link arrays.
	 */
	private static function get_link_url( array $item, string $key ): string {
		$link = $item[ $key ] ?? '';
		if ( is_array( $link ) ) {
			return ! empty( $link['url'] ) ? $link['url'] : '#';
		}
		return is_string( $link ) && ! empty( $link ) ? $link : '#';
	}

	/**
	 * Get target="_blank" attribute string from a link array, or empty string.
	 */
	private static function get_link_target( array $item, string $key ): string {
		$link = $item[ $key ] ?? [];
		if ( is_array( $link ) ) {
			$external = ! empty( $link['is_external'] ) || ! empty( $link['newTab'] );
			return $external ? 'target="_blank"' : '';
		}
		return '';
	}

	/**
	 * Get the icon CSS class string from a setting that may be:
	 *  - Elementor icon array: [ 'library' => 'fa-brands', 'value' => 'fab fa-facebook-f' ]
	 *  - Bricks icon array:    [ 'library' => 'fa-brands', 'icon'  => 'fab fa-facebook-f' ]
	 *  - plain string
	 */
	private static function get_icon_class( array $item, string $key, string $builder ): string {
		$icon = $item[ $key ] ?? '';
		if ( is_array( $icon ) ) {
			// Bricks stores the full class in 'icon'; Elementor uses 'value'.
			if ( 'bricks' === $builder && ! empty( $icon['icon'] ) ) {
				return $icon['icon'];
			}
			if ( 'elementor' === $builder && ! empty( $icon['value'] ) ) {
				return $icon['value'];
			}
			// Fallback: try both keys.
			return $icon['icon'] ?? $icon['value'] ?? '';
		}
		return is_string( $icon ) ? $icon : '';
	}

	/**
	 * Build the comma-separated type string for [tf_search_form].
	 */
	private static function get_type( array $settings ): string {
		$type_raw = $settings['type'] ?? [ 'all' ];
		if ( ! is_array( $type_raw ) ) {
			$type_raw = [ $type_raw ];
		}
		return implode( ',', array_filter( $type_raw ) ) ?: 'all';
	}

	/**
	 * Build the extra tab-title attribute string for [tf_search_form].
	 */
	private static function get_tab_attrs( array $settings ): string {
		$attrs = '';
		if ( ! empty( $settings['hotel_tab_title'] ) ) {
			$attrs .= 'hotel_tab_title="' . esc_attr( $settings['hotel_tab_title'] ) . '" ';
		}
		if ( ! empty( $settings['tour_tab_title'] ) ) {
			$attrs .= 'tour_tab_title="' . esc_attr( $settings['tour_tab_title'] ) . '" ';
		}
		if ( ! empty( $settings['apt_tab_title'] ) ) {
			$attrs .= 'apartment_tab_title="' . esc_attr( $settings['apt_tab_title'] ) . '" ';
		}
		if ( ! empty( $settings['car_tab_title'] ) ) {
			$attrs .= 'car_tab_title="' . esc_attr( $settings['car_tab_title'] ) . '" ';
		}
		return $attrs;
	}
}
