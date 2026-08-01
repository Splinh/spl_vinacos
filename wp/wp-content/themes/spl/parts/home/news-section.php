<?php
/**
 * News Section (TIN TỨC)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();

$section = $args ?? array();
$title   = $section['title'] ?? ( $is_en ? 'News & Beauty Insights' : 'Tin tức' );

// Fetch recent posts for current language
$recent_posts = get_posts( array(
	'numberposts' => 4,
	'post_status' => 'publish',
	'lang'        => $is_en ? 'en' : 'vi',
) );

$articles = array();
if ( ! empty( $recent_posts ) ) {
	foreach ( $recent_posts as $post_obj ) {
		$thumb_url = get_the_post_thumbnail_url( $post_obj->ID, 'medium_large' );
		if ( empty( $thumb_url ) ) {
			$thumb_url = get_template_directory_uri() . '/static/img/news/pilot-batch-cosmetics.jpg';
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
			'title'   => $is_en ? 'Importance of Pilot Batch in OEM Cosmetics Manufacturing' : 'Pilot Batch trong sản xuất mỹ phẩm: Vì sao nên làm mẫu thử trước khi sản xuất hàng loạt',
			'url'     => '#news-1',
			'date'    => '31/07/2026',
			'image'   => get_template_directory_uri() . '/static/img/news/pilot-batch-cosmetics.jpg',
			'excerpt' => $is_en ? 'Pilot Batch testing ensures formula stability, evaluates scalability from lab to factory floor, and eliminates 100% of risk before mass production.' : 'Thử nghiệm Pilot Batch giúp đánh giá tính ổn định của công thức, kiểm tra khả năng nâng quy mô sản xuất và giảm thiểu 100% rủi ro khi sản xuất hàng loạt.',
		),
		array(
			'title'   => $is_en ? 'Application of Nano Lipid Emulsion Technology in Skincare' : 'Ứng Dụng Công Nghệ Nhũ Tương Nano Lipid Trong Chăm Sóc Da Việt',
			'url'     => '#news-2',
			'date'    => '30/07/2026',
			'image'   => get_template_directory_uri() . '/static/img/news/nano-lipid-skincare.jpg',
			'excerpt' => $is_en ? 'Research on nano lipid encapsulation enables deep dermal penetration and active compound stability for high-performance skincare.' : 'Nghiên cứu ứng dụng nhũ tương nano bọc hoạt chất giúp thẩm thấu sâu, bảo toàn hoạt tính và tối ưu hiệu quả trên làn da.',
		),
		array(
			'title'   => $is_en ? '8 Causes of Premature Skin Aging You Face Daily' : '8 nguyên nhân gây lão hoá da mà bạn có thể mắc phải mỗi ngày',
			'url'     => '#news-3',
			'date'    => '18/05/2026',
			'image'   => get_template_directory_uri() . '/static/img/banner/slide1-desktop.jpg',
			'excerpt' => $is_en ? 'Scientific analysis from VINACOS R&D experts on skin aging causes and comprehensive protection strategies.' : 'Quá trình lão hoá diễn ra âm thầm từ rất sớm. Phân tích khoa học từ đội ngũ chuyên gia R&D VINACOS về nguyên nhân và giải pháp chăm sóc da toàn diện.',
		),
		array(
			'title'   => $is_en ? 'VINACOS Unveils New Brand Identity & Position' : '2026: VINACOS công bố bộ nhận diện thương hiệu & định vị mới',
			'url'     => '#news-4',
			'date'    => '26/03/2026',
			'image'   => get_template_directory_uri() . '/static/img/banner/slide2-desktop.jpg',
			'excerpt' => $is_en ? 'VINACOS officially launches new brand identity - reaffirming position as leading international standard R&D partner in Vietnam.' : 'VINACOS chính thức ra mắt nhận diện thương hiệu mới – Khẳng định vị thế đơn vị đồng hành R&D và gia công mỹ phẩm sạch chuẩn quốc tế tại Việt Nam.',
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
					<a class="btn-lined" href="<?php echo esc_url( $is_en ? home_url( '/en/news-insights/' ) : home_url( '/tin-tuc/' ) ); ?>"><?= $is_en ? 'All' : 'Tất cả' ?></a>
				</li>
				<li>
					<a class="btn-lined" href="<?php echo esc_url( $is_en ? home_url( '/en/news-insights/' ) : home_url( '/tin-tuc/' ) ); ?>"><?= $is_en ? 'Cosmetic News' : 'Tin mỹ phẩm' ?></a>
				</li>
				<li>
					<a class="btn-lined" href="<?php echo esc_url( $is_en ? home_url( '/en/news-insights/' ) : home_url( '/tin-tuc/' ) ); ?>"><?= $is_en ? 'Beauty Trends' : 'Xu hướng mỹ phẩm' ?></a>
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
							<?php echo esc_html( wp_strip_all_tags( $article['excerpt'] ) ); ?>
						</div>
						<div class="button mt-5">
							<a class="btn-lined" href="<?php echo esc_url( $article['url'] ); ?>" title="<?php echo esc_attr( $is_en ? 'Read More' : 'Xem chi tiết' ); ?>">
								<span><?= $is_en ? 'Read More' : 'Xem chi tiết' ?></span>
								<?= spl_icon( 'plus', '', 16 ) ?>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
