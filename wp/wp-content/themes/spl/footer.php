<?php
/**
 * The template for displaying the footer — VINACOS / Unila Style 100%.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

?>

	<div class="backdrop backdrop-menu"></div>
	<div class="backdrop backdrop-mega-menu"></div>
	<div class="backdrop backdrop-search"></div>
	<div class="backdrop backdrop-category"></div>
	<div class="cta-fixed">
		<ul>
			<li class="back-to-top"><?= spl_icon( 'arrow-up', '', 20 ) ?></li>
			<li><a href="tel:0902666746"><?= spl_icon( 'phone', '', 20 ) ?></a></li>
			<li><a href="mailto:info@vinacos.com.vn"><?= spl_icon( 'envelope', '', 20 ) ?></a></li>
			<li>
				<a href="https://www.facebook.com/">
					<img src="https://unila.com.vn/wp-content/uploads/2024/06/mess.png" alt="" width="48" height="32" class="alignnone size-full wp-image-83" />
				</a>
			</li>
			<li>
				<a href="https://zalo.me/0902666746">
					<img src="https://unila.com.vn/wp-content/uploads/2024/06/zalo.png" alt="" width="40" height="16" class="alignnone size-full wp-image-85" />
				</a>
			</li>
		</ul>
	</div>
</main>

<footer class="bg-neutral-50">
	<div class="container">
		<div class="footer-top section">
			<div class="row -mt-10">
				<div class="col w-full mt-10 lg:w-1/2">
					<div class="footer-address">
						<h3><span style="font-size: 24pt;">CÔNG TY TNHH VINACOS VIỆT NAM</span></h3>
						<ul>
							<li><strong>Văn phòng:</strong> KCN Thái Hòa, Xã Đức Lập, Tỉnh Tây Ninh / VP TP.HCM</li>
							<li><strong>Nhà máy:</strong> Nhà máy mỹ phẩm đạt chuẩn FDA / GMP</li>
							<li><strong>Hotline:</strong> <a href="tel:0902666746">0902.666.746</a></li>
							<li><strong>Email:</strong> <a href="mailto:info@vinacos.com.vn">info@vinacos.com.vn</a></li>
						</ul>
					</div>
				</div>
				<div class="col w-full mt-10 lg:w-1/2">
					<div class="footer-form">
						<div class="wpcf7 no-js">
							<form action="#" method="post" class="wpcf7-form init">
								<p>Hãy liên hệ với chúng tôi để được tư vấn và nhận mẫu thử miễn phí.</p>
								<div class="row">
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-text" placeholder="Họ và tên" type="text" name="FullName" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-tel" placeholder="Số điện thoại" type="tel" name="Phone" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-email" placeholder="Email" type="email" name="Email" required /></span>
									</div>
									<div class="form-group col w-full sm:w-1/2">
										<span class="wpcf7-form-control-wrap"><input size="40" class="wpcf7-form-control wpcf7-text" placeholder="Bạn đang cần gì?" type="text" name="Message" /></span>
									</div>
									<div class="form-group form-submit col w-full">
										<button class="btn-lined" type="submit"><span>Gửi</span><?= spl_icon( 'plus', '', 16 ) ?></button>
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
					<p class="footer-title">Liên kết nhanh</p>
					<ul id="footer-1" class="footer-menu">
						<li><a href="<?php echo esc_url( home_url( '/tam-the-cong-su-unila-viet-nam/' ) ); ?>">Giới thiệu</a></li>
						<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản phẩm</a></li>
						<li><a href="<?php echo esc_url( home_url( '/oem-odm-gia-cong-unila-viet-nam/' ) ); ?>">OEM/ODM</a></li>
						<li><a href="<?php echo esc_url( home_url( '/tin-tuc-unila-viet-nam/' ) ); ?>">Tin tức</a></li>
						<li><a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>">Liên hệ</a></li>
					</ul>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title">Danh mục sản phẩm</p>
					<ul id="footer-2" class="footer-menu">
						<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Chăm Sóc Da Mặt</a></li>
						<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Chăm Sóc Body</a></li>
						<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Chăm Sóc Tóc</a></li>
						<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Cá Nhân</a></li>
						<li><a href="<?php echo esc_url( home_url( '/san-pham-gia-cong-unila-viet-nam/' ) ); ?>">Sản Phẩm Dành Cho Spa</a></li>
					</ul>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<p class="footer-title">Mạng xã hội</p>
					<div class="social-list">
						<ul>
							<li><a href="#" target="_blank" title="Facebook"><?= spl_icon( 'facebook', '', 18 ) ?></a></li>
							<li><a href="#" target="_blank" title="Youtube"><?= spl_icon( 'youtube', '', 18 ) ?></a></li>
							<li><a href="#" target="_blank" title="Instagram"><?= spl_icon( 'instagram', '', 18 ) ?></a></li>
							<li><a href="#" target="_blank" title="Tiktok"><?= spl_icon( 'tiktok', '', 18 ) ?></a></li>
							<li><a href="#" target="_blank" title="Linkedin"><?= spl_icon( 'linkedin', '', 18 ) ?></a></li>
						</ul>
					</div>
				</div>
				<div class="col w-full mt-10 md:w-1/2 lg:w-1/4">
					<div class="footer-copyright">
						<p>© <?php echo date( 'Y' ); ?> VINACOS VIỆT NAM. All Rights Reserved.</p>
						<p><a href="#">Chính sách bảo mật</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
