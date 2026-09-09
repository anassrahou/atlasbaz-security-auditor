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
		add_action(
			'admin_enqueue_scripts',
			[$this, 'enqueue_assets']
		);
	}

	public function enqueue_assets( string $hook_suffix ): void {
		if ( 'toplevel_page_atlasbaz-security-auditor' !== $hook_suffix ) {
			return;
		}

		$plugin_file = dirname( __DIR__, 2 ) . '/atlasbaz-security-auditor.php';
		$plugin_url  = plugin_dir_url( $plugin_file );
		$plugin_path = plugin_dir_path( $plugin_file );
		$style_path  = $plugin_path . 'assets/css/dashboard.css';
		$script_path = $plugin_path . 'assets/js/dashboard.js';

		wp_enqueue_style(
			'atlasbaz-dashboard',
			$plugin_url . 'assets/css/dashboard.css',
			[],
			(string) filemtime( $style_path )
		);
		wp_enqueue_script(
			'atlasbaz-dashboard',
			$plugin_url . 'assets/js/dashboard.js',
			[],
			(string) filemtime( $script_path ),
			true
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
