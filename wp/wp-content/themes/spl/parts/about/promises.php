<?php
/**
 * About — Promises Section (LỜI HỨA CỦA BB VINACOS).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$title   = $is_en ? 'VINACOS PROMISES' : 'LỜI HỨA CỦA BB VINACOS';
$img_dir = get_template_directory_uri() . '/static/img/';

$items = [
	[
		'icon'  => $img_dir . 'icon-hop-tac.png',
		'title' => $is_en ? 'Collaboration' : 'Sự hợp tác',
		'desc'  => $is_en ? 'Describe what this value represents within the team and across the company.' : 'Hãy mô tả giá trị đó đại diện cho điều gì trong nhóm và trong công ty.',
	],
	[
		'icon'  => $img_dir . 'icon-trung-thuc.png',
		'title' => $is_en ? 'Integrity' : 'Sự trung thực',
		'desc'  => $is_en ? 'Describe what this value represents within the team and across the company.' : 'Hãy mô tả giá trị đó đại diện cho điều gì trong nhóm và trong công ty.',
	],
	[
		'icon'  => $img_dir . 'icon-xuat-sac.png',
		'title' => $is_en ? 'Excellence' : 'Sự xuất sắc',
		'desc'  => $is_en ? 'Describe what this value represents within the team and across the company.' : 'Hãy mô tả giá trị đó đại diện cho điều gì trong nhóm và trong công ty.',
	],
];
?>

<section class="about-promises-section section-large" id="promises">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700">
			<?php echo esc_html( $title ); ?>
		</h2>

		<div class="promises-grid">
			<?php foreach ( $items as $index => $item ) : ?>
				<div class="promise-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="<?php echo esc_attr( 200 * ( $index + 1 ) ); ?>">
					<div class="promise-icon">
						<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" width="60" height="60">
					</div>
					<div class="promise-tag">
						<?php echo esc_html( $item['title'] ); ?>
					</div>
					<p class="promise-desc">
						<?php echo esc_html( $item['desc'] ); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
