<?php

namespace Atlasbaz\Services;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Atlasbaz\Audits\Environment_Audit;
use Atlasbaz\Audits\User_Audit;
use Atlasbaz\Audits\WordPress_Audit;
use Atlasbaz\Audits\Plugin_Audit;
use Atlasbaz\Audits\Update_Status_Audit;
use Atlasbaz\Audits\Api_Exposure_Audit;

class Audit_Manager {

    public function run(): array {

        $results = [];

        $audits = [
            new Environment_Audit(),
            new WordPress_Audit(),
            new User_Audit(),
            new Plugin_Audit(),
            new Update_Status_Audit(),
            new Api_Exposure_Audit(),
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
