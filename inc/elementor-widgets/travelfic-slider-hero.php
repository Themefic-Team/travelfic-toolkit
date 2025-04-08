<?php
class Travelfic_Toolkit_SliderHero extends \Elementor\Widget_Base

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
        return 'tft-slider-hero';
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
        return esc_html__('Travelfic Slider Hero', 'travelfic-toolkit');
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
        return 'eicon-slider-device';
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
        return ['travelfic', 'slider', 'hero', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-slider-hero'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    public function tf_search_types()
    {
        $types = array(
            'all'   => __('All', 'travelfic-toolkit'),
            'hotel' => __('Hotel', 'travelfic-toolkit'),
            'tour'  => __('Tour', 'travelfic-toolkit'),
            'apartment'  => __('Apartment', 'travelfic-toolkit'),
            'carrentals'  => __('Car', 'travelfic-toolkit'),
        );

        if (function_exists('is_tf_pro') && is_tf_pro()) {
            $types['booking'] = __('Booking.com', 'travelfic-toolkit');
            $types['tp-flight'] = __('TravelPayouts Flight', 'travelfic-toolkit');
            $types['tp-hotel'] = __('TravelPayouts Hotel', 'travelfic-toolkit');
        }

        return $types;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'hero_slider',
            [
                'label' => __('Slider Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slider_style',
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

        $this->add_control(
            'banner_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Banner Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Banner title', 'travelfic-toolkit'),
                'default' => __('Embark on extraordinary voyages and explorations', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-2', 'design-3'], // Show this control only when des_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'banner_image',
            [
                'label'   => __('Banner Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'slider_style' => ['design-2', 'design-3', 'design-4'], // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        // Design-1 Repeater
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'slider_image',
            [
                'label'   => __('Slider Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'slider_title',
            [
                'label'       => __('Slider Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('It is Time To Explore The World', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_subtitle',
            [
                'label'       => __('Slider Subtitle', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('A There are many variatio of passage of Lorem for a Ipsum available  Lorem for a Ipsum available dummy lorem text.', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_bttn_txt',
            [
                'label'       => __('Slider Text', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Explore Now', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_bttn_url',
            [
                'label'       => __('Button URL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => [
                    'url' => '#',
                ],
                'label_block' => true,
                'dynamic'     => ['active' => true],

            ]
        );

        $this->add_control(
            'hero_slider_list',
            [
                'label'       => __('Repeater List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ slider_title }}}',
                'condition'   => [
                    'slider_style' => ['design-1'],
                ],
            ]
        );

        // Design-4 Repeater
        $design4_repeater = new \Elementor\Repeater();
        $design4_repeater->add_control(
            'design4_slider_title',
            [
                'label'       => __('Slider Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Discover The World', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $design4_repeater->add_control(
            'design4_slider_subtitle',
            [
                'label'       => __('Slider Subtitle', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Experience Central Park via Air Trips', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $design4_repeater->add_control(
            'design4_slider_bttn_txt',
            [
                'label'       => __('Slider Text', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Explore Now', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $design4_repeater->add_control(
            'design4_slider_bttn_url',
            [
                'label'       => __('Button URL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => [
                    'url' => '#',
                ],
                'label_block' => true,
                'dynamic'     => ['active' => true],

            ]
        );

        $this->add_control(
            'design4_hero_slider_list',
            [
                'label'       => __('Repeater List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $design4_repeater->get_controls(),
                'title_field' => '{{{ design4_slider_title }}}',
                'condition'   => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );


        $this->end_controls_section();

        // social content section
        $this->start_controls_section(
            'social_content_section',
            [
                'label' => __('Hero Social Content', 'themefic_themedev'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );

        $this->add_control(
            'social_media_switcher',
            [
                'label'       => __('Enable Social Sharing?', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => __('Turn On to active the social media icons', 'travelfic-toolkit'),
                'default'     => 'yes',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        // social media repeater
        $social_repeater = new \Elementor\Repeater();
        $social_repeater->add_control(
            'social_media_label',
            [
                'label'       => __('Social Media Label', 'themefic_themedev'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'facebook' => __('Facebook', 'themefic_themedev'),
                    'twitter'  => __('Twitter', 'themefic_themedev'),
                    'linkedin'  => __('Linkedin', 'themefic_themedev'),
                    'instagram'  => __('Instagram', 'themefic_themedev'),
                ],
                'default'     => 'facebook',
                'label_block' => true,
            ]
        );
        $social_repeater->add_control(
            'social_media_url',
            [
                'label'       => __('Social Media URL', 'themefic_themedev'),
                'type'        => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'dynamic'     => ['active' => true],
                'default'     => [
                    'url' => '#',
                ],
            ]
        );
        $this->add_control(
            'social_media_list',
            [
                'label'   => __('Social Media List', 'themefic_themedev'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $social_repeater->get_controls(),
                'default' => [
                    [
                        'social_media_label' => 'facebook',
                    ],
                    [
                        'social_media_label' => 'twitter',
                    ],
                    [
                        'social_media_label' => 'linkedin',
                    ],
                    [
                        'social_media_label' => 'instagram',
                    ],

                ],
                'title_field' => '{{{ social_media_label }}}',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'social_share_label',
            [
                'label'       => __('Social Box Label', 'themefic_themedev'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => ['active' => true],
                'default'     => __('Share', 'themefic_themedev'),
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tf_serach_box',
            [
                'label' => __('Search Box', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'search_box_switcher',
            [
                'label'       => __('Enable Search Box?', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => __('Turn On to active the Searchbox', 'travelfic-toolkit'),
                'default'     => 'yes',
            ]
        );

        $this->add_control(
            'type',
            [
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'label'    => __('Type', 'travelfic-toolkit'),
                'multiple' => true,
                'options'  => $this->tf_search_types(),
                'default'  => ['all'],
            ]
        );
        $this->add_control(
            'hotel_tab_title',
            [
                'type'     => \Elementor\Controls_Manager::TEXT,
                'label'    => __('Hotel Tab Title', 'travelfic-toolkit'),
                'multiple' => true,
                'default'  => __('Hotel', 'travelfic-toolkit'),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'all',
                        ],
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'hotel',
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => [],
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => '',
                        ],
                    ],
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tour_tab_title',
            [
                'type'     => \Elementor\Controls_Manager::TEXT,
                'label'    => __('Tour Tab Title', 'travelfic-toolkit'),
                'multiple' => true,
                'default'  => __('Tour', 'travelfic-toolkit'),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'all',
                        ],
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'tour',
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => [],
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => '',
                        ],
                    ],
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'apt_tab_title',
            [
                'type'     => \Elementor\Controls_Manager::TEXT,
                'label'    => __('Apartment Tab Title', 'travelfic-toolkit'),
                'multiple' => true,
                'default'  => __('Apartment', 'travelfic-toolkit'),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'all',
                        ],
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'apartment',
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => [],
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => '',
                        ],
                    ],
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'car_tab_title',
            [
                'type'     => \Elementor\Controls_Manager::TEXT,
                'label'    => __('Car Tab Title', 'travelfic-toolkit'),
                'multiple' => true,
                'default'  => __('Car', 'travelfic-toolkit'),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'all',
                        ],
                        [
                            'name' => 'type',
                            'operator' => 'contains',
                            'value' => 'carrentals',
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => [],
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => '',
                        ],
                    ],
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Control', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => esc_html__('Slider Height(px)', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 800, // Your default value here
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-slider-bg-img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tft-hero-design-2' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-2'], // Show this control only when des_style is 'design-2'
                ],

            ]
        );
        $this->add_responsive_control(
            'design-3-slider_height',
            [
                'label' => esc_html__('Slider Height(px)', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 540, // Your default value here
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-3' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-3', // Show this control only when des_style is 'design-2'
                ],

            ]
        );
        $this->add_responsive_control(
            'design4_slider_height',
            [
                'label' => esc_html__('Slider Height(px)', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 800, // Your default value here
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-4', // Show this control only when des_style is 'design-4'
                ],

            ]
        );
        $this->add_control(
            'design4_slider_navigation',
            [
                'label'       => __('Navigation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'dots',
                'options'     => [
                    'none' => __('None', 'travelfic-toolkit'),
                    'dots' => __('Dots', 'travelfic-toolkit'),
                    'arrows' => __('Arrows', 'travelfic-toolkit'),
                ],
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_autoplay',
            [
                'label'       => __('Autoplay', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_autoplay_speed',
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
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_autoplay_interval',
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
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_loop',
            [
                'label' => esc_html__('Loop', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_animation',
            [
                'label' => esc_html__('Animation', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );


        $this->add_control(
            'design4_slider_pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_pause_on_focus',
            [
                'label' => esc_html__('Pause On Focus', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_rtl',
            [
                'label' => esc_html__('RTL', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'no',
                'condition'   => [
                    'slider_style' => 'design-4',
                    'design4_slider_loop!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'design4_slider_draggable',
            [
                'label' => esc_html__('Draggable', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'hero_style_section',
            [
                'label' => __('Slider', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'banner_bg_color',
            [
                'label' => __('Background', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1D1D1D94',
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-slider-selector .tft-hero-single-item::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-2', 'design-3'],
                ],
            ]
        );
        $this->add_control(
            'design-4_banner_bg_color',
            [
                'label' => __('Background', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'linear-gradient(180deg, rgba(14, 61, 216, 0.8) 5.87%, rgba(0, 57, 204, 0.03) 125.37%)',
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-slider-selector .tft-hero-single-item::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => 'design-4', // Show this control only when des_style is 'design-2'
                ],
            ]
        );
        $this->add_responsive_control(
            'banner_inner_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-hero-design-2 .tft-hero-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'slider_title',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'slider_title_spacing',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-hero-content h1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-slider-title .tft-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_title',
                'selector' => '{{WRAPPER}} .tft-slider-title .tft-title',
                'label'    => __('Title Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-1'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'banner_title',
                'selector' => '{{WRAPPER}} .tft-hero-content h1',
                'label'    => __('Title Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'hero_slider_title',
                'selector' => '{{WRAPPER}} .tft-hero-design-3 .tft-hero-content-box h1, {{WRAPPER}} .tft-hero-design-4__slider__item__content--title',
                'label'    => __('Title Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-3', 'design-4'],
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-slider-title .tft-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-design-2 .tft-hero-content h1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-design-3 .tft-hero-content-box h1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-design-4 .tft-hero-design-4__slider__item__content--title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-content .tf-booking-form-tab button.active' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'shortcode_form_style',
            [
                'label'     => __('Form Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-2', 'design-3'], // Show this control only when des_style is 'design-2'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'shortcode_form_typo',
                'selector' => '{{WRAPPER}} .tft-search-form, {{WRAPPER}} .tft-search-form button, {{WRAPPER}} .tft-search-form input',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ]
            ]
        );

        $this->add_control(
            'shortcode_form_background',
            [
                'label'     => __('Form Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(48, 40, 28, 0.3)',
                'selectors' => [
                    '{{WRAPPER}} .tf_booking-widget-design-2' => 'background: {{VALUE}}'
                ],
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'shortcode_form_button',
            [
                'label'     => __('Button Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tf_booking-widget-design-2 .tf_hotel_searching .tf_form_innerbody .tf_availability_checker_box button' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-content .tf-booking-form-tab button.active' => 'background: {{VALUE}} !important',
                ],
                'condition' => [
                    'slider_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        // Design 3
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'design_3_shortcode_form_typo',
                'selector' => '{{WRAPPER}} .tf-date-single-select, {{WRAPPER}} .tf-submit-button button, {{WRAPPER}} .tf-date-single-select input, .tf-date-single-select h5',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => 'design-3',
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes']
                ]
            ]
        );

        $this->add_control(
            'design_3_shortcode_form_background',
            [
                'label'     => __('Form Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#e6f2fe',
                'selectors' => [
                    '{{WRAPPER}} .tf-archive-search-box-wrapper' => 'background: {{VALUE}}'
                ],
                'condition' => [
                    'slider_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'design_3_shortcode_form_button',
            [
                'label'     => __('Button Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#0866c4',
                'selectors' => [
                    '{{WRAPPER}} .tf-archive-search-box-wrapper .tf-driver-location-box .tf-submit-button button' => 'background: {{VALUE}}'
                ],
                'condition' => [
                    'slider_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'slider_subtitle',
            [
                'label'     => __('Sub title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_sub_title',
                'selectors' => [
                    '{{WRAPPER}} .tft-sub-title p',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--subtitle',
                ],
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Subtitle Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-sub-title p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        //Buttons
        $this->add_control(
            'slider_buttons_style',
            [
                'label'     => __('Button Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-button .bttn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-button .bttn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs_');

        $this->start_controls_tab(
            'button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Text Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'label'     => __('Background Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'], // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => __('Text Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'], // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label'     => __('Background Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .bttn:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .tft-hero-design-4__slider__item__content--link:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'], // Show this control only when des_style is 'design-1'
                ],
            ]
        );


        $this->end_controls_tab();

        // navigations
        $this->add_control(
            'slider_nav_style',
            [
                'label'     => __('Navigation ', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_nav',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-slider-selector button.slick-arrow' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tft-hero-slider-selector .slider__counter'   => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tft-hero-design-4 .slick-dots li button'   => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tft-hero-design-4 .slick-dots li.slick-active'   => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'], // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_section();
        $this->end_controls_tabs();

        // slider social style
        $this->start_controls_section(
            'slider_social_style',
            [
                'label'     => __('Social', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->add_control(
            'slider_social_label_head',
            [
                'label'     => __('Label', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_social_label_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__label'   => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->add_control(
            'slider_social_icon_head',
            [
                'label'     => __('Icon', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->start_controls_tabs('social_icon_tabs_');

        $this->start_controls_tab(
            'social_icon_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->add_control(
            'slider_social_icon_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__list__item--link i'   => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_social_icon_back',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__list__item--link'   => 'background: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_social_icon_border',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__list__item--link'   => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'social_icon_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->add_control(
            'slider_social_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__list__item--link:hover i'   => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_social_hover_back',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__list__item--link:hover'   => 'background: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_social_hover_border',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-hero-design-4__social__list__item--link:hover'   => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'slider_serach_style',
            [
                'label' => __('Search Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'search_box',
            [
                'label'     => __('Search Box', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_responsive_control(
            'search_box_padding',
            [
                'label' => __('Padding', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 40,
                    'right' => 40,
                    'bottom' => 40,
                    'left' => 40,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tft-search-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_box_border_radius',
            [
                'label' => __('Border Radius', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_tab',
            [
                'label'     => __('Search Tab', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_search_tab',
                'label'    => __('Search Typography', 'travelfic-toolkit'),
                'selector' => '{{WRAPPER}} .tf-booking-form-tab button',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_color',
            [
                'label'     => __('Tab Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_background',
            [
                'label'     => __('Tab Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks' => 'background: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'slider_search_tab_color_active',
            [
                'label'     => __('Active Tab Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'slider_style' => 'design-1',
                ],
            ],
        );
        $this->add_control(
            'slider_search_tab_background_active',
            [
                'label'     => __('Active Tab background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} button.tf-tablinks.active' => 'background: {{VALUE}} !important',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_tab_border_width',
            [
                'label' => __('Border Width', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tf-booking-form-tab button.tf-tablinks' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_tab_border_color',
            [
                'label'     => __('Tab Border Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .tf-booking-form-tab button.tf-tablinks' => 'border-color: {{VALUE}} !important',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_tab_border_radius',
            [
                'label' => __('Border Radius', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tf-booking-form-tab button.tf-tablinks' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_search_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tf-booking-form-tab button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'slider_search_input',
            [
                'label'     => __('Search Form', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_border_width',
            [
                'label' => __('Border Width', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_homepage-booking' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_border_color',
            [
                'label'     => __('Border Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D3040',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_homepage-booking' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_form_border_radius',
            [
                'label' => __('Border Radius', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_homepage-booking' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_search_input_style',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '{{WRAPPER}} .tft-search-box .tf_input-inner div, .tf_homepage-booking input, .tf_homepage-booking ::placeholder, .tft-search-box .tf_input-inner',
                'condition' => [
                    'slider_style' => 'design-1',
                ]
            ]
        );
        $this->add_control(
            'slider_search_input_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_input-inner div' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tft-search-box .tf_input-inner' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tf_homepage-booking ::placeholder' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'slider_button',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_search_button',
                'label'    => __('Search Button Typo', 'travelfic-toolkit'),
                'selector' => '{{WRAPPER}} .tft-search-box .tf_button',
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_border_width',
            [
                'label' => __('Border Width', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_border_color',
            [
                'label' => __('Border Color', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_border_radius',
            [
                'label' => __('Border Radius', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->start_controls_tabs('button_search_button');

        // Normal state tab
        $this->start_controls_tab(
            'search_button_normal',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'search_button_text_color',
            [
                'label'     => __('Button Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'slider_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'search_button_background_color',
            [
                'label'     => __('Button Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'search_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'search_button_hover_color',
            [
                'label'     => __('Button Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );

        $this->add_control(
            'search_button_background_hover_color',
            [
                'label'     => __('Button Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#D83B0B',
                'selectors' => [
                    '{{WRAPPER}} .tft-search-box .tf_button:hover' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'slider_style' => 'design-1', // Show this control only when des_style is 'design-1'
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
        $type_arr = !is_array($settings['type']) ? array($settings['type']) : $settings['type'];
        $type = $settings['type'] ? implode(',', $type_arr) : implode(',', ['all']);

        // Design
        if (!empty($settings['slider_style'])) {
            $tft_design = $settings['slider_style'];
        }
        if (!empty($settings['banner_title'])) {
            $tft_banner_title = $settings['banner_title'];
        }
        if (!empty($settings['banner_image'])) {
            $tft_banner_image = $settings['banner_image'];
        }

        $tour_tab_title = !empty($settings['tour_tab_title']) ? 'tour_tab_title="' . $settings['tour_tab_title'] . '" ' : '';
        $hotel_tab_title = !empty($settings['hotel_tab_title']) ? 'hotel_tab_title="' . $settings['hotel_tab_title'] . '" ' : '';
        $apt_tab_title = !empty($settings['apt_tab_title']) ? 'apartment_tab_title="' . $settings['apt_tab_title'] . '" ' : '';
        $car_tab_title = !empty($settings['car_tab_title']) ? 'car_tab_title="' . $settings['car_tab_title'] . '" ' : '';

        $social_media_switcher = !empty($settings['social_media_switcher']) ? $settings['social_media_switcher'] : false;
        // slider control settings check

        $design4_slider_nav = $settings['design4_slider_navigation'];

        $design4_slider_arrows = ("arrows" === $design4_slider_nav) ? 'true' : 'false';
        $design4_slider_dots = ("dots" === $design4_slider_nav) ? 'true' : 'false';
        $design4_slider_autoplay = ('yes' === $settings['design4_slider_autoplay']) ? 'true' : 'false';
        $design4_slider_autoplay_speed = !empty($settings['design4_slider_autoplay_speed']) ? absint($settings['design4_slider_autoplay_speed']['size']) : 0;
        $design4_slider_autoplay_interval = !empty($settings['design4_slider_autoplay_interval']) ? absint($settings['design4_slider_autoplay_interval']['size']) : 0;
        $design4_slider_loop = ('yes' === $settings['design4_slider_loop']) ? 'true' : 'false';
        $design4_slider_animation = ('yes' === $settings['design4_slider_animation']) ? 'true' : 'false';
        $design4_slider_pause_on_hover = ('yes' === $settings['design4_slider_pause_on_hover']) ? 'true' : 'false';
        $design4_slider_pause_on_focus = ('yes' === $settings['design4_slider_pause_on_focus']) ? 'true' : 'false';
        $design4_slider_rtl = ('yes' === $settings['design4_slider_rtl']) ? 'true' : 'false';
        $design4_slider_draggable = ('yes' === $settings['design4_slider_draggable']) ? 'true' : 'false';


        if ("design-2" == $tft_design) {
?>
            <div class="tft-hero-design-2" style="background-image: url(<?php echo esc_url($tft_banner_image['url']); ?>);">
                <div class="tft-hero-content">
                    <?php
                    if (!empty($tft_banner_title)) { ?>
                        <h1><?php echo wp_kses_post($tft_banner_title); ?></h1>
                    <?php } ?>
                    <?php if ($settings['search_box_switcher'] == 'yes') { ?>
                        <div class="tft-search-form">
                            <?php echo do_shortcode('[tf_search_form  type="' . $type . '" ' . $tour_tab_title . $apt_tab_title . $hotel_tab_title . $car_tab_title . 'design="2"]'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } elseif ("design-3" == $tft_design) { ?>
            <div class="tft-hero-design-3" style="background-image: url(<?php echo esc_url($tft_banner_image['url']); ?>);">
                <div class="tft-hero-content-box">
                    <?php
                    if (!empty($tft_banner_title)) { ?>
                        <h1><?php echo wp_kses_post($tft_banner_title); ?></h1>
                    <?php } ?>

                    <?php if ($settings['search_box_switcher'] == 'yes') { ?>
                        <div class="tft-search-form">
                            <?php echo do_shortcode('[tf_search_form  type="' . $type . '" ' . $tour_tab_title . $apt_tab_title . $hotel_tab_title . $car_tab_title . 'design="3"]'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } elseif ("design-4" == $tft_design) { ?>
            <section class="tft-hero-design-4" style="background-image: url(<?php echo esc_url($settings['banner_image']['url']); ?>);">
                <div class="container tft-hero-design-4__container">
                    <!-- hero banner slider -->
                    <div class="tft-hero-design-4__slider">
                        <?php foreach ($settings['design4_hero_slider_list'] as $slider):
                            $target_blank = $slider['design4_slider_bttn_url']['is_external'] ? 'target="_blank"' : '';
                        ?>
                            <!-- slider item -->
                            <div class="tft-hero-design-4__slider__item">
                                <div class="tft-hero-design-4__slider__item__content">
                                    <!-- slider subtitle -->
                                    <?php if (!empty($slider['design4_slider_subtitle'])) : ?>
                                        <h2 class="tft-hero-design-4__slider__item__content--subtitle">
                                            <?php echo esc_html($slider['design4_slider_subtitle']); ?>
                                        </h2>
                                    <?php endif; ?>

                                    <!-- slider title -->
                                    <?php if (!empty($slider['design4_slider_title'])): ?>
                                        <h1 class="tft-hero-design-4__slider__item__content--title">
                                            <?php echo esc_html($slider['design4_slider_title']); ?>
                                        </h1>
                                    <?php endif; ?>
                                    <!-- slider button -->
                                    <?php if (!empty($slider['design4_slider_bttn_txt'])) : ?>
                                        <a href="<?php echo esc_url($slider['design4_slider_bttn_url']['url']); ?>"
                                            class="tft-hero-design-4__slider__item__content--link tft-btn"
                                            <?php echo esc_attr($target_blank); ?>>
                                            <?php echo esc_html($slider['design4_slider_bttn_txt']); ?>
                                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ('true' === $design4_slider_arrows): ?>
                        <div class="tft-hero-slider-nav">
                            <button type="button" class="tft-prev-slide">
                                <i class="ri-arrow-left-line"></i>
                            </button>
                            <button type="button" class="tft-next-slide">
                                <i class="ri-arrow-right-line"></i>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- hero banner social -->
                    <?php if ($social_media_switcher): ?>
                        <div class="tft-hero-design-4__social">
                            <!-- List of social media items -->
                            <ul class="tft-hero-design-4__social__list">
                                <?php foreach ($settings['social_media_list'] as $social):
                                    $target_blank = $social['social_media_url']['is_external'] ? 'target="_blank"' : '';
                                    $social_media_name = isset($social['social_media_label']) ? $social['social_media_label'] : '';
                                ?>
                                    <!-- social media item-->
                                    <li class="tft-hero-design-4__social__list__item">
                                        <a href="<?php echo esc_url($social['social_media_url']['url']); ?>"
                                            class="tft-hero-design-4__social__list__item--link"
                                            <?php echo esc_attr($target_blank); ?>
                                            aria-label="<?php echo esc_attr('Visit ' . $social_media_name . ' page'); ?>">
                                            <span class="tft-hero-design-4__social-icon">
                                                <?php

                                                $social_icon = '';
                                                switch ($social_media_name) {
                                                    case 'facebook':
                                                        $social_icon = 'fa-facebook-f';
                                                        break;
                                                    case 'twitter':
                                                        $social_icon = 'fa-x-twitter';
                                                        break;
                                                    case 'linkedin':
                                                        $social_icon = 'fa-linkedin-in';
                                                        break;
                                                    case 'instagram':
                                                        $social_icon = 'fa-instagram';
                                                        break;
                                                }
                                                ?>
                                                <i class="fa-brands <?php echo esc_attr($social_icon); ?>" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <div class="tft-hero-design-4__social__divider"></div>
                            <!-- social share label -->
                            <?php if (!empty($settings['social_share_label'])): ?>
                                <h4 class="tft-hero-design-4__social__label">
                                    <?php echo esc_html($settings['social_share_label']); ?>
                                </h4>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="tft-hero-design-4__mobile--share">
                        <!-- social share label -->
                        <?php if (!empty($settings['social_share_label'])): ?>
                            <h4 class="tft-hero-design-4__social__label">
                                <?php echo esc_html($settings['social_share_label']); ?>
                            </h4>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php if ($settings['search_box_switcher'] == 'yes') { ?>
                <div class="tft-search-form">
                    <?php echo do_shortcode('[tf_search_form  type="' . $type . '" ' . $tour_tab_title . $apt_tab_title . $hotel_tab_title . $car_tab_title . 'design="4"]'); ?>
                </div>
            <?php } ?>
            <script>
                (function($) {
                    "use strict";
                    $(document).ready(function() {
                        // Hero slider
                        $(".tft-hero-design-4__slider").slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: <?php echo esc_attr($design4_slider_loop); ?>,
                            autoplay: <?php echo esc_attr($design4_slider_autoplay); ?>,
                            autoplaySpeed: <?php echo esc_attr($design4_slider_autoplay_speed); ?>,
                            speed: <?php echo esc_attr($design4_slider_autoplay_interval); ?>,
                            fade: <?php echo esc_attr($design4_slider_animation); ?>,
                            dots: <?php echo esc_attr($design4_slider_dots) ?>,
                            arrows: <?php echo esc_attr($design4_slider_arrows) ?>,

                            pauseOnHover: <?php echo esc_attr($design4_slider_pause_on_hover); ?>,
                            pauseOnFocus: <?php echo esc_attr($design4_slider_pause_on_focus); ?>,
                            rtl: <?php echo esc_attr($design4_slider_rtl); ?>,
                            draggable: <?php echo esc_attr($design4_slider_draggable); ?>,
                            prevArrow: '.tft-hero-slider-nav .tft-prev-slide',
                            nextArrow: '.tft-hero-slider-nav .tft-next-slide',
                        });
                    });
                })(jQuery);
            </script>

            <?php
        } else {

            if ($settings['hero_slider_list']) { ?>
                <!-- Slider Hero section -->
                <div class="hero--slider-wrapper tft-hero-design-1"> <!-- tft-customizer-typography -->
                    <?php $rand_number = wp_rand(100, 99999999); ?>
                    <div class="tft-hero-slider-selector tft-hero-slider-selector-<?php echo esc_html($rand_number) ?>">
                        <?php foreach ($settings['hero_slider_list'] as $item): 
                            ?>
                            <div class="tft-hero-single-item">
                                <div class="tft-slider-bg-img" style="background-image: url(<?php echo esc_url($item['slider_image']['url']); ?>);">
                                    <div class="tft-container tft-hero-single-item-inner">
                                        <div class=" slider-inner-info">
                                            <div class="tft-slider-title">
                                                <h1 class="tft-title title-large">
                                                    <?php
                                                    if (!empty($item['slider_title'])) {
                                                        echo esc_html($item['slider_title']);
                                                    } ?>
                                                </h1>
                                                <?php if ($item['slider_subtitle'] != '') { ?>
                                                    <div class="tft-sub-title">
                                                        <p> <?php echo esc_html($item['slider_subtitle']); ?> </p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="slider-button">
                                                <?php
                                                if (!empty($item['slider_bttn_url'])) { ?>
                                                    <a class="bttn tft-bttn-primary" href="<?php echo esc_url($item['slider_bttn_url']['url']) ?>">
                                                        <div class="tft-custom-bttn">
                                                            <span>
                                                                <?php
                                                                if (!empty($item['slider_bttn_txt'])) {
                                                                    echo esc_html($item['slider_bttn_txt']);
                                                                } ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="slider-progress">
                        <span></span>
                    </div>
                </div>
                <?php if ($settings['search_box_switcher'] == 'yes'):


                ?>
                    <div class="tft-search-box tft-hero-design-1">
                        <div class="tft-search-box-inner">
                            <?php echo do_shortcode('[tf_search_form  type="' . $type . '" ' . $tour_tab_title . $apt_tab_title . $hotel_tab_title . ']'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <script>
                    // Home Slider
                    (function($) {
                        "use strict";
                        $(document).ready(function() {
                            //Your Code Inside
                            $('.tft-hero-slider-selector-<?php echo esc_html($rand_number) ?>').slick({
                                dots: false,
                                infinite: true,
                                slidesToShow: 1,
                                fade: true,
                                speed: 500,
                                infinite: true,
                                cssEase: 'ease-in-out',
                                touchThreshold: 100,
                                autoplay: false,
                                arrows: true,
                                prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
                                nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
                                autoplaySpeed: 2000
                            });
                        });

                        // Counter Number
                        var $tfSliderHero = $('.tft-hero-slider-selector-<?php echo esc_html($rand_number) ?>');

                        if ($tfSliderHero.length) {
                            var currentSlide;
                            var sliderCounter = document.createElement('div');
                            sliderCounter.classList.add('slider__counter');
                            var updateSliderCounter = function(slick) {
                                currentSlide = slick.slickCurrentSlide() + 1;
                                currentSlide = ('0000' + currentSlide).match(/\d{2}$/);
                                $(sliderCounter).text(currentSlide)
                            };
                            $tfSliderHero.on('init', function(event, slick) {
                                $tfSliderHero.append(sliderCounter);
                                updateSliderCounter(slick);
                            });
                            $tfSliderHero.on('afterChange', function(event, slick, currentSlide) {
                                updateSliderCounter(slick, currentSlide);
                            });
                            //$tfSliderHero.slick();

                        }

                    }(jQuery));
                </script>
            <?php
                do_action('slider_style', esc_html($rand_number));
            }
        }
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) : ?>
            <script>
                jQuery(document).ready(function($) {
                    $(".tft-hero-design-4__slider").slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: <?php echo esc_attr($design4_slider_loop); ?>,
                        autoplay: <?php echo esc_attr($design4_slider_autoplay); ?>,
                        autoplaySpeed: <?php echo esc_attr($design4_slider_autoplay_speed); ?>,
                        speed: <?php echo esc_attr($design4_slider_autoplay_interval); ?>,
                        fade: <?php echo esc_attr($design4_slider_animation); ?>,
                        dots: <?php echo esc_attr($design4_slider_dots) ?>,
                        arrows: <?php echo esc_attr($design4_slider_arrows) ?>,
                        pauseOnHover: <?php echo esc_attr($design4_slider_pause_on_hover); ?>,
                        pauseOnFocus: <?php echo esc_attr($design4_slider_pause_on_focus); ?>,
                        rtl: <?php echo esc_attr($design4_slider_rtl); ?>,
                        draggable: <?php echo esc_attr($design4_slider_draggable); ?>,
                        prevArrow: '.tft-hero-slider-nav .tft-prev-slide',
                        nextArrow: '.tft-hero-slider-nav .tft-next-slide',
                    });
                });
            </script>
<?php endif;
    }
}
