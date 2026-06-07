<?php
class Travelfic_Toolkit_LatestNews extends \Elementor\Widget_Base
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
        return 'tft-latest-news';
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
        return esc_html__('Travelfic Latest News', 'travelfic-toolkit');
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
        return 'eicon-posts-grid';
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

    public function grid_get_all_post_type_categories($post_type)
    {
        $options = array();

        if ($post_type == 'post') {
            $taxonomy = 'category';
        }

        if (! empty($taxonomy)) {
            // Get categories for post type.
            $terms = get_terms(
                array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                )
            );
            if (! empty($terms)) {
                foreach ($terms as $term) {
                    if (isset($term)) {
                        if (isset($term->slug) && isset($term->name)) {
                            $options[$term->slug] = $term->name;
                        }
                    }
                }
            }
        }

        return $options;
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
        return ['travelfic', 'blog', 'latest', 'tft'];
    }
    public function get_style_depends()
    {
        return ['travelfic-toolkit-latest-news'];
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
            'blog_news',
            [
                'label' => __('Blog News', 'travelfic-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        // Design
        $this->add_control(
            'blog_style',
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
            'tft_section_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('We share our experiences, tips and travel stories to inspire', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-2', 'design-3'], 
                ],
            ]
        );
        $this->add_control(
            'tft_section_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('BLOG & NEWS', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-2', 'design-3'], 
                ],
            ]
        );
        // Category name
        $this->add_control(
            'post_category',
            [
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'label'     => __('Category', 'travelfic-toolkit'),
                'options'   => $this->grid_get_all_post_type_categories('post'),
                'multiple' => true,
            ]
        );
        // posts items per page
        $this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __('Items', 'travelfic-toolkit'),
                'placeholder' => __('How many items?', 'travelfic-toolkit'),
                'default'     => 4,
            ]
        );

        // Order by.
        $this->add_control(
            'post_order_by',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Order by', 'travelfic-toolkit'),
                'default' => 'date',
                'options' => [
                    'date'          => __('Date', 'travelfic-toolkit'),
                    'title'         => __('Title', 'travelfic-toolkit'),
                    'modified'      => __('Modified date', 'travelfic-toolkit'),
                    'comment_count' => __('Comment count', 'travelfic-toolkit'),
                    'rand'          => __('Random', 'travelfic-toolkit'),
                ],
            ]
        );
        // Order
        $this->add_control(
            'post_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Order', 'travelfic-toolkit'),
                'default' => 'DESC',
                'options' => [
                    'DESC'        => __('Descending', 'travelfic-toolkit'),
                    'ASC'         => __('Ascending', 'travelfic-toolkit'),
                ],
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
                    'blog_style' => ['design-2', 'design-4'], 
                ],
            ]
        );
        $this->end_controls_section();


        // Style Section
        $this->start_controls_section(
            'blog_design_2_section_style',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => ['design-2', 'design-3'],
                ]
            ]
        );
        $this->add_control(
            'blog_section_background',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2', 'design-3'], 
                ],
            ]
        );


        // design 2
        $this->add_control(
            'blog_section_design2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-header .tft-heading-content .tft-section-title,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => 'design-2',
                ],
            ]
        );

        // design 3
        $this->add_control(
            'blog_section_design3_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_title_typo_design_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-heading-content h2.tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => 'design-3', 
                ],
            ]
        );

        $this->add_control(
            'blog_section_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-header .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-heading-content h2.tft-section-title' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header h2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2', 'design-3'],
                ],
            ]
        );

        // Title Backdrop
        $this->add_control(
            'blog_section_design3_title_backdrop',
            [
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label' => esc_html__('Title Backdrop', 'travelfic-toolkit'),
                'default' => 'yes',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'blog_section_design3_title_backdrop_head',
            [
                'label'     => __('Title Backdrop', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-3',
                    'blog_section_design3_title_backdrop' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'blog_section_design3_title_backdrop_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content h2.tft-title-shape::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                    'blog_section_design3_title_backdrop' => 'yes',
                ],
            ]
        );
        
        // design 2
        $this->add_control(
            'blog_section_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-header .tft-heading-content .tft-section-subtitle,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => 'design-2',
                ],
            ]
        );
        // design 3
        $this->add_control(
            'blog_section_design3_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_subtitle_typo_design_3',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-heading-content h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => 'design-3', 
                ],
            ]
        );
        $this->add_control(
            'blog_section_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-header .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-heading-content .tft-section-subtitle' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2', 'design-3'], 
                ],
            ]
        );


        $this->add_control(
            'blog_section_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_section_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-2'], 
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_section_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
               'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );
        $this->add_responsive_control(
            'blog_section_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'blog_section_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
                'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );

        $this->add_responsive_control(
            'blog_section_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );

        $this->start_controls_tabs('blog_section_button_tabs_');

        $this->start_controls_tab(
            'blog_section_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );
       
       $this->add_control(
            'blog_section_button_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a span svg path' => 'fill: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2'], 
                ],
            ]
        );
        $this->add_control(
            'blog_section_button_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2'], 
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'blog_section_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-2'],
                ]
            ]
        );
        $this->add_control(
            'blog_section_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a:hover' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a:hover span svg path' => 'fill: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2'], 
                ],
            ]
        );
        $this->add_control(
            'blog_section_button_hover_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a:hover' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2'], 
                ],
            ]
        );
        $this->add_control(
            'blog_section_button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .read-more a:hover' => 'border-color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2'], 
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'news_style_section',
            [
                'label' => __('News List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'news_item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card.content-only' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card.with-image .tf-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => ['design-1', 'design-3', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'news_card_radius',
            [
                'label'   => __('Border Radius', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ],
        );

        // design 3
        $this->add_responsive_control(
            'news_card_radius_design_3',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => 'design-3', 
                ],
            ]
        );

        $this->add_control(
            'news_card_background_design_3',
            [
                'label'     => __('Card Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-col-item' => 'background: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-3', 'design-4'] 
                ],
            ]
        );

        $this->add_control(
            'news_card_gradient',
            [
                'label'     => __('Card Gradient', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );
        $this->start_controls_tabs('news_hover_style');

        // Normal state tab
        $this->start_controls_tab(
            'search_button_normal',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        $this->add_control(
            'news_item_card_gradient_1',
            [
                'label'     => __('Background Gradient 1', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        $this->add_control(
            'news_item_card_gradient_2',
            [
                'label'     => __('Background Gradient 2', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1d2a3b00',
                'condition' => [
                    'blog_style' => 'design-1', 
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
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        $this->add_control(
            'news_item_card_gradient_1_hover',
            [
                'label'     => __('Background Gradient 1', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        $this->add_control(
            'news_item_card_gradient_2_hover',
            [
                'label'     => __('Background Gradient 2', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#eb390300',
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'news_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => ['design-1', 'design-4'],
                ],
            ]
        );

        // design 1
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_title_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-content-wrap .tft-post-title .tft-title,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content h3',
                'condition' => [
                    'blog_style' => ['design-1', 'design-4']
                ],
            ]
        );

        $this->add_control(
            'news_title_typo_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-content-wrap .tft-post-title .tft-title' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content h3 a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-1', 'design-4'], 
                ],
            ]
        );

        $this->add_control(
            'news_meta_head',
            [
                'label'     => __('Meta', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => ['design-1'],
                ],
            ]
        );

        // design 1
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_meta_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-content-wrap .tft-meta-wrap .tft-meta',
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );



        $this->add_control(
            'news_meta_typo_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-content-wrap .tft-meta-wrap .tft-meta' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-content-wrap .tft-meta-wrap .tft-meta i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        $this->add_control(
            'news_hover_head',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );
        $this->add_control(
            'news_title_typo_color_hover',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-thumbnail a:hover  .tft-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-1'],
                ],
            ]
        );
        $this->add_control(
            'news_meta_typo_color_hover',
            [
                'label'     => __('Meta', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__one .tft-post-thumbnail a:hover .tft-meta' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-1', 
                ],
            ]
        );

        // Design 2 News Field
        $this->add_responsive_control(
            'news_design2_card_paddding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item .tft-content-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'news_design2_overley',
            [
                'label'     => __('Overley', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .blog-grid-item-2 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-3 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-4 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-4 .tft-post-single-item.tft-col-item:nth-child(3) a .tft-content-details, .blog-grid-item-5 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-5 .tft-post-single-item.tft-col-item:nth-child(4) a .tft-content-details, .blog-grid-item-6 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-6 .tft-post-single-item.tft-col-item:nth-child(4) a .tft-content-details, .blog-grid-item-6 .tft-post-single-item.tft-col-item:nth-child(6) a .tft-content-details' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'news_design2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design2_title_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item a h3',
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'news_design2_title_typo_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item a h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );

        $this->add_control(
            'news_design2_date_head',
            [
                'label'     => __('Date', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design2_time_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item a p.tft-meta',
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );
        $this->add_control(
            'news_design2_time_typo_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item a p.tft-meta' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-2', 
                ],
            ]
        );

        $this->add_control(
            'news_design2_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => ['design-2', 'design-4']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design2_content_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item p.content,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content p',
                'condition' => [
                    'blog_style' => ['design-2', 'design-4'] 
                ],
            ]
        );
        $this->add_control(
            'news_design2_content_typo_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item p.content' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => ['design-2', 'design-4'] 
                ],
            ]
        );

        // Design 3 style settings
        $this->add_control(
            'news_design3_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design3_title_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-content-details .tft-title',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'news_design3_title_typo_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );
        $this->add_control(
            'news_design3_title_hover_typo_color',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'news_design3_meta_head',
            [
                'label'     => __('Meta', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design3_meta_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-content-details .tft-post-meta .tft-meta',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'news_design3_meta_typo_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-content-details .tft-post-meta .tft-meta' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-content-details .tft-post-meta .tft-meta i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'news_design3_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'news_design3_button_typography',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a,
                               #tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more',
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );


        $this->add_responsive_control(
            'news_design3_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );
        $this->add_responsive_control(
            'news_design3_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'news_design3_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a',
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->add_control(
            'news_design3_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs_');

        $this->start_controls_tab(
            'news_design3_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );
  
        $this->add_control(
            'news_design3_button_text_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );
        $this->add_control(
            'news_design3_button_background_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state tab
        $this->start_controls_tab(
            'news_design3_button_hover',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );

        $this->add_control(
            'news_design3_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a:hover' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more:hover' => 'color: {{VALUE}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more:hover svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => ['design-3', 'design-4']
                ],
            ]
        );

        $this->add_control(
            'news_design3_button_background_hover_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

         $this->add_control(
            'news_design3_button_border_hover_color',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-latest-posts-design__three .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => 'design-3',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        \Travelfic_Toolkit\Components\LatestNews::render( $settings, 'elementor' );
    }
}
