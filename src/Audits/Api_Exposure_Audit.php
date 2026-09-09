<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Api_Exposure_Audit implements Audit_Interface {

	public function run(): array {
		return [
			'xmlrpc_enabled'  => $this->is_xmlrpc_enabled(),
			'rest_api_public' => $this->is_rest_api_public(),
		];
	}

	private function is_xmlrpc_enabled(): bool {
		if ( ! function_exists( 'apply_filters' ) ) {
			return true;
		}

		return (bool) apply_filters( 'xmlrpc_enabled', true );
	}

	private function is_rest_api_public(): bool {
		if ( ! function_exists( 'apply_filters' ) ) {
			return true;
		}

		return null === apply_filters( 'rest_authentication_errors', null );
	}
}