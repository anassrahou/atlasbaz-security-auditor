<?php

namespace Atlasbaz\Security;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Login_Tracker {

	public function register(): void {

		add_action(
			'wp_login',
			[ $this, 'track_login' ],
			10,
			2
		);
	}

	public function track_login(
		string $user_login,
		\WP_User $user
	): void {

		update_user_meta(
			$user->ID,
			'atlasbaz_last_login',
			current_time( 'timestamp' )
		);
	}
}
