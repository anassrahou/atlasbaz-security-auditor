<?php

namespace Atlasbaz\Admin;

if (! defined( 'ABSPATH' )) {
	exit;
}

use Atlasbaz\Audits\Environment_Audit;
use Atlasbaz\Audits\User_Audit;
use Atlasbaz\Audits\WordPress_Audit;
use Atlasbaz\Scoring\Score_Calculator;
use Atlasbaz\Recommendations\Recommendation_Engine;

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

		$environment_audit 		= new Environment_Audit();
		$wordpress_audit 	 	= new WordPress_Audit();
		$user_audit				= new User_Audit();
		$calculator 			= new Score_Calculator();
		$recommendation_engine	= new Recommendation_Engine();

		$environment_results 	= $environment_audit->run();
		$wordpress_results   	= $wordpress_audit->run();
		$user_results 		 	= $user_audit->run();

		$results = array_merge(
			$environment_results,
			$wordpress_results,
			$user_results
		);

		$findings = $recommendation_engine->generate( $results );

		$score = $calculator->calculate( $findings );

		require plugin_dir_path( dirname( __DIR__ ) ) .
			'src/Admin/Views/dashboard.php';
	}
}
