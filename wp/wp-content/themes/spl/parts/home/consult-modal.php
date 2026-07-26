<?php
/**
 * Consult Modal Popup (TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
$title   = $section['title'] ?? 'Vui lòng để lại thông tin để nhận TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT MIỄN PHÍ.';
$image   = is_array( $section['image'] ?? null ) ? ( $section['image']['url'] ?? '' ) : ( is_numeric( $section['image'] ?? null ) ? wp_get_attachment_url( $section['image'] ) : ( $section['image'] ?? '' ) );

if ( empty( $image ) ) {
	$image = 'https://unila.com.vn/wp-content/uploads/2024/10/GIA-CONG-MY-PHAM-UNILA-PRODUCT-INSIGHT-POP-UP-01.jpg';
}
?>

<div class="modal modal-product" id="modal-popup-contact" data-fx-modal>
	<div class="modal-wrap">
		<div class="modal-body">
			<div class="left">
				<div class="image img-cover">
					<img class="lozad" src="<?php echo esc_url( $image ); ?>" loading="lazy" alt="VINACOS - Đơn vị nghiên cứu sản xuất mỹ phẩm" width="500" height="700">
				</div>
			</div>
			<div class="right">
				<div class="wpcf7">
					<form action="#" method="post" class="wpcf7-form">
						<h3><?php echo esc_html( $title ); ?></h3>
						<div class="row">
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-text" placeholder="Họ và tên *" required type="text" name="FullName" />
							</div>
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-tel" placeholder="Số điện thoại *" required type="tel" name="Phone" />
							</div>
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-email" placeholder="Email *" required type="email" name="Email" />
							</div>
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-text" placeholder="Dòng sản phẩm gia công quan tâm" type="text" name="Title" />
							</div>
							<div class="form-group col mt-8 w-full">
								<input class="wpcf7-form-control wpcf7-text" placeholder="Vấn đề cần tư vấn chi tiết..." type="text" name="Message" />
							</div>
							<div class="form-captcha-submit col w-full flex items-center flex-wrap justify-between gap-5 mt-8">
								<button type="submit" class="btn-lined">
									<span>GỬI YÊU CẦU TƯ VẤN</span>
									<?= spl_icon( 'arrow-right', '', 16 ) ?>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
