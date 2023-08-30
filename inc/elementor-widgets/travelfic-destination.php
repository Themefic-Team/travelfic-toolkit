<?php
class Travelfic_Toolkit_TourDestinaions extends \Elementor\Widget_Base{

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
        return 'tft-destinations-tours';
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
        return esc_html__( 'TFT Tour Destinations', 'travelfic-toolkit' );
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
        return 'eicon-hotspot';
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
        return ['travelfic', 'destinaions', 'tours', 'tft'];
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
            'tour_destination',
            [
                'label' => __( 'Tour Destinations', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Tour
        $categories = get_categories( array(
            'taxonomy'   => 'tour_destination',
            'hide_empty' => true,
        ) );
        $category_options = array();
        foreach ( $categories as $category ) {
            $category_options[$category->term_id] = $category->name;
        }
        // Design
        $this->add_control(
            'des_style',
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
			'des_title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
                'default' => __( 'Top destinations', 'travelfic-toolkit' ),
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
			]
		);
        $this->add_control(
			'des_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'Destinations', 'travelfic-toolkit' ),
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
			]
		);

        // Tour
        $this->add_control(
            'categories_id',
            [
                'label' => __( 'Select Tour Destinations', 'travelfic-toolkit' ),
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
            'cat_order',
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
        $this->add_control(
            'tour_destination_sec_title_color',
            [
                'label'     => __( 'Section Title Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#595349',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-destination-header h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
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
                    '{{WRAPPER}} .tft-destination-design-2 .tft-destination-header h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
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
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
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
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-content a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
                ],
            ]
        );

        $this->add_control(
            'single_destination_button_bg',
            [
                'label'     => __( 'Destination Button Background', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#B58E53',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-design-2 .tft-single-destination .tft-destination-content a' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'des_style' => 'design-2', // Show this control only when des_style is 'design-2'
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
                    'des_style' => 'design-1', // Show this control only when des_style is 'design-1'
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
                    'des_style' => 'design-1', // Show this control only when des_style is 'design-1'
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
                    'des_style' => 'design-1', // Show this control only when des_style is 'design-1'
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
                    'des_style' => 'design-1', // Show this control only when des_style is 'design-1'
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
                    'des_style' => 'design-1', // Show this control only when des_style is 'design-1'
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
                    'des_style' => 'design-1', // Show this control only when des_style is 'design-1'
                ],
            ]
        );


    }

   
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( !empty( $settings['cat_order'] ) ) {
            $order = $settings['cat_order'];
        }
        if ( !empty( $settings['post_per_page'] ) ) {
            $post_per_page = $settings['post_per_page'];
        }
        if ( !empty( $settings['categories_id'] ) ) {
            $cat_ids = $settings['categories_id'];
            intval( $cat_ids );
        } else {
            $cat_ids = $settings['categories_id'];
        }

        // Design
        if ( !empty( $settings['des_style'] ) ) {
            $tft_design = $settings['des_style'];
        }

        if ( !empty( $settings['des_title'] ) ) {
            $tft_sec_title = $settings['des_title'];
        }
        if ( !empty( $settings['des_subtitle'] ) ) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }

        $taxonomy = 'tour_destination';
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
                    $meta = get_term_meta( $cat->term_id, 'tf_tour_destination', true );
                    if(isset($meta['image'])){
                        $cat_image = $meta['image'];
                    } else{
                        $cat_image = '';
                    }
                ?>
                <div class="tft-single-destination tft-col">
                    <div class="tft-destination-thumbnail tft-thumbnail">
                        <a href="<?php echo esc_url(get_term_link( $cat->slug, 'tour_destination' )); ?>"><img src="<?php echo esc_url($cat_image); ?>" alt=""></a>
                    </div>
                    <div class="tft-destination-title">
                        <?php echo '<a href="' . esc_url(get_term_link( $cat->slug, 'tour_destination' )) . '">' . esc_html($cat->name) . '</a>'; ?>
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
                                    <li><a href="<?php echo esc_url(get_term_link( $sub_category->slug, 'tour_destination' )); ?>"><?php echo esc_html( $sub_category->name ); ?></a></li>
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
    <div class="tft-destination-design-2 tft-l-padding" style="background-image: url(<?php echo esc_url( TRAVELFIC_TOOLKIT_URL.'assets/app/img/destination-bg.png' ); ?>);">
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
        <?php $rand_number = rand(8);?>
        <div class="tft-destination-content">
            <div class="tft-destination-slides tft-destination-slide-<?php echo $rand_number; ?>">
                <?php
                foreach ( $all_categories as $cat ) {
                    if ( $cat->category_parent == 0 ) {
                        $category_id = $cat->term_id;
                        $meta = get_term_meta( $cat->term_id, 'tf_tour_destination', true );
                        if(isset($meta['image'])){
                            $cat_image = $meta['image'];
                        } else{
                            $cat_image = '';
                        }
                    ?>
                    <div class="tft-single-destination">
                        <div class="tft-destination-thumbnail" style="background-image: url(<?php echo esc_url($cat_image); ?>);">
                            <div class="tft-destination-content">
                                <h3><?php echo esc_html($cat->name); ?></h3>
                                <a href="<?php echo esc_url(get_term_link( $cat->slug, 'tour_destination' )); ?>">
                                    <?php echo __("Explore now", "travelfic-toolkit"); ?>
                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="content">
                                    <path id="Vector" d="M17.0001 6L1.00012 6" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path id="Vector_2" d="M12.0003 11C12.0003 11 17.0002 7.31756 17.0002 5.99996C17.0003 4.68237 12.0002 1 12.0002 1" stroke="#FDF9F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                </a>
                            </div>
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
                    $('.tft-destination-slide-<?php echo $rand_number; ?>').slick({
                        dots: false,
                        arrows: true,
                        infinite: true,
                        speed: 300,
                        autoplaySpeed: 2000,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        centerMode: true,
                        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa-solid fa-arrow-left-long'></i></i></button>",
            	        nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa-solid fa-arrow-right-long'></i></button>",
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