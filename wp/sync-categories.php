<?php
/**
 * Standalone One-Click Category & Polylang Sync Tool for VINACOS.
 *
 * Open in browser: http://vinacos.splworks.com/sync-categories.php
 */

// Load WordPress
if ( file_exists( __DIR__ . '/wp-load.php' ) ) {
    require_once __DIR__ . '/wp-load.php';
} elseif ( file_exists( __DIR__ . '/wp/wp-load.php' ) ) {
    require_once __DIR__ . '/wp/wp-load.php';
} else {
    die( 'Error: wp-load.php not found.' );
}

// Bootstrap WordPress init action if not fired
if ( ! did_action( 'init' ) ) {
    do_action( 'init' );
}

// Auto-discover Polylang API
if ( ! function_exists( 'pll_save_term_translations' ) ) {
    $api_files = glob( WP_PLUGIN_DIR . '/polylang*/include/api*.php' );
    if ( ! empty( $api_files ) ) {
        foreach ( $api_files as $api_file ) {
            if ( file_exists( $api_file ) ) {
                require_once $api_file;
            }
        }
    }
}

// Fallback wrappers for Polylang model if functions are not global
if ( ! function_exists( 'pll_save_term_translations' ) && isset( $GLOBALS['polylang'] ) ) {
    function pll_save_term_translations( $terms ) {
        if ( isset( $GLOBALS['polylang']->model ) ) {
            $GLOBALS['polylang']->model->term->save_translations( $terms );
        }
    }
}
if ( ! function_exists( 'pll_set_term_language' ) && isset( $GLOBALS['polylang'] ) ) {
    function pll_set_term_language( $term_id, $lang ) {
        if ( isset( $GLOBALS['polylang']->model ) ) {
            $GLOBALS['polylang']->model->term->set_language( $term_id, $lang );
        }
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VINACOS Category Sync Tool</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background: #f8fafc; color: #1e293b; padding: 40px 20px; line-height: 1.6; }
        .container { max-width: 680px; margin: 0 auto; background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        h1 { color: #064e3b; font-size: 22px; margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 12px; }
        .log { background: #0f172a; color: #38bdf8; font-family: monospace; font-size: 13px; padding: 16px; border-radius: 10px; max-height: 340px; overflow-y: auto; white-space: pre-wrap; margin-bottom: 24px; }
        .btn { display: inline-block; background: #059669; color: #ffffff; text-decoration: none; font-weight: 700; padding: 12px 24px; border-radius: 9999px; transition: background 0.2s; }
        .btn:hover { background: #047857; }
    </style>
</head>
<body>
<div class="container">
    <h1>Sync Danh Mục & Ngôn Ngữ Polylang — VINACOS</h1>
    <div class="log">
<?php
// 1. Delete unwanted / deprecated categories
$slugs_to_delete = array(
    'xe-50cc', 'xe-dien', 'xe-may-dien', 'xe-ba-gac-dien', 'xe-ba-gac-dien-bluera',
    'xe-dap-dien', 'xe-dap-dien-ai-ebike', 'san-pham-moi', 'giam-gia-dac-biet',
    'special-offers', 'new-arrivals', 'xe-3-banh', 'phu-kien',
);
foreach ( $slugs_to_delete as $del_slug ) {
    $del_term = get_term_by( 'slug', $del_slug, 'product_cat' );
    if ( $del_term && ! is_wp_error( $del_term ) ) {
        wp_delete_term( $del_term->term_id, 'product_cat' );
        echo "✓ Deleted deprecated category '{$del_slug}' (ID: {$del_term->term_id})\n";
    }
}

// 2. Link VI <-> EN Product Categories
$product_cat_mappings = array(
    'cham-soc-da-mat'    => array( 'en_name' => 'Facial Care', 'en_slug' => 'facial-care' ),
    'cham-soc-co-the'    => array( 'en_name' => 'Body Care', 'en_slug' => 'body-care' ),
    'tinh-dau'           => array( 'en_name' => 'Essential Oils', 'en_slug' => 'essential-oils' ),
    'dau-nen'            => array( 'en_name' => 'Carrier Oils', 'en_slug' => 'carrier-oils' ),
    'bot-nguyen-lieu'    => array( 'en_name' => 'Raw Cosmetic Powders', 'en_slug' => 'raw-cosmetic-powders' ),
    'cham-soc-me-bim'    => array( 'en_name' => 'Mother & Baby Care', 'en_slug' => 'mother-baby-care' ),
    'san-pham-cho-nam'   => array( 'en_name' => 'Men Skincare & Grooming', 'en_slug' => 'men-grooming' ),
    'san-pham-gia-dung'  => array( 'en_name' => 'Home Care & Cleansing', 'en_slug' => 'home-care-cleansing' ),
    'best-seller'        => array( 'en_name' => 'Best Sellers', 'en_slug' => 'best-sellers' ),
    'uncategorised'      => array( 'en_name' => 'Uncategorized Products', 'en_slug' => 'uncategorized-products' ),
);

foreach ( $product_cat_mappings as $vi_slug => $en_specs ) {
    $vi_term = get_term_by( 'slug', $vi_slug, 'product_cat' );
    if ( ! $vi_term ) {
        continue;
    }

    $vi_id = $vi_term->term_id;
    if ( function_exists( 'pll_set_term_language' ) ) {
        pll_set_term_language( $vi_id, 'vi' );
    }

    $en_term = get_term_by( 'slug', $en_specs['en_slug'], 'product_cat' );
    if ( ! $en_term ) {
        $new_term = wp_insert_term( $en_specs['en_name'], 'product_cat', array( 'slug' => $en_specs['en_slug'] ) );
        if ( ! is_wp_error( $new_term ) ) {
            $en_id = $new_term['term_id'];
            echo "✓ Created EN category '{$en_specs['en_name']}' (ID: {$en_id})\n";
        } else {
            continue;
        }
    } else {
        $en_id = $en_term->term_id;
    }

    if ( $en_id && function_exists( 'pll_save_term_translations' ) ) {
        pll_set_term_language( $en_id, 'en' );
        pll_save_term_translations( array( 'vi' => $vi_id, 'en' => $en_id ) );
        echo "✓ Linked VI ('{$vi_term->name}') <-> EN ('{$en_specs['en_name']}')\n";
    }
}

// 3. Clear transients & caches
delete_transient( 'spl_product_cats_top' );
delete_option( 'spl_product_cats_top' );
wp_cache_flush();

echo "\nSUCCESS! Synced all categories & Polylang languages successfully.\n";
?>
    </div>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"> Quay Về Trang Chủ</a>
</div>
</body>
</html>
