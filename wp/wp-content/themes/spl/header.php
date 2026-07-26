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
						<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản phẩm</a>
						<div class="mega-menu">
							<div class="container">
								<ul class="sub-menu">
									<li class="menu-item menu-item-has-children">
										<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Chăm Sóc Da Mặt</a>
										<div class="mega-wrap">
											<ul class="sub-menu">
												<li><a href="<?php echo esc_url( home_url( '/san-pham-sua-rua-mat-dang-kem-unila/' ) ); ?>" data-walker-img="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-1.jpg">Sữa Rửa Mặt Dạng Kem</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" data-walker-img="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-SON-2.jpg">Tẩy Tế Bào Chết Mặt</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" data-walker-img="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-3.jpg">Toner / Nước Hoa Hồng</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" data-walker-img="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-SON-4.jpg">Serum / Tinh Chất</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Kem Dưỡng Da Mặt</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Mặt Nạ Dưỡng Da</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Chống Nắng</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Son Dưỡng Môi</a></li>
											</ul>
											<div class="walker-preview img-cover"><img src="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-1.jpg" alt="Preview"></div>
										</div>
									</li>
									<li class="menu-item menu-item-has-children">
										<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Chăm Sóc Body</a>
										<div class="mega-wrap">
											<ul class="sub-menu">
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Tẩy Tế Bào Chết Body</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sữa Tắm</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Tắm Trắng</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Body Oil</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Kem Body</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Chống Nắng Body</a></li>
											</ul>
											<div class="walker-preview img-cover"><img src="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-SON-2.jpg" alt="Preview"></div>
										</div>
									</li>
									<li class="menu-item menu-item-has-children">
										<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Chăm Sóc Tóc</a>
										<div class="mega-wrap">
											<ul class="sub-menu">
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Dầu Gội</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Dầu Xả</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Tẩy Tế Bào Chết Da Đầu</a></li>
											</ul>
											<div class="walker-preview img-cover"><img src="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-3.jpg" alt="Preview"></div>
										</div>
									</li>
									<li class="menu-item menu-item-has-children">
										<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Cá Nhân & Spa</a>
										<div class="mega-wrap">
											<ul class="sub-menu">
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Nước Hoa</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Body Mist</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Lăn Khử Mùi</a></li>
												<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Dành Cho Spa</a></li>
											</ul>
											<div class="walker-preview img-cover"><img src="https://unila.com.vn/wp-content/uploads/2026/04/CHAT-SON-4.jpg" alt="Preview"></div>
										</div>
									</li>
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
									<li class="menu-item"><a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Xu hướng mỹ phẩm</a></li>
									<li class="menu-item"><a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Tin Tức Mỹ Phẩm VINACOS</a></li>
									<li class="menu-item menu-item-has-children">
										<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Sự Kiện</a>
										<div class="mega-wrap">
											<ul class="sub-menu">
												<li><a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Hoạt động công ty</a></li>
												<li><a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Hoạt động xã hội</a></li>
											</ul>
											<div class="walker-preview img-cover"><img src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" alt="Preview"></div>
										</div>
									</li>
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
			<div class="button-menu" id="buttonMenu">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
</header>
<main>
