<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Contact Form 7 Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic CF7 Form widgets. Both builders call:
 *
 *   CF7Form::render( $settings, 'elementor' );
 *   CF7Form::render( $settings, 'bricks' );
 */
class CF7Form {

	/**
	 * Render the contact form 7 widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$selected_form = ! empty( $settings['selected_form'] ) ? $settings['selected_form'] : '';
		?>
		<div class="tft-cf7-form-design__one">
			<?php
			if ( ! empty( $selected_form ) ) {
				echo do_shortcode( '[contact-form-7 title="' . esc_attr( $selected_form ) . '"]' );
			}
			?>
		</div>
		<?php
	}
}
