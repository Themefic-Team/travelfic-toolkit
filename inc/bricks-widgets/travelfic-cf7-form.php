<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Contact Form 7 Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_CF7_Form extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-cf7-form';
	public $icon     = 'ti-email';
	public $scripts  = [];

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-cf7-form' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic CF7 Forms', 'travelfic-toolkit' );
	}

	// Function to fetch Contact Form 7 forms
	private function get_contact_form_7_forms() {
		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$forms = array();
			$args  = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
			);
			$query = new \WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$forms[] = \WPCF7_ContactForm::get_instance( get_the_ID() );
				}
			}
			wp_reset_postdata();
			return $forms;
		}
		return [];
	}

	public function get_cf7_from_id() {
		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$forms        = $this->get_contact_form_7_forms(); // Fetch available forms
			$form_options = array( '' => esc_html__( 'Select a form', 'travelfic-toolkit' ) );
			foreach ( $forms as $form ) {
				$form_options[ $form->title() ] = $form->title();
			}
			return $form_options;
		}
		return [];
	}

	public function set_control_groups() {
		// Content Tabs
		$this->control_groups['cf7_form'] = [
			'title' => esc_html__( 'Form', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		// Style Tabs
		$this->control_groups['tour_destination_style'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		// ========== CONTENT GROUP ==========
		$this->controls['selected_form'] = [
			'tab'     => 'content',
			'group'   => 'cf7_form',
			'label'   => esc_html__( 'Select Form', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => $this->get_cf7_from_id(),
		];

		// ========== STYLE GROUP ==========
		$this->controls['cf7_form_input_label_head'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Label', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['cf7_form_input'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Input', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['cf7_form_input_typo'] = [
			'tab'     => 'style',
			'group'   => 'tour_destination_style',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-cf7-form-design__one .wpcf7-form input[type=email], .tft-cf7-form-design__one .wpcf7-form input[type=text], .tft-cf7-form-design__one .wpcf7-form input[type=phone], .tft-cf7-form-design__one .wpcf7-form textarea, .tft-cf7-form-design__one .wpcf7-form label',
				],
			],
		];

		$this->controls['cf7_form_input_bg'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.tft-cf7-form-design__one .wpcf7-form input[type=email], .tft-cf7-form-design__one .wpcf7-form input[type=text], .tft-cf7-form-design__one .wpcf7-form input[type=phone], .tft-cf7-form-design__one .wpcf7-form textarea',
				],
			],
		];

		$this->controls['cf7_form_input_field_padding'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-cf7-form-design__one .wpcf7-form input[type=email], .tft-cf7-form-design__one .wpcf7-form input[type=text], .tft-cf7-form-design__one .wpcf7-form input[type=phone], .tft-cf7-form-design__one .wpcf7-form textarea',
				],
			],
		];

		$this->controls['cf7_form_button_heading'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['cf7_form_button_typo'] = [
			'tab'     => 'style',
			'group'   => 'tour_destination_style',
			'label'   => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'    => 'typography',
			'exclude' => [ 'text-align' ],
			'css'     => [
				[
					'selector' => '.tft-cf7-form-design__one .wpcf7-form .wpcf7-submit',
				],
			],
		];

		$this->controls['cf7_form_button_padding'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.tft-cf7-form-design__one .wpcf7-form .wpcf7-submit',
				],
			],
		];

		$this->controls['cf7_form_button_margin'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'  => 'spacing',
			'css'   => [
				[
					'property' => 'margin',
					'selector' => '.tft-cf7-form-design__one .wpcf7-form .wpcf7-submit',
				],
			],
		];

		$this->controls['cf7_form_button_border_'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'  => 'border',
			'css'   => [
				[
					'selector' => '.tft-cf7-form-design__one .wpcf7-form .wpcf7-submit',
				],
			],
		];

		$this->controls['cf7_form_button_bg_color'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.tft-cf7-form-design__one .wpcf7-form .wpcf7-submit',
				],
			],
		];

		$this->controls['cf7_form_notice'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Notice', 'travelfic-toolkit' ),
			'type'  => 'separator',
		];

		$this->controls['cf7_form_notice_color'] = [
			'tab'   => 'style',
			'group' => 'tour_destination_style',
			'label' => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.tft-cf7-form-design__one .wpcf7-response-output',
				],
			],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\CF7Form::render( $settings, 'bricks' );

		echo '</div>';
	}
}
