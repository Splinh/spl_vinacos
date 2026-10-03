<?php
/**
 * The Template for displaying all pages.
 * http://codex.wordpress.org/Template_Hierarchy
 *
 * @author HD
 */

\defined( 'ABSPATH' ) || die;

get_header();

$is_en      = function_exists( 'pll_current_language' ) && 'en' === pll_current_language();
$home_label = $is_en ? 'Home' : 'Trang chủ';
?>

<section class="global-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $home_label ); ?></a>
				<span class="separator"> - </span>
				<span class="last"><?php the_title(); ?></span>
			</p>
		</nav>
	</div>
</section>

<section class="standard-page-section section-large py-10 md:py-16">
	<div class="container">
		<div class="standard-page-wrap max-w-4xl mx-auto">
			<h1 class="site-title text-2xl md:text-3xl font-bold text-slate-900 mb-8"><?php the_title(); ?></h1>
			<div class="standard-page-content prose leading-relaxed text-slate-700">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						the_content();
					}
				}
				?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
