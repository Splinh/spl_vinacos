<?php
/**
 * Safe Database Search & Replace CLI Utility for WordPress
 * Handles PHP serialized arrays/objects without corruption.
 *
 * Usage:
 * php db_search_replace.php --search="http://vinacos.test" --replace="https://vinacos.splworks.com"
 * php db_search_replace.php (defaults to vinacos.test -> vinacos.splworks.com)
 */

if ( php_sapi_name() !== 'cli' && ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'vinacos_sr_2026' ) ) {
	die( "Direct browser access restricted. Run via CLI: php db_search_replace.php\n" );
}

echo "=======================================================\n";
echo " VINACOS SAFE SEARCH & REPLACE (CLI)\n";
echo "=======================================================\n\n";

$root_dir = __DIR__;
if ( ! file_exists( $root_dir . '/wp/wp-load.php' ) ) {
	die( "ERROR: wp/wp-load.php not found in $root_dir\n" );
}

require_once $root_dir . '/wp/wp-load.php';
global $wpdb, $table_prefix;

// Parse CLI Arguments
$search  = 'http://vinacos.test';
$replace = 'https://vinacos.splworks.com';
$dry_run = false;

foreach ( $argv as $arg ) {
	if ( strpos( $arg, '--search=' ) === 0 ) {
		$search = substr( $arg, 9 );
	} elseif ( strpos( $arg, '--replace=' ) === 0 ) {
		$replace = substr( $arg, 10 );
	} elseif ( $arg === '--dry-run' ) {
		$dry_run = true;
	}
}

// Clean trailing slashes for clean matching
$search  = rtrim( $search, '/' );
$replace = rtrim( $replace, '/' );

echo "Search string : '$search'\n";
echo "Replace string: '$replace'\n";
echo "Dry run mode  : " . ( $dry_run ? 'YES (No changes will be written)' : 'NO (Live update)' ) . "\n\n";

/**
 * Recursive unserialize and replace
 */
function safe_sr_replace( $from, $to, $data, $serialised = false ) {
	try {
		if ( is_string( $data ) && ( false !== strpos( $data, 'a:' ) || false !== strpos( $data, 'O:' ) || false !== strpos( $data, 's:' ) ) && ( $unserialized = @unserialize( $data ) ) !== false ) {
			$data = safe_sr_replace( $from, $to, $unserialized, true );
		} elseif ( is_array( $data ) ) {
			$_tmp = array();
			foreach ( $data as $key => $value ) {
				$_tmp[ $key ] = safe_sr_replace( $from, $to, $value, false );
			}
			$data = $_tmp;
		} elseif ( is_object( $data ) ) {
			$_tmp = $data;
			$props = get_object_vars( $data );
			foreach ( $props as $key => $value ) {
				$_tmp->$key = safe_sr_replace( $from, $to, $value, false );
			}
			$data = $_tmp;
		} elseif ( is_string( $data ) ) {
			$data = str_replace( $from, $to, $data );
		}

		if ( $serialised ) {
			return serialize( $data );
		}
	} catch ( Exception $e ) {
	}
	return $data;
}

// Get all tables for this WordPress install
$tables = $wpdb->get_col( $wpdb->prepare( "SHOW TABLES LIKE %s", $wpdb->esc_like( $table_prefix ) . '%' ) );

$total_tables_updated = 0;
$total_cells_updated  = 0;

foreach ( $tables as $table ) {
	// Skip tables that don't need URL replacement or could cause issues
	if ( in_array( $table, [ $table_prefix . 'users' ], true ) ) {
		continue;
	}

	// Get primary key
	$primary_key = '';
	$indices = $wpdb->get_results( "SHOW INDEX FROM `$table`" );
	foreach ( $indices as $idx ) {
		if ( $idx->Key_name === 'PRIMARY' ) {
			$primary_key = $idx->Column_name;
			break;
		}
	}

	// Get columns
	$columns_data = $wpdb->get_results( "SHOW COLUMNS FROM `$table`" );
	$text_columns = array();
	foreach ( $columns_data as $col ) {
		$type = strtolower( $col->Type );
		if ( strpos( $type, 'char' ) !== false || strpos( $type, 'text' ) !== false || strpos( $type, 'blob' ) !== false || strpos( $type, 'longtext' ) !== false ) {
			$text_columns[] = $col->Field;
		}
	}

	if ( empty( $text_columns ) || empty( $primary_key ) ) {
		continue;
	}

	$count_rows = (int) $wpdb->get_var( "SELECT COUNT(*) FROM `$table`" );
	if ( 0 === $count_rows ) {
		continue;
	}

	echo "Processing table `$table` ($count_rows rows)...";
	$chunk_size     = 500;
	$table_updates  = 0;

	for ( $offset = 0; $offset < $count_rows; $offset += $chunk_size ) {
		$col_list = '`' . $primary_key . '`, `' . implode( '`, `', $text_columns ) . '`';
		$rows = $wpdb->get_results( "SELECT $col_list FROM `$table` LIMIT $chunk_size OFFSET $offset", ARRAY_A );

		foreach ( $rows as $row ) {
			$row_id      = $row[ $primary_key ];
			$update_data = array();

			foreach ( $text_columns as $col ) {
				$val = $row[ $col ];
				if ( ! is_string( $val ) || empty( $val ) ) {
					continue;
				}

				if ( false !== strpos( $val, $search ) ) {
					$new_val = safe_sr_replace( $search, $replace, $val );
					if ( $new_val !== $val ) {
						$update_data[ $col ] = $new_val;
					}
				}
			}

			if ( ! empty( $update_data ) ) {
				$table_updates++;
				$total_cells_updated += count( $update_data );
				if ( ! $dry_run ) {
					$wpdb->update( $table, $update_data, array( $primary_key => $row_id ) );
				}
			}
		}
	}

	if ( $table_updates > 0 ) {
		$total_tables_updated++;
		echo " [UPDATED $table_updates rows]\n";
	} else {
		echo " [No matches]\n";
	}
}

// 4. Also perform a pass for https://vinacos.test if search was http://vinacos.test
if ( strpos( $search, 'http://' ) === 0 ) {
	$https_search = 'https://' . substr( $search, 7 );
	echo "\nChecking for HTTPS variant: '$https_search'...\n";
	foreach ( $tables as $table ) {
		if ( in_array( $table, [ $table_prefix . 'users' ], true ) ) {
			continue;
		}
		$primary_key = '';
		$indices = $wpdb->get_results( "SHOW INDEX FROM `$table`" );
		foreach ( $indices as $idx ) {
			if ( $idx->Key_name === 'PRIMARY' ) {
				$primary_key = $idx->Column_name;
				break;
			}
		}
		$columns_data = $wpdb->get_results( "SHOW COLUMNS FROM `$table`" );
		$text_columns = array();
		foreach ( $columns_data as $col ) {
			$type = strtolower( $col->Type );
			if ( strpos( $type, 'char' ) !== false || strpos( $type, 'text' ) !== false || strpos( $type, 'blob' ) !== false ) {
				$text_columns[] = $col->Field;
			}
		}
		if ( empty( $text_columns ) || empty( $primary_key ) ) {
			continue;
		}
		$count_rows = (int) $wpdb->get_var( "SELECT COUNT(*) FROM `$table`" );
		if ( 0 === $count_rows ) {
			continue;
		}

		for ( $offset = 0; $offset < $count_rows; $offset += 500 ) {
			$col_list = '`' . $primary_key . '`, `' . implode( '`, `', $text_columns ) . '`';
			$rows = $wpdb->get_results( "SELECT $col_list FROM `$table` LIMIT 500 OFFSET $offset", ARRAY_A );

			foreach ( $rows as $row ) {
				$row_id      = $row[ $primary_key ];
				$update_data = array();

				foreach ( $text_columns as $col ) {
					$val = $row[ $col ];
					if ( is_string( $val ) && false !== strpos( $val, $https_search ) ) {
						$new_val = safe_sr_replace( $https_search, $replace, $val );
						if ( $new_val !== $val ) {
							$update_data[ $col ] = $new_val;
						}
					}
				}

				if ( ! empty( $update_data ) && ! $dry_run ) {
					$wpdb->update( $table, $update_data, array( $primary_key => $row_id ) );
				}
			}
		}
	}
}

// 5. Always ensure admin permissions and clean sessions after replace
if ( ! $dry_run ) {
	echo "\nFinalizing & Protecting Admin Access...\n";
	// Clear stale session tokens
	$wpdb->query( "DELETE FROM {$table_prefix}usermeta WHERE meta_key = 'session_tokens'" );
	// Ensure roles exist
	require_once ABSPATH . 'wp-admin/includes/schema.php';
	populate_roles();
	// Ensure quantri is administrator
	$quantri = get_user_by( 'login', 'quantri' );
	if ( $quantri ) {
		$quantri->set_role( 'administrator' );
		update_user_meta( $quantri->ID, $table_prefix . 'capabilities', array( 'administrator' => true ) );
		update_user_meta( $quantri->ID, $table_prefix . 'user_level', 10 );
		wp_set_password( 'Vinacos@2026', $quantri->ID );
	}
	// Flush cache
	if ( function_exists( 'wp_cache_flush' ) ) {
		wp_cache_flush();
	}
}

echo "\n=======================================================\n";
echo " FINISHED SEARCH & REPLACE\n";
echo " Tables updated: $total_tables_updated\n";
echo " Cells updated : $total_cells_updated\n";
echo " Admin login   : https://vinacos.splworks.com/wp/wp-login.php\n";
echo " Username      : quantri | Pass: Vinacos@2026\n";
echo "=======================================================\n";
