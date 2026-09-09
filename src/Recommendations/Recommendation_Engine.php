<?php

namespace Atlasbaz\Recommendations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Recommendation_Engine {

	public function generate( array $results ): array {

		$recommendations = [];

		if ( version_compare( $results['php_version'], '8.2', '<' ) ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'PHP version is below 8.2.',
				'recommendation' => 'Upgrade PHP to version 8.2 or newer.',
			];
		}

		if ( ! $results['https_enabled'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'HTTPS is not enabled.',
				'recommendation' => 'Enable HTTPS and redirect all traffic to SSL.',
			];
		}

		if ( $results['wp_debug'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'WP_DEBUG is enabled.',
				'recommendation' => 'Disable WP_DEBUG on production websites.',
			];
		}

		if ( $results['wp_debug_log'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'WP_DEBUG_LOG is enabled.',
				'recommendation' => 'Disable WP_DEBUG_LOG unless actively troubleshooting.',
			];
		}

		if ( ! $results['file_editing_disabled'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'File editing is enabled.',
				'recommendation' => 'Set DISALLOW_FILE_EDIT to true.',
			];
		}

		if ( $results['auto_updates_disabled'] ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'Automatic updates are disabled.',
				'recommendation' => 'Enable automatic updates where appropriate.',
			];
		}

		if ( $results['default_admin_found'] ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'Default administrator username detected.',
				'recommendation' => 'Rename administrator accounts to non-predictable usernames.',
			];
		}

		if ( $results['administrator_count'] > 3 ) {

			$recommendations[] =  [
				'severity' => 'high',
				'message'  => 'Several administrator accounts exist.',
				'recommendation' => 'Review administrator privileges and remove unnecessary accounts.',
			];
		}

		if ( $results['inactive_admins'] > 0 ) {

			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'Inactive administrator accounts detected.',
				'recommendation' => 'Review or remove inactive administrator accounts.',
			];
		}

		if ( $results['inactive_plugins'] > 0 ) {

			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'Inactive plugins detected.',
				'recommendation' => 'Remove unused plugins to reduce the attack surface.',
			];
		}

		if ( $results['wp_config_writable'] ?? false ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'The wp-config.php file is writable.',
				'recommendation' => 'Restrict write access to wp-config.php after making required configuration changes.',
			];
		}

		if ( $results['htaccess_writable'] ?? false ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'The .htaccess file is writable.',
				'recommendation' => 'Restrict write access to .htaccess where your hosting configuration allows it.',
			];
		}

		if ( $results['uploads_executable'] ?? false ) {
			$recommendations[] = [
				'severity'       => 'high',
				'message'        => 'The uploads directory is executable.',
				'recommendation' => 'Disable script execution in the uploads directory.',
			];
		}

		if ( ( $results['core_updates'] ?? 0 ) > 0 ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'WordPress core updates are available.',
				'recommendation' => 'Update WordPress core to the latest supported version.',
			];
		}

		if ( ( $results['plugin_updates'] ?? 0 ) > 0 ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'Plugin updates are available.',
				'recommendation' => 'Review and install available plugin updates.',
			];
		}

		if ( ( $results['theme_updates'] ?? 0 ) > 0 ) {
			$recommendations[] = [
				'severity'       => 'low',
				'message'        => 'Theme updates are available.',
				'recommendation' => 'Review and install available theme updates.',
			];
		}

		if ( $results['xmlrpc_enabled'] ?? false ) {
			$recommendations[] = [
				'severity'       => 'medium',
				'message'        => 'XML-RPC is enabled.',
				'recommendation' => 'Disable XML-RPC unless it is required by your site or integrations.',
			];
		}

		if ( $results['rest_api_public'] ?? false ) {
			$recommendations[] = [
				'severity'       => 'low',
				'message'        => 'The REST API is publicly accessible.',
				'recommendation' => 'Review REST API exposure and restrict sensitive endpoints where appropriate.',
			];
		}

		return $recommendations;
	}
}
