<?php
/**
 * Polylang Automatic Translation Seeder for Posts & Products
 *
 * @package SPL
 */

require 'wp/wp-load.php';

if ( ! function_exists( 'pll_set_post_language' ) || ! function_exists( 'pll_save_post_translations' ) ) {
	die( 'ERROR: Polylang is not active.' . PHP_EOL );
}

echo "=== STARTING POLYLANG ENGLISH TRANSLATION FOR POSTS & PRODUCTS ===" . PHP_EOL;

// --------------------------------------------------
// 1. DỊCH & LIÊN KẾT BÀI VIẾT (POSTS)
// --------------------------------------------------

$post_translations = array(
	1048 => array(
		'title'   => 'Natural Cosmetics Manufacturing: Turnkey OEM/ODM Solutions for Brands',
		'excerpt' => 'Discover how B&B VINACOS provides end-to-end natural cosmetics formulation, cGMP cleanroom production, and legal filing for skincare brands.',
		'content' => '<p>Natural cosmetics have become the leading trend in the modern beauty industry. At B&B VINACOS, our dedicated R&D lab formulates 100% botanical extract skincare products engineered for Asian skin.</p><h3>Why Choose Natural OEM/ODM Manufacturing?</h3><p>We combine bio-based ingredients with pharmaceutical precision, ensuring high efficacy without skin irritation.</p>',
	),
	1042 => array(
		'title'   => 'Thickeners in Cosmetic Formulations: Raw Ingredients & OEM Solutions',
		'excerpt' => 'Comprehensive guide to rheology modifiers, natural gums, and polymer thickeners used in serum and cream manufacturing.',
		'content' => '<p>Texturing agents and thickeners define the sensory feel of cosmetic emulsions. VINACOS R&D experts analyze carbomers, xanthan gum, and bio-fermented polymers to achieve optimal viscosity.</p>',
	),
	1044 => array(
		'title'   => 'Secrets to Building & Manufacturing Your Own Beauty Brand',
		'excerpt' => 'A step-by-step roadmap from formula development to MOQ management and Ministry of Health notification.',
		'content' => '<p>Starting a private label cosmetics brand requires a reliable OEM partner. VINACOS guides founders through concept formulation, stability testing, packaging design, and full legal compliance.</p>',
	),
	1046 => array(
		'title'   => 'Role of Vitamins in Active Cosmetic Ingredients & Skincare',
		'excerpt' => 'Exploring Vitamin C, Niacinamide (B3), B5, and Vitamin E in targeted brightening and anti-aging OEM formulations.',
		'content' => '<p>Vitamins are indispensable active ingredients in skincare. Our R&D team stabilizes Vitamin C derivatives and Niacinamide to deliver maximum bio-availability.</p>',
	),
	1038 => array(
		'title'   => 'Natural Haircare Trends: Breakthrough OEM Formulations',
		'excerpt' => 'Sulfate-free shampoos, herbal hair oils, and scalp treatment formulas engineered for private label clients.',
		'content' => '<p>Clean haircare is surging worldwide. VINACOS manufactures silicone-free, sulfate-free hair growth serums and botanical scalp masks using cold-pressed oils.</p>',
	),
	1040 => array(
		'title'   => 'How to Select Shampoo Formulation Base for Specific Hair Types',
		'excerpt' => 'Customized OEM surfactants and natural extracts tailored for oily scalp, dry hair, and anti-dandruff solutions.',
		'content' => '<p>Formulating the perfect shampoo base requires balancing gentle cleansing with deep moisture retention. Explore our pre-tested R&D formulas.</p>',
	),
	1034 => array(
		'title'   => 'Anti-Pigmentation Serums: Active Ingredients & Efficacy',
		'excerpt' => 'Synergistic formulation of Alpha Arbutin, Tranexamic Acid, and Kojic Dipalmitate for clinical spot reduction.',
		'content' => '<p>Hyperpigmentation treatment requires multi-target inhibition of melanin synthesis. VINACOS formulates high-stability dark spot serums certified by stability testing.</p>',
	),
	1036 => array(
		'title'   => 'Essential Products for a Complete Haircare System',
		'excerpt' => 'Building a 4-step hair routine: Pre-shampoo scalp scrub, gentle shampoo, nourishing conditioner, and hair oil serum.',
		'content' => '<p>A comprehensive haircare line boosts brand basket size and customer retention. VINACOS offers complete OEM hair routine packages.</p>',
	),
	1030 => array(
		'title'   => 'Cosmetics Raw Powders & Natural Ingredients A–Z Guide',
		'excerpt' => 'Everything you need to know about botanical powders, kaolin clay, turmeric extract, and herbal scrubs.',
		'content' => '<p>Natural powders provide gentle physical exfoliation and detoxifying benefits in clean beauty masks and cleansers.</p>',
	),
	1032 => array(
		'title'   => '9 Superfoods for Radiant & Healthy Skin from Within',
		'excerpt' => 'Understanding antioxidant-rich botanical extracts and inner-beauty supplement formulation principles.',
		'content' => '<p>Skin health begins with cellular nutrition. VINACOS integrates botanical superfood extracts into topical creams and serum boosters.</p>',
	),
	1026 => array(
		'title'   => '8 Best Natural Facial Oils for Skin Barrier Repair',
		'excerpt' => 'Cold-pressed Jojoba, Sacha Inchi, Rosehip, and Argan oils in luxury facial treatment formulations.',
		'content' => '<p>Facial oils replenish essential fatty acids and repair skin lipid barrier. Learn how VINACOS crafts non-comedogenic oil blends.</p>',
	),
	1028 => array(
		'title'   => 'Facial Massage & Anti-Wrinkle Skin Rejuvenation Techniques',
		'excerpt' => 'Combining facial oil serums with ergonomic massage tools for enhanced lymphatic drainage.',
		'content' => '<p>Pairing active oil formulas with massage routines enhances absorption and firming benefits. Ideal for spa and salon OEM lines.</p>',
	),
	1022 => array(
		'title'   => 'Scalp Massage Guide to Boost Hair Growth & Relaxation',
		'excerpt' => 'Formulating stimulating scalp tonics with Peppermint, Rosemary, and Ginseng extracts.',
		'content' => '<p>Scalp microcirculation is key to hair density. VINACOS scalp treatment tonics leverage essential oils for visible hair revival.</p>',
	),
	1024 => array(
		'title'   => 'Modern Methods for Hair Growth & Follicle Stimulation',
		'excerpt' => 'Biotechnology and peptide-infused hair tonics formulated in cGMP cleanrooms.',
		'content' => '<p>Advanced peptide complexes and herbal extracts work in synergy to reactivate dormant hair follicles in OEM hair loss treatments.</p>',
	),
	964 => array(
		'title'   => 'Chronobiology Skincare Trends: Scientific Standardization for 2026',
		'excerpt' => 'Designing day-and-night circadian rhythm skincare formulations tailored for modern lifestyle needs.',
		'content' => '<p>Skin physiology follows circadian rhythms. VINACOS R&D formulates daytime protective emulsions and nighttime cellular repair creams.</p>',
	),
	965 => array(
		'title'   => '8 Everyday Causes of Skin Aging & Preventive Solutions',
		'excerpt' => 'Combating photo-aging, HEV blue light, micro-pollution, and oxidative stress with active antioxidants.',
		'content' => '<p>Environmental stressors accelerate collagen degradation. Our formulations incorporate ectoin and niacinamide to defend skin cells daily.</p>',
	),
	966 => array(
		'title'   => '2026: VINACOS Unveils New Brand Identity & R&D Positioning',
		'excerpt' => 'Upgrading cGMP manufacturing capacity, international R&D lab standards, and client partnership services.',
		'content' => '<p>B&B VINACOS announces a major brand identity transformation, reinforcing our commitment as Vietnam’s top OEM/ODM cosmetics partner.</p>',
	),
	967 => array(
		'title'   => 'Hydrating Toner Formulations: High-Profit Niche for 2026',
		'excerpt' => 'Micro-essence toners and hydrating mists formulated with Hyaluronic Acid and Chamomile extract.',
		'content' => '<p>Hydrating toners offer high repeat-purchase rates and low entry barriers. Partner with VINACOS to launch your custom toner line.</p>',
	),
);

$post_count = 0;
foreach ( $post_translations as $vi_id => $data ) {
	$vi_post = get_post( $vi_id );
	if ( ! $vi_post ) {
		continue;
	}

	// Ensure VI post is marked as 'vi'
	pll_set_post_language( $vi_id, 'vi' );

	$en_id = pll_get_post( $vi_id, 'en' );
	if ( ! $en_id ) {
		// Create EN post
		$en_id = wp_insert_post( array(
			'post_title'   => $data['title'],
			'post_excerpt' => $data['excerpt'],
			'post_content' => $data['content'],
			'post_status'  => 'publish',
			'post_type'    => 'post',
			'post_author'  => $vi_post->post_author,
		) );

		// Copy featured image
		$thumb_id = get_post_thumbnail_id( $vi_id );
		if ( $thumb_id ) {
			set_post_thumbnail( $en_id, $thumb_id );
		}

		pll_set_post_language( $en_id, 'en' );
		pll_save_post_translations( array(
			'vi' => $vi_id,
			'en' => $en_id,
		) );

		$post_count++;
		echo "CREATED & LINKED EN Post ID {$en_id}: {$data['title']}" . PHP_EOL;
	} else {
		// Update existing EN post
		wp_update_post( array(
			'ID'           => $en_id,
			'post_title'   => $data['title'],
			'post_excerpt' => $data['excerpt'],
			'post_content' => $data['content'],
		) );
		echo "UPDATED EN Post ID {$en_id}: {$data['title']}" . PHP_EOL;
	}
}

// --------------------------------------------------
// 2. DỊCH & LIÊN KẾT SẢN PHẨM (PRODUCTS)
// --------------------------------------------------

$product_translations = array(
	1020 => array(
		'title'   => 'Nourishing Body Oil OEM',
		'excerpt' => 'Luxury natural body oil formulated with cold-pressed Jojoba, Vitamin E, and organic botanical extracts.',
		'content' => '<p>Private label nourishing body oil designed for quick absorption and deep hydration without greasy residue. Ideal for spa and bodycare brands.</p>',
	),
	1018 => array(
		'title'   => 'Home Cleansing & Deodorizing Spray',
		'excerpt' => 'Eco-friendly natural plant-based room & fabric deodorizer infused with antibacterial essential oils.',
		'content' => '<p>Natural home care solution utilizing Lemongrass, Tea Tree, and Eucalyptus essential oils to eliminate odors and purify air safely.</p>',
	),
	1016 => array(
		'title'   => 'Relaxing Massage Oil',
		'excerpt' => 'Aromatherapy body massage oil formulated for professional spa treatments and home relaxation routines.',
		'content' => '<p>Smooth glide massage oil blend with Lavender, Sweet Almond, and Chamomile. Hydrates skin while easing muscle tension.</p>',
	),
	1014 => array(
		'title'   => 'Hydrating Mineral Face Mist',
		'excerpt' => 'Ultra-fine hydrating facial mist enriched with Chamomile hydrosol and Hyaluronic Acid.',
		'content' => '<p>Instant cooling and hydrating mist spray for all skin types. Restores moisture balance before or after makeup application.</p>',
	),
	1012 => array(
		'title'   => 'Men’s Natural Deodorant Spray',
		'excerpt' => 'Long-lasting natural aluminum-free deodorant spray designed specifically for men’s active lifestyle.',
		'content' => '<p>Formulated with Bergamot, Cedarwood, and antibacterial bio-complex to control odor and keep underarms fresh 24 hours.</p>',
	),
	1010 => array(
		'title'   => 'Sensual Spa Body Oil',
		'excerpt' => 'Soothing body oil formula enriched with Rosehip and Ylang Ylang for silky smooth skin texture.',
		'content' => '<p>Premium OEM spa body oil that nourishes dry skin barrier and leaves a subtle, elegant natural scent.</p>',
	),
	1008 => array(
		'title'   => 'Pet Botanical Shampoo & Care',
		'excerpt' => 'Gentle sulfate-free herbal pet shampoo formulated with Neem and Aloe Vera for shiny coat health.',
		'content' => '<p>Safe, pH-balanced pet grooming shampoo that soothes sensitive skin, repels fleas naturally, and deodorizes fur.</p>',
	),
	1006 => array(
		'title'   => 'Scalp & Hair Treatment Oil',
		'excerpt' => 'Intensive hair repair oil with Argan, Rosemary, and Castor oil for hair growth and split end prevention.',
		'content' => '<p>Pre-wash scalp treatment and leave-in hair oil formula that revitalizes damaged hair fibers and boosts scalp health.</p>',
	),
	1004 => array(
		'title'   => 'Eco-Friendly Laundry Detergent',
		'excerpt' => 'Plant-based biodegradable fabric cleanser gentle on sensitive skin and baby clothes.',
		'content' => '<p>Concentrated laundry cleanser derived from natural soapnut and essential oil fragrances. 100% non-toxic and skin-safe.</p>',
	),
	1002 => array(
		'title'   => 'Red Bean Exfoliating Cosmetic Powder',
		'excerpt' => 'Pure ground red bean powder ingredient for facial masks and body brightening body scrubs.',
		'content' => '<p>Rich in natural saponin and antioxidants, red bean powder gently polishes away dead skin cells for smooth, radiant skin.</p>',
	),
	1000 => array(
		'title'   => 'Pure Turmeric Extract Powder',
		'excerpt' => 'High-curcumin cosmetic grade turmeric powder for anti-acne and dark spot reduction products.',
		'content' => '<p>Premium cosmetic raw material for brightening masks, spot treatments, and soothing herbal skincare formulations.</p>',
	),
	998  => array(
		'title'   => 'Pure Houttuynia Cordata (Fish Mint) Powder',
		'excerpt' => 'Acne-soothing herbal cosmetic powder rich in quercetin and bioflavonoids.',
		'content' => '<p>Natural anti-inflammatory cosmetic ingredient ideal for troubled skin masks, pimple patches, and facial wash formulas.</p>',
	),
	996  => array(
		'title'   => 'Activated Bamboo Charcoal Powder',
		'excerpt' => 'Deep pore purifying micro-fine charcoal powder for detox masks and cleansing gels.',
		'content' => '<p>Ultra-absorptive cosmetic charcoal powder that draws out excess sebum, dirt, and heavy metal impurities from skin pores.</p>',
	),
	994  => array(
		'title'   => 'Colloidal Oatmeal Cosmetic Powder',
		'excerpt' => 'Soothing bio-oat powder for eczema-prone, sensitive, and dry skin formulations.',
		'content' => '<p>Certified cosmetic grade oatmeal ingredient providing beta-glucans and lipids to calm skin redness and itching.</p>',
	),
	992  => array(
		'title'   => 'Cold-Pressed Sacha Inchi Oil',
		'excerpt' => 'Omega 3-6-9 rich superfood cosmetic oil for cell regeneration and lipid repair.',
		'content' => '<p>100% pure cold-pressed Sacha Inchi seed oil for anti-aging serums, body oils, and hair conditioning treatments.</p>',
	),
	990  => array(
		'title'   => 'Pure Tamanu (Mù U) Healing Oil',
		'excerpt' => 'Traditional wound healing and scar reduction botanical oil for intensive skin repair.',
		'content' => '<p>Cold-pressed Tamanu oil rich in calophyllolide, ideal for acne scar serums, stretch mark oils, and skin recovery balms.</p>',
	),
	988  => array(
		'title'   => 'Virgin Cold-Pressed Coconut Oil',
		'excerpt' => 'Pure unrefined coconut oil cosmetic raw material for hair masks, body balms, and lip care.',
		'content' => '<p>High lauric acid unrefined organic coconut oil providing natural moisture barrier and antimicrobial protection.</p>',
	),
	986  => array(
		'title'   => 'Pure Grapeseed Oil Raw Material',
		'excerpt' => 'Lightweight non-comedogenic carrier oil high in linoleic acid for oily and acne-prone skin.',
		'content' => '<p>Absorbs rapidly without clogging pores. Excellent base oil for cleansing oils, facial serums, and massage blends.</p>',
	),
	984  => array(
		'title'   => 'Pure Castor Oil Raw Material',
		'excerpt' => 'Ricinoleic acid rich oil for lash, brow, and scalp hair follicle nourishment.',
		'content' => '<p>Viscous natural castor oil ideal for eyelash growth serums, hair thickening tonics, and lip gloss formulations.</p>',
	),
	982  => array(
		'title'   => 'Premium Rose Essential Oil',
		'excerpt' => 'Luxury Rose Damascena essential oil for fine fragrance and anti-aging skincare products.',
		'content' => '<p>100% pure steam-distilled rose essential oil providing exquisite natural aroma and cell revitalizing properties.',
	),
	978  => array(
		'title'   => 'Pure Lemon Essential Oil',
		'excerpt' => 'Cold-pressed Citrus Limon oil for skin brightening, pore clarifying, and uplifting aromatherapy.',
		'content' => '<p>High-limonene natural lemon essential oil for cleanser formulations, room sprays, and skin tone evening blends.</p>',
	),
	980  => array(
		'title'   => 'Rosewood Essential Oil Raw Material',
		'excerpt' => 'Natural Linalool rich wood essential oil for luxury perfumery and soothing skincare formulas.',
		'content' => '<p>Elegant woody-floral essential oil providing comforting aromatherapeutic benefits and skin rejuvenating properties.</p>',
	),
	976  => array(
		'title'   => 'Sweet Orange Essential Oil',
		'excerpt' => 'Uplifting cold-pressed sweet orange essential oil for cosmetics, fragrance, and spa products.',
		'content' => '<p>Pure Citrus Sinensis oil rich in d-limonene, widely used in body washes, lip balms, and citrus aromatherapy lines.</p>',
	),
	974  => array(
		'title'   => 'Lemon Eucalyptus Essential Oil',
		'excerpt' => 'Natural Citriodiol rich essential oil for natural insect repellent and purifying sprays.',
		'content' => '<p>Powerful botanical essential oil with fresh citrusy eucalyptus aroma, ideal for outdoor protection sprays and room purifiers.</p>',
	),
);

$prod_count = 0;
foreach ( $product_translations as $vi_id => $data ) {
	$vi_prod = get_post( $vi_id );
	if ( ! $vi_prod ) {
		continue;
	}

	// Ensure VI product is marked as 'vi'
	pll_set_post_language( $vi_id, 'vi' );

	$en_id = pll_get_post( $vi_id, 'en' );
	if ( ! $en_id ) {
		// Create EN product
		$en_id = wp_insert_post( array(
			'post_title'   => $data['title'],
			'post_excerpt' => $data['excerpt'],
			'post_content' => $data['content'],
			'post_status'  => 'publish',
			'post_type'    => 'product',
			'post_author'  => $vi_prod->post_author,
		) );

		// Copy featured image
		$thumb_id = get_post_thumbnail_id( $vi_id );
		if ( $thumb_id ) {
			set_post_thumbnail( $en_id, $thumb_id );
		}

		// Copy WooCommerce prices
		$price = get_post_meta( $vi_id, '_price', true );
		$reg_price = get_post_meta( $vi_id, '_regular_price', true );
		if ( $price ) {
			update_post_meta( $en_id, '_price', $price );
		}
		if ( $reg_price ) {
			update_post_meta( $en_id, '_regular_price', $reg_price );
		}
		update_post_meta( $en_id, '_stock_status', 'instock' );

		pll_set_post_language( $en_id, 'en' );
		pll_save_post_translations( array(
			'vi' => $vi_id,
			'en' => $en_id,
		) );

		$prod_count++;
		echo "CREATED & LINKED EN Product ID {$en_id}: {$data['title']}" . PHP_EOL;
	} else {
		// Update existing EN product
		wp_update_post( array(
			'ID'           => $en_id,
			'post_title'   => $data['title'],
			'post_excerpt' => $data['excerpt'],
			'post_content' => $data['content'],
		) );
		echo "UPDATED EN Product ID {$en_id}: {$data['title']}" . PHP_EOL;
	}
}

echo "=== POLYLANG TRANSLATION SEEDING COMPLETED ===" . PHP_EOL;
echo "Created/Updated {$post_count} EN Posts & {$prod_count} EN Products!" . PHP_EOL;
