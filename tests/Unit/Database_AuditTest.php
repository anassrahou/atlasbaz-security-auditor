<?php

namespace Atlasbaz\Tests\Unit;

use Atlasbaz\Audits\Database_Audit;
use PHPUnit\Framework\TestCase;

class Database_AuditTest extends TestCase {

	public function test_detects_default_prefix_and_legacy_charset(): void {
		global $wpdb;

		$wpdb = (object) [
			'prefix'  => 'wp_',
			'charset' => 'latin1',
		];

		$this->assertSame(
			[
				'default_table_prefix'    => true,
				'legacy_database_charset' => true,
			],
			( new Database_Audit() )->run()
		);

		unset( $wpdb );
	}

	public function test_accepts_custom_prefix_and_utf8mb4(): void {
		global $wpdb;

		$wpdb = (object) [
			'prefix'  => 'site_',
			'charset' => 'utf8mb4',
		];

		$this->assertSame(
			[
				'default_table_prefix'    => false,
				'legacy_database_charset' => false,
			],
			( new Database_Audit() )->run()
		);

		unset( $wpdb );
	}
}
