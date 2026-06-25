<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Environment_Audit implements Audit_Interface {

	public function run(): array {

		return [
			'php_version'       => PHP_VERSION,
			'wordpress_version' => get_bloginfo( 'version' ),
			'https_enabled'     => is_ssl(),
		];
	}
}