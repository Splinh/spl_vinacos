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
			<li class="back-to-top" title="Lên đầu trang"><?= spl_icon( 'arrow-up', '', 20 ) ?></li>
			<li><a href="tel:0902666746" title="Gọi hotline"><?= spl_icon( 'phone', '', 20 ) ?></a></li>
			<li><a href="mailto:info@vinacos.com.vn" title="Gửi email"><?= spl_icon( 'envelope', '', 20 ) ?></a></li>
			<li>
				<a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" title="Messenger">
					<?= spl_icon( 'messenger', '', 22 ) ?>
				</a>
			</li>
			<li>
				<a href="https://zalo.me/0902666746" target="_blank" rel="noopener noreferrer" title="Zalo">
					<?= spl_icon( 'zalo', '', 22 ) ?>
				</a>
			</li>
		</ul>
	</div>
</main>

<footer class="footer-vinacos bg-[#1e60a3] text-white">
	<div class="container">
		<div class="footer-top section">
			<div class="row -mt-10">
				<div class="col w-full mt-10 lg:w-1/2">
					<div class="footer-address">
						<h3><span style="font-size: 24pt; color: #ffffff;"><?php echo esc_html( pll__( 'CÔNG TY TNHH VINACOS VIỆT NAM' ) ); ?></span></h3>
						<ul>
							<li><strong><?php echo esc_html( pll__( 'Văn phòng:' ) ); ?></strong> <?php echo esc_html( pll__( 'KCN Thái Hòa, Xã Đức Lập, Tỉnh Tây Ninh / VP TP.HCM' ) ); ?></li>
							<li><strong><?php echo esc_html( pll__( 'Nhà máy:' ) ); ?></strong> <?php echo esc_html( pll__( 'Nhà máy mỹ phẩm đạt chuẩn FDA / GMP' ) ); ?></li>
							<li><strong><?php echo esc_html( pll__( 'Hotline:' ) ); ?></strong> <a href="tel:0902666746">0902.666.746</a></li>
							<li><strong><?php echo esc_html( pll__( 'Email:' ) ); ?></strong> <a href="mailto:info@vinacos.com.vn">info@vinacos.com.vn</a></li>
						</ul>
					</div>
				</div>
				<div class="col w-full mt-10 lg:w-1/2">
					<div class="footer-form">
						<div class="wpcf7 no-js">
							<form action="#" method="post" class="wpcf7-form init">
								<p><?php echo esc_html( pll__( 'Hãy liên hệ với chúng tôi để được tư vấn và nhận mẫu thử miễn phí.' ) ); ?></p>
								<div class="row">
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-text" placeholder="<?php echo esc_attr( pll__( 'Họ và tên' ) ); ?>" type="text" name="FullName" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-tel" placeholder="<?php echo esc_attr( pll__( 'Số điện thoại' ) ); ?>" type="tel" name="Phone" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-email" placeholder="<?php echo esc_attr( pll__( 'Email' ) ); ?>" type="email" name="Email" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-text" placeholder="<?php echo esc_attr( pll__( 'Bạn đang cần gì?' ) ); ?>" type="text" name="Message" /></span>
									</div>
									<div class="form-group form-submit col w-full">
										<button class="btn-lined" type="submit"><span><?php echo esc_html( pll__( 'Gửi' ) ); ?></span><?= spl_icon( 'plus', '', 16 ) ?></button>
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
					<p class="footer-title"><?php echo esc_html( pll__( 'Liên kết nhanh' ) ); ?></p>
					<ul id="footer-1" class="footer-menu">
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/partner-mindset-about/' ) : home_url( '/tam-the-cong-su-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Giới thiệu' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Sản phẩm' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/rd-system-oem-odm/' ) : home_url( '/oem-odm-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'OEM/ODM' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/contact-us/' ) : home_url( '/lien-he/' ) ); ?>"><?php echo esc_html( pll__( 'Tuyển dụng' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/news/' ) : home_url( '/tin-tuc/' ) ); ?>"><?php echo esc_html( pll__( 'Tin tức' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/contact-us/' ) : home_url( '/lien-he/' ) ); ?>"><?php echo esc_html( pll__( 'Liên hệ' ) ); ?></a></li>
					</ul>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title"><?php echo esc_html( pll__( 'Danh mục sản phẩm' ) ); ?></p>
					<ul id="footer-2" class="footer-menu">
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/cosmetics-oem-products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Sản Phẩm Chăm Sóc Da Mặt' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/cosmetics-oem-products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Sản Phẩm Chăm Sóc Body' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/cosmetics-oem-products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Sản Phẩm Chăm Sóc Tóc' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/cosmetics-oem-products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Sản Phẩm Cá Nhân' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $is_en ? home_url( '/en/cosmetics-oem-products/' ) : home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>"><?php echo esc_html( pll__( 'Sản Phẩm Dành Cho Spa' ) ); ?></a></li>
					</ul>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title"><?php echo esc_html( pll__( 'Mạng xã hội' ) ); ?></p>
					<ul id="footer-social-text" class="footer-menu mb-4 space-y-2">
						<li><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"><?php echo esc_html( pll__( 'Facebook' ) ); ?></a></li>
						<li><a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer"><?php echo esc_html( pll__( 'Youtube' ) ); ?></a></li>
						<li><a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"><?php echo esc_html( pll__( 'Instagram' ) ); ?></a></li>
						<li><a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer"><?php echo esc_html( pll__( 'Tiktok' ) ); ?></a></li>
						<li><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><?php echo esc_html( pll__( 'Linkedin' ) ); ?></a></li>
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
						<p class="text-sm text-blue-100 leading-snug">Copyright <?php echo date( 'Y' ); ?> VINACOS. <?php echo esc_html( pll__( 'All Rights Reserved.' ) ); ?><br><?php echo esc_html( $is_en ? 'Design by VINACOS' : 'Design by VINACOS' ); ?></p>
						<p><a href="<?php echo esc_url( $is_en ? home_url( '/en/privacy-policy/' ) : home_url( '/chinh-sach-bao-mat/' ) ); ?>" class="text-blue-100 hover:text-white underline"><?php echo esc_html( pll__( 'Chính sách bảo mật' ) ); ?></a></p>
						<p><a href="<?php echo esc_url( $is_en ? home_url( '/en/oem-odm-cosmetics-manufacturing/' ) : home_url( '/oem-odm-gia-cong-unila-viet-nam/' ) ); ?>" class="text-blue-100 hover:text-white underline"><?php echo esc_html( pll__( 'Gia công mỹ phẩm là gì ?' ) ); ?></a></p>
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
