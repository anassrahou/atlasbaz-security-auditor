<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Plugin_Audit implements Audit_Interface {

    public function run(): array {

        $results = [];

        $results['inactive_plugins'] = $this->count_inactive_plugins();

        return $results;
    }

    private function count_inactive_plugins(): int {

        $all_plugins = get_plugins();
        $active_plugins = get_option( 'active_plugins', [] );

        $inactive_plugins = array_diff_key( $all_plugins, array_flip( $active_plugins ) );

        return count( $inactive_plugins );
    }
}
