<?php
/**
 * News Archive Template — 100% Exact Unila HTML structure for /tin-tuc-unila-viet-nam/ & category archives.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

$news_banner = get_template_directory_uri() . '/static/img/banner/news-banner.jpg';
$queried_obj = get_queried_object();
$is_cat      = is_category();

$page_title = 'Tin tức - VINACOS Việt Nam';
if ( $is_cat && ! empty( $queried_obj->name ) ) {
	$page_title = $queried_obj->name;
}
?>

<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<img src="<?php echo esc_url( $news_banner ); ?>" alt="Tin tức - VINACOS Việt Nam">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
				<span class="separator"> - </span>
				<?php if ( $is_cat && ! empty( $queried_obj->name ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Tin tức</a>
					<span class="separator"> - </span>
					<span class="last"><?php echo esc_html( $queried_obj->name ); ?></span>
				<?php else : ?>
					<span class="last">Tin tức - VINACOS Việt Nam</span>
				<?php endif; ?>
			</p>
		</nav>
	</div>
</section>

<section class="news-section section-large">
	<div class="container">
		<div class="row -mt-10">
			<!-- Main Left Column -->
			<div class="col w-full mt-10 lg:w-2/3">
				<h1 class="site-title">
					<?php echo esc_html( $page_title ); ?>
				</h1>
				<div class="news-list mt-10">
					<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$args  = array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => 8,
						'paged'          => $paged,
					);
					if ( $is_cat && ! empty( $queried_obj->slug ) ) {
						$args['category_name'] = $queried_obj->slug;
					}

					$news_query = new WP_Query( $args );

					if ( $news_query->have_posts() ) :
						while ( $news_query->have_posts() ) :
							$news_query->the_post();
							$p_id    = get_the_ID();
							$p_thumb = get_the_post_thumbnail_url( $p_id, 'medium_large' ) ?: get_template_directory_uri() . '/static/img/logo.png';
							$p_desc  = get_the_excerpt() ?: wp_trim_words( get_the_content(), 25 );
							?>
							<article class="news-item item-hover">
								<div class="image img-cover">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<img class="lozad" src="<?php echo esc_url( $p_thumb ); ?>" data-src="<?php echo esc_url( $p_thumb ); ?>" loading="lazy" alt="<?php the_title_attribute(); ?>">
									</a>
								</div>
								<div class="caption">
									<p class="news-date mb-3">
										<?php echo esc_html( get_the_date() ); ?>
									</p>
									<h3 class="title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<div class="desc mt-5">
										<?php echo esc_html( wp_strip_all_tags( $p_desc ) ); ?>
									</div>
									<div class="button mt-5">
										<a class="btn-lined" href="<?php the_permalink(); ?>" title="Xem chi tiết">
											<span>Xem chi tiết</span>
											<?= spl_icon( 'plus', '', 16 ) ?>
										</a>
									</div>
								</div>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						echo '<p class="text-slate-500">Chưa có bài viết nào trong chuyên mục này.</p>';
					endif;
					?>
				</div>

				<?php if ( $news_query->max_num_pages > 1 ) : ?>
					<div class="post-nav mt-10">
						<?php
						echo paginate_links( array(
							'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
							'format'    => '?paged=%#%',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $news_query->max_num_pages,
							'prev_text' => spl_icon( 'chevron-left', '', 16 ),
							'next_text' => spl_icon( 'chevron-right', '', 16 ),
						) );
						?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Right Sidebar Column -->
			<div class="col w-full mt-10 lg:w-1/3">
				<div class="box-sticky">
					<!-- Categories Box -->
					<div class="box-news box-news-category">
						<h3 class="box-title">Danh mục</h3>
						<div class="box-body">
							<ul class="news-category-list">
								<li class="<?php echo ( ! $is_cat ) ? 'active' : ''; ?>">
									<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="Tất cả">
										Tất cả
									</a>
								</li>
								<?php
								$cats = get_categories( array(
									'slug'       => array( 'tin-tuc', 'blog', 'dich-vu-xe-dien' ),
									'hide_empty' => false,
								) );
								foreach ( $cats as $c ) :
									$active_class = ( $is_cat && $queried_obj && $queried_obj->term_id === $c->term_id ) ? 'active' : '';
									?>
									<li class="<?php echo esc_attr( $active_class ); ?>">
										<a href="<?php echo esc_url( get_category_link( $c ) ); ?>" title="<?php echo esc_attr( $c->name ); ?>">
											<?php echo esc_html( $c->name ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>

					<!-- Latest Posts Box -->
					<div class="box-news box-news-latest mt-8">
						<h3 class="box-title">Bài viết mới nhất</h3>
						<div class="box-body">
							<ul class="news-latest-list">
								<?php
								$latest_posts = get_posts( array(
									'post_type'      => 'post',
									'posts_per_page' => 5,
									'post_status'    => 'publish',
								) );
								foreach ( $latest_posts as $lp ) :
									?>
									<li>
										<p class="news-date">
											<?php echo esc_html( get_the_date( '', $lp->ID ) ); ?>
										</p>
										<a class="title" href="<?php echo esc_url( get_permalink( $lp ) ); ?>" title="<?php echo esc_attr( get_the_title( $lp ) ); ?>">
											<?php echo esc_html( get_the_title( $lp ) ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
