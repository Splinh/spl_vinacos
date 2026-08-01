<?php
/**
 * Cooperation template part - Process (Quy trình).
 *
 * @package SPL
 */

use SPL\Core\Helper;

$title    = $args['title'] ?? 'Quy Trình Gia Công Mỹ Phẩm 4 Bước';
$subtitle = $args['subtitle'] ?? 'Chỉ 4 bước đơn giản từ ý tưởng ban đầu đến thương hiệu xuất xưởng trong 20 ngày';

$steps = $args['steps'] ?? [
	[
		'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
		'title' => 'Tư vấn & Chọn concept',
		'description' => 'Trao đổi định hướng sản phẩm, tư vấn công thức R&D và lựa chọn gói gia công phù hợp'
	],
	[
		'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 2v7.31c0 1.24-.76 2.34-1.92 2.76L4 13.5V20c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-6.5l-4.08-1.43c-1.16-.42-1.92-1.52-1.92-2.76V2h-4z"/></svg>',
		'title' => 'Gửi mẫu thử (Sample)',
		'description' => 'Thử nghiệm mẫu test miễn phí, điều chỉnh chất kem & tầng hương đến khi bạn hoàn toàn hài lòng'
	],
	[
		'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
		'title' => 'Ký HĐ & Làm pháp lý',
		'description' => 'Ký hợp đồng gia công, NDA bảo mật, thiết kế bao bì & hoàn thiện hồ sơ công bố mỹ phẩm'
	],
	[
		'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
		'title' => 'Sản xuất & Bàn giao 20 ngày',
		'description' => 'Sản xuất khép kín tại nhà máy chuẩn cGMP/FDA, kiểm định chất lượng & giao thành phẩm tận nơi'
	]
];
?>

<section class="max-w-7xl mx-auto px-4 py-14 md:py-20 border-t border-slate-100">
	<div class="text-center mb-12">
		<div class="flex items-center gap-3 justify-center mb-4">
			<span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
			<h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight"><?php echo esc_html( $title ); ?></h2>
		</div>
		<?php if ( $subtitle ) : ?>
			<p class="text-sm text-slate-500 max-w-xl mx-auto"><?php echo esc_html( $subtitle ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( ! empty( $steps ) ) : ?>
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
			<?php 
			$idx = 1;
			foreach ( $steps as $step ) : 
				// Pick colors based on step number to look rich
				$colors = [
					1 => [ 'bg' => 'bg-primary/5 text-primary', 'badge' => 'bg-primary' ],
					2 => [ 'bg' => 'bg-emerald-50 text-emerald-600', 'badge' => 'bg-emerald-500' ],
					3 => [ 'bg' => 'bg-amber-50 text-amber-600', 'badge' => 'bg-amber-500' ],
					4 => [ 'bg' => 'bg-blue-50 text-blue-600', 'badge' => 'bg-blue-500' ],
				];
				$color = $colors[ $idx ] ?? $colors[1];
				?>
				<div class="text-center group">
					<div class="w-16 h-16 <?php echo $color['bg']; ?> rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary group-hover:text-white transition-all duration-300 relative">
						<?php 
						if ( str_starts_with( trim( $step['icon'] ), '<svg' ) ) {
							echo $step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							echo '<i class="' . esc_attr( $step['icon'] ) . ' text-xl"></i>';
						}
						?>
						<span class="absolute -top-2 -right-2 w-6 h-6 <?php echo $color['badge']; ?> group-hover:bg-emerald-500 text-white rounded-full text-xs font-black flex items-center justify-center transition-colors duration-300"><?php echo esc_html( $idx ); ?></span>
					</div>
					<h3 class="font-bold text-slate-800 text-sm mb-1 group-hover:text-primary transition-colors duration-300"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html( $step['description'] ); ?></p>
				</div>
				<?php 
				$idx++;
			endforeach; 
			?>
		</div>
	<?php endif; ?>
</section>
