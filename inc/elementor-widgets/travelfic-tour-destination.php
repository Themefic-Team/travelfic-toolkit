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
                    '{{WRAPPER}} .tft-destination-design__one .tft-destination-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-destination-design__three .tft-single-destination .tft-destination-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-destination-design__three .tft-single-destination .tft-destination-thumbnail::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-subtitle',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail::before' => 'background-color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span svg path' => 'stroke: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover svg path' => 'stroke: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover' => 'border-color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__one .tft-destination-title a',
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
                    '{{WRAPPER}} .tft-destination-design__one .tft-destination-title a' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__one .tft-destination-title a:hover' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__one .tft-destination-details ul li a',
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
                    '{{WRAPPER}} .tft-destination-design__one .tft-destination-details ul li a' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__one .tft-destination-details ul li a:hover' => 'color: {{VALUE}}',
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
                'selector' =>  '{{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-heading-content .tft-section-title',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-heading-content .tft-section-title::after' => 'background: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-heading-content .tft-section-subtitle',
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
                    '{{WRAPPER}} .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-heading-content .tft-section-content p',
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
                    '{{WRAPPER}} .tft-heading-content .tft-section-content p' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__three .tft-btn',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__three .tft-btn',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn:hover' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-btn:hover' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail::after' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content .tft-single-destination .tft-destination-thumbnail::after' => 'background-color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__three .tft-destination-content a h3',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content a h3' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content a h3:hover' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .tft-destination-design__three .tft-destination-content p',
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
                    '{{WRAPPER}} .tft-destination-design__three .tft-destination-content p' => 'color: {{VALUE}}',
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
        \Travelfic_Toolkit\Components\TourDestinations::render( $settings, 'elementor' );
    }
}
