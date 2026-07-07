<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Features Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Features widgets. Both builders call:
 *
 *   Features::render( $settings, 'elementor' );
 *   Features::render( $settings, 'bricks' );
 */
class Features {

	/**
	 * Render the features widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		// Design
		$tft_design = ! empty( $settings['feature_style'] ) ? $settings['feature_style'] : 'design-1';

		// Interaction setting (click / hover)
		$feature_interaction = ! empty( $settings['feature_interaction'] ) ? $settings['feature_interaction'] : 'click';
		$features_section    = ! empty( $settings['features_section'] ) ? $settings['features_section'] : [];

		if ( ! empty( $features_section ) && 'design-1' === $tft_design ) {
			?>
			<div class="tft-features-design__one" data-interaction="<?php echo esc_attr( $feature_interaction ); ?>">
				<div class="tft-features-items">
					<div class="tft-features-items-left">
						<?php
						foreach ( $features_section as $key => $item ) :
							$has_icon = false;
							if ( 'elementor' === $builder ) {
								$has_icon = ! empty( $item['icon']['value'] );
							} else {
								if ( is_array( $item['icon'] ) ) {
									$has_icon = ! empty( $item['icon']['icon'] ) || ! empty( $item['icon']['class'] );
								} else {
									$has_icon = ! empty( $item['icon'] );
								}
							}
							?>
							<div class="tft-single-feature<?php echo ( 0 === intval( $key ) ) ? ' active' : ''; ?>" id="tft-feature-<?php echo esc_attr( $key ); ?>">
								<?php if ( $has_icon ) : ?>
									<div class="tft-feature-icon">
										<?php self::render_icon( $item['icon'], $builder ); ?>
									</div>
								<?php endif; ?>
								<div class="tft-single-feature-right">
									<h3><?php echo esc_html( $item['title'] ); ?></h3>
									<p><?php echo wp_kses_post( $item['description'] ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="tft-features-items-right">
						<?php
						foreach ( $features_section as $key => $item ) :
							$image_url = '';
							if ( ! empty( $item['image']['url'] ) ) {
								$image_url = $item['image']['url'];
							} elseif ( is_string( $item['image'] ) ) {
								$image_url = $item['image'];
							}
							?>
							<div class="tft-single-feature-image<?php echo ( 0 === intval( $key ) ) ? ' active' : ''; ?>" data-id="#tft-feature-<?php echo esc_attr( $key ); ?>">
								<?php if ( ! empty( $image_url ) ) { ?>
									<img src="<?php echo esc_url( $image_url ); ?>" alt="Image">
								<?php } ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<script>
				(function($) {
					$(document).ready(function() {
						// Read interaction mode from server-rendered container (default to click)
						var $container = $('.tft-features-design__one');
						var interaction = $container.data('interaction') || 'click';

						// Ensure only the active image is visible on load
						$('.tft-single-feature-image').hide();
						$('.tft-single-feature-image.active').show();

						function showFeatureById(idSelector, $clicked) {
							// activate left items
							$('.tft-features-items-left .tft-single-feature').removeClass('active');
							if ($clicked) {
								$clicked.addClass('active');
							}

							// show corresponding image
							$('.tft-features-items-right .tft-single-feature-image').removeClass('active').hide();
							$('.tft-features-items-right .tft-single-feature-image[data-id="' + idSelector + '"]').addClass('active').show();
						}

						if (interaction === 'hover') {
							// Hover interaction (mouseenter)
							$('.tft-features-items-left').on('mouseenter', '.tft-single-feature', function() {
								var $this = $(this);
								var id = '#' + $this.attr('id');
								showFeatureById(id, $this);
							});
						} else {
							// Click interaction (default)
							$('.tft-features-items-left').on('click', '.tft-single-feature', function(e) {
								e.preventDefault();
								var $this = $(this);
								var id = '#' + $this.attr('id');
								showFeatureById(id, $this);
							});
						}
					});
				}(jQuery));
			</script>
			<?php
		}
	}

	/**
	 * Render icon based on builder format
	 */
	private static function render_icon( $icon_data, $builder ) {
		if ( 'elementor' === $builder && class_exists( '\Elementor\Icons_Manager' ) ) {
			if ( is_array( $icon_data ) && ! empty( $icon_data['value'] ) ) {
				\Elementor\Icons_Manager::render_icon( $icon_data, [ 'aria-hidden' => 'true' ] );
			}
		} elseif ( 'bricks' === $builder ) {
			$icon_class = '';
			if ( is_array( $icon_data ) ) {
				if ( ! empty( $icon_data['icon'] ) ) {
					$icon_class = $icon_data['icon'];
				} elseif ( ! empty( $icon_data['class'] ) ) {
					$icon_class = $icon_data['class'];
				}
			} elseif ( is_string( $icon_data ) ) {
				$icon_class = $icon_data;
			}

			if ( ! empty( $icon_class ) ) {
				echo '<i class="' . esc_attr( $icon_class ) . '" aria-hidden="true"></i>';
			}
		}
	}
}
