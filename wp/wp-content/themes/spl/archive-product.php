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
				<span class="last">Sản phẩm</span>
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
					<h1 class="site-title">
						Sản phẩm gia công VINACOS
					</h1>
					<div class="product-list mt-10">
						<?php
						$products = array(
							array(
								'title' => 'Sữa Rửa Mặt Dạng Kem',
								'url'   => home_url( '/san-pham-sua-rua-mat-dang-kem-unila/' ),
								'front' => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-SUA-RUA-MAT-DANG-KEM-min-1.png',
								'back'  => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-SUA-RUA-MAT-DANG-KEM-min-1.png',
								'desc'  => 'Sữa Rửa Mặt Dạng Kem với kết cấu chất kem đặc, kết hợp cùng nhiều hoạt chất dưỡng da làm sáng da, cấp ẩm, tẩy tế bào chết nhẹ nhàng và làm sạch sâu bụi mịn.',
								'tag'   => 'Hot',
							),
							array(
								'title' => 'Lăn khử mùi',
								'url'   => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
								'front' => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-LAN-KHU-MUI-min-1.png',
								'back'  => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-LAN-KHU-MUI-min-1.png',
								'desc'  => 'Công thức lăn khử mùi kiểm soát tuyến mồ hôi hiệu quả 48h, kháng khuẩn, mờ thâm vùng da dưới cánh tay không gây ố vàng áo.',
								'tag'   => 'New',
							),
							array(
								'title' => 'Serum Dưỡng Môi',
								'url'   => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
								'front' => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-Serum-duong-moi-min.png',
								'back'  => 'https://unila.com.vn/wp-content/uploads/2024/07/SERUM-DUONG-MOI-min.jpg',
								'desc'  => 'Chiết xuất từ thiên nhiên, mang đến công dụng làm mềm lớp biểu bì môi, hỗ trợ làm lành vết nứt nẻ trên môi.',
								'tag'   => 'New',
							),
							array(
								'title' => 'Tẩy Tế Bào Chết Kem Muối',
								'url'   => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
								'front' => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-TAY-TE-BAO-KEM-MUOI.png',
								'back'  => 'https://unila.com.vn/wp-content/uploads/2024/07/KEM-MUOI-min.jpg',
								'desc'  => 'Chất muối sánh mịn kết hợp cùng hạt muối khoáng, giúp loại bỏ lớp sừng dư thừa trên cơ thể để lộ ra làn da sáng mịn, khỏe mạnh.',
								'tag'   => 'New',
							),
							array(
								'title' => 'Body Mist',
								'url'   => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
								'front' => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-Body-Mist-min-1.png',
								'back'  => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-Body-Mist-min-1.png',
								'desc'  => 'Xịt thâm body hương thơm nhẹ nhàng quyến rũ, khóa ẩm dài lâu mang lại cảm giác tươi mát dễ chịu suốt ngày dài.',
								'tag'   => 'Hot',
							),
							array(
								'title' => 'Nước Hoa Cao Cấp',
								'url'   => home_url( '/san-pham-gia-cong-unila-viet-nam/' ),
								'front' => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-SUA-RUA-MAT-DANG-KEM-min-1.png',
								'back'  => 'https://unila.com.vn/wp-content/uploads/2024/07/ANH-BIA-SUA-RUA-MAT-DANG-KEM-min-1.png',
								'desc'  => 'Gia công nước hoa tinh dầu nhập khẩu Pháp với 3 tầng hương độc đáo, độ lưu hương từ 8 đến 12 tiếng.',
								'tag'   => 'Best',
							),
						);

						foreach ( $products as $prod ) :
						?>
						<article class="product-item">
							<div class="image">
								<a class="img-scale flipper" href="<?php echo esc_url( $prod['url'] ); ?>" title="<?php echo esc_attr( $prod['title'] ); ?>">
									<img class="lozad front" src="<?php echo esc_url( $prod['front'] ); ?>" data-src="<?php echo esc_url( $prod['front'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $prod['title'] ); ?>">
									<img class="lozad back" src="<?php echo esc_url( $prod['back'] ); ?>" data-src="<?php echo esc_url( $prod['back'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $prod['title'] ); ?>">
								</a>
								<?php if ( ! empty( $prod['tag'] ) ) : ?>
									<span class="product-tag"><?php echo esc_html( $prod['tag'] ); ?></span>
								<?php endif; ?>
							</div>
							<div class="caption">
								<h3 class="title">
									<a href="<?php echo esc_url( $prod['url'] ); ?>" title="<?php echo esc_attr( $prod['title'] ); ?>">
										<?php echo esc_html( $prod['title'] ); ?>
									</a>
								</h3>
								<div class="desc">
									<?php echo esc_html( $prod['desc'] ); ?>
								</div>
							</div>
						</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<!-- Sidebar Right Category List (1/3) -->
			<div class="col w-full mt-10 lg:w-1/3 xl:w-1/4">
				<div class="box-category">
					<h2 class="box-title">Danh mục sản phẩm</h2>
					<div class="box-close"><?= spl_icon( 'close', '', 16 ) ?></div>
					<div class="box-body">
						<ul class="mega-list">
							<li class="has-mega active">
								<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" title="Sản Phẩm Chăm Sóc Da Mặt">Sản Phẩm Chăm Sóc Da Mặt</a>
								<span class="toggle-mega"></span>
								<ul class="mega-list">
									<li class="active"><a href="<?php echo esc_url( home_url( '/san-pham-sua-rua-mat-dang-kem-unila/' ) ); ?>">Sữa Rửa Mặt Dạng Kem</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Tẩy Tế Bào Chết Mặt</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Toner / Nước Hoa Hồng</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Serum / Tinh Chất</a></li>
								</ul>
							</li>
							<li class="has-mega">
								<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" title="Sản Phẩm Chăm Sóc Body">Sản Phẩm Chăm Sóc Body</a>
								<span class="toggle-mega"></span>
								<ul class="mega-list">
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sữa Tắm</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Tắm Trắng</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Kem Body</a></li>
								</ul>
							</li>
							<li class="has-mega">
								<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" title="Sản Phẩm Chăm Sóc Tóc">Sản Phẩm Chăm Sóc Tóc</a>
								<span class="toggle-mega"></span>
								<ul class="mega-list">
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Dầu Gội</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Dầu Xả</a></li>
								</ul>
							</li>
							<li class="has-mega">
								<a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>" title="Sản Phẩm Cá Nhân">Sản Phẩm Cá Nhân</a>
								<span class="toggle-mega"></span>
								<ul class="mega-list">
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Nước Hoa</a></li>
									<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Lăn Khử Mùi</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
