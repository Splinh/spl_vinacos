<?php
/**
 * Template Name: OEM/ODM R&D System — 100% Exact Unila HTML layout for /oem-odm-gia-cong-unila-viet-nam/.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

get_header();

global $post;
$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
?>

<section class="banner-child">
	<div class="swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image img-cover">
					<?php $hero_banner_img = get_template_directory_uri() . '/static/img/banner/' . ( $is_en ? 'brand-banner-en.jpg' : 'brand-banner-vi.jpg' ) . '?v=brand'; ?>
					<img src="<?php echo esc_url( $hero_banner_img ); ?>" alt="OEM/ODM VINACOS">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?= $is_en ? 'Home' : 'Trang chủ' ?></a>
				<span class="separator"> - </span>
				<span class="last"><?= $is_en ? 'VINACOS – R&D System & Cosmetics OEM/ODM' : 'VINACOS Việt Nam – Đội ngũ chuyên gia R&D VINACOS' ?></span>
			</p>
		</nav>
	</div>
</section>

<section class="oem-1-section section-t-large section-b-small">
	<div class="container">
		<div class="block-content text-center">
			<h1 class="site-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				<?= $is_en ? 'Formulation Innovation & R&D Excellence' : 'Sáng tạo &amp; sáng chế' ?>
			</h1>
			<div class="site-desc mt-3" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
				<?php if ( $is_en ) : ?>
					<p><span style="font-weight: 400;">VINACOS R&D Center manages the entire lifecycle from formulation development, stability testing, efficacy verification to commercial transfer under strict standards: </span><b>Efficacy – Safety – Stability – Regulatory Compliance</b><span style="font-weight: 400;">.</span></p>
					<p><span style="font-weight: 400;">Every formula is backed by dermatological science and clean ingredient sourcing to deliver </span><b>differentiated, high-performance skincare ready for global market launch</b><span style="font-weight: 400;">.</span></p>
				<?php else : ?>
					<p><span style="font-weight: 400;">Phòng Nghiên cứu &amp; Phát triển (R&amp;D) VINACOS là bộ phận chuyên môn đảm nhận toàn bộ quy trình từ xây dựng công thức, thử nghiệm, đánh giá ổn định đến chuyển giao sản xuất, đáp ứng các tiêu chí cốt lõi: </span><b>hiệu quả – an toàn – ổn định – tuân thủ pháp lý</b><span style="font-weight: 400;">.</span></p>
					<p><span style="font-weight: 400;">Mỗi công thức được xây dựng trên nền tảng khoa học, kiểm soát chặt chẽ nguyên liệu và quy trình, ưu tiên thành phần an toàn, thân thiện với da và môi trường, đồng thời tối ưu chi phí, để tạo ra những sản phẩm </span><b>khác biệt, có giá trị thực tiễn cao và sẵn sàng thương mại hóa</b><span style="font-weight: 400;">.</span></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="oem-1-list mt-10">
			<div class="oem-1-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				<div class="image">
					<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/03/bai-bao-1.png" data-src="https://unila.com.vn/wp-content/uploads/2026/03/bai-bao-1.png" loading="lazy" alt="R&D Publication 1">
				</div>
			</div>
			<div class="oem-1-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
				<div class="image">
					<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/03/bai-bao-2.png" data-src="https://unila.com.vn/wp-content/uploads/2026/03/bai-bao-2.png" loading="lazy" alt="R&D Publication 2">
				</div>
			</div>
			<div class="oem-1-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="900">
				<div class="image">
					<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/03/bai-bao-3.png" data-src="https://unila.com.vn/wp-content/uploads/2026/03/bai-bao-3.png" loading="lazy" alt="R&D Publication 3">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="oem-2-section section-small">
	<div class="container">
		<div class="row -mt-10 items-center">
			<div class="col w-full mt-10 lg:w-1/2">
				<div class="block-content" data-aos="fade-right" data-aos-duration="700" data-aos-delay="300">
					<h2 class="site-title">
						<?= $is_en ? 'Formulation Base R&D' : 'Nghiên cứu nền chất' ?>
					</h2>
					<div class="accordion-list mt-6">
						<div class="accordion-item active">
							<div class="accordion-head">
								<h3 class="accordion-title">
									<?= $is_en ? 'SILICONE-FREE WATER-DROPLET CREAM BASE' : 'NỀN KEM VỠ NƯỚC FREE SILICONE' ?>
								</h3>
								<i class="accordion-icon fa-light fa-plus"></i>
							</div>
							<div class="accordion-content" style="display: block;">
								<div class="full-content">
									<h3><strong><?= $is_en ? 'Silicone-free water-droplet cream base' : 'Nền kem vỡ nước free silicone' ?></strong></h3>
									<p><?= $is_en ? 'Water-burst texture breaks into refreshing micro-water droplets upon application, delivering intense cooling & hydration without silicone buildup. VINACOS successfully engineered a 100% silicone-free lipid-friendly base.' : 'Kem vỡ nước khi thoa lên da, chất kem sẽ vỡ ra thành các giọt nước, các giọt nước đủ lớn để tạo hiệu ứng thị giác tươi mát, cảm quan mang lại hiệu quả làm mát và dưỡng ẩm. VINACOS đã nghiên cứu thành công nền vỡ nước free silicone hoàn toàn thân thiện với màng lipit làn da.' ?></p>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<div class="accordion-head">
								<h3 class="accordion-title">
									<?= $is_en ? 'RICE HUSK SILICA EXFOLIATING BASE' : 'NỀN TẨY TẾ BÀO CHẾT SILICA NGUỒN GỐC TỪ VỎ TRẤU VIỆT NAM' ?>
								</h3>
								<i class="accordion-icon fa-light fa-plus"></i>
							</div>
							<div class="accordion-content">
								<div class="full-content">
									<h3><b><?= $is_en ? 'Bio-sustainable natural rice husk silica scrubbing system' : 'Nền tẩy tế bào chết silica từ vỏ trấu Việt Nam – Hệ hạt sinh học bền vững' ?></b></h3>
									<p><?= $is_en ? 'Uses upcycled silica extracted from Vietnamese agricultural rice husk, replacing microplastics and mined sand. Controlled spherical particles gently cleanse dead skin cells without micro-tears while remaining 100% eco-biodegradable.' : 'Nền chất sử dụng silica chiết xuất từ vỏ trấu Việt Nam, nguồn nguyên liệu tái tạo từ phụ phẩm nông nghiệp, thay thế silica truyền thống từ cát. Hạt silica được kiểm soát kích thước và bề mặt, giúp loại bỏ tế bào chết nhẹ nhàng mà không gây trầy xước vi mô.' ?></p>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<div class="accordion-head">
								<h3 class="accordion-title">
									<?= $is_en ? 'PURIFYING MINERAL CLAY MASK BASE' : 'MẶT NẠ ĐẤT SÉT' ?>
								</h3>
								<i class="accordion-icon fa-light fa-plus"></i>
							</div>
							<div class="accordion-content">
								<div class="full-content">
									<h3><strong><?= $is_en ? 'Purifying mineral clay mask base' : 'Mặt nạ đất sét' ?></strong></h3>
									<p><?= $is_en ? 'Formulated with ultra-purified kaolin & bentonite clay complex to selectively absorb excess sebum & impurities without tight drying sensation.' : 'Nền chất được xây dựng trên tổ hợp đất sét khoáng (kaolin, bentonite hoặc các biến thể xử lý tinh sạch) với khả năng hấp phụ chọn lọc bã nhờn và tạp chất trong lỗ chân lông.' ?></p>
								</div>
							</div>
						</div>

						<div class="accordion-item">
							<div class="accordion-head">
								<h3 class="accordion-title">
									<?= $is_en ? 'CHAMOMILE SOOTHING MUD MASK BASE' : 'MẶT NẠ BÙN CÚC LA MÃ' ?>
								</h3>
								<i class="accordion-icon fa-light fa-plus"></i>
							</div>
							<div class="accordion-content">
								<div class="full-content">
									<h3><strong><?= $is_en ? 'Chamomile soothing mud mask base' : 'Mặt nạ bùn cúc La Mã' ?></strong></h3>
									<p><?= $is_en ? 'Combines trace-element mineral mud with Bisabolol-rich Chamomile extract for instant redness relief and skin barrier strengthening.' : 'Mặt nạ bùn sử dụng bùn khoáng giàu vi lượng kết hợp với chiết xuất Cúc La Mã mang lại hiệu quả làm dịu da tức thì và phục hồi hàng rào bảo vệ da.' ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col w-full mt-10 lg:w-1/2">
				<div class="swiper-relative one-slider is-page" data-aos="fade-left" data-aos-duration="700" data-aos-delay="300">
					<div class="swiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="image img-cover">
									<?php $rd_img = get_template_directory_uri() . '/static/img/nghien-cuu-nen-chat-vinacos.png'; ?>
									<img class="lozad" src="<?php echo esc_url( $rd_img ); ?>" data-src="<?php echo esc_url( $rd_img ); ?>" loading="lazy" alt="VINACOS R&D Formulation Base">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="oem-3-section section-small">
	<div class="container">
		<div class="block-content text-center">
			<h2 class="site-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				<?= $is_en ? 'Research & Material Partners' : 'Đối tác' ?>
			</h2>
			<div class="site-desc mt-3" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
				<p><strong><?= $is_en ? 'Academic R&D Collaboration' : 'Đồng hành nghiên cứu' ?></strong></p>
				<p><?= $is_en ? 'VINACOS R&D Center collaborates closely with academic researchers and university faculties specializing in Organic & Cosmetic Technology to ensure high scientific rigor and practical efficacy.' : 'Phòng R&D VINACOS hợp tác chặt chẽ với các đối tác nghiên cứu học thuật nhằm nâng cao chiều sâu khoa học trong phát triển sản phẩm.' ?></p>
				<p><b><?= $is_en ? 'Global Raw Material Suppliers' : 'Đồng hành nguyên liệu' ?></b></p>
				<p><?= $is_en ? 'We partner with world-renowned ingredient suppliers meeting international cGMP/FDA standards for full traceability, active purity, and formula innovation.' : 'Đội ngũ R&D tại VINACOS cộng tác cùng các nhà cung cấp nguyên liệu uy tín toàn cầu, đáp ứng tiêu chí chất lượng, pháp lý và nguồn gốc rõ ràng.' ?></p>
			</div>
		</div>

		<div class="swiper-relative two-slider is-page mt-10" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1300">
			<div class="swiper">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="oem-3-item">
							<div class="image img-cover">
								<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/03/Dong-hanh-nguyen-lieu.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/03/Dong-hanh-nguyen-lieu.jpg" loading="lazy" alt="Raw Materials Partner">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mobile-only">
				<div class="swiper-pagination"></div>
			</div>
			<div class="desktop-only">
				<div class="swiper-button is-abs">
					<div class="button-prev"><i class="fa-light fa-chevron-left"></i></div>
					<div class="button-next"><i class="fa-light fa-chevron-right"></i></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- QUY TRÌNH NGHIÊN CỨU VÀ SẢN XUẤT SECTION -->
<section class="oem-5-section section-t-small section-b-large">
	<div class="container">
		<div class="block-content text-center">
			<h2 class="site-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				<?= $is_en ? 'R&D & Manufacturing Process' : 'Quy trình nghiên cứu và sản xuất' ?>
			</h2>
			<div class="site-desc mt-3" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
			</div>
		</div>

		<div class="oem-5-list mt-10 xl:mt-14">
			<div class="oem-5-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
				<div class="image img-cover">
					<img class="lozad" src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" data-src="https://unila.com.vn/wp-content/uploads/2026/04/LAB.jpg" loading="lazy" alt="VINACOS R&D Center">
				</div>
				<div class="caption">
					<div class="desc" style="max-width: 540px; font-size: 15px; line-height: 1.65; color: #475569;">
						<p style="margin-bottom: 14px;"><?= $is_en ? 'VINACOS Cosmetics R&D Center operates on two core pillars: <strong style="color: #1e293b; font-weight: 600;">Active Raw Ingredient Research</strong> and <strong style="color: #1e293b; font-weight: 600;">Product Formulation Engineering</strong> to build a solid scientific foundation for clean, safe, and commercially viable beauty solutions.' : 'Phòng Nghiên cứu &amp; Phát triển (R&amp;D) mỹ phẩm VINACOS định hướng hoạt động dựa trên hai trụ cột là: <strong style="color: #1e293b; font-weight: 600;">nghiên cứu nguyên liệu</strong> và <strong style="color: #1e293b; font-weight: 600;">nghiên cứu sản phẩm</strong> nhằm xây dựng nền tảng khoa học vững chắc cho các giải pháp mỹ phẩm an toàn, hiệu quả và có tính ứng dụng cao.' ?></p>
						<p><?= $is_en ? 'Ingredient research focuses on standardization and bio-activity optimization, while product research delivers complete, sensory-pleasing formulations tailored for automated scale-up manufacturing.' : 'Trong đó, nghiên cứu nguyên liệu hướng đến đánh giá, chuẩn hóa và tối ưu khả năng ứng dụng, còn nghiên cứu sản phẩm tập trung phát triển công thức hoàn chỉnh, tối ưu hiệu quả, cảm quan và khả năng sản xuất, đáp ứng nhu cầu thị trường.' ?></p>
					</div>
				</div>
			</div>

			<div class="oem-5-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
				<div class="caption">
					<h3 class="title">
						<?= $is_en ? '01 - Benchmarking Existing Products' : '01 - Từ sản phẩm có sẵn' ?>
					</h3>
					<p class="job mt-3">
						<?= $is_en ? 'For brands seeking formula re-engineering or performance upgrading.' : 'Dành cho doanh nghiệp muốn tái tạo, cải tiến hoặc phát triển sản phẩm tương đương.' ?>
					</p>
					<div class="desc mt-6">
						<p><?= $is_en ? 'VINACOS analyzes benchmark sample formulations, identifies key active ratios, and re-designs formulas with optimized ingredients for superior stability & cost efficiency.' : 'VINACOS phân tích công thức mẫu, xác định vai trò từng thành phần, sau đó thiết kế lại công thức với nguyên liệu phù hợp, đảm bảo tương đương về hiệu quả, tối ưu hơn về chi phí và độ ổn định.' ?></p>
					</div>
				</div>
			</div>

			<div class="oem-5-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="900">
				<div class="caption">
					<h3 class="title">
						<?= $is_en ? '02 - Active Ingredient Centric' : '02 - Từ hoạt chất chính' ?>
					</h3>
					<p class="job mt-3">
						<?= $is_en ? 'For brands with a designated hero active ingredient.' : 'Dành cho doanh nghiệp đã có định hướng thành phần cốt lõi.' ?>
					</p>
					<div class="desc mt-6">
						<p><?= $is_en ? 'Starting from specified hero actives, VINACOS evaluates physicochemical properties, selects compatible delivery systems, and builds optimal cosmetic bases.' : 'Từ hoạt chất chỉ định, VINACOS đánh giá tính chất lý hóa, lựa chọn hệ nền và tá dược tương thích, xây dựng công thức phù hợp với dạng bào chế và đối tượng mục tiêu – đảm bảo hoạt chất phát huy tối đa hiệu quả.' ?></p>
					</div>
				</div>
			</div>

			<div class="oem-5-item" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1200">
				<div class="caption">
					<h3 class="title">
						<?= $is_en ? '03 - Natural Botanical Formulation' : '03 - Từ nguyên liệu thảo mộc' ?>
					</h3>
					<p class="job mt-3">
						<?= $is_en ? 'For brands focused on organic, herbal & eco-friendly lines.' : 'Dành cho doanh nghiệp phát triển theo hướng thiên nhiên, thảo dược.' ?>
					</p>
					<div class="desc mt-6">
						<p><?= $is_en ? 'VINACOS selects bio-proven botanical extracts, optimizes extraction purity, and formulates stable natural skincare preserving full herbal potency.' : 'VINACOS lựa chọn nguyên liệu có công dụng được kiểm chứng, tối ưu phương pháp chiết xuất, phối hợp hoạt chất bổ trợ và xây dựng công thức ổn định – giữ trọn hiệu quả từ thiên nhiên trong từng sản phẩm.' ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

