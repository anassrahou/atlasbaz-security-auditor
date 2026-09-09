<?php

namespace Atlasbaz\Tests\Unit;

use Atlasbaz\Recommendations\Recommendation_Engine;
use PHPUnit\Framework\TestCase;

class Recommendation_EngineTest extends TestCase {

	public function test_generates_recommendations_for_security_findings(): void {
		$engine = new Recommendation_Engine();
		$results = [
			'php_version'           => '8.1',
			'https_enabled'         => false,
			'wp_debug'              => true,
			'wp_debug_log'          => true,
			'file_editing_disabled' => false,
			'auto_updates_disabled' => true,
			'default_admin_found'   => true,
			'administrator_count'   => 4,
			'inactive_admins'        => 1,
			'inactive_plugins'       => 2,
			'core_updates'           => 1,
			'plugin_updates'         => 2,
			'theme_updates'          => 1,
			'xmlrpc_enabled'         => true,
			'rest_api_public'        => true,
		];

		$recommendations = $engine->generate( $results );

		$this->assertCount( 15, $recommendations );
		$this->assertSame( 'medium', $recommendations[0]['severity'] );
		$this->assertSame( 'Upgrade PHP to version 8.2 or newer.', $recommendations[0]['recommendation'] );
		$this->assertSame( 'Inactive plugins detected.', $recommendations[9]['message'] );
		$this->assertSame( 'WordPress core updates are available.', $recommendations[10]['message'] );
		$this->assertSame( 'Plugin updates are available.', $recommendations[11]['message'] );
		$this->assertSame( 'Theme updates are available.', $recommendations[12]['message'] );
		$this->assertSame( 'XML-RPC is enabled.', $recommendations[13]['message'] );
		$this->assertSame( 'The REST API is publicly accessible.', $recommendations[14]['message'] );
	}

	public function test_returns_no_recommendations_for_secure_results(): void {
		$engine = new Recommendation_Engine();
		$results = [
			'php_version'           => '8.2',
			'https_enabled'         => true,
			'wp_debug'              => false,
			'wp_debug_log'          => false,
			'file_editing_disabled' => true,
			'auto_updates_disabled' => false,
			'default_admin_found'   => false,
			'administrator_count'   => 2,
			'inactive_admins'       => 0,
			'inactive_plugins'      => 0,
			'core_updates'           => 0,
			'plugin_updates'         => 0,
			'theme_updates'          => 0,
			'xmlrpc_enabled'         => false,
			'rest_api_public'        => false,
		];

		$this->assertSame( [], $engine->generate( $results ) );
	}
}
