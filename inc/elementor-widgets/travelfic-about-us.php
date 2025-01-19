<?php
class Travelfic_Toolkit_AboutUs extends \Elementor\Widget_Base
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
        return 'tft-about-us';
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
        return esc_html__('Travelfic About Us', 'travelfic-toolkit');
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
        return 'eicon-call-to-action';
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
        return ['travelfic', 'about', 'about us', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-about-us'];
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
            'tft-about-us',
            [
                'label' => __('About Us', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        // Design
        $this->add_control(
            'tft_about_style',
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
        // Design 1 fields
        $this->add_control(
            'about_us_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Enjoy an extraordinary retreat with us', 'travelfic-toolkit'),

            ]
        );
        $this->add_control(
            'about_us_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('about us', 'travelfic-toolkit'),

            ]
        );
        $this->add_control(
            'about_us_experience',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Years of Experience', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter Years of Experience', 'travelfic-toolkit'),
                'default' => __('15+', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'about_us_image',
            [
                'label'   => __('About Us Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tft_about_style' => ['design-1', 'design-2'],
                ],
            ]
        );
        $this->add_control(
            'about_us_circle_image',
            [
                'label'   => __('About Us Circle Image', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tft_about_style' => ['design-2'],
                ],
            ]
        );
        $this->add_control(
            'about_us_content',
            [
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label' => esc_html__('Descriptions', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your descriptions', 'travelfic-toolkit'),
                'default' => __('Welcome to VICTORIA, where comfort meets elegance. Personalized service and attention to detail ensure a truly exceptional stay. Stay in luxury, dine exquisitely, and relax in the spa. With us, you can create unforgettable memories.
                "Creating memorable moments is our passion. Welcome to our hotel, where comfort, elegance, and genuine hospitality meet."', 'travelfic-toolkit'),

            ]
        );
        $this->add_control(
            'about_us_quotes',
            [
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label' => esc_html__('Quotes', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your descriptions', 'travelfic-toolkit'),
                'default' => __('"Creating memorable moments is our passion. Welcome to our hotel, where comfort, elegance, and genuine hospitality meet."', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'about_us_author',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Author Details', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Add Author Details', 'travelfic-toolkit'),
                'default' => __('CEO of VICTORIA', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );

        $about_list_repeater = new \Elementor\Repeater();
        $about_list_repeater->add_control(
            'about_list_title',
            [
                'label'       => __('About List Title', 'themefic_themedev'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Easy & Modern Customer Solution', 'themefic_themedev'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'about_list_content',
            [
                'label'   => __('About List Content', 'themefic_themedev'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $about_list_repeater->get_controls(),
                'default' => [
                    [
                        'about_list_title' => 'Easy & Modern Customer Solution',
                    ],
                ],
                'title_field' => '{{{ about_list_title }}}',
                'condition'   => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'readme_label',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Read More Label', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter read more label', 'travelfic-toolkit'),
                'default' => __('About Us', 'travelfic-toolkit'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tft_about_style' => ['design-2'],
                ],
            ]
        );
        $this->add_control(
            'readme_link',
            [
                'type' => \Elementor\Controls_Manager::URL,
                'label' => esc_html__('Read More URL', 'travelfic-toolkit'),
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

        // Style
        $this->start_controls_section(
            'about_us_style',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Design Styles start
        $this->add_control(
            'content_positon',
            [
                'label' => esc_html__('Content Position', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'start',
                'options' => [
                    'start' => esc_html__('Start', 'travelfic-toolkit'),
                    'center' => esc_html__('Center', 'travelfic-toolkit'),
                    'end' => esc_html__('End', 'travelfic-toolkit'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'about_us_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => ['design-1'],
                ],
            ]
        );
        // design 1
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h3',
                'label'    => __('Title Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );


        $this->add_control(
            'about_us_sec_title_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'about_us_sub_title_head',
            [
                'label'     => __('Sub Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => ['design-1'],
                ]
            ]
        );

        // design 1
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h6',
                'label'    => __('Subtitle Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );

        $this->add_control(
            'about_us_sec_subtitle_color',
            [
                'label'     => __('Subtitle Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );

        $this->add_control(
            'about_us_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => ['design-1'],
                ]
            ]
        );
        // design 1
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_content_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content p',
                'label'    => __('Content Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );

        $this->add_control(
            'about_us_sec_content_color',
            [
                'label'     => __('Content Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_quotes_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .tft-about-us-quotes',
                'label'    => __('Quotes Typography', 'travelfic-toolkit'),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'about_us_sec_quotes_color',
            [
                'label'     => __('Quotes Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .tft-about-us-quotes' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_author_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .tft-about-us-author',
                'label'    => __('Author Typography', 'travelfic-toolkit'),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'about_us_sec_author_alignment',
            [
                'label' => __('Author Alignment', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'travelfic-toolkit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'travelfic-toolkit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'travelfic-toolkit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'right', // Set the default alignment
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .tft-about-us-author' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'about_us_sec_author_color',
            [
                'label'     => __('Author Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .tft-about-us-author' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_years_typo',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .years-of-experience .tft-experience-years h2',
                'label'    => __('Years of Experience Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'about_us_years_color',
            [
                'label'     => __('Years of Experience Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#99948D',
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .years-of-experience .tft-experience-years h2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-1', // Show this control only when tft_about_style is 'design-1'
                ],
            ]
        );

        // design 2 style settings
        $this->add_control(
            'about_us_design2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => ['design-2'],
                ]
            ]
        );
     
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_design2_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-heading-content h2',
                'label'    => __('Title Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_us_design2_sec_title_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-heading-content h2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', 
                ],
            ]
        );

        // Title Backdrop
        $this->add_control(
            'about_us_design2_title_backdrop',
            [
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label' => esc_html__('Title Backdrop', 'travelfic-toolkit'),
                'default' => 'yes',
                'condition' => [
                    'tft_about_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'about_us_design2_title_backdrop_head',
            [
                'label'     => __('Title Backdrop', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => ['design-2'],
                    'about_us_design2_title_backdrop' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'about_us_design2_title_backdrop_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-heading-content h2::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', 
                    'about_us_design2_title_backdrop' => 'yes',
                ],
            ]
        );
       

        // sub title
        $this->add_control(
            'about_us_design2_sub_title_head',
            [
                'label'     => __('Sub Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => 'design-2',
                ]
            ]
        );

        // design 2
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_design2_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-about-design-2 .tft-heading-content h3',
                'label'    => __('Subtitle Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_us_design2_sec_subtitle_color',
            [
                'label'     => __('Subtitle Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', 
                ],
            ]
        );

        $this->add_control(
            'about_us_design2_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => 'design-2',
                ]
            ]
        );
        
        // design 2
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_design2_sec_content_typo',
                'selector' => '{{WRAPPER}} .tft-about-design-2 .tft-heading-content p',
                'label'    => __('Content Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_us_design2_sec_content_color',
            [
                'label'     => __('Content Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-heading-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', 
                ],
            ]
        );


        $this->add_control(
            'about_us_button_style',
            [
                'label'     => __('Button Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'about_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'about_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs_');

        $this->start_controls_tab(
            'button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a',
                'condition' => [
                    'tft_about_style' => 'design-1',
                ],
            ]
        );

        // design 2
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_button_typography',
                'selector' => '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a',
                'condition' => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_us_button_text_color',
            [
                'label'     => __('Text Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a span svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'about_us_button_background_color',
            [
                'label'     => __('Background Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a' => 'background-color: {{VALUE}};',
                ],

            ]
        );
        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'about_us_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'about_us_button_hover_color',
            [
                'label'     => __('Text Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a:hover span svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'about_us_button_background_hover_color',
            [
                'label'     => __('Background Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-us-wrapper .tft-about-us-grid .tft-about-us-content .read-more a:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-button a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        // design 2 
        $this->add_control(
            'about_us_section_list',
            [
                'label'     => __('List Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_design2_sec_list_typo',
                'selector' => '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .icon i',
                'label'    => __('List Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_us_sec_list_color',
            [
                'label'     => __('List Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'about_us_sec_list_icon_typo',
                'selector' => '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .icon i',
                'label'    => __('Icon Typography', 'travelfic-toolkit'),
                'condition' => [
                    'tft_about_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'about_us_sec_list_icon_color',
            [
                'label'     => __('Icon Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-us-content .tft-about-us-list ul li .icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        // shape
        $this->add_control(
            'about_us_section_shape',
            [
                'label'     => __('Shape Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'tft_about_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'about_us_sec_shape_1',
            [
                'label'     => __('Shape 1 Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-image::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'about_us_sec_shape_2',
            [
                'label'     => __('Shape 2 Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tft-about-design-2 .tft-about-us-grid .tft-about-image::after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'tft_about_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Design
        if (!empty($settings['tft_about_style'])) {
            $tft_design = $settings['tft_about_style'];
        }

        if (!empty($settings['about_us_title'])) {
            $tft_sec_title = $settings['about_us_title'];
        }
        if (!empty($settings['about_us_subtitle'])) {
            $tft_sec_subtitle = $settings['about_us_subtitle'];
        }
        if (!empty($settings['about_us_content'])) {
            $tft_sec_content = $settings['about_us_content'];
        }
        if (!empty($settings['about_us_quotes'])) {
            $tft_sec_quotes = $settings['about_us_quotes'];
        }
        if (!empty($settings['about_us_author'])) {
            $tft_sec_author = $settings['about_us_author'];
        }
        if (!empty($settings['about_us_image'])) {
            $tft_about_us_image = $settings['about_us_image'];
        }
        if (!empty($settings['about_us_circle_image'])) {
            $tft_about_us_circle_image = $settings['about_us_circle_image'];
        }
        if (!empty($settings['about_us_experience'])) {
            $tft_about_us_experience = $settings['about_us_experience'];
        }

        if (!empty($settings['readme_label'])) {
            $tft_about_us_button_text = $settings['readme_label'];
        }
        $section_title_backdrop = $settings['about_us_design2_title_backdrop' ] !== 'yes' ? ' tft-no-backdrop' : '';
    
        if ("design-1" == $tft_design) {
?>

            <div class="tft-about-us-wrapper tft-customizer-typography">
                <div class="tft-about-us tft-row">
                    <div class="tft-about-us-grid">
                        <div class="tft-about-us-content">
                            <?php
                            if (!empty($tft_sec_subtitle)) { ?>
                                <h6><?php echo esc_html($tft_sec_subtitle); ?></h6>
                            <?php }

                            if (!empty($tft_sec_title)) { ?>
                                <h3><?php echo esc_html($tft_sec_title); ?></h3>
                            <?php }

                            if (!empty($tft_sec_content)) { ?>
                                <p><?php echo wp_kses_post($tft_sec_content); ?></p>
                            <?php } ?>

                            <?php if (!empty($tft_sec_quotes)) { ?>
                                <p class="tft-about-us-quotes"><?php echo wp_kses_post($tft_sec_quotes); ?></p>
                            <?php } ?>

                            <?php if (!empty($tft_sec_author)) { ?>
                                <p class="tft-about-us-author"><?php echo esc_html($tft_sec_author); ?></p>
                            <?php } ?>

                            <div class="read-more">
                                <a href="<?php echo esc_url($settings['readme_link']['url']); ?>">
                                    <?php echo esc_html_e("More", "travelfic-toolkit"); ?>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
                                            <path d="M56.7071 8.86336C57.0976 8.47283 57.0976 7.83967 56.7071 7.44914L50.3431 1.08518C49.9526 0.694658 49.3195 0.694658 48.9289 1.08518C48.5384 1.47571 48.5384 2.10887 48.9289 2.4994L54.5858 8.15625L48.9289 13.8131C48.5384 14.2036 48.5384 14.8368 48.9289 15.2273C49.3195 15.6178 49.9526 15.6178 50.3431 15.2273L56.7071 8.86336ZM0 9.15625H56V7.15625H0V9.15625Z" fill="#B58E53" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="tft-about-us-image">
                            <?php
                            if (!empty($tft_about_us_experience)) { ?>
                                <div class="years-of-experience">
                                    <img class="experience-badge" src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/app/img/years-experience.png'); ?>" alt="">
                                    <div class="tft-experience-years">
                                        <h2><?php echo esc_html($tft_about_us_experience); ?></h2>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php
                            if (!empty($tft_about_us_image['url'])) { ?>
                                <div class="tft-about-image">
                                    <img src="<?php echo esc_url($tft_about_us_image['url']); ?>" alt="About Us Image">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ("design-2" == $tft_design) { ?>
            <div class="tft-about-design-2 tft-customizer-typography tft-section-space-top tft-section-small-bottom-space">
                <div class="tft-about-us tft-row">
                    <div class="tft-about-us-grid">
                        <div class="tft-about-us-image">
                            <?php if (!empty($tft_about_us_image['url'])) { ?>
                                <div class="tft-about-image">
                                    <div class="tft-about-curbe-image">
                                        <img src="<?php echo esc_url($tft_about_us_image['url']); ?>" alt="About Us Image">
                                    </div>
                                    <div class="tft-about-circle-image">
                                        <img src="<?php echo esc_url($tft_about_us_circle_image['url']); ?>" alt="About Us Circle Image">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tft-about-us-content tft-heading-content">
                            <?php if (!empty($tft_sec_subtitle)) { ?>
                                <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                            <?php }
                            if (!empty($tft_sec_title)) { ?>
                                <h2 class="tft-section-title<?php echo esc_attr($section_title_backdrop);?>"><?php echo esc_html($tft_sec_title); ?></h2>
                            <?php }
                            if (!empty($tft_sec_content)) { ?>
                                <div class="tft-section-content">
                                    <?php echo wp_kses_post($tft_sec_content); ?>
                                </div>
                            <?php } ?>

                            <div class="tft-about-us-list">
                                <ul>
                                    <?php foreach ($settings['about_list_content'] as $list): ?>
                                        <li>
                                            <div class="icon">
                                                <i class="fa-regular fa-circle-check"></i>
                                            </div>
                                            <div class="text">
                                                <?php echo esc_html($list['about_list_title']); ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="tft-about-us-button">
                                <a href="<?php echo esc_url($settings['readme_link']['url']); ?>" class="tft-btn">
                                    <?php echo esc_html($tft_about_us_button_text); ?>
                                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tft-about-us-shape">
                    <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/app/img/plane shape.png'); ?>" alt="About us shape">
                </div>
            </div>
<?php
        }
    }
}
