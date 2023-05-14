<?php
class TravelficSliderHero extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'tf-slider-hero';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('TFT Slider Hero', 'travelfic');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-slider-device';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url()
	{
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['travelfic'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['travelfic', 'slider', 'hero', 'tft'];
	}

	public function get_style_depends()
	{
		return ['travelfic-slider-hero'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	public function tf_search_types() {
		$types = array(
			'all'   => __( 'All', 'tourfic' ),
			'hotel' => __( 'Hotel', 'tourfic' ),
			'tour'  => __( 'Tour', 'tourfic' ),
		);

		if ( function_exists('is_tf_pro') && is_tf_pro() ) {
			$types['booking']   = __( 'Booking.com', 'tourfic' );
			$types['tp-flight'] = __( 'TravelPayouts Flight', 'tourfic' );
			$types['tp-hotel']  = __( 'TravelPayouts Hotel', 'tourfic' );
		}

		return $types;
	}


	protected function register_controls()
	{

		$this->start_controls_section(
			'hero_slider',
			[
				'label' => esc_html__('Slider Items', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'slider_image',
			[
				'label' => esc_html__('Slider Image', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'slider_title',
			[
				'label' => esc_html__('Slider Title', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('It is Time To Explore The World', 'travelfic-toolkit'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_subtitle',
			[
				'label' => esc_html__('Slider Subtitle', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('A There are many variatio of passage of Lorem for a Ipsum available  Lorem for a Ipsum available dummy lorem text.', 'travelfic-toolkit'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_bttn_txt',
			[
				'label' => esc_html__('Slider Text', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Explore Now', 'travelfic-toolkit'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_bttn_url',
			[
				'label' => esc_html__('Button URL', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('#', 'travelfic-toolkit'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_slider_list',
			[
				'label' => esc_html__('Repeater List', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tf_serach_box',
			[
				'label' => esc_html__('Search Box', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_box_switcher',
			[
				'label'   => esc_html__('Enable Search Box?', 'travelfic-toolkit'),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'description' =>  esc_html__('Turn On to active the Searchbox', 'travelfic-toolkit'),
				'default' => '1',
			]
		);
		
		$this->add_control(
			'type',
			[
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'label'    => esc_html__( 'Type', 'tourfic' ),
				'multiple' => true,
				'options'  => $this->tf_search_types(),
				'default'  => [ 'all' ],
			]
		);

		// $this->add_control(
		// 	'slider_search_code',
		// 	[
		// 		'label' => esc_html__('Search Shortcode', 'travelfic-toolkit'),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'placeholder' => esc_html__('[tf_search_form type="tour"]', 'travelfic-toolkit'),
		// 		'description' =>  esc_html__("Add the search shortcode", 'travelfic-toolkit'),
		// 		'label_block' => true,
		// 	]
		// );
		$this->end_controls_section();


		$this->start_controls_section(
			'slider_settings',
			[
				'label' => esc_html__('Slider Control', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_height',
			[
				'label' => esc_html__('Slider Height(px)', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 900,
			],
		);
		$this->add_control(
			'slider_opacity',
			[
				'label' => esc_html__('Slider Opacity(%)', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 35,
			],
		);
		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Slider Typo Style', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_title',
				'selector' => '{{WRAPPER}} .tft-slider-title .tft-title',
				'label' => esc_html__('Title Style', 'travelfic-toolkit')
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Title Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .tft-slider-title .tft-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_sub_title',
				'selector' => '{{WRAPPER}} .tft-sub-title p',
				'label' => esc_html__('Subtitle Style', 'travelfic-toolkit')
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__('Subtitle Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .tft-sub-title p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'slider_nav',
			[
				'label' => esc_html__('Slider Nav Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} .tft-hero-slider-selector button.slick-arrow' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tft-hero-slider-selector .slider__counter' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_button_style',
			[
				'label' => esc_html__('Slider Button Style', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slider_button_margin',
			[
				'label' => esc_html__('Margin', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slider-button .bttn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider_button_padding',
			[
				'label' => esc_html__('Padding', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slider-button .bttn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('button_style_tabs');

		// Normal state tab
		$this->start_controls_tab(
			'button_normal',
			[
				'label' => __('Normal', 'travelfic-toolkit'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .slider-button .bttn',
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slider-button .bttn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__('Background Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} .slider-button .bttn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover state tab
		$this->start_controls_tab(
			'button_hover',
			[
				'label' => esc_html__('Hover', 'travelfic-toolkit'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __('Text Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slider-button .bttn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__('Background Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#D83B0B',
				'selectors' => [
					'{{WRAPPER}} .slider-button .bttn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'slider_serach_style',
			[
				'label' => __('Serach Style', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_search_tab',
				'label' => esc_html__('Search Tab', 'travelfic-toolkit'),
				'selector' => '{{WRAPPER}} .tf-booking-form-tab button',
			]
		);
		$this->add_control(
			'slider_search_tab_color',
			[
				'label' => esc_html__('Tab Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} button.tf-tablinks' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider_search_tab_background',
			[
				'label' => esc_html__('Tab Background', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} button.tf-tablinks' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider_search_tab_color_active',
			[
				'label' => esc_html__('Active Tab Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} button.tf-tablinks.active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'slider_search_tab_background_active',
			[
				'label' => esc_html__('Active Tab background', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} button.tf-tablinks.active' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_search_input_style',
				'label' => esc_html__('Search Fields Typo', 'travelfic-toolkit'),
				'selector' => '{{WRAPPER}} .tf_homepage-booking input, .tf_homepage-booking ::placeholder, .tft-search-box .tf_input-inner *',
			]
		);
		$this->add_control(
			'slider_search_input_color',
			[
				'label' => esc_html__('Search Field Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} .tft-search-box .tf_input-inner div' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .tft-search-box .tf_input-inner *' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .tf_homepage-booking ::placeholder' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_search_button',
				'label' => esc_html__('Search Button Typo', 'travelfic-toolkit'),
				'selector' => '{{WRAPPER}} .tft-search-box .tf_button',
			]
		);

		$this->start_controls_tabs('button_search_button');

		// Normal state tab
		$this->start_controls_tab(
			'search_button_normal',
			[
				'label' => esc_html__('Normal', 'travelfic-toolkit'),
			]
		);
		$this->add_control(
			'search_button_text_color',
			[
				'label' => esc_html__('Button Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .tft-search-box .tf_button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'search_button_background_color',
			[
				'label' => esc_html__('Button Background', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#F15D30',
				'selectors' => [
					'{{WRAPPER}} .tft-search-box .tf_button' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		// Hover state tab
		$this->start_controls_tab(
			'search_button_hover',
			[
				'label' => esc_html__('Hover', 'travelfic-toolkit'),
			]
		);

		$this->add_control(
			'search_button_hover_color',
			[
				'label' => __('Button Color', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .tft-search-box .tf_button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_button_background_hover_color',
			[
				'label' => esc_html__('Button Background', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '##D83B0B',
				'selectors' => [
					'{{WRAPPER}} .tft-search-box .tf_button:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$type_arr           = !is_array($settings['type']) ? array($settings['type']): $settings['type'];
        $type               = $settings['type'] ? implode( ',', $type_arr ) : implode( ',', [ 'all' ] );
		?>
		<style>
			.tft-hero-slider-selector .tft-hero-single-item::before {
				background: rgb(0 0 0 / <?php echo $settings['slider_opacity'] ?>%);
			}
		</style>
		<?php
		if ($settings['hero_slider_list']) { ?>
			<!-- Slider Hero section -->

			<div class="hero--slider-wrapper"> <!-- tft-customizer-typography -->
				<?php $rand_number = rand(); ?>
				<div class="tft-hero-slider-selector tft-hero-slider-selector-<?php echo $rand_number ?>">
					<?php foreach ($settings['hero_slider_list'] as $item) : ?>
						<div class="tft-hero-single-item">
							<div class="tft-slider-bg-img" style="background-image: url(<?php echo esc_url($item['slider_image']['url']); ?>);height: <?php echo $settings['slider_height'] ?>px;">
								<div class="tft-container tft-hero-single-item-inner">
									<div class=" slider-inner-info">
										<div class="tft-slider-title">
											<h1 class="tft-title title-large"> <?php echo esc_html($item['slider_title']); ?> </h1>
											<?php
											if ($item['slider_subtitle'] != '') { ?>
												<div class="tft-sub-title">
													<p> <?php echo esc_html($item['slider_subtitle']); ?> </p>
												</div>
											<?php }
											?>

										</div>
										<div class="slider-button">
											<a class="bttn tft-bttn-primary" href="<?php echo $item['slider_bttn_url'] ?>">
												<div class="tft-custom-bttn">
													<span><?php echo esc_html($item['slider_bttn_txt']); ?></span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="slider-progress">
					<span></span>
				</div>
			</div>
			<?php if ($settings['search_box_switcher'] == 'yes') : ?>
				<div class="tft-search-box">
					<div class="tft-search-box-inner">
						<?php //echo sanitize_text_field($settings['slider_search_code']); ?>
						<?php echo do_shortcode( '[tf_search_form  type="' . $type . '" ]' );  ?>
					</div>
				</div>
			<?php endif; ?>
			<script>
				// Home Slider
				(function($) {
					"use strict";
					$(document).ready(function() {
						//Your Code Inside 
						$('.tft-hero-slider-selector-<?php echo $rand_number ?>').slick({
							dots: false,
							infinite: true,
							slidesToShow: 1,
							arrows: true,
							fade: true,
							speed: 500,
							infinite: true,
							cssEase: 'ease-in-out',
							touchThreshold: 100,
							autoplay: false,
							autoplaySpeed: 2000,
							nextArrow: '<button class="slick-next slick-arrow"> </button>',
							prevArrow: '<button class="slick-prev slick-arrow"> </button>'
						});
					});

					// Counter Number
					var $tfSliderHero = $('.tft-hero-slider-selector-<?php echo $rand_number ?>');
					console.log($tfSliderHero);

					if ($tfSliderHero.length) {
						var currentSlide;
						var sliderCounter = document.createElement('div');
						sliderCounter.classList.add('slider__counter');
						var updateSliderCounter = function(slick) {
							currentSlide = slick.slickCurrentSlide() + 1;
							currentSlide = ('0000' + currentSlide).match(/\d{2}$/);
							$(sliderCounter).text(currentSlide)
						};
						$tfSliderHero.on('init', function(event, slick) {
							$tfSliderHero.append(sliderCounter);
							updateSliderCounter(slick);
						});
						$tfSliderHero.on('afterChange', function(event, slick, currentSlide) {
							updateSliderCounter(slick, currentSlide);
						});
						$tfSliderHero.slick();

					}
				}(jQuery));
			</script>
		<?php } ?>
		<?php
		do_action('slider_style', $rand_number);
		?>
<?php

	}
}