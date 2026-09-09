# Atlasbaz Security Auditor

Atlasbaz Security Auditor is a WordPress plugin that reviews a site's security posture and presents a score with actionable recommendations.

The plugin is read-only: it reports risks but does not automatically change WordPress configuration, update software, or modify file permissions.

## What It Checks

The current audit includes:

- PHP, WordPress version, and HTTPS status
- `WP_DEBUG`, `WP_DEBUG_LOG`, file editing, and automatic updates
- Administrator count, default administrator usernames, and inactive administrators
- Inactive plugins
- Available WordPress core, plugin, and theme updates
- XML-RPC status and REST API exposure
- Writable `wp-config.php` and `.htaccess` files
- An executable uploads directory

Findings are classified as high, medium, or low severity. The score starts at 100 and applies these deductions:

- High: 20 points
- Medium: 10 points
- Low: 5 points

The score cannot fall below zero.

## Installation

1. Copy the `atlasbaz-security-auditor` directory into `wp-content/plugins/`.
2. Ensure the `vendor/` directory is present, or run `composer install` in the plugin directory.
3. In WordPress admin, open **Plugins** and activate **Atlasbaz Security Auditor**.
4. Open the **Atlasbaz** menu to view the audit dashboard.

For local development, the recommended setup is a WordPress installation running under XAMPP. The plugin directory should be the active working copy inside that installation.

## Development

Requirements:

- PHP 8.2 or newer
- Composer
- WordPress

Install development dependencies:

```powershell
composer install
```

Run the automated tests:

```powershell
composer test
```

The test suite uses PHPUnit and covers score calculation, recommendation rules, and file-permission audit behavior.

Before committing a change:

```powershell
git status
composer test
git add .
git commit -m "Describe the change"
git push
```

Feature work should be developed on a branch and merged into `main` through a pull request.

## Architecture

- `src/Audits/` contains individual audit modules.
- `src/Services/Audit_Manager.php` runs the audit modules and combines their results.
- `src/Recommendations/Recommendation_Engine.php` turns results into findings.
- `src/Scoring/Score_Calculator.php` calculates the security score.
- `src/Admin/Views/dashboard.php` renders the WordPress admin dashboard.
- `tests/Unit/` contains PHPUnit tests for isolated behavior.

New audits should implement `Audit_Interface`, return a small array of result values, and be registered in `Audit_Manager`.

## Limitations

- The plugin does not replace a full vulnerability scanner or penetration test.
- File-permission results depend on the operating system and hosting configuration.
- Update checks depend on WordPress's available update information at scan time.
- API exposure checks identify broad exposure; they do not audit every REST endpoint or integration.
- The current tests do not boot a complete WordPress installation, so the dashboard should also be checked manually in XAMPP.

## License

Atlasbaz Security Auditor is licensed under the GPL-2.0-or-later license. See [LICENSE](LICENSE).
