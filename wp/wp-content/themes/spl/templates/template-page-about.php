<?php
/**
 * Template Name: Giới Thiệu — 100% Exact Unila HTML layout for /tam-the-cong-su-unila-viet-nam/.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- Banner Child & Breadcrumbs -->
<?php get_template_part( 'parts/about/hero' ); ?>

<!-- About Section 1: Tổ chức kiên định & Thông điệp từ trái tim -->
<?php get_template_part( 'parts/about/story' ); ?>
<?php get_template_part( 'parts/about/message' ); ?>

<!-- About Section 2: Timeline Từng mốc dấu ấn -->
<?php get_template_part( 'parts/about/timeline' ); ?>

<!-- About Section 3: Tầm nhìn & Sứ mệnh -->
<?php get_template_part( 'parts/about/mission' ); ?>

<!-- About Section 4: Những con số biết nói -->
<?php get_template_part( 'parts/about/stats' ); ?>

<!-- About Section 5: Sức mạnh tập thể (Slide 8 phòng ban) -->
<?php get_template_part( 'parts/about/team' ); ?>

<!-- About Section 6: Nhà máy & Quy trình sản xuất -->
<?php get_template_part( 'parts/about/cta' ); ?>

<?php
get_footer();
