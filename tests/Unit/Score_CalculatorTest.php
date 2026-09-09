<?php

namespace Atlasbaz\Tests\Unit;

use Atlasbaz\Scoring\Score_Calculator;
use PHPUnit\Framework\TestCase;

class Score_CalculatorTest extends TestCase {

	public function test_deducts_points_for_known_severities(): void {
		$calculator = new Score_Calculator();

		$score = $calculator->calculate(
			[
				[ 'severity' => 'high' ],
				[ 'severity' => 'medium' ],
				[ 'severity' => 'low' ],
			]
		);

		$this->assertSame( 83, $score );
	}

	public function test_ignores_unknown_severities(): void {
		$calculator = new Score_Calculator();

		$this->assertSame( 100, $calculator->calculate( [ [ 'severity' => 'unknown' ] ] ) );
	}

	public function test_clamps_score_at_zero(): void {
		$calculator = new Score_Calculator();
		$findings = array_fill( 0, 10, [ 'severity' => 'high' ] );

		$this->assertSame( 0, $calculator->calculate( $findings ) );
	}
}
