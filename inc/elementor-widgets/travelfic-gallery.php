<?php
class Travelfic_Toolkit_Gallery extends \Elementor\Widget_Base
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
        return 'tft-gallery';
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
        return esc_html__('Travelfic Gallery', 'travelfic-toolkit');
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
        return 'eicon-image';
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
        return ['travelfic', 'gallery', 'images', 'tft'];
    }
    public function get_style_depends()
    {
        return ['travelfic-toolkit-gallery'];
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
            'tft-gallery',
            [
                'label' => __('Gallery', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Design
        $this->add_control(
            'gallery_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Design', 'travelfic-toolkit'),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __('Design 1', 'travelfic-toolkit'),
                ],
            ]
        );

        $this->add_control(
            'des_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Book your stay today', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'des_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('GALLERY', 'travelfic-toolkit'),
            ]
        );

        // design 1
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Swimming Pool', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'galleries',
            [
                'label'       => __('Gallery List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // slider control settings check
        $this->start_controls_section(
            'gallery_slider_control',
            [
                'label' => __('Slider Control', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

            ]
        );
        $this->add_control(
            'gallery_slider_slidetoshow',
            [
                'label'       => __('Slide To Show', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 15,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'gallery_slider_slidetoscroll',
            [
                'label'       => __('Slide To Scroll', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'gallery_slider_navigation',
            [
                'label'       => __('Navigation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'arrows',
                'options'     => [
                    'none' => __('None', 'travelfic-toolkit'),
                    'dots' => __('Dots', 'travelfic-toolkit'),
                    'arrows' => __('Arrows', 'travelfic-toolkit'),
                ],
            ]
        );
        $this->add_control(
            'gallery_slider_autoplay',
            [
                'label'       => __('Autoplay', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );
        $this->add_control(
            'gallery_slider_autoplay_speed',
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
            ]
        );
        $this->add_control(
            'gallery_slider_autoplay_interval',
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
            ]
        );
        $this->add_control(
            'gallery_slider_loop',
            [
                'label' => esc_html__('Loop', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );


        $this->add_control(
            'gallery_slider_pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'gallery_slider_pause_on_focus',
            [
                'label' => esc_html__('Pause On Focus', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'gallery_slider_rtl',
            [
                'label' => esc_html__('RTL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'gallery_slider_draggable',
            [
                'label' => esc_html__('Draggable', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
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
                    'gallery_style' => ['design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_gallery_section_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two' => 'background: {{VALUE}}', 
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three' => 'background: {{VALUE}}', 
                ],
                'condition' => [
                    'gallery_style' => ['design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_gallery_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_gallery_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-top-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_gallery_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-top-header .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'tft_gallery_sub_title_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_gallery_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-top-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_gallery_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-top-header .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
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
                    'gallery_style' => 'design-3',
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
                    'gallery_style' => ['design-3'],
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
                    'gallery_style' => ['design-3'],
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
                    'gallery_style' => 'design-3',
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
                    'gallery_style' => ['design-3'],
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
                    'gallery_style' => 'design-3',
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
                    'gallery_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-3'],
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
                    'gallery_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_content_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-3'],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_style_section',
            [
                'label' => __('Item List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => ['design-1', 'design-2' , 'design-4'],   
                ],
            ]
        );
        $this->add_control(
            'gallery_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'],   
                ],
            ]
        );
        $this->add_control(
            'gallery_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner:hover' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'gallery_title_space_bellow',
            [
                'label'     => __('Heading Space', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .gallery-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .gallery-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'gallery_card_border_rds',
            [
                'label'     => __('Border Radius', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        
        $this->add_responsive_control(
            'gallery_tour_item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .person-name,#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'gallery_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .person-name' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner:hover .person-name' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_designation',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_designation_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .designation,#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .designation' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner:hover .designation' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .gallery-body .tft-content, #tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .gallery-body .tft-content',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .gallery-body .tft-content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .gallery-body .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner:hover .tft-content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .gallery-footer i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .gallery-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'],  
                ],
            ]
        );

        $this->add_control(
            'gallery_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-inner:hover .gallery-footer i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .gallery-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'gallery_posted_date_head',
            [
                'label'     => __('Posted Date', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'gallery_posted_date_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .gallery-header .gallery-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-4',  
                ],
            ]
        );

         $this->add_control(
            'gallery_posted_date_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .gallery-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'gallery_rating_number_head',
            [
                'label'     => __('Rating Number', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'gallery_rating_number_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .gallery-rating h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'gallery_rating_number_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .gallery-rating h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'gallery_quote_icon_head',
            [
                'label'     => __('Quote Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'gallery_quote_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .quote-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'gallery_quote_icon_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four .tft-gallery-inner:hover .quote-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-4',  
                ],
            ]
        );
        
     
        $this->add_control(
            'gallery_2_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );

        // Design 2 Styles
        $this->add_responsive_control(
            'gallery_2_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'gallery_2_author',
            [
                'label'     => __('Author', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_2_author_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery .gallery-author .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_author_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery .gallery-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_author_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery:hover .gallery-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_designation',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_2_designation_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery .gallery-author .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery .gallery-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery:hover .gallery-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
       
        $this->add_control(
            'gallery_2_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_2_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery .gallery-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'gallery_2_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery .gallery-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'gallery_2_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .tft-gallery-slides .tft-single-gallery:hover .gallery-review .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-2',
                ],
            ]
        );
     
        $this->end_controls_section();

        // gallery design 3 team style settings
        $this->start_controls_section(
            'gallery_style_3_section',
            [
                'label' => __('Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'gallery_card_3_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-slides .tft-single-gallery' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'gallery_card_3_border_rds',
            [
                'label'      => __('Border Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-slides .tft-single-gallery' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'gallery_tour_item_card_3_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-slides .tft-single-gallery' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'gallery_title_head_3',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_title_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-author .gallery-author-info h4',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'gallery_title_3_color',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-author .gallery-author-info h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'gallery_designation_3',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_designation_3_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-author .gallery-author-info p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'gallery_designation_3_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-author .gallery-author-info p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'gallery_content_head_3',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_content_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'gallery_content_3_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'gallery_image_3_head',
            [
                'label'     => __('Image', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'gallery_image_3_size',
            [
                'label'     => __('Image Size', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .tft-gallery-slides .tft-single-gallery .tft-gallery-inner .gallery-author .gallery-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_nav_style',
            [
                'label' => __('Nav', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tft_gallery_nav_icon_head',
            [
                'label'     => __('Arrows', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one button.slick-arrow path' => 'stroke: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four button.slick-arrow path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_nav_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_nav_icon_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one button.slick-arrow' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__four button.slick-arrow' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_responsive_control(
            'gallery_nav__arrow_width',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-heading-content .slick-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'gallery_nav__arrow_border',
                'label' => esc_html__('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one button.slick-arrow,
                    #tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .slick-dots li.slick-active button::before, 
                    #tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .slick-dots li.slick-active,
                    #tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-heading-content .slick-arrow',
                'condition' => [
                    'gallery_style' => ['design-2','design-3'],
                ],
            ]
        );
      
       $this->start_controls_tabs('tft_gallery_3_nav_arrow_tabs_');

        $this->start_controls_tab(
            'tft_gallery_3_nav_arrow_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tft_gallery_3_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-slider-arrows .tft-arrow i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                    'gallery_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'tft_gallery_3_icon_nav_icon_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content .tft-slider-arrows .tft-arrow' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                    'gallery_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'tft_gallery_3_nav_arrow_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tft_gallery_3_icon_nav_icon_color_hover',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-slider-arrows .tft-arrow:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                    'gallery_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'tft_gallery_3_icon_nav_icon_background_color_hover',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                    'gallery_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_nav_border_hover',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => 'design-3',
                    'gallery_slider_navigation' => 'arrows',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'tft_gallery_nav_head',
            [
                'label'     => __('Dots', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'gallery_style' => ['design-2','design-3'],
                    'gallery_slider_navigation' => 'dots',
                ],
            ]
        );
        $this->add_control(
            'gallery_nav_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .slick-dots li button::before' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .slick-dots li button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-2','design-3'],
                    'gallery_slider_navigation' => 'dots',
                ],
            ]
        );
        $this->add_control(
            'gallery_icon_nav_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__two .slick-dots li:hover button::before' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__three .tft-gallery-content .tft-gallery-sliders .slick-dots li:hover button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'gallery_style' => ['design-2','design-3'],
                    'gallery_slider_navigation' => 'dots',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        // Design
        if (!empty($settings['gallery_style'])) {
            $tft_design = $settings['gallery_style'];
        }

        if (!empty($settings['des_title'])) {
            $tft_sec_title = $settings['des_title'];
        }
        if (!empty($settings['des_subtitle'])) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }

        // Items per page
        $slideToShow = !empty($settings['gallery_slider_slidetoshow']) ? $settings['gallery_slider_slidetoshow'] : 2;
        $gallery_slide_to_scroll = !empty($settings['gallery_slider_slidetoscroll']) ? $settings['gallery_slider_slidetoscroll'] : 1;
        $gallery_slider_nav = $settings['gallery_slider_navigation'];
        $gallery_slider_arrows = ("arrows" === $gallery_slider_nav) ? 'true' : 'false';
        $gallery_slider_dots = ("dots" === $gallery_slider_nav) ? 'true' : 'false';
        $gallery_slider_autoplay = ('yes' === $settings['gallery_slider_autoplay']) ? 'true' : 'false';
        $gallery_slider_autoplay_speed = !empty($settings['gallery_slider_autoplay_speed']) ? $settings['gallery_slider_autoplay_speed']['size'] : 0;
        $gallery_slider_autoplay_interval = !empty($settings['gallery_slider_autoplay_interval']) ? $settings['gallery_slider_autoplay_interval']['size'] : 0;
        $gallery_slider_loop = ('yes' === $settings['gallery_slider_loop']) ? 'true' : 'false';
        $gallery_slider_pause_on_hover = ('yes' === $settings['gallery_slider_pause_on_hover']) ? 'true' : 'false';
        $gallery_slider_pause_on_focus = ('yes' === $settings['gallery_slider_pause_on_focus']) ? 'true' : 'false';
        $gallery_slider_rtl = ('yes' === $settings['gallery_slider_rtl']) ? 'true' : 'false';
        $gallery_slider_draggable = ('yes' === $settings['gallery_slider_draggable']) ? 'true' : 'false';

        if($settings['galleries'] && "design-1" == $tft_design) { ?>
            <div class="tft-gallery-design__one tft-customizer-typography">
                <div class="tft-gallery-top-header">
                    <div class="gallery-header-shape tft-heading-content">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }if (!empty($tft_sec_title)) { ?>
                            <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="tft-slider-arrows tft-slider-arrows--mobile">
                        <button type='button' class='slick-prev'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 8L2 12M2 12L6 16M2 12L22 12" stroke="#EE5509" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type='button' class='slick-next'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 8L22 12M22 12L18 16M22 12L2 12" stroke="#EE5509" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="tft-gallery-selector tft-slide-default">
                    <?php foreach ($settings['galleries'] as $item) { ?>
                        <div class="tft-single-gallery">
                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="Image"/>
                            <h3><?php echo esc_html($item['title']) ?></h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <script>
                (function($) {
                    "use strict";
                    $(document).ready(function() {
                        $('.tft-gallery-design__one .tft-gallery-selector').slick({
                            slidesToShow: <?php echo esc_attr($slideToShow); ?>,
                            slidesToScroll: <?php echo esc_attr($gallery_slide_to_scroll); ?>,
                            infinite: <?php echo esc_attr($gallery_slider_loop); ?>,
                            autoplay: <?php echo esc_attr($gallery_slider_autoplay); ?>,
                            autoplaySpeed: <?php echo esc_attr($gallery_slider_autoplay_speed); ?>,
                            speed: <?php echo esc_attr($gallery_slider_autoplay_interval); ?>,
                            dots: <?php echo esc_attr($gallery_slider_dots); ?>,
                            arrows: <?php echo esc_attr($gallery_slider_arrows); ?>,
                            pauseOnHover: <?php echo esc_attr($gallery_slider_pause_on_hover); ?>,
                            pauseOnFocus: <?php echo esc_attr($gallery_slider_pause_on_focus); ?>,
                            rtl: <?php echo esc_attr($gallery_slider_rtl); ?>,
                            draggable: <?php echo esc_attr($gallery_slider_draggable); ?>,
                            prevArrow: ".tft-gallery-design__one .slick-prev",
                            nextArrow: ".tft-gallery-design__one .slick-next",
                            variableWidth: true,
                            adaptiveHeight: true,
                            responsive: [
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
                    });
                }(jQuery));
            </script>
        <?php }
    }
}
