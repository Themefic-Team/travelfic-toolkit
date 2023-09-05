<?php
class Travelfic_Toolkit_Hotels extends \Elementor\Widget_Base
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
		return 'tft-hotels';
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
		return esc_html__('TFT Hotels', 'travelfic-toolkit');
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
		return 'eicon-posts-ticker';
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
		return ['travelfic', 'popular', 'hotels', 'tft'];
	}

	public function get_style_depends()
	{
		return ['travelfic-toolkit-hotels'];
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
			'tft_hotels',
			[
				'label' => __('Hotels Section', 'travelfic-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'tft_section_title',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Title', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
                'default' => __( 'The best hotels to explore', 'travelfic-toolkit' ),
			]
		);
        $this->add_control(
			'tft_section_subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
				'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
                'default' => __( 'Hotels', 'travelfic-toolkit' ),
			]
		);

		$this->add_control(
			'tf_post_type',
			[
				'label' => __('Post Type', 'travelfic-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tf_hotel',
				'options' => [
					'tf_hotel' => __('Hotels', 'travelfic-toolkit')
				]
			]
		);

		// Order by.
		$this->add_control(
			'post_order_by',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __('Order by', 'travelfic-toolkit'),
				'default' => 'date',
				'options' => [
					'date' => __('Date', 'travelfic-toolkit'),
					'title' => __('Title', 'travelfic-toolkit'),
					'modified' => __('Modified date', 'travelfic-toolkit'),
				],
			]
		);

		$this->add_control(
            'post_items',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => __( 'Item Per page', 'travelfic-toolkit' ),
                'placeholder' => __( '6', 'travelfic-toolkit' ),
                'default'     => 6,
            ]
        );
		// Order
		$this->add_control(
			'post_order',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __('Order', 'travelfic-toolkit'),
				'default' => 'DESC',
				'options' => [
					'DESC' => __('Descending', 'travelfic-toolkit'),
					'ASC' => __('Ascending', 'travelfic-toolkit')
				],
			]
		);
		$this->end_controls_section();

		// Style Section
        $this->start_controls_section(
            'popular_tour_style_section',
            [
                'label' => __( 'Section Styles', 'travelfic-toolkit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'popular_tour_item_card_padding',
            [
                'label'      => __( 'Padding', 'travelfic-toolkit' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'popular_title_head',
            [
                'label'     => __( 'Title', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_item_title',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-title',
            ]
        );
		$this->add_control(
            'popular_tour_item_title_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-title' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_meta_heading',
            [
                'label'     => __( 'Meta Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_item_meta',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-content',
            ]
        );
		$this->add_control(
            'popular_tour_item_meta_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-content' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_tour_price',
            [
                'label'     => __( 'Price', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'popular_tour_price_typo',
                'label'    => __( 'Typography', 'travelfic-toolkit' ),
                'selector' => '{{WRAPPER}} .tft-popular-tour-items .tft-pricing',
            ]
        );
		$this->add_control(
            'popular_tour_price_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1D2A3B',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-tour-items .tft-pricing' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'popular_icon_head',
            [
                'label'     => __( 'Icon Style', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_control(
            'popular_tour_item_icon_color',
            [
                'label'     => __( 'Color', 'travelfic-toolkit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#F15D30',
                'selectors' => [
                    '{{WRAPPER}} .tft-popular-tour-items .tft-popular-item-info .tft-popular-sub-info p i' => 'color: {{VALUE}}',
                ],
            ]
        );

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type' => $settings['tf_post_type']
		);

		// Display posts in category.
		if ( !empty( $settings['post_category'] ) ) {
			$args['category_name'] = $settings['post_category'];
		}

		// Items per page
		if ( !empty( $settings['post_items'] ) ) {
			$args['posts_per_page'] = $settings['post_items'];
		}

		// Items Order By
		if ( !empty( $settings['post_order_by'] ) ) {
			$args['orderby'] = $settings['post_order_by'];
		}

		// Items Order
		if ( !empty( $settings['post_order'] ) ) {
    		$args['order'] = $settings['post_order'];
		}

		$query = new \WP_Query ( $args );

		?>

		<div class="tft-popular-hotels-wrapper tft-customizer-typography tft-w-padding">
			<div class="tft-popular-hotels-items tft-popular-hotels-selector">

				<?php if ($query->have_posts()): ?>
					<?php while ($query->have_posts()):
						$query->the_post(); ?>
						<?php
						// Review Query 
						$args = array(
							'post_id' => get_the_ID(),
							'status'  => 'approve',
							'type'    => 'comment',
						);
						$comments_query = new WP_Comment_Query( $args );
						$comments = $comments_query->comments;

						$option_meta = travelfic_get_meta( get_the_ID(), 'tf_hotels_opt' );

						$disable_review_sec = !empty($meta['t-review']) ? $meta['t-review'] : '';
						?>
						<div class="tft-popular-single-item">
							<div class="tft-popular-single-item-inner">
                                <?php 
                                $tft_hotel_image = get_the_post_thumbnail_url( get_the_ID() );
                                ?>
								<div class="tft-popular-thumbnail" style="background-image: url(<?php echo esc_url($tft_hotel_image) ?>);">
                                    <div class="tft-hotel-details">
                                        <?php if ($comments && !$disable_review_sec == '1') { ?>
                                            <div class="tft-ratings">
                                                <span>
                                                    <i class="fas fa-star"></i>
                                                    <span>
                                                        <?php echo esc_html(tf_total_avg_rating($comments)); ?>
                                                    </span>
                                                    out of <?php tf_based_on_text(count($comments)); ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <h3 class="tft-title">
											<?php the_title() ?>
										</h3>
                                        <p class="tft-locations">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <g clip-path="url(#clip0_1443_3217)">
                                            <path d="M10 17.9176L14.1248 13.7927C16.4028 11.5147 16.4028 7.82124 14.1248 5.54318C11.8468 3.26512 8.15327 3.26512 5.87521 5.54318C3.59715 7.82124 3.59715 11.5147 5.87521 13.7927L10 17.9176ZM10 20.2746L4.6967 14.9713C1.76777 12.0423 1.76777 7.2936 4.6967 4.36467C7.62563 1.43574 12.3743 1.43574 15.3033 4.36467C18.2323 7.2936 18.2323 12.0423 15.3033 14.9713L10 20.2746ZM10 11.3346C10.9205 11.3346 11.6667 10.5885 11.6667 9.66797C11.6667 8.74749 10.9205 8.0013 10 8.0013C9.0795 8.0013 8.33333 8.74749 8.33333 9.66797C8.33333 10.5885 9.0795 11.3346 10 11.3346ZM10 13.0013C8.15905 13.0013 6.66667 11.5089 6.66667 9.66797C6.66667 7.82702 8.15905 6.33464 10 6.33464C11.8409 6.33464 13.3333 7.82702 13.3333 9.66797C13.3333 11.5089 11.8409 13.0013 10 13.0013Z" fill="#595349"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_1443_3217">
                                            <rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
                                            </clipPath>
                                            </defs>
                                            </svg>
                                            <?php 
                                                echo !empty($option_meta['map']['address']) ? esc_html( $option_meta['map']['address'] ) : $option_meta['address'];
                                            ?>
                                        </p>
                                        <div class="tf-others-details">
                                            <?php 
                                                $rooms = !empty($option_meta['room']) ? $option_meta['room'] : '';
                                                if(!empty($rooms)){
                                                    $rm_features = [];
                                                    foreach ( $rooms as $key => $room ) {
                                                        //merge for each room's selected features
                                                        if(!empty($room['features'])){
                                                            $rm_features = array_unique(array_merge( $rm_features, $room['features'])) ;
                                                        }
                                                    }
                                                    if(!empty($rm_features)){ ?>
                                                    <ul>
                                                        <?php
                                                        $tft_limit = 1;
                                                        foreach ( $rm_features as $feature ) {
                                                            if($tft_limit<7){
                                                                $term = get_term_by( 'id', $feature, 'hotel_feature' );

                                                                $room_f_meta = get_term_meta( $feature, 'tf_hotel_feature', true );
                                                                if ( ! empty( $room_f_meta ) ) {
                                                                    $room_icon_type = ! empty( $room_f_meta['icon-type'] ) ? $room_f_meta['icon-type'] : '';
                                                                }
                                                                if ( ! empty( $room_icon_type ) && $room_icon_type == 'fa' && !empty($room_f_meta['icon-fa']) ) {
                                                                    $room_feature_icon = '<i class="' . $room_f_meta['icon-fa'] . '"></i>';
                                                                } elseif ( ! empty( $room_icon_type ) && $room_icon_type == 'c' && ! empty( $room_f_meta['icon-c'] )) {
                                                                    $room_feature_icon = '<img src="' . $room_f_meta['icon-c'] . '" style="min-width: ' . $room_f_meta['dimention'] . 'px; height: ' . $room_f_meta['dimention'] . 'px;" />';
                                                                }
                                                                ?>
                                                                <li>
                                                                    <?php echo ! empty( $room_feature_icon ) ? $room_feature_icon : ''; ?>
                                                                    <?php echo $term->name; ?>
                                                                </li>
                                                            <?php
                                                            }
                                                        $tft_limit++;
                                                        } ?>
                                                    </ul>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo __("View details", "travelfic-toolkit"); ?></a>
                                        </div>
                                    </div>
								</div>
								
							</div>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			
		</div>

		<?php
	}
}