<?php

use \Tourfic\Classes\Hotel\Pricing as Hotel_Price;

class Travelfic_Toolkit_Hotels extends \Elementor\Widget_Base
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
        return 'tft-hotels';
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
        return esc_html__('Travelfic Hotels, Tours & Apartment', 'travelfic-toolkit');
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
        return ['travelfic', 'popular', 'hotels', 'tours', 'apartment', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-hotels'];
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
            'tft_hotels',
            [
                'label' => __('Hotels, Tours & Apartment Section', 'travelfic-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'tft_hotels_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Design', 'travelfic-toolkit'),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __('Design 1', 'travelfic-toolkit'),
                    'design-2' => __('Design 2', 'travelfic-toolkit'),
                ],
            ]
        );
        $this->add_control(
            'tft_posts_section_bg',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Section Background', 'travelfic-toolkit'),
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/hotel-lists-bg.png',
                ],
            ]
        );
        $this->add_control(
            'tft_posts_type',
            [
                'type'     => \Elementor\Controls_Manager::SELECT,
                'label'    => __('Type', 'travelfic-toolkit'),
                'options'  => array(
                    'alls'   => __('*', 'travelfic-toolkit'),
                    'all' => __('All', 'travelfic-toolkit'),
                    'featured'  => __('Featured', 'travelfic-toolkit'),
                ),
                'default'  => 'alls',
            ]
        );
        $this->add_control(
            'tft_section_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('The best hotels to explore', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'tft_section_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Hotels', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'tf_post_type',
            [
                'label' => __('Post Type', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'tf_hotel',
                'options' => [
                    'tf_hotel' => __('Hotels', 'travelfic-toolkit'),
                    'tf_tours' => __('Tours', 'travelfic-toolkit'),
                    'tf_apartment' => __('Apartments', 'travelfic-toolkit')
                ]
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ]
            ]
        );



        $this->add_control(
            'view_all_link',
            [
                'type' => \Elementor\Controls_Manager::URL,
                'label' => esc_html__('View ALL URL', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter Link', 'travelfic-toolkit'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tft_hotels_style' => 'design-1'
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
                'condition' => [
                    'tft_hotels_style' => ['design-2'],
                ],

            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_slidetoshow',
            [
                'label'       => __('Slide To Show', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 15,
                'step' => 1,
                'default' => 3,
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_slidetoscroll',
            [
                'label'       => __('Slide To Scroll', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_navigation',
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
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_autoplay',
            [
                'label'       => __('Autoplay', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_autoplay_speed',
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
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_autoplay_interval',
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
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_loop',
            [
                'label' => esc_html__('Loop', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'tft_hotels_design2_slider_pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_pause_on_focus',
            [
                'label' => esc_html__('Pause On Focus', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_rtl',
            [
                'label' => esc_html__('RTL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                    'tft_hotels_design2_slider_loop!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'tft_hotels_design2_slider_draggable',
            [
                'label' => esc_html__('Draggable', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'tft_hotels_style' => 'design-2',
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
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
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
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
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1',
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
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'popular_design1_hotel_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .read-more .tft-btn',
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ],
            ]
        );
        

        $this->end_controls_tabs();

        $this->start_controls_tabs('popular_section_design1_button_tabs');
        $this->start_controls_tab(
            'popular_section_design1_button_normal',
            [
                'label'     => __('Normal', 'travelfic-toolkit'),
                 'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_section_design1_button_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                 'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
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
                'condition' => [
                    'tft_hotels_style' => 'design-1'
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
        
        // list head
        $this->add_control(
            'popular_section_list_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-1',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_list_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ]
            ]
        );

        $this->start_controls_tabs('popular_section_design1_list_tabs');
        $this->start_controls_tab(
            'popular_section_design1_list_normal',
            [
                'label'     => __('Normal', 'travelfic-toolkit'),
                 'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
            ]
        );

        $this->add_control(
            'popular_section_list_item_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ]
            ]
        );
        $this->add_control(
            'popular_section_list_item_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_section_design1_button_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                 'condition' => [
                    'tft_hotels_style' => 'design-1'
                ],
            ]
        );
        $this->add_control(
            'popular_section_list_active_item_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn.active' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ]
            ]
        );
        $this->add_control(
            'popular_section_list_active_item_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__one .tft-heading-content ul li .tft-btn.active' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-1'
                ]
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1',
                ],
            ]
        );
        $this->start_controls_tabs('popular_hotel_card_button_tabs_');

        $this->start_controls_tab(
            'popular_hotel_card_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_hotel_card_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-1',
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
                    'tft_hotels_style' => 'design-1'
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
                    'tft_hotels_style' => 'design-1'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
    
    
        // Design 2 style settings 

        // title head
        $this->add_control(
            'popular_section_design2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_design2_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ],
            ]
        );
        $this->add_control(
            'popular_section_design2_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ],
            ]
        );

        // Title Backdrop
        $this->add_control(
            'popular_section_design2_title_backdrop',
            [
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label' => esc_html__('Title Backdrop', 'travelfic-toolkit'),
                'default' => 'yes',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_section_design2_title_backdrop_head',
            [
                'label'     => __('Title Backdrop', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => ['design-2'],
                    'popular_section_design2_title_backdrop' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'popular_section_design2_title_backdrop_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-title::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                    'popular_section_design2_title_backdrop' => 'yes',
                ],
            ]
        );

        // subtitle head
        $this->add_control(
            'popular_section_design2_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_section_design2_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ],
            ]
        );
        $this->add_control(
            'popular_section_design2_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ],
            ]
        );

        $this->end_controls_section();
        // card
        $this->start_controls_section(
            'popular_design2_card_tab',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_background',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_responsive_control(
            'popular_design2_hotel_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_border_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );

        // image
        $this->add_control(
            'popular_design2_hotel_card_image_heading',
            [
                'label'     => __('Image', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_image_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}}  .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );

        // featured
        $this->add_control(
            'popular_design2_hotel_card_featured_heading',
            [
                'label'     => __('Featured', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_featured_radius',
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
                    '#tft-site-main-body #page {{WRAPPER}}  .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail .tft-destination-featured .tft-featured' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_design2_hotel_card_featured_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail .tft-destination-featured .tft-featured',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_featured_back_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail .tft-destination-featured .tft-featured' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_featured_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-thumbnail .tft-destination-featured .tft-featured' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );


        // card title
        $this->add_control(
            'popular_design2_hotel_card_title_heading',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon-popular_design2_hotel_card_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_title_hover_color',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-title:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );

        // review meta
        $this->add_control(
            'popular_design2_hotel_review_meta_heading',
            [
                'label'     => __('Review', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_review_icon_meta_typo',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'popular_design2_hotel_review_icon_meta_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-rating i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );

        // location meta
        $this->add_control(
            'popular_design2_hotel_card_meta_heading',
            [
                'label'     => __('Location', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_design2_hotel_card_meta_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_meta_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_icon_meta_typo',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'popular_design2_hotel_card_icon_meta_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-top-info .tft-destination-location i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );

        // price
        $this->add_control(
            'popular_design2_hotel_price_head',
            [
                'label'     => __('Price', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_design2_hotel_price_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-price .tft-destination-price-value',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_price_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-price .tft-destination-price-value' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_design2_hotel_price_label_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-price .tft-destination-price-title',
                'label'    => __('Label Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );
        $this->add_control(
            'popular_design2_hotel_price_label_color',
            [
                'label'     => __('Label Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-price .tft-destination-price-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2'
                ]
            ]
        );

        // button
        $this->add_control(
            'popular_design2_hotel_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_design2_hotel_button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_design2_hotel_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_design2_hotel_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'popular_design2_hotel_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_design2_hotel_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs_');

        $this->start_controls_tab(
            'popular_design2_hotel_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
       

        $this->add_control(
            'popular_design2_hotel_button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_design2_hotel_button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'popular_design2_hotel_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_design2_hotel_button_hover_color',
            [
                'label'     => __('Text Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_design2_hotel_button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'popular_design2_hotel_button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .tft-single-destination .tft-destination-content .tft-destination-bottom-info .tft-destination-btn .tft-btn:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // navigations
        $this->start_controls_section(
            'popular_design2_hotel_nav',
            [
                'label' => __('Nav', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_design2_hotel_nav_arrow_width',
            [
                'label' => esc_html__('Size', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'popular_design2_hotel_nav_border_width',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button' => 'border-width: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_design2_hotel_nav_border_color',
            [
                'label'     => __('Border Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button' => 'border-color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li.slick-active' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'popular_design2_hotel_nav_border_hover_color',
            [
                'label'     => __('Border Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'tft_popular_design2_hotel_nav_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
       
        $this->start_controls_tabs('popular_design2_hotel_icon_style_tabs_');

        $this->start_controls_tab(
            'popular_design2_hotel_icon_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
       
        $this->add_control(
            'testimonials_icon_nav_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
       
        $this->add_control(
            'testimonials_icon_nav_icon_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'popular_design2_hotel_icon_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_color_hover',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_icon_bg_hover',
            [
                'label'     => __('Background ', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider-nav button:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'tft_popular_design2_hotel_nav_head',
            [
                'label'     => __('Nav', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'popular_design2_hotel_nav_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-popular-hotels-design__two .tft-destination-slider .slick-dots li button:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_hotels_style' => 'design-2',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['tft_hotels_style'])) {
            $tft_design = $settings['tft_hotels_style'];
        }

        $tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];

        $service_type = '';
		if( $settings['tf_post_type'] == "tf_hotel" ){
			$service_type = "hotel";
		}elseif( $settings['tf_post_type'] == "tf_tours" ){
			$service_type = "tour";
		}elseif( $settings['tf_post_type'] == "tf_apartment" ){
			$service_type = "apartment";
		}

		if (in_array($service_type, $tf_disable_services)){
			return;
		}

        $args = array(
            'post_type' => $settings['tf_post_type']
        );

        $featured_args = array(
            'post_type' => $settings['tf_post_type']
        );

        // Display posts in category.
        if (!empty($settings['post_category'])) {
            $args['category_name'] = $settings['post_category'];
            $featured_args['category_name'] = $settings['post_category'];
        }

        // Items per page
        if (!empty($settings['post_items'])) {
            $args['posts_per_page'] = $settings['post_items'];
            $featured_args['posts_per_page'] = -1;
        }

        // Items Order By
        if (!empty($settings['post_order_by'])) {
            $args['orderby'] = $settings['post_order_by'];
            $featured_args['orderby'] = $settings['post_order_by'];
        }

        // Items Order
        if (!empty($settings['post_order'])) {
            $args['order'] = $settings['post_order'];
            $featured_args['order'] = $settings['post_order'];
        }

        $query = new \WP_Query($args);
        $featured_query = new \WP_Query($featured_args);


        $tft_sec_title = !empty($settings['tft_section_title']) ? $settings['tft_section_title'] : '';
        $section_title_backdrop = $settings['popular_section_design2_title_backdrop'] !== 'yes' ? ' tft-no-backdrop' : '';
        $tft_sec_subtitle = !empty($settings['tft_section_subtitle']) ? $settings['tft_section_subtitle'] : '';

        if (!empty($settings['tft_posts_section_bg'])) {
            $tft_posts_sec_bg = $settings['tft_posts_section_bg'];
        }

        $tft_posts_tabs = !empty($settings['tft_posts_type']) ? $settings['tft_posts_type'] : 'alls';

        $slideToShow = !empty($settings['tft_hotels_design2_slider_slidetoshow']) ? $settings['tft_hotels_design2_slider_slidetoshow'] : 3;
        $postCount = 0;
        // get count posts
        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();
                $postCount++;
            endwhile;
        endif;

        // disable slider
        $tftDisableClass = '';
        $tftSliderDisable = false;
        if ($postCount < $slideToShow) {
            $tftSliderDisable = true;
            $tftDisableClass = 'tft-slider-disable';
        }


        // slider control settings check
        $design2_slide_to_scroll = !empty($settings['tft_hotels_design2_slider_slidetoscroll']) ? $settings['tft_hotels_design2_slider_slidetoscroll'] : 1;

        $design2_slider_nav = $settings['tft_hotels_design2_slider_navigation'];

        $design2_slider_arrows = ("arrows" === $design2_slider_nav) ? 'true' : 'false';
        $design2_slider_dots = ("dots" === $design2_slider_nav) ? 'true' : 'false';

        $slider_box_hidden = ("true" === $design2_slider_arrows) ? ' tft-box-hidden' : '';
        $container_max_width = ("true" === $design2_slider_arrows) ? ' tft-container-width' : '';

        $design2_slider_autoplay = ('yes' === $settings['tft_hotels_design2_slider_autoplay']) ? 'true' : 'false';
        $design2_slider_autoplay_speed = !empty($settings['tft_hotels_design2_slider_autoplay_speed']) ? $settings['tft_hotels_design2_slider_autoplay_speed']['size'] : 0;
        $design2_slider_autoplay_interval = !empty($settings['tft_hotels_design2_slider_autoplay_interval']) ? $settings['tft_hotels_design2_slider_autoplay_interval']['size'] : 0;
        $design2_slider_loop = ('yes' === $settings['tft_hotels_design2_slider_loop']) ? 'true' : 'false';
        $design2_slider_pause_on_hover = ('yes' === $settings['tft_hotels_design2_slider_pause_on_hover']) ? 'true' : 'false';
        $design2_slider_pause_on_focus = ('yes' === $settings['tft_hotels_design2_slider_pause_on_focus']) ? 'true' : 'false';
        $design2_slider_rtl = ('yes' === $settings['tft_hotels_design2_slider_rtl']) ? 'true' : 'false';
        $design2_slider_draggable = ('yes' === $settings['tft_hotels_design2_slider_draggable']) ? 'true' : 'false';
?>
        <?php if ('design-1' == $tft_design): ?>
            <div class="tft-popular-hotels-design__one tft-customizer-typography" style="background-image: url(<?php echo !empty($tft_posts_sec_bg['url']) ? esc_url($tft_posts_sec_bg['url']) : ''; ?>);">
                <div class="tft-popular-hotel-header">
                    <div class="tft-hotel-header tft-heading-content">
                        <?php
                        if (!empty($tft_sec_subtitle)) { ?>
                             <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }if (!empty($tft_sec_title)) {?>
                            <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>

                        <ul>
                            <?php
                            if ("alls" == $tft_posts_tabs) { ?>
                                <li data-id="all">
                                    <button class="tft-btn active tft-btn_sharp"><?php echo esc_html_e("All", "travelfic-toolkit"); ?></button>
                                </li>
                                <li data-id="featured">
                                    <button class="tft-btn tft-btn_gray tft-btn_sharp"><?php echo esc_html_e("Featured", "travelfic-toolkit"); ?></button>
                                </li>
                            <?php } elseif ("all" == $tft_posts_tabs) { ?>
                                <li data-id="all">
                                    <button class="tft-btn active tft-btn_sharp"><?php echo esc_html_e("All", "travelfic-toolkit"); ?></button>
                                </li>
                            <?php } elseif ("featured" == $tft_posts_tabs) { ?>
                                <li data-id="featured">
                                    <button class="tft-btn active tft-btn_sharp"><?php echo esc_html_e("Featured", "travelfic-toolkit"); ?></button>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="read-more">
                        <a href="<?php echo esc_url($settings['view_all_link']['url']); ?>" class="tft-btn tft-large-circle tft-wh-auto tft-flex-column">
                            <?php echo esc_html_e("View All", "travelfic-toolkit"); ?>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
                                    <path d="M56.7071 8.70711C57.0976 8.31658 57.0976 7.68342 56.7071 7.29289L50.3431 0.928932C49.9526 0.538408 49.3195 0.538408 48.9289 0.928932C48.5384 1.31946 48.5384 1.95262 48.9289 2.34315L54.5858 8L48.9289 13.6569C48.5384 14.0474 48.5384 14.6805 48.9289 15.0711C49.3195 15.4616 49.9526 15.4616 50.3431 15.0711L56.7071 8.70711ZM0 9H56V7H0V9Z" fill="#FDF9F4" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="tft-popular-hotels-items tft-popular-hotels-selector tf-widget-all-post" style="<?php echo "alls" == $tft_posts_tabs || "all" == $tft_posts_tabs ? esc_attr("display: grid") : esc_attr("display: none") ?>">

                    <?php if ($query->have_posts()): ?>
                        <?php while ($query->have_posts()):
                            $query->the_post(); ?>
                            <?php
                            // Review Query 
                            $args = array(
                                'post_id' => get_the_ID(),
                                'status'  => 'approve',
                                'type'    => 'comment',
                            );
                            $comments_query = new WP_Comment_Query($args);
                            $comments = $comments_query->comments;
                            if ("tf_hotel" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_hotels_opt');
                                $disable_review_sec = !empty($option_meta['h-review']) ? $option_meta['h-review'] : '';
                            }
                            if ("tf_tours" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_tours_opt');
                                $disable_review_sec = !empty($option_meta['t-review']) ? $option_meta['t-review'] : '';

                                $tour_duration = ! empty($option_meta['duration']) ? $option_meta['duration'] : '';
                                $duration_time = ! empty($option_meta['duration_time']) ? $option_meta['duration_time'] : '';
                                $night         = ! empty($option_meta['night']) ? $option_meta['night'] : false;
                                $night_count   = ! empty($option_meta['night_count']) ? $option_meta['night_count'] : '';
                            }
                            if ("tf_apartment" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_apartment_opt');
                                $disable_review_sec = !empty($option_meta['disable-apartment-review']) ? $option_meta['disable-apartment-review'] : '';
                            }
                            ?>
                            <div class="tft-popular-single-item">
                                <div class="tft-popular-single-item-inner">
                                    <?php
                                    $tft_hotel_image = !empty(get_the_post_thumbnail_url(get_the_ID())) ? esc_url(get_the_post_thumbnail_url(get_the_ID())) : esc_url(site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png');
                                    ?>
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="tft-popular-thumbnail" style="background-image: url(<?php echo esc_url($tft_hotel_image) ?>);">

                                    </a>
                                    <div class="tft-hotel-details">
                                        <?php if ($comments && !$disable_review_sec == '1') { ?>
                                            <div class="tft-ratings">
                                                <span class="tft-color-text">
                                                    <i class="fas fa-star"></i>
                                                    <span class="tft-color-text">
                                                        <?php echo (class_exists("\Tourfic\App\TF_Review")) ? esc_html(\Tourfic\App\TF_Review::tf_total_avg_rating($comments)) : esc_html(tf_total_avg_rating($comments)); ?>
                                                    </span>
                                                    <?php echo esc_html__('out of', 'tourfic'); ?> <?php class_exists("\Tourfic\App\TF_Review") ? esc_html(\Tourfic\App\TF_Review::tf_based_on_text(count($comments))) : esc_html(tf_based_on_text(count($comments))); ?>
                                                </span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="tft-ratings ">
                                                <span class="tft-color-text">
                                                    <i class="fas fa-star"></i>
                                                    <span class="tft-color-text">
                                                        <?php echo esc_html__('0.0', 'tourfic'); ?>
                                                    </span>
                                                    <?php echo esc_html__('out of 0 review', 'tourfic'); ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <h3 class="tft-title<?php echo ("Split" == $settings['card_title_type']) ? ' tft-title-split' : ''; ?>">
                                            <a href="<?php echo esc_url(get_the_permalink()) ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <p class="tft-locations">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                <g clip-path="url(#clip0_1443_3217)">
                                                    <path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1443_3217">
                                                        <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>
                                                <?php
                                                if ("tf_hotel" == $settings['tf_post_type']) {
                                                    echo !empty(tf_data_types($option_meta['map'])['address']) ? esc_html(travelfic_character_limit(tf_data_types($option_meta['map'])['address'], 40)) : '';
                                                }
                                                if ("tf_tours" == $settings['tf_post_type']) {
                                                    echo !empty(tf_data_types($option_meta['location'])['address']) ? esc_html(travelfic_character_limit(tf_data_types($option_meta['location'])['address'], 40)) : '';
                                                }
                                                if ("tf_apartment" == $settings['tf_post_type']) {
                                                    echo !empty(tf_data_types($option_meta['map'])['address']) ? esc_html(travelfic_character_limit(tf_data_types($option_meta['map'])['address'], 40)) : '';
                                                }
                                                ?>
                                            </span>
                                        </p>

                                        <div class="tf-others-details" style="<?php echo "tf_tours" == $settings['tf_post_type'] ? esc_attr('margin-top: 0px') : ''; ?>">
                                            <?php
                                            if ("tf_tours" == $settings['tf_post_type']) {
                                                if ($tour_duration) {
                                            ?>
                                                    <p class="tour-time">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <path d="M10.0001 2.16406C14.6024 2.16406 18.3334 5.89502 18.3334 10.4974C18.3334 15.0997 14.6024 18.8307 10.0001 18.8307C5.39771 18.8307 1.66675 15.0997 1.66675 10.4974H3.33341C3.33341 14.1793 6.31818 17.1641 10.0001 17.1641C13.682 17.1641 16.6667 14.1793 16.6667 10.4974C16.6667 6.8155 13.682 3.83073 10.0001 3.83073C7.7086 3.83073 5.68714 4.98685 4.48717 6.7476L6.66675 6.7474V8.41406H1.66675V3.41406H3.33341L3.33332 5.49671C4.8537 3.47302 7.27402 2.16406 10.0001 2.16406ZM10.8334 6.33073L10.8332 10.1516L13.5356 12.8544L12.3571 14.0329L9.16658 10.8416L9.16675 6.33073H10.8334Z" fill="#595349" />
                                                        </svg>
                                                        <?php echo esc_html($tour_duration); ?>
                                                        <?php
                                                        if ($tour_duration > 1) {
                                                            $dur_string         = 's';
                                                            $duration_time_html = $duration_time . $dur_string;
                                                        } else {
                                                            $duration_time_html = $duration_time;
                                                        }
                                                        echo " " . esc_html($duration_time_html);
                                                        ?>
                                                        <?php if ($night) { ?>
                                                            <span>
                                                                <?php echo esc_html($night_count); ?>
                                                                <?php
                                                                if (! empty($night_count)) {
                                                                    if ($night_count > 1) {
                                                                        echo esc_html__('Nights', 'travelfic-toolkit');
                                                                    } else {
                                                                        echo esc_html__('Night', 'travelfic-toolkit');
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        <?php } ?>
                                                    </p>
                                            <?php }
                                            } ?>
                                            <?php
                                            if ("tf_hotel" == $settings['tf_post_type']) {
                                                $rooms = !empty($option_meta['room']) ? $option_meta['room'] : '';
                                                if (!empty($rooms)) {
                                                    $rm_features = [];
                                                    foreach ($rooms as $key => $room) {
                                                        //merge for each room's selected features
                                                        if (!empty($room['features'])) {
                                                            $rm_features = array_unique(array_merge($rm_features, $room['features']));
                                                        }
                                                    }
                                                    if (!empty($rm_features)) { ?>
                                                        <ul>
                                                            <?php
                                                            $tft_limit = 1;
                                                            foreach ($rm_features as $feature) {
                                                                if ($tft_limit < 7) {
                                                                    $term = get_term_by('id', $feature, 'hotel_feature');

                                                                    $room_f_meta = get_term_meta($feature, 'tf_hotel_feature', true);
                                                                    if (! empty($room_f_meta)) {
                                                                        $room_icon_type = ! empty($room_f_meta['icon-type']) ? $room_f_meta['icon-type'] : '';
                                                                    }
                                                                    if (! empty($room_icon_type) && $room_icon_type == 'fa' && !empty($room_f_meta['icon-fa'])) {
                                                                        $room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
                                                                    } elseif (! empty($room_icon_type) && $room_icon_type == 'c' && ! empty($room_f_meta['icon-c'])) {
                                                                        $room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
                                                                    }
                                                            ?>
                                                                    <li>
                                                                        <?php echo ! empty($room_feature_icon) ? wp_kses_post($room_feature_icon) : ''; ?>
                                                                        <?php echo !empty($term->name) ? esc_html($term->name) : ''; ?>
                                                                    </li>
                                                            <?php
                                                                }
                                                                $tft_limit++;
                                                            } ?>
                                                        </ul>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            if ("tf_apartment" == $settings['tf_post_type']) {
                                                $amenitiess = !empty($option_meta['amenities']) ? tf_data_types($option_meta['amenities']) : '';
                                                if (!empty($amenitiess)) {
                                                    $rm_features = [];
                                                    foreach ($amenitiess as $key => $apartment) {
                                                        //merge for each room's selected features
                                                        if (!empty($apartment['feature'])) {
                                                            $rm_features[] = $apartment['feature'];
                                                        }
                                                    }
                                                    if (!empty($rm_features)) { ?>
                                                        <ul>
                                                            <?php
                                                            $tft_limit = 1;
                                                            foreach ($rm_features as $feature) {
                                                                if ($tft_limit < 7) {
                                                                    $term = get_term_by('id', $feature, 'apartment_feature');

                                                                    $apartment_f_meta = get_term_meta($feature, 'tf_apartment_feature', true);
                                                                    if (! empty($apartment_f_meta)) {
                                                                        $apartment_icon_type = ! empty($apartment_f_meta['icon-type']) ? $apartment_f_meta['icon-type'] : '';
                                                                    }
                                                                    if (! empty($apartment_icon_type) && $apartment_icon_type == 'fa' && !empty($apartment_f_meta['icon-fa'])) {
                                                                        $apartment_feature_icon = '<i class="' . $apartment_f_meta['icon-fa'] . '"></i>';
                                                                    } elseif (! empty($apartment_icon_type) && $apartment_icon_type == 'c' && ! empty($apartment_f_meta['icon-c'])) {
                                                                        $apartment_feature_icon = '<img src="' . $apartment_f_meta['icon-c'] . '" style="min-width: ' . $apartment_f_meta['dimention'] . 'px; height: ' . $apartment_f_meta['dimention'] . 'px;" />';
                                                                    }
                                                            ?>
                                                                    <li>
                                                                        <?php echo ! empty($apartment_feature_icon) ? wp_kses_post($apartment_feature_icon) : ''; ?>
                                                                        <?php echo esc_html($term->name); ?>
                                                                    </li>
                                                            <?php
                                                                }
                                                                $tft_limit++;
                                                            } ?>
                                                        </ul>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>

                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="tft-btn tft-wh-auto tft-btn_sharp btn-view-details"><?php echo esc_html_e("View details", "travelfic-toolkit"); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="tft-popular-hotels-items tft-popular-hotels-selector tf-widget-featured-post" style="<?php echo "featured" == $tft_posts_tabs ? esc_attr("display: grid") : esc_attr("display: none") ?>">

                    <?php
                    $featured_posts = [];
                    if ($featured_query->have_posts()): ?>
                        <?php while ($featured_query->have_posts()):
                            $featured_query->the_post();
                            if ("tf_hotel" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_hotels_opt');
                                $tf_featured_post = !empty($option_meta['featured']) ? $option_meta['featured'] : '';
                            }
                            if ("tf_tours" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_tours_opt');
                                $tf_featured_post = !empty($option_meta['tour_as_featured']) ? $option_meta['tour_as_featured'] : '';
                            }
                            if ("tf_apartment" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_apartment_opt');
                                $disable_review_sec = !empty($option_meta['disable-apartment-review']) ? $option_meta['disable-apartment-review'] : '';
                            }
                            if ($tf_featured_post) {
                                $featured_posts[] = get_the_ID();
                            }
                        ?>

                        <?php endwhile; ?>
                    <?php endif;
                    $filter_args = array(
                        'post_type'      => $settings['tf_post_type'],
                        'post_status'    => 'publish',
                        'posts_per_page' => $settings['post_items'],
                        'post__in'       => $featured_posts,
                    );
                    $result_query = new WP_Query($filter_args);
                    ?>
                    <?php if ($result_query->have_posts()): ?>
                        <?php while ($result_query->have_posts()):
                            $result_query->the_post(); ?>
                            <?php
                            // Review Query 
                            $args = array(
                                'post_id' => get_the_ID(),
                                'status'  => 'approve',
                                'type'    => 'comment',
                            );
                            $comments_query = new WP_Comment_Query($args);
                            $comments = $comments_query->comments;

                            if ("tf_hotel" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_hotels_opt');
                                $disable_review_sec = !empty($option_meta['h-review']) ? $option_meta['h-review'] : '';
                            }
                            if ("tf_tours" == $settings['tf_post_type']) {
                                $option_meta = travelfic_get_meta(get_the_ID(), 'tf_tours_opt');
                                $disable_review_sec = !empty($option_meta['t-review']) ? $option_meta['t-review'] : '';

                                $tour_duration = ! empty($option_meta['duration']) ? $option_meta['duration'] : '';
                                $duration_time = ! empty($option_meta['duration_time']) ? $option_meta['duration_time'] : '';
                                $night         = ! empty($option_meta['night']) ? $option_meta['night'] : false;
                                $night_count   = ! empty($option_meta['night_count']) ? $option_meta['night_count'] : '';
                            }
                            ?>
                            <div class="tft-popular-single-item">
                                <div class="tft-popular-single-item-inner">
                                    <?php
                                    $tft_hotel_image = !empty(get_the_post_thumbnail_url(get_the_ID())) ? esc_url(get_the_post_thumbnail_url(get_the_ID())) : esc_url(site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png');
                                    ?>
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="tft-popular-thumbnail" style="background-image: url(<?php echo esc_url($tft_hotel_image) ?>);">
                                    </a>
                                    <div class="tft-hotel-details">
                                        <?php if ($comments && !$disable_review_sec == '1') { ?>
                                            <div class="tft-ratings">
                                                <span>
                                                    <i class="fas fa-star"></i>
                                                    <span>
                                                        <?php echo (class_exists("\Tourfic\App\TF_Review")) ? esc_html(\Tourfic\App\TF_Review::tf_total_avg_rating($comments)) : esc_html(tf_total_avg_rating($comments)); ?>
                                                    </span>
                                                    out of <?php class_exists("\Tourfic\App\TF_Review") ? esc_html(\Tourfic\App\TF_Review::tf_based_on_text(count($comments))) : esc_html(tf_based_on_text(count($comments))); ?>
                                                </span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="tft-ratings">
                                                <span>
                                                    <i class="fas fa-star"></i>
                                                    <span>
                                                        0.0
                                                    </span>
                                                    out of 0 review
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <h3 class="tft-title">
                                            <a href="<?php echo  esc_url(get_the_permalink()) ?>">
                                                <?php echo the_title();?>
                                            </a>
                                        </h3>
                                        <p class="tft-locations">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                <g clip-path="url(#clip0_1443_3217)">
                                                    <path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1443_3217">
                                                        <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>
                                                <?php
                                                if ("tf_hotel" == $settings['tf_post_type']) {
                                                    echo !empty(tf_data_types($option_meta['map'])['address']) ? esc_html(travelfic_character_limit(tf_data_types($option_meta['map'])['address'], 40)) : '';
                                                }
                                                if ("tf_tours" == $settings['tf_post_type']) {
                                                    echo !empty(tf_data_types($option_meta['location'])['address']) ? esc_html(travelfic_character_limit(tf_data_types($option_meta['location'])['address'], 40)) : '';
                                                }
                                                if ("tf_apartment" == $settings['tf_post_type']) {
                                                    echo !empty(tf_data_types($option_meta['map'])['address']) ? esc_html(travelfic_character_limit(tf_data_types($option_meta['map'])['address'], 40)) : '';
                                                }
                                                ?>
                                            </span>
                                        </p>

                                        <div class="tf-others-details" style="<?php echo "tf_tours" == $settings['tf_post_type'] ? esc_attr('margin-top: 0px') : ''; ?>">
                                            <?php
                                            if ("tf_tours" == $settings['tf_post_type']) {
                                                if ($tour_duration) {
                                            ?>
                                                    <p class="tour-time">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <path d="M10.0001 2.16406C14.6024 2.16406 18.3334 5.89502 18.3334 10.4974C18.3334 15.0997 14.6024 18.8307 10.0001 18.8307C5.39771 18.8307 1.66675 15.0997 1.66675 10.4974H3.33341C3.33341 14.1793 6.31818 17.1641 10.0001 17.1641C13.682 17.1641 16.6667 14.1793 16.6667 10.4974C16.6667 6.8155 13.682 3.83073 10.0001 3.83073C7.7086 3.83073 5.68714 4.98685 4.48717 6.7476L6.66675 6.7474V8.41406H1.66675V3.41406H3.33341L3.33332 5.49671C4.8537 3.47302 7.27402 2.16406 10.0001 2.16406ZM10.8334 6.33073L10.8332 10.1516L13.5356 12.8544L12.3571 14.0329L9.16658 10.8416L9.16675 6.33073H10.8334Z" fill="#595349" />
                                                        </svg>
                                                        <?php echo esc_html($tour_duration); ?>
                                                        <?php
                                                        if ($tour_duration > 1) {
                                                            $dur_string         = 's';
                                                            $duration_time_html = $duration_time . $dur_string;
                                                        } else {
                                                            $duration_time_html = $duration_time;
                                                        }
                                                        echo " " . esc_html($duration_time_html);
                                                        ?>
                                                        <?php if ($night) { ?>
                                                            <span>
                                                                <?php echo esc_html($night_count); ?>
                                                                <?php
                                                                if (! empty($night_count)) {
                                                                    if ($night_count > 1) {
                                                                        echo esc_html__('Nights', 'travelfic-toolkit');
                                                                    } else {
                                                                        echo esc_html__('Night', 'travelfic-toolkit');
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        <?php } ?>
                                                    </p>
                                            <?php }
                                            } ?>
                                            <?php
                                            if ("tf_hotel" == $settings['tf_post_type']) {
                                                $rooms = !empty($option_meta['room']) ? $option_meta['room'] : '';
                                                if (!empty($rooms)) {
                                                    $rm_features = [];
                                                    foreach ($rooms as $key => $room) {
                                                        //merge for each room's selected features
                                                        if (!empty($room['features'])) {
                                                            $rm_features = array_unique(array_merge($rm_features, $room['features']));
                                                        }
                                                    }
                                                    if (!empty($rm_features)) { ?>
                                                        <ul>
                                                            <?php
                                                            $tft_limit = 1;
                                                            foreach ($rm_features as $feature) {
                                                                if ($tft_limit < 7) {
                                                                    $term = get_term_by('id', $feature, 'hotel_feature');
                                                                    $room_f_meta = get_term_meta($feature, 'tf_hotel_feature', true);
                                                                    if (! empty($room_f_meta)) {
                                                                        $room_icon_type = ! empty($room_f_meta['icon-type']) ? $room_f_meta['icon-type'] : '';
                                                                    }
                                                                    if (! empty($room_icon_type) && $room_icon_type == 'fa' && !empty($room_f_meta['icon-fa'])) {
                                                                        $room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
                                                                    } elseif (! empty($room_icon_type) && $room_icon_type == 'c' && ! empty($room_f_meta['icon-c'])) {
                                                                        $room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
                                                                    }
                                                            ?>
                                                                    <li>
                                                                        <?php echo ! empty($room_feature_icon) ? wp_kses_post($room_feature_icon) : ''; ?>
                                                                        <?php if(!empty($term->name)): ?>
                                                                            <?php echo esc_html($term->name); ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                            <?php
                                                                }
                                                                $tft_limit++;
                                                            } ?>
                                                        </ul>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <a class="btn-view-details" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html_e("View details", "travelfic-toolkit"); ?></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <script>
                    (function($) {
                        $(document).ready(function() {
                            $('body').on('click', '.tft-popular-hotel-header ul li', function() {
                                let $this = $(this).closest('.tft-popular-hotels-design__one');
                                let tab_type = $(this).attr('data-id');
                                $this.find('.tft-hotel-header ul li').each(function() {
                                    $(this).children('button').removeClass('active').addClass('tft-btn_gray');
                                })
                                $(this).children('button').addClass('active').removeClass('tft-btn_gray');
                                $this.find('.tft-popular-hotels-items').hide();
                                $this.find('.tf-widget-' + tab_type + '-post').css('display', 'grid');
                            });
                        });
                    }(jQuery));
                </script>

            </div>
        <?php endif;
        if ('design-2' == $tft_design): ?>
            <div class="tft-popular-hotels-design__two tft-customizer-typography tft-section-space-bottom" style="background-image: url(<?php echo !empty($tft_posts_sec_bg['url']) ? esc_url($tft_posts_sec_bg['url']) : ''; ?>);">
                <div class="container<?php echo esc_attr($container_max_width); ?>">
                    <!-- heading content -->
                    <div class="tft-heading-content">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }
                        if (!empty($tft_sec_title)) { ?>
                            <h2 class="tft-section-title tft-title-shape <?php echo esc_attr($section_title_backdrop); ?>"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="tft-destination-content">
                        <div class="tft-destination-slider <?php echo esc_attr($tftDisableClass . $slider_box_hidden); ?>">
                            <?php if ($query->have_posts()): ?>
                                <?php while ($query->have_posts()):
                                    $query->the_post();

                                    $post_id = get_the_ID();

                                    // Review Query 
                                    $tf_comments = get_comments(array('post_id' => $post_id, 'status' => 'approve'));
                                    $tf_average_rating = 0;

                                    if ($tf_comments) {
                                        $tf_comments_meta = get_comment_meta($tf_comments[0]->comment_ID, 'tf_comment_meta', true);
                                        if (!empty($tf_comments_meta) && is_array($tf_comments_meta)) {
                                            $tf_total_rating = array_sum($tf_comments_meta);
                                            $tf_category_count = count($tf_comments_meta);
                                            $tf_average_rating = $tf_category_count > 0 ? $tf_total_rating / $tf_category_count : 0;
                                        }
                                    }

                                    $tf_total_price = 0;
                                    // get average rating
                                    $comments_query = new WP_Comment_Query($args);
                                    $comments = $comments_query->comments;

                                    if ("tf_hotel" == $settings['tf_post_type']) {
                                        $option_meta = travelfic_get_meta(get_the_ID(), 'tf_hotels_opt');
                                        $disable_review_sec = !empty($option_meta['h-review']) ? $option_meta['h-review'] : '';

                                        $min_price_arr = Hotel_Price::instance($post_id)->get_min_price();


                                        $tf_total_price = $min_price_arr['min_sale_price'] ? $min_price_arr['min_sale_price'] : $min_price_arr['min_regular_price'];

                                        // // featured
                                        $tf_featured = isset($option_meta['featured']) ? $option_meta['featured'] : false;
                                        $tf_featured_text = !empty($option_meta['featured_text']) ? $option_meta['featured_text'] : 'Featured';

                                        // // location
                                        if (is_array($option_meta) && isset($option_meta['map'])) {
                                            $tf_location = maybe_unserialize($option_meta['map'])['address'] ?? '';
                                        } else {
                                            $tf_location = '';
                                        }
                                    }
                                    if ("tf_tours" == $settings['tf_post_type']) {
                                        $option_meta = travelfic_get_meta(get_the_ID(), 'tf_tours_opt');
                                        $disable_review_sec = !empty($option_meta['t-review']) ? $option_meta['t-review'] : '';

                                        // featured
                                        $tf_featured = isset($option_meta['tour_as_featured']) ? $option_meta['tour_as_featured'] : '';;
                                        $tf_featured_text = !empty($option_meta['featured_text']) ? $option_meta['featured_text'] : 'Featured';

                                        // pricing
                                        $tf_pricing = !empty($option_meta['pricing']) ? $option_meta['pricing'] : '';


                                        if ($tf_pricing === 'group') {
                                            $tf_total_price = $option_meta['group_price'] ?? 0;
                                        } else {
                                            $tf_adult_price = $option_meta['adult_price'] ?? 0;
                                            $tf_child_price = $option_meta['child_price'] ?? 0;
                                            $tf_total_price = min($tf_adult_price, $tf_child_price);
                                        }

                                        // location
                                        if (is_array($option_meta) && isset($option_meta['location'])) {
                                            $tf_location = maybe_unserialize($option_meta['location'])['address'] ?? '';
                                        } else {
                                            $tf_location = '';
                                        }
                                    }
                                    if ("tf_apartment" == $settings['tf_post_type']) {
                                        $option_meta = travelfic_get_meta(get_the_ID(), 'tf_apartment_opt');
                                        $disable_review_sec = !empty($option_meta['disable-apartment-review']) ? $option_meta['disable-apartment-review'] : '';

                                        // featured
                                        $tf_featured = isset($option_meta['apartment_as_featured']) ? $option_meta['apartment_as_featured'] : '';;
                                        $tf_featured_text = !empty($option_meta['featured_text']) ? $option_meta['featured_text'] : 'Featured';

                                        // pricing
                                        $tf_pricing = $option_meta['pricing_type'];

                                        if ($tf_pricing === 'per_night') {
                                            $tf_total_price = $option_meta['price_per_night'] ?? 0;
                                        } else {
                                            $tf_adult_price = $option_meta['adult_price'] ?? 0;
                                            $tf_child_price = $option_meta['child_price'] ?? 0;
                                            $tf_total_price = min($tf_adult_price, $tf_child_price);
                                        }

                                        // location
                                        if (is_array($option_meta) && isset($option_meta['map'])) {
                                            $tf_location = maybe_unserialize($option_meta['map'])['address'] ?? '';
                                        } else {
                                            $tf_location = '';
                                        }
                                    }

                                ?>
                                    <!-- single destination -->
                                    <div class="tft-single-destination">
                                        <!-- destination thumbnail -->
                                        <div class="tft-destination-thumbnail">
                                            <?php
                                            $tft_hotel_image = !empty(get_the_post_thumbnail_url(get_the_ID())) ? esc_url(get_the_post_thumbnail_url(get_the_ID())) : esc_url(site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png');
                                            ?>
                                            <img src="<?php echo esc_url($tft_hotel_image); ?>" alt="post thumbnail">
                                            <div class="tft-destination-featured">
                                                <?php echo $tf_featured ? '<span class="tft-featured">' . esc_html($tf_featured_text) . '</span>' : ''; ?>
                                            </div>
                                        </div>
                                        <!-- destination content -->
                                        <div class="tft-destination-content">
                                            <!-- destination top info -->
                                            <div class="tft-destination-top-info">
                                                <!-- destination rating -->
                                                <?php echo tf_review_star_rating((float) $tf_average_rating);  ?>
                                                <!-- destination location -->
                                                <?php if(!empty($tf_location)): ?>
                                                    <span class="tft-destination-location">
                                                        <i class="ri-map-pin-line tft-color-primary"></i>
                                                        <span class="tft-color-text"><?php echo esc_html($tf_location); ?></span>
                                                    </span> 
                                                <?php endif; ?>
                                                <!-- destination title -->
                                                <h2 class="tft-destination-title">
                                                    <a href="<?php echo esc_url(get_the_permalink()) ?>" class="tft-color-hover-primary">
                                                        <?php
                                                        if ("Split" == $settings['card_title_type']) {
                                                            echo esc_html(travelfic_character_limit(get_the_title(), 40));
                                                        } else {
                                                            the_title();
                                                        }
                                                        ?>
                                                    </a>
                                                </h2>
                                            </div>

                                            <!-- destination bottom info -->
                                            <div class="tft-destination-bottom-info">
                                                <!-- destination price -->
                                                <div class="tft-destination-price">
                                                    <span class="tft-destination-price-title tft-color-text">
                                                        <?php 
                                                            if ( function_exists( 'wc_price' ) ) {
                                                                $currency_code   = get_woocommerce_currency(); 
                                                                echo sprintf( esc_html__( 'From %s', 'travelfic-toolkit' ), $currency_code );
                                                            } else {
                                                                echo esc_html__( 'From USD', 'travelfic-toolkit' );
                                                            }
                                                        ?>
                                                    </span>
                                                    <span class="tft-destination-price-value tft-color-primary">
                                                        <?php if ( function_exists( 'wc_price' ) ) {
                                                                echo wc_price( $tf_total_price );
                                                            } else {
                                                                echo '$' . number_format( $tf_total_price, 2 );
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                                <!-- destination button -->
                                                <div class="tft-destination-btn">
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tft-btn tft-btn_gray">
                                                        <?php echo esc_html__('Explore', 'travelfic-toolkit'); ?>
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endwhile;
                            endif; ?>
                        </div>
                        <!-- destination slider navigation -->
                        <?php if ($tftSliderDisable == false && 'true' === $design2_slider_arrows): ?>
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

                </div>
                <script>
                    // Destination Slider
                    (function($) {
                        $(document).ready(function() {
                            //Your Code Inside
                            $('.tft-popular-hotels-design__two .tft-destination-slider').slick({
                                slidesToShow: <?php echo esc_attr($slideToShow); ?>,
                                slidesToScroll: <?php echo esc_attr($design2_slide_to_scroll); ?>,
                                infinite: <?php echo esc_attr($design2_slider_loop); ?>,
                                autoplay: <?php echo esc_attr($design2_slider_autoplay); ?>,
                                autoplaySpeed: <?php echo esc_attr($design2_slider_autoplay_speed); ?>,
                                speed: <?php echo esc_attr($design2_slider_autoplay_interval); ?>,
                                dots: <?php echo esc_attr($design2_slider_dots); ?>,
                                arrows: <?php echo esc_attr($design2_slider_arrows); ?>,
                                pauseOnHover: <?php echo esc_attr($design2_slider_pause_on_hover); ?>,
                                pauseOnFocus: <?php echo esc_attr($design2_slider_pause_on_focus); ?>,
                                rtl: <?php echo esc_attr($design2_slider_rtl); ?>,
                                draggable: <?php echo esc_attr($design2_slider_draggable); ?>,
                                cssEase: 'linear',
                                prevArrow: '.tft-popular-hotels-design__two .tft-prev-slide',
                                nextArrow: '.tft-popular-hotels-design__two .tft-next-slide',
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
