<?php
class Travelfic_Toolkit_Features extends \Elementor\Widget_Base
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
        return 'tft-features';
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
        return esc_html__('Travelfic Features', 'travelfic-toolkit');
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
        return 'eicon-kit-details';
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
        return ['travelfic', 'features', 'tft'];
    }
    public function get_style_depends()
    {
        return ['travelfic-toolkit-features'];
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
            'tft-features',
            [
                'label' => __('Feature Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Design
        $this->add_control(
            'feature_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Design', 'travelfic-toolkit'),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __('Design 1', 'travelfic-toolkit'),
                ],
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
            'icon',
            [
                'label'   => __('Icon', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Swimming pool', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label'       => __('Description', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Our trained and experienced staff is capable of handling a number of pool features', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'features_section',
            [
                'label'       => __('Features List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        // Interaction control: hover or click
        $this->add_control(
            'feature_interaction',
            [
                'label' => __('Interaction', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'click' => __('Click', 'travelfic-toolkit'),
                    'hover' => __('Hover', 'travelfic-toolkit'),
                ],
                'default' => 'click',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'features_style_section',
            [
                'label' => __('Item List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'features_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'features_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_card_color_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature.active' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'features_tour_item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'features_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'features_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_title_color_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature.active h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'features_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'features_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature p',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'features_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature:hover p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'features_content_color_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-features-design__one .tft-features-items .tft-features-items-left .tft-single-feature.active p' => 'color: {{VALUE}}',
                ],
            ]
        );
     
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        \Travelfic_Toolkit\Components\Features::render( $settings, 'elementor' );
    }
}
