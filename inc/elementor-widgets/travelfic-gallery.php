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
            'gallery_slider_rtl',
            [
                'label' => esc_html__('RTL', 'travelfic-toolkit'),
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
        // Design
        if (!empty($settings['gallery_style'])) {
            $tft_design = $settings['gallery_style'];
        }

        if (!empty($settings['section_title'])) {
            $tft_sec_title = $settings['section_title'];
        }
        if (!empty($settings['section_subtitle'])) {
            $tft_sec_subtitle = $settings['section_subtitle'];
        }

        // Items per page
        $gallery_slider_nav = $settings['gallery_slider_navigation'];
        $gallery_slider_arrows = ("arrows" === $gallery_slider_nav) ? 'true' : 'false';
        $gallery_slider_dots = ("dots" === $gallery_slider_nav) ? 'true' : 'false';
        $gallery_slider_autoplay = ('yes' === $settings['gallery_slider_autoplay']) ? 'true' : 'false';
        $gallery_slider_autoplay_speed = !empty($settings['gallery_slider_autoplay_speed']) ? $settings['gallery_slider_autoplay_speed']['size'] : 0;
        $gallery_slider_autoplay_interval = !empty($settings['gallery_slider_autoplay_interval']) ? $settings['gallery_slider_autoplay_interval']['size'] : 0;
        $gallery_slider_loop = ('yes' === $settings['gallery_slider_loop']) ? 'true' : 'false';
        $gallery_slider_pause_on_hover = ('yes' === $settings['gallery_slider_pause_on_hover']) ? 'true' : 'false';
        $gallery_slider_pause_on_focus = ('yes' === $settings['gallery_slider_pause_on_focus']) ? 'true' : 'false';
        $gallery_slider_rtl = ('yes' === $settings['gallery_slider_rtl']) ? 'true' : 'false';
        $gallery_slider_draggable = ('yes' === $settings['gallery_slider_draggable']) ? 'true' : 'false';

        if($settings['galleries'] && "design-1" == $tft_design) { ?>
            <div class="tft-gallery-design__one tft-customizer-typography">
                <div class="tft-gallery-top-header">
                    <div class="gallery-header-shape tft-heading-content">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }if (!empty($tft_sec_title)) { ?>
                            <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="tft-slider-arrows tft-slider-arrows--mobile">
                        <button type='button' class='slick-prev'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 8L2 12M2 12L6 16M2 12L22 12" stroke="#EE5509" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type='button' class='slick-next'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 8L22 12M22 12L18 16M22 12L2 12" stroke="#EE5509" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="tft-gallery-selector tft-slide-default">
                    <?php foreach ($settings['galleries'] as $item) { ?>
                        <div class="tft-single-gallery">
                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="Image"/>
                            <h3><?php echo esc_html($item['title']) ?></h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <script>
                (function($) {
                    "use strict";
                    $(document).ready(function() {
                        $('.tft-gallery-design__one .tft-gallery-selector').slick({
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: <?php echo esc_attr($gallery_slider_loop); ?>,
                            autoplay: <?php echo esc_attr($gallery_slider_autoplay); ?>,
                            autoplaySpeed: <?php echo esc_attr($gallery_slider_autoplay_speed); ?>,
                            speed: <?php echo esc_attr($gallery_slider_autoplay_interval); ?>,
                            dots: <?php echo esc_attr($gallery_slider_dots); ?>,
                            arrows: <?php echo esc_attr($gallery_slider_arrows); ?>,
                            pauseOnHover: <?php echo esc_attr($gallery_slider_pause_on_hover); ?>,
                            pauseOnFocus: <?php echo esc_attr($gallery_slider_pause_on_focus); ?>,
                            rtl: <?php echo esc_attr($gallery_slider_rtl); ?>,
                            draggable: <?php echo esc_attr($gallery_slider_draggable); ?>,
                            prevArrow: ".tft-gallery-design__one .slick-prev",
                            nextArrow: ".tft-gallery-design__one .slick-next",
                            variableWidth: true,
                            adaptiveHeight: true,
                            responsive: [
                                {
                                    breakpoint: 991,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 2
                                    }
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                },

                            ]
                        });
                    });
                }(jQuery));
            </script>
        <?php }
    }
}
