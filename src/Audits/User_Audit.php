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

        $inactive_admins = 0;

        $current_time       = time();
        $inactive_threshold = DAY_IN_SECONDS * 90;

        foreach ( $administrators as $user ) {

            $last_login = get_user_meta(
                $user->ID,
                'atlasbaz_last_login',
                true
            );

            if ( empty( $last_login ) ) {
                $inactive_admins++;
                continue;
            }

            if ( $current_time - $last_login > $inactive_threshold ) {
                $inactive_admins++;
            }

            if (
                in_array(
                    strtolower( $user->user_login ),
                    array(
                        'admin',
                        'administrator',
                        'wpadmin',
                    ),
                    true
                )
            ) {
                $default_admin_found = true;
            }
        }

		return array(
			'administrator_count' => count( $administrators ),
			'default_admin_found' => $default_admin_found,
			'inactive_admins'     => $inactive_admins,
        );
	}
}
