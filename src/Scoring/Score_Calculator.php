<?php

namespace Atlasbaz\Scoring;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Score_Calculator {

	public function calculate( array $findings ): int {

		$score = 100;

		foreach ( $findings as $finding ) {

			switch ( $finding['severity'] ) {

				case 'high':
					$score -= 20;
					break;

				case 'medium':
					$score -= 10;
					break;

				case 'low':
					$score -= 5;
					break;
			}
		}

		return max( 0, $score );
	}
}