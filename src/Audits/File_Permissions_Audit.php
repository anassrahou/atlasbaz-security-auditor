<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class File_Permissions_Audit implements Audit_Interface {

	public function run(): array {
		return [
			'wp_config_writable' => $this->is_wp_config_writable(),
			'htaccess_writable' => is_writable( ABSPATH . '.htaccess' ),
			'uploads_executable' => $this->is_uploads_executable(),
		];
	}

	private function is_wp_config_writable(): bool {
		$paths = [
			ABSPATH . 'wp-config.php',
			dirname( rtrim( ABSPATH, '/\\' ) ) . '/wp-config.php',
		];

		foreach ( $paths as $path ) {
			if ( file_exists( $path ) ) {
				return is_writable( $path );
			}
		}

		return false;
	}

	private function is_uploads_executable(): bool {
		if ( ! function_exists( 'wp_upload_dir' ) ) {
			return false;
		}

		$uploads = wp_upload_dir();
		$path    = $uploads['basedir'] ?? '';

		return '' !== $path && is_executable( $path );
	}
}