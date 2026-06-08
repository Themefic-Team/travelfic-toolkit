<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Section Heading Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Heading widgets. Both builders call:
 *
 *   SectionHeading::render( $settings, 'elementor' );
 *   SectionHeading::render( $settings, 'bricks' );
 */
class SectionHeading {

	/**
	 * Render the section heading widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$tft_design = ! empty( $settings['tft_heading_style'] ) ? $settings['tft_heading_style'] : 'design-1';
		$tf_heading = ! empty( $settings['tf_heading'] ) ? $settings['tf_heading'] : '';
		$tf_heading_details = ! empty( $settings['tf_heading_details'] ) ? $settings['tf_heading_details'] : '';
		$suffix_title = ! empty( $settings['suffix_title'] ) ? $settings['suffix_title'] : '';
		$text_align = ! empty( $settings['text_align'] ) ? $settings['text_align'] : 'center';
		$has_suffix = tft_get_switcher_value( $settings, 'title_suffix', 'yes', $builder );
		$show_suffix = 'yes' === $has_suffix;

		if ( 'design-2' === $tft_design ) {
			self::render_design_2( $tf_heading, $suffix_title, $show_suffix, $text_align );
		} else {
			self::render_design_1( $tf_heading, $tf_heading_details, $suffix_title, $show_suffix, $text_align );
		}
	}

	/**
	 * Render Design 1 layout
	 */
	private static function render_design_1( $tf_heading, $tf_heading_details, $suffix_title, $show_suffix, $text_align ) {
		?>
		<div class="tft-section-heading__one tft-section-head" style="text-align: <?php echo esc_attr( $text_align ); ?>;">
			<h2 class="title section-title">
				<?php echo esc_html( $tf_heading ); ?>
				<?php if ( $show_suffix && ! empty( $suffix_title ) ) : ?>
					<span class="section-title-suffix">
						<?php echo esc_html( $suffix_title ); ?>
					</span>
				<?php endif; ?>
			</h2>
			<?php if ( ! empty( $tf_heading_details ) ) : ?>
				<p class="subtitle">
					<?php echo esc_html( $tf_heading_details ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render Design 2 layout
	 */
	private static function render_design_2( $tf_heading, $suffix_title, $show_suffix, $text_align ) {
		?>
		<div class="tft-section-heading__two tft-section-head" style="text-align: <?php echo esc_attr( $text_align ); ?>;">
			<h2 class="title section-title">
				<?php if ( $show_suffix && ! empty( $suffix_title ) ) : ?>
					<span class="section-title-suffix">
						<?php echo esc_html( $suffix_title ); ?>
					</span>
				<?php endif; ?>
				<?php echo esc_html( $tf_heading ); ?>
			</h2>
		</div>
		<?php
	}
}
