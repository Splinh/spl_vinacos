<?php
/**
 * The template for displaying the footer — VINACOS / Unila Style 100%.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'pll__' ) ) {
	function pll__( string $string ): string {
		return __( $string, 'spl' );
	}
}

$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
?>

	<div class="backdrop backdrop-menu"></div>
	<div class="backdrop backdrop-mega-menu"></div>
	<div class="backdrop backdrop-search"></div>
	<div class="backdrop backdrop-category"></div>
	<div class="cta-fixed">
		<ul>
			<li><a href="tel:0906941088" title="Gọi hotline" aria-label="Gọi hotline"><?= spl_icon( 'phone', '', 22 ) ?></a></li>
			<li><a href="mailto:bbvinacos@gmail.com" title="Gửi email" aria-label="Gửi email"><?= spl_icon( 'envelope', '', 22 ) ?></a></li>
			<li>
				<a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" title="Messenger" aria-label="Messenger">
					<?= spl_icon( 'messenger', '', 24 ) ?>
				</a>
			</li>
			<li class="item-zalo">
				<a href="https://zalo.me/0906941088" target="_blank" rel="noopener noreferrer" title="Zalo" aria-label="Zalo">
					<span class="zalo-text">Zalo</span>
				</a>
			</li>
		</ul>
	</div>
</main>

<footer class="footer-vinacos bg-[#1e60a3] text-white">
	<div class="container">
		<div class="footer-top section">
			<div class="row -mt-10">
<?php
// Resolve valid bilingual URLs for footer menus
$about_id   = ( $is_en && function_exists( 'pll_get_post' ) ) ? ( pll_get_post( 942, 'en' ) ?: 1052 ) : 942;
$about_url  = $about_id ? get_permalink( $about_id ) : ( $is_en ? home_url( '/en/partner-mindset-about/' ) : home_url( '/ve-chung-toi/' ) );

$shop_id    = ( $is_en && function_exists( 'pll_get_post' ) ) ? ( pll_get_post( 943, 'en' ) ?: 1123 ) : 943;
$shop_url   = $shop_id ? get_permalink( $shop_id ) : ( $is_en ? home_url( '/en/products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) );

$oem_id     = ( $is_en && function_exists( 'pll_get_post' ) ) ? ( pll_get_post( 944, 'en' ) ?: 1122 ) : 944;
$oem_url    = $oem_id ? get_permalink( $oem_id ) : ( $is_en ? home_url( '/en/rd-system-oem-odm/' ) : home_url( '/oem-odm-gia-cong-unila-viet-nam/' ) );

$news_id    = ( $is_en && function_exists( 'pll_get_post' ) ) ? ( pll_get_post( 928, 'en' ) ?: 1124 ) : 928;
$news_url   = $news_id ? get_permalink( $news_id ) : ( $is_en ? home_url( '/en/news/' ) : home_url( '/tin-tuc/' ) );

$contact_id = ( $is_en && function_exists( 'pll_get_post' ) ) ? ( pll_get_post( 937, 'en' ) ?: 1056 ) : 937;
$contact_url = $contact_id ? get_permalink( $contact_id ) : ( $is_en ? home_url( '/en/contact-us/' ) : home_url( '/lien-he/' ) );

// Resolve category URLs
$cat_facial_term = get_term_by( 'slug', $is_en ? 'facial-care' : 'cham-soc-da-mat', 'product_cat' );
$cat_facial_url  = $cat_facial_term ? get_term_link( $cat_facial_term ) : $shop_url;

$cat_body_term   = get_term_by( 'slug', $is_en ? 'body-care' : 'cham-soc-body', 'product_cat' );
$cat_body_url    = $cat_body_term ? get_term_link( $cat_body_term ) : $shop_url;

$cat_carrier_term = get_term_by( 'slug', $is_en ? 'carrier-oils' : 'dau-nen', 'product_cat' );
$cat_carrier_url  = $cat_carrier_term ? get_term_link( $cat_carrier_term ) : $shop_url;

$cat_essential_term = get_term_by( 'slug', $is_en ? 'essential-oils' : 'tinh-dau', 'product_cat' );
$cat_essential_url  = $cat_essential_term ? get_term_link( $cat_essential_term ) : $shop_url;

$cat_powder_term = get_term_by( 'slug', $is_en ? 'raw-cosmetic-powders' : 'bot-nguyen-lieu', 'product_cat' );
$cat_powder_url  = $cat_powder_term ? get_term_link( $cat_powder_term ) : $shop_url;
?>
				<div class="col w-full mt-10 lg:w-1/2">
					<div class="footer-address">
						<h3><span style="font-size: 20pt; color: #ffffff; font-weight: 800;"><?php echo esc_html( $is_en ? 'B&B VINACOS CO., LTD' : 'CÔNG TY TNHH B&B VINACOS' ); ?></span></h3>
						<ul>
							<li><strong><?php echo esc_html( $is_en ? 'Tax ID:' : 'MST:' ); ?></strong> 2601138503</li>
							<li><strong><?php echo esc_html( $is_en ? 'Headquarters:' : 'Địa chỉ (Trụ sở chính):' ); ?></strong> <?php echo esc_html( $is_en ? 'Land plot No. 55, Map sheet 22, Dao Xa, Phu Tho Province.' : 'Thửa đất số 55, tờ bản đồ 22, Đào Xá, Tỉnh Phú Thọ.' ); ?></li>
							<li><strong><?php echo esc_html( $is_en ? 'Branch:' : 'Tên chi nhánh:' ); ?></strong> <?php echo esc_html( $is_en ? 'B&B Vinacos Co., Ltd Branch' : 'Chi nhánh công ty TNHH B&B Vinacos' ); ?></li>
							<li><strong><?php echo esc_html( $is_en ? 'Branch Address:' : 'Địa chỉ chi nhánh:' ); ?></strong> <?php echo esc_html( $is_en ? 'No. 44, Thanh Xuan 31 St., Thoi An Ward, Ho Chi Minh City' : 'Số 44, Thạnh Xuân 31, Phường Thới An, Thành Phố Hồ Chí Minh' ); ?></li>
							<li><strong><?php echo esc_html( $is_en ? 'Legal Representative:' : 'Người đại diện PL:' ); ?></strong> <?php echo esc_html( $is_en ? 'NGUYEN THI SON (Director)' : 'NGUYỄN THỊ SƠN (Chức vụ: Giám đốc)' ); ?></li>
							<li><strong><?php echo esc_html( $is_en ? 'Phone:' : 'Điện thoại:' ); ?></strong> <a href="tel:0906941088">0906.941.088</a></li>
							<li><strong><?php echo esc_html( $is_en ? 'Billing Email:' : 'EMAIL nhận hóa đơn:' ); ?></strong> <a href="mailto:bbvinacos@gmail.com">bbvinacos@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col w-full mt-10 lg:w-1/2">
					<div class="footer-form">
						<div class="wpcf7 no-js">
							<form action="#" method="post" class="wpcf7-form init">
								<p><?php echo esc_html( $is_en ? 'Contact us today for complimentary consultation and free formula samples.' : 'Hãy liên hệ với chúng tôi để được tư vấn và nhận mẫu thử miễn phí.' ); ?></p>
								<div class="row">
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-text" placeholder="<?php echo esc_attr( $is_en ? 'Full Name *' : 'Họ và tên *' ); ?>" type="text" name="FullName" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-tel" placeholder="<?php echo esc_attr( $is_en ? 'Phone Number *' : 'Số điện thoại *' ); ?>" type="tel" name="Phone" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-email" placeholder="<?php echo esc_attr( $is_en ? 'Email Address *' : 'Email *' ); ?>" type="email" name="Email" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-text" placeholder="<?php echo esc_attr( $is_en ? 'What are you looking to formulate?' : 'Bạn đang cần gì?' ); ?>" type="text" name="Message" /></span>
									</div>
									<div class="form-group form-submit col w-full">
										<button class="btn-lined" type="submit"><span><?php echo esc_html( $is_en ? 'Send Message' : 'Gửi' ); ?></span><?= spl_icon( 'plus', '', 16 ) ?></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bot section">
			<div class="row -mt-10">
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title"><?php echo esc_html( $is_en ? 'Quick Links' : 'Liên kết nhanh' ); ?></p>
					<ul id="footer-1" class="footer-menu">
						<li><a href="<?php echo esc_url( $about_url ); ?>"><?php echo esc_html( $is_en ? 'About Us' : 'Giới thiệu' ); ?></a></li>
						<li><a href="<?php echo esc_url( $shop_url ); ?>"><?php echo esc_html( $is_en ? 'Products' : 'Sản phẩm' ); ?></a></li>
						<li><a href="<?php echo esc_url( $oem_url ); ?>"><?php echo esc_html( $is_en ? 'OEM/ODM R&D' : 'OEM/ODM' ); ?></a></li>
						<li><a href="<?php echo esc_url( $contact_url ); ?>"><?php echo esc_html( $is_en ? 'Careers' : 'Tuyển dụng' ); ?></a></li>
						<li><a href="<?php echo esc_url( $news_url ); ?>"><?php echo esc_html( $is_en ? 'News & Insights' : 'Tin tức' ); ?></a></li>
						<li><a href="<?php echo esc_url( $contact_url ); ?>"><?php echo esc_html( $is_en ? 'Contact Us' : 'Liên hệ' ); ?></a></li>
					</ul>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title"><?php echo esc_html( $is_en ? 'Product Categories' : 'Danh mục sản phẩm' ); ?></p>
					<ul id="footer-2" class="footer-menu">
						<li><a href="<?php echo esc_url( $cat_facial_url ); ?>"><?php echo esc_html( $is_en ? 'Facial Skincare Solutions' : 'Sản Phẩm Chăm Sóc Da Mặt' ); ?></a></li>
						<li><a href="<?php echo esc_url( $cat_body_url ); ?>"><?php echo esc_html( $is_en ? 'Body Care Formulations' : 'Sản Phẩm Chăm Sóc Body' ); ?></a></li>
						<li><a href="<?php echo esc_url( $cat_carrier_url ); ?>"><?php echo esc_html( $is_en ? 'Natural Carrier & Hair Oils' : 'Dầu Nền & Chăm Sóc Tóc' ); ?></a></li>
						<li><a href="<?php echo esc_url( $cat_essential_url ); ?>"><?php echo esc_html( $is_en ? 'Pure Natural Essential Oils' : 'Tinh Dầu Thiên Nhiên' ); ?></a></li>
						<li><a href="<?php echo esc_url( $cat_powder_url ); ?>"><?php echo esc_html( $is_en ? 'Raw Cosmetic Powders' : 'Bột Nguyên Liệu Mỹ Phẩm' ); ?></a></li>
					</ul>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title"><?php echo esc_html( $is_en ? 'Follow Us' : 'Mạng xã hội' ); ?></p>
					<ul id="footer-social-text" class="footer-menu mb-4 space-y-2">
						<li><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">Facebook</a></li>
						<li><a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer">Youtube</a></li>
						<li><a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">Instagram</a></li>
						<li><a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer">Tiktok</a></li>
						<li><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">Linkedin</a></li>
					</ul>
					<div class="social-list flex items-center gap-4 mt-4">
						<a href="https://www.facebook.com/" target="_blank" title="Facebook" class="text-white hover:text-blue-200 transition-colors"><?= spl_icon( 'facebook', '', 22 ) ?></a>
						<a href="https://www.youtube.com/" target="_blank" title="Youtube" class="text-white hover:text-blue-200 transition-colors"><?= spl_icon( 'youtube', '', 22 ) ?></a>
						<a href="https://www.instagram.com/" target="_blank" title="Instagram" class="text-white hover:text-blue-200 transition-colors"><?= spl_icon( 'instagram', '', 22 ) ?></a>
						<a href="https://www.tiktok.com/" target="_blank" title="Tiktok" class="text-white hover:text-blue-200 transition-colors"><?= spl_icon( 'tiktok', '', 22 ) ?></a>
						<a href="https://www.linkedin.com/" target="_blank" title="Linkedin" class="text-white hover:text-blue-200 transition-colors"><?= spl_icon( 'linkedin', '', 22 ) ?></a>
					</div>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<div class="footer-copyright space-y-2">
						<p class="text-sm text-blue-100 leading-snug">Copyright <?php echo date( 'Y' ); ?> VINACOS. <?php echo esc_html( $is_en ? 'All Rights Reserved.' : 'Bảo lưu mọi quyền.' ); ?><br><?php echo esc_html( $is_en ? 'Designed by VINACOS' : 'Thiết kế bởi VINACOS' ); ?></p>
						<p><a href="<?php echo esc_url( $is_en ? home_url( '/en/privacy-policy/' ) : home_url( '/chinh-sach-bao-mat/' ) ); ?>" class="text-blue-100 hover:text-white underline"><?php echo esc_html( $is_en ? 'Privacy Policy' : 'Chính sách bảo mật' ); ?></a></p>
						<p><a href="<?php echo esc_url( $oem_url ); ?>" class="text-blue-100 hover:text-white underline"><?php echo esc_html( $is_en ? 'What is Cosmetics OEM/ODM?' : 'Gia công mỹ phẩm là gì ?' ); ?></a></p>
						<div class="mt-3">
							<a href="https://www.dmca.com/Protection/Status.aspx" target="_blank" rel="nofollow" title="DMCA Protection Status" class="inline-block">
								<img src="https://images.dmca.com/Badges/dmca_protected_sml_120m.png" alt="DMCA Protected" width="120" height="28" style="height: 28px; width: auto;" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
