<?php
/**
 * Key Numbers Section (CON SỐ NỔI BẬT)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
$title   = $section['title'] ?? 'Con số nổi bật';
$items   = $section['items'] ?? array();
$bg_img  = is_array( $section['bg_image'] ?? null ) ? ( $section['bg_image']['url'] ?? '' ) : ( is_numeric( $section['bg_image'] ?? null ) ? wp_get_attachment_url( $section['bg_image'] ) : ( $section['bg_image'] ?? '' ) );
$fig_img = is_array( $section['figure_image'] ?? null ) ? ( $section['figure_image']['url'] ?? '' ) : ( is_numeric( $section['figure_image'] ?? null ) ? wp_get_attachment_url( $section['figure_image'] ) : ( $section['figure_image'] ?? '' ) );

if ( empty( $items ) ) {
	$items = array(
		array(
			'count'  => 100,
			'suffix' => '%',
			'title'  => 'Kiểm nghiệm công thức và test độ ổn định',
		),
		array(
			'count'  => 300,
			'suffix' => '+',
			'title'  => 'Công thức độc quyền đã nghiên cứu R&D',
		),
		array(
			'count'  => 30,
			'suffix' => '+',
			'title'  => 'Đề tài nghiên cứu khoa học công bố',
		),
		array(
			'count'  => 10,
			'suffix' => '+',
			'title'  => 'Năm kinh nghiệm sản xuất & gia công mỹ phẩm',
		),
	);
}

if ( empty( $bg_img ) ) {
	$bg_img = 'https://unila.com.vn/wp-content/uploads/2026/04/CON-SO-NOI-BAT-2.jpg';
}
if ( empty( $fig_img ) ) {
	$fig_img = 'https://unila.com.vn/wp-content/uploads/2026/03/UNILA-VIET-NAM.png';
}
?>

<section class="home-4-section section-small" id="key-numbers">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700">
			<?php echo esc_html( $title ); ?>
		</h2>
		<div class="home-4-wrap mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
			<div class="home-4-list">
				<?php foreach ( $items as $item ) : ?>
					<div class="home-4-item">
						<div class="number">
							<span class="count-up" data-count="<?php echo esc_attr( $item['count'] ?? 0 ); ?>">0</span><span class="suffix"><?php echo esc_html( $item['suffix'] ?? '' ); ?></span>
						</div>
						<p class="title">
							<?php echo esc_html( $item['title'] ?? '' ); ?>
						</p>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="home-4-image text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
				<img class="bg lozad" src="<?php echo esc_url( $bg_img ); ?>" data-src="<?php echo esc_url( $bg_img ); ?>" loading="lazy" alt="CON SỐ NỔI BẬT VINACOS" width="1200" height="500">
				<figure>
					<img class="lozad" src="<?php echo esc_url( $fig_img ); ?>" data-src="<?php echo esc_url( $fig_img ); ?>" loading="lazy" alt="VINACOS VIỆT NAM" width="600" height="300">
				</figure>
			</div>
		</div>
	</div>
</section>
