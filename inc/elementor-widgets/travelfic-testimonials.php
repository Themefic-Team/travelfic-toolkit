<?php
class Testimonials extends \Elementor\Widget_Base {

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
		return 'tf-testimonials';
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
		return esc_html__( 'TFT Testimonials', 'travelfic' );
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
		return 'eicon-testimonial-carousel';
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
		return [ 'travelfic', 'reveiw', 'testimonials', 'tft' ];
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
			'tf-testimonials',
			[
				'label' => esc_html__( 'Slider Items', 'travelfic' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'person_image', [
                'label' => esc_html__( 'Image', 'travelfic' ),
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
            'person_name', [
                'label' => esc_html__( 'Name', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'John Doe', 'travelfic' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'designation', [
                'label' => esc_html__( 'Designation', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'CEO', 'travelfic' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testimonials_review', [
                'label' => __( 'Review Details', 'travelfic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore'
            ]
        );
        $repeater->add_control(
            'rate',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Rattings', 'travelfic' ),
                'default' => '5',
                'options' => [
                    '1'  => __('&#9733;','cafetora'),
                    '2'  => __('&#9733;&#9733;','cafetora'),
                    '3'  => __('&#9733;&#9733;&#9733;','cafetora'),
                    '4'  => __('&#9733;&#9733;&#9733;&#9733;','cafetora'),
                    '5'  => __('&#9733;&#9733;&#9733;&#9733;&#9733;','cafetora'),
                ],
            ]
        );

		$this->add_control(
			'testimonials_section',
			[
				'label' => esc_html__( 'Testimonials List', 'travelfic' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ person_name }}}',
			]
		);


		$this->end_controls_section();

	}


    private function testimonials_rattings( $rate ){
        if( $rate ){
            for ($i=1; $i <= $rate; $i++) {                    
                echo '<i class="fas fa-star"></i>';
            }
        }
    }

	protected function render() {
	$settings = $this->get_settings_for_display(); ?>
    
    <?php if( $settings['testimonials_section'] ) : ?>
        
        <div class="tft-testimonials-wrapper tft-customizer-typography">
            <div class="tft-testimonials-selector tft-slide-default">
                <?php 

                    if($settings['testimonials_section']){
                        foreach ($settings['testimonials_section'] as $item) { ?>
                            <div class="tft-single-testimonial">
                                <div class="tft-testimonials-inner">
                                    <div class="testimonial-header">
                                        <div class="person-avatar">
                                        <?php echo wp_get_attachment_image( $item['person_image']['id'], "team-image", "", array( "class" => "circle" ) ); ?>
                                        </div>
                                        <div class="person-info">
                                            <h4 class="person-name"> <?php echo esc_html( $item['person_name'] ) ?> </h4>
                                            <p><?php echo esc_html( $item['designation'] ) ?></p>
                                        </div>
                                    </div>
                                    <div class="testimonial-body">
                                        <p><?php echo esc_html( $item['testimonials_review'] ) ?></p>
                                    </div>
                                    <div class="testimonial-footer">
                                        <?php $this->testimonials_rattings($item['rate']); ?>
                                    </div>
                                </div>
                            </div>
                    <?php }} ?>
            </div>

        <script>
        // Testimonials 
        (function ($) {
            "use strict";
            $(document).ready(function () {
            $('.tft-testimonials-selector').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 6000,  
                speed: 500,  
                dots: false,
                pauseOnHover:true,
                infinite: true,
                cssEase: 'linear',
                arrows: true,
                
                responsive: [
                    {
                    breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    }, 
                    {
                    breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
               
                ]
                });
            });
        }(jQuery)); 

        </script>
        
        </div>
        
    <?php endif ?>
    <?php
	}
}