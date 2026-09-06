<?php
/**
 * CLI Utility to Diagnose & Fix WordPress Login Issues on VPS
 *
 * Usage via SSH:
 * php fix_login.php
 * php fix_login.php --new-password=YourPassword123
 */

if ( php_sapi_name() !== 'cli' && ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'vinacos_fix_2026' ) ) {
	die( "Direct browser access restricted. Run via CLI: php fix_login.php\n" );
}

echo "=======================================================\n";
echo " VINACOS WORDPRESS LOGIN DIAGNOSTICS & REPAIR\n";
echo "=======================================================\n\n";

// 1. Load WordPress environment
$root_dir = __DIR__;
if ( ! file_exists( $root_dir . '/wp/wp-load.php' ) ) {
	die( "ERROR: wp/wp-load.php not found in $root_dir\n" );
}

require_once $root_dir . '/wp/wp-load.php';
global $wpdb, $table_prefix;

echo "[1] ENVIRONMENT & CONFIG CHECK:\n";
echo " - Table Prefix in config: '$table_prefix'\n";
echo " - WP_HOME: " . ( defined( 'WP_HOME' ) ? WP_HOME : 'Not defined' ) . "\n";
echo " - WP_SITEURL: " . ( defined( 'WP_SITEURL' ) ? WP_SITEURL : 'Not defined' ) . "\n";
echo " - HDA_DISABLE_OTP: " . ( defined( 'HDA_DISABLE_OTP' ) && HDA_DISABLE_OTP ? 'YES (Bypassed)' : 'NO (WARNING: OTP active!)' ) . "\n";
echo " - HDA_DISABLE_LOGIN_SECURITY: " . ( defined( 'HDA_DISABLE_LOGIN_SECURITY' ) && HDA_DISABLE_LOGIN_SECURITY ? 'YES' : 'NO' ) . "\n";

// Check siteurl and home in database
$db_siteurl = $wpdb->get_var( "SELECT option_value FROM {$table_prefix}options WHERE option_name = 'siteurl'" );
$db_home    = $wpdb->get_var( "SELECT option_value FROM {$table_prefix}options WHERE option_name = 'home'" );
echo " - DB option 'siteurl': $db_siteurl\n";
echo " - DB option 'home': $db_home\n";

// 2. Check Database Tables
echo "\n[2] DATABASE TABLES CHECK:\n";
$users_table = $table_prefix . 'users';
$table_check = $wpdb->get_var( "SHOW TABLES LIKE '$users_table'" );
if ( $table_check !== $users_table ) {
	echo " ! ERROR: Table '$users_table' DOES NOT EXIST! Checking available tables...\n";
	$all_tables = $wpdb->get_col( "SHOW TABLES" );
	foreach ( $all_tables as $t ) {
		if ( strpos( $t, 'users' ) !== false ) {
			echo "   Found alternative: $t\n";
		}
	}
	echo " ! Please ensure DB_PREFIX in .env matches your imported database prefix!\n";
	exit( 1 );
}
echo " - Table '$users_table' found: OK\n";

// 3. Check User Roles Serialization
echo "\n[3] USER ROLES SERIALIZATION CHECK:\n";
$raw_roles = $wpdb->get_var( "SELECT option_value FROM {$table_prefix}options WHERE option_name = '{$table_prefix}user_roles'" );
$roles     = maybe_unserialize( $raw_roles );
if ( ! is_array( $roles ) || empty( $roles ) ) {
	echo " ! WARNING: {$table_prefix}user_roles is corrupt or empty (often caused by raw SQL find-and-replace)!\n";
	echo "   Attempting automatic repair via populate_roles()...\n";
	require_once ABSPATH . 'wp-admin/includes/schema.php';
	populate_roles();
	$repaired_roles = get_option( "{$table_prefix}user_roles" );
	if ( is_array( $repaired_roles ) && ! empty( $repaired_roles ) ) {
		echo "   => Successfully repaired {$table_prefix}user_roles! Standard roles restored.\n";
	} else {
		echo "   ! Could not repair roles automatically.\n";
	}
} else {
	echo " - User roles serialized data: VALID (" . count( $roles ) . " roles defined: " . implode( ', ', array_keys( $roles ) ) . ")\n";
}

// 4. Check Users and Capabilities
echo "\n[4] USERS & CAPABILITIES CHECK:\n";
$users = $wpdb->get_results( "SELECT ID, user_login, user_email, user_pass FROM $users_table" );
echo " - Found " . count( $users ) . " user(s) in database:\n";

$target_user_id = 0;
foreach ( $users as $u ) {
	$caps_key  = $table_prefix . 'capabilities';
	$raw_caps  = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM {$table_prefix}usermeta WHERE user_id = %d AND meta_key = %s", $u->ID, $caps_key ) );
	$user_caps = maybe_unserialize( $raw_caps );
	$level     = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM {$table_prefix}usermeta WHERE user_id = %d AND meta_key = %s", $u->ID, $table_prefix . 'user_level' ) );

	$is_admin = is_array( $user_caps ) && ! empty( $user_caps['administrator'] );
	echo "   * ID: {$u->ID} | Login: '{$u->user_login}' | Email: '{$u->user_email}'\n";
	echo "     Caps key: '$caps_key' => " . ( is_array( $user_caps ) ? json_encode( $user_caps ) : 'CORRUPT/EMPTY' ) . " | Level: $level\n";

	if ( $u->user_login === 'quantri' || $is_admin || $u->ID == 1 ) {
		$target_user_id = $u->ID;
	}

	// Fix capabilities if corrupted
	if ( ( $u->user_login === 'quantri' || $u->ID == 1 ) && ! $is_admin ) {
		echo "     -> REPAIRING administrator capabilities for '{$u->user_login}'...\n";
		update_user_meta( $u->ID, $caps_key, array( 'administrator' => true ) );
		update_user_meta( $u->ID, $table_prefix . 'user_level', 10 );
		echo "     => Capabilities updated to administrator!\n";
	}
}

// 5. Password Reset / Confirmation
echo "\n[5] PASSWORD STATUS:\n";
$new_pass = null;
foreach ( $argv as $arg ) {
	if ( strpos( $arg, '--new-password=' ) === 0 ) {
		$new_pass = substr( $arg, 15 );
	}
}

if ( $target_user_id ) {
	$user_obj = get_user_by( 'ID', $target_user_id );
	if ( $new_pass ) {
		wp_set_password( $new_pass, $target_user_id );
		echo " => Successfully set new password for '{$user_obj->user_login}': '$new_pass'\n";
	} else {
		echo " - Target user is '{$user_obj->user_login}' (ID: $target_user_id).\n";
		echo "   To reset password, run: php fix_login.php --new-password=MatKhauMoiCuaBan\n";
	}
}

echo "\n=======================================================\n";
echo " SUMMARY & RECOMMENDATIONS:\n";
echo "=======================================================\n";
echo "1. Exact Login URL: " . ( defined( 'WP_SITEURL' ) ? WP_SITEURL : home_url() ) . "/wp-login.php\n";
echo "2. Exact Username: " . ( isset( $user_obj ) ? $user_obj->user_login : 'quantri' ) . "\n";
if ( ! defined( 'HDA_DISABLE_OTP' ) || ! HDA_DISABLE_OTP ) {
	echo "3. ATTENTION: Add these lines to your .env file to bypass OTP/email blocks:\n";
	echo "   HDA_DISABLE_OTP=true\n";
	echo "   HDA_DISABLE_LOGIN_SECURITY=true\n";
	echo "   HDA_DISABLE_LOGIN_CAPTCHA=true\n";
}
echo "=======================================================\n";
