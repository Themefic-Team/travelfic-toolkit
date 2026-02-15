<?php

use \Tourfic\Classes\Hotel\Pricing as Hotel_Price;
use Tourfic\Classes\Room\Pricing;

class Travelfic_Toolkit_Rooms extends \Elementor\Widget_Base
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
        return 'tft-rooms';
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
        return esc_html__('Travelfic Rooms', 'travelfic-toolkit');
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
        return 'eicon-posts-ticker';
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
        return ['travelfic', 'popular', 'rooms', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-rooms'];
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
            'tft_rooms',
            [
                'label' => __('Rooms Section', 'travelfic-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'tft_rooms_style',
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
            'tft_section_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Our facilities are your playground', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'tft_section_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Our Rooms', 'travelfic-toolkit'),
            ]
        );
        // Order by.
        $this->add_control(
            'post_order_by',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => __('Order by', 'travelfic-toolkit'),
                'default' => 'date',
                'options' => [
                    'date' => __('Date', 'travelfic-toolkit'),
                    'title' => __('Title', 'travelfic-toolkit'),
                    'modified' => __('Modified date', 'travelfic-toolkit'),
                ],
            ]
        );

        $this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __('Item Per page', 'travelfic-toolkit'),
                'placeholder' => __('6', 'travelfic-toolkit'),
                'default'     => 6,
            ]
        );
        // Order
        $this->add_control(
            'post_order',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => __('Order', 'travelfic-toolkit'),
                'default' => 'DESC',
                'options' => [
                    'DESC' => __('Descending', 'travelfic-toolkit'),
                    'ASC' => __('Ascending', 'travelfic-toolkit')
                ],
            ]
        );
        // Card Title
        $this->add_control(
            'card_title_type',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => __('Card Title', 'travelfic-toolkit'),
                'default' => 'Split',
                'options' => [
                    'Split' => __('Split', 'travelfic-toolkit'),
                    'Full' => __('Full Title', 'travelfic-toolkit')
                ],
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

        $this->end_controls_section();

        // slider control settings check
        $this->start_controls_section(
            'team_slider_control',
            [
                'label' => __('Slider Control', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

            ]
        );
        $this->add_control(
            'tft_room_slider_slidetoshow',
            [
                'label'       => __('Slide To Show', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 15,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_control(
            'tft_room_slider_slidetoscroll',
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
            'tft_room_slider_navigation',
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
            'tft_room_slider_autoplay',
            [
                'label'       => __('Autoplay', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );
        $this->add_control(
            'tft_room_slider_autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2000,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 5000,
                        'step' => 100
                    ],
                ],
            ]
        );
        $this->add_control(
            'tft_room_slider_autoplay_interval',
            [
                'label' => esc_html__('Autoplay Interval', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1500,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 5000,
                        'step' => 100
                    ],
                ],
            ]
        );
        $this->add_control(
            'tft_room_slider_loop',
            [
                'label' => esc_html__('Loop', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );

        $this->add_control(
            'tft_room_slider_pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'tft_room_slider_pause_on_focus',
            [
                'label' => esc_html__('Pause On Focus', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'tft_room_slider_rtl',
            [
                'label' => esc_html__('RTL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'tft_room_slider_loop!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'tft_room_slider_draggable',
            [
                'label' => esc_html__('Draggable', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'popular_tour_style_section',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Design 1 style settings 

        // title head
        $this->add_control(
            'popular_section_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_section_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        // subtitle head
        $this->add_control(
            'popular_section_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_section_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

      

        // button head
        $this->add_control(
            'popular_section_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );

        $this->add_responsive_control(
            'popular_design1_hotel_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_design1_hotel_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'popular_design1_hotel_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn',
            ]
        );

        $this->add_control(
            'popular_design1_hotel_button_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->end_controls_tabs();

        $this->start_controls_tabs('popular_section_design1_button_tabs');
        $this->start_controls_tab(
            'popular_section_design1_button_normal',
            [
                'label'     => __('Normal', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'popular_section_button_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn span svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_button_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_section_design1_button_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_section_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn:hover' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn:hover span svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_button_hover_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_section_button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        // card head
        $this->add_control(
            'popular_card_heading',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ]
            ]
        );
        $this->add_responsive_control(
            'popular_hotel_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-popular-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details' => 'left: {{LEFT}}{{UNIT}};right: {{RIGHT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ]
            ]
        );
        $this->add_control(
            'popular_hotel_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ]
            ]
        );

        $this->add_control(
            'popular_card_review_head',
            [
                'label'     => __('Review', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_review_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-ratings span',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ]
            ]
        );
        $this->add_control(
            'popular_hotel_card_review_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-ratings span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ]
            ]
        );
        $this->add_control(
            'popular_card_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_card_location_head',
            [
                'label'     => __('Location', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_location_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations span',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_location_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations span' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tft-locations svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_card_feature_head',
            [
                'label'     => __('Features', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_features_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_features_color',
            [
                'label'     => __('Features Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_card_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_hotel_card_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_hotel_card_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ],
            ]
        );
        $this->start_controls_tabs('popular_hotel_card_button_tabs_');

        $this->start_controls_tab(
            'popular_hotel_card_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ],
            ]
        );
       
        $this->add_control(
            'popular_hotel_card_button_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_hotel_card_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_hover_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-1'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
    
    
        // Design 2 style settings 

        // title head
        $this->add_control(
            'popular_section_room_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_room_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ],
            ]
        );
        $this->add_control(
            'popular_section_room_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ],
            ]
        );


        // subtitle head
        $this->add_control(
            'popular_section_room_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_room_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ],
            ]
        );
        $this->add_control(
            'popular_section_room_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ],
            ]
        );

        $this->end_controls_section();
        // card
        $this->start_controls_section(
            'popular_room_card_tab',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_background',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_responsive_control(
            'popular_room_hotel_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_border_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );

        // image
        $this->add_control(
            'popular_room_hotel_card_image_heading',
            [
                'label'     => __('Image', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_image_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}}  .tft-room-section .tft-room-slider .tft-single-destination .tft-room-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );

        // featured
        $this->add_control(
            'popular_room_hotel_card_featured_heading',
            [
                'label'     => __('Featured', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_featured_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}}  .tft-room-section .tft-room-slider .tft-single-destination .tft-room-thumbnail .tft-room-featured .tft-featured' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_room_hotel_card_featured_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-thumbnail .tft-room-featured .tft-featured',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_featured_back_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-thumbnail .tft-room-featured .tft-featured' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_featured_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-thumbnail .tft-room-featured .tft-featured' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );


        // card title
        $this->add_control(
            'popular_room_hotel_card_title_heading',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon-popular_room_hotel_card_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_title_hover_color',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-title:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );

        // review meta
        $this->add_control(
            'popular_room_hotel_review_meta_heading',
            [
                'label'     => __('Review', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_review_icon_meta_typo',
            [
                'label'     => __('Size', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'popular_room_hotel_review_icon_meta_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-rating i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );

        // location meta
        $this->add_control(
            'popular_room_hotel_card_meta_heading',
            [
                'label'     => __('Location', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_room_hotel_card_meta_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-location',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_meta_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-location span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_icon_meta_typo',
            [
                'label'     => __('Size', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-location i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'popular_room_hotel_card_icon_meta_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-top-info .tft-room-location i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );

        // price
        $this->add_control(
            'popular_room_hotel_price_head',
            [
                'label'     => __('Price', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_room_hotel_price_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-price .tft-room-price-value',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_price_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-price .tft-room-price-value' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_room_hotel_price_label_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-price .tft-room-price-title',
                'label'    => __('Label Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_room_hotel_price_label_color',
            [
                'label'     => __('Label Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-price .tft-room-price-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2'
                ]
            ]
        );

        // button
        $this->add_control(
            'popular_room_hotel_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_room_hotel_button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_room_hotel_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_room_hotel_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'popular_room_hotel_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_room_hotel_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs_');

        $this->start_controls_tab(
            'popular_room_hotel_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
       

        $this->add_control(
            'popular_room_hotel_button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_room_hotel_button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'popular_room_hotel_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_room_hotel_button_hover_color',
            [
                'label'     => __('Text Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_room_hotel_button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_room_hotel_button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-destination .tft-room-content .tft-room-bottom-info .tft-room-btn .tft-btn:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // navigations
        $this->start_controls_section(
            'popular_room_hotel_nav',
            [
                'label' => __('Nav', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_room_hotel_nav_arrow_width',
            [
                'label' => esc_html__('Size', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_room_hotel_nav_border_width',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button' => 'border-width: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .slick-dots li' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_room_hotel_nav_border_color',
            [
                'label'     => __('Border Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button' => 'border-color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .slick-dots li.slick-active' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_room_hotel_nav_border_hover_color',
            [
                'label'     => __('Border Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_popular_room_hotel_nav_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
       
        $this->start_controls_tabs('popular_room_hotel_icon_style_tabs_');

        $this->start_controls_tab(
            'popular_room_hotel_icon_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
       
        $this->add_control(
            'testimonials_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
       
        $this->add_control(
            'testimonials_icon_nav_icon_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_room_hotel_icon_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_color_hover',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_bg_hover',
            [
                'label'     => __('Background ', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider-nav button:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'tft_popular_room_hotel_nav_head',
            [
                'label'     => __('Nav', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'popular_room_hotel_nav_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .slick-dots li button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .slick-dots li button:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_rooms_style' => 'design-2',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['tft_rooms_style'])) {
            $tft_design = $settings['tft_rooms_style'];
        }

        $tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];

		if (in_array('hotel', $tf_disable_services)){
			return;
		}

        $args = array(
            'post_type' => 'tf_room'
        );

        // Items per page
        if (!empty($settings['post_items'])) {
            $args['posts_per_page'] = $settings['post_items'];
        }

        // Items Order By
        if (!empty($settings['post_order_by'])) {
            $args['orderby'] = $settings['post_order_by'];
        }

        // Items Order
        if (!empty($settings['post_order'])) {
            $args['order'] = $settings['post_order'];
        }

        $query = new \WP_Query($args);

        $tft_sec_title = !empty($settings['tft_section_title']) ? $settings['tft_section_title'] : '';
        $tft_sec_subtitle = !empty($settings['tft_section_subtitle']) ? $settings['tft_section_subtitle'] : '';

        $slideToShow = !empty($settings['tft_room_slider_slidetoshow']) ? $settings['tft_room_slider_slidetoshow'] : 3;
        $postCount = $query->post_count;

        // disable slider
        $tftDisableClass = '';
        $tftSliderDisable = false;
        if ($postCount < $slideToShow) {
            $tftSliderDisable = true;
            $tftDisableClass = 'tft-slider-disable';
        }


        // slider control settings check
        $room_slide_to_scroll = !empty($settings['tft_room_slider_slidetoscroll']) ? $settings['tft_room_slider_slidetoscroll'] : 1;

        $room_slider_nav = $settings['tft_room_slider_navigation'];

        $room_slider_arrows = ("arrows" === $room_slider_nav) ? 'true' : 'false';
        $room_slider_dots = ("dots" === $room_slider_nav) ? 'true' : 'false';

        $room_slider_autoplay = ('yes' === $settings['tft_room_slider_autoplay']) ? 'true' : 'false';
        $room_slider_autoplay_speed = !empty($settings['tft_room_slider_autoplay_speed']) ? $settings['tft_room_slider_autoplay_speed']['size'] : 0;
        $room_slider_autoplay_interval = !empty($settings['tft_room_slider_autoplay_interval']) ? $settings['tft_room_slider_autoplay_interval']['size'] : 0;
        $room_slider_loop = ('yes' === $settings['tft_room_slider_loop']) ? 'true' : 'false';
        $room_slider_pause_on_hover = ('yes' === $settings['tft_room_slider_pause_on_hover']) ? 'true' : 'false';
        $room_slider_pause_on_focus = ('yes' === $settings['tft_room_slider_pause_on_focus']) ? 'true' : 'false';
        $room_slider_rtl = ('yes' === $settings['tft_room_slider_rtl']) ? 'true' : 'false';
        $room_slider_draggable = ('yes' === $settings['tft_room_slider_draggable']) ? 'true' : 'false';
        
        if ('design-1' == $tft_design): ?>
            <div class="tft-room-section tft-customizer-typography">
                <div class="tft-room-sec-header">
                    <div class="tft-room-header-left">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo wp_kses_post($tft_sec_subtitle); ?></h3>
                        <?php } if (!empty($tft_sec_title)) {?>
                            <h2 class="tft-section-title"><?php echo wp_kses_post($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="read-more">
                        <a href="<?php echo esc_url($settings['see_all_link']['url']); ?>" class="tft-btn tft-btn-transparent tft-flex-column">
                            <?php esc_html_e("See All", "travelfic-toolkit"); ?>
                        </a>
                    </div>
                </div>
                <div class="tft-room-items">
                    <div class="tft-room-slider <?php echo esc_attr($tftDisableClass); ?>">
                        <?php if ($query->have_posts()): ?>
                            <?php while ($query->have_posts()):
                                $query->the_post();
                                $post_id = get_the_ID();
                                $room    = get_post_meta( $post_id, 'tf_room_opt', true );
                                $adult_number = ! empty( $room['adult'] ) ? $room['adult'] : '0';
                                $child_number = ! empty( $room['child'] ) ? $room['child'] : '0';
                                $footage = ! empty( $room['footage'] ) ? $room['footage'] : '';
                                $min_price_arr = Pricing::instance($post_id)->get_min_price('');
                                $min_discount_type = !empty($min_price_arr['min_discount_type']) ? $min_price_arr['min_discount_type'] : 'none';
                                $min_discount_amount = !empty($min_price_arr['min_discount_amount']) ? $min_price_arr['min_discount_amount'] : 0;
                                ?>
                                <div class="tft-single-room">
                                    <div class="tft-room-thumbnail">
                                        <?php $tft_hotel_image = !empty(get_the_post_thumbnail_url(get_the_ID())) ? esc_url(get_the_post_thumbnail_url(get_the_ID())) : esc_url(site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png'); ?>
                                        <img src="<?php echo esc_url($tft_hotel_image); ?>" alt="post thumbnail">

                                        <?php if ( ! empty( $min_discount_amount ) ) : ?>
                                            <div class="tf-room-off">
                                                <span>
                                                    <?php echo $min_discount_type == "percent" ? esc_html( $min_discount_amount ) . '%' : wp_kses_post( wc_price( $min_discount_amount ) ) ?><?php esc_html_e( " Off ", "tourfic" ); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tft-room-content">
                                        <div class="tft-room-title-wrap">
                                            <h2 class="tft-room-title">
                                                <a href="<?php echo esc_url(get_the_permalink()) ?>" class="tft-color-hover-primary">
                                                    <?php
                                                    if ("Split" == $settings['card_title_type']) {
                                                        echo esc_html(travelfic_character_limit(get_the_title(), 20));
                                                    } else {
                                                        the_title();
                                                    }
                                                    ?>
                                                </a>
                                            </h2>
                                            <div class="tf-room-price"><?php Pricing::instance( $post_id )->get_per_price_html( '', 'design-3' ); ?></div>
                                        </div>
                                        <ul>
                                            <?php if ( $footage ) { ?>
                                                <li><?php echo esc_html( $footage ); ?> /</li>
                                            <?php } ?>

                                            <?php if ( $adult_number ) { ?>
                                            <li>
                                                <?php
                                                // Adult count with singular/plural translation
                                                $adult_count = intval( $adult_number );
                                                echo esc_html( sprintf( '%d %s', $adult_count, _n( 'Adult', 'Adults', $adult_count, 'travelfic-toolkit' ) ) );
                                                ?> /
                                            </li>
                                            <?php } ?>

                                            <?php if ( $child_number ) { ?>
                                            <li>
                                                <?php
                                                // Child count with singular/plural translation
                                                $child_count = intval( $child_number );
                                                echo esc_html( sprintf( '%d %s', $child_count, _n( 'Child', 'Children', $child_count, 'travelfic-toolkit' ) ) );
                                                ?>
                                            </li>
                                            <?php } ?>
                                        </ul>

                                        <div class="tft-room-btn">
                                            <a href="<?php echo esc_url(get_the_permalink()) ?>" class="tft-btn tft-bg-hover-primary">
                                                <?php esc_html_e("Book Now", "travelfic-toolkit"); ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M7 7H17M17 7V17M17 7L7 17" stroke="#F5FFFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php endwhile;
                        endif; ?>
                    </div>
                    <!-- room slider navigation -->
                    <?php if ($tftSliderDisable == false && 'true' === $room_slider_arrows): ?>
                        <div class="tft-destination-slider-nav">
                            <button type="button" class="tft-prev-slide tft-bg-hover-primary">
                                <i class="ri-arrow-left-line"></i>
                            </button>
                            <button type="button" class="tft-next-slide tft-bg-hover-primary">
                                <i class="ri-arrow-right-line"></i>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <script>
                    // room Slider
                    (function($) {
                        $(document).ready(function() {
                            //Your Code Inside
                            $('.tft-room-section .tft-room-slider').slick({
                                slidesToShow: <?php echo esc_attr($slideToShow); ?>,
                                slidesToScroll: <?php echo esc_attr($room_slide_to_scroll); ?>,
                                infinite: <?php echo esc_attr($room_slider_loop); ?>,
                                autoplay: <?php echo esc_attr($room_slider_autoplay); ?>,
                                autoplaySpeed: <?php echo esc_attr($room_slider_autoplay_speed); ?>,
                                speed: <?php echo esc_attr($room_slider_autoplay_interval); ?>,
                                dots: <?php echo esc_attr($room_slider_dots); ?>,
                                arrows: <?php echo esc_attr($room_slider_arrows); ?>,
                                pauseOnHover: <?php echo esc_attr($room_slider_pause_on_hover); ?>,
                                pauseOnFocus: <?php echo esc_attr($room_slider_pause_on_focus); ?>,
                                rtl: <?php echo esc_attr($room_slider_rtl); ?>,
                                draggable: <?php echo esc_attr($room_slider_draggable); ?>,
                                cssEase: 'linear',
                                prevArrow: '.tft-room-section .tft-prev-slide',
                                nextArrow: '.tft-room-section .tft-next-slide',
                                variableWidth: true,
                                adaptiveHeight: true,
                                responsive: [{
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1,

                                        }
                                    },
                                    {
                                        breakpoint: 640,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1,
                                            centerMode: true
                                        }
                                    }
                                ]
                            });
                        });

                    }(jQuery));
                </script>
            </div>
<?php endif;
    }
}
