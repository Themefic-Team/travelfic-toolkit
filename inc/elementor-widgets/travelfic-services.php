<?php
class Travelfic_Toolkit_Services extends \Elementor\Widget_Base
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
        return 'tft-services';
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
        return esc_html__('Travelfic Services', 'travelfic-toolkit');
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
        return 'eicon-kit-details';
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
        return ['travelfic', 'services', 'tft'];
    }
    public function get_style_depends()
    {
        return ['travelfic-toolkit-services'];
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
            'tft-services',
            [
                'label' => __('Slider Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Design
        $this->add_control(
            'service_style',
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
            'section_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Checkout our awesome services', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'section_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Services', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'see_all_link',
            [
                'type' => \Elementor\Controls_Manager::URL,
                'label' => esc_html__('See ALL URL', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter Link', 'travelfic-toolkit'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
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
            'icon',
            [
                'label'   => __('Icon', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Swimming pool', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label'       => __('Description', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Our trained and experienced staff is capable of handling a number of pool services', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'services_section',
            [
                'label'       => __('Services List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
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
                    'service_style' => ['design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_service_section_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two' => 'background: {{VALUE}}', 
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three' => 'background: {{VALUE}}', 
                ],
                'condition' => [
                    'service_style' => ['design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_services_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_services_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-service-top-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_services_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-service-top-header .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'tft_services_sub_title_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_services_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-service-top-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_services_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-service-top-header .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
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
                    'service_style' => 'design-3',
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
                    'service_style' => ['design-3'],
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
                    'service_style' => ['design-3'],
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
                    'service_style' => 'design-3',
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
                    'service_style' => ['design-3'],
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
                    'service_style' => 'design-3',
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
                    'service_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-3'],
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
                    'service_style' => 'design-3',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_design_3_sec_content_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tft_design_3_sec_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-3'],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'services_style_section',
            [
                'label' => __('Item List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'service_style' => ['design-1', 'design-2' , 'design-4'],   
                ],
            ]
        );
        $this->add_control(
            'services_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-1', 'design-4'],   
                ],
            ]
        );
        $this->add_control(
            'services_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner:hover' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'services_title_space_bellow',
            [
                'label'     => __('Heading Space', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .service-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'services_card_border_rds',
            [
                'label'     => __('Border Radius', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        
        $this->add_responsive_control(
            'services_tour_item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .person-name,#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'services_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .person-name' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner:hover .person-name' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_designation',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_designation_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .designation,#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .designation' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner:hover .designation' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .service-body .tft-content, #tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-body .tft-content',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .service-body .tft-content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-body .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner:hover .tft-content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .service-footer i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'],  
                ],
            ]
        );

        $this->add_control(
            'services_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner:hover .service-footer i' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .service-footer i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'services_posted_date_head',
            [
                'label'     => __('Posted Date', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'services_posted_date_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-header .service-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-4',  
                ],
            ]
        );

         $this->add_control(
            'services_posted_date_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .service-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'services_rating_number_head',
            [
                'label'     => __('Rating Number', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'services_rating_number_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-rating h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'services_rating_number_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .service-rating h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'services_quote_icon_head',
            [
                'label'     => __('Quote Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-4', 
                ],
            ]
        );
        $this->add_control(
            'services_quote_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .quote-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-4',  
                ],
            ]
        );

        $this->add_control(
            'services_quote_icon_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .quote-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-4',  
                ],
            ]
        );
        
     
        $this->add_control(
            'services_2_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );

        // Design 2 Styles
        $this->add_responsive_control(
            'services_2_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'services_2_author',
            [
                'label'     => __('Author', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_2_author_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service .service-author .person-name',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_author_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service .service-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_author_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service:hover .service-author .person-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_designation',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_2_designation_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service .service-author .designation',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_designation_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service .service-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_designation_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service:hover .service-author .designation' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
       
        $this->add_control(
            'services_2_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_2_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service .service-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'services_2_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service .service-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'services_2_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .tft-services-slides .tft-single-service:hover .service-review .tft-content' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-2',
                ],
            ]
        );
     
        $this->end_controls_section();

        // Service design 3 team style settings
        $this->start_controls_section(
            'services_style_3_section',
            [
                'label' => __('Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'services_card_3_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-slides .tft-single-service' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'services_card_3_border_rds',
            [
                'label'      => __('Border Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-slides .tft-single-service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_responsive_control(
            'services_tour_item_card_3_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-slides .tft-single-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'services_title_head_3',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_title_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-author .service-author-info h4',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'services_title_3_color',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-author .service-author-info h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'services_designation_3',
            [
                'label'     => __('Designation', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_designation_3_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-author .service-author-info p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'services_designation_3_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-author .service-author-info p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'services_content_head_3',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_content_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-review p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'services_content_3_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-review p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'services_image_3_head',
            [
                'label'     => __('Image', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'services_image_3_size',
            [
                'label'     => __('Image Size', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .tft-services-slides .tft-single-service .tft-services-inner .service-author .service-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'services_nav_style',
            [
                'label' => __('Nav', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tft_services_nav_icon_head',
            [
                'label'     => __('Arrows', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one button.slick-arrow path' => 'stroke: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four button.slick-arrow path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_icon_nav_icon_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four button.slick-arrow:hover path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );
        $this->add_control(
            'services_icon_nav_icon_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one button.slick-arrow' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four button.slick-arrow' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_responsive_control(
            'services_nav__arrow_width',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-heading-content .slick-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'services_nav__arrow_border',
                'label' => esc_html__('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one button.slick-arrow,
                    #tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .slick-dots li.slick-active button::before, 
                    #tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .slick-dots li.slick-active,
                    #tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-heading-content .slick-arrow',
                'condition' => [
                    'service_style' => ['design-2','design-3'],
                ],
            ]
        );
      
       $this->start_controls_tabs('tft_services_3_nav_arrow_tabs_');

        $this->start_controls_tab(
            'tft_services_3_nav_arrow_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tft_services_3_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-slider-arrows .tft-arrow i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                    'service_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'tft_services_3_icon_nav_icon_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content .tft-slider-arrows .tft-arrow' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                    'service_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'tft_services_3_nav_arrow_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tft_services_3_icon_nav_icon_color_hover',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-slider-arrows .tft-arrow:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                    'service_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'tft_services_3_icon_nav_icon_background_color_hover',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                    'service_design3_slider_navigation' => 'arrows',
                ],
            ]
        );
        $this->add_control(
            'services_icon_nav_border_hover',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-heading-content .tft-slider-arrows .tft-bg-hover-primary:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => 'design-3',
                    'service_design3_slider_navigation' => 'arrows',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'tft_services_nav_head',
            [
                'label'     => __('Dots', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'service_style' => ['design-2','design-3'],
                    'service_design3_slider_navigation' => 'dots',
                ],
            ]
        );
        $this->add_control(
            'services_nav_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .slick-dots li button::before' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .slick-dots li button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-2','design-3'],
                    'service_design3_slider_navigation' => 'dots',
                ],
            ]
        );
        $this->add_control(
            'services_icon_nav_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__two .slick-dots li:hover button::before' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__three .tft-services-content .tft-services-sliders .slick-dots li:hover button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'service_style' => ['design-2','design-3'],
                    'service_design3_slider_navigation' => 'dots',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        // Design
        if (!empty($settings['service_style'])) {
            $tft_design = $settings['service_style'];
        }

        if (!empty($settings['section_title'])) {
            $tft_sec_title = $settings['section_title'];
        }
        if (!empty($settings['section_subtitle'])) {
            $tft_sec_subtitle = $settings['section_subtitle'];
        }
        
        if ($settings['services_section'] && "design-1" == $tft_design) { ?>

            <div class="tft-services-design__one">
                <div class="tft-service-sec-header">
                    <div class="tft-service-header-left">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo wp_kses_post($tft_sec_subtitle); ?></h3>
                        <?php } if (!empty($tft_sec_title)) {?>
                            <h2 class="tft-section-title"><?php echo wp_kses_post($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="read-more">
                        <a href="<?php echo esc_url($settings['see_all_link']['url']); ?>" class="tft-btn tft-btn-transparent tft-flex-column">
                            <?php esc_html_e("More Services", "travelfic-toolkit"); ?>
                        </a>
                    </div>
                </div>
                
                <div class="tft-services-items">
                    <div class="tft-services-items-left">
                        <?php foreach ($settings['services_section'] as $key => $item) : ?>
                            <div class="tft-single-service<?php echo ( 0 === intval( $key ) ) ? ' active' : ''; ?>" id="tft-service-<?php echo esc_attr($key); ?>">
                                <?php if (!empty($item['icon']['value'])) : ?>
                                <div class="tft-service-icon">
                                    <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                                <?php endif; ?>
                                <div class="tft-single-service-right">
                                    <h3><?php echo esc_html($item['title']) ?></h3>
                                    <p><?php echo wp_kses_post($item['description']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tft-services-items-right">
                        <?php foreach ($settings['services_section'] as $key => $item) : ?>
                            <div class="tft-single-service-image<?php echo ( 0 === intval( $key ) ) ? ' active' : ''; ?>" data-id="#tft-service-<?php echo esc_attr($key); ?>">
                                <?php if (!empty($item['image']['url'])) { ?>
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="Image">
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <script>
                (function($) {
                    $(document).ready(function() {
                        // Ensure only the active image is visible on load
                        $('.tft-single-service-image').hide();
                        $('.tft-single-service-image.active').show();

                        // When a service on the left is clicked, activate it and show its image
                        $('.tft-services-items-left').on('click', '.tft-single-service', function(e) {
                            e.preventDefault();
                            var $this = $(this);
                            var id = '#' + $this.attr('id');

                            // activate left items
                            $('.tft-services-items-left .tft-single-service').removeClass('active');
                            $this.addClass('active');

                            // show corresponding image
                            $('.tft-services-items-right .tft-single-service-image').removeClass('active').hide();
                            $('.tft-services-items-right .tft-single-service-image[data-id="' + id + '"]').addClass('active').show();
                        });
                    });
                }(jQuery));
            </script>
        <?php 
        } 
    }
}
