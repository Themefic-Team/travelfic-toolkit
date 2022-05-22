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
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'slider_bttn_txt', [
                'label' => __( 'Slider Text', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click here', 'travelfic' ),
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
				'description' =>  __( 'Please Turn OFF the', 'travelfic' ),
				'default' => '1',
			]
		);
        $this->add_control(
            'slider_search_code', [
                'label' => __( 'Search Shortcode', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
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

	}

	

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['hero_slider_list'] ) { ?>
            <!-- Slider Hero section -->
            
            <div class="hero--slider-wrapper">
                <div class="tft-hero-slider-selector">
                    <?php foreach( $settings['hero_slider_list'] as $team ) : ?>
                        <div class="tft-hero-single-item">
                            <div class="tft-slider-bg-img" style="background-image: url(<?php echo $team['slider_image']['url']?>);height: <?php echo $settings['slider_height'] ?>px;

                            ">
                                <div class="tft-container tft-hero-single-item-inner">
                                    <div class=" slider-inner-info">
                                        <div class="tft-slider-title">
                                            <h1 class="tft-title title-large"> <?php echo $team['slider_title']?> </h1>
                                        </div>
                                        <div class="slider-button">
                                            <a class="bttn tft-bttn-primary" href="<?php echo $team['slider_bttn_url']?>">
                                                <div class="tft-custom-bttn">
                                                    <span><?php echo $team['slider_bttn_txt']?></span>
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

                    <!-- <form class="tft-search-box-form" action="#" method="get">
                        <div class="tft-search-box-container tft-container-flex">
                            <div class="tft-search-box-field">
                                <label for="search-destinations">Destinations</label>
                                <select name="search-destinations" id="destinations">
                                    <option value="Paris,France">Paris,France</option>
                                    <option value="Dhaka,Bangladesh">Dhaka,Bangladesh</option>
                                    <option value="Jakarta,Indonesia">Jakarta,Indonesia</option>
                                </select>
                            </div> 
                            <div class="tft-search-box-field">
                                <label for="check-in">Check In</label>
                                <input type="date" id="check-in" name="checkin">
                            </div>

                            <div class="tft-search-box-field">
                                <label for="price-range">Price Range</label>
                                <input type="text" name="price-range" id="price-range" value="$500 - $10,000">
                            </div>
                            <div class="tft-search-box-field">
                                <div class="slider-button tft-bttn-primary border-rds-4">
								<input id="submit" type="submit" value="Booking Now" class="tft-custom-bttn" />
                                </div>
                            </div>
                        </div>
                    </form> -->

                </div>
            </div>
			<?php endif; ?>

        <script>
        // Home Slider
        (function ($) {
            "use strict";
            $(document).ready(function () {
            //Your Code Inside 
            $('.tft-hero-slider-selector').slick({
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
            var $tfSliderHero = $('.tft-hero-slider-selector');
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
	}
}