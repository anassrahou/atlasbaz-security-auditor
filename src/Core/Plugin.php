<?php

namespace Atlasbaz\Core;

use Atlasbaz\Admin\Admin_Menu;
use Atlasbaz\Security\Login_Tracker;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {

	public function run(): void {

		$admin_menu = new Admin_Menu();
		$tracker    = new Login_Tracker();

        $admin_menu->register();
		$tracker->register();
	}
}
