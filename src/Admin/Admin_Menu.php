<?php

namespace Atlasbaz\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Atlasbaz\Audits\Environment_Audit;

class Admin_Menu {

	public function register(): void {

		add_action(
			'admin_menu',
			[ $this, 'add_menu' ]
		);
	}

	public function add_menu(): void {

		add_menu_page(
			'Atlasbaz Security Auditor',
			'Atlasbaz',
			'manage_options',
			'atlasbaz-security-auditor',
			[ $this, 'render_dashboard' ],
			'dashicons-shield-alt',
			80
		);
	}

	public function render_dashboard(): void {

            $audit = new Environment_Audit();

            $results = $audit->run();
        ?>
        <div class="wrap">
            <h1>Atlasbaz Security Auditor</h1>

            <h2>Environment Audit</h2>

            <table class="widefat striped">
                <tbody>
                    <tr>
                        <th>PHP Version</th>
                        <td><?php echo esc_html( $results['php_version'] ); ?></td>
                    </tr>

                    <tr>
                        <th>WordPress Version</th>
                        <td><?php echo esc_html( $results['wordpress_version'] ); ?></td>
                    </tr>

                    <tr>
                        <th>HTTPS Enabled</th>
                        <td>
                            <?php echo esc_html( $results['https_enabled'] ? 'Yes' : 'No' ); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
	}
}