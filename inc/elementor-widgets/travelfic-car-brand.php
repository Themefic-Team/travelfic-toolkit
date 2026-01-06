<?php
class Travelfic_Toolkit_CarBrands extends \Elementor\Widget_Base
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
        return 'tft-car-brands';
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
        return esc_html__('Travelfic Car Brands', 'travelfic-toolkit');
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
        return 'eicon-carousel';
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
        return ['travelfic', 'brand', 'cars', 'tft'];
    }

    public function get_style_depends()
    {
        return ['travelfic-toolkit-cars-brand'];
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
            'carrental_brand',
            [
                'label' => __('Car Brand', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Car
        $categories = get_categories(array(
            'taxonomy'   => 'carrental_brand',
            'hide_empty' => true,
        ));
        $category_options = array();
        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }

        $this->add_control(
            'des_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your title', 'travelfic-toolkit'),
                'default' => __('Popular by Rent', 'travelfic-toolkit'),
            ]
        );
        $this->add_control(
            'des_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('SubTitle', 'travelfic-toolkit'),
                'placeholder' => esc_html__('Enter your SubTitle', 'travelfic-toolkit'),
                'default' => __('Vivamus arcu felis bibendum ut tristique et egestas. Ultricies leo intege in malesuada nunc vel risus commodo. Sapien nec sagittis aliquam male bibendum arcu vitae. ', 'travelfic-toolkit'),
            ]
        );


        $this->add_control(
            'categories_id',
            [
                'label' => __('Select Car Brand', 'travelfic-toolkit'),
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

        // Style
        $this->add_control(
            'cat_style',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => __('Style', 'travelfic-toolkit'),
                'default' => 'slider',
                'options' => [
                    'slider' => __('Slider', 'travelfic-toolkit'),
                    'grid'  => __('Grid', 'travelfic-toolkit'),
                ],
            ]
        );

        // Order
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
            'tour_destination_style',
            [
                'label' => __('Style', 'travelfic-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
      
        $this->add_control(
            'car_brand_header',
            [
                'label'     => __('Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_car_item_title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-section-heading .tft-section-title',
            ]
        );
        $this->add_control(
            'popular_car_item_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-section-heading .tft-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popular_subtitle_head',
            [
                'label'     => __('Sub Title', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
      
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_car_item_sub_title',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-section-heading p',
            ]
        );
        $this->add_control(
            'popular_car_item_sub_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-section-heading p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popular_card_head',
            [
                'label'     => __('Card', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'tour_destination_image_border_radius',
            [
                'label'      => __('Image Radius', 'travelfic-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'], 
                'selectors'  => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_car_item_card_title_typo',
                'label'    => __('Typography', 'travelfic-toolkit'),
                'selector' => '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-brands-title a',
            ]
        );
        $this->add_control(
            'popular_car_item_card_title_bg',
            [
                'label'     => __('Background', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-brands-title a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'popular_car_item_card_title_color',
            [
                'label'     => __('Color', 'travelfic-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#tft-site-main-body #page {{WRAPPER}} .tft-brands-design__one .tft-brands-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        
    }


    protected function render()
    {
        $tf_disable_services = ! empty( travelfic_get_opt( 'disable-services' ) ) ? travelfic_get_opt( 'disable-services' ) : [];
		if (in_array('carrentals', $tf_disable_services)){
			return;
		}
        
        $settings = $this->get_settings_for_display();

        if (!empty($settings['cat_order'])) {
            $order = $settings['cat_order'];
        }

        if (!empty($settings['cat_style'])) {
            $style = $settings['cat_style'];
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

        if (!empty($settings['des_title'])) {
            $tft_sec_title = $settings['des_title'];
        }
        if (!empty($settings['des_subtitle'])) {
            $tft_sec_subtitle = $settings['des_subtitle'];
        }
        if (!empty($settings['location_section_bg'])) {
            $tft_location_section_bg = $settings['location_section_bg'];
        }

        $taxonomy = 'carrental_brand';
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
        $all_brands_categories = get_categories($args);

?>

        <div class="tft-brands-design__one tft-customizer-typography">
            <div class="tft-brands-inner">
                <div class="tft-brands-header tft-section-heading">
                    <?php if(!empty($tft_sec_title)): ?>
                        <h2 class="tft-section-title"><?php echo esc_html($tft_sec_title); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($tft_sec_subtitle)): ?>
                        <div class="tft-section-content">
                            <p><?php echo esc_html($tft_sec_subtitle); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $rand_number = wp_rand(100, 99999999); ?>
                <div class="tft-brands <?php echo 'slider' == $style ? esc_attr('tft-brands-slider-selector-') . $rand_number : esc_attr('tft-brands-grid'); ?>">
                    <?php
                    foreach ($all_brands_categories as $cat) {
                        if ($cat->category_parent == 0) {
                            $category_id = $cat->term_id;
                            $meta = get_term_meta($cat->term_id, 'tf_carrental_brand', true);
                            if (!empty($meta['image'])) {
                                $cat_image = $meta['image'];
                            } else {
                                $cat_image = TRAVELFIC_TOOLKIT_URL . 'assets/app/img/feature-default.jpg';
                            }
                    ?>
                            <div class="tft-single-brands">
                                <div class="tft-brands-thumbnail tft-thumbnail">
                                    <a href="<?php echo esc_url(get_term_link($cat->slug, 'carrental_brand')); ?>"><img src="<?php echo esc_url($cat_image); ?>" alt="<?php esc_html_e("Car brands Image", "travelfic-toolkit"); ?>"></a>

                                    <div class="tft-brands-title">
                                        <?php echo '<a href="' . esc_url(get_term_link($cat->slug, 'carrental_brand')) . '">' . esc_html($cat->name) . '</a>'; ?>
                                    </div>
                                </div>
                            </div>
                    <?php } else {
                        }
                    } ?>
                </div>
            </div>
            <script>
                (function($) {
                    $(document).ready(function() {
                        //Your Code Inside
                        $('.tft-brands-slider-selector-<?php echo esc_html($rand_number) ?>').slick({
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            dots: false,
                            arrows: false,
                            centerMode: true,
                            focusOnSelect: true,
                            infinite: true,
                            autoplay: true,
                            speed: 900,
                            autoplaySpeed: 6000,
                            responsive: [{
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        infinite: true,
                                    }
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        margin: '10px'
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
<?php
    }
}
