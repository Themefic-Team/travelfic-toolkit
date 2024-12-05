<?php
class Travelfic_Toolkit_IconWithText extends \Elementor\Widget_Base
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
        return 'tft-icon-with-text';
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
        return esc_html__('Travelfic Icon With Text', 'travelfic-toolkit');
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
        return 'eicon-info-box';
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
        return ['travelfic', 'icon', 'icon with text', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-icon-text'];
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
            'icon_with_text',
            [
                'label' => __('Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'tft_icon_style',
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
            'sec_bg_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Background Image', 'travelfic-toolkit'),
                'condition' => [
                    'tft_icon_style' => ['design-2'],
                ],
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/work-bg.png',
                ],
            ]
        );
        $this->add_control(
            'sec_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Work Process', 'travelfic-toolkit'),
                'condition' => [
                    'tft_icon_style' => ['design-2'],
                ],
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('How IT Works', 'travelfic-toolkit'),
                'condition' => [
                    'tft_icon_style' => ['design-2'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'box_image',
            [
                'label'   => __('Image', 'travelfic-toolkit'),
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
            'box_icon',
            [
                'label'   => __('Icon', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'tft_icon_style' => 'design-1',
                ],
            ]
        );
        $repeater->add_control(
            'box_title',
            [
                'label'       => __('Title', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Your Heading Text Here', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'box_details',
            [
                'label'       => __('Descriptions', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'active_gap',
            [
                'label'        => __('Active Gap Item', 'travelfic-toolkit'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'travelfic-toolkit'),
                'label_off'    => __('No', 'travelfic-toolkit'),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'tft_icon_style' => ['design-1'],
                ]
            ]
        );
        $this->add_control(
            'icon_text_list',
            [
                'label'       => __('Repeater List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ box_title }}}',
            ]
        );

        $this->add_control(
            'items_gap',
            [
                'label'   => __('Middle item gap', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 70,
                'condition' => [
                    'tft_icon_style' => ['design-1'],
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'icon_text_style_section',
            [
                'label' => __('Item List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_text_card',
            [
                'label'     => __('Card Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'unit' => 'px',
                    'top' => 80,
                    'right' => 0,
                    'bottom' => 40,
                    'left' => 0,
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-single-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'list_card_bg_color',
            [
                'label'     => __('List Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-items .tft-icon-text-single' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_card_bg_color_hover',
            [
                'label'     => __('List Background Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-items .tft-icon-text-single:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_id',
            [
                'label'     => __('Icon Style', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );


        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size)', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 46, // Your default value here
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_outter_width',
            [
                'label'     => __('Icon outter Width', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 126,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .icon_outter' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_outter_height',
            [
                'label'     => __('Icon outter height', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 126,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .icon_outter' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Icon Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Icon Color Hover', 'plugin-domain'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-single:hover .tft-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_outter_gradient_1',
            [
                'label'   => __('Icon Outter Gradient 1', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF4E18',
            ]
        );
        $this->add_control(
            'icon_color_outter_gradient_2',
            [
                'label'   => __('Icon Outter Gradient 2', 'travelfic-toolkit'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '#F88664',
            ]
        );

        $this->add_control(
            'heading_id',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon-text_title',
                'selector' => '{{WRAPPER}} .tft-icon-text-wrapper .tft-title',
                'label'    => __('Title Style', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3BCC',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Title Color Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-single:hover .tft-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'content_id',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon-text_content',
                'selector' => '{{WRAPPER}} .tft-icon-text-wrapper .tft-details',
                'label'    => __('Content Style', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label'     => __('Content Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3BCC',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-single .tft-details' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'content_color_hover',
            [
                'label'     => __('Content Color Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-icon-text-wrapper .tft-icon-text-single:hover .tft-details' => 'color: {{VALUE}}',
                ],
            ]
        );
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['tft_icon_style'])) {
            $tft_design = $settings['tft_icon_style'];
        }
        if (!empty($settings['sec_bg_image'])) {
            $tft_sec_bg_image = $settings['sec_bg_image'] ?: '';
        }
        if (!empty($settings['sec_title'])) {
            $tft_sec_title = $settings['sec_title'];
        }
        if (!empty($settings['sec_subtitle'])) {
            $tft_sec_subtitle = $settings['sec_subtitle'];
        }
        $iconGradientOne = $settings['icon_color_outter_gradient_1'];
        $iconGradientTwo = $settings['icon_color_outter_gradient_2'];
?>

        <?php if ($settings['icon_text_list'] && "design-2" == $tft_design) : ?>
            <div class="tft-icon-design-2 tft-no-reapeat tft-customizer-typography tft-section-space" style="background-image: url(<?php echo esc_url($tft_sec_bg_image['url']); ?>)">
                <div class="container">
                    <div class="tft-heading-content">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }
                        if (!empty($tft_sec_title)) { ?>
                            <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="tft-icon-text-items tft-section-space-bottom">
                        <?php foreach ($settings['icon_text_list'] as $item): ?>
                            <div class="tft-icon-text-single">
                                <div class="tft-icon-text-single-inner tft-center">
                                    <div class="icon_outter">
                                        <?php if (!empty($item['box_image']['url'])) : ?>
                                            <div class="img-box">
                                                <img src="<?php echo esc_url($item['box_image']['url']); ?> " alt="">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="tft-title">
                                        <?php echo esc_html($item['box_title']); ?>
                                    </h3>
                                    <p class="tft-details">
                                        <?php echo esc_html($item['box_details']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php elseif ($settings['icon_text_list']): ?>
            <div class="tft-icon-text-wrapper tft-customizer-typography">
                <div class="tft-icon-text-items tft-flex">
                    <?php foreach ($settings['icon_text_list'] as $item): ?>

                        <div class="tft-icon-text-single" <?php if ($item['active_gap'] == 'yes'): ?>
                            style="margin-top:<?php echo esc_html($settings['items_gap']); ?>px;" <?php else: ?>
                            style="margin-bottom:<?php echo esc_html($settings['items_gap']); ?>px;" <?php endif ?>>
                            <div class="tft-icon-text-single-inner tft-center">
                                <div class="icon_outter"
                                    style="background: radial-gradient(52.1% 52.66% at 80.79% 21.03%, <?php echo esc_attr($iconGradientOne); ?> 6.09%, <?php echo esc_attr($iconGradientTwo); ?> 100%);">
                                    <?php
                                    if (!empty($item['box_image']['url'])) : ?>
                                        <img src="<?php echo esc_url($item['box_image']['url']); ?> " alt="">
                                        <?php else :
                                        if (!empty($item['box_icon']['value'])) : ?>
                                            <div class="tft-icon">
                                                <?php \Elementor\Icons_Manager::render_icon($item['box_icon'], ['aria-hidden' => 'true']); ?>
                                            </div>
                                    <?php endif;
                                    endif;
                                    ?>
                                </div>
                                <h3 class="tft-title">
                                    <?php echo esc_html($item['box_title']); ?>
                                </h3>
                                <p class="tft-details">
                                    <?php echo esc_html($item['box_details']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif ?>
<?php
    }
}
