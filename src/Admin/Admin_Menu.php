<?php

namespace Atlasbaz\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Atlasbaz\Audits\Environment_Audit;
use Atlasbaz\Scoring\Score_Calculator;
use Atlasbaz\Recommendations;
use Atlasbaz\Recommendations\Recommendation_Engine;

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

        $audit      = new Environment_Audit();
        $calculator = new Score_Calculator();
        $engine     = new Recommendation_Engine();

        $results         = $audit->run();
        $score           = $calculator->calculate( $results );
        $recommendations = $engine->generate( $results );
        ?>
        <div class="wrap">
            <h1>Atlasbaz Security Auditor</h1>

            <div class="notice notice-info">
                <p>
                    <strong>
                        Security Score:
                        <?php echo esc_html( $score ); ?>/100
                    </strong>
                </p>
            </div>

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
            <h2>Recommendations</h2>
            <?php if ( empty( $recommendations ) ) : ?>

                <p>No recommendations found.</p>

            <?php else : ?>

                <ul>

                    <?php foreach ( $recommendations as $recommendation ) : ?>

                        <li>
                            <?php echo esc_html( $recommendation['message'] ); ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>
        </div>
        <?php
	}
}