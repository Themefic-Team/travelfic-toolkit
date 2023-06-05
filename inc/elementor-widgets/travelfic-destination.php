<?php
class TourDestinaions extends \Elementor\Widget_Base{

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
        return 'tff-destinations-tours';
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
        return ['travelfic-tour-destination'];
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
                'label' => esc_html__( 'Tour Destinations', 'travelfic-toolkit' ),
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
                'label'       => esc_html__( 'Item Limit', 'travelfic-toolkit' ),
                'placeholder' => esc_html__( 'Post Per Page', 'travelfic-toolkit' ),
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
                'label' => esc_html__( 'Style', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'tour_destination_image_border_radius',
            [
                'label'      => esc_html__( 'Image Radius', 'travelfic-toolkit' ),
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
                'label'     => esc_html__( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_title',
                'label'    => esc_html__( 'Destination List', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-destination-wrapper .tft-destination-title a',
            ]
        );
        $this->add_control(
            'tour_destination_title_color',
            [
                'label'     => esc_html__( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tour_destination_title_color_hover',
            [
                'label'     => esc_html__( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tour_destination_sub_list',
                'label'    => esc_html__( 'Destination Sub List', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-destination-wrapper .tft-destination-details ul li a',
            ]
        );
        $this->add_control(
            'tour_destination_sub_list_color',
            [
                'label'     => esc_html__( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-details ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tour_destination_sub_list_color_hover',
            [
                'label'     => esc_html__( 'Hover', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-destination-wrapper .tft-destination-details ul li a:hover' => 'color: {{VALUE}}',
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
                    <a href="<?php echo get_term_link( $cat->slug, 'tour_destination' ); ?>"><img src="<?php echo $cat_image; ?>" alt=""></a>
                </div>
                <div class="tft-destination-title">
                    <?php echo '<a href="' . get_term_link( $cat->slug, 'tour_destination' ) . '">' . $cat->name . '</a>'; ?>
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
                                <li><a href="<?php echo get_term_link( $sub_category->slug, 'tour_destination' ); ?>"><?php echo $sub_category->name; ?></a></li>
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
<?php
}
}