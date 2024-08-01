<?php
class Travelfic_Toolkit_SliderHero extends \Elementor\Widget_Base

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
    public function get_name() {
        return 'tft-slider-hero';
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
        return esc_html__( 'Travelfic Slider Hero', 'travelfic-toolkit' );
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
    public function get_keywords() {
        return ['travelfic', 'slider', 'hero', 'tft'];
    }

    public function get_style_depends() {
        return ['travelfic-toolkit-slider-hero'];
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
            'all'   => __( 'All', 'travelfic-toolkit' ),
            'hotel' => __( 'Hotel', 'travelfic-toolkit' ),
            'tour'  => __( 'Tour', 'travelfic-toolkit' ),
        );

        if ( function_exists( 'is_tf_pro' ) && is_tf_pro() ) {
            $types['booking'] = __( 'Booking.com', 'travelfic-toolkit' );
            $types['tp-flight'] = __( 'TravelPayouts Flight', 'travelfic-toolkit' );
            $types['tp-hotel'] = __( 'TravelPayouts Hotel', 'travelfic-toolkit' );
        }

        return $types;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'hero_slider',
            [
                'label' => __( 'Slider Items', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slider_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Design', 'travelfic-toolkit' ),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __( 'Design 1', 'travelfic-toolkit' ),
                    'design-2'  => __( 'Design 2', 'travelfic-toolkit' ),
                ],
            ]
        );
        $repeater = new \Elementor\Repeater ();
        $repeater->add_control(
            'slider_image',
            [
                'label'   => __( 'Slider Image', 'travelfic-toolkit' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
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
                'label'       => __( 'Slider Title', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'It is Time To Explore The World', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_subtitle',
            [
                'label'       => __( 'Slider Subtitle', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'A There are many variatio of passage of Lorem for a Ipsum available  Lorem for a Ipsum available dummy lorem text.', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_bttn_txt',
            [
                'label'       => __( 'Slider Text', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Explore Now', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_bttn_url',
            [
                'label'       => __( 'Button URL', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( '#', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'hero_slider_list',
            [
                'label'       => __( 'Repeater List', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ slider_title }}}',
                'condition'   => [
                    'slider_style' => 'design-1', // Add condition for Design 1 here
                ],
            ]
        );

        // Design 2 fields
        $this->add_control(
			'banner_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Banner Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Banner title', 'travelfic-toolkit' ),
                'default' => __( 'Embark on extraordinary voyages and explorations', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
			]
		);
        $this->add_control(
            'banner_image',
            [
                'label'   => __( 'Banner Image', 'travelfic-toolkit' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tf_serach_box',
            [
                'label' => __( 'Search Box', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'search_box_switcher',
            [
                'label'       => __( 'Enable Search Box?', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => __( 'Turn On to active the Searchbox', 'travelfic-toolkit' ),
                'default'     => 'yes',
            ]
        );

        $this->add_control(
            'type',
            [
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'label'    => __( 'Type', 'travelfic-toolkit' ),
                'multiple' => true,
                'options'  => $this->tf_search_types(),
                'default'  => ['all'],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __( 'Slider Control', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => esc_html__('Slider Height(px)', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 800, // Your default value here
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-slider-bg-img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tft-hero-design-2' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'hero_style_section',
            [
                'label' => __( 'Slider Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'banner_bg_color',
            [
                'label' => __('Background', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1D1D1D94',
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-slider-selector .tft-hero-single-item::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'banner_inner_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-hero-design-2 .tft-hero-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'slider_title',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'slider_title_spacing',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-hero-content h1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-slider-title .tft-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_title',
                'selector' => '{{WRAPPER}} .tft-slider-title .tft-title',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'banner_title',
                'selector' => '{{WRAPPER}} .tft-hero-content h1',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-slider-title .tft-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-design-2 .tft-hero-content h1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-content .tf-booking-form-tab button.active' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'shortcode_form_style',
            [
                'label'     => __( 'Form Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'shortcode_form_typo',
                'selector' => '{{WRAPPER}} .tft-search-form, {{WRAPPER}} .tft-search-form button, {{WRAPPER}} .tft-search-form input',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );

        $this->add_control(
            'shortcode_form_background',
            [
                'label'     => __( 'Form Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(48, 40, 28, 0.3)',
                'selectors' => [
                    '{{WRAPPER}} .tf_booking-widget-design-2' => 'background: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'shortcode_form_button',
            [
                'label'     => __( 'Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tf_booking-widget-design-2 .tf_hotel_searching .tf_form_innerbody .tf_availability_checker_box button' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-content .tf-booking-form-tab button.active' => 'background: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'slider_subtitle',
            [
                'label'     => __( 'Sub title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_sub_title',
                'selector' => '{{WRAPPER}} .tft-sub-title p',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'sub_title_color',
            [
                'label'     => __( 'Subtitle Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-sub-title p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_nav_style',
            [
                'label'     => __( 'Navigation ', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_nav',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-slider-selector button.slick-arrow' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tft-hero-slider-selector .slider__counter'   => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        //Buttons
        $this->add_control(
            'slider_buttons_style',
            [
                'label'     => __( 'Button Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_button_margin_',
            [
                'label'      => __( 'Margin', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-button .bttn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_button_padding_',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-button .bttn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->start_controls_tabs( 'button_style_tabs_' );

        $this->start_controls_tab(
            'button_normal_',
            [
                'label' => __( 'Normal', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .slider-button .bttn',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Text Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'label'     => __( 'Background Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'Hover', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => __( 'Text Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label'     => __( 'Background Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#D83B0B',
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'slider_serach_style',
            [
                'label' => __( 'Search Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'search_box',
            [
                'label'     => __( 'Search Box', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_responsive_control(
            'search_box_padding',
            [
                'label' => __( 'Padding', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 40,
                    'right' => 40,
                    'bottom' => 40,
                    'left' => 40,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tft-search-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_box_border_radius',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_tab',
            [
                'label'     => __( 'Search Tab', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_search_tab',
                'label'    => __( 'Search Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tf-booking-form-tab button',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_color',
            [
                'label'     => __( 'Tab Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_background',
            [
                'label'     => __( 'Tab Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks' => 'background: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_color_active',
            [
                'label'     => __( 'Active Tab Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks.active' => 'color: {{VALUE}} !important',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_background_active',
            [
                'label'     => __( 'Active Tab background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks.active' => 'background: {{VALUE}} !important',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_tab_border_width',
            [
                'label' => __( 'Border Width', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tf-booking-form-tab button.tf-tablinks' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_tab_border_color',
            [
                'label'     => __( 'Tab Border Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .tf-booking-form-tab button.tf-tablinks' => 'border-color: {{VALUE}} !important',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_tab_border_radius',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tf-booking-form-tab button.tf-tablinks' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_search_button_padding_',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tf-booking-form-tab button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'slider_search_input',
            [
                'label'     => __( 'Search Form', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_border_width',
            [
                'label' => __( 'Border Width', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_homepage-booking' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_border_color',
            [
                'label'     => __( 'Border Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D3040',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_homepage-booking' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_border_radius',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_homepage-booking' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_search_input_style',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-search-box .tf_input-inner div, .tf_homepage-booking input, .tf_homepage-booking ::placeholder, .tft-search-box .tf_input-inner',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_input_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_input-inner div' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tft-search-box .tf_input-inner' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tf_homepage-booking ::placeholder' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'slider_button',
            [
                'label'     => __( 'Button', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_search_button',
                'label'    => __( 'Search Button Typo', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-search-box .tf_button',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_border_width',
            [
                'label' => __( 'Border Width', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_border_color',
            [
                'label' => __( 'Border Color', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_border_radius',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->start_controls_tabs( 'button_search_button' );

        // Normal state tab
        $this->start_controls_tab(
            'search_button_normal',
            [
                'label' => __( 'Normal', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_text_color',
            [
                'label'     => __( 'Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_background_color',
            [
                'label'     => __( 'Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'search_button_hover',
            [
                'label' => __( 'Hover', 'travelfic-toolkit' ),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'search_button_hover_color',
            [
                'label'     => __( 'Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'search_button_background_hover_color',
            [
                'label'     => __( 'Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#D83B0B',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button:hover' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $type_arr = !is_array( $settings['type'] ) ? array( $settings['type'] ) : $settings['type'];
        $type = $settings['type'] ? implode( ',', $type_arr ) : implode( ',', ['all'] );

        // Design
        if ( !empty( $settings['slider_style'] ) ) {
            $tft_design = $settings['slider_style'];
        }
        if ( !empty( $settings['banner_title'] ) ) {
            $tft_banner_title = $settings['banner_title'];
        }
        if ( !empty( $settings['banner_image'] ) ) {
            $tft_banner_image = $settings['banner_image'];
        }

        if("design-2"==$tft_design){
        ?>
        <div class="tft-hero-design-2" style="background-image: url(<?php echo esc_url($tft_banner_image['url']); ?>);">
            <div class="tft-hero-content">
                <?php
                if(!empty($tft_banner_title)){ ?>
                <h1><?php echo esc_html($tft_banner_title); ?></h1>
                <?php } ?>
                <?php if ( $settings['search_box_switcher'] == 'yes' ){ ?>
                <div class="tft-search-form">
                    <?php echo do_shortcode( '[tf_search_form  type="' . $type . '" design="2"]' ); ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php }else{ ?>

		<?php
		if ( $settings['hero_slider_list'] ) { ?>
			<!-- Slider Hero section -->
			<div class="hero--slider-wrapper tft-hero-design-1"> <!-- tft-customizer-typography -->
				<?php $rand_number = wp_rand(100,99999999);?>
				<div class="tft-hero-slider-selector tft-hero-slider-selector-<?php echo esc_html($rand_number) ?>">
					<?php foreach ( $settings['hero_slider_list'] as $item ): ?>
						<div class="tft-hero-single-item">
							<div class="tft-slider-bg-img" style="background-image: url(<?php echo esc_url( $item['slider_image']['url'] ); ?>);">
								<div class="tft-container tft-hero-single-item-inner">
									<div class=" slider-inner-info">
										<div class="tft-slider-title">
											<h1 class="tft-title title-large">
											<?php
												if ( !empty( $item['slider_title'] ) ) {
												echo esc_html( $item['slider_title'] );
											}?>
											</h1>
											<?php if ( $item['slider_subtitle'] != '' ) {?>
												<div class="tft-sub-title">
													<p> <?php echo esc_html( $item['slider_subtitle'] ); ?> </p>
												</div>
											<?php }?>
										</div>
										<div class="slider-button">
                                            <?php
                                                if ( !empty( $item['slider_bttn_url'] ) ) { ?>
                                                    <a class="bttn tft-bttn-primary" href="<?php echo esc_url($item['slider_bttn_url']) ?>">
                                                        <div class="tft-custom-bttn">
                                                            <span>
                                                                <?php
                                                                if ( !empty( $item['slider_bttn_txt'] ) ) {
                                                                    echo esc_html( $item['slider_bttn_txt'] );
                                                                }?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                <?php }
                                            ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach;?>
				</div>
				<div class="slider-progress">
					<span></span>
				</div>
			</div>
			<?php if ( $settings['search_box_switcher'] == 'yes' ): ?>
				<div class="tft-search-box tft-hero-design-1">
					<div class="tft-search-box-inner">
						<?php echo do_shortcode( '[tf_search_form  type="' . esc_attr($type) . '" ]' ); ?>
					</div>
				</div>
			<?php endif;?>
			<script>
				// Home Slider
				(function($) {
					"use strict";
					$(document).ready(function() {
						//Your Code Inside
						$('.tft-hero-slider-selector-<?php echo esc_html($rand_number) ?>').slick({
							dots: false,
							infinite: true,
							slidesToShow: 1,
							fade: true,
							speed: 500,
							infinite: true,
							cssEase: 'ease-in-out',
							touchThreshold: 100,
							autoplay: false,
                            arrows: true,
            	            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            	            nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
							autoplaySpeed: 2000
						});
					});

					// Counter Number
					var $tfSliderHero = $('.tft-hero-slider-selector-<?php echo esc_html($rand_number) ?>');

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
						//$tfSliderHero.slick();

					}
				}(jQuery));
			</script>
		<?php
        do_action( 'slider_style', esc_html($rand_number) );
        }
        }
    }
}