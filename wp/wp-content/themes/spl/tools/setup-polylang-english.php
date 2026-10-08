<?php
/**
 * Setup script to create & link English (EN) translated pages and ACF content for VINACOS.
 *
 * Usage via CLI: php -r "require 'wp/wp-load.php'; require 'wp/wp-content/themes/spl/tools/setup-polylang-english.php';"
 *
 * @package SPL
 */

defined( 'ABSPATH' ) || exit;

echo "=== STARTING POLYLANG ENGLISH TRANSLATION SETUP ===" . PHP_EOL;

if ( ! function_exists( 'pll_set_post_language' ) || ! function_exists( 'pll_save_post_translations' ) ) {
	echo "ERROR: Polylang functions not available!" . PHP_EOL;
	exit( 1 );
}

$page_mappings = array(
	// VI Page ID => [ EN Title, EN Slug, Template ]
	10  => array(
		'title'    => 'Home - VINACOS Cosmetics OEM/ODM',
		'slug'     => 'home-en',
		'template' => 'templates/template-page-home.php',
	),
	942 => array(
		'title'    => 'PARTNER MINDSET | VINACOS',
		'slug'     => 'partner-mindset-about',
		'template' => 'templates/template-page-about.php',
	),
	944 => array(
		'title'    => 'R&D SYSTEM & OEM/ODM MANUFACTURING',
		'slug'     => 'oem-odm-cosmetics-manufacturing',
		'template' => 'templates/template-page-cooperation.php',
	),
	943 => array(
		'title'    => 'Products & Packaging Catalog',
		'slug'     => 'cosmetics-oem-products',
		'template' => '',
	),
	928 => array(
		'title'    => 'News & Beauty Insights',
		'slug'     => 'news-insights',
		'template' => '',
	),
	937 => array(
		'title'    => 'Contact Us | B&B Vinacos',
		'slug'     => 'contact-us',
		'template' => 'templates/template-page-contact.php',
	),
);

$translations_map = array();

foreach ( $page_mappings as $vi_id => $en_meta ) {
	$vi_post = get_post( $vi_id );
	if ( ! $vi_post ) {
		echo "WARNING: VI Post ID {$vi_id} not found." . PHP_EOL;
		continue;
	}

	// Ensure VI post language is set to 'vi'
	pll_set_post_language( $vi_id, 'vi' );

	// Check if EN translation already exists
	$en_id = pll_get_post( $vi_id, 'en' );

	if ( ! $en_id ) {
		// Create EN Page
		$en_post_data = array(
			'post_title'   => $en_meta['title'],
			'post_name'    => $en_meta['slug'],
			'post_content' => $vi_post->post_content,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_author'  => $vi_post->post_author,
		);

		$en_id = wp_insert_post( $en_post_data );

		if ( is_wp_error( $en_id ) ) {
			echo "ERROR creating EN page for {$en_meta['title']}: " . $en_id->get_error_message() . PHP_EOL;
			continue;
		}

		echo "CREATED EN Page ID {$en_id}: {$en_meta['title']}" . PHP_EOL;
	} else {
		// Update existing EN Page title & slug
		wp_update_post( array(
			'ID'         => $en_id,
			'post_title' => $en_meta['title'],
			'post_name'  => $en_meta['slug'],
		) );
		echo "EXISTS EN Page ID {$en_id}: {$en_meta['title']}" . PHP_EOL;
	}

	// Set language & template
	pll_set_post_language( $en_id, 'en' );
	if ( ! empty( $en_meta['template'] ) ) {
		update_post_meta( $en_id, '_wp_page_template', $en_meta['template'] );
	}

	// Link VI and EN posts in Polylang
	pll_save_post_translations( array(
		'vi' => $vi_id,
		'en' => $en_id,
	) );

	$translations_map[ $vi_id ] = $en_id;
	echo "LINKED VI ID {$vi_id} <-> EN ID {$en_id}" . PHP_EOL;
}

// --------------------------------------------------
// Populate English ACF Content for OEM/ODM Page (ID $en_oem_id)
// --------------------------------------------------

$en_oem_id = $translations_map[944] ?? 0;

if ( $en_oem_id > 0 ) {
	echo "=== SEEDING ENGLISH ACF FLEXIBLE CONTENT FOR OEM/ODM PAGE (ID {$en_oem_id}) ===" . PHP_EOL;

	$en_cooperation_sections = array(
		// Section 1: Hero
		array(
			'acf_fc_layout' => 'cooperation_hero',
			'title'         => 'R&D System & Cosmetics OEM/ODM Manufacturing',
			'subtitle'      => 'cGMP Standard Cosmetics Factory — Custom Formulation & Packaging Solution',
			'description'   => 'B&B Vinacos delivers turnkey OEM/ODM cosmetics manufacturing solutions with 100% certified cGMP/FDA standards. From custom formula R&D, bottleneck-free bottle/jar supply to legal notification and fast delivery.',
			'button_text'   => 'Get Free Sample & Quote',
			'button_link'   => '#register-form',
			'stats_badge'   => '1,000+ Formulations | 500+ Brand Partners',
		),

		// Section 2: Benefits / 5 Reasons
		array(
			'acf_fc_layout' => 'cooperation_benefits',
			'title'         => '5 Reasons to Choose B&B Vinacos for Cosmetics OEM',
			'subtitle'      => 'Professional OEM/ODM Partner — Elevating Your Cosmetics Brand',
			'cards'         => array(
				array(
					'icon'        => 'flask',
					'title'       => '100% Custom Formula R&D',
					'description' => 'Experienced R&D team formulating exclusive creams, serums, and sunscreens tailored to your target customer profile.',
				),
				array(
					'icon'        => 'shield-check',
					'title'       => 'cGMP & FDA Certified Factory',
					'description' => 'Automated cleanrooms ensuring 100% batch consistency, stability testing, and rigorous safety compliance.',
				),
				array(
					'icon'        => 'box',
					'title'       => 'Turnkey Packaging & Bottle Supply',
					'description' => 'Direct supply of premium glass/acrylic jars, airless bottles, and tubes at factory-direct competitive prices.',
				),
				array(
					'icon'        => 'file-text',
					'title'       => 'Full Legal Notification Support',
					'description' => 'Free assistance with MoH cosmetic publishing documents, barcode registration, and legal compliance.',
				),
				array(
					'icon'        => 'zap',
					'title'       => 'Low MOQs & Fast 20-Day Lead Time',
					'description' => 'Flexible minimum order quantities starting from 1,000 units with optimized 20-day production turnaround.',
				),
			),
		),

		// Section 3: Packages / Service Tiers
		array(
			'acf_fc_layout' => 'cooperation_packages',
			'title'         => 'Cosmetics OEM Manufacturing Packages',
			'subtitle'      => 'Flexible Packages Designed for Startups, Growing Brands & Enterprise Chains',
			'packages'      => array(
				array(
					'name'        => 'Startup OEM (1,000 Units)',
					'target'      => 'Ideal for new cosmetics brands & spa owners',
					'price'       => 'Starting at 15,000,000 VND',
					'features'    => "• Standard 1,000 unit production\n• Free sample testing (2 iterations)\n• Free bottle labeling design\n• Standard 20-day lead time",
					'highlight'   => false,
					'badge_text'  => 'Startup Choice',
					'button_text' => 'Select Package',
				),
				array(
					'name'        => 'Private Brand OEM/ODM (5,000 Units)',
					'target'      => 'Best seller for established cosmetics companies',
					'price'       => 'Optimized Unit Cost',
					'features'    => "• Exclusive formula formulation\n• Full legal documentation & MoH publishing\n• Premium custom packaging selection\n• Priority cGMP production line",
					'highlight'   => true,
					'badge_text'  => 'Most Popular',
					'button_text' => 'Consult Now',
				),
				array(
					'name'        => 'VIP Enterprise OEM (10,000+ Units)',
					'target'      => 'For retail chains & international export brands',
					'price'       => 'Factory Direct Wholesale Rate',
					'features'    => "• Dedicated R&D lab engineer team\n• FDA & export compliance documentation\n• Custom bottle mold manufacturing\n• Dedicated account manager 24/7",
					'highlight'   => false,
					'badge_text'  => 'Enterprise',
					'button_text' => 'Contact Enterprise',
				),
			),
		),

		// Section 4: 4-Step Process
		array(
			'acf_fc_layout' => 'cooperation_process',
			'title'         => '4-Step Cosmetics OEM Manufacturing Process',
			'subtitle'      => 'Transparent 20-Day Journey from Concept to Finished Shelf Product',
			'steps'         => array(
				array(
					'number'      => '01',
					'title'       => 'Consultation & Sample Trial',
					'description' => 'Define product requirements, target texture/scent, and send free testing samples within 3-5 days.',
				),
				array(
					'number'      => '02',
					'title'       => 'Formula & Packaging Finalization',
					'description' => 'Approve sample quality, select bottle/jar packaging design, and sign official OEM contract.',
				),
				array(
					'number'      => '03',
					'title'       => 'cGMP Automated Manufacturing',
					'description' => 'Mass production in cGMP cleanrooms, filling, capping, labeling, and strict QA/QC inspection.',
				),
				array(
					'number'      => '04',
					'title'       => 'MoH Notification & Delivery',
					'description' => 'Complete legal cosmetics dossier notification, pack securely, and deliver directly to warehouse.',
				),
			),
		),

		// Section 5: Form & FAQs
		array(
			'acf_fc_layout' => 'cooperation_register_form',
			'form_title'    => 'Register for Cosmetics OEM Consultation & Free Samples',
			'form_subtitle' => 'Fill out your contact details to receive instant product insight consultation from B&B Vinacos specialists.',
			'faqs'          => array(
				array(
					'question' => 'What is the Minimum Order Quantity (MOQ) at B&B Vinacos?',
					'answer'   => 'We support low MOQs starting from 1,000 units per batch for new brands, and offer high-volume production up to 100,000+ units per day.',
				),
				array(
					'question' => 'Are free testing samples provided before ordering?',
					'answer'   => 'Yes! B&B Vinacos provides 100% free formulation samples for trial so you can verify texture, absorption, and fragrance quality before signing.',
				),
				array(
					'question' => 'How long does legal cosmetics notification take?',
					'answer'   => 'Our legal department handles all Ministry of Health publishing procedures within 7 to 15 working days concurrently with production.',
				),
				array(
					'question' => 'Can B&B Vinacos supply custom bottles and packaging?',
					'answer'   => 'Yes, we supply a complete catalog of over 500+ cosmetics bottle designs (serum droppers, cream jars, airless pumps, tubes) at wholesale prices.',
				),
			),
		),
	);

	if ( function_exists( 'update_field' ) ) {
		update_field( 'cooperation_sections', $en_cooperation_sections, $en_oem_id );
		echo "SUCCESS: Updated EN ACF flexible content for Page ID {$en_oem_id}" . PHP_EOL;
	}
}

echo "=== POLYLANG ENGLISH SETUP COMPLETED SUCCESSFULLY ===" . PHP_EOL;
