# Dependency and Compatibility Matrix

**Baseline:** `441f7d89d` `composer.lock`, `package.json`, `Dockerfile`  
**Status:** proposed targets are planning recommendations, not installed versions.

| Component | Verified original | Proposed target / decision | Migration work | Risk |
|---|---|---|---|---|
| PHP | 7.4.33 | 8.5 fixed patch | Extension ABI, language changes, runtime/container validation | Critical |
| Laravel | 5.8.38 | 13 current supported patch | Eight major guides and application adaptation | Critical |
| Node | 14.21.3 | 26 LTS, after build test | Rebuild Mix/Webpack toolchain; pin image | Medium |
| Composer | `composer:2` unpinned | Composer 2 current stable, pinned | Reproducible installer/image and lock validation | Medium |
| Laravel Mix | ^4.0.7 | Keep temporarily or replace only after asset audit | Verify Sass/Webpack/Vue build outputs | Medium |
| Vue | ^2.7.16 | Keep if active; otherwise isolate/remove | Inventory imports and compiled bundles | Medium |
| AngularJS | ^1.7.9 | Keep only for backend-served legacy screens | Security/asset inventory; no Angular 10 scope | Medium |
| Axios/jQuery/Sass/Lodash | Old direct frontend dependencies | Pin compatible versions or defer | Browser/build regression | Medium |
| MongoDB Laravel | 3.5.3 | Supported adapter compatible with Laravel 13 | Namespace/query/casting/driver migration | Critical |
| JWT | 1.0.2 | Maintained Laravel-compatible package | Claims, guards, refresh and middleware tests | Critical |
| Elasticsearch | 7.17.3 | Compatible PHP client; server unchanged unless approved | Query/index/mapping contract tests | High |
| AWS Laravel | 3.8.1 | Current supported adapter/SDK | S3 multipart, delete, URLs and credentials tests | High |
| Guzzle | 6.5.8 | Supported 7/8 line as transitive constraints allow | SDK request/exception behavior | High |
| DBAL | 2.13.9 | Supported line for selected Laravel | Migration/schema behavior | High |
| Dompdf | 0.8.7 | Supported wrapper or controlled renderer | Golden PDF and HTML/CSS comparison | High |
| FFmpeg wrapper | 4.1.0 | Compatible maintained release | Binary path, codecs, process timeout and storage tests | High |
| Intervention Image | 2.7.2 | Compatible supported major | Resize/orientation/metadata tests | Medium |
| Redis | PECL redis 5.3.7 in Docker | Supported extension/client | Queue/cache/session compatibility | High |
| Predis | 3.3.0 | Resolve against selected Laravel | Cache/queue serialization tests | Medium |
| Razorpay | 2.9.2 | Latest compatible SDK, adapter boundary | Signature, amount, currency, reference, replay tests | Critical |
| PayUMoney | 1.0.4 | Verify maintenance; replace adapter if necessary | Preserve existing callback semantics | Critical |
| PhpSpreadsheet | 1.30.1 | Supported PHP 8.5-compatible release | Import/export fixture tests | Medium |
| Laravel Excel | 3.1.67 | Compatible release | Spreadsheet regression | Medium |
| CKEditor | 4.7.2 | Keep if admin active; security review | Admin editor smoke test | Medium |
| Log viewer | 2.3.0 | Restrict/replace after owner decision | Authorization and sensitive-log review | High |
| Location | 6.6.2 | Resolve compatible release | Provider/API tests; no policy changes | Low/medium |

## Support references

- Laravel 13 supports PHP 8.3–8.5 and security fixes through 17 March 2028: https://laravel.com/docs/13.x/releases
- PHP support table: https://www.php.net/supported-versions.php
- Node release schedule: https://nodejs.org/en/about/previous-releases
- Composer downloads/support: https://getcomposer.org/download/

## Resolution rules

Do not update all packages blindly. For each direct dependency, record the selected version, PHP/Laravel constraints, maintenance status, breaking API changes, external-server compatibility, test evidence and replacement decision. Use Composer prohibition diagnostics at each checkpoint and keep the lock file reviewable.
