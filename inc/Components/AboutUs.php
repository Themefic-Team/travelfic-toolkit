<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global About Us Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic About Us widgets. Both builders call:
 *
 *   AboutUs::render( $settings, 'elementor' );
 *   AboutUs::render( $settings, 'bricks' );
 */
class AboutUs {

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( array $settings = [], string $builder = '' ): void {
		// Design style
		$tft_design = ! empty( $settings['tft_about_style'] ) ? $settings['tft_about_style'] : 'design-1';

		// Resolve texts
		$tft_sec_title           = ! empty( $settings['about_us_title'] ) ? $settings['about_us_title'] : '';
		$tft_sec_subtitle        = ! empty( $settings['about_us_subtitle'] ) ? $settings['about_us_subtitle'] : '';
		$tft_about_us_experience = ! empty( $settings['about_us_experience'] ) ? $settings['about_us_experience'] : '';
		$tft_sec_content         = ! empty( $settings['about_us_content'] ) ? $settings['about_us_content'] : '';
		$tft_sec_quotes          = ! empty( $settings['about_us_quotes'] ) ? $settings['about_us_quotes'] : '';
		$tft_sec_author          = ! empty( $settings['about_us_author'] ) ? $settings['about_us_author'] : '';
		$tft_about_us_button_text = ! empty( $settings['readme_label'] ) ? $settings['readme_label'] : '';

		// Resolve images
		$tft_about_us_image_url        = self::get_image_url( $settings, 'about_us_image' );
		$tft_about_us_circle_image_url = self::get_image_url( $settings, 'about_us_circle_image' );

		// Resolve links
		$readme_url = self::get_link_url( $settings, 'readme_link' );
		$readme_attrs = self::get_link_target_and_rel( $settings, 'readme_link' );

		// Backdrop switcher logic
		$has_backdrop = tft_get_switcher_value($settings, 'about_us_design2_title_backdrop', 'yes', $builder);
		$section_title_backdrop = 'yes' != $has_backdrop ? ' tft-no-backdrop' : '';

		if ( 'design-1' == $tft_design ) {
			?>
			<div class="tft-about-us-design__one tft-customizer-typography">
				<div class="tft-about-us__inner tft-row">
					<div class="tft-about-us-grid">
						<div class="tft-about-us-content tft-heading-content tf-direction-column">
							<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
								<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $tft_sec_title ) ) : ?>
								<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
							<?php endif; ?>

							<div class="tft-section-content">
								<?php if ( ! empty( $tft_sec_content ) ) : ?>
									<p> <?php echo wp_kses_post( $tft_sec_content ); ?></p>
								<?php endif; ?>

								<?php if ( ! empty( $tft_sec_quotes ) ) : ?>
									<div class="tft-about-us-quotes"><?php echo wp_kses_post( $tft_sec_quotes ); ?></div>
								<?php endif; ?>

								<?php if ( ! empty( $tft_sec_author ) ) : ?>
									<p class="tft-about-us-author tft-text-right tft-color-text"><?php echo esc_html( $tft_sec_author ); ?></p>
								<?php endif; ?>
							</div>
							<div class="read-more">
								<a href="<?php echo esc_url( $readme_url ); ?>" class="tft-btn tft-btn-transparent tft-large-circle tft-wh-auto tft-flex-column"<?php echo $readme_attrs; ?>>
									<?php esc_html_e( 'More', 'travelfic-toolkit' ); ?>
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
											<path d="M56.7071 8.86336C57.0976 8.47283 57.0976 7.83967 56.7071 7.44914L50.3431 1.08518C49.9526 0.694658 49.3195 0.694658 48.9289 1.08518C48.5384 1.47571 48.5384 2.10887 48.9289 2.4994L54.5858 8.15625L48.9289 13.8131C48.5384 14.2036 48.5384 14.8368 48.9289 15.2273C49.3195 15.6178 49.9526 15.6178 50.3431 15.2273L56.7071 8.86336ZM0 9.15625H56V7.15625H0V9.15625Z" fill="#B58E53" />
										</svg>
									</span>
								</a>
							</div>
						</div>
						<div class="tft-about-us-image">
							<?php if ( ! empty( $tft_about_us_experience ) ) : ?>
								<div class="years-of-experience">
									<img class="experience-badge" src="<?php echo esc_url( TRAVELFIC_TOOLKIT_URL . 'assets/app/img/years-experience.png' ); ?>" alt="">
									<div class="tft-experience-years">
										<h2><?php echo esc_html( $tft_about_us_experience ); ?></h2>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $tft_about_us_image_url ) ) : ?>
								<div class="tft-about-image">
									<img src="<?php echo esc_url( $tft_about_us_image_url ); ?>" alt="<?php esc_attr_e( 'About Us Image', 'travelfic-toolkit' ); ?>">
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( 'design-2' == $tft_design ) { ?>
			<div class="tft-about-us-design__two tft-customizer-typography tft-section-space-top tft-section-small-bottom-space">
				<div class="tft-about-us__inner tft-row">
					<div class="tft-about-us-grid">
						<div class="tft-about-us-image">
							<?php if ( ! empty( $tft_about_us_image_url ) ) : ?>
								<div class="tft-about-image">
									<div class="tft-about-curbe-image">
										<img src="<?php echo esc_url( $tft_about_us_image_url ); ?>" alt="<?php esc_attr_e( 'About Us Image', 'travelfic-toolkit' ); ?>">
									</div>
									<div class="tft-about-circle-image">
										<img src="<?php echo esc_url( $tft_about_us_circle_image_url ); ?>" alt="<?php esc_attr_e( 'About Us Circle Image', 'travelfic-toolkit' ); ?>">
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="tft-about-us-content tft-heading-content">
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

							<div class="tft-about-us-list">
								<ul>
									<?php
									$about_list_content = ! empty( $settings['about_list_content'] ) ? $settings['about_list_content'] : [];
									foreach ( $about_list_content as $list ) :
										?>
										<li>
											<div class="icon tft-color-primary">
												<i class="fa-regular fa-circle-check"></i>
											</div>
											<div class="text tft-color-text">
												<?php echo esc_html( $list['about_list_title'] ?? '' ); ?>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="tft-about-us-button">
								<a href="<?php echo esc_url( $readme_url ); ?>" class="tft-btn"<?php echo $readme_attrs; ?>>
									<?php echo esc_html( $tft_about_us_button_text ); ?>
									<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="tft-about-us-shape">
					<img src="<?php echo esc_url( TRAVELFIC_TOOLKIT_URL . 'assets/app/img/plane-shape.png' ); ?>" alt="<?php esc_attr_e( 'About us shape', 'travelfic-toolkit' ); ?>">
				</div>
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

	/**
	 * Safe link URL helper.
	 */
	private static function get_link_url( array $settings, string $key ): string {
		$link = $settings[ $key ] ?? '';
		if ( is_array( $link ) ) {
			return ! empty( $link['url'] ) ? $link['url'] : '#';
		}
		return is_string( $link ) && ! empty( $link ) ? $link : '#';
	}

	/**
	 * Safe link target and rel helper.
	 */
	private static function get_link_target_and_rel( array $settings, string $key ): string {
		$link = $settings[ $key ] ?? [];
		$attrs = '';
		if ( is_array( $link ) ) {
			$external = ! empty( $link['is_external'] ) || ! empty( $link['newTab'] );
			if ( $external ) {
				$attrs .= ' target="_blank"';
			}
			$nofollow = ! empty( $link['nofollow'] );
			if ( $nofollow ) {
				$attrs .= ' rel="nofollow"';
			}
		}
		return $attrs;
	}
}
