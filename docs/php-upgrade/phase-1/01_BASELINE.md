# Phase 1 baseline

Audit date: 29 October 2026 (Asia/Calcutta). Status: **PARTIAL**; local assessment is complete, production inventory and a successful restore rehearsal are pending. No Phase 2 implementation is included.

Evidence labels used throughout this directory:

- **VERIFIED**: observed locally, in tracked source/lock metadata, or in the cited public upstream metadata. The scope is always stated.
- **INFERRED**: likely architecture or behavior from configuration, not demonstrated against a running deployment.
- **PENDING**: requires an operator check, external access, or an isolated service fixture.
- **BLOCKED**: could not execute here because a required tool/environment is unavailable or unsafe to use.

## Source baseline and preservation

**VERIFIED**: repository `C:/Projects/imagefootage/imagefootage_BE`, branch `final_update`, HEAD `a461926a4` (`fix: update custom quotation details and template`). Working tree was clean at audit start. This HEAD includes the user's `Common.php` and custom quotation changes; they were not overwritten. This audit adds documentation only. No branch was switched, deployment triggered, or commit/push performed.

Commands: `git status --short`, `git branch --show-current`, `git log -3 --oneline`, `git ls-files`. Existing `UPGRADE_PLAN.md` is preserved. No previous `progress.md` existed; a new progress history was started and updated during the audit.

The original dependency manifests, lockfiles, Dockerfile, and quotation source are checked against SHA-256 hashes at the end; see `evidence/baseline-hashes.json` and `10_PHASE_1_REPORT.md`.

## Versions

| Item | VERIFIED observation | Scope |
| --- | --- | --- |
| PHP | 7.4.33 CLI, NTS, x64, Zend 3.4.0 | Local Windows executable; not production FPM |
| Composer | 2.2.25 | Local; lacks `audit` command |
| Laravel | 5.8.38 | Lock, installed metadata, isolated `artisan --version` |
| PHP dependencies | 125 runtime + 35 development; all 160 installed versions match lock | Metadata comparison; not a fresh install |
| MongoDB PHP extension | 1.16.2 | Local CLI platform check |
| Node / npm | 24.12.0 / 11.6.2 | Local; differs from Docker build |
| Docker declarations | PHP 7.4.33 FPM, Node 14.21.3; Composer floating `2` image | Dockerfile; actual deployed digests PENDING |
| npm lockfile | v3 | Root package-lock.json; clean Node 14/npm compatibility PENDING |
| PHPUnit | 7.5.20 | Installed and executed in isolated source copy |

**PENDING** target implementation: PHP 8.5 latest patched stable and Laravel 13 latest compatible stable. Public metadata was checked on the audit date; target versions are candidates, not installed or solver-proven. PHP currently announces 8.5.12; Laravel registry metadata reports 13.39.0. Recheck before any implementation. Sources: [PHP announcements](https://www.php.net/index.php), [Laravel support table](https://laravel.com/docs/13.x/releases), [Laravel package metadata](https://repo.packagist.org/p2/laravel/framework.json).

## Baseline assessment

**VERIFIED**: Composer validation and installed-platform checks pass; 413 first-party PHP files pass syntax checks. Isolated application bootstrap and route inspection pass. The existing two-test suite has one passing unit test and one failing feature test (`GET /`: expected 200, observed 404) under the documented isolated configuration.

**VERIFIED**: local Vue is 2.7.14 while the lock requires 2.7.16; AngularJS is locked at 1.7.9 but absent locally. Existing node_modules is not a clean reproduction of the lockfile. Security and frontend build assessment are in `05_BUILD_TEST_RESULTS.md`.

**BLOCKED**: Docker CLI is not installed. No full Docker build or fresh PHP dependency installation was performed. Existing vendor metadata matching the lock does not prove the current Dockerfile can reproduce the baseline from scratch.

## Isolation used for checks

Application inputs were copied to a temporary directory outside the repository; no `.env`, cached configuration, logs, uploaded media, SQL dumps, or private keys were copied. Composer autoload metadata was copied so its application base path resolves inside the temporary source copy. Existing vendor package directories were linked for read access; PHPUnit used an explicit wrapper loading the copied autoloader. No dependency installation or vendor source edits occurred.

The harness supplied disposable secrets, disabled debug, set MySQL/MongoDB/Redis/Elasticsearch to refused loopback port 1, used array mail/cache/sessions and local storage, disabled SMS, cleared integration environment keys, disabled URL fopen and PHP cURL/socket/process/mail functions, and ran only version/route inspection and the existing example tests. `RANDOM_PATH_FOR_LOGS=all-logs` selected the repository default rather than the user's private configured path. Optional local/debug-only routes are therefore excluded. This is a controlled baseline assessment, not production-equivalent acceptance.

Frontend build/audit ran in separate temporary copies with no `.env`. No application HTTP endpoints, payment APIs, SMS gateways, or customer mail were invoked. Temporary check output is summarized and retained under `evidence/` where useful; temporary copies are not production backups.
