<?php

namespace Atlasbaz\Scoring;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Score_Calculator {

	public function calculate( array $findings ): int {

		$high_count = 0;
		$medium_count = 0;
		$low_count = 0;
		foreach ( $findings as $finding ) {

			switch ( $finding['severity'] ) {

				case 'high':
					$high_count++;
					break;

				case 'medium':
					$medium_count++;
					break;

				case 'low':
					$low_count++;
					break;
			}
		}

		return max( 0, $score );
	}
}
