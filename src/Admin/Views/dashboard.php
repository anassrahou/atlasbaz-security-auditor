<?php

if (! defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">

    <h1>Atlasbaz Security Auditor</h1>

    <div class="notice notice-info">
        <p>
            <strong>
                Security Score:
                <?php echo esc_html($score); ?>/100
            </strong>
        </p>
    </div>

    <h2>Environment Audit</h2>

    <table class="widefat striped">
        <tbody>

            <tr>
                <th>PHP Version</th>
                <td><?php echo esc_html($results['php_version']); ?></td>
            </tr>

            <tr>
                <th>WordPress Version</th>
                <td><?php echo esc_html($results['wordpress_version']); ?></td>
            </tr>

            <tr>
                <th>HTTPS Enabled</th>
                <td>
                    <?php echo esc_html(
                        $results['https_enabled'] ? 'Yes' : 'No'
                    ); ?>
                </td>
            </tr>

        </tbody>
    </table>

    <h2>WordPress Audit</h2>

    <table class="widefat striped">
        <tbody>

            <tr>
                <th>WP_DEBUG</th>
                <td>
                    <?php echo esc_html(
                        $results['wp_debug'] ? 'Enabled' : 'Disabled'
                    ); ?>
                </td>
            </tr>

            <tr>
                <th>WP_DEBUG_LOG</th>
                <td>
                    <?php echo esc_html(
                        $results['wp_debug_log'] ? 'Enabled' : 'Disabled'
                    ); ?>
                </td>
            </tr>

            <tr>
                <th>File Editing</th>
                <td>
                    <?php echo esc_html(
                        $results['file_editing_disabled']
                            ? 'Disabled'
                            : 'Enabled'
                    ); ?>
                </td>
            </tr>

        </tbody>
    </table>

    <h2>User Audit</h2>

    <table class="widefat striped">
        <tbody>

            <tr>
                <th>Administrator Accounts</th>
                <td>
                    <?php echo esc_html(
                        $results['administrator_count']
                    ); ?>
                </td>
            </tr>

            <tr>
                <th>Default Username Found</th>
                <td>
                    <?php echo esc_html(
                        $results['default_admin_found']
                            ? 'Yes'
                            : 'No'
                    ); ?>
                </td>
            </tr>

            <tr>
                <th>Inactive Administrators</th>
                <td>
                    <?php echo esc_html(
                        $results['inactive_admins']
                    ); ?>
                </td>
            </tr>

        </tbody>
    </table>

    <h2>Security Findings</h2>
    <?php if ( empty( $findings ) ) : ?>

        <p>No findings detected.</p>

    <?php else : ?>

        <table class="widefat striped">

            <thead>
                <tr>
                    <th>Severity</th>
                    <th>Finding</th>
                    <th>Recommendation</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ( $findings as $finding ) : ?>

                    <tr>

                        <td>
                            <?php echo esc_html( ucfirst( $finding['severity'] ) ); ?>
                        </td>

                        <td>
                            <?php echo esc_html( $finding['message'] ); ?>
                        </td>

                        <td>
                            <?php echo esc_html( $finding['recommendation'] ); ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>
