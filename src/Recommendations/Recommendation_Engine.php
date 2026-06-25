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
				'severity' => 'warning',
				'message'  => 'Upgrade PHP to version 8.2 or newer.',
			];
		}

		if ( ! $results['https_enabled'] ) {
			$recommendations[] = [
				'severity' => 'high',
				'message'  => 'Enable HTTPS and redirect all traffic to SSL.',
			];
		}

		return $recommendations;
	}
}