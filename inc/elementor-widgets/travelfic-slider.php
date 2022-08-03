<?php
class TravelFicSlider extends \Elementor\Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tf-slider';
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
	public function get_title() {
		return esc_html__( 'TFT Hero Slider', 'travelfic' );
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
	public function get_icon() {
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
	public function get_custom_help_url() {
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
	public function get_categories() {
		return [ 'travelfic' ];
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
	public function get_keywords() {
		return [ 'travelfic', 'slider', 'hero', 'tft' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'hero_slider',
			[
				'label' => esc_html__( 'Slider Items', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'slider_image', [
                'label' => __( 'Slider Image', 'travelfic' ),
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
            'slider_title', [
                'label' => __( 'Slider Title', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'It’s Time To
				Explore The World', 'travelfic' ),
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'slider_subtitle', [
                'label' => __( 'Slider Subtitle', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'A There are many variatio of passage of Lorem for a Ipsum available  Lorem for a Ipsum available dummy lorem text.', 'travelfic' ),
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'slider_bttn_txt', [
                'label' => __( 'Slider Text', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore Now', 'travelfic' ),
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'slider_bttn_url', [
                'label' => __( 'Button URL', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'travelfic' ),
                'label_block' => true,
            ]
        );

		$this->add_control(
			'hero_slider_list',
			[
				'label' => esc_html__( 'Repeater List', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tf_serach_box',
			[
				'label' => __( 'Search Box', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_box_switcher',
			[
				'label'   => __( 'Enable Search Box?', 'travelfic' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'description' =>  __( 'Turn On to active the Searchbox', 'travelfic' ),
				'default' => '1',
			]
		);
        $this->add_control(
            'slider_search_code', [
                'label' => __( 'Search Shortcode', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '[tf_search_form type="tour"]', 'travelfic' ),
				'description' =>  __( "[tf_search_form type='tour']", 'travelfic' ),
                'label_block' => true,
            ]
        );
		$this->end_controls_section();


        $this->start_controls_section(
            'my_section',
            [
                'label' => esc_html__( 'Slider Control', 'travelfic' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'slider_height',
			[
				'label' => esc_html__( 'Slider Height(px)', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 900,
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Slider Style', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_title',
				'selector' => '{{WRAPPER}} .tft-slider-title h1',
				'label' => esc_html('Title Style', 'travelfic')
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_sub_title',
				'selector' => '{{WRAPPER}} .tft-sub-title p',
				'label' => esc_html('Subtitle Style', 'travelfic')
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_button_style',
				'selector' => '{{WRAPPER}} .slider-button a',
				'label' => esc_html('Slider Button Style', 'travelfic')
			]
		);

	}

	

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['hero_slider_list'] ) { ?>
            <!-- Slider Hero section -->
            
            <div class="hero--slider-wrapper tft-customizer-typography">
				<?php $rand_number = rand(); ?>
                <div class="tft-hero-slider-selector tft-hero-slider-selector-<?php echo $rand_number ?>">
                    <?php foreach( $settings['hero_slider_list'] as $item ) : ?>
                        <div class="tft-hero-single-item">
                            <div class="tft-slider-bg-img" style="background-image: url(<?php echo $item['slider_image']['url']?>);height: <?php echo $settings['slider_height'] ?>px;

                            ">
                                <div class="tft-container tft-hero-single-item-inner">
                                    <div class=" slider-inner-info">
                                        <div class="tft-slider-title">
                                            <h1 class="tft-title title-large"> <?php echo $item['slider_title']?> </h1>
											
												<?php 
													if(  $item['slider_subtitle'] != '' ){ ?>
													<div class="tft-sub-title">
														<p> <?php echo $item['slider_subtitle']?> </p>
													</div>
													<?php }
												?>
												
                                        </div>
                                        <div class="slider-button">
                                            <a class="bttn tft-bttn-primary" href="<?php echo $item['slider_bttn_url']?>">
                                                <div class="tft-custom-bttn">
                                                    <span><?php echo $item['slider_bttn_txt']?></span>
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
			 
			<?php if( $settings['search_box_switcher'] == 'yes' ) : ?>

			<div class="tft-search-box">
                <div class="tft-search-box-inner">

                    <?php echo $settings['slider_search_code']; ?>

                </div>
            </div>
			<?php endif; ?>

        <script>
        // Home Slider
        	(function ($) {
            "use strict";
				$(document).ready(function () {
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
					autoplaySpeed: 2000
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
						currentSlide = ('0000'+currentSlide).match(/\d{2}$/);
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
    <?php }
	?>

	<?php 
		do_action( 'slider_style', $rand_number );
	?>
	
	<?php

	}
}