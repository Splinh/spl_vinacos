<?php
/**
 * Key Numbers Section (CON SỐ NỔI BẬT)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();
$title   = $section['title'] ?? ( $is_en ? 'Key Highlights & Milestones' : 'Con số nổi bật' );
if ( $is_en && ( 'Con số nổi bật' === $title || preg_match( '/[\x{00C0}-\x{1EF9}]/u', $title ) ) ) {
	$title = 'Key Highlights & Milestones';
}
$items   = $section['items'] ?? array();
$bg_img  = is_array( $section['bg_image'] ?? null ) ? ( $section['bg_image']['url'] ?? '' ) : ( is_numeric( $section['bg_image'] ?? null ) ? wp_get_attachment_url( $section['bg_image'] ) : ( $section['bg_image'] ?? '' ) );
$fig_img = is_array( $section['figure_image'] ?? null ) ? ( $section['figure_image']['url'] ?? '' ) : ( is_numeric( $section['figure_image'] ?? null ) ? wp_get_attachment_url( $section['figure_image'] ) : ( $section['figure_image'] ?? '' ) );

if ( empty( $items ) ) {
	$items = $is_en ? array(
		array(
			'count'  => 100,
			'suffix' => '%',
			'title'  => 'Formulas Stability & Efficacy Tested',
		),
		array(
			'count'  => 300,
			'suffix' => '+',
			'title'  => 'Proprietary R&D Formulas Developed',
		),
		array(
			'count'  => 30,
			'suffix' => '+',
			'title'  => 'Published Scientific Papers & Patents',
		),
		array(
			'count'  => 10,
			'suffix' => '+',
			'title'  => 'Years OEM/ODM Cosmetics Manufacturing',
		),
	) : array(
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
} else {
	if ( $is_en ) {
		$en_map = array(
			'Kiểm nghiệm công thức và test độ ổn định' => 'Formulas Stability & Efficacy Tested',
			'Công thức độc quyền đã nghiên cứu R&D' => 'Proprietary R&D Formulas Developed',
			'Đề tài nghiên cứu khoa học công bố'     => 'Published Scientific Papers & Patents',
			'Năm kinh nghiệm sản xuất & gia công mỹ phẩm' => 'Years OEM/ODM Cosmetics Manufacturing',
		);
		foreach ( $items as &$it ) {
			$t = $it['title'] ?? '';
			if ( isset( $en_map[ $t ] ) ) {
				$it['title'] = $en_map[ $t ];
			} elseif ( preg_match( '/[\x{00C0}-\x{1EF9}]/u', $t ) ) {
				if ( false !== strpos( $t, 'ổn định' ) || false !== strpos( $t, 'Kiểm nghiệm' ) ) {
					$it['title'] = 'Formulas Stability & Efficacy Tested';
				} elseif ( false !== strpos( $t, 'độc quyền' ) || false !== strpos( $t, 'công thức' ) ) {
					$it['title'] = 'Proprietary R&D Formulas Developed';
				} elseif ( false !== strpos( $t, 'khoa học' ) ) {
					$it['title'] = 'Published Scientific Papers & Patents';
				} elseif ( false !== strpos( $t, 'kinh nghiệm' ) || false !== strpos( $t, 'sản xuất' ) ) {
					$it['title'] = 'Years OEM/ODM Cosmetics Manufacturing';
				}
			}
		}
		unset( $it );
	}
}

if ( empty( $bg_img ) ) {
	$bg_img = get_template_directory_uri() . '/static/img/bg-stats-vinacos.jpg';
}
if ( empty( $fig_img ) ) {
	$fig_img = get_template_directory_uri() . '/static/img/stats-vinacos.png';
}
?>

<section class="home-4-section section-small" id="key-numbers">
	<div class="container">
		<h2 class="site-title text-center" data-aos="fade-up" data-aos-duration="700">
			<?php echo esc_html( $title ); ?>
		</h2>
		<div class="home-4-wrap" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
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
				<img class="bg lozad" src="<?php echo esc_url( $bg_img ); ?>" data-src="<?php echo esc_url( $bg_img ); ?>" loading="lazy" alt="<?php echo esc_attr( $is_en ? 'VINACOS KEY HIGHLIGHTS' : 'CON SỐ NỔI BẬT VINACOS' ); ?>" width="1200" height="500">
				<figure>
					<img class="lozad" src="<?php echo esc_url( $fig_img ); ?>" data-src="<?php echo esc_url( $fig_img ); ?>" loading="lazy" alt="<?php echo esc_attr( $is_en ? 'VINACOS VIETNAM' : 'VINACOS VIỆT NAM' ); ?>" width="600" height="300">
				</figure>
			</div>
		</div>
	</div>
</section>
