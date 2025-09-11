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
                    'testimonial_style' => ['design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_testimonial_section_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two' => 'background: {{VALUE}}', 
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three' => 'background: {{VALUE}}', 
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
                    'testimonial_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_testimonials_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_testimonials_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonial-top-header .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => 'design-2',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content h2',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content h2' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content h2::after' => 'background: {{VALUE}}',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-section-subtitle',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-3'],
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content p',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content p' => 'color: {{VALUE}}',
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
                    'testimonial_style' => ['design-1', 'design-2' , 'design-4'],   
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover' => 'background: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .testimonial-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .testimonial-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
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
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .person-name,#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .person-name' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .person-name' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .person-name' => 'color: {{VALUE}}',
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
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_designation_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .designation,#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .designation' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .designation' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .designation' => 'color: {{VALUE}}',
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
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .testimonial-body .tft-content, #tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .testimonial-body .tft-content',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .testimonial-body .tft-content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .testimonial-body .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .tft-content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .tft-content' => 'color: {{VALUE}}',
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
                    'testimonial_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .testimonial-footer i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .testimonial-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'testimonial_style' => ['design-1', 'design-4'],  
                ],
            ]
        );

        $this->add_control(
            'testimonials_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one .tft-testimonials-inner:hover .testimonial-footer i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .testimonial-footer i' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .testimonial-header .testimonial-date' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .testimonial-date' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .testimonial-rating h5' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .testimonial-rating h5' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .quote-icon i' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four .tft-testimonials-inner:hover .quote-icon i' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial' => 'background: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover' => 'background: {{VALUE}}',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .person-name' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-author .person-name' => 'color: {{VALUE}}',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-author .designation' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-author .designation' => 'color: {{VALUE}}',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-review p',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial .testimonial-review p' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .tft-testimonials-slides .tft-single-testimonial:hover .testimonial-review .tft-content' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' => 'background: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-slides .tft-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info h4' => 'color: {{VALUE}}',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-info p' => 'color: {{VALUE}}',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-review p' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .tft-testimonials-slides .tft-single-testimonial .tft-testimonials-inner .testimonial-author .testimonial-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one button.slick-arrow path' => 'stroke: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four button.slick-arrow path' => 'stroke: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one button.slick-arrow' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__four button.slick-arrow' => 'background: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__one button.slick-arrow,
                    #tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .slick-dots li.slick-active button::before, 
                    #tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li.slick-active,
                    #tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-heading-content .slick-arrow',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-slider-arrows .tft-arrow i' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-arrow' => 'background: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-slider-arrows .tft-arrow:hover i' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'background-color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'border-color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .slick-dots li button::before' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li button' => 'background-color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__two .slick-dots li:hover button::before' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-testimonials-design__three .tft-testimonials-content .tft-testimonials-sliders .slick-dots li:hover button' => 'background-color: {{VALUE}}',
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
        $postCount = isset($settings['testimonials_design3_section']) ? count($settings['testimonials_design3_section']) : (isset($settings['testimonials_section']) ? count($settings['testimonials_section']) : 0);

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
            <div class="tft-testimonials-design__one tft-customizer-typography">
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
                                            <h3 class="person-name"><?php echo esc_html($item['person_name']) ?></h3>
                                            <h4 class="designation"><?php echo esc_html($item['designation']) ?></h4>
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
                    <button type='button' class='slick-prev'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <path d="M15.9999 21.3334L5.33325 32M5.33325 32L15.9999 42.6667M5.33325 32L58.6666 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button type='button' class='slick-next'>
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
                            prevArrow: ".tft-testimonials-design__one .slick-prev",
                            nextArrow: ".tft-testimonials-design__one .slick-next",
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

            <div class="tft-testimonials-design__two">
                <div class="tft-testimonial-top-header">
                    <div class="testimonial-header-shape tft-heading-content">
                        <?php
                        if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }if (!empty($tft_sec_title)) { ?>
                            <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
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
                                            <p class="tft-content"><?php echo wp_kses_post(travelfic_character_limit($item['testimonials_review'], 100)); ?></p>
                                        </div>
                                        <div class="testimonial-author">
                                            <h3 class="person-name"><?php echo esc_html($item['person_name']) ?></h3>
                                            <h4 class="designation"><?php echo esc_html($item['designation']) ?></h4>
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
                            speed: 1000,
                            autoplaySpeed: 3000,
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
        <?php } elseif ($settings['testimonials_design3_section'] && "design-3" == $tft_design) { ?>
            <div class="tft-testimonials-design__three" style="background-image: url(<?php echo !empty($tft_testimonial_bg['url']) ? esc_url($tft_testimonial_bg['url']) : ''; ?>);">
                <div class="container">
                    <div class="tft-testimonials-content">
                        <div class="tft-heading-content">
                            <?php if (!empty($tft_sec_subtitle)) { ?>
                                <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                            <?php }
                            if (!empty($tft_sec_title)) { ?>
                                <h2 class="tft-section-title tft-title-shape <?php echo esc_attr($section_title_backdrop); ?>"><?php echo esc_html($tft_sec_title); ?></h2>
                            <?php }
                            if (!empty($tft_sec_content)) { ?>
                                <div class="tft-section-content">
                                    <?php echo wp_kses_post($tft_sec_content); ?>
                                </div>
                            <?php } ?>

                            <?php if ($tftSliderDisable == false && 'true' === $design3_slider_arrows): ?>
                                <div class="tft-slider-arrows tft-slider-arrows--desktop">
                                    <button type="button" class="tft-slider-prev tft-arrow tft-bg-hover-primary">
                                        <i class="ri-arrow-left-line"></i>
                                    </button>
                                    <button type="button" class="tft-slider-next tft-arrow tft-bg-hover-primary">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tft-testimonials-sliders  <?php echo esc_attr($tftDisableClass); ?>">
                            <div class="tft-testimonials-slides">
                                <?php if ($settings['testimonials_design3_section']) {
                                    foreach ($settings['testimonials_design3_section'] as $item) { ?>
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
                            $('.tft-testimonials-design__three .tft-testimonials-slides').slick({
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

        <?php } elseif($settings['testimonials_design4_list'] && "design-4" == $tft_design) { ?>
            <div class="tft-testimonials-design__four tft-customizer-typography">
                <div class="tft-testimonials-selector tft-slide-default">
                    <?php if ($settings['testimonials_design4_list']) {
                        foreach ($settings['testimonials_design4_list'] as $item) { ?>
                            <div class="tft-single-testimonial">
                                <div class="tft-testimonials-inner">
                                    <div class="testimonial-header">
                                        <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
                                        <div class="testimonial-date"><?php echo esc_html($item['post_date']) ?></div>
                                    </div>
                                    <div class="testimonial-body">
                                        <h3 class="tft-content"><?php echo esc_html($item['testimonials_review']) ?></h3>
                                    </div>
                                    <div class="testimonial-footer">
                                        <div class="user-info">
                                            <div class="person-avatar">
                                                <img src="<?php echo esc_url($item['person_image']['url']); ?>" alt="Image">
                                            </div>
                                            <div class="person-info">
                                                <div class="person-name"><?php echo esc_html($item['person_name']) ?></div>
                                                <div class="designation"><?php echo esc_html($item['designation']) ?></div>
                                            </div>
                                        </div>

                                        <div class="testimonial-rating">
                                            <h5><?php echo esc_html($item['rate']).'.0' ?></h5>
                                            <span class="rating"><?php echo $this->testimonials_rattings($item['rate']); ?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="tft-slider-arrows tft-slider-arrows--mobile">
                    <button type='button' class='slick-prev'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <path d="M15.9999 21.3334L5.33325 32M5.33325 32L15.9999 42.6667M5.33325 32L58.6666 32" stroke="#C0CCD8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button type='button' class='slick-next'>
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
                            centerMode: true,
                            centerPadding: "100px",
                            autoplaySpeed: 6000,
                            speed: 700,
                            dots: false,
                            pauseOnHover: true,
                            infinite: true,
                            cssEase: "linear",
                            arrows: true,
                            prevArrow: ".tft-testimonials-design__four .slick-prev",
                            nextArrow: ".tft-testimonials-design__four .slick-next",
                            responsive: [
                                {
                                breakpoint: 1200,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        centerPadding: "40px",
                                    },
                                },
                                {
                                breakpoint: 991,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        centerMode: false,
                                    },
                                },
                                {
                                    breakpoint: 600,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                        centerMode: false,
                                    },
                                },
                            ],
                        });

                    });
                }(jQuery));
            </script>
        <?php }
    }
}
