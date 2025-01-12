<?php
class Travelfic_Toolkit_HotelLocation extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * Retrieve  widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'tft-locations-hotel';
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
    public function get_title() {
        return esc_html__( 'Travelfic Hotel Location', 'travelfic-toolkit' );
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
    public function get_icon() {
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
    public function get_custom_help_url() {
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
    public function get_categories() {
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
    public function get_keywords() {
        return ['travelfic', 'locations', 'hotels', 'tft'];
    }

    public function get_style_depends(){
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
    protected function register_controls() {
        
        $this->start_controls_section(
            'hotel_location',
            [
                'label' => __( 'Hotel Locations', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Tour
        $categories = get_categories( array(
            'taxonomy'   => 'hotel_location',
            'hide_empty' => true,
        ) );
        $category_options = array();
        foreach ( $categories as $category ) {
            $category_options[$category->term_id] = $category->name;
        }
        // Design
        $this->add_control(
            'hotel_location_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Design', 'travelfic-toolkit' ),
                'default' => 'design-1',
                'options' => [
                    'design-1' => __( 'Design 1', 'travelfic-toolkit' ),
                    'design-2'  => __( 'Design 2', 'travelfic-toolkit' ),
                ],
            ]
        );
        // Design 2 fields
        $this->add_control(
			'location_section_bg',
			[
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Section Background', 'travelfic-toolkit' ),
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
                'default' => [
                    'url' => TRAVELFIC_TOOLKIT_URL.'assets/app/img/destination-bg.png',
                ],
			]
		);
        $this->add_control(
			'des_title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
                'default' => __( 'Top Hotel Locations', 'travelfic-toolkit' ),
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
			]
		);
        $this->add_control(
			'des_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'Locations', 'travelfic-toolkit' ),
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
			]
		);

        // Hotel
        $this->add_control(
            'hotel_categories_id',
            [
                'label' => __( 'Select Hotel Location', 'travelfic-toolkit' ),
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
                'label'       => __( 'Item Limit', 'travelfic-toolkit' ),
                'placeholder' => __( 'Post Per Page', 'travelfic-toolkit' ),
                'default'     => 4,
            ]
        );

        // 
        $this->add_control(
            'hotel_cat_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Order', 'travelfic-toolkit' ),
                'default' => 'DESC',
                'options' => [
                    'DESC' => __( 'Descending', 'travelfic-toolkit' ),
                    'ASC'  => __( 'Ascending', 'travelfic-toolkit' ),
                ],
            ]
        );
        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'tour_destination_style',
            [
                'label' => __( 'Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'tour_destination_image_border_radius',
            [
                'label'      => __( 'Image Radius', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_header',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        // Design 2 Styles start
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sec_title_typo',
                'selector' => '{{WRAPPER}} .tft-location-design-2 .tft-destination-header h3',
                'label'    => __( 'Section Title Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sec_title_color',
            [
                'label'     => __( 'Section Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-location-design-2 .tft-destination-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sec_subtitle_typo',
                'selector' => '{{WRAPPER}} .tft-location-design-2 .tft-destination-header h6',
                'label'    => __( 'Section Subtitle Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sec_subtitle_color',
            [
                'label'     => __( 'Section Subtitle Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-location-design-2 .tft-destination-header h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_responsive_control(
            'single_destination_card_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3, {{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when blog_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'single_destination_card_opacity',
            [
                'label'     => __( 'Card Overley Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, .4)',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_title_typo',
                'selector' => '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3',
                'label'    => __( 'Single Destination Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Cormorant Garamond',
                    ],
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'single_destination_title_color',
            [
                'label'     => __( 'Single Destination Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'single_destination_button_typo',
                'selector' => '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span',
                'label'    => __( 'Single Button Typography', 'travelfic-toolkit' ),
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Josefin Sans',
                    ],
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );
        $this->add_control(
            'single_destination_button_color',
            [
                'label'     => __( 'Destination Button Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'single_location_button_bg',
            [
                'label'     => __( 'Destination Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_hovers_color',
            [
                'label'     => __( 'Destination Button Hover Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FDF9F3',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover svg path' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'single_location_button_hovers_bg',
            [
                'label'     => __( 'Destination Button Hover Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#917242',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-thumbnail .tft-destination-content span:hover' => 'background: {{VALUE}} !important',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-2', // Show this control only when hotel_location_style is 'design-2'
                ],
            ]
        );

        // Design 2 Styles end

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_title',
                'label'    => __( 'Destination List', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-destination-wrapper .tft-destination-title a',
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_title_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_title_color_hover',
            [
                'label'     => __( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-1'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sub_list',
                'label'    => __( 'Destination Sub List', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-destination-wrapper .tft-destination-details ul li a',
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sub_list_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-details ul li a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-1'
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sub_list_color_hover',
            [
                'label'     => __( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-details ul li a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hotel_location_style' => 'design-1', // Show this control only when hotel_location_style is 'design-1'
                ],
            ]
        );


    }

   
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( !empty( $settings['hotel_cat_order'] ) ) {
            $order = $settings['hotel_cat_order'];
        }
        if ( !empty( $settings['post_per_page'] ) ) {
            $post_per_page = $settings['post_per_page'];
        }
        if ( !empty( $settings['hotel_categories_id'] ) ) {
            $cat_ids = $settings['hotel_categories_id'];
            intval( $cat_ids );
        } else {
            $cat_ids = $settings['hotel_categories_id'];
        }

        // Design
        if ( !empty( $settings['hotel_location_style'] ) ) {
            $tft_design = $settings['hotel_location_style'];
        }

        if ( !empty( $settings['des_title'] ) ) {
            $tft_sec_title = $settings['des_title'];
        }
        if ( !empty( $settings['des_subtitle'] ) ) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }
        if ( !empty( $settings['location_section_bg'] ) ) {
            $tft_location_section_bg = $settings['location_section_bg'];
        }
        $taxonomy = 'hotel_location';
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
            'number'=> $post_per_page,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'include'      => $included,
            'hide_empty'   => $empty,
        );
        $all_categories = get_categories( $args );
    if("design-1"==$tft_design){
    ?>

	<div class="tft-destination-wrapper tft-customizer-typography">
    	<div class="tft-destination tft-row">
            <?php
            foreach ( $all_categories as $cat ) {
                if ( $cat->category_parent == 0 ) {
                    $category_id = $cat->term_id;
                    $meta = get_term_meta( $cat->term_id, 'tf_hotel_location', true );
                    if(!empty($meta['image'])){
                        $cat_image = $meta['image'];
                    } else{
                        $cat_image = TRAVELFIC_TOOLKIT_URL.'assets/app/img/feature-default.jpg';
                    }
                ?>
                <div class="tft-single-destination tft-col">
                    <div class="tft-destination-thumbnail tft-thumbnail">
                        <a href="<?php echo esc_url(get_term_link( $cat->slug, 'hotel_location' )); ?>"><img src="<?php echo esc_url($cat_image); ?>" alt="<?php esc_html_e("Hotel Location Image", "travelfic-toolkit"); ?>"></a>
                    </div>
                    <div class="tft-destination-title">
                        <?php echo '<a href="' . esc_url(get_term_link( $cat->slug, 'hotel_location' )) . '">' . esc_html($cat->name) . '</a>'; ?>
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
                            $sub_cats = get_categories( $args2 );
                            if ( $sub_cats ) {
                                foreach ( $sub_cats as $sub_category ) {?>
                                    <li><a href="<?php echo esc_url(get_term_link( $sub_category->slug, 'hotel_location' )); ?>"><?php echo esc_html( $sub_category->name ); ?></a></li>
                                <?php }
                            }?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } else{
                
            } } ?>
        </div>
    </div>
    <?php }elseif("design-2"==$tft_design){ ?>
    <div class="tft-destination-design-2 tft-location-design-2" style="background-image: url(<?php echo !empty($tft_location_section_bg['url']) ? esc_url( $tft_location_section_bg['url'] ) : ''; ?>);">
        <div class="tft-destination-header">
            <?php 
            if(!empty($tft_sec_subtitle)){ ?>
                <h6><?php echo esc_html($tft_sec_subtitle); ?></h6>
            <?php }
            if(!empty($tft_sec_title)){
            ?>
            <h3><?php echo esc_html($tft_sec_title); ?></h3>
            <?php } ?>
        </div>
        <?php $rand_number = wp_rand(8,10);?>
        <div class="tft-destination-content">
            <div class="tft-destination-slides tft-locations-slide-<?php echo esc_attr($rand_number); ?>">
                <?php
                foreach ( $all_categories as $cat ) {
                    if ( $cat->category_parent == 0 ) {
                        $category_id = $cat->term_id;
                        $meta = get_term_meta( $cat->term_id, 'tf_hotel_location', true );
                        if(!empty($meta['image'])){
                            $cat_image = $meta['image'];
                        } else{
                            $cat_image = 'https://theme-demo.themefic.com/wp-content/uploads/2025/01/placeholder-450x600-1.jpg';
                        }
                    ?>
                    <div class="tft-single-destination">
                        <div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url($cat_image); ?>);">
                            <a href="<?php echo esc_url(get_term_link( $cat->slug, 'hotel_location' )); ?>" class="tft-destination-content">
                                <h3><?php echo esc_html($cat->name); ?></h3>
                                <span>
                                    <?php echo esc_html_e("Explore now", "travelfic-toolkit"); ?>
                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="content">
                                    <path id="Vector" d="M17.0001 6L1.00012 6" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path id="Vector_2" d="M12.0003 11C12.0003 11 17.0002 7.31756 17.0002 5.99996C17.0003 4.68237 12.0002 1 12.0002 1" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php } else{
                    
                } } ?>
            </div>
        </div>
        <script>
            // Destination Slider
            (function($) {
                $(document).ready(function() {
                    //Your Code Inside
                    $('.tft-locations-slide-<?php echo esc_attr($rand_number); ?>').slick({
                        dots: false,
                        arrows: true,
                        infinite: true,
                        speed: 300,
                        autoplaySpeed: 2000,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        centerMode: <?php echo !empty($all_categories) && count($all_categories) > 3 ? 'true' : 'false' ?>,
                        prevArrow:'<button type="button" class="slick-prev pull-left"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none"><path d="M7.82843 11.0009H44V13.0009H7.82843L13.1924 18.3648L11.7782 19.779L4 12.0009L11.7782 4.22266L13.1924 5.63687L7.82843 11.0009Z" fill="#B58E53"/></svg></button>',
            	        nextArrow:'<button type="button" class="slick-next pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 48 24" fill="none"><path d="M40.1716 11.0009H4V13.0009H40.1716L34.8076 18.3648L36.2218 19.779L44 12.0009L36.2218 4.22266L34.8076 5.63687L40.1716 11.0009Z" fill="#B58E53"/></svg></button>',
                        responsive: [
                            {
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