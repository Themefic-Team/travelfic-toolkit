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
            'section_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Book your stay today', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'section_subtitle',
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
            ]
        );
        $this->add_control(
            'tft_gallery_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_gallery_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-top-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'tft_gallery_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-top-header .tft-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tft_gallery_sub_title_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_gallery_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-top-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'tft_gallery_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-gallery-top-header .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_style_section',
            [
                'label' => __('Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gallery_image_head',
            [
                'label'     => __('Image', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gallery_image_width',
            [
                'label'     => __('Image width', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-single-gallery img' => 'width: {{SIZE}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .slick-list .slick-slide' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gallery_image_height',
            [
                'label'     => __('Image height', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-single-gallery img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'gallery_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'gallery_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-single-gallery h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'gallery_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-gallery-design__one .tft-single-gallery h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        \Travelfic_Toolkit\Components\Gallery::render( $settings, 'elementor' );
    }
}
