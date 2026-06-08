<?php
class Travelfic_Toolkit_ApartmentLocation extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve  widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tft-aprtments-locations';
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
    public function get_title()
    {
        return esc_html__('Travelfic Apartment Location', 'travelfic-toolkit');
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
    public function get_icon()
    {
        return 'eicon-google-maps';
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
     * Retrieve the list of categories the widget belongs to.
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
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['travelfic', 'locations', 'apartments', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-tour-destination'];
    }

    /**
     * Register widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'apartments_locations',
            [
                'label' => __('Apartment Location', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Tour
        $categories = get_categories(array(
            'taxonomy'   => 'apartment_location',
            'hide_empty' => true,
        ));
        $category_options = array();
        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }
        // Design
        $this->add_control(
            'aprt_location_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Design', 'travelfic-toolkit'),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __('Design 1', 'travelfic-toolkit'),
                    'design-2'  => __('Design 2', 'travelfic-toolkit'),
                ],
            ]
        );
        // Design 2 fields
        $this->add_control(
            'location_section_bg',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Section Background', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/destination-bg.png',
                ],
            ]
        );
        $this->add_control(
            'des_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'label_block' => true,
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Next level of living', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'des_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'label_block' => true,
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Destinations', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        // Tour
        $this->add_control(
            'categories_id',
            [
                'label' => __('Select Apartment Location', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $category_options,
                'default' => '',
                'multiple' => true,
                'label_block' => true,
                'separator'   => 'after',
            ]
        );

        $this->add_control(
            'post_per_page',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __('Item Limit', 'travelfic-toolkit'),
                'placeholder' => __('Post Per Page', 'travelfic-toolkit'),
                'default'     => 4,
            ]
        );

        // 
        $this->add_control(
            'cat_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Order', 'travelfic-toolkit'),
                'default' => 'DESC',
                'options' => [
                    'DESC' => __('Descending', 'travelfic-toolkit'),
                    'ASC'  => __('Ascending', 'travelfic-toolkit'),
                ],
            ]
        );
        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'apartments_locations_style',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'apartments_locations_image_border_radius',
            [
                'label'      => __('Image Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );

        $this->add_control(
            'apartments_locations_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'apartments_locations_title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a',
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );


        // Design 2 Styles start
        $this->add_control(
            'apartments_locations_design_2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'apartments_locations_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-destination-header h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-destination-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_design_2_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'apartments_locations_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_design_2_card_head',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_responsive_control(
            'apartment_location_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3, #tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartment_destination_card_opacity',
            [
                'label'     => __('Overley', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two  .tft-single-destination .tft-destination-thumbnail::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'single_destination_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'single_destination_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'about_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->start_controls_tabs('single_destination_button_tabs_');

        $this->start_controls_tab(
            'single_destination_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        
        

        $this->end_controls_tab();

        $this->start_controls_tab(
            'single_destination_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_hover_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_hover_border',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();

      
        $this->add_control(
            'apartments_locations_design_2_arrows_head',
            [
                'label'     => __('Arrows', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_control(
            'single_destination_arrows_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-destination-content .tft-destination-slides .slick-arrow path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
        \Travelfic_Toolkit\Components\ApartmentLocation::render( $settings, 'elementor' );
    }
}
