<?php

namespace Atlasbaz\Tests\Unit;

use Atlasbaz\Audits\File_Permissions_Audit;
use PHPUnit\Framework\TestCase;

class File_Permissions_AuditTest extends TestCase {

	public function test_returns_permission_statuses(): void {
		$results = ( new File_Permissions_Audit() )->run();

		$this->assertSame(
			[
				'wp_config_writable'  => false,
				'htaccess_writable'  => false,
				'uploads_executable' => false,
			],
			$results
		);
	}
}