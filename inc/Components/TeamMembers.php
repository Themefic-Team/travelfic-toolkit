<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Team Members Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Team Members widgets. Both builders call:
 *
 *   TeamMembers::render( $settings, 'elementor' );
 *   TeamMembers::render( $settings, 'bricks' );
 */
class TeamMembers {

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$tft_design = ! empty( $settings['tft_team_style'] ) ? $settings['tft_team_style'] : 'design-1';
		$tft_sec_title = ! empty( $settings['team_title'] ) ? $settings['team_title'] : '';
		$tft_sec_subtitle = ! empty( $settings['team_subtitle'] ) ? $settings['team_subtitle'] : '';

		// Backdrop switcher logic via centralized helper function
		$has_backdrop = tft_get_switcher_value( $settings, 'team_sec_title_backdrop', 'yes', $builder );
		$section_title_backdrop = 'yes' !== $has_backdrop ? ' tft-no-backdrop' : '';

		$members_list = ! empty( $settings['members_list'] ) ? $settings['members_list'] : [];

		// Items per page
		$slideToShow = ! empty( $settings['team_design2_slider_slidetoshow'] ) ? $settings['team_design2_slider_slidetoshow'] : 3;
		$postCount = count( $members_list );

		// Disable slider class
		$tftSliderDisable = false;
		$tftDisableClass = '';
		if ( $postCount <= $slideToShow ) {
			$tftSliderDisable = true;
			$tftDisableClass = 'tft-slider-disable';
		}

		// slider control settings check
		$design2_slide_to_scroll = ! empty( $settings['team_design2_slider_slidetoscroll'] ) ? $settings['team_design2_slider_slidetoscroll'] : 1;

		$design2_slider_nav = ! empty( $settings['team_design2_slider_navigation'] ) ? $settings['team_design2_slider_navigation'] : 'dots';

		$design2_slider_arrows = ( 'arrows' === $design2_slider_nav ) ? 'true' : 'false';
		$design2_slider_dots = ( 'dots' === $design2_slider_nav ) ? 'true' : 'false';

		$slider_box_hidden = ( 'true' === $design2_slider_arrows ) ? ' tft-box-hidden' : '';
		$container_max_width = ( 'true' === $design2_slider_arrows ) ? ' tft-container-width' : '';

		// autoplays/switchers
		$autoplay_val = tft_get_switcher_value( $settings, 'team_design2_slider_autoplay', 'yes', $builder );
		$design2_slider_autoplay = ( 'yes' === $autoplay_val ) ? 'true' : 'false';

		$loop_val = tft_get_switcher_value( $settings, 'team_design2_slider_loop', 'no', $builder );
		$design2_slider_loop = ( 'yes' === $loop_val ) ? 'true' : 'false';

		$hover_val = tft_get_switcher_value( $settings, 'team_design2_slider_pause_on_hover', 'no', $builder );
		$design2_slider_pause_on_hover = ( 'yes' === $hover_val ) ? 'true' : 'false';

		$focus_val = tft_get_switcher_value( $settings, 'team_design2_slider_pause_on_focus', 'no', $builder );
		$design2_slider_pause_on_focus = ( 'yes' === $focus_val ) ? 'true' : 'false';

		$rtl_val = tft_get_switcher_value( $settings, 'team_design2_slider_rtl', 'no', $builder );
		$design2_slider_rtl = ( 'yes' === $rtl_val ) ? 'true' : 'false';

		$drag_val = tft_get_switcher_value( $settings, 'team_design2_slider_draggable', 'yes', $builder );
		$design2_slider_draggable = ( 'yes' === $drag_val ) ? 'true' : 'false';

		if ( 'design-1' == $tft_design ) {
			self::render_design_1( $members_list );
		} elseif ( 'design-2' == $tft_design ) {
			// Extract numerical values safely for slider speed and interval
			if ( $builder == 'elementor' ) {
				$design2_slider_autoplay_speed = ! empty( $settings['team_design2_slider_autoplay_speed'] ) ? $settings['team_design2_slider_autoplay_speed']['size'] : 3000;
				$design2_slider_autoplay_interval = ! empty( $settings['team_design2_slider_autoplay_interval'] ) ? $settings['team_design2_slider_autoplay_interval']['size'] : 1500;
			} elseif ( $builder == 'bricks' ) {
				$design2_slider_autoplay_speed = is_array( $settings['team_design2_slider_autoplay_speed'] ) && isset( $settings['team_design2_slider_autoplay_speed']['size'] ) ? $settings['team_design2_slider_autoplay_speed']['size'] : ( ! empty( $settings['team_design2_slider_autoplay_speed'] ) ? $settings['team_design2_slider_autoplay_speed'] : 3000 );
				$design2_slider_autoplay_interval = is_array( $settings['team_design2_slider_autoplay_interval'] ) && isset( $settings['team_design2_slider_autoplay_interval']['size'] ) ? $settings['team_design2_slider_autoplay_interval']['size'] : ( ! empty( $settings['team_design2_slider_autoplay_interval'] ) ? $settings['team_design2_slider_autoplay_interval'] : 1500 );
			}
			self::render_design_2( $members_list, $tft_sec_subtitle, $tft_sec_title, $section_title_backdrop, $tftDisableClass, $container_max_width, $slider_box_hidden, $tftSliderDisable, $design2_slider_arrows, $slideToShow, $design2_slide_to_scroll, $design2_slider_loop, $design2_slider_autoplay, $design2_slider_autoplay_speed, $design2_slider_autoplay_interval, $design2_slider_dots, $design2_slider_pause_on_hover, $design2_slider_pause_on_focus, $design2_slider_rtl, $design2_slider_draggable );
		} elseif ( 'design-3' == $tft_design ) {
			self::render_design_3( $members_list );
		}
	}

	/**
	 * Render Design 1
	 */
	private static function render_design_1( $members_list ) {
		?>
		<div class="tft-team-design__one tft-customizer-typography">
			<div class="tft-team-members tft-flex tft-f-cg-40 tft-f-rw-40 tft-f-sb">
				<?php foreach ( $members_list as $item ) : ?>
					<div class="tft-single-member tft-card-default">
						<div class="team-members-inner tft-flex align-center">
							<?php if ( ! empty( $item['member_img']['url'] ) ) { ?>
								<div class="member_img">
									<img src="<?php echo esc_url( $item['member_img']['url'] ); ?>" alt="">
								</div>
							<?php } ?>
							<div class="member-details">
								<h3 class="tft-title"> <?php echo esc_html( $item['member_name'] ); ?> </h3>
								<p class="tft-subtitle"><?php echo esc_html( $item['member_designation'] ); ?></p>
								<p class="tft-content"><?php echo esc_html( $item['member_details'] ); ?></p>

								<div class="social-media">
									<?php if ( ! empty( $item['member_social_fb'] ) ) { ?>
										<a href="<?php echo esc_url( $item['member_social_fb'] ); ?>">
											<i class="fab fa-facebook-f"></i>
										</a>
									<?php } ?>
									<?php if ( ! empty( $item['member_social_ld'] ) ) { ?>
										<a href="<?php echo esc_url( $item['member_social_ld'] ); ?>">
											<i class="fab fa-linkedin-in"></i>
										</a>
									<?php } ?>
									<?php if ( ! empty( $item['member_social_tw'] ) ) { ?>
										<a href="<?php echo esc_url( $item['member_social_tw'] ); ?>">
											<i class="fab fa-twitter"></i>
										</a>
									<?php } ?>
									<?php if ( ! empty( $item['member_social_insta'] ) ) { ?>
										<a href="<?php echo esc_url( $item['member_social_insta'] ); ?>">
											<i class="fab fa-instagram"></i>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Design 2
	 */
	private static function render_design_2( $members_list, $tft_sec_subtitle, $tft_sec_title, $section_title_backdrop, $tftDisableClass, $container_max_width, $slider_box_hidden, $tftSliderDisable, $design2_slider_arrows, $slideToShow, $design2_slide_to_scroll, $design2_slider_loop, $design2_slider_autoplay, $design2_slider_autoplay_speed, $design2_slider_autoplay_interval, $design2_slider_dots, $design2_slider_pause_on_hover, $design2_slider_pause_on_focus, $design2_slider_rtl, $design2_slider_draggable ) {
		$slider_id = 'tft-team-slider-' . wp_generate_uuid4();
		?>
		<div class="tft-team-design__two tft-customizer-typography tft-section-space-top">
			<div class="container<?php echo esc_attr( $tftDisableClass . $container_max_width ); ?>">
				<div class="tft-heading-content">
					<?php if ( ! empty( $tft_sec_subtitle ) ) { ?>
						<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
					<?php } ?>
					<?php if ( ! empty( $tft_sec_title ) ) { ?>
						<h2 class="tft-section-title tft-title-shape <?php echo esc_attr( $section_title_backdrop ); ?>"><?php echo esc_html( $tft_sec_title ); ?></h2>
					<?php } ?>
				</div>
				<div class="tft-team-content">
					<div id="<?php echo esc_attr( $slider_id ); ?>" class="tft-team-members <?php echo esc_attr( $slider_box_hidden ); ?>">
						<?php foreach ( $members_list as $item ) : ?>
							<div class="tft-single-member tft-card-default">
								<div class="team-members-inner">
									<?php if ( ! empty( $item['member_img']['url'] ) ) { ?>
										<div class="member_img">
											<img src="<?php echo esc_url( $item['member_img']['url'] ); ?>" alt="">
										</div>
									<?php } ?>
									<div class="member-details">
										<div class="social-media-icons">
											<button class="share-btn tft-btn tft-wh-auto" id="shareButons">
												<i class="ri-share-line"></i>
											</button>
											<div class="social-media">
												<?php if ( ! empty( $item['member_social_fb'] ) ) { ?>
													<a href="<?php echo esc_url( $item['member_social_fb'] ); ?>">
														<i class="fab fa-facebook-f"></i>
													</a>
												<?php } ?>
												<?php if ( ! empty( $item['member_social_ld'] ) ) { ?>
													<a href="<?php echo esc_url( $item['member_social_ld'] ); ?>">
														<i class="fab fa-linkedin-in"></i>
													</a>
												<?php } ?>
												<?php if ( ! empty( $item['member_social_tw'] ) ) { ?>
													<a href="<?php echo esc_url( $item['member_social_tw'] ); ?>">
														<i class="fab fa-twitter"></i>
													</a>
												<?php } ?>
												<?php if ( ! empty( $item['member_social_insta'] ) ) { ?>
													<a href="<?php echo esc_url( $item['member_social_insta'] ); ?>">
														<i class="fab fa-instagram"></i>
													</a>
												<?php } ?>
											</div>
										</div>
										<h3 class="tft-subtitle"> <?php echo esc_html( $item['member_designation'] ); ?> </h3>
										<h2 class="tft-title"><?php echo esc_html( $item['member_name'] ); ?></h2>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<!-- slider navigation -->
					<?php if ( $tftSliderDisable == false && 'true' === $design2_slider_arrows ) : ?>
						<div class="tft-team-slider-nav">
							<button type="button" class="tft-prev-slide">
								<i class="ri-arrow-left-line"></i>
							</button>
							<button type="button" class="tft-next-slide">
								<i class="ri-arrow-right-line"></i>
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="tft_team_bottom_shape">
				<img src="<?php echo esc_url( TRAVELFIC_TOOLKIT_URL . 'assets/app/img/team-banner-shape.png' ); ?>" alt="Team background shape">
			</div>
		</div>

		<script>
			jQuery(document).ready(function($) {
				<?php if ( $tftSliderDisable == false ) : ?>
					$("#<?php echo esc_js( $slider_id ); ?>").slick({
						slidesToShow: <?php echo esc_js( $slideToShow ); ?>,
						slidesToScroll: <?php echo esc_js( $design2_slide_to_scroll ); ?>,
						infinite: <?php echo esc_js( $design2_slider_loop ); ?>,
						autoplay: <?php echo esc_js( $design2_slider_autoplay ); ?>,
						autoplaySpeed: <?php echo esc_js( $design2_slider_autoplay_speed ); ?>,
						speed: <?php echo esc_js( $design2_slider_autoplay_interval ); ?>,
						dots: <?php echo esc_js( $design2_slider_dots ); ?>,
						arrows: <?php echo esc_js( $design2_slider_arrows ); ?>,
						pauseOnHover: <?php echo esc_js( $design2_slider_pause_on_hover ); ?>,
						pauseOnFocus: <?php echo esc_js( $design2_slider_pause_on_focus ); ?>,
						rtl: <?php echo esc_js( $design2_slider_rtl ); ?>,
						draggable: <?php echo esc_js( $design2_slider_draggable ); ?>,
						prevArrow: $("#<?php echo esc_js( $slider_id ); ?>").closest('.tft-team-content').find('.tft-prev-slide'),
						nextArrow: $("#<?php echo esc_js( $slider_id ); ?>").closest('.tft-team-content').find('.tft-next-slide'),
						responsive: [{
								breakpoint: 991,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2,
								}
							},
							{
								breakpoint: 640,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									centerMode: true,
									adaptiveHeight: false,
								}
							},
						]
					});
				<?php endif; ?>
			});
		</script>
		<?php
	}

	/**
	 * Render Design 3
	 */
	private static function render_design_3( $members_list ) {
		?>
		<div class="tft-team-design__three tft-customizer-typography">
			<div class="tft-team-members tft-flex">
				<?php foreach ( $members_list as $item ) : ?>
					<div class="tft-single-member">
						<?php if ( ! empty( $item['member_img']['url'] ) ) { ?>
							<div class="member_img">
								<img src="<?php echo esc_url( $item['member_img']['url'] ); ?>" alt="">
							</div>
						<?php } ?>
						<div class="member-details">
							<h2 class="tft-title"><?php echo esc_html( $item['member_name'] ); ?></h2>
							<span class="tft-subtitle"> <?php echo esc_html( $item['member_designation'] ); ?></span>
							<div class="social-media">
								<?php if ( ! empty( $item['member_social_fb'] ) ) { ?>
									<a href="<?php echo esc_url( $item['member_social_fb'] ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M18 2H15C13.6739 2 12.4021 2.52678 11.4645 3.46447C10.5268 4.40215 10 5.67392 10 7V10H7V14H10V22H14V14H17L18 10H14V7C14 6.73478 14.1054 6.48043 14.2929 6.29289C14.4804 6.10536 14.7348 6 15 6H18V2Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>
								<?php } ?>
								<?php if ( ! empty( $item['member_social_ld'] ) ) { ?>
									<a href="<?php echo esc_url( $item['member_social_ld'] ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M6 9H2V21H6V9Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>
								<?php } ?>
								<?php if ( ! empty( $item['member_social_tw'] ) ) { ?>
									<a href="<?php echo esc_url( $item['member_social_tw'] ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M22 4C22 4 21.3 6.1 20 7.4C21.6 17.4 10.6 24.7 2 19C4.2 19.1 6.4 18.4 8 17C3 15.5 0.5 9.6 3 5C5.2 7.6 8.6 9.1 12 9C11.1 4.8 16 2.4 19 5.2C20.1 5.2 22 4 22 4Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>
								<?php } ?>
								<?php if ( ! empty( $item['member_social_insta'] ) ) { ?>
									<a href="<?php echo esc_url( $item['member_social_insta'] ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M17.5 6.5H17.51M7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7C2 4.23858 4.23858 2 7 2ZM16 11.37C16.1234 12.2022 15.9813 13.0522 15.5938 13.799C15.2063 14.5458 14.5931 15.1514 13.8416 15.5297C13.0901 15.9079 12.2384 16.0396 11.4078 15.9059C10.5771 15.7723 9.80976 15.3801 9.21484 14.7852C8.61992 14.1902 8.22773 13.4229 8.09407 12.5922C7.9604 11.7616 8.09207 10.9099 8.47033 10.1584C8.84859 9.40685 9.45419 8.79374 10.201 8.40624C10.9478 8.01874 11.7978 7.87659 12.63 8C13.4789 8.12588 14.2649 8.52146 14.8717 9.12831C15.4785 9.73515 15.8741 10.5211 16 11.37Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
