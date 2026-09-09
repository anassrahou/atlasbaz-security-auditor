<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Update_Status_Audit implements Audit_Interface {

	public function run(): array {
		return [
			'core_updates'   => $this->count_updates( 'get_core_updates' ),
			'plugin_updates' => $this->count_updates( 'get_plugin_updates' ),
			'theme_updates'  => $this->count_updates( 'get_theme_updates' ),
		];
	}

	private function count_updates( string $function ): int {
		if ( ! function_exists( $function ) ) {
			return 0;
		}

		$updates = call_user_func( $function );

		return is_array( $updates ) ? count( $updates ) : 0;
	}
}