<?php
/**
 * Plugin Name: Atlasbaz Security Auditor
 * Description: Security auditing plugin focused on posture assessment and recommendations.
 * Version: 0.1.0
 * Author: Anass Rahou
 * License: GPL-2.0-or-later
 * Text Domain: atlasbaz-security-auditor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

$plugin = new Atlasbaz\Core\Plugin();

$plugin->run();

define( 'ATLASBAZ_VERSION', '0.1.0' );