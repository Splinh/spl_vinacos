<?php
/**
 * Single Post Detail Template — 100% Exact Unila HTML structure for post details.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

$is_en        = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$home_label   = $is_en ? 'Home' : 'Trang chủ';
$news_label   = $is_en ? 'News & Market Insights' : 'Tin tức - VINACOS Việt Nam';
$cat_title    = $is_en ? 'Categories' : 'Danh mục';
$all_label    = $is_en ? 'All' : 'Tất cả';
$latest_label = $is_en ? 'Latest Articles' : 'Bài viết mới nhất';
$post_id      = get_the_ID();
$post_title   = get_the_title( $post_id );
$post_date    = get_the_date( 'd/m/Y', $post_id );
?>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $home_label ); ?></a>
				<span class="separator"> - </span>
				<a href="<?php echo esc_url( $is_en ? home_url( '/en/news-insights/' ) : home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>"><?php echo esc_html( $news_label ); ?></a>
				<span class="separator"> - </span>
				<span class="last"><?php echo esc_html( $post_title ); ?></span>
			</p>
		</nav>
	</div>
</section>

<section class="news-detail-section section-large">
	<div class="container">
		<div class="row -mt-10">
			<!-- Main Article Body (8/12) -->
			<div class="col w-full mt-10 lg:w-2/3">
				<div class="box-news-detail">
					<h1 class="site-sub-title font-bold text-2xl lg:text-3xl text-neutral-900 leading-snug">
						<?php echo esc_html( $post_title ); ?>
					</h1>
					<p class="news-date mt-3 text-sm text-neutral-500 font-medium">
						<?php echo esc_html( $post_date ); ?>
					</p>

					<div class="full-content mt-8 space-y-6 text-neutral-700 leading-relaxed text-base">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

			<!-- Sidebar Right (4/12) -->
			<div class="col w-full mt-10 lg:w-1/3">
				<div class="box-sticky">
					<!-- Categories Box -->
					<div class="box-news box-news-category mb-8">
						<h3 class="box-title"><?php echo esc_html( $cat_title ); ?></h3>
						<div class="box-body">
							<ul class="news-category-list">
								<li class="active">
									<a href="<?php echo esc_url( $is_en ? home_url( '/en/news-insights/' ) : home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="<?php echo esc_attr( $all_label ); ?>">
										<?php echo esc_html( $all_label ); ?>
									</a>
								</li>
								<?php
								$cat_slugs = $is_en 
									? array( 'news-industry-trends', 'beauty-skincare-blog', 'oem-odm-insights' )
									: array( 'tin-tuc', 'blog', 'dich-vu-xe-dien' );

								$cats = get_categories( array(
									'slug'       => $cat_slugs,
									'hide_empty' => false,
								) );

								if ( empty( $cats ) ) {
									$cats = get_categories( array(
										'hide_empty' => false,
										'number'     => 3,
										'exclude'    => array( 1 ),
									) );
								}

								foreach ( $cats as $c ) :
									?>
									<li>
										<a href="<?php echo esc_url( get_category_link( $c ) ); ?>" title="<?php echo esc_attr( $c->name ); ?>">
											<?php echo esc_html( $c->name ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>

					<!-- Latest News Box -->
					<div class="box-news box-news-latest">
						<h3 class="box-title"><?php echo esc_html( $latest_label ); ?></h3>
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
											<?php echo esc_html( get_the_date( 'd/m/Y', $lp->ID ) ); ?>
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
