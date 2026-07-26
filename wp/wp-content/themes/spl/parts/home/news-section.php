<?php
/**
 * News Section (TIN TỨC)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
$title   = $section['title'] ?? 'Tin tức';

// Fetch recent posts or mock fallback
$recent_posts = get_posts( array(
	'numberposts' => 4,
	'post_status' => 'publish',
) );

$articles = array();
if ( ! empty( $recent_posts ) ) {
	foreach ( $recent_posts as $post_obj ) {
		$thumb_url = get_the_post_thumbnail_url( $post_obj->ID, 'medium_large' );
		if ( empty( $thumb_url ) ) {
			$thumb_url = 'https://unila.com.vn/wp-content/uploads/2026/07/C5A8225-scaled.jpg';
		}
		$articles[] = array(
			'title'   => get_the_title( $post_obj ),
			'url'     => get_permalink( $post_obj ),
			'date'    => get_the_date( 'd/m/Y', $post_obj ),
			'image'   => $thumb_url,
			'excerpt' => wp_trim_words( get_the_excerpt( $post_obj ), 25, ' [&hellip;]' ),
		);
	}
}

if ( empty( $articles ) ) {
	$articles = array(
		array(
			'title'   => 'Pilot Batch trong sản xuất mỹ phẩm: Vì sao 1 đơn vị đồng hành R&D nên làm mẫu thử trước khi sản xuất hàng loạt',
			'url'     => '#news-1',
			'date'    => '16/07/2026',
			'image'   => 'https://unila.com.vn/wp-content/uploads/2026/07/C5A8225-scaled.jpg',
			'excerpt' => 'Bạn đã duyệt mẫu lab, hài lòng với texture, mùi hương và màu sắc. Nhưng khi sản xuất lô hàng đầu tiên, làm thế nào để đảm bảo không có bất kỳ rủi ro nào phát sinh? Bài viết giải mã quy trình Pilot Batch tiêu chuẩn tại VINACOS [&hellip;]',
		),
		array(
			'title'   => 'Xu hướng mỹ phẩm chăm sóc da theo chu kỳ sinh học: chuẩn hóa khoa học dẫn dắt thị trường 2026',
			'url'     => '#news-2',
			'date'    => '12/06/2026',
			'image'   => 'https://unila.com.vn/wp-content/uploads/2026/06/my-pham-cham-soc-da-theo-chu-ky-sinh-hoc.png',
			'excerpt' => 'Làn da không hoạt động theo một nhịp điệu cố định suốt 24 giờ. VINACOS nghiên cứu các giải pháp dưỡng da nhịp sinh học Chronobiology tối ưu cho người dùng Việt [&hellip;]',
		),
		array(
			'title'   => '8 nguyên nhân gây lão hoá da mà bạn có thể mắc phải mỗi ngày',
			'url'     => '#news-3',
			'date'    => '18/05/2026',
			'image'   => 'https://unila.com.vn/wp-content/uploads/2026/05/8-nguyen-nhan-gay-lao-hoa-da.png',
			'excerpt' => 'Quá trình lão hoá diễn ra âm thầm từ rất sớm. Phân tích khoa học từ đội ngũ chuyên gia R&D VINACOS về nguyên nhân và giải pháp chăm sóc da toàn diện [&hellip;]',
		),
		array(
			'title'   => '2026: VINACOS công bố bộ nhận diện thương hiệu & định vị mới',
			'url'     => '#news-4',
			'date'    => '26/03/2026',
			'image'   => 'https://unila.com.vn/wp-content/uploads/2026/03/unila-cong-bo-bo-nhan-dien-thuong-hieu-moi-scaled.webp',
			'excerpt' => 'VINACOS chính thức ra mắt nhận diện thương hiệu mới – Khẳng định vị thế đơn vị đồng hành R&D và gia công mỹ phẩm sạch chuẩn quốc tế tại Việt Nam [&hellip;]',
		),
	);
}
?>

<section class="home-9-section section-t-small section-b-large" id="news">
	<div class="container">
		<div class="head-flex">
			<h2 class="site-title" data-aos="fade-right" data-aos-duration="700" data-aos-delay="300">
				<?php echo esc_html( $title ); ?>
			</h2>
			<ul class="site-nav" data-aos="fade-left" data-aos-duration="700" data-aos-delay="600">
				<li class="active">
					<a class="btn-lined" href="javascript:;">Tất cả</a>
				</li>
				<li>
					<a class="btn-lined" href="#news-cosmetics">Tin mỹ phẩm</a>
				</li>
				<li>
					<a class="btn-lined" href="#news-trends">Xu hướng mỹ phẩm</a>
				</li>
			</ul>
		</div>
		<div class="news-list mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<?php foreach ( $articles as $article ) : ?>
				<article class="news-item item-hover">
					<div class="image img-cover">
						<a href="<?php echo esc_url( $article['url'] ); ?>" title="<?php echo esc_attr( $article['title'] ); ?>">
							<img class="lozad" src="<?php echo esc_url( $article['image'] ); ?>" data-src="<?php echo esc_url( $article['image'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $article['title'] ); ?>" width="400" height="260">
						</a>
					</div>
					<div class="caption">
						<p class="news-date mb-3">
							<?php echo esc_html( $article['date'] ); ?>
						</p>
						<h3 class="title">
							<a href="<?php echo esc_url( $article['url'] ); ?>" title="<?php echo esc_attr( $article['title'] ); ?>">
								<?php echo esc_html( $article['title'] ); ?>
							</a>
						</h3>
						<div class="desc mt-5">
							<?php echo esc_html( $article['excerpt'] ); ?>
						</div>
						<div class="button mt-5">
							<a class="btn-lined" href="<?php echo esc_url( $article['url'] ); ?>" title="Xem chi tiết">
								<span>Xem chi tiết</span>
								<?= spl_icon( 'plus', '', 16 ) ?>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
