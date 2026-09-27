<?php
/**
 * VINACOS — Production Database Synchronization for English Language.
 *
 * Usage on VPS / Local:
 *   php wp/wp-content/themes/spl/sync-en-data.php
 * Or via WP-CLI:
 *   wp eval-file wp/wp-content/themes/spl/sync-en-data.php
 *
 * @package VINACOS
 */

$wp_load = __DIR__ . '/../../../../wp-load.php';
if ( ! file_exists( $wp_load ) ) {
	$wp_load = __DIR__ . '/../../../wp-load.php';
}
if ( ! file_exists( $wp_load ) && defined( 'ABSPATH' ) ) {
	// Already loaded inside WP-CLI
} elseif ( file_exists( $wp_load ) ) {
	require_once $wp_load;
}

echo "========================================================\n";
echo "   VINACOS PRODUCTION ENGLISH DATABASE SYNCHRONIZATION  \n";
echo "========================================================\n\n";

/**
 * Helper to find post ID by slug or Polylang translation.
 */
function vinacos_find_page( $vi_slug, $en_slug, $vi_id_fallback = 0, $en_id_fallback = 0 ) {
	if ( function_exists( 'pll_get_post' ) ) {
		$vi_page = get_page_by_path( $vi_slug );
		if ( $vi_page ) {
			$en_id = pll_get_post( $vi_page->ID, 'en' );
			if ( $en_id ) {
				return (int) $en_id;
			}
		}
		if ( $vi_id_fallback ) {
			$en_id = pll_get_post( $vi_id_fallback, 'en' );
			if ( $en_id ) {
				return (int) $en_id;
			}
		}
	}

	$en_page = get_page_by_path( $en_slug );
	if ( $en_page ) {
		return (int) $en_page->ID;
	}

	if ( $en_id_fallback && get_post( $en_id_fallback ) ) {
		return (int) $en_id_fallback;
	}

	return 0;
}

// --------------------------------------------------------------------------
// 1. Sync English About Page
// --------------------------------------------------------------------------
$about_en_id = vinacos_find_page( 've-chung-toi', 'partner-mindset-about', 942, 1052 );
echo "[1/4] Syncing English About Page (ID: {$about_en_id})...\n";

if ( $about_en_id ) {
	update_post_meta( $about_en_id, '_wp_page_template', 'templates/template-page-about.php' );
	wp_update_post( array(
		'ID'         => $about_en_id,
		'post_title' => 'About Us - VINACOS',
	) );

	$about_sections_en = array(
		array(
			'acf_fc_layout' => 'about_hero',
			'disable'       => false,
			'banner_image'  => 1231,
			'title'         => 'PARTNER MINDSET',
		),
		array(
			'acf_fc_layout' => 'about_story',
			'disable'       => false,
			'title'         => "COSMETICS <br/> R&D & <br/> MANUFACTURING",
			'image'         => false,
			'content'       => "<h2><strong>VINACOS – Driving a Clean Beauty Era from Vietnamese Botanical Resources.</strong></h2>\n" .
				"<p><strong><span style=\"color: #1e60a3;\"><i>Pioneering Leadership</i></span></strong></p>\n" .
				"<p><i>VINACOS is a science & technology enterprise pioneering clean cosmetics formulation and cGMP/FDA production in Vietnam.</i></p>\n" .
				"<p>We dedicate our heart to human talent, laboratory equipment, and quality control to ensure every formula delivered to brand partners excels in safety, efficacy, and commercial readiness. Anticipating global trends, VINACOS establishes new benchmarks, proving that Vietnamese cosmetics can stand shoulder-to-shoulder internationally.</p>\n" .
				"<p><strong><span style=\"color: #1e60a3;\"><i>Deep Empathy & Co-Creation</i></span></strong></p>\n" .
				"<p><i>We partner with beauty brands, leveraging R&D science to create gentle, effective formulations tailored for modern consumers.</i></p>\n" .
				"<p>We understand that consumers deserve skincare made with genuine safety. And brands seeking that vision require a partner who not only manufactures, but actively listens, consults, and co-shapes the product from the very beginning.</p>",
		),
		array(
			'acf_fc_layout' => 'about_message',
			'disable'       => false,
			'title'         => "The journey is still long, but we already have <strong>many achievements</strong> worth celebrating.",
			'subtitle'      => 'Your Great Company',
			'ceo_name'      => 'MS. NGUYEN HONG TRUC',
			'ceo_title'     => 'FOUNDER & CEO',
			'image'         => false,
			'content'       => "<p><i>I embarked on this journey not from grand ambitions, but from the simplest passion: a profound dedication to authentic Vietnamese beauty.</i></p>\n" .
				"<p><i>From the very beginning of this challenging entrepreneurial path, I have steadily pursued my vision: to build an enterprise that does not merely grow by numbers, but creates genuine, lasting value.</i></p>\n" .
				"<p><i>Nurturing both the material and spiritual well-being of all team members — that is our philosophy, our driving force, and our enduring belief.</i></p>",
		),
		array(
			'acf_fc_layout' => 'about_timeline',
			'disable'       => false,
			'title'         => 'Key Development Milestones',
			'timeline_items' => array(
				array(
					'year'  => '2015',
					'title' => 'R&D Inception',
					'desc'  => 'Established the first laboratory dedicated to clean cosmetics formulation research.',
				),
				array(
					'year'  => '2018',
					'title' => 'Scaling R&D Capabilities',
					'desc'  => 'Reached the milestone of 100+ proprietary cosmetic formulas for brand partners.',
				),
				array(
					'year'  => '2021',
					'title' => 'cGMP & FDA Certified Plant',
					'desc'  => 'Invested in state-of-the-art automated compounding and filling facilities.',
				),
				array(
					'year'  => '2026',
					'title' => 'Pioneering Clean Beauty Era',
					'desc'  => 'Collaborating with universities and research institutions on advanced technology transfer.',
				),
			),
		),
		array(
			'acf_fc_layout' => 'about_mission',
			'disable'       => false,
			'vision_title'  => 'Vision',
			'vision_desc'   => 'To become Vietnam’s leading science & technology enterprise in clean cosmetics R&D and international-standard OEM/ODM manufacturing.',
			'mission_title' => 'Mission',
			'mission_desc'  => 'Partnering with beauty brands to create safe, transparent, high-performance skincare tailored for modern consumers.',
		),
		array(
			'acf_fc_layout' => 'about_stats',
			'disable'       => false,
			'title'         => 'Milestones in Numbers',
			'items'         => array(
				array( 'count' => '10',  'suffix' => '+', 'title' => 'Years R&D Experience' ),
				array( 'count' => '300', 'suffix' => '+', 'title' => 'Proprietary Formulas Developed' ),
				array( 'count' => '30',  'suffix' => '+', 'title' => 'Published Scientific Papers' ),
				array( 'count' => '100', 'suffix' => '%', 'title' => 'Tested Formula Safety & Stability' ),
			),
		),
		array(
			'acf_fc_layout' => 'about_team',
			'disable'       => false,
			'title'         => 'Collective Strength & Expert Team',
			'team_items'    => array(
				array(
					'name' => 'Research & Development (R&D)',
					'desc' => 'Pharmacists and cosmetic formulation engineers specialized in active compounds and stability.',
				),
				array(
					'name' => 'Quality Assurance & Control (QA/QC)',
					'desc' => 'Strict quality inspection of incoming raw materials and outgoing production batches.',
				),
				array(
					'name' => 'Regulatory & Health Compliance',
					'desc' => 'Turnkey legal filing support: Pasteur Institute testing and Ministry of Health cosmetic notification.',
				),
				array(
					'name' => 'Production & Plant Operations',
					'desc' => 'Operating automated compounding and cleanroom filling lines compliant with cGMP standards.',
				),
			),
		),
		array(
			'acf_fc_layout' => 'about_cta',
			'disable'       => false,
			'title'         => 'cGMP & FDA Certified Cleanroom Plant',
			'image'         => 1240,
			'content'       => '<p>State-of-the-art cleanroom environment with strict temperature, humidity, and microbiological control ensuring consistent excellence across all batches.</p>',
		),
	);

	update_field( 'about_sections', $about_sections_en, $about_en_id );
	echo "   ✓ About page synced successfully.\n";
} else {
	echo "   ⚠ English About page not found.\n";
}

// --------------------------------------------------------------------------
// 2. Sync English Home Page
// --------------------------------------------------------------------------
$home_en_id = vinacos_find_page( '', 'home', 941, 1121 );
echo "\n[2/4] Syncing English Home Page (ID: {$home_en_id})...\n";

if ( $home_en_id ) {
	$home_sections_en = array(
		array(
			'acf_fc_layout' => 'hero_slider',
			'disable'       => false,
			'slides'        => array(
				array(
					'bg_image'        => 1209,
					'bg_image_mobile' => 1210,
					'title'           => "PIONEERING CLEAN BEAUTY\nSCIENTIFIC FORMULATION\nOEM/ODM EXCELLENCE",
					'description'     => 'VINACOS is a pioneer in applying dermatological science to clean cosmetics research and manufacturing, setting new benchmarks for beauty brands.',
					'button_text'     => 'Explore More',
					'button_url'      => '/en/partner-mindset-about/',
				),
				array(
					'bg_image'        => 1211,
					'bg_image_mobile' => 1212,
					'title'           => "UNDERSTANDING SKIN\nPARTNERING WITH\nGLOBAL BRANDS",
					'description'     => 'VINACOS believes every consumer deserves gentle, efficacious skincare backed by medically sound, dermatologically verified formulas.',
					'button_text'     => 'Explore More',
					'button_url'      => '/en/products/',
				),
				array(
					'bg_image'        => 1213,
					'bg_image_mobile' => 1214,
					'title'           => "THE BIGGEST RISK\nIS FORMULATION FLAW",
					'description'     => 'VINACOS prioritizes safety and transparency: 0% prohibited active ingredients – 100% stability tested – Full regulatory compliance from A to Z.',
					'button_text'     => 'Explore More',
					'button_url'      => '/en/rd-system-oem-odm/',
				),
				array(
					'bg_image'        => 1215,
					'bg_image_mobile' => 1216,
					'title'           => "STRENGTH FROM\nOUR R&D SYSTEM",
					'description'     => '300+ exclusive formulations. 10+ years of R&D experience. Behind every product lies solid scientific data and clinical trials.',
					'button_text'     => 'Explore More',
					'button_url'      => '/en/products/',
				),
			),
		),
		array(
			'acf_fc_layout' => 'about_section',
			'disable'       => false,
			'title'         => "PARTNER\nMINDSET",
			'image'         => 1234,
			'content'       => "<h3><strong>Pioneering Vision</strong></h3>\n" .
				"<p><em>VINACOS is a science & technology pioneer in clean cosmetics formulation research and cGMP/FDA OEM manufacturing in Vietnam.</em></p>\n" .
				"<p>We invest heavily in human capital, international-standard cleanrooms, and automated processing lines to ensure every formula delivered to client brands is thoroughly tested, stable, and compliant.</p>\n" .
				"<h3><strong>Empathetic Mission</strong></h3>\n" .
				"<p><em>VINACOS accompanies client brands through turnkey OEM/ODM solutions, turning formula concepts into market success.</em></p>\n",
			'btn_text'      => 'About Us',
			'btn_link'      => '/en/partner-mindset-about/',
		),
		array(
			'acf_fc_layout' => 'brand_banner',
			'disable'       => false,
			'image'         => 1218,
		),
		array(
			'acf_fc_layout' => 'rd_system',
			'disable'       => false,
			'title'         => 'R&D SYSTEM',
			'items'         => array(
				array(
					'label'    => 'R&D SYSTEM',
					'title'    => 'Advanced Formulation & Biotechnology R&D for Vietnamese Brands.',
					'desc'     => 'VINACOS R&D Center pioneers active extraction, bio-analysis, and turn-key OEM/ODM cosmetic formulation complying with cGMP & FDA standards.',
					'image'    => 1240,
					'btn_text' => 'Learn More',
					'btn_link' => '/en/rd-system-oem-odm/',
				),
			),
		),
		array(
			'acf_fc_layout' => 'key_numbers',
			'disable'       => false,
			'title'         => 'Key Highlights & Milestones',
			'bg_image'      => 1221,
			'figure_image'  => 1222,
			'items'         => array(
				array( 'count' => '100', 'suffix' => '%', 'title' => 'Formulas Stability & Efficacy Tested' ),
				array( 'count' => '300', 'suffix' => '+', 'title' => 'Proprietary R&D Formulas Developed' ),
				array( 'count' => '30',  'suffix' => '+', 'title' => 'Published Scientific Papers & Patents' ),
				array( 'count' => '10',  'suffix' => '+', 'title' => 'Years OEM/ODM Cosmetics Manufacturing' ),
			),
		),
		array(
			'acf_fc_layout' => 'product_showcase',
			'disable'       => false,
			'title'         => 'Featured Product Portfolio',
			'items'         => array(
				array(
					'title'       => 'Silicone-Free Water-Droplet Cream Base',
					'image'       => 1223,
					'description' => 'Cooling water-burst texture engineered without silicone, 100% lipid-friendly & safe for delicate sensitive skin.',
					'btn_text'    => 'Learn More',
					'btn_link'    => '/en/products/',
				),
				array(
					'title'       => 'Detoxifying Green Tea Mineral Clay Mask',
					'image'       => 1224,
					'description' => 'Absorbs excess sebum & impurities with natural mineral clay complex while preserving skin moisture barrier.',
					'btn_text'    => 'Learn More',
					'btn_link'    => '/en/products/',
				),
				array(
					'title'       => 'Natural Rice Husk Silica Exfoliator',
					'image'       => 1225,
					'description' => 'Bio-sustainable scrubbing system using upcycled rice husk silica, replacing microplastics with spherical bio-particles.',
					'btn_text'    => 'Learn More',
					'btn_link'    => '/en/products/',
				),
				array(
					'title'       => 'Chamomile Soothing & Recovery Mud Mask',
					'image'       => 1226,
					'description' => 'Combines natural mineral mud with standardized Chamomile extract for instant redness relief & skin barrier repair.',
					'btn_text'    => 'Learn More',
					'btn_link'    => '/en/products/',
				),
			),
		),
		array(
			'acf_fc_layout' => 'partners_section',
			'disable'       => false,
			'watermark'     => 'VINACOS',
			'left_title'    => 'RAW MATERIAL PARTNERS',
			'right_title'   => 'RESEARCH & ACADEMIC PARTNERS',
		),
		array(
			'acf_fc_layout' => 'news_section',
			'disable'       => false,
			'title'         => 'News & Market Insights',
		),
		array(
			'acf_fc_layout' => 'consult_modal',
			'disable'       => false,
			'title'         => 'Please submit your details for FREE PRODUCT INSIGHT CONSULTATION.',
			'image'         => 1211,
		),
	);

	update_field( 'home_sections', $home_sections_en, $home_en_id );
	echo "   ✓ Home page synced successfully.\n";
} else {
	echo "   ⚠ English Home page not found.\n";
}

// --------------------------------------------------------------------------
// 3. Sync English Cooperation / R&D Page
// --------------------------------------------------------------------------
$coop_en_id = vinacos_find_page( 'tam-the-cong-su-rd-oem-odm', 'rd-system-oem-odm', 944, 1122 );
echo "\n[3/4] Syncing English Cooperation / R&D Page (ID: {$coop_en_id})...\n";

if ( $coop_en_id ) {
	$cooperation_sections_en = array(
		array(
			'acf_fc_layout' => 'cooperation_hero',
			'disable'       => false,
			'banner_image'  => 1239,
			'title'         => 'R&D SYSTEM & OEM/ODM MANUFACTURING',
		),
		array(
			'acf_fc_layout' => 'cooperation_benefits',
			'disable'       => false,
			'title'         => 'Proprietary R&D Innovation & Patent Portfolio',
			'benefit_items' => array(
				array(
					'title' => 'Vietnamese Botanical Raw Ingredient Research',
					'image' => 1240,
					'desc'  => 'Harnessing and upgrading local agricultural botanicals: Essential oils, herbal extracts, and bio-silica from rice husks into premium cosmetics.',
				),
				array(
					'title' => 'Nano Lipid Active Encapsulation Technology',
					'image' => 1220,
					'desc'  => 'Optimizing active ingredient stability and maximizing deep dermal penetration without causing skin irritation.',
				),
				array(
					'title' => 'Rigorous Clinical Trials & Thermal Stability Testing',
					'image' => 1234,
					'desc'  => 'Every formulation undergoes thermal shock, centrifugation, and dermatological safety screening before mass production.',
				),
			),
		),
		array(
			'acf_fc_layout' => 'cooperation_process',
			'disable'       => false,
			'title'         => 'Turnkey 6-Step R&D & OEM/ODM Workflow',
			'process_steps' => array(
				array(
					'step_num' => '01',
					'title'    => 'Concept Inception & Product Positioning',
					'desc'     => 'Understanding market demand and defining target product specifications with brand partners.',
				),
				array(
					'step_num' => '02',
					'title'    => 'Formulation R&D & Sample Prototyping',
					'desc'     => 'Developing exclusive custom formulas tailored to desired sensory feel and clinical efficacy.',
				),
				array(
					'step_num' => '03',
					'title'    => 'Sample Evaluation & Refinement',
					'desc'     => 'Delivering trial batches and fine-tuning formulas until achieving 100% client satisfaction.',
				),
				array(
					'step_num' => '04',
					'title'    => 'Regulatory Filings & MoH Notification',
					'desc'     => 'Comprehensive support for Ministry of Health cosmetic notification and Pasteur testing certificates.',
				),
				array(
					'step_num' => '05',
					'title'    => 'Automated cGMP Mass Production',
					'desc'     => 'High-capacity automated compounding, precision filling, and professional packaging.',
				),
				array(
					'step_num' => '06',
					'title'    => 'Delivery & Post-Launch Support',
					'desc'     => 'Nationwide delivery, technical product training, and strategic marketing consultation.',
				),
			),
		),
		array(
			'acf_fc_layout' => 'cooperation_form',
			'disable'       => false,
			'title'         => 'Register for R&D Consultation & Quotation',
			'subtitle'      => 'VINACOS expert formulation team will contact you within 24 hours',
		),
	);

	update_field( 'cooperation_sections', $cooperation_sections_en, $coop_en_id );
	echo "   ✓ Cooperation / R&D page synced successfully.\n";
} else {
	echo "   ⚠ English Cooperation page not found.\n";
}

// --------------------------------------------------------------------------
// 4. Translate Products & Fix Slugs
// --------------------------------------------------------------------------
echo "\n[4/4] Verifying and Translating English Product Titles...\n";
$untranslated_map = array(
	1083 => 'Eco-Friendly Laundry & Fabric Care (OEM/ODM Formula)',
	1076 => 'Home Cleansing & Deodorizing Spray (OEM/ODM Formula)',
);

foreach ( $untranslated_map as $p_id => $p_title ) {
	$p = get_post( $p_id );
	if ( $p ) {
		wp_update_post( array(
			'ID'         => $p_id,
			'post_title' => $p_title,
		) );
		echo "   ✓ Product #{$p_id} updated: '{$p_title}'\n";
	}
}

// Flush rewrites and clear transients
flush_rewrite_rules( false );
echo "\n✓ Rewrite rules flushed.\n";
echo "\n========================================================\n";
echo "   SYNCHRONIZATION COMPLETED SUCCESSFULLY!              \n";
echo "========================================================\n";
