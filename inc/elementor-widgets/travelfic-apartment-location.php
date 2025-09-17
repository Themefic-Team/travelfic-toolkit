<?php
class Travelfic_Toolkit_ApartmentLocation extends \Elementor\Widget_Base
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
        return 'tft-aprtments-locations';
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
        return esc_html__('Travelfic Apartment Location', 'travelfic-toolkit');
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
        return 'eicon-google-maps';
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
        return ['travelfic', 'locations', 'apartments', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-tour-destination'];
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
            'apartments_locations',
            [
                'label' => __('Apartment Location', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Tour
        $categories = get_categories(array(
            'taxonomy'   => 'apartment_location',
            'hide_empty' => true,
        ));
        $category_options = array();
        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }
        // Design
        $this->add_control(
            'aprt_location_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Design', 'travelfic-toolkit'),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __('Design 1', 'travelfic-toolkit'),
                    'design-2'  => __('Design 2', 'travelfic-toolkit'),
                ],
            ]
        );
        // Design 2 fields
        $this->add_control(
            'location_section_bg',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Section Background', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL . 'assets/app/img/destination-bg.png',
                ],
            ]
        );
        $this->add_control(
            'des_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'label_block' => true,
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Next level of living', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'des_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'label_block' => true,
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Destinations', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        // Tour
        $this->add_control(
            'categories_id',
            [
                'label' => __('Select Apartment Location', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $category_options,
                'default' => '',
                'multiple' => true,
                'label_block' => true,
                'separator'   => 'after',
            ]
        );

        $this->add_control(
            'post_per_page',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __('Item Limit', 'travelfic-toolkit'),
                'placeholder' => __('Post Per Page', 'travelfic-toolkit'),
                'default'     => 4,
            ]
        );

        // 
        $this->add_control(
            'cat_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Order', 'travelfic-toolkit'),
                'default' => 'DESC',
                'options' => [
                    'DESC' => __('Descending', 'travelfic-toolkit'),
                    'ASC'  => __('Ascending', 'travelfic-toolkit'),
                ],
            ]
        );
        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'apartments_locations_style',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'apartments_locations_image_border_radius',
            [
                'label'      => __('Image Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );

        $this->add_control(
            'apartments_locations_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'apartments_locations_title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a',
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_title_color_hover',
            [
                'label'     => __('Hover', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__one .tft-destination-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-1',
                ],
            ]
        );


        // Design 2 Styles start
        $this->add_control(
            'apartments_locations_design_2_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'apartments_locations_sec_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-destination-header h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_sec_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-destination-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_design_2_subtitle_head',
            [
                'label'     => __('Subtitle', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'apartments_locations_sec_subtitle_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_sec_subtitle_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-heading-content .tft-section-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartments_locations_design_2_card_head',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_responsive_control(
            'apartment_location_card_padding',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3, #tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'apartment_destination_card_opacity',
            [
                'label'     => __('Overley', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two  .tft-single-destination .tft-destination-thumbnail::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_title_head',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_title_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_head',
            [
                'label'     => __('Button', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_button_typo',
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'single_destination_button_margin_',
            [
                'label'      => __('Margin', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_responsive_control(
            'single_destination_button_padding_',
            [
                'label'      => __('Padding', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'about_button_border_',
                'label'    => __('Border', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'about_button_border_radius_',
            [
                'label' => __( 'Border Radius', 'travelfic-toolkit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->start_controls_tabs('single_destination_button_tabs_');

        $this->start_controls_tab(
            'single_destination_button_normal_',
            [
                'label' => __('Normal', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        
        

        $this->end_controls_tab();

        $this->start_controls_tab(
            'single_destination_button_hover_',
            [
                'label' => __('Hover', 'travelfic-toolkit'),
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_hover_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'color: {{VALUE}}',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_hover_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_hover_border',
            [
                'label'     => __('Border', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-single-destination .tft-destination-content span:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();

      
        $this->add_control(
            'apartments_locations_design_2_arrows_head',
            [
                'label'     => __('Arrows', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ]
            ]
        );
        $this->add_control(
            'single_destination_arrows_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-destination-design__two .tft-destination-content .tft-destination-slides .slick-arrow path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'aprt_location_style' => 'design-2',
                ],
            ]
        );
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['cat_order'])) {
            $order = $settings['cat_order'];
        }
        if (!empty($settings['post_per_page'])) {
            $post_per_page = $settings['post_per_page'];
        }
        if (!empty($settings['categories_id'])) {
            $cat_ids = $settings['categories_id'];
            intval($cat_ids);
        } else {
            $cat_ids = $settings['categories_id'];
        }

        // Design
        if (!empty($settings['aprt_location_style'])) {
            $tft_design = $settings['aprt_location_style'];
        }

        if (!empty($settings['des_title'])) {
            $tft_sec_title = $settings['des_title'];
        }
        if (!empty($settings['des_subtitle'])) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }
        if (!empty($settings['location_section_bg'])) {
            $tft_location_section_bg = $settings['location_section_bg'];
        }
        $taxonomy = 'apartment_location';
        $show_count = 0;
        $orderby = 'name';
        $pad_counts = 0;
        $hierarchical = 1;
        $title = '';
        $empty = 0;
        $included = $cat_ids;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'order'        => $order,
            'number' => $post_per_page,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'include'      => $included,
            'hide_empty'   => $empty,
        );
        $all_categories = get_categories($args);
        if ("design-1" == $tft_design) {
?>

            <div class="tft-destination-design__one tft-customizer-typography">
                <div class="tft-destination tft-row">
                    <?php
                    foreach ($all_categories as $cat) {
                        if ($cat->category_parent == 0) {
                            $category_id = $cat->term_id;
                            $meta = get_term_meta($cat->term_id, 'tf_apartments_locations', true);
                            if (!empty($meta['image'])) {
                                $cat_image = $meta['image'];
                            } else {
                                $cat_image = TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
                            }
                    ?>
                            <div class="tft-single-destination tft-col">
                                <div class="tft-destination-thumbnail tft-thumbnail">
                                    <a href="<?php echo esc_url(get_term_link($cat->slug, 'apartment_location')); ?>"><img src="<?php echo esc_url($cat_image); ?>" alt="<?php esc_html_e("Tour Destination Image", "travelfic-toolkit"); ?>"></a>
                                </div>
                                <div class="tft-destination-title">
                                    <?php echo '<a href="' . esc_url(get_term_link($cat->slug, 'apartment_location')) . '">' . esc_html($cat->name) . '</a>'; ?>
                                </div>

                                <div class="tft-destination-details">
                                    <div class="tft-destination-details">
                                        <ul>
                                            <?php
                                            $args2 = array(
                                                'taxonomy'     => $taxonomy,
                                                'child_of'     => 0,
                                                'parent'       => $category_id,
                                                'orderby'      => $orderby,
                                                'show_count'   => $show_count,
                                                'pad_counts'   => $pad_counts,
                                                'hierarchical' => $hierarchical,
                                                'title_li'     => $title,
                                                'hide_empty'   => $empty,
                                            );
                                            $sub_cats = get_categories($args2);
                                            if ($sub_cats) {
                                                foreach ($sub_cats as $sub_category) { ?>
                                                    <li><a href="<?php echo esc_url(get_term_link($sub_category->slug, 'apartments_locations')); ?>"><?php echo esc_html($sub_category->name); ?></a></li>
                                            <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    <?php } else {
                        }
                    } ?>
                </div>
            </div>
        <?php } elseif ("design-2" == $tft_design) { ?>
            <div class="tft-destination-design__two" style="background-image: url(<?php echo !empty($tft_location_section_bg['url']) ? esc_url($tft_location_section_bg['url']) : ''; ?>);">
                <div class="tft-destination-header">
                    <div class="tft-heading-content">
                        <?php 
                        if(!empty($tft_sec_subtitle)){ ?>
                            <h3 class="tft-section-subtitle"><?php echo esc_html($tft_sec_subtitle); ?></h3>
                        <?php }
                        if(!empty($tft_sec_title)){
                        ?>
                        <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                        <?php } ?>
                    </div>
                    <div class="tft-apartment-location-slider-arrows">
                        <button type="button" class="slick-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
                                <path d="M7.82843 11.0009H44V13.0009H7.82843L13.1924 18.3648L11.7782 19.779L4 12.0009L11.7782 4.22266L13.1924 5.63687L7.82843 11.0009Z" fill="#B58E53"/>
                            </svg>
                        </button>
                        <button type="button" class="slick-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none">
                                <path d="M40.1716 11.0009H4V13.0009H40.1716L34.8076 18.3648L36.2218 19.779L44 12.0009L36.2218 4.22266L34.8076 5.63687L40.1716 11.0009Z" fill="#B58E53"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <?php $rand_number = wp_rand(8, 10); ?>
                <div class="tft-destination-content">
                    <div class="tft-destination-slides tft-apart-destination-slide-<?php echo esc_attr($rand_number); ?>">
                        <?php
                        foreach ($all_categories as $cat) {
                            if ($cat->category_parent == 0) {
                                $category_id = $cat->term_id;
                                $meta = get_term_meta($cat->term_id, 'tf_apartments_locations', true);
                                if (!empty($meta['image'])) {
                                    $cat_image = $meta['image'];
                                } else {
                                    $cat_image = 'https://theme-demo.themefic.com/wp-content/uploads/2025/01/placeholder-450x600-1.jpg';
                                }
                        ?>
                                <div class="tft-single-destination">
                                    <div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url($cat_image); ?>);">
                                        <a href="<?php echo esc_url(get_term_link($cat->slug, 'apartment_location')); ?>" class="tft-destination-content">
                                            <h3><?php echo esc_html($cat->name); ?></h3>
                                            <span class="tft-w-100 tft-btn tft-wh-auto tft-btn_sharp tft-gap-0">
                                                <?php echo esc_html_e("Explore now", "travelfic-toolkit"); ?>
                                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="content">
                                                        <path id="Vector" d="M17.0001 6L1.00012 6" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path id="Vector_2" d="M12.0003 11C12.0003 11 17.0002 7.31756 17.0002 5.99996C17.0003 4.68237 12.0002 1 12.0002 1" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                        <?php } else {
                            }
                        } ?>
                    </div>
                </div>
                <script>
                    // Destination Slider
                    (function($) {
                        $(document).ready(function() {
                            //Your Code Inside
                            $('.tft-apart-destination-slide-<?php echo esc_attr($rand_number); ?>').slick({
                                dots: false,
                                arrows: true,
                                infinite: true,
                                speed: 300,
                                autoplaySpeed: 2000,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                prevArrow:'.tft-apartment-location-slider-arrows .slick-prev',
            	                nextArrow:'.tft-apartment-location-slider-arrows .slick-next',
                                responsive: [{
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1,
                                            infinite: true,
                                        }
                                    },
                                    {
                                        breakpoint: 580,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                        }
                                    }
                                ]
                            });
                        });

                    }(jQuery));
                </script>
            </div>
        <?php } ?>
<?php
    }
}
