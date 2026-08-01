<?php
/**
 * Contact — Locations section.
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;
?><?php
$is_en = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();

$title_sec  = $is_en ? 'VINACOS Facility Network' : 'Hệ thống cơ sở VINACOS';
$sub_sec    = $is_en ? 'TP.HCM Branch Office, Headquarters & cGMP Certified Cosmetics Factory' : 'Văn phòng chi nhánh TP.HCM, Trụ sở chính & Nhà máy sản xuất của Công ty TNHH B&B Vinacos';

$tab_1 = $is_en ? 'TP.HCM Branch' : 'Chi nhánh TP.HCM';
$tab_2 = $is_en ? 'Phu Tho HQ' : 'Trụ sở chính Phú Thọ';
$tab_3 = $is_en ? 'cGMP / FDA Factory' : 'Nhà máy cGMP / FDA';

$lbl_addr  = $is_en ? 'Address' : 'Địa chỉ';
$lbl_phone = $is_en ? 'Phone' : 'Điện thoại';
$lbl_fax   = $is_en ? 'Fax / Office' : 'Fax / ĐT bàn';
$lbl_hours = $is_en ? 'Working Hours' : 'Thời gian làm việc';
$btn_map   = $is_en ? 'Get Directions' : 'Chỉ đường trên bản đồ';
?>
<section class="mb-14 md:mb-20">
	<div class="container">
		<div class="flex items-center gap-3 mb-3">
			<span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
			<h2 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight"><?= esc_html( $title_sec ) ?></h2>
		</div>
		<p class="text-sm text-slate-500 mb-8 ml-5"><?= esc_html( $sub_sec ) ?></p>

		<!-- Location Tabs -->
		<div class="flex flex-wrap gap-2 mb-6" id="location-tabs" role="tablist">
			<button onclick="switchLocation(0)" role="tab" aria-selected="false"
				class="location-tab flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all border-2 border-slate-200 bg-white text-slate-600 hover:border-primary-400 hover:text-primary-600">
				<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-3.67A2 2 0 0 1 7.73 3h8.54a2 2 0 0 1 1.32.33L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M9 22V12h6v10"/><path d="M2 7h20"/><path d="M12 22v-6"/></svg> <?= esc_html( $tab_1 ) ?>
			</button>
			<button onclick="switchLocation(1)" role="tab" aria-selected="false"
				class="location-tab flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all border-2 border-slate-200 bg-white text-slate-600 hover:border-emerald-400 hover:text-emerald-600">
				<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22V4a2 2 0 0 0-2-2H3a2 2 0 0 0-2 2v18h13z"/><path d="M20 22V10a2 2 0 0 0-2-2h-4v14h6z"/><path d="M23 22v-6a2 2 0 0 0-2-2h-1v8h3z"/><path d="M4 6h3"/><path d="M4 10h3"/><path d="M4 14h3"/><path d="M4 18h3"/><path d="M17 12h2"/><path d="M17 16h2"/></svg> <?= esc_html( $tab_2 ) ?>
			</button>
			<button onclick="switchLocation(2)" role="tab" aria-selected="false"
				class="location-tab flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all border-2 border-slate-200 bg-white text-slate-600 hover:border-amber-400 hover:text-amber-600">
				<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22V4a2 2 0 0 0-2-2H3a2 2 0 0 0-2 2v18h13z"/><path d="M20 22V10a2 2 0 0 0-2-2h-4v14h6z"/><path d="M23 22v-6a2 2 0 0 0-2-2h-1v8h3z"/><path d="M4 6h3"/><path d="M4 10h3"/><path d="M4 14h3"/><path d="M4 18h3"/><path d="M17 12h2"/><path d="M17 16h2"/></svg> <?= esc_html( $tab_3 ) ?>
			</button>
		</div>

		<!-- Location Cards -->
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-premium">

			<!-- Left Info Panel (5 cols) -->
			<div class="lg:col-span-5 flex flex-col justify-between" id="location-info-panel">
				<div>
					<!-- Badge -->
					<div class="mb-4" id="location-badge">
						<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-600 border border-primary-100">
							<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-3.67A2 2 0 0 1 7.73 3h8.54a2 2 0 0 1 1.32.33L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M9 22V12h6v10"/><path d="M2 7h20"/><path d="M12 22v-6"/></svg> <?= esc_html( $tab_1 ) ?>
						</span>
					</div>

					<!-- Company Name -->
					<h3 class="text-xl md:text-2xl font-black text-slate-800 tracking-tight leading-tight mb-2" id="location-name"><?= $is_en ? 'Office & Cosmetics Packaging Warehouse' : 'Văn phòng & Kho bao bì Chai lọ Mỹ phẩm' ?></h3>
					<p class="text-xs font-bold text-slate-400 mb-6" id="location-company"><?= $is_en ? 'B&B VINACOS CO., LTD' : 'CÔNG TY TNHH B&B VINACOS' ?></p>

					<!-- Details -->
					<div class="space-y-4">
						<div class="flex items-start gap-3">
							<div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center flex-shrink-0 mt-0.5">
								<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
							</div>
							<div>
								<p class="text-xs text-slate-400 font-medium"><?= esc_html( $lbl_addr ) ?></p>
								<p class="text-sm font-bold text-slate-700 leading-relaxed" id="location-address"><?= $is_en ? '44 Thanh Xuan 31, Thoi An Ward, Dist 12, HCMC' : '44 Thạnh Xuân 31, P. Thới An, Q. 12, TP.HCM' ?></p>
							</div>
						</div>

						<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
							<div class="flex items-start gap-3">
								<div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center flex-shrink-0 mt-0.5">
									<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
								</div>
								<div>
									<p class="text-xs text-slate-400 font-medium"><?= esc_html( $lbl_phone ) ?></p>
									<p class="text-sm font-bold text-slate-700" id="location-phone">0967 198 483</p>
								</div>
							</div>

							<div class="flex items-start gap-3" id="location-fax-row">
								<div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center flex-shrink-0 mt-0.5">
									<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
								</div>
								<div>
									<p class="text-xs text-slate-400 font-medium"><?= esc_html( $lbl_fax ) ?></p>
									<p class="text-sm font-bold text-slate-700" id="location-fax">—</p>
								</div>
							</div>
						</div>

						<div class="flex items-start gap-3">
							<div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center flex-shrink-0 mt-0.5">
								<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
							</div>
							<div>
								<p class="text-xs text-slate-400 font-medium"><?= esc_html( $lbl_hours ) ?></p>
								<p class="text-sm font-bold text-slate-700" id="location-hours">8:00 – 18:00 (Mon–Sun)</p>
							</div>
						</div>
					</div>
				</div>

				<!-- CTA -->
				<div class="mt-8 pt-6 border-t border-slate-100">
					<a href="https://maps.google.com/?q=44+Thạnh+Xuân+31+Quận+12+TPHCM" target="_blank" id="location-direction-btn"
						class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition-all hover:shadow-lg active:scale-95">
						<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg> <?= esc_html( $btn_map ) ?>
					</a>
				</div>
			</div>

			<!-- Right Map Area (7 cols) -->
			<div class="lg:col-span-7 rounded-2xl overflow-hidden min-h-[350px] border border-slate-100 shadow-inner relative" id="location-map-container">
				<iframe id="location-map"
					src="https://maps.google.com/maps?q=44+Thanh+Xuan+31+Quan+12+Ho+Chi+Minh&z=15&output=embed"
					class="absolute inset-0 w-full h-full border-0"
					allowfullscreen=""
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"
					title="Bản đồ cơ sở VINACOS">
				</iframe>
			</div>

		</div>
	</div>
</section>

<script>
	const isEn = <?= $is_en ? 'true' : 'false' ?>;
	const locationData = [
		{
			badge: '<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-3.67A2 2 0 0 1 7.73 3h8.54a2 2 0 0 1 1.32.33L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M9 22V12h6v10"/><path d="M2 7h20"/><path d="M12 22v-6"/></svg> ' + (isEn ? 'TP.HCM Branch' : 'Chi nhánh TP.HCM'),
			badgeClass: 'bg-primary-50 text-primary-600 border-primary-100',
			tabClass: 'active-store',
			name: isEn ? 'Office & Cosmetics Packaging Warehouse' : 'Văn phòng & Kho bao bì Chai lọ Mỹ phẩm',
			company: isEn ? 'B&B VINACOS CO., LTD' : 'CÔNG TY TNHH B&B VINACOS',
			address: isEn ? 'No. 44 Thanh Xuan 31 St., Thoi An Ward, Dist. 12, HCMC' : 'Số 44 Đường Thạnh Xuân 31, Phường Thới An, Quận 12, TP. Hồ Chí Minh',
			phone: '0967 198 483',
			fax: '—',
			hours: isEn ? '8:00 – 18:00 (Mon–Sun)' : '8:00 – 18:00 (T2–CN)',
			mapSrc: 'https://maps.google.com/maps?q=44+Thanh+Xuan+31+Quan+12+Ho+Chi+Minh&z=15&output=embed',
			directionUrl: 'https://maps.google.com/?q=44+Thạnh+Xuân+31+Quận+12+TPHCM'
		},
		{
			badge: '<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22V4a2 2 0 0 0-2-2H3a2 2 0 0 0-2 2v18h13z"/><path d="M20 22V10a2 2 0 0 0-2-2h-4v14h6z"/><path d="M23 22v-6a2 2 0 0 0-2-2h-1v8h3z"/><path d="M4 6h3"/><path d="M4 10h3"/><path d="M4 14h3"/><path d="M4 18h3"/><path d="M17 12h2"/><path d="M17 16h2"/></svg> ' + (isEn ? 'Phu Tho HQ' : 'Trụ sở chính Phú Thọ'),
			badgeClass: 'bg-emerald-50 text-emerald-600 border-emerald-100',
			tabClass: 'active-factory1',
			name: isEn ? 'Official Registered Headquarters' : 'Trụ sở đăng ký kinh doanh chính',
			company: isEn ? 'B&B VINACOS CO., LTD (Tax Code: 2601138503)' : 'CÔNG TY TNHH B&B VINACOS (MST: 2601138503)',
			address: isEn ? 'Plot 55, Map 22, Dao Xa Ward, Thanh Thuy Dist, Phu Tho Province' : 'Thửa đất số 55, tờ bản đồ số 22, Xã Đào Xá, Huyện Thanh Thủy, Tỉnh Phú Thọ',
			phone: '0906 941 088',
			fax: '—',
			hours: isEn ? '8:00 – 17:00 (Mon–Fri)' : '8:00 – 17:00 (T2–T6)',
			mapSrc: 'https://maps.google.com/maps?q=Dao+Xa+Thanh+Thuy+Phu+Tho&z=15&output=embed',
			directionUrl: 'https://maps.google.com/?q=Đào+Xá+Thanh+Thủy+Phú+Thọ'
		},
		{
			badge: '<svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22V4a2 2 0 0 0-2-2H3a2 2 0 0 0-2 2v18h13z"/><path d="M20 22V10a2 2 0 0 0-2-2h-4v14h6z"/><path d="M23 22v-6a2 2 0 0 0-2-2h-1v8h3z"/><path d="M4 6h3"/><path d="M4 10h3"/><path d="M4 14h3"/><path d="M4 18h3"/><path d="M17 12h2"/><path d="M17 16h2"/></svg> ' + (isEn ? 'cGMP / FDA Factory' : 'Nhà máy cGMP / FDA'),
			badgeClass: 'bg-amber-50 text-amber-600 border-amber-100',
			tabClass: 'active-factory2',
			directionUrl: 'https://maps.google.com/?q=1351+Quốc+Lộ+51+Long+Phước+Long+Thành+Đồng+Nai'
		}
	];

	function switchLocation(index) {
		const loc = locationData[index];
		if (!loc) return;

		// Update tabs
		const tabs = document.querySelectorAll('.location-tab');
		tabs.forEach((tab, i) => {
			tab.classList.remove('active', 'active-store', 'active-factory1', 'active-factory2');
			tab.setAttribute('aria-selected', 'false');
			tab.style.borderColor = '';
			tab.style.background = '';
			tab.style.color = '';
			if (i === index) {
				tab.classList.add('active');
				tab.setAttribute('aria-selected', 'true');
				if (index === 0) {
					tab.style.borderColor = '#1e73be';
					tab.style.backgroundColor = '#f0f7ff';
					tab.style.color = '#1e73be';
				} else if (index === 1) {
					tab.style.borderColor = '#10b981';
					tab.style.backgroundColor = '#ecfdf5';
					tab.style.color = '#10b981';
				} else if (index === 2) {
					tab.style.borderColor = '#f59e0b';
					tab.style.backgroundColor = '#fffbeb';
					tab.style.color = '#f59e0b';
				}
			}
		});

		// Update info panel with fade
		const panel = document.getElementById('location-info-panel');
		panel.style.opacity = '0';
		panel.style.transform = 'translateY(8px)';

		setTimeout(() => {
			document.getElementById('location-badge').innerHTML =
				`<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold ${loc.badgeClass} border">${loc.badge}</span>`;
			document.getElementById('location-name').textContent = loc.name;
			document.getElementById('location-company').textContent = loc.company;
			document.getElementById('location-address').textContent = loc.address;
			document.getElementById('location-phone').textContent = loc.phone;
			document.getElementById('location-fax').textContent = loc.fax;
			document.getElementById('location-hours').textContent = loc.hours;
			document.getElementById('location-direction-btn').href = loc.directionUrl;

			// Update map
			document.getElementById('location-map').src = loc.mapSrc;

			panel.style.opacity = '1';
			panel.style.transform = 'translateY(0)';
		}, 200);
	}

	// Add transition to info panel and select first tab
	document.addEventListener('DOMContentLoaded', () => {
		const infoPanel = document.getElementById('location-info-panel');
		if (infoPanel) {
			infoPanel.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
		}
		switchLocation(0);
	});
</script>
