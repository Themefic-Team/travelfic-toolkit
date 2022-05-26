<?php
class Destinaions extends \Elementor\Widget_Base{

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
        return 'tf-destinations-tours';
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
        return esc_html__( 'TFT Tour Destinations', 'travelfic' );
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
                'label' => esc_html__( 'Destinations', 'travelfic' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Order
        $this->add_control(
            'categories_id',
            [
                'label'       => esc_html__( 'Destinaions ID', 'travelfic' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( ' ', 'travelfic' ),
                'placeholder' => esc_html__( '10, 14', 'travelfic' ),
                'description' => esc_html( 'Separet ID by comma(,)' ),
                'separator'   => 'after',
            ]
        );

        // Order
        $this->add_control(
            'cat_order',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __( 'Order', 'travelfic' ),
                'default' => 'DESC',
                'options' => [
                    'DESC' => __( 'Descending', 'travelfic' ),
                    'ASC'  => __( 'Ascending', 'travelfic' ),
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( !empty( $settings['cat_order'] ) ) {
            $order = $settings['cat_order'];
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
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'include'      => $included,
            'hide_empty'   => $empty,
        );
        $all_categories = get_categories( $args );

        ?>

	<div class="tft-destination-wrapper">
    	<div class="tft-destination tft-row">
        <?php

        foreach ( $all_categories as $cat ) {
            if ( $cat->category_parent == 0 ) {
                $category_id = $cat->term_id;
                $meta = get_term_meta( $cat->term_id, 'tour_destination', true );
                if(isset($meta['image']['url'])){
                    $cat_image = $meta['image']['url'];
                } else{
                    $cat_image = '';
                }
                
            ?>

            <div class="tft-single-destination tft-col">
                <div class="tft-destination-thumbnail tft-thumbnail">
                    <a href="<?php echo get_term_link( $cat->slug, 'tour_destination' ); ?>"><img src="<?php echo $cat_image; ?>" alt=""></a>
                </div>
                <div class="tft-destination-title">
                    <a href="#"><?php echo '<a href="' . get_term_link( $cat->slug, 'tour_destination' ) . '">' . $cat->name . '</a>'; ?></a>
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
                            foreach ( $sub_cats as $sub_category ) { ?>
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