<?php

use Tourfic\Classes\Helper;

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
        return esc_html__('Travelfic Hero', 'travelfic-toolkit');
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
                'label' => __('Hero Content', 'travelfic-toolkit'),
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
                    'design-5'  => __('Design 5', 'travelfic-toolkit'),
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
                    'slider_style' => ['design-2', 'design-3', 'design-5'],
                ],
            ]
        );

        $this->add_control(
            'banner_description',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Banner Description', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Banner description', 'travelfic-toolkit'),
                'default' => __('Discover luxurious hotel at unbeatable price Discover luxurious hotel at unbeatable price Discover luxurious hotel at unbeatable price Discover luxurious hotel at unbeatable', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-5'],
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
                    'slider_style' => ['design-2', 'design-3', 'design-4', 'design-5'],
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
                'label' => __('Hero Social Content', 'travelfic-toolkit'),
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
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-wordpress-simple',
					'library' => 'fa-solid',
				],
				'recommended' => [
                    'fa-brands' => [
                        'facebook-f',
                        'x-twitter',
                        'linkedin-in',
                        'instagram',
                        'youtube',
                        'pinterest-p',
                        'tiktok',
                        'whatsapp',
                        'telegram',
                        'github',
                        'reddit-alien',
                        'tumblr',
                        'snapchat-ghost',
                        'dribbble',
                        'behance',
                        'flickr',
                        'wordpress-simple',
                    ],
                ],
			]
        );
        $social_repeater->add_control(
            'social_media_url',
            [
                'label'       => __('Link', 'travelfic-toolkit'),
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
                'label'   => __('Social Media List', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $social_repeater->get_controls(),
                'default' => [
                    [
                        'social_media_label' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_media_label' => [
                            'value' => 'fab fa-x-twitter',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_media_label' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_media_label' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_media_label' => [
                            'value' => 'fab fa-tiktok',
                            'library' => 'fa-brands',
                        ],
                    ],
                ],
                'title_field' => '{{{ social_media_label.value }}}',
                'condition'   => [
                    'slider_style' => 'design-4',
                ],
            ]
        );
        $this->add_control(
            'social_share_label',
            [
                'label'       => __('Social Box Label', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => ['active' => true],
                'default'     => __('Share', 'travelfic-toolkit'),
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
                'condition'   => [
                    'slider_style!' => 'design-5',
                ],
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
                'condition'   => [
                    'slider_style!' => 'design-5',
                ],
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
                    '{{WRAPPER}} .tft-hero-design__two' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-2'],
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
                    '{{WRAPPER}} .tft-hero-design__three' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-3',
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
                    '{{WRAPPER}} .tft-hero-design__four' => 'height: {{SIZE}}{{UNIT}};',
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
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-slider-selector .tft-hero-single-item::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-3'],
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__two .tft-hero-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => 'design-2', 
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-content h1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-slider-title .tft-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__slider__item__content--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-slider-title .tft-title, #tft-site-main-body #page {{WRAPPER}} .tft-hero-content h1, #tft-site-main-body #page {{WRAPPER}} .tft-hero-design__three .tft-hero-content-box h1, #tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__slider__item__content--title',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-slider-title .tft-title' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__two .tft-hero-content h1' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__five .tft-hero-content h1' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__three .tft-hero-content-box h1' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four .tft-hero-design__four__slider__item__content--title' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-content .tf-booking-form-tab button.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slider_subtitle',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
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
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-sub-title p, #tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__slider__item__content--subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_sub_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-sub-title p' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__slider__item__content--subtitle' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        $this->add_control(
            'slider_description',
            [
                'label'     => __('Description', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style' => ['design-5'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_description',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-hero-content p',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style' => ['design-5'],
                ],
            ]
        );
        $this->add_control(
            'slider_description_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-content p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-5'],
                ],
            ]
        );

        //Buttons
        $this->add_control(
            'slider_buttons_style',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
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
                'name'     => 'button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'slider_button_border',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn',
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style' => '!design-5', 
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
      

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-content-box .tft-btn' => 'background-color: {{VALUE}};',
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
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-content-box .tft-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-content-box .tft-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-1', 'design-4'],
                ],
            ]
        );
        $this->add_control(
            'button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // navigations
        // $this->add_control(
        //     'slider_nav_style',
        //     [
        //         'label'     => __('Navigation ', 'travelfic-toolkit'),
        //         'type'      => \Elementor\Controls_Manager::HEADING,
        //         'separator' => 'after',
        //         'condition' => [
        //             'slider_style' => ['design-1', 'design-4'],
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'slider_nav_color',
        //     [
        //         'label'     => __('Color', 'travelfic-toolkit'),
        //         'type'      => \Elementor\Controls_Manager::COLOR,
        //         'selectors' => [
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-hero-slider-selector button.slick-arrow' => 'background-color: {{VALUE}};',
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-hero-slider-selector .slider__counter'   => 'color: {{VALUE}};',
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four .slick-dots li button'   => 'background-color: {{VALUE}};',
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four .slick-dots li.slick-active'   => 'border-color: {{VALUE};',
        //         ],
        //         'condition' => [
        //             'slider_style' => ['design-1', 'design-4'],
        //         ],
        //     ]
        // );

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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__social__label' => 'color: {{VALUE}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__social__list__item--link i'   => 'color: {{VALUE}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__social__list__item--link'   => 'background: {{VALUE}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__social__list__item--link'   => 'border-color: {{VALUE}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-design__four__social__list__item--link:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );
        $this->add_control(
            'slider_social_hover_background',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-bg-hover-primary:hover' => 'background: {{VALUE}};',
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
                    '#tft-site-main-body #page {{WRAPPER}} .tft-hero-wrapper .tft-bg-hover-primary:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style' => ['design-4'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // search form
        $this->start_controls_section(
            'hero_search_section',
            [
                'label' => __('Search', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        //Buttons
        $this->add_control(
            'search_buttons_style',
            [
                'label'     => __('Tab', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'search_button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn',
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
        $this->add_responsive_control(
            'search_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
        $this->add_responsive_control(
            'search_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'search_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn',
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
        $this->add_control(
            'search_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
 
        $this->start_controls_tabs('search_button_style_tabs_'); 

        $this->start_controls_tab(
            'search_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );
        $this->add_control(
            'search_button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
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
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_hover_border',
            [
                'label'     => __('border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'search_button_active',
            [
                'label' => __('Active', 'travelfic-toolkit'),
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_active_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn.active' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_background_active_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn.active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );

        $this->add_control(
            'search_button_active_border',
            [
                'label'     => __('border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-form-tab .tf-tablinks.tf_btn.active' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'slider_style!' => 'design-5', 
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'search_form_style',
            [
                'label'     => __('Form', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'search_form_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-search-box' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .default-form' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'search_form_label',
            [
                'label'     => __('Label', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'search_form_label_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking label, 
                               #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-label, 
                               #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__label,
                               #tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper label,
                               #tft-site-main-body #page {{WRAPPER}} .tf-archive-search-box-wrapper .tf-date-select-box .tf-date-single-select .tf-select-date .info-select h5',
            ]
        );

        $this->add_control(
            'search_form_label_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking label' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-label' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__label' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .icon svg path' => 'stroke: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper label' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-archive-search-box-wrapper .tf-date-select-box .tf-date-single-select .tf-select-date .info-select h5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'search_form_input',
            [
                'label'     => __('Input', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'search_form_input_wrapper_background',
            [
                'label'     => __('Wrapper Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf-archive-search-box-wrapper .tf-date-select-box .tf-date-single-select' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'slider_style' => ['design-3'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'search_form_input_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking input, 
                               #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_form-inner input, 
                               #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .field--title,
                               #tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field,
                               #tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field input,
                               #tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field .tf-guest',
            ]
        );
        $this->add_control(
            'search_form_input_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking input' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_input-inner > div' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_input-inner > div i' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking input::placeholder' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_form-inner input' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_form-inner input::placeholder' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_form_inners span' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .info-select input' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_selectperson-wrap div' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .info-select input::placeholder' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_form_inners svg path' => 'fill: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .field--title' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__input' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__input::placeholder' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__field__mthyr > span' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_checkin_to_label' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .form--span path' => 'stroke: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field input' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field .tf-guest' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'search_form_input_background',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking > div' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf_form-inner' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .info-select input' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__field #tf-location' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-search-tabs__design--5 .tf-archive-search-box-wrapper .tf-search-field' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'search_form_buttons_style',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'search_form_button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit, #tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button, #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn, #tft-site-main-body #page {{WRAPPER}} .tf-search__form__submit',
            ]
        );
        $this->add_responsive_control(
            'search_form_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} #tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'search_form_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'search_form_button_border',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit, #tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button, #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn, #tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit',
            ]
        );
        $this->add_control(
            'about_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit, #tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
 
        $this->start_controls_tabs('search_form_button_style_tabs_');

        $this->start_controls_tab(
            'search_form_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'search_form_button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn i' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'search_form_button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'search_form_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'search_form_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit:hover' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button:hover' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn:hover' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit:hover' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn:hover i' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit:hover path' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_form_button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit:hover' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button:hover' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn:hover' => 'background-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'search_form_button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tf_homepage-booking .tf_btn.tf-submit:hover' => 'border-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf_availability_checker_box button:hover' => 'border-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-submit-button .tf_btn:hover' => 'border-color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tf-booking-forms-wrapper .tf-search__form__submit:hover' => 'border-color: {{VALUE}};',
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
        \Travelfic_Toolkit\Components\SliderHero::render( $settings, 'elementor' );
    }
}
