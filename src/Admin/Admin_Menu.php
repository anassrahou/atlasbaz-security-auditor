<?php

namespace Atlasbaz\Admin;

if (! defined( 'ABSPATH' )) {
	exit;
}

use Atlasbaz\Services\Audit_Manager;
use Atlasbaz\Recommendations\Recommendation_Engine;
use Atlasbaz\Scoring\Score_Calculator;

class Admin_Menu {

	public function register(): void {

		add_action(
			'admin_menu',
			[$this, 'add_menu']
		);
	}

	public function add_menu(): void {

		add_menu_page(
			'Atlasbaz Security Auditor',
			'Atlasbaz',
			'manage_options',
			'atlasbaz-security-auditor',
			[$this, 'render_dashboard'],
			'dashicons-shield-alt',
			80
		);
	}

	public function render_dashboard(): void {

		$audit_manager 			= new Audit_Manager();
		$recommendation_engine 	= new Recommendation_Engine();
		$score_calculator 		= new Score_Calculator();

		$results = $audit_manager->run();

		$findings = $recommendation_engine->generate( $results );

		$score = $score_calculator->calculate( $findings );

		require plugin_dir_path( dirname( __DIR__ ) ) .
			'src/Admin/Views/dashboard.php';
	}
}
