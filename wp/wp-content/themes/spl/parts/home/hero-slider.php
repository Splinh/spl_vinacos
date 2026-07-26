<?php
/**
 * Hero Banner Slider — 100% Unila HTML structure & VINACOS titles.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
$slides  = $section['slides'] ?? array();

$default_vinacos_slides = array(
	array(
		'title_lines' => array( 'MỞ LỐI KỶ NGUYÊN', 'MỸ PHẨM VIỆT', 'CHUẨN KHOA HỌC' ),
		'desc'        => 'VINACOS là đơn vị tiên phong ứng dụng khoa học vào nghiên cứu và gia công mỹ phẩm sạch. Dẫn đầu để đặt ra tiêu chuẩn mới cho thương hiệu mỹ phẩm Việt.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => '#about-us',
	),
	array(
		'title_lines' => array( 'HIỂU LÀN DA VIỆT', 'ĐỒNG HÀNH', 'THƯƠNG HIỆU VIỆT' ),
		'desc'        => 'VINACOS tin rằng người Việt xứng đáng được chăm sóc bằng những công thức an toàn, lành tính, chuẩn y khoa.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => '#services',
	),
	array(
		'title_lines' => array( 'RỦI RO LỚN NHẤT', 'LÀ SAI TỪ CÔNG THỨC' ),
		'desc'        => 'VINACOS đặt sự an toàn và tính minh bạch lên hàng đầu: 0% sai sót về hoạt chất cấm – 100% kiểm nghiệm công thức – Hồ sơ pháp lý A-Z.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => '#rd-system',
	),
	array(
		'title_lines' => array( 'SỨC MẠNH', 'TỪ HỆ THỐNG R&D' ),
		'desc'        => '300+ công thức độc quyền. 10+ năm kinh nghiệm R&D. Đằng sau mỗi sản phẩm là dữ liệu khoa học & kiểm định lâm sàng.',
		'btn_text'    => 'Xem thêm',
		'btn_link'    => '#products',
	),
);

$img_base = get_template_directory_uri() . '/static/img/banner';
?>

<section class="home-banner one-scroll">
	<div class="banner-slider">
		<div class="swiper key-visual-swiper start">
			<div class="swiper-wrapper key-visual-wrapper">
				<?php for ( $i = 0; $i < 4; $i++ ) : 
					$s = $slides[ $i ] ?? array();
					$v = $default_vinacos_slides[ $i ];

					$desktop_img = $img_base . '/slide' . ( $i + 1 ) . '-desktop.jpg';
					$mobile_img  = $img_base . '/slide' . ( $i + 1 ) . '-mobile.jpg';

					$title_lines = array();
					if ( ! empty( $s['title_line_1'] ) ) { $title_lines[] = $s['title_line_1']; }
					if ( ! empty( $s['title_line_2'] ) ) { $title_lines[] = $s['title_line_2']; }
					if ( ! empty( $s['title_line_3'] ) ) { $title_lines[] = $s['title_line_3']; }
					if ( empty( $title_lines ) ) {
						$title_lines = $v['title_lines'];
					}

					$desc     = ! empty( $s['description'] ) ? $s['description'] : $v['desc'];
					$btn_text = $v['btn_text'];
					$btn_url  = $v['btn_link'];
				?>
				<div class="swiper-slide key-visual-slide" data-swiper-autoplay="2999">
					<div class="image key-img-box">
						<img class="mb" src="<?php echo esc_url( $mobile_img ); ?>" alt="">
						<img src="<?php echo esc_url( $desktop_img ); ?>" alt="<?php echo esc_attr( $title_lines[0] ?? '' ); ?>">
					</div>
					<div class="caption container">
						<div class="content">
							<div class="banner-title">
								<?php foreach ( $title_lines as $line ) : ?>
								<div class="split-parent"><strong><?php echo esc_html( $line ); ?></strong></div>
								<?php endforeach; ?>
							</div>
							<?php if ( ! empty( $desc ) ) : ?>
							<div class="desc">
								<p><?php echo esc_html( $desc ); ?></p>
							</div>
							<?php endif; ?>
						</div>
						<?php if ( ! empty( $btn_text ) ) : ?>
						<div class="button mt-4 xl:mt-6">
							<a class="btn-lined" href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>">
								<span><?php echo esc_html( $btn_text ); ?></span>
								<?= spl_icon( 'plus', '', 16 ) ?>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endfor; ?>
			</div>
			<div class="swiper-pagination container"></div>
		</div>
	</div>
</section>
