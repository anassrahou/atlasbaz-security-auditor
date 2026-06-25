<?php

namespace Atlasbaz\Core;

use Atlasbaz\Admin\Admin_Menu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {

	public function run(): void {

		$admin_menu = new Admin_Menu();

        $admin_menu->register();
	}
}