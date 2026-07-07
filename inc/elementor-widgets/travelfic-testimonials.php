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
                    'design-4'  => __('Design 4', 'travelfic-toolkit'),
                    'design-5'  => __('Design 5', 'travelfic-toolkit'),
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
                    'testimonial_style' => ['design-2', 'design-3', 'design-5'],
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
                    'testimonial_style' => ['design-2', 'design-3', 'design-5'],
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

        // design 1 and 2
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'person_image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
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
            ]
        );

        $this->add_control(
            'testimonials_section',
            [
                'label'       => __('Testimonials List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ person_name }}}',
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-2'],
                ],
            ]
        );

        // Design 3
        $repeater2 = new \Elementor\Repeater();
        $repeater2->add_control(
            'person_image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater2->add_control(
            'person_name',
            [
                'label'       => __('Name', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('John Doe', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater2->add_control(
            'designation',
            [
                'label'       => __('Designation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('CEO', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater2->add_control(
            'testimonials_review',
            [
                'label'   => __('Review Details', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', 'travelfic-toolkit'),

            ]
        );
     
        $this->add_control(
            'testimonials_design3_section',
            [
                'label'       => __('Testimonials List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'title_field' => '{{{ person_name }}}',
                'condition' => [
                    'testimonial_style' => ['design-3'],
                ],
            ]
        );

        // design 4
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'person_image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
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
            ]
        );
         $repeater->add_control(
            'post_date',
            [
                'label'       => __('Date', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false,
                    'dateFormat' => 'd M, Y',
                    'showMonths' => true
                ],
                'default' => date('d M, Y'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonials_design4_list',
            [
                'label'       => __('Testimonials List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ person_name }}}',
                'condition' => [
                    'testimonial_style' => 'design-4',
                ],
            ]
        );

        // design 5
        $repeater5 = new \Elementor\Repeater();
        $repeater5->add_control(
            'person_image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater5->add_control(
            'person_name',
            [
                'label'       => __('Name', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('John Doe', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater5->add_control(
            'designation',
            [
                'label'       => __('Designation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('from New York', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater5->add_control(
            'testimonials_review_title',
            [
                'label'       => __('Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Amazing service and beautiful rooms!', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater5->add_control(
            'testimonials_review',
            [
                'label'   => __('Review Details', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('We celebrated our anniversary here, and the staff went above and beyond to make it special. The room was stunning, and the view was breathtaking. Highly recommend!', 'travelfic-toolkit'),

            ]
        );
        $repeater5->add_control(
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
            ]
        );

        $this->add_control(
            'testimonials_design5_list',
            [
                'label'       => __('Testimonials List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater5->get_controls(),
                'title_field' => '{{{ person_name }}}',
                'condition' => [
                    'testimonial_style' => 'design-5',
                ],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-3', 'design-5'],
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
                    'testimonial_style' => ['design-2', 'design-3', 'design-5'],
                ],
            ]
        );
        $this->add_control(
            'tft_testimonial_section_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two' => 'background: {{VALUE}}', 
                    '{{WRAPPER}} .tft-testimonials-design__three' => 'background: {{VALUE}}', 
                ],
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-3'],
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
                    'testimonial_style' => ['design-2', 'design-5']
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_testimonials_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-section-title,
                               {{WRAPPER}} .tft-testimonials-design__five .tft-testimonial-top-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-5']
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-section-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-testimonial-top-header .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-5']
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
                    'testimonial_style' => ['design-2', 'design-5']
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_testimonials_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-section-subtitle,
                               {{WRAPPER}} .tft-testimonials-design__five .tft-testimonial-top-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-5']
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-testimonial-top-header .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-2', 'design-5']
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
                    'testimonial_style' => 'design-3',
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
                    'testimonial_style' => 'design-3',
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
                    'testimonial_style' => 'design-3',
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
                'selector' => '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
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
                'selector' => '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
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
                    'testimonial_style' => ['design-1', 'design-2', 'design-4', 'design-5'],   
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'],   
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_title_space_bellow',
            [
                'label'     => __('Heading Space', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .testimonial-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design__four .testimonial-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_card_border_rds',
            [
                'label'     => __('Border Radius', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
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
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
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
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_title',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__one .person-name,
                               {{WRAPPER}} .tft-testimonials-design__four .person-name,
                               {{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-header h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .person-name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .person-name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .person-name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
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
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_designation_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__one .designation,
                               {{WRAPPER}} .tft-testimonials-design__four .designation,
                               {{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .user-info .person-name,
                               {{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .user-info .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .user-info .person-name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .user-info .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
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
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_content',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__one .testimonial-body .tft-content, 
                               {{WRAPPER}} .tft-testimonials-design__four .testimonial-body .tft-content, 
                               {{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-body .tft-content',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .testimonial-body .tft-content' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .testimonial-body .tft-content' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-body .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .tft-content' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
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
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .testimonial-footer i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .testimonial-footer i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__five .tft-single-testimonial .testimonial-footer .testimonial-rating i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4', 'design-5'],  
                ],
            ]
        );

        $this->add_control(
            'testimonials_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .testimonial-footer i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .testimonial-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'testimonials_posted_date_head',
            [
                'label'     => __('Posted Date', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'testimonials_posted_date_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__four .testimonial-header .testimonial-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-4',  
                ],
            ]
        );

         $this->add_control(
            'testimonials_posted_date_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .testimonial-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'testimonials_rating_number_head',
            [
                'label'     => __('Rating Number', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'testimonials_rating_number_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__four .testimonial-rating h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'testimonials_rating_number_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .testimonial-rating h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'testimonials_quote_icon_head',
            [
                'label'     => __('Quote Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'testimonials_quote_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__four .quote-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'testimonials_quote_icon_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .quote-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-4',  
                ],
            ]
        );
        
     
        $this->add_control(
            'testimonials_2_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => 'design-2',
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
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
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
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_author_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_author_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_author_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
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
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_designation_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
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
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_2_content',
                'selector' => '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_2_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'testimonials_2_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-review .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
     
        $this->end_controls_section();

        // Testimonial design 3 team style settings
        $this->start_controls_section(
            'testimonials_style_3_section',
            [
                'label' => __('Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'testimonials_card_3_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_card_3_border_rds',
            [
                'label'      => __('Border Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_3_color',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p',
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
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p',
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
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                'condition' => [
                    'testimonial_style!' => 'design-5', 
                ],
            ]
        );


        $this->add_control(
            'tft_testimonials_nav_icon_head',
            [
                'label'     => __('Arrows', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one button.slick-arrow path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four button.slick-arrow path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__one button.slick-arrow' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__four button.slick-arrow' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
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
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonials_nav__arrow_border',
                'label' => esc_html__('Border', 'travelfic-toolkit'),
                'selector' => '{{WRAPPER}} .tft-testimonials-design__one button.slick-arrow,
                    {{WRAPPER}} .tft-testimonials-design__two .slick-dots li.slick-active button::before, 
                    {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li.slick-active,
                    {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow',
                'condition' => [
                    'testimonial_style' => ['design-2','design-3'],
                ],
            ]
        );
      
       $this->start_controls_tabs('tft_testimonials_3_nav_arrow_tabs_');

        $this->start_controls_tab(
            'tft_testimonials_3_nav_arrow_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tft_testimonials_3_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-slider-arrows .tft-arrow i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                    'testimonial_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_3_icon_nav_icon_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-arrow' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                    'testimonial_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'tft_testimonials_3_nav_arrow_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tft_testimonials_3_icon_nav_icon_color_hover',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-slider-arrows .tft-arrow:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                    'testimonial_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_3_icon_nav_icon_background_color_hover',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                    'testimonial_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_border_hover',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-3',
                    'testimonial_design3_slider_navigation' => 'arrows',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'tft_testimonials_nav_head',
            [
                'label'     => __('Dots', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'testimonial_style' => ['design-2','design-3'],
                    'testimonial_design3_slider_navigation' => 'dots',
                ],
            ]
        );
        $this->add_control(
            'testimonials_nav_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .slick-dots li button::before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-2','design-3'],
                    'testimonial_design3_slider_navigation' => 'dots',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-design__two .slick-dots li:hover button::before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li:hover button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-2','design-3'],
                    'testimonial_design3_slider_navigation' => 'dots',
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
        \Travelfic_Toolkit\Components\Testimonials::render( $settings, 'elementor' );
    }
}
