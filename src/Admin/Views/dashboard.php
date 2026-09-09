<?php

if (! defined('ABSPATH')) {
    exit;
}

$high_findings = 0;

foreach ( $findings as $finding ) {
    if ( 'high' === ( $finding['severity'] ?? '' ) ) {
        $high_findings++;
    }
}

$score_class = 'notice-error';

if ( $score >= 80 ) {
    $score_class = 'notice-success';
} elseif ( $score >= 50 ) {
    $score_class = 'notice-warning';
}
?>

<div class="wrap">

    <h1>Atlasbaz Security Auditor</h1>

    <div class="notice <?php echo esc_attr( $score_class ); ?>">
        <p>
            <strong>
                Security Score:
                <?php echo esc_html($score); ?>/100
            </strong>
        </p>
    </div>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>Total Findings</th>
                <th>High Priority</th>
                <th>Inactive Plugins</th>
                <th>Available Updates</th>
                <th>API Risks</th>
                <th>Permission Risks</th>
                <th>Database Risks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo esc_html( count( $findings ) ); ?></td>
                <td><?php echo esc_html( $high_findings ); ?></td>
                <td><?php echo esc_html( $results['inactive_plugins'] ); ?></td>
                <td><?php echo esc_html( $results['core_updates'] + $results['plugin_updates'] + $results['theme_updates'] ); ?></td>
                <td><?php echo esc_html( (int) ( $results['xmlrpc_enabled'] ?? false ) + (int) ( $results['rest_api_public'] ?? false ) ); ?></td>
                <td><?php echo esc_html( (int) ( $results['wp_config_writable'] ?? false ) + (int) ( $results['htaccess_writable'] ?? false ) + (int) ( $results['uploads_executable'] ?? false ) ); ?></td>
                <td><?php echo esc_html( (int) ( $results['default_table_prefix'] ?? false ) + (int) ( $results['legacy_database_charset'] ?? false ) ); ?></td>
            </tr>
        </tbody>
    </table>

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

    <h2>Plugin Audit</h2>

    <table class="widefat striped">
        <tbody>

            <tr>
                <th>Inactive Plugins</th>
                <td>
                    <?php echo esc_html(
                        $results['inactive_plugins']
                    ); ?>
                </td>
            </tr>

        </tbody>
    </table>

    <h2>Update Status</h2>

    <table class="widefat striped">
        <tbody>
            <tr>
                <th>WordPress Core Updates</th>
                <td><?php echo esc_html( $results['core_updates'] ); ?></td>
            </tr>
            <tr>
                <th>Plugin Updates</th>
                <td><?php echo esc_html( $results['plugin_updates'] ); ?></td>
            </tr>
            <tr>
                <th>Theme Updates</th>
                <td><?php echo esc_html( $results['theme_updates'] ); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>API Exposure</h2>

    <table class="widefat striped">
        <tbody>
            <tr>
                <th>XML-RPC</th>
                <td><?php echo esc_html( ( $results['xmlrpc_enabled'] ?? false ) ? 'Enabled' : 'Disabled' ); ?></td>
            </tr>
            <tr>
                <th>REST API</th>
                <td><?php echo esc_html( ( $results['rest_api_public'] ?? false ) ? 'Publicly accessible' : 'Restricted' ); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>File Permissions</h2>

    <table class="widefat striped">
        <tbody>
            <tr>
                <th>wp-config.php Writable</th>
                <td><?php echo esc_html( ( $results['wp_config_writable'] ?? false ) ? 'Yes' : 'No' ); ?></td>
            </tr>
            <tr>
                <th>.htaccess Writable</th>
                <td><?php echo esc_html( ( $results['htaccess_writable'] ?? false ) ? 'Yes' : 'No' ); ?></td>
            </tr>
            <tr>
                <th>Uploads Directory Executable</th>
                <td><?php echo esc_html( ( $results['uploads_executable'] ?? false ) ? 'Yes' : 'No' ); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>Database Configuration</h2>

    <table class="widefat striped">
        <tbody>
            <tr>
                <th>Default Table Prefix</th>
                <td><?php echo esc_html( ( $results['default_table_prefix'] ?? false ) ? 'Yes' : 'No' ); ?></td>
            </tr>
            <tr>
                <th>Legacy Character Set</th>
                <td><?php echo esc_html( ( $results['legacy_database_charset'] ?? false ) ? 'Yes' : 'No' ); ?></td>
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
