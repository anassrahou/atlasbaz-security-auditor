<?php

namespace Atlasbaz\Scoring;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Score_Calculator {

	public function calculate( array $findings ): int {

		$score = 100;
		$deductions = [
			'high'   => 20,
			'medium' => 10,
			'low'    => 5,
		];

		foreach ( $findings as $finding ) {

			$severity = $finding['severity'] ?? '';
			$score   -= $deductions[ $severity ] ?? 0;
		}

		return max( 0, $score );
	}
}
