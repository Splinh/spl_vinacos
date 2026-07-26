<?php
/**
 * Product Archive Template — 100% Exact Unila HTML layout for /san-pham-gia-cong-unila-viet-nam/.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

$banner_img = get_template_directory_uri() . '/static/img/banner/WEB-BIA.jpg';
?>

<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<img src="<?php echo esc_url( $banner_img ); ?>" alt="Sản phẩm - VINACOS Việt Nam">
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
				<?php
				$queried_obj = get_queried_object();
				if ( is_tax( 'product_cat' ) && ! empty( $queried_obj->name ) ) :
					?>
					<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Sản phẩm</a>
					<span class="separator"> - </span>
					<span class="last"><?php echo esc_html( $queried_obj->name ); ?></span>
				<?php else : ?>
					<span class="last">Sản phẩm</span>
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
					$queried_obj = get_queried_object();
					$page_title = 'Sản phẩm gia công VINACOS';
					if ( is_tax( 'product_cat' ) && ! empty( $queried_obj->name ) ) {
						$page_title = $queried_obj->name;
					}
					?>
					<h1 class="site-title">
						<?php echo esc_html( $page_title ); ?>
					</h1>
					<div class="product-list mt-10">
						<?php
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						$args  = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'posts_per_page' => 12,
							'paged'          => $paged,
						);
						if ( is_tax( 'product_cat' ) && ! empty( $queried_obj->slug ) ) {
							$args['tax_query'] = array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $queried_obj->slug,
								),
							);
						}

						$product_query = new WP_Query( $args );

						if ( $product_query->have_posts() ) :
							while ( $product_query->have_posts() ) :
								$product_query->the_post();
								$p_id       = get_the_ID();
								$p_title    = get_the_title();
								$p_url      = get_permalink();
								$p_thumb    = get_the_post_thumbnail_url( $p_id, 'medium_large' ) ?: get_template_directory_uri() . '/static/img/logo.png';
								$p_desc     = get_the_excerpt() ?: wp_trim_words( get_the_content(), 20 );
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
							echo '<p class="col-span-full text-slate-500">Chưa có sản phẩm nào trong danh mục này.</p>';
						endif;
						?>
					</div>

					<?php if ( $product_query->max_num_pages > 1 ) : ?>
						<div class="pagination-wrap mt-8">
							<?php
							echo paginate_links( array(
								'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
								'format'    => '?paged=%#%',
								'current'   => max( 1, get_query_var( 'paged' ) ),
								'total'     => $product_query->max_num_pages,
								'prev_text' => '&laquo; Trước',
								'next_text' => 'Sau &raquo;',
							) );
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Sidebar Right Category List (1/3) -->
			<div class="col w-full mt-10 lg:w-1/3 xl:w-1/4">
				<div class="box-category">
					<h2 class="box-title">Danh mục sản phẩm</h2>
					<div class="box-close"><?= spl_icon( 'close', '', 16 ) ?></div>
					<div class="box-body">
						<ul class="mega-list">
							<li class="<?php echo ( ! is_tax( 'product_cat' ) ) ? 'active' : ''; ?>">
								<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Tất cả sản phẩm</a>
							</li>
							<?php
							$p_terms = get_terms( array(
								'taxonomy'   => 'product_cat',
								'slug'       => array( 'tinh-dau', 'dau-nen', 'bot-nguyen-lieu', 'san-pham-gia-dung', 'cham-soc-co-the', 'cham-soc-da-mat', 'cham-soc-me-bim', 'san-pham-cho-nam', 'best-seller' ),
								'hide_empty' => false,
							) );
							if ( ! empty( $p_terms ) && ! is_wp_error( $p_terms ) ) :
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
