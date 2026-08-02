<?php
/**
 * Product Archive Template — 100% Exact Unila HTML layout for /san-pham-gia-cong-unila-viet-nam/ & /en/products/.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

$is_en      = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$banner_img = get_template_directory_uri() . '/static/img/banner/' . ( $is_en ? 'brand-banner-en.jpg' : 'brand-banner-vi.jpg' );

$home_label     = $is_en ? 'Home' : 'Trang chủ';
$products_label = $is_en ? 'Cosmetics Portfolio' : 'Sản phẩm';
$all_label      = $is_en ? 'All Products' : 'Tất cả sản phẩm';
$cat_title      = $is_en ? 'Product Categories' : 'Danh mục sản phẩm';
$default_title  = $is_en ? 'VINACOS Cosmetic Products Portfolio' : 'Sản phẩm gia công VINACOS';
$no_products    = $is_en ? 'No products found in this category.' : 'Chưa có sản phẩm nào trong danh mục này.';
$shop_url       = $is_en ? home_url( '/en/products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' );
?>


<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $home_label ); ?></a>
				<span class="separator"> - </span>
				<?php
				$queried_obj = get_queried_object();
				if ( is_tax( 'product_cat' ) && ! empty( $queried_obj->name ) ) :
					?>
					<a href="<?php echo esc_url( $shop_url ); ?>"><?php echo esc_html( $products_label ); ?></a>
					<span class="separator"> - </span>
					<span class="last"><?php echo esc_html( $queried_obj->name ); ?></span>
				<?php else : ?>
					<span class="last"><?php echo esc_html( $products_label ); ?></span>
				<?php endif; ?>
			</p>
		</nav>
	</div>
</section>

<section class="product-section section-large">
	<div class="container">
		<div class="row -mt-10 lg:flex-row-reverse">
			<!-- Main Left Product List (2/3) -->
			<div class="col w-full mt-10 lg:w-2/3 xl:w-3/4">
				<div class="product-wrap">
					<?php
					$page_title = $default_title;
					if ( is_tax( 'product_cat' ) && ! empty( $queried_obj->name ) ) {
						$page_title = $queried_obj->name;
					}
					?>
					<h1 class="site-title">
						<?php echo esc_html( $page_title ); ?>
					</h1>
					<div class="product-list mt-10">
						<?php
						$paged        = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						$current_lang = function_exists( 'pll_current_language' ) ? pll_current_language() : ( $is_en ? 'en' : 'vi' );
						if ( empty( $current_lang ) ) {
							$current_lang = $is_en ? 'en' : 'vi';
						}

						$args = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'posts_per_page' => 12,
							'paged'          => $paged,
							'lang'           => $current_lang,
						);

						$tax_query = array();

						if ( is_tax( 'product_cat' ) && ! empty( $queried_obj->slug ) ) {
							$tax_query[] = array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $queried_obj->slug,
							);
						}

						if ( function_exists( 'pll_current_language' ) ) {
							$tax_query[] = array(
								'taxonomy' => 'language',
								'field'    => 'slug',
								'terms'    => $current_lang,
							);
						}

						if ( ! empty( $tax_query ) ) {
							if ( count( $tax_query ) > 1 ) {
								$tax_query['relation'] = 'AND';
							}
							$args['tax_query'] = $tax_query;
						}

						$product_query = new WP_Query( $args );

						if ( $product_query->have_posts() ) :
							while ( $product_query->have_posts() ) :
								$product_query->the_post();
								$p_id    = get_the_ID();
								$p_title = get_the_title();
								$p_url   = get_permalink();
								$p_thumb = get_the_post_thumbnail_url( $p_id, 'medium_large' ) ?: get_template_directory_uri() . '/static/img/logo.png';
								$p_desc  = get_the_excerpt() ?: wp_trim_words( get_the_content(), 20 );
								?>
								<article class="product-item">
									<div class="image">
										<a class="img-scale flipper" href="<?php echo esc_url( $p_url ); ?>" title="<?php echo esc_attr( $p_title ); ?>">
											<img class="lozad front" src="<?php echo esc_url( $p_thumb ); ?>" data-src="<?php echo esc_url( $p_thumb ); ?>" loading="lazy" alt="<?php echo esc_attr( $p_title ); ?>">
											<img class="lozad back" src="<?php echo esc_url( $p_thumb ); ?>" data-src="<?php echo esc_url( $p_thumb ); ?>" loading="lazy" alt="<?php echo esc_attr( $p_title ); ?>">
										</a>
										<span class="product-tag">HOT</span>
									</div>
									<div class="caption">
										<h3 class="title">
											<a href="<?php echo esc_url( $p_url ); ?>" title="<?php echo esc_attr( $p_title ); ?>">
												<?php echo esc_html( $p_title ); ?>
											</a>
										</h3>
										<div class="desc">
											<?php echo esc_html( wp_strip_all_tags( $p_desc ) ); ?>
										</div>
									</div>
								</article>
								<?php
							endwhile;
							wp_reset_postdata();
						else :
							echo '<p class="col-span-full text-slate-500">' . esc_html( $no_products ) . '</p>';
						endif;
						?>
					</div>

					<?php if ( $product_query->max_num_pages > 1 ) : ?>
						<div class="post-nav mt-8">
							<?php
							$current_p = max( 1, (int) get_query_var( 'paged' ) );
							$total_p   = (int) $product_query->max_num_pages;
							$links     = paginate_links( array(
								'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
								'format'    => '?paged=%#%',
								'current'   => $current_p,
								'total'     => $total_p,
								'type'      => 'array',
								'prev_text' => '<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>',
								'next_text' => '<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>',
							) );

							if ( ! empty( $links ) ) {
								foreach ( $links as $l ) {
									echo $l;
								}

								if ( $current_p < $total_p && $total_p > 3 ) {
									$last_url = get_pagenum_link( $total_p );
									echo '<a class="page-numbers last-page" href="' . esc_url( $last_url ) . '" title="' . ( $is_en ? 'Last page' : 'Trang cuối' ) . '">'
										. '<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m13 17 5-5-5-5"/><path d="m6 17 5-5-5-5"/></svg>'
										. '</a>';
								}
							}
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Sidebar Right Category List (1/3) -->
			<div class="col w-full mt-10 lg:w-1/3 xl:w-1/4">
				<div class="box-category">
					<h2 class="box-title"><?php echo esc_html( $cat_title ); ?></h2>
					<div class="box-close"><?= spl_icon( 'close', '', 16 ) ?></div>
					<div class="box-body">
						<ul class="mega-list">
							<li class="<?php echo ( ! is_tax( 'product_cat' ) ) ? 'active' : ''; ?>">
								<a href="<?php echo esc_url( $shop_url ); ?>"><?php echo esc_html( $all_label ); ?></a>
							</li>
							<?php
							$p_terms = get_terms( array(
								'taxonomy'   => 'product_cat',
								'hide_empty' => false,
								'lang'       => $is_en ? 'en' : 'vi',
								'exclude'    => array( 15, 501 ), // Exclude Uncategorized
							) );

							if ( ! empty( $p_terms ) && ! is_wp_error( $p_terms ) ) :
								if ( function_exists( 'pll_get_term_language' ) ) {
									$target_lang = $is_en ? 'en' : 'vi';
									$p_terms     = array_filter( $p_terms, function( $t ) use ( $target_lang ) {
										$t_lang = pll_get_term_language( $t->term_id );
										return $t_lang === $target_lang;
									} );
								}
								foreach ( $p_terms as $term ) :
									$is_active = ( is_tax( 'product_cat' ) && $queried_obj && $queried_obj->term_id === $term->term_id ) ? 'active' : '';
									?>
									<li class="<?php echo esc_attr( $is_active ); ?>">
										<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
											<?php echo esc_html( $term->name ); ?> (<?php echo (int) $term->count; ?>)
										</a>
									</li>
									<?php
								endforeach;
							endif;
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

