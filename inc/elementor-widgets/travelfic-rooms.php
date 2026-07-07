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

        // card head
        $this->add_control(
            'popular_card_heading',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'popular_hotel_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popular_card_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3,
                               #tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_hotel_card_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details h3' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'popular_card_feature_head',
            [
                'label'     => __('Features', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_features_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li,
                               #tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content ul li',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_hotel_card_features_color',
            [
                'label'     => __('Features Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details ul li' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_card_price_head',
            [
                'label'     => __('Price', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_price_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-room-content .tf-room-price .discount-price,
                               #tft-site-main-body #page {{WRAPPER}} .tft-room-content .tf-room-price .sale-price',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_hotel_card_price_color',
            [
                'label'     => __('Price Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-content .tf-room-price .discount-price' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-content .tf-room-price .sale-price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'popular_card_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_hotel_card_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details,
                               #tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn',
                'label'    => __('Typography', 'travelfic-toolkit'),
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('popular_hotel_card_button_tabs_');

        $this->start_controls_tab(
            'popular_hotel_card_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
            ]
        );
       
        $this->add_control(
            'popular_hotel_card_button_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_hotel_card_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'popular_hotel_card_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-popular-hotels-items .tft-popular-single-item .tft-hotel-details .tf-others-details a.btn-view-details:hover' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn:hover' => 'color: {{VALUE}}',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-room-section .tft-room-slider .tft-single-room .tft-room-content .tft-room-btn .tft-btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        \Travelfic_Toolkit\Components\Rooms::render( $settings, 'elementor' );
    }
}
