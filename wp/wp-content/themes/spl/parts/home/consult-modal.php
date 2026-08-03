<?php
/**
 * Consult Modal Popup (TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT)
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();

$section = $args ?? array();
$title   = $section['title'] ?? ( $is_en ? 'Please submit your details for FREE PRODUCT INSIGHT CONSULTATION.' : 'Vui lòng để lại thông tin để nhận TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT MIỄN PHÍ.' );
$image   = is_array( $section['image'] ?? null ) ? ( $section['image']['url'] ?? '' ) : ( is_numeric( $section['image'] ?? null ) ? wp_get_attachment_url( $section['image'] ) : ( $section['image'] ?? '' ) );

$ph_name  = $is_en ? 'Full Name *' : 'Họ và tên *';
$ph_phone = $is_en ? 'Phone Number *' : 'Số điện thoại *';
$ph_email = $is_en ? 'Email Address *' : 'Email *';
$ph_prod  = $is_en ? 'Target Cosmetics Product Line' : 'Dòng sản phẩm gia công quan tâm';
$ph_msg   = $is_en ? 'Detailed Consultation Questions...' : 'Vấn đề cần tư vấn chi tiết...';
$btn_send = $is_en ? 'SUBMIT CONSULTATION REQUEST' : 'GỬI YÊU CẦU TƯ VẤN';

if ( empty( $image ) ) {
	$image = get_template_directory_uri() . '/assets/img/vinacos/popup-banner.jpg';
}
?>

<div class="modal modal-product" id="modal-popup-contact" data-fx-modal>
	<div class="modal-wrap">
		<div class="modal-body">
			<div class="left">
				<div class="image img-cover">
					<img class="lozad" src="<?php echo esc_url( $image ); ?>" loading="lazy" alt="VINACOS - Cosmetics OEM/ODM Research" width="500" height="700">
				</div>
			</div>
			<div class="right">
				<div class="wpcf7">
					<form action="#" method="post" class="wpcf7-form">
						<h3><?php echo esc_html( $title ); ?></h3>
						<div class="row">
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-text" placeholder="<?= esc_attr( $ph_name ) ?>" required type="text" name="FullName" />
							</div>
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-tel" placeholder="<?= esc_attr( $ph_phone ) ?>" required type="tel" name="Phone" />
							</div>
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-email" placeholder="<?= esc_attr( $ph_email ) ?>" required type="email" name="Email" />
							</div>
							<div class="form-group col mt-8 w-full sm:w-1/2">
								<input class="wpcf7-form-control wpcf7-text" placeholder="<?= esc_attr( $ph_prod ) ?>" type="text" name="Title" />
							</div>
							<div class="form-group col mt-8 w-full">
								<input class="wpcf7-form-control wpcf7-text" placeholder="<?= esc_attr( $ph_msg ) ?>" type="text" name="Message" />
							</div>
							<div class="form-captcha-submit col w-full flex items-center flex-wrap justify-between gap-5 mt-8">
								<button type="submit" class="btn-lined">
									<span><?= esc_html( $btn_send ) ?></span>
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
