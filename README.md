# Atlasbaz Security Auditor

Atlasbaz Security Auditor helps WordPress administrators understand the security condition of their website.

It reviews important settings, identifies potential risks, and presents a security score with practical recommendations. The plugin is designed to help you see what deserves attention without changing your website automatically.

## What the Plugin Does

After activation, the plugin checks several areas of your WordPress website:

- PHP, WordPress version, and HTTPS protection
- Debugging and file-editing settings
- Automatic update settings
- Administrator accounts and inactive administrators
- Inactive plugins
- Available WordPress, plugin, and theme updates
- XML-RPC and REST API exposure
- Important file and uploads-directory permissions
- Database configuration, including the table prefix and character set

The results are shown in the **Atlasbaz** page inside your WordPress administration area.

## Security Score

The score starts at 100 and decreases when the audit finds a risk:

- **High severity:** 10 points deducted
- **Medium severity:** 5 points deducted
- **Low severity:** 2 points deducted

The score is an overview, not a guarantee that a website is completely secure. A high score does not replace regular updates, backups, access-control reviews, or professional security testing.

## Installation

### Install from a ZIP file

1. Download the plugin ZIP file.
2. In WordPress, open **Plugins → Add New Plugin**.
3. Select **Upload Plugin**.
4. Choose the ZIP file and select **Install Now**.
5. Select **Activate Plugin** after installation.
6. Open **Atlasbaz** in the WordPress administration menu.

### Install manually

1. Extract the plugin folder.
2. Copy it into your site's `wp-content/plugins/` directory.
3. Open **Plugins** in WordPress administration.
4. Activate **Atlasbaz Security Auditor**.
5. Open **Atlasbaz** to view the dashboard.

## Using the Dashboard

Open **Atlasbaz** whenever you want to review the current security status of the site.

The dashboard includes:

- The overall security score
- A summary of total and high-priority findings
- Environment and WordPress configuration details
- Administrator and plugin information
- Available software updates
- API exposure information
- File-permission information
- A recommendation for each detected finding

Review high-severity findings first, then medium and low-severity findings. After resolving an issue, return to the dashboard to review the updated result.

## Recommendations

Atlasbaz reports issues but does not apply fixes automatically. Depending on the recommendation, you may need to:

- Update WordPress, plugins, or themes
- Disable debugging on a production website
- Review administrator accounts
- Remove unused plugins
- Review XML-RPC or REST API exposure
- Restrict access to sensitive files
- Disable script execution in the uploads directory
- Review the database table prefix and character set

Always create a backup and confirm that a recommended change is compatible with your hosting environment, theme, plugins, and integrations before applying it.

## Important Limitations

- The plugin is an auditing tool, not a complete vulnerability scanner or penetration test.
- Results reflect the website's condition at the time of the scan.
- Update information depends on the information available to WordPress.
- File-permission results can vary between operating systems and hosting providers.
- API checks identify broad exposure and do not inspect every endpoint or integration.
- Database checks provide configuration indicators and do not replace database-hardening or hosting-level reviews.
- Some recommendations require hosting-level access or assistance from your hosting provider.

## Privacy and Changes

The plugin is intended to inspect the local WordPress installation and display its results to administrators. It does not automatically modify the site's configuration, update software, or change file permissions.

## Support

Before requesting help, note:

- Your WordPress and PHP versions
- The finding or dashboard section involved
- Whether the issue occurs on a local or hosted website
- Any recent plugin, theme, or hosting changes

## License

Atlasbaz Security Auditor is licensed under GPL-2.0-or-later. See [LICENSE](LICENSE) for the full license text.
