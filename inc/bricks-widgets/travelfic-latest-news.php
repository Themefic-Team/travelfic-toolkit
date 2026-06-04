<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Travelfic Latest News Widget for Bricks Builder
 */
class Travelfic_Toolkit_Bricks_LatestNews extends \Bricks\Element {

	public $category = 'travelfic';
	public $name     = 'tft-latest-news';
	public $icon     = 'ti-layout-grid3';

	public function enqueue_scripts() {
		wp_enqueue_style( 'travelfic-toolkit-latest-news' );
	}

	public function get_label() {
		return esc_html__( 'Travelfic Latest News', 'travelfic-toolkit' );
	}

	public function grid_get_all_post_type_categories( $post_type ) {
		$options = array();
		if ( $post_type == 'post' ) {
			$taxonomy = 'category';
		}
		if ( ! empty( $taxonomy ) ) {
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term->slug ) && isset( $term->name ) ) {
						$options[ $term->slug ] = $term->name;
					}
				}
			}
		}
		return $options;
	}

	public function set_control_groups() {
		$this->control_groups['blog_news'] = [
			'title' => esc_html__( 'Blog News', 'travelfic-toolkit' ),
			'tab'   => 'content',
		];

		$this->control_groups['blog_design_2_section_style'] = [
			'title' => esc_html__( 'Style', 'travelfic-toolkit' ),
			'tab'   => 'style',
		];

		$this->control_groups['news_style_section'] = [
			'title' => esc_html__( 'News List', 'travelfic-toolkit' ),
			'tab'   => 'style',
		];
	}

	public function set_controls() {
		$this->controls['blog_style'] = [
			'tab'     => 'content',
			'group'   => 'blog_news',
			'label'   => esc_html__( 'Design', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'design-1' => esc_html__( 'Design 1', 'travelfic-toolkit' ),
				'design-2' => esc_html__( 'Design 2', 'travelfic-toolkit' ),
				'design-3' => esc_html__( 'Design 3', 'travelfic-toolkit' ),
				'design-4' => esc_html__( 'Design 4', 'travelfic-toolkit' ),
			],
			'default' => 'design-1',
		];

		$this->controls['tft_section_title'] = [
			'tab'         => 'content',
			'group'       => 'blog_news',
			'label'       => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your title', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'We share our experiences, tips and travel stories to inspire', 'travelfic-toolkit' ),
			'required'    => [ 'blog_style', '=', [ 'design-2', 'design-3' ] ],
		];

		$this->controls['tft_section_subtitle'] = [
			'tab'         => 'content',
			'group'       => 'blog_news',
			'label'       => esc_html__( 'SubTitle', 'travelfic-toolkit' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__( 'Enter your SubTitle', 'travelfic-toolkit' ),
			'default'     => esc_html__( 'BLOG & NEWS', 'travelfic-toolkit' ),
			'required'    => [ 'blog_style', '=', [ 'design-2', 'design-3' ] ],
		];

		$this->controls['post_category'] = [
			'tab'      => 'content',
			'group'    => 'blog_news',
			'label'    => esc_html__( 'Category', 'travelfic-toolkit' ),
			'type'     => 'select',
			'options'  => $this->grid_get_all_post_type_categories( 'post' ),
			'multiple' => true,
		];

		$this->controls['post_items'] = [
			'tab'     => 'content',
			'group'   => 'blog_news',
			'label'   => esc_html__( 'Items', 'travelfic-toolkit' ),
			'type'    => 'number',
			'default' => 4,
		];

		$this->controls['post_order_by'] = [
			'tab'     => 'content',
			'group'   => 'blog_news',
			'label'   => esc_html__( 'Order by', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'date'          => esc_html__( 'Date', 'travelfic-toolkit' ),
				'title'         => esc_html__( 'Title', 'travelfic-toolkit' ),
				'modified'      => esc_html__( 'Modified date', 'travelfic-toolkit' ),
				'comment_count' => esc_html__( 'Comment count', 'travelfic-toolkit' ),
				'rand'          => esc_html__( 'Random', 'travelfic-toolkit' ),
			],
			'default' => 'date',
		];

		$this->controls['post_order'] = [
			'tab'     => 'content',
			'group'   => 'blog_news',
			'label'   => esc_html__( 'Order', 'travelfic-toolkit' ),
			'type'    => 'select',
			'options' => [
				'DESC' => esc_html__( 'Descending', 'travelfic-toolkit' ),
				'ASC'  => esc_html__( 'Ascending', 'travelfic-toolkit' ),
			],
			'default' => 'DESC',
		];

		$this->controls['view_all_link'] = [
			'tab'      => 'content',
			'group'    => 'blog_news',
			'label'    => esc_html__( 'View ALL URL', 'travelfic-toolkit' ),
			'type'     => 'link',
			'default'  => [
				'url' => '#',
			],
			'required' => [ 'blog_style', '=', [ 'design-2', 'design-4' ] ],
		];

		// Style Controls - blog_design_2_section_style
		$this->controls['blog_section_background'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-latest-posts-design__two, .tft-latest-posts-design__three',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-2', 'design-3' ] ],
		];

		$this->controls['blog_section_design2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .tft-blog-header .tft-heading-content .tft-section-title, .tft-latest-posts-design__four .tft-blog-sec-header .tft-section-title',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_design3_title_head'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['blog_section_title_typo_design_3'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__three .container .tft-heading-content h2',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['blog_section_design3_title_backdrop'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Title Backdrop', 'travelfic-toolkit' ),
			'type'     => 'checkbox',
			'default'  => true,
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['blog_section_design3_title_backdrop_head'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Title Backdrop Style', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [
				[ 'blog_style', '=', 'design-3' ],
				[ 'blog_section_design3_title_backdrop', '=', true ],
			],
		];

		$this->controls['blog_section_design3_title_backdrop_color'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-heading-content h2::after',
				],
			],
			'required' => [
				[ 'blog_style', '=', 'design-3' ],
				[ 'blog_section_design3_title_backdrop', '=', true ],
			],
		];

		$this->controls['blog_section_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_subtitle_typo'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .tft-blog-header .tft-heading-content .tft-section-subtitle, .tft-latest-posts-design__four .tft-blog-sec-header .tft-section-subtitle',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_design3_subtitle_head'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Subtitle', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['blog_section_subtitle_typo_design_3'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-heading-content h3',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['blog_section_button_head'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_button_typo'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .read-more a, .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-latest-posts-design__two .read-more a, .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-latest-posts-design__two .read-more a, .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .read-more a, .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_button_bg'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-latest-posts-design__two .read-more a, .tft-latest-posts-design__four .tft-blog-sec-header .tft-btn',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['blog_section_button_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'blog_design_2_section_style',
			'label'    => esc_html__( 'Button Icon Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'fill',
					'selector' => '.tft-latest-posts-design__two .read-more a span svg path',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		// Style Controls - news_style_section
		$this->controls['news_item_card_padding'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-latest-posts-design__one .tft-post-content-wrap, .tft-latest-posts-design__three .container .tft-blog-gird-section .tft-post-single-item, .tft-latest-posts-design__four .tf-blog-card.content-only, .tft-latest-posts-design__four .tf-blog-card.with-image .tf-content',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-1', 'design-3', 'design-4' ] ],
		];

		$this->controls['news_card_background_design_3'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Card Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.tft-latest-posts-design__three .container .tft-blog-gird-section .tft-col-item, .tft-latest-posts-design__four .tf-blog-card',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-3', 'design-4' ] ],
		];

		$this->controls['news_card_gradient'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Card Gradient', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-1' ],
		];

		$this->controls['news_item_card_gradient_1'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Background Gradient 1', 'travelfic-toolkit' ),
			'type'     => 'color',
			'default'  => '#1D2A3B',
			'required' => [ 'blog_style', '=', 'design-1' ],
		];

		$this->controls['news_item_card_gradient_2'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Background Gradient 2', 'travelfic-toolkit' ),
			'type'     => 'color',
			'default'  => '#1d2a3b00',
			'required' => [ 'blog_style', '=', 'design-1' ],
		];

		$this->controls['news_title_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', [ 'design-1', 'design-4' ] ],
		];

		$this->controls['news_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__one .tft-post-content-wrap .tft-post-title .tft-title, .tft-latest-posts-design__four .tf-blog-card .tf-content h3',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-1', 'design-4' ] ],
		];

		$this->controls['news_meta_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Meta', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-1' ],
		];

		$this->controls['news_meta_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__one .tft-post-content-wrap .tft-meta-wrap .tft-meta',
				],
			],
			'required' => [ 'blog_style', '=', 'design-1' ],
		];

		$this->controls['news_design2_overley'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Overlay', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.blog-grid-item-2 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-3 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-4 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-4 .tft-post-single-item.tft-col-item:nth-child(3) a .tft-content-details, .blog-grid-item-5 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-5 .tft-post-single-item.tft-col-item:nth-child(4) a .tft-content-details, .blog-grid-item-6 .tft-post-single-item.tft-col-item:nth-child(2) a .tft-content-details, .blog-grid-item-6 .tft-post-single-item.tft-col-item:nth-child(4) a .tft-content-details, .blog-grid-item-6 .tft-post-single-item.tft-col-item:nth-child(6) a .tft-content-details',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['news_design2_title_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['news_design2_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item a h3',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['news_design2_date_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Date', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['news_design2_time_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item a p.tft-meta',
				],
			],
			'required' => [ 'blog_style', '=', 'design-2' ],
		];

		$this->controls['news_design2_content_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Content', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', [ 'design-2', 'design-4' ] ],
		];

		$this->controls['news_design2_content_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__two .tft-blog-gird-section .tft-post-single-item p.content, .tft-latest-posts-design__four .tf-blog-card .tf-content p',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-2', 'design-4' ] ],
		];

		$this->controls['news_design3_title_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Title', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_title_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__three .tft-content-details .tft-title',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_meta_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Meta', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_meta_typo'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__three .tft-content-details .tft-post-meta .tft-meta',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_button_head'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Button', 'travelfic-toolkit' ),
			'type'     => 'separator',
			'required' => [ 'blog_style', '=', [ 'design-3', 'design-4' ] ],
		];

		$this->controls['news_design3_button_typography'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Typography', 'travelfic-toolkit' ),
			'type'     => 'typography',
			'exclude'  => [ 'text-align' ],
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__three .container .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a, .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-3', 'design-4' ] ],
		];

		$this->controls['news_design3_button_margin_'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Margin', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.tft-latest-posts-design__three .container .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a, .tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more',
				],
			],
			'required' => [ 'blog_style', '=', [ 'design-3', 'design-4' ] ],
		];

		$this->controls['news_design3_button_padding_'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Padding', 'travelfic-toolkit' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.tft-latest-posts-design__three .container .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_button_border_'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Border', 'travelfic-toolkit' ),
			'type'     => 'border',
			'css'      => [
				[
					'selector' => '.tft-latest-posts-design__three .container .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_button_background_color'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Button Background', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.tft-latest-posts-design__three .container .tft-blog-gird-section .tft-post-single-item .tft-content-details .tft-read-more a',
				],
			],
			'required' => [ 'blog_style', '=', 'design-3' ],
		];

		$this->controls['news_design3_button_icon_color'] = [
			'tab'      => 'style',
			'group'    => 'news_style_section',
			'label'    => esc_html__( 'Button Icon Color', 'travelfic-toolkit' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'fill',
					'selector' => '.tft-latest-posts-design__four .tf-blog-card .tf-content .tf-read-more svg path',
				],
			],
			'required' => [ 'blog_style', '=', 'design-4' ],
		];
	}

	public function render() {
		$settings = $this->settings;

		$this->set_attribute( '_root', 'style', 'width: 100%;' );
		echo '<div ' . $this->render_attributes( '_root' ) . '>';

		\Travelfic_Toolkit\Components\LatestNews::render( $settings, 'bricks' );

		echo '</div>';
	}
}
