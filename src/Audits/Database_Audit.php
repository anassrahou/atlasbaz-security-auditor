<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Database_Audit implements Audit_Interface {

	public function run(): array {
		return [
			'default_table_prefix'   => $this->uses_default_table_prefix(),
			'legacy_database_charset' => $this->uses_legacy_charset(),
		];
	}

	private function uses_default_table_prefix(): bool {
		global $wpdb, $table_prefix;

		$prefix = '';

		if ( is_object( $wpdb ) && isset( $wpdb->prefix ) ) {
			$prefix = $wpdb->prefix;
		} elseif ( isset( $table_prefix ) ) {
			$prefix = $table_prefix;
		}

		return 'wp_' === $prefix;
	}

	private function uses_legacy_charset(): bool {
		global $wpdb;

		$charset = defined( 'DB_CHARSET' ) ? DB_CHARSET : '';

		if ( '' === $charset && is_object( $wpdb ) && isset( $wpdb->charset ) ) {
			$charset = $wpdb->charset;
		}

		return '' !== $charset && 'utf8mb4' !== strtolower( $charset );
	}
}
