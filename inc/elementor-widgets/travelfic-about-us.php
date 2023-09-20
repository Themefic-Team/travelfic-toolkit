<?php
class Travelfic_Toolkit_AboutUs extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * Retrieve  widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'tft-about-us';
    }

    /**
     * Get widget title.
     *
     * Retrieve  widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Travelfic About Us', 'travelfic-toolkit' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve  widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-hotspot';
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
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['travelfic'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['travelfic', 'about', 'about us', 'tft'];
    }

    public function get_style_depends(){
        return ['travelfic-toolkit-about-us'];
    }

    /**
     * Register widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        
        $this->start_controls_section(
            'tft-about-us',
            [
                'label' => __( 'About Us', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        // Design
        $this->add_control(
            'tft_about_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Design', 'travelfic-toolkit' ),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __( 'Design 1', 'travelfic-toolkit' ),
                ],
            ]
        );
        // Design 1 fields
        $this->add_control(
			'about_us_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
                'default' => __( 'Enjoy an extraordinary retreat with us', 'travelfic-toolkit' ),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
			]
		);
        $this->add_control(
			'about_us_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'about us', 'travelfic-toolkit' ),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
			]
		);
        $this->add_control(
			'about_us_experience',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Years of Experience', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter Years of Experience', 'travelfic-toolkit' ),
                'default' => __( '15+', 'travelfic-toolkit' ),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
			]
		);
        $this->add_control(
            'about_us_image',
            [
                'label'   => __( 'About Us Image', 'travelfic-toolkit' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
			'about_us_content',
			[
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'Welcome to VICTORIA, where comfort meets elegance. Personalized service and attention to detail ensure a truly exceptional stay. Stay in luxury, dine exquisitely, and relax in the spa. With us, you can create unforgettable memories. 
                
                "Creating memorable moments is our passion. Welcome to our hotel, where comfort, elegance, and genuine hospitality meet."', 'travelfic-toolkit' ),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
			]
		);
        $this->add_control(
			'readme_link',
			[
				'type' => \Elementor\Controls_Manager::URL,
				'label' => esc_html__( 'Read More URL', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter Link', 'travelfic-toolkit' ),
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
			]
		);

    
        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'tour_destination_style',
            [
                'label' => __( 'Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Design 1 Styles start
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h3',
                'label'    => __( 'Title Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ]
            ]
        );
        $this->add_control(
            'about_us_sec_title_color',
            [
                'label'     => __( 'Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h6',
                'label'    => __( 'Subtitle Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'about_us_sec_subtitle_color',
            [
                'label'     => __( 'Subtitle Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_content_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content p',
                'label'    => __( 'Content Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'about_us_sec_content_color',
            [
                'label'     => __( 'Content Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_years_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .years-of-experience .tft-experience-years span',
                'label'    => __( 'Years of Experience Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ]
            ]
        );
        $this->add_control(
            'about_us_years_color',
            [
                'label'     => __( 'Years of Experience Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .years-of-experience .tft-experience-years span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_button_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a',
                'label'    => __( 'Button Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );
        $this->add_control(
            'about_us_button_color',
            [
                'label'     => __( 'Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a' => 'color: {{VALUE}};border-color: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a span svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

    }

   
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Design
        if ( !empty( $settings['tft_about_style'] ) ) {
            $tft_design = $settings['tft_about_style'];
        }

        if ( !empty( $settings['about_us_title'] ) ) {
            $tft_sec_title = $settings['about_us_title'];
        }
        if ( !empty( $settings['about_us_subtitle'] ) ) {
            $tft_sec_subtitle = $settings['about_us_subtitle'];
        }
        if ( !empty( $settings['about_us_content'] ) ) {
            $tft_sec_content = $settings['about_us_content'];
        }
        if ( !empty( $settings['about_us_image'] ) ) {
            $tft_about_us_image = $settings['about_us_image'];
        }
        if ( !empty( $settings['about_us_experience'] ) ) {
            $tft_about_us_experience = $settings['about_us_experience'];
        }

    if("design-1"==$tft_design){
    ?>

	<div class="tft-about-us-wrapper tft-customizer-typography tft-w-padding">
    	<div class="tft-about-us tft-row">
            <div class="tft-about-us-grid">
                <div class="tft-about-us-content">
                    <?php 
                    if(!empty($tft_sec_subtitle)){ ?>
                        <h6><?php echo esc_html( $tft_sec_subtitle ); ?></h6>
                    <?php } if(!empty($tft_sec_title)){ ?>
                        <h3><?php echo esc_html( $tft_sec_title ); ?></h3>
                    <?php } if(!empty($tft_sec_content)){ ?>
                        <p><?php echo esc_html( $tft_sec_content ); ?></p>
                    <?php } ?>

                    <div class="read-more">
                        <a href="<?php echo esc_url($settings['readme_link']['url']); ?>">
                            <?php echo __("More", "travelfic-toolkit"); ?>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
                                <path d="M56.7071 8.86336C57.0976 8.47283 57.0976 7.83967 56.7071 7.44914L50.3431 1.08518C49.9526 0.694658 49.3195 0.694658 48.9289 1.08518C48.5384 1.47571 48.5384 2.10887 48.9289 2.4994L54.5858 8.15625L48.9289 13.8131C48.5384 14.2036 48.5384 14.8368 48.9289 15.2273C49.3195 15.6178 49.9526 15.6178 50.3431 15.2273L56.7071 8.86336ZM0 9.15625H56V7.15625H0V9.15625Z" fill="#B58E53"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="tft-about-us-image">
                    <?php 
                    if(!empty($tft_about_us_experience)){ ?>
                    <div class="years-of-experience">
                        <img src="<?php echo esc_url( TRAVELFIC_TOOLKIT_URL.'assets/app/img/years-experience.png' ); ?>" alt="">
                        <div class="tft-experience-years">
                            <span><?php echo esc_html( $tft_about_us_experience ); ?></span>
                        </div>
                    </div>
                    <?php } ?>
                    <?php 
                    if(!empty($tft_about_us_image['url'])){ ?>
                    <div class="tft-about-image">
                        <img src="<?php echo esc_url($tft_about_us_image['url']); ?>" alt="About Us Image">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
<?php
}
}