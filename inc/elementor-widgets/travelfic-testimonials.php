<?php
class Testimonials extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'tft-testimonials';
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
    public function get_title() {
        return esc_html__( 'TFT Testimonials', 'travelfic-toolkit' );
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
    public function get_icon() {
        return 'eicon-testimonial-carousel';
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
    public function get_custom_help_url() {
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
    public function get_categories() {
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
    public function get_keywords() {
        return ['travelfic', 'reveiw', 'testimonials', 'tft'];
    }
    public function get_style_depends() {
        return ['travelfic-testimonials'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'tft-testimonials',
            [
                'label' => esc_html__( 'Slider Items', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater ();
        $repeater->add_control(
            'person_image', [
                'label'   => esc_html__( 'Image', 'travelfic-toolkit' ),
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
            'person_name', [
                'label'       => esc_html__( 'Name', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'John Doe', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'designation', [
                'label'       => esc_html__( 'Designation', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'CEO', 'travelfic-toolkit' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testimonials_review', [
                'label'   => __( 'Review Details', 'travelfic-toolkit' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', 'travelfic-toolkit' ),
            ]
        );
        $repeater->add_control(
            'rate',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Rattings', 'travelfic-toolkit' ),
                'default' => '5',
                'options' => [
                    '1' => __( '&#9733;', 'travelfic-toolkit' ),
                    '2' => __( '&#9733;&#9733;', 'travelfic-toolkit' ),
                    '3' => __( '&#9733;&#9733;&#9733;', 'travelfic-toolkit' ),
                    '4' => __( '&#9733;&#9733;&#9733;&#9733;', 'travelfic-toolkit' ),
                    '5' => __( '&#9733;&#9733;&#9733;&#9733;&#9733;', 'travelfic-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'testimonials_section',
            [
                'label'       => esc_html__( 'Testimonials List', 'travelfic-toolkit' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ person_name }}}',
            ]
        );
        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'testimonials_style_section',
            [
                'label' => esc_html__( 'Item List', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonials_card_head',
            [
                'label'     => esc_html__( 'List Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testimonials_card_color',
            [
                'label'     => esc_html__( 'List Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_card_border_rds',
            [
                'label'     => esc_html__( 'Border Radius', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_space_bellow',
            [
                'label'     => esc_html__( 'Title Space Bellow', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 28,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .testimonial-header' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonials_tour_item_card_padding',
            [
                'label'      => esc_html__( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'testimonials_title_head',
            [
                'label'     => esc_html__( 'Titile', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_title',
                'selector' => '{{WRAPPER}} .tft-testimonials-selector .person-name',
                'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
            ]
        );

        $this->add_control(
            'testimonials_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .person-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation',
            [
                'label'     => esc_html__( 'Designation', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_designation_typo',
                'selector' => '{{WRAPPER}} .tft-testimonials-selector .designation',
                'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
            ]
        );
        $this->add_control(
            'testimonials_designation_color',
            [
                'label'     => esc_html__( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .designation' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_head',
            [
                'label'     => esc_html__( 'Content', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_content',
                'selector' => '{{WRAPPER}} .tft-testimonials-selector .testimonial-body .tft-content',
                'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
            ]
        );
        $this->add_control(
            'testimonials_content_color',
            [
                'label'     => esc_html__( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .testimonial-body .tft-content' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_head',
            [
                'label'     => esc_html__( 'Icon', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testimonials_icon_color',
            [
                'label'     => esc_html__( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .testimonial-footer i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_hover',
            [
                'label'     => esc_html__( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testimonials_card_color_hover',
            [
                'label'     => esc_html__( 'List Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonials_title_color_hover',
            [
                'label'     => esc_html__( 'Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .person-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_designation_color_hover',
            [
                'label'     => esc_html__( 'Designation Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .designation' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_content_color_hover',
            [
                'label'     => esc_html__( 'Content Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .tft-content' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_color_hover',
            [
                'label'     => esc_html__( 'Icon Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-testimonials-selector .tft-testimonials-inner:hover .testimonial-footer i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonials_nav_style',
            [
                'label' => esc_html__( 'Nav Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_color',
            [
                'label'     => esc_html__( 'Icon Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-slide-default button.slick-arrow' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'testimonials_icon_nav_color_hover',
            [
                'label'     => esc_html__( 'Icon Color Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-slide-default button.slick-arrow:hover' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

    }

    private function testimonials_rattings( $rate ) {
        if ( $rate ) {
            for ( $i = 1; $i <= $rate; $i++ ) {
                echo '<i class="fas fa-star"></i>';
            }
        }
    }

    protected function render() {
    $settings = $this->get_settings_for_display();?>

    <?php if ( $settings['testimonials_section'] ): ?>
        <div class="tft-testimonials-wrapper tft-customizer-typography">
            <div class="tft-testimonials-selector tft-slide-default">
                <?php if ( $settings['testimonials_section'] ) {
                foreach ( $settings['testimonials_section'] as $item ) {?>
                    <div class="tft-single-testimonial">
                        <div class="tft-testimonials-inner">
                            <div class="testimonial-header">
                                <div class="person-avatar">
                                    <?php echo wp_get_attachment_image( $item['person_image']['id'], "team-image", "", array( "class" => "circle" ) ); ?>
                                </div>
                                <div class="person-info">
                                    <h4 class="person-name"><?php echo esc_html( $item['person_name'] ) ?></h4>
                                    <p class="designation"><?php echo esc_html( $item['designation'] ) ?></p>
                                </div>
                            </div>
                            <div class="testimonial-body">
                                <p class="tft-content"><?php echo esc_html( $item['testimonials_review'] ) ?></p>
                            </div>
                            <div class="testimonial-footer">
                                <?php $this->testimonials_rattings( $item['rate'] );?>
                            </div>
                        </div>
                    </div>
                <?php }
                }?>
            </div>
    </div>
    <?php endif; 
    }
}