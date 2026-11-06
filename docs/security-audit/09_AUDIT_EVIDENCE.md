# Audit Evidence

## Baseline and comparison

- Primary baseline: `441f7d89d`.
- Current branch at audit time: `final_update`, ahead of `origin/final_update` by one commit.
- Current checkout differs from the baseline in later upgrade/remediation work, including `UPGRADE_PLAN.md`, `app/Models/Common.php`, and a quotation template. Those changes were not used to erase or downgrade baseline findings.
- Existing `docs/backend-modernization-audit/` documents and `progress.md` content were preserved.

## Repository evidence reviewed

- `composer.json`, `composer.lock`, `package.json`, `package-lock.json`, `webpack.mix.js`
- `Dockerfile`, `docker/nginx.conf`, `config/`, `routes/`
- `app/Http/Controllers/`, `app/Http/Middleware/`, `app/Models/`, `app/Jobs/`, `app/Support/`
- `public/dbc.php`, `database/`, `resources/`, `tests/`, `.gitignore`, `.env-sample`, `- Copy.env`

## Commands and outcomes

- Read-only `git show 441f7d89d:<path>` inspection: completed.
- Read-only route/controller/config scans: completed.
- `npm audit --json`: completed; 127 advisories reported.
- `composer audit --locked --format=json`: not available in installed Composer 2.2.25; no Composer packages were changed.
- No production connection, live payment, email, SMS, credential authentication, exploit payload, destructive test, commit, or push was performed.

## External references used

- PHP official security release for CVE-2026-109618 and CVE-2026-109619.
- GitHub Security Advisory GHSA-6wmf-4rv5-p3rp.
- AWS security bulletin for the PHP issues.
- Laravel release/support documentation.
- OWASP ASVS 5.0 and OWASP API Security Top 10 2023.

## Evidence limitations

The repository cannot prove production reachability, runtime patch level, valid credentials, proxy controls, service configuration, actual user data, or compromise. Those items remain explicitly classified as potential or not verified.
