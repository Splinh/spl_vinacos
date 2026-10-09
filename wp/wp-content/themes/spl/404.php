<?php
/**
 * 404 — Page not found.
 *
 * Designed with UI/UX Pro Max & Impeccable standards.
 *
 * @package SPL
 */

use SPL\Core\Helper;

defined( 'ABSPATH' ) || exit;

get_header();

$is_en    = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$is_woo   = Helper::isWoocommerceActive();
$shop_url = $is_en ? home_url( '/en/products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' );
$home_url = $is_en ? home_url( '/en/' ) : home_url( '/' );

$lbl_badge      = $is_en ? 'Page Not Found' : 'Không tìm thấy trang';
$lbl_title      = $is_en ? 'Oops! The page you are looking for does not exist' : 'Rất tiếc! Trang bạn tìm kiếm không tồn tại';
$lbl_desc       = $is_en ? 'The page you are trying to access may have been moved, renamed, or is temporarily unavailable. Try searching our cosmetics formulations or explore key categories below.' : 'Trang bạn đang truy cập có thể đã được di chuyển, đổi tên hoặc tạm thời không khả dụng. Hãy thử tìm kiếm sản phẩm hoặc chọn từ khóa dưới đây.';
$lbl_ph_search  = $is_en ? 'Search cosmetics, serums, essential oils, formulas...' : 'Tìm sản phẩm chăm sóc da, serum, tinh dầu, công thức gia công...';
$lbl_btn_search = $is_en ? 'Search' : 'Tìm kiếm';
$lbl_hot_tags   = $is_en ? 'Popular Topics:' : 'Từ khóa hot:';
$lbl_home_btn   = $is_en ? 'Back to Home' : 'Về trang chủ';
$lbl_all_prods  = $is_en ? 'View All Products' : 'Xem tất cả sản phẩm';
$lbl_suggest    = $is_en ? 'Suggested Products' : 'Gợi ý sản phẩm';
$lbl_sug_head   = $is_en ? 'Latest OEM/ODM Formulations for You' : 'Sản phẩm mới nhất dành cho bạn';

$pills = $is_en ? array(
	array( 'label' => 'Facial Care', 'query' => 'facial care' ),
	array( 'label' => 'Essential Oils', 'query' => 'essential oil' ),
	array( 'label' => 'Cosmetics OEM/ODM', 'query' => 'oem' ),
	array( 'label' => 'Raw Cosmetic Powders', 'query' => 'powder' ),
) : array(
	array( 'label' => 'Chăm sóc da mặt', 'query' => 'chăm sóc da mặt' ),
	array( 'label' => 'Gia công mỹ phẩm', 'query' => 'gia công' ),
	array( 'label' => 'Tinh dầu thiên nhiên', 'query' => 'tinh dầu' ),
	array( 'label' => 'Bột nguyên liệu', 'query' => 'bột nguyên liệu' ),
);
?>

<section class="error-404">
	<div class="container">
		<div class="error-404__inner reveal">
			<div class="error-404__badge-wrapper">
				<div class="error-404__code">404</div>
				<div class="error-404__badge">
					<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
					<span><?php echo esc_html( $lbl_badge ); ?></span>
				</div>
			</div>

			<h1 class="error-404__title"><?php echo esc_html( $lbl_title ); ?></h1>
			<p class="error-404__desc"><?php echo esc_html( $lbl_desc ); ?></p>

			<!-- Search Bar -->
			<div class="error-404__search search-bar" role="search">
				<div class="search-bar__wrapper" data-search>
					<form action="<?php echo esc_url( $home_url ); ?>" method="get">
						<label for="search-input-404" class="sr-only"><?php echo esc_html( $lbl_btn_search ); ?></label>
						<input id="search-input-404" type="search" class="search-bar__input" name="s" placeholder="<?php echo esc_attr( $lbl_ph_search ); ?>" autocomplete="off" data-search-input />
						<?php if ( $is_woo ) : ?>
							<input type="hidden" name="post_type" value="product" />
						<?php endif; ?>
						<button type="submit" class="search-bar__btn" aria-label="<?php echo esc_attr( $lbl_btn_search ); ?>">
							<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
							<span><?php echo esc_html( $lbl_btn_search ); ?></span>
						</button>
					</form>
					<div class="search-results" data-search-results hidden></div>
				</div>
			</div>

			<!-- Quick Keyword Pills -->
			<div class="error-404__quick-links">
				<span class="quick-links__label"><?php echo esc_html( $lbl_hot_tags ); ?></span>
				<div class="quick-links__items">
					<?php foreach ( $pills as $pill ) : ?>
						<a href="<?php echo esc_url( add_query_arg( array( 's' => $pill['query'], 'post_type' => 'product' ), $home_url ) ); ?>" class="quick-link-pill">
							<?php echo esc_html( $pill['label'] ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- CTA Buttons -->
			<div class="error-404__actions">
				<a href="<?php echo esc_url( $home_url ); ?>" class="btn btn--primary">
					<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
					<span><?php echo esc_html( $lbl_home_btn ); ?></span>
				</a>
				<?php if ( $shop_url ) : ?>
					<a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn--outline">
						<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
						<span><?php echo esc_html( $lbl_all_prods ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php
		if ( $is_woo ) :
			$suggested = new WP_Query( array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'posts_per_page'      => 4,
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'lang'                => $is_en ? 'en' : 'vi',
			) );

			if ( $suggested->have_posts() ) :
				?>
				<div class="error-404__suggest">
					<div class="error-404__suggest-head">
						<span class="error-404__suggest-badge">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<?php echo esc_html( $lbl_suggest ); ?>
						</span>
						<h2 class="error-404__suggest-title">
							<?php echo esc_html( $lbl_sug_head ); ?>
						</h2>
					</div>
					<div class="product-section">
						<div class="product-list error-404__product-list">
							<?php
							while ( $suggested->have_posts() ) :
								$suggested->the_post();
								get_template_part( 'parts/product-card', null, array( 'id' => get_the_ID() ) );
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
				<?php
			endif;
		endif;
		?>
	</div>
</section>

<?php get_footer(); ?>
