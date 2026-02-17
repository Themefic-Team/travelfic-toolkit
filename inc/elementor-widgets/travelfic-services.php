<?php
class Travelfic_Toolkit_Services extends \Elementor\Widget_Base
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
        return 'tft-services';
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
        return esc_html__('Travelfic Services', 'travelfic-toolkit');
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
        return ['travelfic', 'services', 'tft'];
    }
    public function get_style_depends()
    {
        return ['travelfic-toolkit-services'];
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
            'tft-services',
            [
                'label' => __('Service Items', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Design
        $this->add_control(
            'service_style',
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
                'default' => __('Checkout our awesome services', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'section_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Services', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'see_all_link',
            [
                'type' => \Elementor\Controls_Manager::URL,
                'label' => esc_html__('See ALL URL', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter Link', 'travelfic-toolkit'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
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
                'default'     => __('Our trained and experienced staff is capable of handling a number of pool services', 'travelfic-toolkit'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'services_section',
            [
                'label'       => __('Services List', 'travelfic-toolkit'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
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
            'tft_services_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_services_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-service-sec-header .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'tft_services_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-service-sec-header .tft-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tft_services_sub_title_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tft_services_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-service-sec-header .tft-section-subtitle',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'tft_services_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-service-sec-header .tft-section-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'services_style_section',
            [
                'label' => __('Item List', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'services_card_head',
            [
                'label'     => __('List', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'services_card_color',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'services_card_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'services_card_color_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service.active' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'services_tour_item_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'services_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_title',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );

        $this->add_control(
            'services_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'services_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'services_title_color_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service.active h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'services_content_head',
            [
                'label'     => __('Content', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'services_content',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service p',
                'label'    => __('Typography', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'services_content_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'services_content_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service:hover p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'services_content_color_active',
            [
                'label'     => __('Active', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-items .tft-services-items-left .tft-single-service.active p' => 'color: {{VALUE}}',
                ],
            ]
        );
        // $this->add_control(
        //     'services_icon_head',
        //     [
        //         'label'     => __('Icon', 'travelfic-toolkit'),
        //         'type'      => \Elementor\Controls_Manager::HEADING,
        //         'separator' => 'after',
        //     ]
        // );
        // $this->add_control(
        //     'services_icon_color',
        //     [
        //         'label'     => __('Color', 'travelfic-toolkit'),
        //         'type'      => \Elementor\Controls_Manager::COLOR,
        //         'selectors' => [
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .service-footer i' => 'color: {{VALUE}}',
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .service-footer i' => 'color: {{VALUE}}',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'services_icon_color_hover',
        //     [
        //         'label'     => __('Hover', 'travelfic-toolkit'),
        //         'type'      => \Elementor\Controls_Manager::COLOR,
        //         'selectors' => [
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__one .tft-services-inner:hover .service-footer i' => 'color: {{VALUE}}',
        //             '#tft-site-main-body #page {{WRAPPER}} .tft-services-design__four .tft-services-inner:hover .service-footer i' => 'color: {{VALUE}}',
        //         ],
        //     ]
        // );
     
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        // Design
        if (!empty($settings['service_style'])) {
            $tft_design = $settings['service_style'];
        }

        if (!empty($settings['section_title'])) {
            $tft_sec_title = $settings['section_title'];
        }
        if (!empty($settings['section_subtitle'])) {
            $tft_sec_subtitle = $settings['section_subtitle'];
        }
        
        if ($settings['services_section'] && "design-1" == $tft_design) { ?>

            <div class="tft-services-design__one">
                <div class="tft-service-sec-header">
                    <div class="tft-service-header-left">
                        <?php if (!empty($tft_sec_subtitle)) { ?>
                            <h3 class="tft-section-subtitle"><?php echo wp_kses_post($tft_sec_subtitle); ?></h3>
                        <?php } if (!empty($tft_sec_title)) {?>
                            <h2 class="tft-section-title"><?php echo wp_kses_post($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="read-more">
                        <a href="<?php echo esc_url($settings['see_all_link']['url']); ?>" class="tft-btn tft-btn-transparent tft-flex-column">
                            <?php esc_html_e("More Services", "travelfic-toolkit"); ?>
                        </a>
                    </div>
                </div>
                
                <div class="tft-services-items">
                    <div class="tft-services-items-left">
                        <?php foreach ($settings['services_section'] as $key => $item) : ?>
                            <div class="tft-single-service<?php echo ( 0 === intval( $key ) ) ? ' active' : ''; ?>" id="tft-service-<?php echo esc_attr($key); ?>">
                                <?php if (!empty($item['icon']['value'])) : ?>
                                <div class="tft-service-icon">
                                    <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                                <?php endif; ?>
                                <div class="tft-single-service-right">
                                    <h3><?php echo esc_html($item['title']) ?></h3>
                                    <p><?php echo wp_kses_post($item['description']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tft-services-items-right">
                        <?php foreach ($settings['services_section'] as $key => $item) : ?>
                            <div class="tft-single-service-image<?php echo ( 0 === intval( $key ) ) ? ' active' : ''; ?>" data-id="#tft-service-<?php echo esc_attr($key); ?>">
                                <?php if (!empty($item['image']['url'])) { ?>
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="Image">
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <script>
                (function($) {
                    $(document).ready(function() {
                        // Ensure only the active image is visible on load
                        $('.tft-single-service-image').hide();
                        $('.tft-single-service-image.active').show();

                        // When a service on the left is clicked, activate it and show its image
                        $('.tft-services-items-left').on('click', '.tft-single-service', function(e) {
                            e.preventDefault();
                            var $this = $(this);
                            var id = '#' + $this.attr('id');

                            // activate left items
                            $('.tft-services-items-left .tft-single-service').removeClass('active');
                            $this.addClass('active');

                            // show corresponding image
                            $('.tft-services-items-right .tft-single-service-image').removeClass('active').hide();
                            $('.tft-services-items-right .tft-single-service-image[data-id="' + id + '"]').addClass('active').show();
                        });
                    });
                }(jQuery));
            </script>
        <?php 
        } 
    }
}
