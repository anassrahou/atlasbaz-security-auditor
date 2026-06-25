<?php

namespace Atlasbaz\Scoring;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Score_Calculator {

	public function calculate( array $results ): int {

		$score = 0;

		if ( version_compare( $results['php_version'], '8.2', '>=' ) ) {
			$score += 40;
		} elseif ( version_compare( $results['php_version'], '8.0', '>=' ) ) {
			$score += 30;
		} else {
			$score += 10;
		}

		if ( $results['https_enabled'] ) {
			$score += 30;
		}

		$score += 30;

		return $score;
	}
}