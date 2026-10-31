# Dependency compatibility matrix

Audit date: 29 October 2026. **VERIFIED** installed PHP metadata matches all 160 locked packages (125 runtime, 35 dev). All 29 direct Composer packages and all 12 direct npm packages are covered below. `php` itself is covered in the baseline. The transitive lock inventory and advisory matches are included in evidence.

**Interpretation:** PHP/Laravel cells describe declared constraints, not demonstrated runtime support. An unbounded PHP constraint is not a PHP 8.5 test. Standalone packages do not independently guarantee Laravel compatibility. Every target combination remains **PENDING** full dependency solving and regression testing; no update/install/lockfile edit was done. Intermediate ranges below apply to the currently locked package, not a recommended bridge package. Framework-coupled ranges are the intersection of its declared Illuminate requirements; sampled late major patch constraints are indicative and exact checkpoint versions must be resolved later.

Public upstream versions, dates, requirements, conflicts and abandoned flags are retained in [package-metadata.json](evidence/package-metadata.json), fetched from each package's primary registry endpoint `https://repo.packagist.org/p2/<vendor>/<package>.json`. Each package name links its upstream package page. ?No abandoned flag? is not a maintenance or security guarantee. Recommendations and migration risk are **INFERRED engineering assessments**.

## Direct PHP runtime and development dependencies

| Package (scope) | Installed / lock | Root constraint | Locked PHP 8.5 declaration | Locked Laravel 13 declaration | Locked intermediate Laravel declarations | Upstream stable observed / maintenance evidence | Recommended candidate or replacement | Breaking changes / verification | Difficulty | Risk |
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |
| [aws/aws-sdk-php-laravel](https://packagist.org/packages/aws/aws-sdk-php-laravel) (runtime) | 3.8.1 | ~3.0 | Allows | Blocks | 6, 7, 8, 9, 10 | 3.11.0; No abandoned flag; release 2026-03-24 | 3.11.0 candidate + compatible AWS SDK | Storage adapter/config and SDK PHP minimums; S3 streams/URLs; do not remove direct S3 usage | M | High |
| [barryvdh/laravel-dompdf](https://packagist.org/packages/barryvdh/laravel-dompdf) (runtime) | v0.8.7 | ^0.8.5 | Allows | Blocks | 6, 7, 8 | v3.1.2; No abandoned flag; release 2026-02-21 | 3.1.2 candidate | Dompdf 0.8 to 3; fonts, options, remote assets, chroot and pagination; compare PDFs | H | High |
| [doctrine/dbal](https://packagist.org/packages/doctrine/dbal) (runtime) | 2.13.9 | ^2.12.1 | Allows | Standalone; full graph PENDING | No direct framework coupling | 4.5.0; No abandoned flag; release 2026-09-24 | 4.5.0 only if still needed; otherwise review in later implementation | 2 to 4 APIs, schema introspection and migration tooling coupling | M | Medium |
| [elasticsearch/elasticsearch](https://packagist.org/packages/elasticsearch/elasticsearch) (runtime) | v7.17.3 | ^7.9 | Allows | Standalone; full graph PENDING | No direct framework coupling | v9.5.0; No abandoned flag; release 2026-08-04 | Retain server-compatible client line; 9.5.0 is NOT a default recommendation | Client 7 to 8/9 changes namespace/response APIs; cluster upgrade separate | H | High |
| [fideloper/proxy](https://packagist.org/packages/fideloper/proxy) (runtime) | 4.4.2 | ^4.0 | Allows | Blocks | 6, 7, 8, 9 | 4.4.2; No abandoned flag; release 2022-02-09 | Use framework proxy middleware at correct checkpoint | Header trust and TLS forwarding behavior; latest package blocks 13 | M | High |
| [google/apiclient](https://packagist.org/packages/google/apiclient) (runtime) | v2.14.0 | ^2.3.0 | Allows | Standalone; full graph PENDING | No direct framework coupling | v2.20.1; No abandoned flag; release 2026-09-25 | 2.20.1 candidate | PHP floor, auth/Google token handling, Guzzle constraints; API-specific validation | M | Medium |
| [guzzlehttp/guzzle](https://packagist.org/packages/guzzlehttp/guzzle) (runtime) | 6.5.8 | ^6.3 | Allows | Standalone; full graph PENDING | No direct framework coupling | 8.3.1; No abandoned flag; release 2026-10-25 | 7.16.1 candidate to minimize API jump; latest 8.3.1 also needs full graph review | 6 to 7 PSR interfaces, exceptions, promises; framework 13.39 allows 7.8.2 or 8 | M | High |
| [intervention/image](https://packagist.org/packages/intervention/image) (runtime) | 2.7.2 | ^2.5 | Allows | Standalone; full graph PENDING | No direct framework coupling | 4.4.0; No abandoned flag; release 2026-10-17 | 4.4.0 plus image-laravel 4.1.1 candidate | v2 facade/provider and image API rewrite; GD/EXIF and output tests | H | High |
| [laravel/framework](https://packagist.org/packages/laravel/framework) (runtime) | v5.8.38 | 5.8.* | Blocks | Blocks: locked 5.8 | Upgrade required for every checkpoint | v13.39.0; No abandoned flag; release 2026-10-27 | 13.39.0 candidate; checkpoint through every major | Mail, Flysystem, middleware, routes, schema/casts, Carbon, logging and PHP changes | H | Critical |
| [laravel/tinker](https://packagist.org/packages/laravel/tinker) (runtime) | v1.0.10 | ^1.0 | Allows | Blocks | 6 | v3.0.2; No abandoned flag; release 2026-03-17 | 3.0.2 candidate | Console/PsySH dependencies and PHP support | L | Low |
| [laravelcollective/html](https://packagist.org/packages/laravelcollective/html) (runtime) | v5.8.1 | ^5.7 | Allows | Blocks | None | v6.4.1; Abandoned ? spatie/laravel-html | Replace with Blade/HTML or evaluate spatie/laravel-html 3.13.0 | Abandoned; replacement API is not drop-in; inspect all admin forms | H | High |
| [maatwebsite/excel](https://packagist.org/packages/maatwebsite/excel) (runtime) | 3.1.67 | ^3.1 | Allows | Blocks | 6, 7, 8, 9, 10, 11, 12 | 4.0.6; No abandoned flag; release 2026-10-23 | 4.0.6 with compatible PhpSpreadsheet 5.x candidate | Imports/exports, concerns, value binding and formatting; latest line needs Laravel 12/13 | H | High |
| [mongodb/laravel-mongodb](https://packagist.org/packages/mongodb/laravel-mongodb) (runtime) | v3.5.3 | 3.5.x | Unspecified | Blocks | None | 5.12.0; No abandoned flag; release 2026-10-26 | 5.12.0 candidate with supported extension/server | 3 to 4 to 5; namespace, id/_id, casting, relations, query results; ext ^1.21 or ^2 | H | Critical |
| [pbmedia/laravel-ffmpeg](https://packagist.org/packages/pbmedia/laravel-ffmpeg) (runtime) | 4.1.0 | ^4.1 | Blocks | Blocks | None | 8.9.0; No abandoned flag; release 2026-02-24 | 8.9.0 candidate; keep package name unless vendor directs otherwise | Media API, streams/storage integration, FFmpeg binary compatibility | H | High |
| [phpoffice/phpspreadsheet](https://packagist.org/packages/phpoffice/phpspreadsheet) (runtime) | 1.30.1 | ^1.9 | Blocks | Standalone; full graph PENDING | No direct framework coupling | 5.10.0; No abandoned flag; release 2026-09-17 | 5.10.0 candidate aligned with Excel 4 | Current direct requirement explicitly excludes PHP 8.5; methods, types, reader/writer behavior | H | High |
| [predis/predis](https://packagist.org/packages/predis/predis) (runtime) | v3.3.0 | ^3.3 | Allows | Standalone; full graph PENDING | No direct framework coupling | v3.7.0; No abandoned flag; release 2026-10-08 | 3.7.0 candidate after server/framework integration check | Connection options, serialization, cache/queue prefixes and server commands | M | High |
| [rap2hpoutre/laravel-log-viewer](https://packagist.org/packages/rap2hpoutre/laravel-log-viewer) (runtime) | v2.3.0 | ^2.3 | Allows | Blocks | 6, 7, 8, 9, 10 | v3.1.0; No abandoned flag; release 2026-05-12 | 3.1.0 candidate with access-control review | Log route authorization and format; latest line supports Laravel 12/13 | M | High |
| [razorpay/razorpay](https://packagist.org/packages/razorpay/razorpay) (runtime) | 2.9.2 | 2.* | Allows | Standalone; full graph PENDING | No direct framework coupling | 2.9.3; No abandoned flag; release 2026-06-08 | 2.9.3 candidate; sandbox verification required | Direct PHP constraint permits 8.5; signature verification, links, callbacks and HTTP transport remain untested | M | Critical |
| [riazxrazor/payumoney](https://packagist.org/packages/riazxrazor/payumoney) (runtime) | 1.0.4 | ^1.0 | Allows | Blocks | 6 | 1.0.4; No abandoned flag; release 2020-01-17 | Replace wrapper with maintained vendor-supported integration if no supported release exists | Latest metadata still limited to Laravel 5.5/6; merchant hashes/callback contract and hardcoded config | H | Critical |
| [stevebauman/location](https://packagist.org/packages/stevebauman/location) (runtime) | v6.6.2 | ^6.0 | Allows | Blocks | 6, 7, 8, 9, 10 | v7.7.0; No abandoned flag; release 2026-10-05 | 7.7.0 candidate | IP/proxy interpretation, driver defaults and external lookups | M | Medium |
| [tymon/jwt-auth](https://packagist.org/packages/tymon/jwt-auth) (runtime) | 1.0.2 | ^1.0 | Blocks | Blocks | 6, 7, 8 | 2.3.1; No abandoned flag; release 2026-10-24 | 2.3.1 candidate; alternative only if testing requires it | Old PHP constraint blocks 8.x; new JWT dependency/claims/blacklist/refresh behavior | H | Critical |
| [unisharp/laravel-ckeditor](https://packagist.org/packages/unisharp/laravel-ckeditor) (runtime) | 4.7.2 | ^4.7 | Unspecified | Blocks | None | 4.7.2; No abandoned flag; release 2017-11-01 | Replace wrapper; independently review editor build/licensing/support | Latest 4.7.2 still requires Illuminate ~5.0; editor uploads and form bindings | H | High |
| [beyondcode/laravel-dump-server](https://packagist.org/packages/beyondcode/laravel-dump-server) (dev) | 1.3.0 | ^1.0 | Blocks | Blocks | 6 | 2.1.0; No abandoned flag; release 2025-02-26 | Framework-compatible debug tooling; omit/replace later if unused | Latest 2.1.0 metadata stops at Laravel 12; no verified Laravel 13 candidate | L | Medium |
| [filp/whoops](https://packagist.org/packages/filp/whoops) (dev) | 2.18.4 | ^2.0 | Allows | Standalone; full graph PENDING | No direct framework coupling | 2.18.7; No abandoned flag; release 2026-10-18 | 2.18.7 candidate via chosen tool graph | Error rendering; align with Collision constraints | L | Low |
| [fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker) (dev) | v1.9.2 | ^1.4 | Blocks | Standalone; full graph PENDING | No direct framework coupling | v1.9.2; Abandoned | fakerphp/faker 1.24.1 candidate | Abandoned; factory namespaces and deterministic test fixtures | M | Medium |
| [kitloong/laravel-migrations-generator](https://packagist.org/packages/kitloong/laravel-migrations-generator) (dev) | v6.11.1 | ^6.10 | Allows | Blocks | 6, 7, 8, 9, 10 | v7.4.0; No abandoned flag; release 2026-05-10 | 7.4.0 candidate if retained | Schema introspection/DBAL and engine support; never run against production for this audit | M | Medium |
| [mockery/mockery](https://packagist.org/packages/mockery/mockery) (dev) | 1.3.6 | ^1.0 | Allows | Standalone; full graph PENDING | No direct framework coupling | 1.6.15; No abandoned flag; release 2026-08-19 | 1.6.15 candidate | PHPUnit lifecycle/mock API and assertion changes | M | Medium |
| [nunomaduro/collision](https://packagist.org/packages/nunomaduro/collision) (dev) | v3.2.0 | ^3.0 | Allows | Standalone; full graph PENDING | No direct framework coupling | v8.9.5; No abandoned flag; release 2026-07-15 | 8.9.5 candidate with PHPUnit 12 graph | Console/Symfony; current candidate conflicts with PHPUnit <11.5.50 or >=14 | M | Medium |
| [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit) (dev) | 7.5.20 | ^7.5 | Blocks | Standalone; full graph PENDING | No direct framework coupling | 13.4.5; No abandoned flag; release 2026-10-27 | 12.5.42 candidate following Laravel 13 upgrade guide; latest overall is 13.4.5 | 7 to 12 XML/assertions/extensions and PHP minimum; rebuild meaningful fixtures | H | High |

## Target candidate declarations ? VERIFIED metadata, testing PENDING

This separate table prevents confusing current blockers with the proposed replacement's declared support. ?Allows? evaluates PHP 8.5.0 against the candidate's direct PHP constraint. All transitive requirements, extension constraints, server versions and runtime behavior still need resolution/testing.

| Package / candidate | PHP constraint | PHP 8.5 declaration | Laravel 13 declared components | Target support assessment |
| --- | --- | --- | --- | --- |
| aws/aws-sdk-php-laravel 3.11.0 | >=8.1 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| barryvdh/laravel-dompdf v3.1.2 | ^8.1 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| doctrine/dbal 4.5.0 | ^8.2 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| elasticsearch/elasticsearch v9.5.0 | ^8.1 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| fideloper/proxy 4.4.2 | >=5.4.0 | Allows | Blocks | BLOCKER: replacement/removal decision required later |
| google/apiclient v2.20.1 | ^8.1 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| guzzlehttp/guzzle 7.16.1 | ^7.2.5  /  /  ^8.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| intervention/image 4.4.0 | ^8.3 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| laravel/framework v13.39.0 | ^8.3 | Allows | Target framework | Candidate only; full graph/runtime PENDING |
| laravel/tinker v3.0.2 | ^8.1 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| laravelcollective/html v6.4.1 | >=7.2.5 | Allows | Blocks | BLOCKER: replacement/removal decision required later |
| maatwebsite/excel 4.0.6 | ^8.3 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| mongodb/laravel-mongodb 5.12.0 | ^8.2 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| pbmedia/laravel-ffmpeg 8.9.0 | ^8.2 / ^8.3 / ^8.4 / ^8.5 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| phpoffice/phpspreadsheet 5.10.0 | ^8.2 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| predis/predis v3.7.0 | ^7.2  /  /  ^8.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| rap2hpoutre/laravel-log-viewer v3.1.0 | ^8.2 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| razorpay/razorpay 2.9.3 | >=7.3 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| riazxrazor/payumoney 1.0.4 | >=5.6.0 | Allows | Blocks | BLOCKER: replacement/removal decision required later |
| stevebauman/location v7.7.0 | >=8.1 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| tymon/jwt-auth 2.3.1 | ^8.0 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| unisharp/laravel-ckeditor 4.7.2 | Not specified | Unspecified | Blocks | BLOCKER: replacement/removal decision required later |
| beyondcode/laravel-dump-server 2.1.0 | >=7.2.5 | Allows | Blocks | BLOCKER: replacement/removal decision required later |
| filp/whoops 2.18.7 | ^7.1  /  /  ^8.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| fzaninotto/faker v1.9.2 | ^5.3.3  /  /  ^7.0 | Blocks | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| kitloong/laravel-migrations-generator v7.4.0 | ^8.2 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| mockery/mockery 1.6.15 | >=7.3 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| nunomaduro/collision v8.9.5 | ^8.2.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| phpunit/phpunit 12.5.42 | >=8.3 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| fakerphp/faker v1.24.1 | ^7.4  /  /  ^8.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| intervention/image-laravel 4.1.1 | ^8.3 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| spatie/laravel-html 3.13.0 | ^8.2 | Allows | Allows | Candidate only; full graph/runtime PENDING |
| dompdf/dompdf v3.1.6 | ^7.1  /  /  ^8.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| aws/aws-sdk-php 3.402.3 | >=8.2 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| league/flysystem 3.36.0 | ^8.0.2 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| swiftmailer/swiftmailer v6.3.0 | >=7.0.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |
| lcobucci/jwt 5.6.1 | ~8.2.0  /  /  ~8.3.0  /  /  ~8.4.0  /  /  ~8.5.0 | Allows | Standalone; framework coupling N/A | Candidate only; full graph/runtime PENDING |

## Frontend dependencies ? VERIFIED registry/lock/local metadata

PHP and Laravel coupling is N/A for these browser/build packages; build output and Blade integration remain PENDING acceptance. The observed latest version is information, not an instruction to combine those majors with Mix 4. Frontend major migrations must be scoped separately. Missing local packages/version drift prevent calling existing node_modules reproducible.

| Package | Root constraint | Locked | Local installed | Latest observed | Maintenance / compatibility / recommended direction | Difficulty / risk |
| --- | --- | --- | --- | --- | --- | --- |
| [angular](https://registry.npmjs.org/angular/latest) | ^1.7.9 | 1.7.9 | MISSING | 1.8.3 | Registry deprecates AngularJS; EOL. Inventory usage; separate frontend migration; do not substitute modern Angular automatically | H / High |
| [axios](https://registry.npmjs.org/axios/latest) | ^0.18 | 0.18.1 | 0.18.1 | 1.21.0 | 0.18 to maintained line; request/response/error/security behavior changes | M / High |
| [bootstrap](https://registry.npmjs.org/bootstrap/latest) | ^4.1.0 | 4.6.2 | 4.6.2 | 5.3.8 | 4 to 5 removes jQuery dependency and changes markup/utilities; preserve admin behavior | H / High |
| [cross-env](https://registry.npmjs.org/cross-env/latest) | ^5.1 | 5.2.1 | 5.2.1 | 10.1.0 | Latest needs Node >=20; build-tool upgrade only with selected runtime | L / Medium |
| [jquery](https://registry.npmjs.org/jquery/latest) | ^3.2 | 3.7.0 | 3.7.0 | 4.0.0 | Latest major 4 may break legacy plugins; audit bundled admin dependencies | H / High |
| [laravel-mix](https://registry.npmjs.org/laravel-mix/latest) | ^4.0.7 | 4.1.4 | 4.1.4 | 6.0.49 | Latest registry Mix 6; evaluate Mix 4 to 6 or separately scoped Vite; webpack config/plugins differ | H / High |
| [lodash](https://registry.npmjs.org/lodash/latest) | ^4.17.5 | 4.17.21 | 4.17.21 | 4.18.1 | Select patched line after audit; verify imports and browser bundle | L / Medium |
| [popper.js](https://registry.npmjs.org/popper.js/latest) | ^1.12 | 1.16.1 | 1.16.1 | 1.16.1 | Registry deprecates v1 in favor of @popperjs/core; coordinate with Bootstrap | M / Medium |
| [resolve-url-loader](https://registry.npmjs.org/resolve-url-loader/latest) | ^2.3.1 | 2.3.2 | 2.3.2 | 5.0.0 | Upgrade only alongside compatible sass-loader/webpack; URL rewriting/source maps | M / Medium |
| [sass](https://registry.npmjs.org/sass/latest) | ^1.15.2 | 1.64.0 | 1.64.0 | 1.107.0 | Latest registry requires Node >=20.19; deprecated Sass syntax and emitted CSS differences | M / Medium |
| [sass-loader](https://registry.npmjs.org/sass-loader/latest) | ^7.1.0 | 7.3.1 | 7.3.1 | 17.1.0 | Latest registry needs Node >=22.11 and matching webpack; cannot drop into Mix 4 blindly | H / High |
| [vue](https://registry.npmjs.org/vue/latest) | ^2.7.16 | 2.7.16 | 2.7.14 | 3.5.44 | Vue 2 is EOL; installed version violates root ^2.7.16; Vue 3 migration separate and API-breaking | H / High |

## Blocker decisions and checkpoint policy

- **VERIFIED locked blockers:** root PHP `^7.4.33`, framework `5.8.*`, PHP-limited JWT/FFmpeg/test packages and PhpSpreadsheet `<8.5`; many Illuminate requirements prohibit Laravel 13. Diagnostics are saved in `evidence/composer-diagnostics.json`. Exit zero from `prohibits` means the diagnostic executed; blockers were printed.
- **VERIFIED latest-release blockers:** Payumoney wrapper still allows only Laravel 5.5/6; UniSharp CKEditor requires `~5.0`; LaravelCollective is abandoned and stops at Laravel 10; latest dump-server metadata stops at 12. Fideloper's replacement belongs to the framework. These need explicit implementation decisions before target readiness.
- **VERIFIED possible supported path:** JWT 2.3.1, MongoDB integration 5.12.0, FFmpeg 8.9.0, Excel 4.0.6 and Dompdf wrapper 3.1.2 declare Laravel 13 support. They are candidates, not proven drop-in upgrades.
- **PENDING:** exact versions for each bridge (6 ? 7 ? 8 ? 9 ? 10 ? 11 ? 12 ? 13), full dependency solving, supported MongoDB PHP extension/server combination, Elasticsearch client/cluster compatibility, image v2 to v4 API migration, and binary/runtime verification. Do not apply latest packages to old checkpoints.
- **PENDING:** PHPUnit 12 is the framework-guide recommendation; registry latest PHPUnit 13 is not automatically selected. Guzzle 7 is a conservative candidate even though current framework metadata also allows 8. Freshly fetched latest constraints can differ from Laravel 13.0 diagnostics.
- **VERIFIED unsupported stacks:** PHP 7.4, Laravel 5.8, Node 14, Vue 2 and AngularJS have ended public support. No commercial extended support was verified. Source references: [PHP supported versions](https://www.php.net/supported-versions.php), [Laravel release policy](https://laravel.com/docs/13.x/releases), [Node release schedule](https://github.com/nodejs/Release), [Vue 2 EOL](https://v2.vuejs.org/eol/), [AngularJS support notice](https://docs.angularjs.org/misc/version-support-status).

Use [Laravel upgrade guides](https://laravel.com/docs/13.x/upgrade) for every intervening major and [MongoDB's integration upgrade guide](https://www.mongodb.com/docs/drivers/php/laravel-mongodb/current/upgrade/) for namespace, id and serialization changes. Exact target readiness is **PENDING**; this audit did not run a dependency update or claim a successful target solve.
