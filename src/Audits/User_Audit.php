<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class User_Audit implements Audit_Interface {

	public function run(): array {

		$administrators = get_users(
			[
				'role' => 'administrator',
			]
		);

		$default_admin_found = false;

		foreach ( $administrators as $user ) {

			if ( in_array(
				strtolower( $user->user_login ),
				[
					'admin',
					'administrator',
					'wpadmin',
				],
				true
			) ) {

				$default_admin_found = true;
			}
		}

		return [
			'administrator_count' => count( $administrators ),
			'default_admin_found' => $default_admin_found,
		];
	}
}
