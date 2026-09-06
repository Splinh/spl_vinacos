<?php
/**
 * Contact — 100% Unila Contact Section (Address & Interactive Form).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
?>
<?php
$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();

$home_lbl   = $is_en ? 'Home' : 'Trang chủ';
$crumb_lbl  = $is_en ? 'VINACOS – Contact Us' : 'VINACOS Việt Nam – Liên hệ';
$title_lbl  = $is_en ? 'Contact Us' : 'Liên hệ';
$sub_lbl    = $is_en ? 'Please submit your details to receive FREE PRODUCT INSIGHT CONSULTATION.' : 'Vui lòng để lại thông tin để nhận TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT MIỄN PHÍ.';
$ph_name    = $is_en ? 'Full Name *' : 'Họ và tên *';
$ph_phone   = $is_en ? 'Phone Number *' : 'Số điện thoại *';
$ph_email   = $is_en ? 'Email Address *' : 'Email *';
$ph_need    = $is_en ? 'Cosmetics Needs (e.g. Sunscreen, Serum...)' : 'Nhu cầu gia công (vd: Kem chống nắng, Serum...)';
$ph_msg     = $is_en ? 'Your Message...' : 'Nội dung lời nhắn...';
$btn_submit = $is_en ? 'Submit Consultation Request' : 'Gửi yêu cầu tư vấn';

$lbl_company = $is_en ? 'B&B VINACOS CO., LTD' : 'CÔNG TY TNHH B&B VINACOS';
$lbl_branch  = $is_en ? 'TP.HCM Branch' : 'Chi nhánh TP.HCM';
$lbl_hq      = $is_en ? 'Headquarters' : 'Trụ sở chính';
$lbl_factory = $is_en ? 'cGMP Factory' : 'Nhà máy sản xuất';
$lbl_tax     = $is_en ? 'Tax ID' : 'Mã số thuế';

$addr_branch = $is_en ? 'No. 44, Thanh Xuan 31 St., Thoi An Ward, Ho Chi Minh City' : 'Số 44, Thạnh Xuân 31, Phường Thới An, Thành Phố Hồ Chí Minh';
$addr_hq     = $is_en ? 'Land plot No. 55, Map sheet 22, Dao Xa, Phu Tho Province.' : 'Thửa đất số 55, tờ bản đồ 22, Đào Xá, Tỉnh Phú Thọ.';
$val_tax     = '2601138503';
?>
<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?= esc_html( $home_lbl ) ?></a>
				<span class="separator"> - </span>
				<span class="last"><?= esc_html( $crumb_lbl ) ?></span>
			</p>
		</nav>
	</div>
</section>

<section class="contact-section section-large pt-6 md:pt-10">
	<div class="container">
		<div class="row -mt-10">
			<div class="col w-full mt-10 lg:w-1/3">
				<div class="box-contact">
					<h1 class="site-title text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4"><?= esc_html( $title_lbl ) ?></h1>
					<div class="footer-address mt-6 border-t border-slate-100 pt-6">
						<h2 class="text-lg md:text-xl font-bold text-slate-900 leading-snug mb-4"><?= esc_html( $lbl_company ) ?></h2>
						<ul class="space-y-4 text-sm text-slate-700">
							<li class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
								<strong class="text-slate-900 shrink-0 font-bold"><?= esc_html( $lbl_branch ) ?>:</strong>
								<span class="leading-relaxed"><?= esc_html( $addr_branch ) ?></span>
							</li>
							<li class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
								<strong class="text-slate-900 shrink-0 font-bold"><?= esc_html( $lbl_hq ) ?>:</strong>
								<span class="leading-relaxed"><?= esc_html( $addr_hq ) ?></span>
							</li>
							<li class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
								<strong class="text-slate-900 shrink-0 font-bold"><?= esc_html( $lbl_factory ) ?>:</strong>
								<span class="leading-relaxed"><?= $is_en ? 'cGMP / FDA certified cosmetics & packaging manufacturing facility' : 'Nhà máy gia công mỹ phẩm & bao bì chai lọ chuẩn cGMP / FDA' ?></span>
							</li>
							<li class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
								<strong class="text-slate-900 shrink-0 font-bold">Hotline / Zalo:</strong>
								<span class="inline-flex flex-wrap items-center gap-x-2 gap-y-1 font-semibold text-primary">
									<a href="tel:0906941088" class="hover:underline whitespace-nowrap">0906.941.088</a>
								</span>
							</li>
							<li class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
								<strong class="text-slate-900 shrink-0 font-bold">Email:</strong>
								<span><a href="mailto:bbvinacos@gmail.com" class="text-primary hover:underline font-medium">bbvinacos@gmail.com</a></span>
							</li>
							<li class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-2">
								<strong class="text-slate-900 shrink-0 font-bold"><?= esc_html( $lbl_tax ) ?>:</strong>
								<span class="leading-relaxed"><?= esc_html( $val_tax ) ?></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col w-full mt-10 lg:w-2/3">
				<div class="contact-form">
					<form action="#" method="post" class="wpcf7-form">
						<h3><?= esc_html( $sub_lbl ) ?></h3>
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
								<input class="wpcf7-form-control wpcf7-text" placeholder="<?= esc_attr( $ph_need ) ?>" type="text" name="Need" />
							</div>
							<div class="form-group col mt-8 w-full">
								<textarea class="wpcf7-form-control wpcf7-textarea" placeholder="<?= esc_attr( $ph_msg ) ?>" rows="4" name="Message"></textarea>
							</div>
							<div class="form-group col mt-8 w-full">
								<button type="submit" class="btn-lined">
									<span><?= esc_html( $btn_submit ) ?></span>
									<?= spl_icon( 'plus', '', 16 ) ?>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
