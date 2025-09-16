<?php
class Travelfic_Toolkit_TourDestinaions extends \Elementor\Widget_Base
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
        return 'tft-destinations-tours';
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
        return esc_html__('Travelfic Tour Destinations', 'travelfic-toolkit');
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
        return ['travelfic', 'destinaions', 'tours', 'tft'];
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
            'tour_destination',
            [
                'label' => __('Tour Destinations', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // tour destination get categories
        $categories = get_categories(array(
            'taxonomy'   => 'tour_destination',
            'hide_empty' => true,
        ));

        $category_options = array();
        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }

        // tour attractions get categories
        $attraction_categories = get_categories(array(
            'taxonomy'   => 'tour_attraction',
            'hide_empty' => true,
        ));

        // tour attractions store categories in array
        $attractions_cat_options = array();
        foreach ($attraction_categories as $cat) {
            $attractions_cat_options[$cat->term_id] = $cat->name;
        }

        // Design
        $this->add_control(
            'des_style',
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
        // Tour

        // Design 2 fields
        $this->add_control(
            'location_section_bg',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Section Background', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2', 
                ],
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/destination-bg.png',
                ],
            ]
        );
        $this->add_control(
            'des_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Top destinations', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-2', 'design-3', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'des_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Destinations', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-2', 'design-3', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'des_description',
            [
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label' => esc_html__('Destination Descriptions', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your descriptions', 'travelfic-toolkit'),
                'default' => __('We offer amazing properties that are full of character, situated in beautiful neighborhoods so you can feel right at home anywhere in the world travel society for healthy life backup.', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'readme_label',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Button Label', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter button label', 'travelfic-toolkit'),
                'default' => __('View All Destination', 'travelfic-toolkit'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'readme_url',
            [
                'type' => \Elementor\Controls_Manager::URL,
                'label' => esc_html__('Button URL', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter button url', 'travelfic-toolkit'),
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        // Tour
        $this->add_control(
            'categories_id',
            [
                'label' => __('Select Tour Destinations', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $category_options,
                'default' => '',
                'multiple' => true,
                'label_block' => true,
                'separator'   => 'after',
                'condition' => [
                    'des_style' => ['design-1', 'design-2', 'design-3'],
                ],
            ]
        );

        $this->add_control(
            'attractions_cat_id',
            [
                'label' => __('Select Tour Attractions', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $attractions_cat_options,
                'default' => '',
                'multiple' => true,
                'label_block' => true,
                'separator'   => 'after',
                'condition' => [
                    'des_style' => ['design-4'],
                ],
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
            'tour_destination_style',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'tour_destination_image_border_radius',
            [
                'label'      => __('Image Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-single-destination .tft-destination-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-single-destination .tft-destination-thumbnail::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'des_style' => ['design-1', 'design-3'],
                ],
            ]
        );
      
        // Design 2 Styles start
        $this->add_control(
            'tour_destination_design2_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'tour_destination_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-2'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_design2_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tour_destination_card_head',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_responsive_control(
            'tour_destination_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'tour_destination_card_opacity',
            [
                'label'     => __('Overley', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-2'],
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
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2', 
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
                    'des_style' => 'design-2', 
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
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2', 
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
                    'des_style' => 'design-2', 
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
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'single_destination_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->start_controls_tabs('single_destination_button_tabs_');

        $this->start_controls_tab(
            'single_destination_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2', 
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
                    'des_style' => 'design-2', 
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'single_destination_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_hov_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_hov_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_border_hov_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', 
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
       
        // Design 2 Styles end
         $this->add_control(
            'tour_destination_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-1',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a',
                'condition' => [
                    'des_style' => 'design-1', 
                ],
            ]
        );
        $this->add_control(
            'tour_destination_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-1', 
                ],
            ]
        );
        $this->add_control(
            'tour_destination_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-1', 
                ],
            ]
        );
        $this->add_control(
            'tour_destination_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-1',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sub_list',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-details ul li a',
                'condition' => [
                    'des_style' => 'design-1', 
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sub_list_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-details ul li a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-1', 
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sub_list_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-details ul li a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-1', 
                ],
            ]
        );

        // design 3
        $this->add_control(
            'tour_destination_header_design_3',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_design_3_sec_title_typo',
                'selector' =>  '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_design3_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        // Title Backdrop
        $this->add_control(
            'tour_destination_design3_title_backdrop',
            [
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label' => esc_html__('Title Backdrop', 'travelfic-toolkit'),
                'default' => 'yes',
                'condition' => [
                    'des_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'tour_destination_design3_title_backdrop_head',
            [
                'label'     => __('Title Backdrop', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-3',
                    'tour_destination_design3_title_backdrop' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'tour_destination_design3_title_backdrop_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-heading-content .tft-section-title::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-3',
                    'tour_destination_design3_title_backdrop' => 'yes',
                ],
            ]
        );
        // Sub title
        $this->add_control(
            'tour_destination_subtitle',
            [
                'label'     => __('Sub title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sub_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sub_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_content_design_3',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_content_design_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_content_color_design_3',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        //Buttons
        $this->add_control(
            'tour_destination_buttons_style',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn',
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_responsive_control(
            'tour_destination_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_responsive_control(
            'tour_destination_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tour_destination_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn',
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs_');

        $this->start_controls_tab(
            'tour_destination_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'tour_destination_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->add_control(
            'tour_destination_button_Border_hover_color',
            [
                'label'     => __('Background Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-btn:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'tour_destination_post_card',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_design3_border_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail::after' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'des_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'tour_destination_design3_card_opacity',
            [
                'label'     => __('Overley', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail::after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        // title
        $this->add_control(
            'tour_destination_card_title_heading',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-3'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_card_title_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content a h3',
                'label'    => __('Typography', 'travelfic-toolkit'),

                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_card_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content a h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_card_title_hover_color',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content a h3:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        // paragraph
        $this->add_control(
            'tour_destination_card_para_heading',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'des_style' => 'design-3'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_card_para_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );
        $this->add_control(
            'tour_destination_card_para_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__three .tft-destination-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => ['design-3'],
                ],
            ]
        );

        $this->end_controls_section();
    }



    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['cat_order'])) {
            $order = $settings['cat_order'];
        }
        if (!empty($settings['post_per_page'])) {
            $post_per_page = $settings['post_per_page'];
        }
        if (!empty($settings['categories_id'])) {
            $cat_ids = $settings['categories_id'];
            intval($cat_ids);
        } else {
            $cat_ids = $settings['categories_id'];
        }
        if (!empty($settings['attractions_cat_id'])) {
            $attraction_cat_ids = $settings['attractions_cat_id'];
            intval($attraction_cat_ids);
        } else {
            $attraction_cat_ids = $settings['attractions_cat_id'];
        }


        // Design
        if (!empty($settings['des_style'])) {
            $tft_design = $settings['des_style'];
        }

        if (!empty($settings['des_title'])) {
            $tft_sec_title = $settings['des_title'];
        }

        $section_title_backdrop = $settings['tour_destination_design3_title_backdrop'] !== 'yes' ? ' tft-no-backdrop' : '';

        if (!empty($settings['des_subtitle'])) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }
        if (!empty($settings['des_description'])) {
            $tft_sec_content = $settings['des_description'];
        }

        if (!empty($settings['readme_url'])) {
            $tft_readme_url = $settings['readme_url'];
        }

        if (!empty($settings['location_section_bg'])) {
            $tft_location_section_bg = $settings['location_section_bg'];
        }

        $taxonomy = ('design-4' === $tft_design) ? 'tour_attraction' : 'tour_destination';
        $included = ('design-4' === $tft_design) ? $attraction_cat_ids : $cat_ids;

        $show_count = 0;
        $orderby = 'name';
        $pad_counts = 0;
        $hierarchical = 1;
        $title = '';
        $empty = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'order'        => $order,
            'number'       => $post_per_page,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'include'      => $included,
            'hide_empty'   => $empty,
        );

        // get all posts based on the taxonomy
        if ('design-4' === $tft_design) {
            $tax_query = [];
            if (!empty($included)) {
                $tax_query[] = [
                    'taxonomy' => 'tour_attraction',
                    'field' => 'term_id',
                    'terms' => $included,
                    'include_children' => false,
                ];
            }

            $args = [
                'post_type' => 'tf_tours',
                'order_by' => $orderby ?? 'name',
                'order' => $order ?? 'DESC',
                'post_per_page' => $post_per_page ?? 5,
                'tax_query' => $tax_query,
            ];

            $all_attraction_posts = get_posts($args);
        } else {
            $all_destination_categories = get_categories($args);
        }




        // design 1
        if ("design-1" == $tft_design) {
?>

            <div class="tft-destination-design__one tft-customizer-typography">
                <div class="tft-destination tft-row">
                    <?php
                    foreach ($all_destination_categories as $cat) {
                        if ($cat->category_parent == 0) {
                            $category_id = $cat->term_id;
                            $meta = get_term_meta($cat->term_id, 'tf_tour_destination', true);
                            if (!empty($meta['image'])) {
                                $cat_image = $meta['image'];
                            } else {
                                $cat_image = TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
                            }
                    ?>
                            <div class="tft-single-destination tft-col">
                                <div class="tft-destination-thumbnail tft-thumbnail">
                                    <a href="<?php echo esc_url(get_term_link($cat->slug, 'tour_destination')); ?>"><img src="<?php echo esc_url($cat_image); ?>" alt="<?php esc_html_e("Tour Destination Image", "travelfic-toolkit"); ?>"></a>
                                </div>
                                <div class="tft-destination-title">
                                    <?php echo '<a href="' . esc_url(get_term_link($cat->slug, 'tour_destination')) . '" class="tft-color-text">' . esc_html($cat->name) . '</a>'; ?>
                                </div>
                                
                                <div class="tft-destination-details">
                                    <ul>
                                        <?php
                                        $args2 = array(
                                            'taxonomy'     => $taxonomy,
                                            'child_of'     => 0,
                                            'parent'       => $category_id,
                                            'orderby'      => $orderby,
                                            'show_count'   => $show_count,
                                            'pad_counts'   => $pad_counts,
                                            'hierarchical' => $hierarchical,
                                            'title_li'     => $title,
                                            'hide_empty'   => $empty,
                                        );
                                        $sub_cats = get_categories($args2);
                                        if ($sub_cats) {
                                            foreach ($sub_cats as $sub_category) { ?>
                                                <li><a href="<?php echo esc_url(get_term_link($sub_category->slug, 'tour_destination')); ?>"><?php echo esc_html($sub_category->name); ?></a></li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </div>
                               
                            </div>
                    <?php } else {
                        }
                    } ?>
                </div>
            </div>
            <!-- design 2 -->
        <?php } elseif ("design-2" == $tft_design) { ?>
            <div class="tft-destination-design__two" style="background-image: url(<?php echo !empty($tft_location_section_bg['url']) ? esc_url($tft_location_section_bg['url']) : ''; ?>);">
                <div class="tft-destination-header">
                    <div class="tft-heading-content">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php } if (!empty($tft_sec_title)) { ?>
                            <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="tft-tour-destination-slides-arrows">
                        <button type="button" class="slick-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
                                <path d="M7.82843 11.0009H44V13.0009H7.82843L13.1924 18.3648L11.7782 19.779L4 12.0009L11.7782 4.22266L13.1924 5.63687L7.82843 11.0009Z" fill="#B58E53"/>
                            </svg>
                        </button>
                        <button type="button" class="slick-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
                                <path d="M40.1716 11.0009H4V13.0009H40.1716L34.8076 18.3648L36.2218 19.779L44 12.0009L36.2218 4.22266L34.8076 5.63687L40.1716 11.0009Z" fill="#B58E53"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <?php $rand_number = wp_rand(8, 10); ?>
                <div class="tft-destination-content">
                    <div class="tft-destination-slides tft-destination-slide-<?php echo esc_attr($rand_number); ?>">
                        <?php
                        foreach ($all_destination_categories as $cat) {
                            if ($cat->category_parent == 0) {
                                $category_id = $cat->term_id;
                                $meta = get_term_meta($cat->term_id, 'tf_tour_destination', true);
                                if (!empty($meta['image'])) {
                                    $cat_image = $meta['image'];
                                } else {
                                    $cat_image = TRAVELFIC_TOOLKIT_ASSETS . 'app/img/location.jpeg';
                                }
                        ?>
                                <div class="tft-single-destination">
                                    <div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url($cat_image); ?>);">
                                        <a href="<?php echo esc_url(get_term_link($cat->slug, 'tour_destination')); ?>" class="tft-destination-content">
                                            <div class="tft-content-box">
                                                <h3><?php echo esc_html($cat->name); ?></h3>
                                            </div>
                                            <span class="tft-w-100 tft-btn tft-wh-auto tft-btn_sharp tft-gap-0">
                                                <?php echo esc_html_e("Explore now", "travelfic-toolkit"); ?>
                                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="content">
                                                        <path id="Vector" d="M17.0001 6L1.00012 6" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path id="Vector_2" d="M12.0003 11C12.0003 11 17.0002 7.31756 17.0002 5.99996C17.0003 4.68237 12.0002 1 12.0002 1" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                        <?php } else {
                            }
                        } ?>
                    </div>
                </div>
                <script>
                    // Destination Slider
                    (function($) {
                        $(document).ready(function() {
                            //Your Code Inside
                            $('.tft-destination-slide-<?php echo esc_attr($rand_number); ?>').slick({
                                dots: false,
                                arrows: true,
                                infinite: true,
                                speed: 300,
                                autoplaySpeed: 2000,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                prevArrow:'.tft-tour-destination-slides-arrows .slick-prev',
            	                nextArrow:'.tft-tour-destination-slides-arrows .slick-next',
                                responsive: [{
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1,
                                            infinite: true,
                                        }
                                    },
                                    {
                                        breakpoint: 580,
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
            <!-- design 3 -->
        <?php } elseif ("design-3" == $tft_design) { ?>
            <div class="tft-destination-design__three tft-section-space" style="background-image: url(<?php echo !empty($tft_location_section_bg['url']) ? esc_url($tft_location_section_bg['url']) : ''; ?>);">
                <div class="tft-destination-content">
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
                        <?php }
                        if (!empty($settings['readme_label'])) { ?>
                            <a href="<?php echo esc_url($tft_readme_url['url']); ?>" class="tft-btn" target="_blank" rel="noopener noreferrer">
                                <?php echo esc_html($settings['readme_label']); ?>
                                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                    foreach ($all_destination_categories as $cat) {
                        if ($cat->category_parent == 0) {
                            $category_id = $cat->term_id;
                            $meta = get_term_meta($cat->term_id, 'tf_tour_destination', true);
                            if (!empty($meta['image'])) {
                                $cat_image = $meta['image'];
                            } else {
                                $cat_image = TRAVELFIC_TOOLKIT_ASSETS . 'app/img/destination-placeholder.png';
                            }
                    ?>
                            <div class="tft-single-destination">
                                <div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url($cat_image); ?>);">
                                    <div class="tft-destination-content tft-content-box">
                                        <h3>
                                            <a href="<?php echo esc_url(get_term_link($cat->slug, 'tour_destination')); ?>" class="tft-destination-content">
                                                <?php echo esc_html($cat->name); ?>
                                            </a>
                                        </h3>
                                        <p class="tft-color-white"><?php echo esc_html($cat->count); ?> <span><?php echo esc_html__('Destination', 'travelfic-toolkit'); ?></span></p>
                                    </div>

                                </div>
                            </div>
                        <?php }
                    }
                    if (!empty($settings['readme_label'])) { ?>
                        <a href="<?php echo esc_url($tft_readme_url['url']); ?>" class="tft-btn tft-btn--mobile tft-btn-transparent" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($settings['readme_label']); ?>
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <!-- design 4 -->
        <?php 
        }
    }
}
