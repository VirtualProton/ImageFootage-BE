# Baseline verification results

Audit date: 29 October 2026. All application checks used temporary isolated inputs described in `01_BASELINE.md`. No production application, credentials, databases, workers or customer communications were used. Failures were recorded without fixes.

| Check / actual command | Result | Meaning and limitation |
| --- | --- | --- |
| `php -v`, `php -m` | VERIFIED: CLI 7.4.33; module list in runtime inventory | Local only |
| `composer --version` | VERIFIED: 2.2.25 | Local only |
| `node --version`, `npm --version` | VERIFIED: 24.12.0 / 11.6.2 | Not Docker's Node 14 |
| `composer --no-plugins --no-scripts validate --no-check-publish` | PASS, exit 0 | composer.json valid; no target upgrade attempted |
| `composer --no-plugins --no-scripts check-platform-reqs` | PASS, exit 0 | Installed vendor requirements satisfied on local PHP 7.4; not PHP 8.5 |
| `composer --no-plugins --no-scripts audit` | BLOCKED, exit 1: command not defined | Composer 2.2 has no native audit; fallback below |
| `composer --no-plugins --no-scripts prohibits php 8.5` | Diagnostic ran, exit 0, printed blockers | Root PHP, Laravel, JWT, FFmpeg, Dompdf, PhpSpreadsheet and test/transitive packages block target |
| `composer --no-plugins --no-scripts prohibits laravel/framework "^13.0"` | Diagnostic ran, exit 0, printed blockers | Root/framework/Illuminate constraints and PHP/transitive dependencies block target; output assessed Laravel 13.0.0, not latest patch |
| `php -l <file>` across app/config/routes/tests/bootstrap/database PHP files excluding caches | PASS: 413 files, no syntax failures | PHP 7.4 syntax only; no PHP 8.5/static correctness claim |
| Isolated `php artisan --version` with network/process functions disabled | PASS, exit 0: Laravel 5.8.38 | Disposable configuration |
| Isolated `php artisan route:list --no-ansi` with same safeguards | PASS, exit 0 | Observed actions/middleware saved in evidence/routes.md; environment-conditional routes excluded |
| Isolated existing PHPUnit suite through wrapper calling PHPUnit TextUI Command | FAIL, exit 1: 2 tests, 2 assertions, 1 failure | Unit ExampleTest passes; Feature ExampleTest expects GET / 200, gets 404 with repository-default log path |
| Isolated `npm run production` using copied existing node_modules | FAIL, exit 1: `ERR_OSSL_EVP_UNSUPPORTED` in webpack createHash | Node 24/legacy webpack incompatibility observed; copied node_modules also differs from lock |
| Isolated `npm audit --package-lock-only --ignore-scripts --json` | FAIL/security findings, exit 1: 127 vulnerable package entries | 6 low, 67 moderate, 47 high, 7 critical; registry report, not 127 independent exploitable CVEs |
| `docker --version` | BLOCKED: command not found | No Docker image build or container verification possible locally |
| Fresh Composer/npm install from locks, Docker Node 14 build | PENDING | Not run; no dependency installation or security/platform bypass used |
| Live service versions, production smoke tests and backup/restore | PENDING | No server/Coolify session available |

Detailed outputs: [Composer diagnostics](evidence/composer-diagnostics.json), [PHP lint](evidence/php-lint.json), [application results](evidence/app-check-results.json), [PHPUnit output](evidence/phpunit.txt), [frontend build](evidence/frontend-build-results.json), [npm audit](evidence/npm-audit.json).

## Security advisory fallback

**VERIFIED procedure**: queried Packagist's anonymous security-advisory API with only the 160 public locked package names. Compared every returned `affectedVersions` constraint against the exact locked version using the local Composer PHAR's `Composer\Semver\Semver::satisfies`. No application bootstrap or package installation was involved. No credentials or private source were sent. The first POST attempt used an unsupported request shape and returned HTTP 400; the documented GET `packages[]` queries succeeded. Results are retained in [matched-advisories.json](evidence/matched-advisories.json).

**VERIFIED findings**: 77 advisory/package matches across 21 locked packages. This includes runtime and development packages. Counts can include related or overlapping advisories and do not establish exposure or exploitation. This fallback does not implement every native Composer audit policy (e.g. malicious-package policy, all abandoned checks); repeat native `composer audit --locked` with an approved audit-capable Composer tool in an isolated environment before acceptance. No global Composer upgrade was performed.

| Locked package | Matching advisory records |
| --- | --- |
| aws/aws-sdk-php | 2 |
| dompdf/dompdf | 14 |
| firebase/php-jwt | 1 |
| guzzlehttp/guzzle | 9 |
| guzzlehttp/psr7 | 4 |
| laravel/framework | 10 |
| league/flysystem | 1 |
| maatwebsite/excel | 1 |
| mongodb/mongodb | 2 |
| mtdowling/jmespath.php | 1 |
| phenx/php-svg-lib | 3 |
| phpoffice/phpspreadsheet | 12 |
| phpseclib/phpseclib | 5 |
| psy/psysh | 1 |
| symfony/cache | 1 |
| symfony/http-foundation | 2 |
| symfony/mime | 2 |
| symfony/polyfill-intl-idn | 1 |
| symfony/process | 2 |
| symfony/routing | 2 |
| phpunit/phpunit | 1 |

Sources/method: [Packagist advisory API](https://packagist.org/apidoc#list-security-advisories), [Composer CLI audit](https://getcomposer.org/doc/03-cli.md#audit). Each advisory's affected range, CVE/identifier, severity where supplied and upstream disclosure URL are retained in evidence. Operational applicability and priority remain PENDING assessment.

## Reproduction and pending clean build

The application harness copied source/config/routes/resources/tests/bootstrap plus copied Composer autoload metadata and read-linked dependency packages, but excluded the real `.env`, caches, logs and private data. It provided disposable integration settings, refused loopback service ports and disabled PHP network/process/mail functions. PHPUnit was launched with a wrapper requiring that copied autoloader before `PHPUnit\TextUI\Command::main()`; this avoids loading application paths from the original vendor runner. An initial trial used `--do-not-cache-result`, which PHPUnit 7.5 does not recognize; the final recorded suite removed that unsupported flag. These were harness corrections, not application fixes.

An initial full vendor-copy attempt was stopped because it was unnecessary; the source repository was not modified. Temporary output from a malformed one-line version helper and an inventory script typo was corrected and is not an application failure. A native Docker tool is unavailable, so no image was built.

**PENDING operator clean build**: on a separate approved Docker builder, create a disposable checkout of the recorded baseline commit. Before building, inspect tracked environment-like files and credential-like defaults. Current `.dockerignore` excludes `.env` but includes tracked ` - Copy.env`, `.env-sample`, data files and configuration defaults. Do not send this context to an untrusted remote builder or expose the resulting image. Establish protected build-context handling first. Build without production runtime variables, volumes, networks or ports:

```sh
# Run only in the reviewed isolated baseline checkout; placeholders must be resolved.
git rev-parse HEAD
git status --short
docker build --pull --progress=plain --tag imagefootage:phase1-baseline-a461926a4 .
```

Do not modify locks, run `npm audit fix`, use platform ignores, or disable Composer security policies to make it pass. Record base image digests, build Composer/npm versions, install resolution/errors and generated-asset checksums. `npm install` and floating Composer/base OS packages mean this Dockerfile is not fully pinned even with lockfiles. A successful isolated build and a deployed-image platform check remain acceptance gates. No build command above was executed here.
