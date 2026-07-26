<?php
/**
 * Header — 100% Unila HTML structure with Mega Menu & SVG icons.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;200;300;400;500;600;700;800;900&family=Playball&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'home page-template page-template-pages page-template-page-home page-template-pagespage-home-php page wp-custom-logo' ); ?>>
<?php wp_body_open(); ?>

<header>
	<div class="header-wrap">
		<div class="header-logo">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img decoding="async" class="alignnone size-full wp-image-81" src="<?php echo esc_url( get_template_directory_uri() . '/static/img/logo.png' ); ?>" alt="VINACOS" style="height: 56px; width: auto; max-height: 64px; object-fit: contain;" />
				</a>
			</p>
		</div>
		<div class="header-center">
			<nav class="navbar-nav" id="toggleMenu">
				<ul id="primary-menu" class="main-menu">
					<li class="menu-item menu-item-type-post_type menu-item-object-page">
						<a href="<?php echo esc_url( home_url( '/tam-the-cong-su-unila-viet-nam/' ) ); ?>">TÂM THẾ CỘNG SỰ</a>
					</li>
					<li class="menu-item menu-item-type-taxonomy menu-item-object-products menu-item-has-children">
						<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Sản phẩm</a>
						<div class="mega-menu">
							<div class="container">
								<ul class="sub-menu">
									<?php
									$mega_cats = array(
										array( 'slug' => 'cham-soc-da-mat', 'title' => 'Chăm sóc da mặt & Body' ),
										array( 'slug' => 'tinh-dau', 'title' => 'Tinh dầu thiên nhiên' ),
										array( 'slug' => 'dau-nen', 'title' => 'Dầu nền nguyên chất' ),
										array( 'slug' => 'bot-nguyen-lieu', 'title' => 'Bột nguyên liệu & Gia dụng' ),
									);

									foreach ( $mega_cats as $mc ) :
										$term = get_term_by( 'slug', $mc['slug'], 'product_cat' );
										$term_url = $term ? get_term_link( $term ) : home_url( '/shop/' );
										
										// Get up to 5 products for sub-menu
										$prods = get_posts( array(
											'post_type'      => 'product',
											'posts_per_page' => 5,
											'tax_query'      => array(
												array(
													'taxonomy' => 'product_cat',
													'field'    => 'slug',
													'terms'    => $mc['slug'],
												),
											),
										) );
										
										$preview_img = ! empty( $prods ) ? get_the_post_thumbnail_url( $prods[0]->ID, 'medium' ) : get_template_directory_uri() . '/static/img/logo.png';
										?>
										<li class="menu-item menu-item-has-children">
											<a href="<?php echo esc_url( $term_url ); ?>"><?php echo esc_html( $mc['title'] ); ?></a>
											<div class="mega-wrap">
												<ul class="sub-menu">
													<?php if ( ! empty( $prods ) ) : ?>
														<?php foreach ( $prods as $p ) : ?>
															<li><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></li>
														<?php endforeach; ?>
													<?php else : ?>
														<li><a href="<?php echo esc_url( $term_url ); ?>">Xem tất cả</a></li>
													<?php endif; ?>
												</ul>
												<div class="walker-preview img-cover"><img src="<?php echo esc_url( $preview_img ); ?>" alt="<?php echo esc_attr( $mc['title'] ); ?>"></div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page">
						<a href="<?php echo esc_url( home_url( '/oem-odm-gia-cong-unila-viet-nam/' ) ); ?>">HỆ THỐNG R&D</a>
					</li>
					<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children">
						<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Tin tức</a>
						<div class="mega-menu">
							<div class="container">
								<ul class="sub-menu">
									<?php
									$news_cats = array(
										array( 'slug' => 'tin-tuc', 'title' => 'Tin Tức & Thị Trường' ),
										array( 'slug' => 'blog', 'title' => 'Blog Làm Đẹp' ),
										array( 'slug' => 'dich-vu-xe-dien', 'title' => 'Dịch Vụ Gia Công' ),
									);

									foreach ( $news_cats as $nc ) :
										$cat = get_category_by_slug( $nc['slug'] );
										$cat_url = $cat ? get_category_link( $cat ) : home_url( '/tin-tuc-unila-viet-nam/' );
										
										$posts = get_posts( array(
											'post_type'      => 'post',
											'posts_per_page' => 4,
											'category_name'  => $nc['slug'],
										) );
										
										$preview_img = ! empty( $posts ) ? get_the_post_thumbnail_url( $posts[0]->ID, 'medium' ) : get_template_directory_uri() . '/static/img/logo.png';
										?>
										<li class="menu-item menu-item-has-children">
											<a href="<?php echo esc_url( $cat_url ); ?>"><?php echo esc_html( $nc['title'] ); ?></a>
											<div class="mega-wrap">
												<ul class="sub-menu">
													<?php foreach ( $posts as $ps ) : ?>
														<li><a href="<?php echo esc_url( get_permalink( $ps ) ); ?>"><?php echo esc_html( get_the_title( $ps ) ); ?></a></li>
													<?php endforeach; ?>
												</ul>
												<div class="walker-preview img-cover"><img src="<?php echo esc_url( $preview_img ); ?>" alt="<?php echo esc_attr( $nc['title'] ); ?>"></div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page">
						<a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>">Liên hệ</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="header-right">
			<div class="button-search"><?= spl_icon( 'search', '', 18 ) ?></div>
			<div class="button-cart"><?= spl_icon( 'cart', '', 18 ) ?></div>
			<div class="button-language">
				<div class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-dropdown-click js-wpml-ls-legacy-dropdown-click">
					<ul>
						<li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-vi wpml-ls-current-language wpml-ls-first-item wpml-ls-last-item wpml-ls-item-legacy-dropdown-click">
							<a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle">
								<span class="wpml-ls-native">VN</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<button type="button" id="buttonMenu" aria-controls="toggleMenu" data-target="#toggleMenu">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
				<span id="pulseMe">
					<span class="bar left"></span>
					<span class="bar top"></span>
					<span class="bar right"></span>
					<span class="bar bottom"></span>
				</span>
			</button>
		</div>
	</div>
</header>

<div class="mobile-wrap">
	<i class="close-mobile">&times;</i>
	<div class="navbar-nav-list"></div>
</div>
<div class="backdrop backdrop-mobile"></div>

<main>
