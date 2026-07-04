<?php

namespace Atlasbaz\Services;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Atlasbaz\Audits\Environment_Audit;
use Atlasbaz\Audits\User_Audit;
use Atlasbaz\Audits\WordPress_Audit;
use Atlasbaz\Scoring\Score_Calculator;
use Atlasbaz\Recommendations\Recommendation_Engine;

class Audit_Manager {

    public function run(): array {

        $results = [];

        $audits = [
            new Environment_Audit(),
            new WordPress_Audit(),
            new User_Audit(),
        ];

        foreach ( $audits as $audit ) {
            $results = array_merge(
                $results,
                $audit->run()
            );
        }

        return $results;
    }
}
