<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Cars Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Cars widgets. Both builders call:
 *
 *   Cars::render( $settings, 'elementor' );
 *   Cars::render( $settings, 'bricks' );
 */
class Cars {

	/**
	 * Render the cars widget
	 *
	 * @param array  $settings Widget settings.
	 * @param string $builder  Builder type (elementor or bricks).
	 * @return void
	 */
	public static function render( $settings, $builder = 'elementor' ) {
		$style     = ! empty( $settings['car_style'] ) ? $settings['car_style'] : 'grid';
		$per_pages = ! empty( $settings['post_items'] ) ? $settings['post_items'] : 6;
		$sec_title = ! empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
		$sub_title = ! empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
		?>
		<div class="tf-archive-template__one">
			<?php echo do_shortcode( '[tf_cars style="' . esc_attr( $style ) . '" count="' . esc_attr( $per_pages ) . '" title="' . esc_attr( $sec_title ) . '" subtitle="' . esc_attr( $sub_title ) . '" ]' ); ?>
		</div>
		<?php
	}
}
