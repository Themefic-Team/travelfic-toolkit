<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Icon With Text Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Icon With Text widgets. Both builders call:
 *
 *   IconWithText::render( $settings, 'elementor' );
 *   IconWithText::render( $settings, 'bricks' );
 */
class IconWithText {

	/**
	 * Render the icon with text widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$tft_design = ! empty( $settings['tft_icon_style'] ) ? $settings['tft_icon_style'] : 'design-1';
        $settings['builder'] = $builder; // Pass builder info to settings for use in sub-methods

		if ( 'design-2' === $tft_design ) {
			self::render_design_2( $settings );
		} else {
			self::render_design_1( $settings );
		}
	}

	/**
	 * Render Design 1 layout
	 *
	 * @param array $settings Widget settings.
	 * @return void
	 */
	private static function render_design_1( $settings ) {
        $builder = isset($settings['builder']) ? $settings['builder'] : '';
		$icon_text_list = ! empty( $settings['icon_text_list'] ) ? $settings['icon_text_list'] : [];
		$items_gap = ! empty( $settings['items_gap'] ) ? $settings['items_gap'] : 70;
		$gradient_1 = ! empty( $settings['icon_color_outter_gradient_1'] ) ? $settings['icon_color_outter_gradient_1'] : '#FF6B6B';
		$gradient_2 = ! empty( $settings['icon_color_outter_gradient_2'] ) ? $settings['icon_color_outter_gradient_2'] : '#4ECDC4';
		?>
		<div class="tft-icon-text-design__one tft-customizer-typography">
			<div class="tft-icon-text-items tft-flex">
				<?php foreach ( $icon_text_list as $item ) : ?>
					<div class="tft-icon-text-single" style="<?php echo self::get_gap_style( $item, $items_gap ); ?>">
						<div class="tft-icon-text-single-inner tft-center">
							<div class="icon_outter" style="background: radial-gradient(52.1% 52.66% at 80.79% 21.03%, <?php echo esc_attr( $gradient_1 ); ?> 6.09%, <?php echo esc_attr( $gradient_2 ); ?> 100%);">
								<?php self::render_icon_or_image( $item, $builder ); ?>
							</div>
							<h3 class="tft-title">
								<?php echo esc_html( $item['box_title'] ); ?>
							</h3>
							<p class="tft-details">
								<?php echo esc_html( $item['box_details'] ); ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Design 2 layout
	 *
	 * @param array $settings Widget settings.
	 * @return void
	 */
	private static function render_design_2( $settings ) {
        $builder = isset($settings['builder']) ? $settings['builder'] : '';
		$icon_text_list = ! empty( $settings['icon_text_list'] ) ? $settings['icon_text_list'] : [];
		$tft_sec_subtitle = ! empty( $settings['sec_subtitle'] ) ? $settings['sec_subtitle'] : '';
		$tft_sec_title = ! empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
		$section_title_backdrop = isset( $settings['sec_title_backdrop'] ) && true === $settings['sec_title_backdrop'] ? '' : ' tft-no-backdrop';
		?>
		<div class="tft-icon-text-design__two tft-customizer-typography tft-section-space">
			<div class="container">
				<div class="tft-heading-content">
					<?php if ( ! empty( $tft_sec_subtitle ) ) { ?>
						<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
					<?php } ?>
					<?php if ( ! empty( $tft_sec_title ) ) { ?>
						<h2 class="tft-section-title tft-title-shape<?php echo esc_attr( $section_title_backdrop ); ?>"><?php echo esc_html( $tft_sec_title ); ?></h2>
					<?php } ?>
				</div>
				<div class="tft-icon-text-items tft-section-space-bottom">
					<?php foreach ( $icon_text_list as $item ) : ?>
						<div class="tft-icon-text-single">
							<div class="tft-icon-text-single-inner tft-center">
								<div class="icon_outter">
									<div class="img-box">
										<?php self::render_icon_or_image( $item, $builder ); ?>
									</div>
								</div>
								<h3 class="tft-title">
									<?php echo esc_html( $item['box_title'] ); ?>
								</h3>
								<p class="tft-details">
									<?php echo esc_html( $item['box_details'] ); ?>
								</p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get gap style for item
	 *
	 * @param array $item Item data.
	 * @param int   $gap Gap value in pixels.
	 * @return string
	 */
	private static function get_gap_style( $item, $gap ) {
		// Check if active_gap is set to true (boolean or string 'yes')
		$is_active_gap = false;
		if ( isset( $item['active_gap'] ) ) {
			if ( true === $item['active_gap'] || 'yes' === $item['active_gap'] ) {
				$is_active_gap = true;
			}
		}

		if ( $is_active_gap ) {
			return 'margin-top:' . esc_attr( $gap ) . 'px;';
		} else {
			return 'margin-bottom:' . esc_attr( $gap ) . 'px;';
		}
	}

	/**
	 * Render icon or image based on switcher
	 *
	 * @param array $item Item data.
	 * @param string $builder Builder type.
	 * @return void
	 */
	private static function render_icon_or_image( $item, $builder ) {
		// Determine if showing image or icon
		$show_image = false;
		
		// Check if this is from Elementor (checkbox true/yes) or Bricks (select 'image'/'icon')
		if ( isset( $item['image_icon_switcher'] ) ) {
			if ( 'image' === $item['image_icon_switcher'] || true === $item['image_icon_switcher'] || 'yes' === $item['image_icon_switcher'] ) {
				$show_image = true;
			}
		}

		if ( $show_image && ! empty( $item['box_image']['url'] ) ) {
			?>
			<img src="<?php echo esc_url( $item['box_image']['url'] ); ?>" alt="">
			<?php
		} elseif ( ! $show_image && ! empty( $item['box_icon'] ) ) {
			self::render_icon( $item['box_icon'], $builder );
		}
	}

	/**
	 * Render icon in proper format
	 *
	 * @param mixed $icon_data Icon data from Elementor or Bricks.
	 * @param string $builder Builder type.
	 * @return void
	 */
	private static function render_icon( $icon_data, $builder ) {
        $box_icon_html = '';
		if ( 'elementor' === $builder && class_exists( '\Elementor\Icons_Manager' ) ) {
            if ( is_array( $icon_data ) && ! empty( $icon_data['value'] ) ) {
                ob_start();
                \Elementor\Icons_Manager::render_icon( $icon_data, [ 'aria-hidden' => 'true' ] );
                $box_icon_html = ob_get_clean();
            }
        } elseif ( 'bricks' === $builder ) {
            if ( is_array( $icon_data ) ) {
                if ( ! empty( $icon_data['icon'] ) ) {
                    // Bricks icon control format: ['icon' => 'fas fa-star', 'library' => '...']
                    $box_icon_html = '<i class="' . esc_attr( $icon_data['icon'] ) . '" aria-hidden="true"></i>';
                } elseif ( ! empty( $icon_data['class'] ) ) {
                    $box_icon_html = '<i class="' . esc_attr( $icon_data['class'] ) . '" aria-hidden="true"></i>';
                }
            } elseif ( is_string( $icon_data ) ) {
                // Fallback for string format
                $box_icon_html = '<i class="' . esc_attr( $icon_data ) . '" aria-hidden="true"></i>';
            }
        }
        
        if ( ! empty( $box_icon_html ) ) {
            echo '<div class="tft-icon">' . $box_icon_html . '</div>';
        }
	}

}
