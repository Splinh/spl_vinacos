<?php
/**
 * News Archive Template — 100% Exact Unila HTML structure for /tin-tuc-unila-viet-nam/.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

$news_banner = get_template_directory_uri() . '/static/img/banner/news-banner.jpg';
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
				<span class="last">Tin tức - VINACOS Việt Nam</span>
			</p>
		</nav>
	</div>
</section>

<section class="news-section section-large">
	<div class="container">
		<div class="row -mt-10">
			<div class="col w-full mt-10 lg:w-2/3">
				<h1 class="site-title">
					Tin tức - VINACOS Việt Nam
				</h1>
				<div class="news-list mt-10">
					<?php 
					$articles = array(
						array(
							'title' => 'Pilot Batch trong sản xuất mỹ phẩm: Vì sao 1 đơn vị đồng hành R&D nên làm mẫu thử trước khi sản xuất hàng loạt',
							'url'   => home_url( '/pilot-batch-trong-san-xuat-my-pham/' ),
							'image' => 'https://unila.com.vn/wp-content/uploads/2026/07/C5A8225-scaled.jpg',
							'date'  => '16/07/2026',
							'desc'  => 'Bạn đã duyệt mẫu lab, hài lòng với texture, mùi hương và màu sắc. Nhưng khi nhận lô hàng đầu tiên, chất kem lại đặc hơn, mùi hương thay đổi hoặc bao bì chiết rót không như mong muốn. Đây là tình huống không hiếm trong ngành gia công mỹ phẩm.',
						),
						array(
							'title' => 'Xu hướng mỹ phẩm chăm sóc da theo chu kỳ sinh học: chuẩn hóa khoa học dẫn dắt thị trường 2026',
							'url'   => home_url( '/tin-tuc-unila-viet-nam/' ),
							'image' => 'https://unila.com.vn/wp-content/uploads/2026/06/my-pham-cham-soc-da-theo-chu-ky-sinh-hoc.png',
							'date'  => '12/06/2026',
							'desc'  => 'Làn da không hoạt động theo một nhịp điệu cố định suốt 24 giờ. Nó thay đổi – từng giờ, từng ngày, từng tháng. Đó chính là nền tảng của một trong những xu thế làm đẹp đang được cộng đồng khoa học mỹ phẩm và người tiêu dùng toàn cầu quan tâm nhiều nhất.',
						),
						array(
							'title' => '8 nguyên nhân gây lão hoá da mà bạn có thể mắc phải mỗi ngày',
							'url'   => home_url( '/tin-tuc-unila-viet-nam/' ),
							'image' => 'https://unila.com.vn/wp-content/uploads/2026/05/8-nguyen-nhan-gay-lao-hoa-da.png',
							'date'  => '18/05/2026',
							'desc'  => 'Nhiều người bắt đầu lo lắng về lão hoá da khi những nếp nhăn đầu tiên xuất hiện. Nhưng thực tế, quá trình lão hoá diễn ra âm thầm từ rất sớm, tích luỹ qua từng thói quen nhỏ mỗi ngày.',
						),
						array(
							'title' => '2026: VINACOS công bố bộ nhận diện thương hiệu mới nâng tầm vị thế',
							'url'   => home_url( '/tin-tuc-unila-viet-nam/' ),
							'image' => 'https://unila.com.vn/wp-content/uploads/2026/03/unila-cong-bo-bo-nhan-dien-thuong-hieu-moi-scaled.webp',
							'date'  => '26/03/2026',
							'desc'  => 'Đánh dấu bước chuyển mình mạnh mẽ sau gần một thập kỷ phát triển, VINACOS chính thức ra mắt bộ nhận diện thương hiệu mới, khẳng định vị thế đối tác R&D tin cậy cho các thương hiệu mỹ phẩm Việt.',
						),
						array(
							'title' => 'Nghiên cứu sản xuất Toner cấp ẩm – Sản phẩm ngách lý tưởng cho hoạt động kinh doanh năm 2026',
							'url'   => home_url( '/tin-tuc-unila-viet-nam/' ),
							'image' => 'https://unila.com.vn/wp-content/uploads/2025/01/nghien-cuu-san-xuat-toner-cap-am-unila.jpg',
							'date'  => '26/02/2026',
							'desc'  => 'Nghiên cứu sản xuất toner là một trong những lựa chọn được nhiều thương hiệu mỹ phẩm quan tâm trong chiến lược phát triển sản phẩm, hỗ trợ làm sạch da sau bước rửa mặt và cân bằng độ ẩm.',
						),
					);

					foreach ( $articles as $art ) :
					?>
					<article class="news-item item-hover">
						<div class="image img-cover">
							<a href="<?php echo esc_url( $art['url'] ); ?>" title="<?php echo esc_attr( $art['title'] ); ?>">
								<img class="lozad" src="<?php echo esc_url( $art['image'] ); ?>" data-src="<?php echo esc_url( $art['image'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $art['title'] ); ?>">
							</a>
						</div>
						<div class="caption">
							<p class="news-date mb-3">
								<?php echo esc_html( $art['date'] ); ?>
							</p>
							<h3 class="title">
								<a href="<?php echo esc_url( $art['url'] ); ?>" title="<?php echo esc_attr( $art['title'] ); ?>">
									<?php echo esc_html( $art['title'] ); ?>
								</a>
							</h3>
							<div class="desc mt-5">
								<?php echo esc_html( $art['desc'] ); ?>
							</div>
							<div class="button mt-5">
								<a class="btn-lined" href="<?php echo esc_url( $art['url'] ); ?>" title="Xem chi tiết">
									<span>Xem chi tiết</span>
									<?= spl_icon( 'plus', '', 16 ) ?>
								</a>
							</div>
						</div>
					</article>
					<?php endforeach; ?>
				</div>

				<div class="post-nav mt-10">
					<ul class="pager">
						<li class="active"><span class="active">01</span></li>
						<li><a href="#">02</a></li>
						<li><a href="#">03</a></li>
						<li><a href="#">04</a></li>
						<li><a href="#" title="Kế tiếp"><?= spl_icon( 'chevron-right', '', 16 ) ?></a></li>
					</ul>
				</div>
			</div>

			<div class="col w-full mt-10 lg:w-1/3">
				<div class="box-sticky">
					<div class="box-news box-news-category">
						<h3 class="box-title">
							Danh mục
						</h3>
						<div class="box-body">
							<ul class="news-category-list">
								<li class="active">
									<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="Tất cả">
										Tất cả
									</a>
								</li>
								<li>
									<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="Xu hướng mỹ phẩm">
										Xu hướng mỹ phẩm
									</a>
								</li>
								<li>
									<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="Tin mỹ phẩm">
										Tin mỹ phẩm
									</a>
								</li>
								<li>
									<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="Sự kiện">
										Sự kiện
									</a>
								</li>
								<li>
									<a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>" title="Hoạt động xã hội">
										Hoạt động xã hội
									</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="box-news box-news-latest mt-8">
						<h3 class="box-title">Bài viết mới nhất</h3>
						<div class="box-body">
							<ul class="news-latest-list">
								<?php foreach ( array_slice( $articles, 0, 4 ) as $art ) : ?>
								<li>
									<p class="news-date">
										<?php echo esc_html( $art['date'] ); ?>
									</p>
									<a class="title" href="<?php echo esc_url( $art['url'] ); ?>" title="<?php echo esc_attr( $art['title'] ); ?>">
										<?php echo esc_html( $art['title'] ); ?>
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
