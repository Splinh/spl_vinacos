<?php
/**
 * Home — R&D System Section (HỆ THỐNG R&D - Canva Slide Format).
 *
 * Exact 1:1 full-bleed layout matching the Canva Slide format:
 * - Desktop: Full-screen (100vw, 100vh - header) edge-to-edge layout with Canva organic curve and team meeting photo.
 * - Mobile/Tablet: Clean stacked responsive layout with photo banner on top, content below.
 *   - Badge with Subtitle/Label at top-left (no icon).
 *   - Main Title & Description positioned lower down matching the slide rhythm.
 *   - Button is hidden by default; only displayed when a custom link is entered via ACF.
 * - Appearance animations: Consistent with Home page data-aos standard (fade-up sequence).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en   = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$section = $args ?? array();

// Section Title / Badge text (ACF or default)
$badge_text = ! empty( $section['title'] ) ? $section['title'] : ( $is_en ? 'R&D SYSTEM' : 'HỆ THỐNG R&D' );
if ( $is_en && ( 'HỆ THỐNG R&D' === $badge_text || 'Hệ thống R&D' === $badge_text ) ) {
	$badge_text = 'R&D SYSTEM';
}

// Retrieve repeater items or fallback
$items      = $section['items'] ?? array();
$first_item = ! empty( $items[0] ) ? $items[0] : array();

// Item Title
$raw_item_title = $first_item['title'] ?? ( $section['heading'] ?? '' );
if ( empty( $raw_item_title ) || ( $is_en && preg_match( '/[\x{00C0}-\x{1EF9}]/u', $raw_item_title ) ) ) {
	$main_title = $is_en
		? "Advanced Formulation<br>&amp; <strong>Biotechnology R&amp;D</strong><br>for Vietnamese Brands."
		: "Năng lực nghiên cứu<br><strong>sản xuất &amp; công nghệ</strong><br>tiên phong tại Việt Nam.";
} else {
	$main_title = $raw_item_title;
	// Auto-format bold and rhythm if needed
	if ( false === strpos( $main_title, '<strong' ) && false === strpos( $main_title, '<b' ) ) {
		$main_title = str_replace(
			array( 'sản xuất & công nghệ', 'sản xuất &amp; công nghệ', 'Năng lực nghiên cứu sản xuất' ),
			array( '<strong>sản xuất &amp; công nghệ</strong>', '<strong>sản xuất &amp; công nghệ</strong>', 'Năng lực nghiên cứu<br><strong>sản xuất &amp; công nghệ</strong>' ),
			$main_title
		);
	}
}

// Item Desc
$raw_desc = $first_item['desc'] ?? ( $section['content'] ?? '' );
if ( empty( $raw_desc ) || ( $is_en && preg_match( '/[\x{00C0}-\x{1EF9}]/u', $raw_desc ) ) ) {
	$main_desc = $is_en
		? "VINACOS R&D Center pioneers active extraction, bio-analysis, and turn-key OEM/ODM cosmetic formulation complying with cGMP & FDA standards."
		: "VINACOS tập trung khai thác nguyên liệu tiềm năng, phân tích hoạt chất và phát triển công thức mỹ phẩm hoàn chỉnh OEM/ODM đạt chuẩn quốc tế cGMP và FDA.";
} else {
	$main_desc = wp_strip_all_tags( $raw_desc );
}

// Button logic: Ẩn mặc định, chỉ hiển thị khi có link hợp lệ được nhập trong ACF (không fallback link mặc định)
$raw_btn_link = $first_item['btn_link'] ?? ( $section['btn_link'] ?? '' );
$btn_url      = '';
if ( is_array( $raw_btn_link ) ) {
	$btn_url = ! empty( $raw_btn_link['url'] ) ? trim( $raw_btn_link['url'] ) : '';
} elseif ( is_string( $raw_btn_link ) ) {
	$btn_url = trim( $raw_btn_link );
}

if ( $is_en && ! empty( $btn_url ) ) {
	$btn_url = str_replace(
		array( '/tam-the-cong-su-rd-oem-odm/', '/tam-the-cong-su-rd-oem-odm', '/oem-odm-gia-cong-unila-viet-nam/' ),
		array( '/en/rd-system-oem-odm/', '/en/rd-system-oem-odm/', '/en/rd-system-oem-odm/' ),
		$btn_url
	);
}

$show_button = ! empty( $btn_url ) && '#' !== $btn_url;
$btn_text    = ! empty( $first_item['btn_text'] ) ? $first_item['btn_text'] : ( $section['btn_text'] ?? ( $is_en ? 'Learn More' : 'Tìm hiểu thêm' ) );
if ( $is_en && ( 'Tìm hiểu thêm' === $btn_text || 'Xem thêm' === $btn_text ) ) {
	$btn_text = 'Learn More';
}

// Background image (Desktop): Dùng ảnh trang Tâm thế cộng sự phông xanh dương (bg-rd-system-blue.webp) theo yêu cầu, hoặc ảnh custom từ ACF nếu có
$custom_bg_id = $section['image'] ?? ( $first_item['image'] ?? 0 );
$bg_url       = '';
if ( ! empty( $custom_bg_id ) ) {
	$bg_url = is_numeric( $custom_bg_id ) ? wp_get_attachment_image_url( (int) $custom_bg_id, 'full' ) : (string) $custom_bg_id;
}
// Nếu chưa upload ảnh riêng hoặc đang dùng ảnh cũ, mặc định dùng ảnh phông xanh dương bg-rd-system-blue.webp
if ( empty( $bg_url ) || false !== strpos( $bg_url, 'tam-the-cong-su-vinacos.jpg' ) || false !== strpos( $bg_url, 'bg-rd-system.webp' ) || false !== strpos( $bg_url, 'bg-tam-the-cong-su.webp' ) ) {
	$bg_url = get_template_directory_uri() . '/static/img/vinacos/bg-rd-system-blue.webp';
}

// Background image (Mobile): Có field riêng trong ACF để đổi ảnh phù hợp cho mobile
$custom_mobi_id = $section['image_mobile'] ?? ( $first_item['image_mobile'] ?? 0 );
$bg_mobi_url    = '';
if ( ! empty( $custom_mobi_id ) ) {
	$bg_mobi_url = is_numeric( $custom_mobi_id ) ? wp_get_attachment_image_url( (int) $custom_mobi_id, 'full' ) : (string) $custom_mobi_id;
}
if ( empty( $bg_mobi_url ) ) {
	$bg_mobi_url = $bg_url;
}
?>

<section class="home-3-section home-rd-section" id="rd-system">
	<div class="home-rd-card" style="--rd-bg: url('<?php echo esc_url( $bg_url ); ?>');" data-aos="fade-up" data-aos-duration="700">
		<!-- Content Area (Left on Desktop, Top on Mobile: Text first) -->
		<div class="home-rd-content">
			<!-- Top Badge: Subtitle -->
			<div class="home-rd-badge" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
				<span class="home-rd-badge-text">
					<?php echo wp_kses_post( $badge_text ); ?>
				</span>
			</div>

			<!-- Main Content: Title + Description + (Optional) Button -->
			<div class="home-rd-quote-wrap">
				<h2 class="home-rd-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
					<?php echo wp_kses_post( $main_title ); ?>
				</h2>
				<div class="home-rd-desc" data-aos="fade-up" data-aos-duration="700" data-aos-delay="500">
					<?php echo wp_kses_post( nl2br( $main_desc ) ); ?>
				</div>
				<?php if ( $show_button ) : ?>
					<div class="home-rd-action" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
						<a href="<?php echo esc_url( $btn_url ); ?>" class="home-rd-btn" title="<?php echo esc_attr( $btn_text ); ?>">
							<span><?php echo esc_html( $btn_text ); ?></span>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Mobile Photo Banner (Visible only on < 1025px, Below text on Mobile) -->
		<div class="home-rd-mobile-media" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
			<img src="<?php echo esc_url( $bg_mobi_url ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $badge_text ) ); ?> - VINACOS" loading="lazy" width="800" height="450">
		</div>
	</div>
</section>
