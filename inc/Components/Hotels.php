<?php

namespace Travelfic_Toolkit\Components;

use \Tourfic\Classes\Hotel\Pricing as Hotel_Price;
use \Tourfic\Classes\Tour\Pricing as Tour_Price;
use \Tourfic\Classes\Helper as Tourfic_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Global Hotels Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Hotels widgets. Both builders call:
 *
 *   Hotels::render( $settings, 'elementor' );
 *   Hotels::render( $settings, 'bricks' );
 */
class Hotels {

	/**
	 * Get minimum tour card price from Tourfic pricing engine with legacy fallback.
	 *
	 * @param int   $post_id     Tour post id.
	 * @param array $option_meta Tour options meta.
	 * @return float
	 */
	protected static function tft_get_tour_card_price( $post_id, $option_meta = array() ) {
		$option_meta = is_array( $option_meta ) ? $option_meta : array();
		$pricing_rule = ! empty( $option_meta['pricing'] ) ? $option_meta['pricing'] : '';
		$minimum_setting = class_exists( '\Tourfic\Classes\Helper' ) && ! empty( Tourfic_Helper::tfopt( 'tour_archive_price_minimum_settings' ) ) ? Tourfic_Helper::tfopt( 'tour_archive_price_minimum_settings' ) : 'adult';
		$disable_adult_price = ! empty( $option_meta['disable_adult_price'] );
		$disable_child_price = ! empty( $option_meta['disable_child_price'] );
		$disable_infant_price = ! empty( $option_meta['disable_infant_price'] );

		if ( class_exists( '\Tourfic\Classes\Tour\Pricing' ) ) {
			$avail_prices = Tour_Price::instance( $post_id )->get_avail_price();
			$calculated_prices = array();

			if ( 'group' === $pricing_rule && ! empty( $avail_prices['group_price'] ) ) {
				$calculated_prices[] = (float) $avail_prices['group_price'];
			}

			if ( 'person' === $pricing_rule || 'package' === $pricing_rule ) {
				if ( 'all' === $minimum_setting ) {
					if ( ! empty( $avail_prices['adult_price'] ) && ! $disable_adult_price ) {
						$calculated_prices[] = (float) $avail_prices['adult_price'];
					}
					if ( ! empty( $avail_prices['child_price'] ) && ! $disable_child_price ) {
						$calculated_prices[] = (float) $avail_prices['child_price'];
					}
				}
				if ( 'adult' === $minimum_setting && ! empty( $avail_prices['adult_price'] ) && ! $disable_adult_price ) {
					$calculated_prices[] = (float) $avail_prices['adult_price'];
				}
				if ( 'child' === $minimum_setting && ! empty( $avail_prices['child_price'] ) && ! $disable_child_price ) {
					$calculated_prices[] = (float) $avail_prices['child_price'];
				}
			}

			if ( 'package' === $pricing_rule && ! empty( $avail_prices['group_price'] ) ) {
				$calculated_prices[] = (float) $avail_prices['group_price'];
			}

			if ( ! empty( $calculated_prices ) ) {
				return (float) min( $calculated_prices );
			}

			$fallback_prices = array();

			if ( ! empty( $avail_prices['adult_price'] ) && ! $disable_adult_price ) {
				$fallback_prices[] = (float) $avail_prices['adult_price'];
			}
			if ( ! empty( $avail_prices['child_price'] ) && ! $disable_child_price ) {
				$fallback_prices[] = (float) $avail_prices['child_price'];
			}
			if ( ! empty( $avail_prices['infant_price'] ) && ! $disable_infant_price ) {
				$fallback_prices[] = (float) $avail_prices['infant_price'];
			}
			if ( ! empty( $avail_prices['group_price'] ) && ( 'group' === $pricing_rule || 'package' === $pricing_rule ) ) {
				$fallback_prices[] = (float) $avail_prices['group_price'];
			}

			if ( ! empty( $fallback_prices ) ) {
				return (float) min( $fallback_prices );
			}
		}

		if ( 'group' === $pricing_rule ) {
			return isset( $option_meta['group_price'] ) ? (float) $option_meta['group_price'] : 0;
		}

		$person_prices = array();
		$adult_price = isset( $option_meta['adult_price'] ) ? $option_meta['adult_price'] : '';
		if ( ! $disable_adult_price && '' !== $adult_price ) {
			$person_prices[] = (float) $adult_price;
		}

		$child_price = isset( $option_meta['child_price'] ) ? $option_meta['child_price'] : '';
		if ( ! $disable_child_price && '' !== $child_price ) {
			$person_prices[] = (float) $child_price;
		}

		$infant_price = isset( $option_meta['infant_price'] ) ? $option_meta['infant_price'] : '';
		if ( ! $disable_infant_price && '' !== $infant_price ) {
			$person_prices[] = (float) $infant_price;
		}

		return ! empty( $person_prices ) ? (float) min( $person_prices ) : 0;
	}

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( array $settings = [], string $builder = '' ): void {
		$tft_design = ! empty( $settings['tft_hotels_style'] ) ? $settings['tft_hotels_style'] : 'design-1';

		$tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];

		$service_type = '';
		$post_type_setting = ! empty( $settings['tf_post_type'] ) ? $settings['tf_post_type'] : 'tf_hotel';
		if ( 'tf_hotel' === $post_type_setting ) {
			$service_type = 'hotel';
		} elseif ( 'tf_tours' === $post_type_setting ) {
			$service_type = 'tour';
		} elseif ( 'tf_apartment' === $post_type_setting ) {
			$service_type = 'apartment';
		}

		if ( in_array( $service_type, $tf_disable_services ) ) {
			return;
		}

		$args = array(
			'post_type' => $post_type_setting
		);

		$featured_args = array(
			'post_type' => $post_type_setting
		);

		// Display posts in category.
		if ( ! empty( $settings['post_category'] ) ) {
			$args['category_name'] = $settings['post_category'];
			$featured_args['category_name'] = $settings['post_category'];
		}

		// Items per page
		$post_items_setting = self::get_number( $settings, 'post_items', 6 );
		if ( ! empty( $post_items_setting ) ) {
			$args['posts_per_page'] = $post_items_setting;
			$featured_args['posts_per_page'] = -1;
		}

		// Items Order By
		if ( ! empty( $settings['post_order_by'] ) ) {
			$args['orderby'] = $settings['post_order_by'];
			$featured_args['orderby'] = $settings['post_order_by'];
		}

		// Items Order
		if ( ! empty( $settings['post_order'] ) ) {
			$args['order'] = $settings['post_order'];
			$featured_args['order'] = $settings['post_order'];
		}

		$query = new \WP_Query( $args );
		$featured_query = new \WP_Query( $featured_args );

		$tft_sec_title = ! empty( $settings['tft_section_title'] ) ? $settings['tft_section_title'] : '';
		$backdrop_enabled = isset( $settings['popular_section_design2_title_backdrop'] ) ? self::get_bool( $settings, 'popular_section_design2_title_backdrop', $builder ) : true;
		$section_title_backdrop = ! $backdrop_enabled ? ' tft-no-backdrop' : '';
		$tft_sec_subtitle = ! empty( $settings['tft_section_subtitle'] ) ? $settings['tft_section_subtitle'] : '';

		$tft_posts_sec_bg_url = self::get_image_url( $settings, 'tft_posts_section_bg' );
		$tft_posts_tabs = ! empty( $settings['tft_posts_type'] ) ? $settings['tft_posts_type'] : 'alls';

		$slideToShow = self::get_number( $settings, 'tft_hotels_design2_slider_slidetoshow', 3 );
		$postCount = 0;
		// get count posts
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$postCount++;
			endwhile;
		endif;

		// disable slider
		$tftDisableClass = '';
		$tftSliderDisable = false;
		if ( $postCount < $slideToShow ) {
			$tftSliderDisable = true;
			$tftDisableClass = 'tft-slider-disable';
		}

		// slider control settings check
		$design2_slide_to_scroll = self::get_number( $settings, 'tft_hotels_design2_slider_slidetoscroll', 1 );
		$design2_slider_nav = ! empty( $settings['tft_hotels_design2_slider_navigation'] ) ? $settings['tft_hotels_design2_slider_navigation'] : 'arrows';

		$design2_slider_arrows = ( 'arrows' === $design2_slider_nav ) ? 'true' : 'false';
		$design2_slider_dots = ( 'dots' === $design2_slider_nav ) ? 'true' : 'false';

		$slider_box_hidden = ( 'true' === $design2_slider_arrows ) ? ' tft-box-hidden' : '';
		$container_max_width = ( 'true' === $design2_slider_arrows ) ? ' tft-container-width' : '';

		$design2_slider_autoplay = self::get_bool( $settings, 'tft_hotels_design2_slider_autoplay', $builder ) ? 'true' : 'false';
		$design2_slider_autoplay_speed = self::get_number( $settings, 'tft_hotels_design2_slider_autoplay_speed', 0 );
		$design2_slider_autoplay_interval = self::get_number( $settings, 'tft_hotels_design2_slider_autoplay_interval', 0 );
		$design2_slider_loop = self::get_bool( $settings, 'tft_hotels_design2_slider_loop', $builder ) ? 'true' : 'false';
		$design2_slider_pause_on_hover = self::get_bool( $settings, 'tft_hotels_design2_slider_pause_on_hover', $builder ) ? 'true' : 'false';
		$design2_slider_pause_on_focus = self::get_bool( $settings, 'tft_hotels_design2_slider_pause_on_focus', $builder ) ? 'true' : 'false';
		$design2_slider_rtl = self::get_bool( $settings, 'tft_hotels_design2_slider_rtl', $builder ) ? 'true' : 'false';
		$design2_slider_draggable = self::get_bool( $settings, 'tft_hotels_design2_slider_draggable', $builder ) ? 'true' : 'false';

		if ( 'design-1' == $tft_design ) : ?>
			<div class="tft-popular-hotels-design__one tft-customizer-typography" style="background-image: url(<?php echo esc_url( $tft_posts_sec_bg_url ); ?>);">
				<div class="tft-popular-hotel-header">
					<div class="tft-hotel-header tft-heading-content">
						<?php
						if ( ! empty( $tft_sec_subtitle ) ) { ?>
							 <h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php }
						if ( ! empty( $tft_sec_title ) ) { ?>
							<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php } ?>

						<ul>
							<?php
							if ( "alls" == $tft_posts_tabs ) { ?>
								<li data-id="all">
									<button class="tft-btn active tft-btn_sharp"><?php esc_html_e( "All", "travelfic-toolkit" ); ?></button>
								</li>
								<li data-id="featured">
									<button class="tft-btn tft-btn_gray tft-btn_sharp"><?php esc_html_e( "Featured", "travelfic-toolkit" ); ?></button>
								</li>
							<?php } elseif ( "all" == $tft_posts_tabs ) { ?>
								<li data-id="all">
									<button class="tft-btn active tft-btn_sharp"><?php esc_html_e( "All", "travelfic-toolkit" ); ?></button>
								</li>
							<?php } elseif ( "featured" == $tft_posts_tabs ) { ?>
								<li data-id="featured">
									<button class="tft-btn active tft-btn_sharp"><?php esc_html_e( "Featured", "travelfic-toolkit" ); ?></button>
								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="read-more">
						<a href="<?php echo esc_url( self::get_link_url( $settings, 'view_all_link' ) ); ?>" class="tft-btn tft-large-circle tft-wh-auto tft-flex-column">
							<?php esc_html_e( "View All", "travelfic-toolkit" ); ?>
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
									<path d="M56.7071 8.70711C57.0976 8.31658 57.0976 7.68342 56.7071 7.29289L50.3431 0.928932C49.9526 0.538408 49.3195 0.538408 48.9289 0.928932C48.5384 1.31946 48.5384 1.95262 48.9289 2.34315L54.5858 8L48.9289 13.6569C48.5384 14.0474 48.5384 14.6805 48.9289 15.0711C49.3195 15.4616 49.9526 15.4616 50.3431 15.0711L56.7071 8.70711ZM0 9H56V7H0V9Z" fill="#FDF9F4" />
								</svg>
							</span>
						</a>
					</div>
				</div>
				<div class="tft-popular-hotels-items tft-popular-hotels-selector tf-widget-all-post" style="<?php echo "alls" == $tft_posts_tabs || "all" == $tft_posts_tabs ? esc_attr( "display: grid" ) : esc_attr( "display: none" ) ?>">

					<?php if ( $query->have_posts() ) : ?>
						<?php while ( $query->have_posts() ) :
							$query->the_post(); ?>
							<?php
							// Review Query 
							$comment_args = array(
								'post_id' => get_the_ID(),
								'status'  => 'approve',
								'type'    => 'comment',
							);
							$comments_query = new \WP_Comment_Query( $comment_args );
							$comments = $comments_query->comments;
							$disable_review_sec = '';
							if ( "tf_hotel" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
								$disable_review_sec = ! empty( $option_meta['h-review'] ) ? $option_meta['h-review'] : '';
							}
							if ( "tf_tours" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
								$disable_review_sec = ! empty( $option_meta['t-review'] ) ? $option_meta['t-review'] : '';

								$tour_duration = ! empty( $option_meta['duration'] ) ? $option_meta['duration'] : '';
								$duration_time = ! empty( $option_meta['duration_time'] ) ? $option_meta['duration_time'] : '';
								$night         = ! empty( $option_meta['night'] ) ? $option_meta['night'] : false;
								$night_count   = ! empty( $option_meta['night_count'] ) ? $option_meta['night_count'] : '';
							}
							if ( "tf_apartment" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_apartment_opt' );
								$disable_review_sec = ! empty( $option_meta['disable-apartment-review'] ) ? $option_meta['disable-apartment-review'] : '';
							}
							?>
							<div class="tft-popular-single-item">
								<div class="tft-popular-single-item-inner">
									<?php
									$tft_hotel_image = ! empty( get_the_post_thumbnail_url( get_the_ID() ) ) ? esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) : esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' );
									?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="tft-popular-thumbnail" style="background-image: url(<?php echo esc_url( $tft_hotel_image ) ?>);">

									</a>
									<div class="tft-hotel-details">
										<?php if ( $comments && ! $disable_review_sec == '1' ) { ?>
											<div class="tft-ratings">
												<span class="tft-color-text">
													<i class="fas fa-star"></i>
													<span class="tft-color-text">
														<?php echo ( class_exists( "\Tourfic\App\TF_Review" ) ) ? esc_html( \Tourfic\App\TF_Review::tf_total_avg_rating( $comments ) ) : esc_html( tf_total_avg_rating( $comments ) ); ?>
													</span>
													<?php echo esc_html__( 'out of', 'tourfic' ); ?> <?php class_exists( "\Tourfic\App\TF_Review" ) ? esc_html( \Tourfic\App\TF_Review::tf_based_on_text( count( $comments ) ) ) : esc_html( tf_based_on_text( count( $comments ) ) ); ?>
												</span>
											</div>
										<?php } else { ?>
											<div class="tft-ratings ">
												<span class="tft-color-text">
													<i class="fas fa-star"></i>
													<span class="tft-color-text">
														<?php echo esc_html__( '0.0', 'tourfic' ); ?>
													</span>
													<?php echo esc_html__( 'out of 0 review', 'tourfic' ); ?>
												</span>
											</div>
										<?php } ?>
										<h3 class="tft-title<?php echo ( "Split" == ( $settings['card_title_type'] ?? 'Split' ) ) ? ' tft-title-split' : ''; ?>">
											<a href="<?php echo esc_url( get_the_permalink() ) ?>">
												<?php the_title(); ?>
											</a>
										</h3>
										<p class="tft-locations">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
												<g clip-path="url(#clip0_1443_3217)">
													<path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349" />
												</g>
												<defs>
													<clipPath id="clip0_1443_3217">
														<rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
													</clipPath>
												</defs>
											</svg>
											<span>
												<?php
												if ( "tf_hotel" == $post_type_setting ) {
													echo ! empty( tf_data_types( $option_meta['map'] )['address'] ) ? esc_html( travelfic_character_limit( tf_data_types( $option_meta['map'] )['address'], 40 ) ) : '';
												}
												if ( "tf_tours" == $post_type_setting ) {
													echo ! empty( tf_data_types( $option_meta['location'] )['address'] ) ? esc_html( travelfic_character_limit( tf_data_types( $option_meta['location'] )['address'], 40 ) ) : '';
												}
												if ( "tf_apartment" == $post_type_setting ) {
													echo ! empty( tf_data_types( $option_meta['map'] )['address'] ) ? esc_html( travelfic_character_limit( tf_data_types( $option_meta['map'] )['address'], 40 ) ) : '';
												}
												?>
											</span>
										</p>

										<div class="tf-others-details" style="<?php echo "tf_tours" == $post_type_setting ? esc_attr( 'margin-top: 0px' ) : ''; ?>">
											<?php
											if ( "tf_tours" == $post_type_setting ) {
												if ( ! empty( $tour_duration ) ) {
											?>
													<p class="tour-time">
														<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
															<path d="M10.0001 2.16406C14.6024 2.16406 18.3334 5.89502 18.3334 10.4974C18.3334 15.0997 14.6024 18.8307 10.0001 18.8307C5.39771 18.8307 1.66675 15.0997 1.66675 10.4974H3.33341C3.33341 14.1793 6.31818 17.1641 10.0001 17.1641C13.682 17.1641 16.6667 14.1793 16.6667 10.4974C16.6667 6.8155 13.682 3.83073 10.0001 3.83073C7.7086 3.83073 5.68714 4.98685 4.48717 6.7476L6.66675 6.7474V8.41406H1.66675V3.41406H3.33341L3.33332 5.49671C4.8537 3.47302 7.27402 2.16406 10.0001 2.16406ZM10.8334 6.33073L10.8332 10.1516L13.5356 12.8544L12.3571 14.0329L9.16658 10.8416L9.16675 6.33073H10.8334Z" fill="#595349" />
														</svg>
														<?php echo esc_html( $tour_duration ); ?>
														<?php
														if ( $tour_duration > 1 ) {
															$dur_string         = 's';
															$duration_time_html = $duration_time . $dur_string;
														} else {
															$duration_time_html = $duration_time;
														}
														echo " " . esc_html( $duration_time_html );
														?>
														<?php if ( ! empty( $night ) ) { ?>
															<span>
																<?php echo esc_html( $night_count ); ?>
																<?php
																if ( ! empty( $night_count ) ) {
																	if ( $night_count > 1 ) {
																		echo esc_html__( 'Nights', 'travelfic-toolkit' );
																	} else {
																		echo esc_html__( 'Night', 'travelfic-toolkit' );
																	}
																}
																?>
															</span>
														<?php } ?>
													</p>
											<?php }
											} ?>
											<?php
											if ( "tf_hotel" == $post_type_setting ) {
												$rooms = ! empty( $option_meta['room'] ) ? $option_meta['room'] : '';
												if ( ! empty( $rooms ) ) {
													$rm_features = [];
													foreach ( $rooms as $key => $room ) {
														//merge for each room's selected features
														if ( ! empty( $room['features'] ) ) {
															$rm_features = array_unique( array_merge( $rm_features, $room['features'] ) );
														}
													}
													if ( ! empty( $rm_features ) ) { ?>
														<ul>
															<?php
															$tft_limit = 1;
															foreach ( $rm_features as $feature ) {
																if ( $tft_limit < 7 ) {
																	$term = get_term_by( 'id', $feature, 'hotel_feature' );

																	$room_f_meta = get_term_meta( $feature, 'tf_hotel_feature', true );
																	$room_feature_icon = '';
																	if ( ! empty( $room_f_meta ) ) {
																		$room_icon_type = ! empty( $room_f_meta['icon-type'] ) ? $room_f_meta['icon-type'] : '';
																	}
																	if ( ! empty( $room_icon_type ) && $room_icon_type == 'fa' && ! empty( $room_f_meta['icon-fa'] ) ) {
																		$room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
																	} elseif ( ! empty( $room_icon_type ) && $room_icon_type == 'c' && ! empty( $room_f_meta['icon-c'] ) ) {
																		$room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
																	}
															?>
																	<li>
																		<?php echo ! empty( $room_feature_icon ) ? wp_kses_post( $room_feature_icon ) : ''; ?>
																		<?php echo ! empty( $term->name ) ? esc_html( $term->name ) : ''; ?>
																	</li>
															<?php
																}
																$tft_limit++;
															} ?>
														</ul>
											<?php
													}
												}
											}
											?>
											<?php
											if ( "tf_apartment" == $post_type_setting ) {
												$amenitiess = ! empty( $option_meta['amenities'] ) ? tf_data_types( $option_meta['amenities'] ) : '';
												if ( ! empty( $amenitiess ) ) {
													$rm_features = [];
													foreach ( $amenitiess as $key => $apartment ) {
														//merge for each room's selected features
														if ( ! empty( $apartment['feature'] ) ) {
															$rm_features[] = $apartment['feature'];
														}
													}
													if ( ! empty( $rm_features ) ) { ?>
														<ul>
															<?php
															$tft_limit = 1;
															foreach ( $rm_features as $feature ) {
																if ( $tft_limit < 7 ) {
																	$term = get_term_by( 'id', $feature, 'apartment_feature' );

																	$apartment_f_meta = get_term_meta( $feature, 'tf_apartment_feature', true );
																	$apartment_feature_icon = '';
																	if ( ! empty( $apartment_f_meta ) ) {
																		$apartment_icon_type = ! empty( $apartment_f_meta['icon-type'] ) ? $apartment_f_meta['icon-type'] : '';
																	}
																	if ( ! empty( $apartment_icon_type ) && $apartment_icon_type == 'fa' && ! empty( $apartment_f_meta['icon-fa'] ) ) {
																		$apartment_feature_icon = '<i class="' . $apartment_f_meta['icon-fa'] . '"></i>';
																	} elseif ( ! empty( $apartment_icon_type ) && $apartment_icon_type == 'c' && ! empty( $apartment_f_meta['icon-c'] ) ) {
																		$apartment_feature_icon = '<img src="' . $apartment_f_meta['icon-c'] . '" style="min-width: ' . $apartment_f_meta['dimention'] . 'px; height: ' . $apartment_f_meta['dimention'] . 'px;" />';
																	}
															?>
																	<li>
																		<?php echo ! empty( $apartment_feature_icon ) ? wp_kses_post( $apartment_feature_icon ) : ''; ?>
																		<?php echo ! empty( $term->name ) ? esc_html( $term->name ) : ''; ?>
																	</li>
															<?php
																}
																$tft_limit++;
															} ?>
														</ul>
											<?php
													}
												}
											}
											?>

											<a href="<?php echo esc_url( get_permalink() ); ?>" class="tft-btn tft-wh-auto tft-btn_sharp btn-view-details"><?php esc_html_e( "View details", "travelfic-toolkit" ); ?></a>
										</div>
									</div>
								</div>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>

				<div class="tft-popular-hotels-items tft-popular-hotels-selector tf-widget-featured-post" style="<?php echo "featured" == $tft_posts_tabs ? esc_attr( "display: grid" ) : esc_attr( "display: none" ) ?>">

					<?php
					$featured_posts = [];
					if ( $featured_query->have_posts() ) : ?>
						<?php while ( $featured_query->have_posts() ) :
							$featured_query->the_post();
							$tf_featured_post = false;
							if ( "tf_hotel" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
								$tf_featured_post = ! empty( $option_meta['featured'] ) ? $option_meta['featured'] : '';
							}
							if ( "tf_tours" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
								$tf_featured_post = ! empty( $option_meta['tour_as_featured'] ) ? $option_meta['tour_as_featured'] : '';
							}
							if ( "tf_apartment" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_apartment_opt' );
								$tf_featured_post = ! empty( $option_meta['apartment_as_featured'] ) ? $option_meta['apartment_as_featured'] : '';
							}
							if ( $tf_featured_post ) {
								$featured_posts[] = get_the_ID();
							}
						?>

						<?php endwhile; ?>
					<?php endif;
					$filter_args = array(
						'post_type'      => $post_type_setting,
						'post_status'    => 'publish',
						'posts_per_page' => $post_items_setting,
						'post__in'       => ! empty( $featured_posts ) ? $featured_posts : [0],
					);
					$result_query = new \WP_Query( $filter_args );
					?>
					<?php if ( $result_query->have_posts() ) : ?>
						<?php while ( $result_query->have_posts() ) :
							$result_query->the_post(); ?>
							<?php
							// Review Query 
							$comment_args = array(
								'post_id' => get_the_ID(),
								'status'  => 'approve',
								'type'    => 'comment',
							);
							$comments_query = new \WP_Comment_Query( $comment_args );
							$comments = $comments_query->comments;
							$disable_review_sec = '';

							if ( "tf_hotel" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
								$disable_review_sec = ! empty( $option_meta['h-review'] ) ? $option_meta['h-review'] : '';
							}
							if ( "tf_tours" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
								$disable_review_sec = ! empty( $option_meta['t-review'] ) ? $option_meta['t-review'] : '';

								$tour_duration = ! empty( $option_meta['duration'] ) ? $option_meta['duration'] : '';
								$duration_time = ! empty( $option_meta['duration_time'] ) ? $option_meta['duration_time'] : '';
								$night         = ! empty( $option_meta['night'] ) ? $option_meta['night'] : false;
								$night_count   = ! empty( $option_meta['night_count'] ) ? $option_meta['night_count'] : '';
							}
							if ( "tf_apartment" == $post_type_setting ) {
								$option_meta = travelfic_get_meta( get_the_ID(), 'tf_apartment_opt' );
								$disable_review_sec = ! empty( $option_meta['disable-apartment-review'] ) ? $option_meta['disable-apartment-review'] : '';
							}
							?>
							<div class="tft-popular-single-item">
								<div class="tft-popular-single-item-inner">
									<?php
									$tft_hotel_image = ! empty( get_the_post_thumbnail_url( get_the_ID() ) ) ? esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) : esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' );
									?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="tft-popular-thumbnail" style="background-image: url(<?php echo esc_url( $tft_hotel_image ) ?>);">
									</a>
									<div class="tft-hotel-details">
										<?php if ( $comments && ! $disable_review_sec == '1' ) { ?>
											<div class="tft-ratings">
												<span>
													<i class="fas fa-star"></i>
													<span>
														<?php echo ( class_exists( "\Tourfic\App\TF_Review" ) ) ? esc_html( \Tourfic\App\TF_Review::tf_total_avg_rating( $comments ) ) : esc_html( tf_total_avg_rating( $comments ) ); ?>
													</span>
													out of <?php class_exists( "\Tourfic\App\TF_Review" ) ? esc_html( \Tourfic\App\TF_Review::tf_based_on_text( count( $comments ) ) ) : esc_html( tf_based_on_text( count( $comments ) ) ); ?>
												</span>
											</div>
										<?php } else { ?>
											<div class="tft-ratings">
												<span>
													<i class="fas fa-star"></i>
													<span>
														0.0
													</span>
													out of 0 review
												</span>
											</div>
										<?php } ?>
										<h3 class="tft-title">
											<a href="<?php echo esc_url( get_the_permalink() ) ?>">
												<?php the_title(); ?>
											</a>
										</h3>
										<p class="tft-locations">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
												<g clip-path="url(#clip0_1443_3217)">
													<path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349" />
												</g>
												<defs>
													<clipPath id="clip0_1443_3217">
														<rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
													</clipPath>
												</defs>
											</svg>
											<span>
												<?php
												if ( "tf_hotel" == $post_type_setting ) {
													echo ! empty( tf_data_types( $option_meta['map'] )['address'] ) ? esc_html( travelfic_character_limit( tf_data_types( $option_meta['map'] )['address'], 40 ) ) : '';
												}
												if ( "tf_tours" == $post_type_setting ) {
													echo ! empty( tf_data_types( $option_meta['location'] )['address'] ) ? esc_html( travelfic_character_limit( tf_data_types( $option_meta['location'] )['address'], 40 ) ) : '';
												}
												if ( "tf_apartment" == $post_type_setting ) {
													echo ! empty( tf_data_types( $option_meta['map'] )['address'] ) ? esc_html( travelfic_character_limit( tf_data_types( $option_meta['map'] )['address'], 40 ) ) : '';
												}
												?>
											</span>
										</p>

										<div class="tf-others-details" style="<?php echo "tf_tours" == $post_type_setting ? esc_attr( 'margin-top: 0px' ) : ''; ?>">
											<?php
											if ( "tf_tours" == $post_type_setting ) {
												if ( ! empty( $tour_duration ) ) {
											?>
													<p class="tour-time">
														<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
															<path d="M10.0001 2.16406C14.6024 2.16406 18.3334 5.89502 18.3334 10.4974C18.3334 15.0997 14.6024 18.8307 10.0001 18.8307C5.39771 18.8307 1.66675 15.0997 1.66675 10.4974H3.33341C3.33341 14.1793 6.31818 17.1641 10.0001 17.1641C13.682 17.1641 16.6667 14.1793 16.6667 10.4974C16.6667 6.8155 13.682 3.83073 10.0001 3.83073C7.7086 3.83073 5.68714 4.98685 4.48717 6.7476L6.66675 6.7474V8.41406H1.66675V3.41406H3.33341L3.33332 5.49671C4.8537 3.47302 7.27402 2.16406 10.0001 2.16406ZM10.8334 6.33073L10.8332 10.1516L13.5356 12.8544L12.3571 14.0329L9.16658 10.8416L9.16675 6.33073H10.8334Z" fill="#595349" />
														</svg>
														<?php echo esc_html( $tour_duration ); ?>
														<?php
														if ( $tour_duration > 1 ) {
															$dur_string         = 's';
															$duration_time_html = $duration_time . $dur_string;
														} else {
															$duration_time_html = $duration_time;
														}
														echo " " . esc_html( $duration_time_html );
														?>
														<?php if ( ! empty( $night ) ) { ?>
															<span>
																<?php echo esc_html( $night_count ); ?>
																<?php
																if ( ! empty( $night_count ) ) {
																	if ( $night_count > 1 ) {
																		echo esc_html__( 'Nights', 'travelfic-toolkit' );
																	} else {
																		echo esc_html__( 'Night', 'travelfic-toolkit' );
																	}
																}
																?>
															</span>
														<?php } ?>
													</p>
											<?php }
											} ?>
											<?php
											if ( "tf_hotel" == $post_type_setting ) {
												$rooms = ! empty( $option_meta['room'] ) ? $option_meta['room'] : '';
												if ( ! empty( $rooms ) ) {
													$rm_features = [];
													foreach ( $rooms as $key => $room ) {
														//merge for each room's selected features
														if ( ! empty( $room['features'] ) ) {
															$rm_features = array_unique( array_merge( $rm_features, $room['features'] ) );
														}
													}
													if ( ! empty( $rm_features ) ) { ?>
														<ul>
															<?php
															$tft_limit = 1;
															foreach ( $rm_features as $feature ) {
																if ( $tft_limit < 7 ) {
																	$term = get_term_by( 'id', $feature, 'hotel_feature' );
																	$room_f_meta = get_term_meta( $feature, 'tf_hotel_feature', true );
																	$room_feature_icon = '';
																	if ( ! empty( $room_f_meta ) ) {
																		$room_icon_type = ! empty( $room_f_meta['icon-type'] ) ? $room_f_meta['icon-type'] : '';
																	}
																	if ( ! empty( $room_icon_type ) && $room_icon_type == 'fa' && ! empty( $room_f_meta['icon-fa'] ) ) {
																		$room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
																	} elseif ( ! empty( $room_icon_type ) && $room_icon_type == 'c' && ! empty( $room_f_meta['icon-c'] ) ) {
																		$room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
																	}
															?>
																	<li>
																		<?php echo ! empty( $room_feature_icon ) ? wp_kses_post( $room_feature_icon ) : ''; ?>
																		<?php if ( ! empty( $term->name ) ) : ?>
																			<?php echo esc_html( $term->name ); ?>
																		<?php endif; ?>
																	</li>
															<?php
																}
																$tft_limit++;
															} ?>
														</ul>
											<?php
													}
												}
											}
											?>
											<a class="btn-view-details" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( "View details", "travelfic-toolkit" ); ?></a>
										</div>
									</div>

								</div>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>

				<script>
					(function($) {
						$(document).ready(function() {
							$('body').on('click', '.tft-popular-hotel-header ul li', function() {
								let $this = $(this).closest('.tft-popular-hotels-design__one');
								let tab_type = $(this).attr('data-id');
								$this.find('.tft-hotel-header ul li').each(function() {
									$(this).children('button').removeClass('active').addClass('tft-btn_gray');
								})
								$(this).children('button').addClass('active').removeClass('tft-btn_gray');
								$this.find('.tft-popular-hotels-items').hide();
								$this.find('.tf-widget-' + tab_type + '-post').css('display', 'grid');
							});
						});
					}(jQuery));
				</script>

			</div>
		<?php endif;
		if ( 'design-2' == $tft_design ) : ?>
			<div class="tft-popular-hotels-design__two tft-customizer-typography tft-section-space-bottom" style="background-image: url(<?php echo esc_url( $tft_posts_sec_bg_url ); ?>);">
				<div class="container<?php echo esc_attr( $container_max_width ); ?>">
					<!-- heading content -->
					<div class="tft-heading-content">
						<?php if ( ! empty( $tft_sec_subtitle ) ) { ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php }
						if ( ! empty( $tft_sec_title ) ) { ?>
							<h2 class="tft-section-title tft-title-shape <?php echo esc_attr( $section_title_backdrop ); ?>"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php } ?>
					</div>
					<div class="tft-destination-content">
						<div class="tft-destination-slider <?php echo esc_attr( $tftDisableClass . $slider_box_hidden ); ?>"
						     data-slides-to-show="<?php echo esc_attr( $slideToShow ); ?>"
						     data-slides-to-scroll="<?php echo esc_attr( $design2_slide_to_scroll ); ?>"
						     data-loop="<?php echo esc_attr( $design2_slider_loop ); ?>"
						     data-autoplay="<?php echo esc_attr( $design2_slider_autoplay ); ?>"
						     data-autoplay-speed="<?php echo esc_attr( $design2_slider_autoplay_speed ); ?>"
						     data-speed="<?php echo esc_attr( $design2_slider_autoplay_interval ); ?>"
						     data-dots="<?php echo esc_attr( $design2_slider_dots ); ?>"
						     data-arrows="<?php echo esc_attr( $design2_slider_arrows ); ?>"
						     data-pause-on-hover="<?php echo esc_attr( $design2_slider_pause_on_hover ); ?>"
						     data-pause-on-focus="<?php echo esc_attr( $design2_slider_pause_on_focus ); ?>"
						     data-rtl="<?php echo esc_attr( $design2_slider_rtl ); ?>"
						     data-draggable="<?php echo esc_attr( $design2_slider_draggable ); ?>">
							<?php if ( $query->have_posts() ) : ?>
								<?php while ( $query->have_posts() ) :
									$query->the_post();

									$post_id = get_the_ID();

									// Review Query 
									$tf_comments = get_comments( array( 'post_id' => $post_id, 'status' => 'approve' ) );
									$tf_average_rating = 0;

									if ( $tf_comments ) {
										$tf_comments_meta = get_comment_meta( $tf_comments[0]->comment_ID, 'tf_comment_meta', true );
										if ( ! empty( $tf_comments_meta ) && is_array( $tf_comments_meta ) ) {
											$tf_total_rating = array_sum( $tf_comments_meta );
											$tf_category_count = count( $tf_comments_meta );
											$tf_average_rating = $tf_category_count > 0 ? $tf_total_rating / $tf_category_count : 0;
										}
									}

									$tf_total_price = 0;
									// get average rating
									$comments_query = new \WP_Comment_Query( $args );
									$comments = $comments_query->comments;

									if ( "tf_hotel" == $post_type_setting ) {
										$option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );
										$disable_review_sec = ! empty( $option_meta['h-review'] ) ? $option_meta['h-review'] : '';

										$min_price_arr = Hotel_Price::instance( $post_id )->get_min_price();

										$tf_total_price = ! empty( $min_price_arr['min_sale_price'] ) ? $min_price_arr['min_sale_price'] : ( ! empty( $min_price_arr['min_regular_price'] ) ? $min_price_arr['min_regular_price'] : 0 );

										// // featured
										$tf_featured = isset( $option_meta['featured'] ) ? $option_meta['featured'] : false;
										$tf_featured_text = ! empty( $option_meta['featured_text'] ) ? $option_meta['featured_text'] : 'Featured';

										// // location
										if ( is_array( $option_meta ) && isset( $option_meta['map'] ) ) {
											$tf_location = maybe_unserialize( $option_meta['map'] )['address'] ?? '';
										} else {
											$tf_location = '';
										}
									}
									if ( "tf_tours" == $post_type_setting ) {
										$option_meta = travelfic_get_meta( get_the_ID(), 'tf_tours_opt' );
										$disable_review_sec = ! empty( $option_meta['t-review'] ) ? $option_meta['t-review'] : '';

										// featured
										$tf_featured = isset( $option_meta['tour_as_featured'] ) ? $option_meta['tour_as_featured'] : '';
										$tf_featured_text = ! empty( $option_meta['featured_text'] ) ? $option_meta['featured_text'] : 'Featured';

										// pricing
										$tf_total_price = self::tft_get_tour_card_price( $post_id, $option_meta );

										// location
										if ( is_array( $option_meta ) && isset( $option_meta['location'] ) ) {
											$tf_location = maybe_unserialize( $option_meta['location'] )['address'] ?? '';
										} else {
											$tf_location = '';
										}
									}
									if ( "tf_apartment" == $post_type_setting ) {
										$option_meta = travelfic_get_meta( get_the_ID(), 'tf_apartment_opt' );
										$disable_review_sec = ! empty( $option_meta['disable-apartment-review'] ) ? $option_meta['disable-apartment-review'] : '';

										// featured
										$tf_featured = isset( $option_meta['apartment_as_featured'] ) ? $option_meta['apartment_as_featured'] : '';
										$tf_featured_text = ! empty( $option_meta['featured_text'] ) ? $option_meta['featured_text'] : 'Featured';

										// pricing
										$tf_pricing = ! empty( $option_meta['pricing_type'] ) ? $option_meta['pricing_type'] : '';

										if ( $tf_pricing === 'per_night' ) {
											$tf_total_price = $option_meta['price_per_night'] ?? 0;
										} else {
											$tf_adult_price = $option_meta['adult_price'] ?? 0;
											$tf_child_price = $option_meta['child_price'] ?? 0;
											$tf_total_price = min( $tf_adult_price, $tf_child_price );
										}

										// location
										if ( is_array( $option_meta ) && isset( $option_meta['map'] ) ) {
											$tf_location = maybe_unserialize( $option_meta['map'] )['address'] ?? '';
										} else {
											$tf_location = '';
										}
									}

								?>
									<!-- single destination -->
									<div class="tft-single-destination">
										<!-- destination thumbnail -->
										<div class="tft-destination-thumbnail">
											<?php
											$tft_hotel_image = ! empty( get_the_post_thumbnail_url( get_the_ID() ) ) ? esc_url( get_the_post_thumbnail_url( get_the_ID() ) ) : esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' );
											?>
											<img src="<?php echo esc_url( $tft_hotel_image ); ?>" alt="post thumbnail">
											<div class="tft-destination-featured">
												<?php echo $tf_featured ? '<span class="tft-featured">' . esc_html( $tf_featured_text ) . '</span>' : ''; ?>
											</div>
										</div>
										<!-- destination content -->
										<div class="tft-destination-content">
											<!-- destination top info -->
											<div class="tft-destination-top-info">
												<!-- destination rating -->
												<?php echo tf_review_star_rating( (float) $tf_average_rating );  ?>
												<!-- destination location -->
												<?php if ( ! empty( $tf_location ) ) : ?>
													<span class="tft-destination-location">
														<i class="ri-map-pin-line tft-color-primary"></i>
														<span class="tft-color-text"><?php echo esc_html( $tf_location ); ?></span>
													</span> 
												<?php endif; ?>
												<!-- destination title -->
												<h2 class="tft-destination-title">
													<a href="<?php echo esc_url( get_the_permalink() ) ?>" class="tft-color-hover-primary">
														<?php
														if ( "Split" == ( $settings['card_title_type'] ?? 'Split' ) ) {
															echo esc_html( travelfic_character_limit( get_the_title(), 40 ) );
														} else {
															the_title();
														}
														?>
													</a>
												</h2>
											</div>

											<!-- destination bottom info -->
											<div class="tft-destination-bottom-info">
												<!-- destination price -->
												<div class="tft-destination-price">
													<span class="tft-destination-price-title tft-color-text">
														<?php 
															if ( function_exists( 'wc_price' ) ) {
																$currency_code   = get_woocommerce_currency(); 
																echo sprintf( esc_html__( 'From %s', 'travelfic-toolkit' ), $currency_code );
															} else {
																echo esc_html__( 'From USD', 'travelfic-toolkit' );
															}
														?>
													</span>
													<span class="tft-destination-price-value tft-color-primary">
														<?php if ( function_exists( 'wc_price' ) ) {
																echo wc_price( $tf_total_price );
															} else {
																echo '$' . number_format( $tf_total_price, 2 );
															}
														?>
													</span>
												</div>
												<!-- destination button -->
												<div class="tft-destination-btn">
													<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="tft-btn tft-btn_gray">
														<?php echo esc_html__( 'Explore', 'travelfic-toolkit' ); ?>
														<i class="fa-solid fa-arrow-right"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
							<?php endwhile;
							endif; ?>
						</div>
						<!-- destination slider navigation -->
						<?php if ( $tftSliderDisable == false && 'true' === $design2_slider_arrows ) : ?>
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

				</div>
				<script>
					// Destination Slider
					(function($) {
						$(document).ready(function() {
							//Your Code Inside
							$('.tft-popular-hotels-design__two .tft-destination-slider').slick({
								slidesToShow: <?php echo esc_attr( $slideToShow ); ?>,
								slidesToScroll: <?php echo esc_attr( $design2_slide_to_scroll ); ?>,
								infinite: <?php echo esc_attr( $design2_slider_loop ); ?>,
								autoplay: <?php echo esc_attr( $design2_slider_autoplay ); ?>,
								autoplaySpeed: <?php echo esc_attr( $design2_slider_autoplay_speed ); ?>,
								speed: <?php echo esc_attr( $design2_slider_autoplay_interval ); ?>,
								dots: <?php echo esc_attr( $design2_slider_dots ); ?>,
								arrows: <?php echo esc_attr( $design2_slider_arrows ); ?>,
								pauseOnHover: <?php echo esc_attr( $design2_slider_pause_on_hover ); ?>,
								pauseOnFocus: <?php echo esc_attr( $design2_slider_pause_on_focus ); ?>,
								rtl: <?php echo esc_attr( $design2_slider_rtl ); ?>,
								draggable: <?php echo esc_attr( $design2_slider_draggable ); ?>,
								cssEase: 'linear',
								prevArrow: '.tft-popular-hotels-design__two .tft-prev-slide',
								nextArrow: '.tft-popular-hotels-design__two .tft-next-slide',
								responsive: [{
										breakpoint: 1024,
										settings: {
											slidesToShow: 2,
											slidesToScroll: 1,

										}
									},
									{
										breakpoint: 640,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
											centerMode: true
										}
									}
								]
							});
						});

					}(jQuery));
				</script>
			</div>
<?php endif;
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
	private static function get_number( array $settings, string $key, int $default = 0 ): int {
		$val = $settings[ $key ] ?? $default;
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
}
