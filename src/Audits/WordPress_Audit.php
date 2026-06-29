<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WordPress_Audit implements Audit_Interface {

    public function run(): array {

        return [
            'wp_debug'              => defined( 'WP_DEBUG' ) && WP_DEBUG,
            'wp_debug_log'          => defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG,
            'file_editing_disabled' => defined( 'DISALLOW_FILE_EDIT' ) && DISALLOW_FILE_EDIT,
            'auto_updates_disabled' => defined( 'AUTOMATIC_UPDATER_DISABLED' ) && AUTOMATIC_UPDATER_DISABLED,
        ];
    }
}
