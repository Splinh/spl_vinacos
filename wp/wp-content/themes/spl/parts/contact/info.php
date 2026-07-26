<?php
/**
 * Contact — 100% Unila Contact Section (Address & Interactive Form).
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

$section = $args ?? array();
?>
<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
				<span class="separator"> - </span>
				<span class="last">VINACOS Việt Nam – Liên hệ</span>
			</p>
		</nav>
	</div>
</section>

<section class="contact-section section-large">
	<div class="container">
		<div class="row -mt-10">
			<div class="col w-full mt-10 lg:w-1/3">
				<div class="box-contact">
					<h1 class="site-title">Liên hệ</h1>
					<div class="footer-address mt-8">
						<h2>CÔNG TY TNHH VINACOS</h2>
						<ul class="mt-5">
							<li><strong>Trụ sở: </strong>4E đường Cư Xá Đồng Tiến, Phường Diên Hồng, TP. Hồ Chí Minh, Việt Nam</li>
							<li><strong>Nhà máy:</strong> 160 A12, Khu phố 2, Phường Phú Tân, Tỉnh Vĩnh Long, Việt Nam</li>
							<li><strong>Hotline: </strong><a href="tel:0933505222">0933.505.222</a> – <a href="tel:0946544904">0946.544.904</a></li>
							<li><strong>Email: </strong><a href="mailto:giacongvinacos@gmail.com">giacongvinacos@gmail.com</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col w-full mt-10 lg:w-2/3">
				<div class="contact-form">
					<form action="#" method="post" class="wpcf7-form">
						<h3>Vui lòng để lại thông tin để nhận TƯ VẤN GIẢI PHÁP PRODUCT INSIGHT MIỄN PHÍ.</h3>
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
								<input class="wpcf7-form-control wpcf7-text" placeholder="Nhu cầu gia công (vd: Kem chống nắng, Serum...)" type="text" name="Need" />
							</div>
							<div class="form-group col mt-8 w-full">
								<textarea class="wpcf7-form-control wpcf7-textarea" placeholder="Nội dung lời nhắn..." rows="4" name="Message"></textarea>
							</div>
							<div class="form-group col mt-8 w-full">
								<button type="submit" class="btn-lined">
									<span>Gửi yêu cầu tư vấn</span>
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
