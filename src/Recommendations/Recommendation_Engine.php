<?php

namespace Atlasbaz\Recommendations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Recommendation_Engine {

	public function generate( array $results ): array {

		$recommendations = [];

		if ( version_compare( $results['php_version'], '8.2', '<' ) ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'PHP version is below 8.2.',
				'recommendation' => 'Upgrade PHP to version 8.2 or newer.',
			];
		}

		if ( ! $results['https_enabled'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'HTTPS is not enabled.',
				'recommendation' => 'Enable HTTPS and redirect all traffic to SSL.',
			];
		}

		if ( $results['wp_debug'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'WP_DEBUG is enabled.',
				'recommendation' => 'Disable WP_DEBUG on production websites.',
			];
		}

		if ( $results['wp_debug_log'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'WP_DEBUG_LOG is enabled.',
				'recommendation' => 'Disable WP_DEBUG_LOG unless actively troubleshooting.',
			];
		}

		if ( ! $results['file_editing_disabled'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'File editing is enabled.',
				'recommendation' => 'Set DISALLOW_FILE_EDIT to true.',
			];
		}

		if ( $results['auto_updates_disabled'] ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'Automatic updates are disabled.',
				'recommendation' => 'Enable automatic updates where appropriate.',
			];
		}

		return $recommendations;
	}
}
