<?php

namespace Travelfic_Toolkit\Components;

defined( 'ABSPATH' ) || exit;

/**
 * Global Latest News Component
 *
 * Centralized render logic shared by the Elementor and Bricks
 * Travelfic Latest News widgets. Both builders call:
 *
 *   LatestNews::render( $settings, 'elementor' );
 *   LatestNews::render( $settings, 'bricks' );
 */
class LatestNews {

	/**
	 * Main entry point called by both widget render() methods.
	 *
	 * @param array  $settings Merged settings array from the widget.
	 * @param string $builder  'elementor' | 'bricks'
	 */
	public static function render( array $settings = [], string $builder = '' ): void {
		$args = array(
			'post_type' => 'post',
		);

		// Design
		$design = ! empty( $settings['blog_style'] ) ? $settings['blog_style'] : 'design-1';

		// Display posts in category.
		if ( ! empty( $settings['post_category'] ) ) {
			$post_categories = $settings['post_category'];
			if ( is_array( $post_categories ) ) {
				$args['category_name'] = implode( ',', $post_categories );
			} elseif ( is_string( $post_categories ) ) {
				$args['category_name'] = $post_categories;
			}
		}

		// Items per page
		if ( ! empty( $settings['post_items'] ) ) {
			$args['posts_per_page'] = $settings['post_items'];
		}

		// Items Order By
		if ( ! empty( $settings['post_order_by'] ) ) {
			$args['orderby'] = $settings['post_order_by'];
		}

		// Items Order
		if ( ! empty( $settings['post_order'] ) ) {
			$args['order'] = $settings['post_order'];
		}

		$query       = new \WP_Query( $args );
		$items_count = ! empty( $settings['post_items'] ) ? $settings['post_items'] : 4;

		$tft_sec_title = ! empty( $settings['tft_section_title'] ) ? $settings['tft_section_title'] : '';
		$tft_sec_subtitle = ! empty( $settings['tft_section_subtitle'] ) ? $settings['tft_section_subtitle'] : '';

		// Backdrop switcher logic via centralized helper function
		$has_backdrop = tft_get_switcher_value( $settings, 'blog_section_design3_title_backdrop', 'yes', $builder );
		$section_title_backdrop = 'yes' !== $has_backdrop ? ' tft-no-backdrop' : '';

		// View all link details
		$view_all_url   = self::get_link_url( $settings, 'view_all_link' );
		$view_all_attrs = self::get_link_target_and_rel( $settings, 'view_all_link' );

		if ( 'design-4' == $design ) {
			?>
			<div class="tft-latest-posts-design__four">
				<?php
				if ( $query->have_posts() ) :
					$row_index  = 0;
					$post_index = 0;

					echo '<div class="tf-blog-wrapper">';

					while ( $query->have_posts() ) :
						$query->the_post();

						// Open new row for every 2 posts
						if ( $post_index % 2 == 0 ) {
							$row_index++;
							// Odd row → 33/66
							$row_class = ( $row_index % 2 == 1 ) ? 'row-33-66' : 'row-66-33';
							echo '<div class="tf-blog-row ' . esc_attr( $row_class ) . '">';
						}

						// Determine card type inside row
						$is_first_in_row = ( $post_index % 2 == 0 );

						// For odd row (33-66)
						if ( $row_index % 2 == 1 ) {
							$card_class = $is_first_in_row ? 'content-only' : 'with-image';
						} else {
							// Even row (66-33)
							$card_class = $is_first_in_row ? 'with-image' : 'content-only';
						}
						?>

						<div class="tf-blog-card <?php echo esc_attr( $card_class ); ?>">
							<?php if ( $card_class === 'with-image' ) : ?>
								<div class="tf-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( get_the_post_thumbnail_url( get_the_ID() ) ) {
											the_post_thumbnail( 'blog-thumb' );
										} else {
											?>
											<img src="<?php echo esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' ); ?>" alt="<?php esc_attr_e( 'Post', 'travelfic-toolkit' ); ?>">
										<?php } ?>
									</a>
								</div>
							<?php endif; ?>

							<div class="tf-content">
								<h3>
									<a href="<?php the_permalink(); ?>">
										<?php echo esc_html( travelfic_character_limit( get_the_title(), 32 ) ); ?>
									</a>
								</h3>

								<p>
									<?php echo esc_html( travelfic_character_limit( get_the_excerpt(), 110 ) ); ?>
								</p>

								<a href="<?php the_permalink(); ?>" class="tf-read-more">
									<?php esc_html_e( 'Learn More', 'tourfic' ); ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M7 7H17M17 7V17M17 7L7 17" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</a>
							</div>
						</div>

						<?php
						$post_index++;

						// Close row after 2 posts
						if ( $post_index % 2 == 0 ) {
							echo '</div>';
						}

					endwhile;

					// Close row if odd number of posts
					if ( $post_index % 2 != 0 ) {
						echo '</div>';
					}

					echo '</div>';

					wp_reset_postdata();
				endif;
				?>
			</div>
			<?php
		} elseif ( 'design-3' == $design ) {
			?>
			<div class="tft-latest-posts-design__three">
				<div class="tft-heading-content">
					<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
						<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $tft_sec_title ) ) : ?>
						<h2 class="tft-section-title tft-title-shape <?php echo esc_attr( $section_title_backdrop ); ?>"><?php echo esc_html( $tft_sec_title ); ?></h2>
					<?php endif; ?>
				</div>

				<div class="tft-blog-gird-section">
					<?php if ( $query->have_posts() ) : ?>
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							?>
							<div class="tft-col-item tft-post-single-item">
								<div class="tft-blog-thumbnail">
									<?php
									if ( get_the_post_thumbnail_url( get_the_ID() ) ) {
										the_post_thumbnail( 'blog-thumb' );
									} else {
										?>
										<img src="<?php echo esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' ); ?>" alt="<?php esc_attr_e( 'Post', 'travelfic-toolkit' ); ?>">
									<?php } ?>
								</div>
								<div class="tft-content-details">
									<div class="tft-post-meta">
										<p class="tft-meta"><i class="ri-time-line"></i><?php echo get_the_date( 'j M, Y' ); ?></p>
										<p class="tft-meta"><i class="ri-user-line"></i> <?php echo esc_html__( 'by', 'travelfic-toolkit' ) . ' ' . get_the_author(); ?></p>
									</div>
									<h3 class="tft-title">
										<a href="<?php echo esc_url( get_permalink() ); ?>">
											<?php echo esc_html( travelfic_character_limit( get_the_title(), 70 ) ); ?>
										</a>
									</h3>
									<div class="tft-read-more">
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="tft-btn tft-btn_gray">
											<?php esc_html_e( 'Read Details', 'travelfic-toolkit' ); ?>
											<i class="ri-arrow-right-line"></i>
										</a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php
		} elseif ( 'design-2' == $design ) {
			?>
			<div class="tft-latest-posts-design__two">
				<div class="tft-blog-header">
					<div class="tft-news-header tft-heading-content">
						<?php if ( ! empty( $tft_sec_subtitle ) ) : ?>
							<h3 class="tft-section-subtitle"><?php echo esc_html( $tft_sec_subtitle ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $tft_sec_title ) ) : ?>
							<h2 class="tft-section-title"><?php echo esc_html( $tft_sec_title ); ?></h2>
						<?php endif; ?>
					</div>
					<div class="read-more">
						<a href="<?php echo esc_url( $view_all_url ); ?>" class="tft-btn tft-large-circle tft-wh-auto tft-flex-column"<?php echo $view_all_attrs; ?>>
							<?php esc_html_e( 'View All', 'travelfic-toolkit' ); ?>
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="57" height="16" viewBox="0 0 57 16" fill="none">
									<path d="M56.7071 8.70711C57.0976 8.31658 57.0976 7.68342 56.7071 7.29289L50.3431 0.928932C49.9526 0.538408 49.3195 0.538408 48.9289 0.928932C48.5384 1.31946 48.5384 1.95262 48.9289 2.34315L54.5858 8L48.9289 13.6569C48.5384 14.0474 48.5384 14.6805 48.9289 15.0711C49.3195 15.4616 49.9526 15.4616 50.3431 15.0711L56.7071 8.70711ZM0 9H56V7H0V9Z" fill="#FDF9F4" />
								</svg>
							</span>
						</a>
					</div>
				</div>

				<div class="tft-blog-gird-section blog-grid-item-<?php echo esc_attr( $items_count ); ?>">
					<?php if ( $query->have_posts() ) : ?>
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							?>
							<div class="tft-col-item tft-post-single-item">
								<a id="post-<?php the_ID(); ?>" href="<?php echo esc_url( get_permalink() ); ?>">
									<div class="tft-blog-thumbnail">
										<?php
										if ( get_the_post_thumbnail_url( get_the_ID() ) ) {
											the_post_thumbnail( 'blog-thumb' );
										} else {
											?>
											<img src="<?php echo esc_url( site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png' ); ?>" alt="<?php esc_attr_e( 'Post', 'travelfic-toolkit' ); ?>">
										<?php } ?>
									</div>
									<div class="tft-content-details">
										<p class="tft-meta"><i class="fas fa-clock"></i> <?php echo get_the_date( 'j M, Y' ); ?></p>
										<h3 class="tft-title">
											<?php echo esc_html( travelfic_character_limit( get_the_title(), 22 ) ); ?>
										</h3>
										<?php
										$blog_single_cont = wp_strip_all_tags( get_the_content() );
										if ( strlen( $blog_single_cont ) > 28 ) {
											$blog_single_cont = substr( $blog_single_cont, 0, 28) . '<span> ...Read more</span>';
										}
										echo '<p class="content">' . wp_kses_post( $blog_single_cont ) . '</p>';
										?>
									</div>
								</a>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php
		} else {
			$news_item_card_gradient_1 = '#1D2A3B';
			$news_item_card_gradient_2 = '#1d2a3b00';
			$news_item_card_gradient_1_hover = '';
			$news_item_card_gradient_2_hover = '';

			if($builder == 'elementor') {
				$news_item_card_gradient_1 = ! empty( $settings['news_item_card_gradient_1'] ) ? $settings['news_item_card_gradient_1'] : '#1D2A3B';
				$news_item_card_gradient_2 = ! empty( $settings['news_item_card_gradient_2'] ) ? $settings['news_item_card_gradient_2'] : '#1d2a3b00';
				
				$news_item_card_gradient_1_hover = ! empty( $settings['news_item_card_gradient_1_hover'] ) ? $settings['news_item_card_gradient_1_hover'] : '';
				$news_item_card_gradient_2_hover = ! empty( $settings['news_item_card_gradient_2_hover'] ) ? $settings['news_item_card_gradient_2_hover'] : '';
			} elseif($builder == 'bricks') {
				$news_item_card_gradient_1 = isset( $settings['news_item_card_gradient_1'] ) ? ( is_array( $settings['news_item_card_gradient_1'] ) ? ( $settings['news_item_card_gradient_1']['raw'] ?? $settings['news_item_card_gradient_1']['hex'] ?? '#1D2A3B' ) : $settings['news_item_card_gradient_1'] ) : '#1D2A3B';
				$news_item_card_gradient_2 = isset( $settings['news_item_card_gradient_2'] ) ? ( is_array( $settings['news_item_card_gradient_2'] ) ? ( $settings['news_item_card_gradient_2']['raw'] ?? $settings['news_item_card_gradient_2']['hex'] ?? '#1d2a3b00' ) : $settings['news_item_card_gradient_2'] ) : '#1d2a3b00';
				
				$news_item_card_gradient_1_hover = isset( $settings['news_item_card_gradient_1_hover'] ) ? ( is_array( $settings['news_item_card_gradient_1_hover'] ) ? ( $settings['news_item_card_gradient_1_hover']['raw'] ?? $settings['news_item_card_gradient_1_hover']['hex'] ?? '' ) : $settings['news_item_card_gradient_1_hover'] ) : '';
				$news_item_card_gradient_2_hover = isset( $settings['news_item_card_gradient_2_hover'] ) ? ( is_array( $settings['news_item_card_gradient_2_hover'] ) ? ( $settings['news_item_card_gradient_2_hover']['raw'] ?? $settings['news_item_card_gradient_2_hover']['hex'] ?? '' ) : $settings['news_item_card_gradient_2_hover'] ) : '';
			}
			?>
			<style>
				.tft-latest-posts .tft-post-thumbnail a::before {
					background: linear-gradient(360deg, <?php echo esc_attr( $news_item_card_gradient_1 ); ?> -9.6%, <?php echo esc_attr( $news_item_card_gradient_2 ); ?> 109.78%);
				}
				<?php if ( ! empty( $news_item_card_gradient_1_hover ) || ! empty( $news_item_card_gradient_2_hover ) ) : ?>
					.tft-latest-posts .tft-post-thumbnail a:hover::before {
						background: linear-gradient(360deg, <?php echo esc_attr( $news_item_card_gradient_1_hover ); ?> -9.6%, <?php echo esc_attr( $news_item_card_gradient_2_hover ); ?> 109.78%);
					}
				<?php endif; ?>
				<?php if ( 'bricks' !== $builder && ! empty( $settings['news_card_radius'] ) ) : ?>
					.tft-latest-posts .tft-post-thumbnail img {
						border-radius: <?php echo esc_attr( $settings['news_card_radius'] ); ?>px;
					}
				<?php endif; ?>
			</style>

			<div class="tft-latest-posts-design__one tft-customizer-typography">
				<div class="tft-latest-posts">
					<div id="items-count-<?php echo esc_html( $items_count ); ?>" class="tft-latest-post-items">
						<?php if ( $query->have_posts() ) : ?>
							<?php
							while ( $query->have_posts() ) :
								$query->the_post();
								?>
								<div class="tft-col-item tft-post-single-item">
									<div class="tft-post-thumbnail tft-thumbnail">
										<div class="tft-thumbnail-url">
											<a id="post-<?php the_ID(); ?>" <?php post_class( 'single-blog' ); ?> href="<?php echo esc_url( get_permalink() ); ?>">
												<?php the_post_thumbnail( 'blog-thumb' ); ?>
												<div class="tft-post-content-wrap tft-content-box">
													<div class="tft-meta-wrap">
														<p class="tft-meta tft-color-white"><i class="fas fa-clock"></i> <?php echo get_the_date(); ?></p>
													</div>
													<div class="tft-post-title">
														<h3 class="tft-title"><?php the_title(); ?></h3>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Safe link URL helper.
	 */
	private static function get_link_url( array $settings, string $key ): string {
		$link = $settings[ $key ] ?? '';
		if ( is_array( $link ) ) {
			return ! empty( $link['url'] ) ? $link['url'] : '#';
		}
		return is_string( $link ) && ! empty( $link ) ? $link : '#';
	}

	/**
	 * Safe link target and rel helper.
	 */
	private static function get_link_target_and_rel( array $settings, string $key ): string {
		$link = $settings[ $key ] ?? [];
		$attrs = '';
		if ( is_array( $link ) ) {
			$external = ! empty( $link['is_external'] ) || ! empty( $link['newTab'] );
			if ( $external ) {
				$attrs .= ' target="_blank"';
			}
			$nofollow = ! empty( $link['nofollow'] );
			if ( $nofollow ) {
				$attrs .= ' rel="nofollow"';
			}
		}
		return $attrs;
	}
}
