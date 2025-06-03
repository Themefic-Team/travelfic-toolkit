<?php
class Travelfic_Toolkit_Testimonials extends \Elementor\Widget_Base
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
        return 'tft-testimonials';
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
        return esc_html__('Travelfic Testimonials', 'travelfic-toolkit');
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
        return ['travelfic', 'reveiw', 'testimonials', 'tft'];
    }
    public function get_style_depends()
    {
        return ['travelfic-toolkit-testimonials'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'tft-testimonials',
            [
                'label' => __('Slider Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Design
        $this->add_control(
            'testimonial_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Design', 'travelfic-toolkit'),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __('Design 1', 'travelfic-toolkit'),
                    'design-2'  => __('Design 2', 'travelfic-toolkit'),
                    'design-3'  => __('Design 3', 'travelfic-toolkit'),
                ],
            ]
        );

        // Design 2 fields
        $this->add_control(
            'testimonial_bg',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Testimonial Background', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-3'],
                ],
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/testimonial-bg.png',
                ],
            ]
        );
        $this->add_control(
            'des_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('What client’s say?', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'des_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Testimonials', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-3'],
                ],
            ]
        );

        $this->add_control(
            'des_content',
            [
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label' => esc_html__('Content', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your Content', 'travelfic-toolkit'),
                'default' => __('Competently predominate client based intsafgerfaces whereas cuttinadg edge niche markets  re engineer internal sources without installed.', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );



        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'person_image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
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
            'person_name',
            [
                'label'       => __('Name', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('John Doe', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'designation',
            [
                'label'       => __('Designation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('CEO', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testimonials_review',
            [
                'label'   => __('Review Details', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', 'travelfic-toolkit'),

            ]
        );
        $repeater->add_control(
            'rate',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Rattings', 'travelfic-toolkit'),
                'default' => '5',
                'options' => [
                    '1' => __('&#9733;', 'travelfic-toolkit'),
                    '2' => __('&#9733;&#9733;', 'travelfic-toolkit'),
                    '3' => __('&#9733;&#9733;&#9733;', 'travelfic-toolkit'),
                    '4' => __('&#9733;&#9733;&#9733;&#9733;', 'travelfic-toolkit'),
                    '5' => __('&#9733;&#9733;&#9733;&#9733;&#9733;', 'travelfic-toolkit'),
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-2'],
                ],
            ]
        );

        $this->add_control(
            'testimonials_section',
            [
                'label'       => __('Testimonials List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ person_name }}}',
            ]
        );
        $this->end_controls_section();

        // slider control settings check
        $this->start_controls_section(
            'testimonial_slider_control',
            [
                'label' => __('Slider Control', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],

            ]
        );
        $this->add_control(
            'testimonial_design3_slider_slidetoshow',
            [
                'label'       => __('Slide To Show', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 15,
                'step' => 1,
                'default' => 2,
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_slidetoscroll',
            [
                'label'       => __('Slide To Scroll', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_navigation',
            [
                'label'       => __('Navigation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'arrows',
                'options'     => [
                    'none' => __('None', 'travelfic-toolkit'),
                    'dots' => __('Dots', 'travelfic-toolkit'),
                    'arrows' => __('Arrows', 'travelfic-toolkit'),
                ],
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_autoplay',
            [
                'label'       => __('Autoplay', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 3000,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 100
                    ],
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_autoplay_interval',
            [
                'label' => esc_html__('Autoplay Interval', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1500,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 100
                    ],
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_loop',
            [
                'label' => esc_html__('Loop', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );


        $this->add_control(
            'testimonial_design3_slider_pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_pause_on_focus',
            [
                'label' => esc_html__('Pause On Focus', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_rtl',
            [
                'label' => esc_html__('RTL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'testimonial_style' => 'design-3',
                    'testimonial_design3_slider_loop!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'testimonial_design3_slider_draggable',
            [
                'label' => esc_html__('Draggable', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );


        $this->end_controls_section();

        // Style Section

        $this->start_controls_section(
            'tft_style_section',
            [
                'label' => __('Section', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-3'], // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tft_testimonial_section_bg',
            [
                'label'     => __('Section Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-3'], // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_testimonials_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonial-top-header h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonial-top-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'tft_testimonials_sub_title_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_testimonials_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonial-top-header h6',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonial-top-header .testimonial-header-shape h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );

        // design 3 
        $this->add_control(
            'tft_design_3_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-heading-content h2',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-heading-content h2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );
        // Title Backdrop
        $this->add_control(
            'tft_design_3_title_backdrop',
            [
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label' => esc_html__('Title Backdrop', 'travelfic-toolkit'),
                'default' => 'yes',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_title_backdrop_head',
            [
                'label'     => __('Title Backdrop', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => ['design-3'],
                    'tft_design_3_title_backdrop' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'tft_design_3_title_backdrop_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-heading-content h2::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                    'tft_design_3_title_backdrop' => 'yes',
                ],
            ]
        );


        // design 3 subtitle
        $this->add_control(
            'tft_design_3_sub_title_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-heading-content h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-heading-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-3'], // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_content_typo',
                'selector' => '{{WRAPPER}} .tft-heading-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-heading-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonials_style_section',
            [
                'label' => __('Item List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-2'], // Show this control only when testimonial_style is 'design-1'   
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_head',
            [
                'label'     => __('List Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testimonials_card_color',
            [
                'label'     => __('List Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_border_rds',
            [
                'label'     => __('Border Radius', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_space_bellow',
            [
                'label'     => __('Heading Space', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .testimonial-header' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_tour_item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_title',
                'selector' => '{{WRAPPER}} .tft-testimonials-selector .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_designation_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-selector .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_content',
                'selector' => '{{WRAPPER}} .tft-testimonials-selector .testimonial-body .tft-content',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .testimonial-body .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .testimonial-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );


        // Design 2 Styles
        $this->add_responsive_control(
            'testimonials_2_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_card_color',
            [
                'label'     => __('List Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FAEEDC',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_title',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-author p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
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
            'testimonials_2_title_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-author p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_designation',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_designation_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
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
            'testimonials_2_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_author',
            [
                'label'     => __('Author', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_author_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
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
            'testimonials_2_author_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_content',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
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
            'testimonials_2_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial .testimonial-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );


        $this->add_control(
            'testimonials_card_color_hover',
            [
                'label'     => __('Box Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_color_hover',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color_hover',
            [
                'label'     => __('Designation Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color_hover',
            [
                'label'     => __('Content Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_color_hover',
            [
                'label'     => __('Icon Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .testimonial-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-1', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );

        // Design 2 settings
        $this->add_control(
            'testimonials_2_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'testimonials_2_card_color_hover',
            [
                'label'     => __('Box Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FAEEDC',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'testimonials_2_title_color_hover',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-author p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_designation_color_hover',
            [
                'label'     => __('Designation Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-author p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_content_color_hover',
            [
                'label'     => __('Content Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-2 .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2', // Show this control only when testimonial_style is 'design-2'
                ],
            ]
        );

        $this->end_controls_section();

        // Testimonial design 3 team style settings
        $this->start_controls_section(
            'testimonials_style_3_section',
            [
                'label' => __('Team', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'testimonials_card_3_color',
            [
                'label'     => __('Team Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-slides .tft-single-testimonial' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_3_border_rds',
            [
                'label'     => __('Border Radius', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-slides .tft-single-testimonial' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_tour_item_card_3_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-slides .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_head_3',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_title_3',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_3_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_3',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_designation_3_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_3_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_head_3',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_content_3',
                'selector' => '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_3_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'testimonials_image_3_head',
            [
                'label'     => __('Image', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'testimonials_image_3_size',
            [
                'label'     => __('Image Size', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testimonials_nav_style',
            [
                'label' => __('Nav', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'testimonials_nav__arrow_width',
            [
                'label' => esc_html__('Size', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                    ],
                ],
                'default' => [
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_nav__border_width',
            [
                'label' => esc_html__('Border', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector button.slick-arrow' => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow' => 'border-width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );
        $this->add_control(
            'testimonials_nav_border_color',
            [
                'label'     => __('Border Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector button.slick-arrow' => 'border-color: {{VALUE}} !important',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow' => 'border-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'testimonials_nav_border_hover_color',
            [
                'label'     => __('Border Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector button.slick-arrow:hover' => 'border-color: {{VALUE}} !important',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow:hover' => 'border-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_nav_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-slide-default button.slick-arrow i' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow i' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_color_hover',
            [
                'label'     => __('Hover Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-slide-default button.slick-arrow:hover i' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow:hover i' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_nav_head',
            [
                'label'     => __('Nav', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testimonials_nav_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-slide-default button.slick-arrow' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-slide-default button.slick-arrow:hover' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .tft-testimonials-design-3 .tft-slider-arrows .tft-arrow:hover' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function testimonials_rattings($rate)
    {
        if ($rate) {
            for ($i = 1; $i <= $rate; $i++) {
                echo '<i class="fas fa-star"></i>';
            }
        }
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        // Design
        if (!empty($settings['testimonial_style'])) {
            $tft_design = $settings['testimonial_style'];
        }

        if (!empty($settings['des_title'])) {
            $tft_sec_title = $settings['des_title'];
        }
        $section_title_backdrop = $settings['tft_design_3_title_backdrop'] !== 'yes' ? ' tft-no-backdrop' : '';
        if (!empty($settings['des_subtitle'])) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }
        if (!empty($settings['des_content'])) {
            $tft_sec_content = $settings['des_content'];
        }
        if (!empty($settings['testimonial_bg'])) {
            $tft_testimonial_bg = $settings['testimonial_bg'];
        }

        // Items per page
        $slideToShow = !empty($settings['testimonial_design3_slider_slidetoshow']) ? $settings['testimonial_design3_slider_slidetoshow'] : 2;
        $postCount = isset($settings['testimonials_section']) ? count($settings['testimonials_section']) : 0;

        // Disable slider class
        $tftSliderDisable = false;
        $tftDisableClass = '';
        if ($postCount <= $slideToShow) {
            $tftSliderDisable = true;
            $tftDisableClass = 'tft-slider-disable';
        }

        // slider control settings check
        $design3_slide_to_scroll = !empty($settings['testimonial_design3_slider_slidetoscroll']) ? $settings['testimonial_design3_slider_slidetoscroll'] : 1;

        $design3_slider_nav = $settings['testimonial_design3_slider_navigation'];

        $design3_slider_arrows = ("arrows" === $design3_slider_nav) ? 'true' : 'false';
        $design3_slider_dots = ("dots" === $design3_slider_nav) ? 'true' : 'false';

        $design3_slider_autoplay = ('yes' === $settings['testimonial_design3_slider_autoplay']) ? 'true' : 'false';
        $design3_slider_autoplay_speed = !empty($settings['testimonial_design3_slider_autoplay_speed']) ? $settings['testimonial_design3_slider_autoplay_speed']['size'] : 0;
        $design3_slider_autoplay_interval = !empty($settings['testimonial_design3_slider_autoplay_interval']) ? $settings['testimonial_design3_slider_autoplay_interval']['size'] : 0;
        $design3_slider_loop = ('yes' === $settings['testimonial_design3_slider_loop']) ? 'true' : 'false';
        $design3_slider_pause_on_hover = ('yes' === $settings['testimonial_design3_slider_pause_on_hover']) ? 'true' : 'false';
        $design3_slider_pause_on_focus = ('yes' === $settings['testimonial_design3_slider_pause_on_focus']) ? 'true' : 'false';
        $design3_slider_rtl = ('yes' === $settings['testimonial_design3_slider_rtl']) ? 'true' : 'false';
        $design3_slider_draggable = ('yes' === $settings['testimonial_design3_slider_draggable']) ? 'true' : 'false';

?>

        <?php if ($settings['testimonials_section'] && "design-1" == $tft_design) { ?>
            <div class="tft-testimonials-wrapper tft-customizer-typography">
                <div class="tft-testimonials-selector tft-slide-default">
                    <?php if ($settings['testimonials_section']) {
                        foreach ($settings['testimonials_section'] as $item) { ?>
                            <div class="tft-single-testimonial">
                                <div class="tft-testimonials-inner">
                                    <div class="testimonial-header">
                                        <div class="person-avatar">
                                            <img src="<?php echo esc_url($item['person_image']['url']); ?>" alt="Image">
                                        </div>
                                        <div class="person-info">
                                            <p class="person-name"><?php echo esc_html($item['person_name']) ?></p>
                                            <p class="designation"><?php echo esc_html($item['designation']) ?></p>
                                        </div>
                                    </div>
                                    <div class="testimonial-body">
                                        <p class="tft-content"><?php echo esc_html($item['testimonials_review']) ?></p>
                                    </div>
                                    <div class="testimonial-footer">
                                        <?php $this->testimonials_rattings($item['rate']); ?>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="tft-slider-arrows tft-slider-arrows--mobile">
                    <button type='button' class='slick-prev pull-left'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <path d="M15.9999 21.3334L5.33325 32M5.33325 32L15.9999 42.6667M5.33325 32L58.6666 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button type='button' class='slick-next pull-right'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <path d="M47.9999 21.3334L58.6666 32M58.6666 32L47.9999 42.6667M58.6666 32L5.33325 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
            <script>
                // Testimonials
                (function($) {
                    "use strict";
                    $(document).ready(function() {

                        $(".tft-testimonials-selector").slick({
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 6000,
                            speed: 700,
                            dots: false,
                            pauseOnHover: true,
                            infinite: true,
                            cssEase: "linear",
                            arrows: true,
                            prevArrow: ".tft-testimonials-wrapper .slick-prev",
                            nextArrow: ".tft-testimonials-wrapper .slick-next",
                            responsive: [{
                                    breakpoint: 991,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        infinite: true,
                                        dots: false,
                                    },
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                    },
                                },
                            ],
                        });

                    });
                }(jQuery));
            </script>
        <?php } elseif ($settings['testimonials_section'] && "design-2" == $tft_design) { ?>

            <div class="tft-testimonials-design-2">
                <div class="tft-testimonial-top-header">
                    <?php
                    if (!empty($tft_sec_subtitle)) { ?>
                        <div class="testimonial-header-shape">
                            <!-- <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/app/img/testimonial-group-1.png'); ?>" alt="Testimonial Shape"> -->
                            <h6><?php echo esc_html($tft_sec_subtitle); ?></h6>
                            <!-- <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/app/img/testimonial-group-2.png'); ?>" alt="Testimonial Shape"> -->
                        </div>
                    <?php }
                    if (!empty($tft_sec_title)) {
                    ?>
                        <h3><?php echo esc_html($tft_sec_title); ?></h3>
                    <?php } ?>
                </div>
                <div class="tft-testimonials-sliders" style="background-image: url(<?php echo !empty($tft_testimonial_bg['url']) ? esc_url($tft_testimonial_bg['url']) : ''; ?>);">
                    <div class="tft-testimonials-slides">
                        <?php if ($settings['testimonials_section']) {
                            foreach ($settings['testimonials_section'] as $item) { ?>
                                <div class="tft-single-testimonial">
                                    <div class="tft-testimonials-inner">
                                        <div class="testimonial-author-image">
                                            <?php
                                            if (!empty($item['person_image']['url'])) { ?>
                                                <img src="<?php echo esc_url($item['person_image']['url']); ?>" alt="Image">
                                            <?php } else { ?>
                                                <img src="<?php echo esc_url(site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png'); ?>" alt="Image">
                                            <?php } ?>
                                            <svg width="61" height="49" viewBox="0 0 61 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="content">
                                                    <path id="Rectangle 2190" d="M36.4167 36.3333C36.4167 30.755 36.4167 27.9659 38.1497 26.233C39.8827 24.5 42.6718 24.5 48.2501 24.5C53.8284 24.5 56.6175 24.5 58.3505 26.233C60.0834 27.9659 60.0834 30.755 60.0834 36.3333C60.0834 41.9116 60.0834 44.7008 58.3505 46.4337C56.6175 48.1667 53.8284 48.1667 48.2501 48.1667C42.6718 48.1667 39.8827 48.1667 38.1497 46.4337C36.4167 44.7008 36.4167 41.9116 36.4167 36.3333Z" stroke="#99948D" stroke-width="1.5" />
                                                    <path id="Rectangle 2191" d="M36.4167 36.3359V24.0963C36.4167 13.2482 43.8591 4.04822 54.1667 0.835938" stroke="#99948D" stroke-width="1.5" stroke-linecap="round" />
                                                    <path id="Rectangle 2192" d="M0.916748 36.3333C0.916748 30.755 0.916748 27.9659 2.6497 26.233C4.38265 24.5 7.17179 24.5 12.7501 24.5C18.3284 24.5 21.1175 24.5 22.8505 26.233C24.5834 27.9659 24.5834 30.755 24.5834 36.3333C24.5834 41.9116 24.5834 44.7008 22.8505 46.4337C21.1175 48.1667 18.3284 48.1667 12.7501 48.1667C7.17179 48.1667 4.38265 48.1667 2.6497 46.4337C0.916748 44.7008 0.916748 41.9116 0.916748 36.3333Z" stroke="#99948D" stroke-width="1.5" />
                                                    <path id="Rectangle 2193" d="M0.916748 36.3359V24.0963C0.916748 13.2482 8.35906 4.04822 18.6667 0.835938" stroke="#99948D" stroke-width="1.5" stroke-linecap="round" />
                                                </g>
                                            </svg>

                                        </div>
                                        <div class="testimonial-review">
                                            <p class="tft-content">"<?php echo wp_kses_post(travelfic_character_limit($item['testimonials_review'], 100)); ?> "</p>
                                        </div>
                                        <div class="testimonial-author">
                                            <p class="person-name"><?php echo esc_html($item['person_name']) ?></p>
                                            <p class="designation"><?php echo esc_html($item['designation']) ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <script>
                // Destination Slider
                (function($) {
                    $(document).ready(function() {
                        //Your Code Inside
                        $('.tft-testimonials-slides').slick({
                            dots: true,
                            arrows: false,
                            infinite: true,
                            speed: 300,
                            autoplaySpeed: 2000,
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            centerMode: <?php echo !empty($settings['testimonials_section']) && count($settings['testimonials_section']) > 3 ? 'true' : 'false' ?>,
                            responsive: [{
                                    breakpoint: 1280,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        infinite: true,
                                    }
                                },
                                {
                                    breakpoint: 866,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                        centerMode: false
                                    }
                                }
                            ]
                        });
                    });

                }(jQuery));
            </script>
        <?php } elseif ($settings['testimonials_section'] && "design-3" == $tft_design) { ?>
            <div class="tft-testimonials-design-3" style="background-image: url(<?php echo !empty($tft_testimonial_bg['url']) ? esc_url($tft_testimonial_bg['url']) : ''; ?>);">
                <div class="container">
                    <div class="tft-testimonials-content">
                        <div class="tft-heading-content">
                            <?php if (!empty($tft_sec_subtitle)) { ?>
                                <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                            <?php }
                            if (!empty($tft_sec_title)) { ?>
                                <h2 class="tft-section-title<?php echo esc_attr($section_title_backdrop); ?>"><?php echo esc_html($tft_sec_title); ?></h2>
                            <?php }
                            if (!empty($tft_sec_content)) { ?>
                                <div class="tft-section-content">
                                    <?php echo wp_kses_post($tft_sec_content); ?>
                                </div>
                            <?php } ?>

                            <?php if ($tftSliderDisable == false && 'true' === $design3_slider_arrows): ?>
                                <div class="tft-slider-arrows tft-slider-arrows--desktop">
                                    <button type="button" class="tft-slider-prev tft-arrow">
                                        <i class="ri-arrow-left-line"></i>
                                    </button>
                                    <button type="button" class="tft-slider-next tft-arrow">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tft-testimonials-sliders  <?php echo esc_attr($tftDisableClass); ?>">
                            <div class="tft-testimonials-slides">
                                <?php if ($settings['testimonials_section']) {
                                    foreach ($settings['testimonials_section'] as $item) { ?>
                                        <div class="tft-single-testimonial">
                                            <div class="tft-testimonials-inner">
                                                <div class="testimonial-review">
                                                    <p><?php echo wp_kses_post($item['testimonials_review']); ?></p>
                                                </div>
                                                <div class="testimonial-author">
                                                    <div class="testimonial-author-image">
                                                        <?php
                                                        if (!empty($item['person_image']['url'])) { ?>
                                                            <img src="<?php echo esc_url($item['person_image']['url']); ?>" alt="Image">
                                                        <?php } else { ?>
                                                            <img src="<?php echo esc_url(site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png'); ?>" alt="Image">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="testimonial-author-info">
                                                        <h4 class="person-name"><?php echo esc_html($item['person_name']) ?></h4>
                                                        <p class="designation"><?php echo esc_html($item['designation']) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                        <!-- responsive view -->
                        <?php if ($tftSliderDisable == false && 'true' === $design3_slider_arrows): ?>
                            <div class="tft-slider-arrows tft-slider-arrows--mobile">
                                <button type="button" class="tft-slider-prev tft-arrow">
                                    <i class="ri-arrow-left-line"></i>
                                </button>
                                <button type="button" class="tft-slider-next tft-arrow">
                                    <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <script>
                // Destination Slider
                (function($) {
                    $(document).ready(function() {
                        //Your Code Inside
                        <?php if ($tftSliderDisable == false): ?>
                            $('.tft-testimonials-design-3 .tft-testimonials-slides').slick({
                                slidesToShow: <?php echo esc_attr($slideToShow); ?>,
                                slidesToScroll: <?php echo esc_attr($design3_slide_to_scroll); ?>,
                                infinite: <?php echo esc_attr($design3_slider_loop); ?>,
                                autoplay: <?php echo esc_attr($design3_slider_autoplay); ?>,
                                autoplaySpeed: <?php echo esc_attr($design3_slider_autoplay_speed); ?>,
                                speed: <?php echo esc_attr($design3_slider_autoplay_interval); ?>,
                                dots: <?php echo esc_attr($design3_slider_dots); ?>,
                                arrows: <?php echo esc_attr($design3_slider_arrows); ?>,
                                pauseOnHover: <?php echo esc_attr($design3_slider_pause_on_hover); ?>,
                                pauseOnFocus: <?php echo esc_attr($design3_slider_pause_on_focus); ?>,
                                rtl: <?php echo esc_attr($design3_slider_rtl); ?>,
                                draggable: <?php echo esc_attr($design3_slider_draggable); ?>,
                                prevArrow: $('.tft-slider-prev'),
                                nextArrow: $('.tft-slider-next'),
                                responsive: [{
                                        breakpoint: 1199,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                        }
                                    },
                                    {
                                        breakpoint: 991,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    },
                                    {
                                        breakpoint: 767,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                        }
                                    },

                                ]
                            });
                        <?php endif; ?>
                    });

                }(jQuery));
            </script>

<?php }
    }
}
