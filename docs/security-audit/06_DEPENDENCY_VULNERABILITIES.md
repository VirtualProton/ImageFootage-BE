# Dependency Vulnerabilities and Supply Chain Review

## Composer

Baseline versions include Laravel 5.8.38, Guzzle 6.5.8, Doctrine DBAL 2.13.9, MongoDB Laravel 3.5.3, JWT Auth 1.0.2, Razorpay 2.9.2, Admin/log-viewer and media/PDF packages from the legacy ecosystem. These versions are lifecycle and maintenance risks. No individual Composer CVE is asserted here because `composer audit --locked --format=json` failed: the installed Composer 2.2.25 reports that the `audit` command is not defined.

Composer dependency status is therefore **NOT VERIFIED**, not clean. Run the audit with a supported Composer/tooling image in isolation and preserve the JSON output.

## npm

Read-only `npm audit --json` on the locked tree reported 127 advisories: 6 low, 64 moderate, 50 high, and 7 critical. The tree contains approximately 1,190 dependencies including development tooling.

Direct-package concerns observed include AngularJS 1.7.9, Axios 0.18, Lodash 4.17 range, Vue 2.7, Laravel Mix 4, and resolve-url-loader 2. These advisories may be transitive or unreachable in production; reachability and build impact need triage. No `npm audit fix` was run and no lockfile was changed.

## Runtime/build supply chain

The baseline Dockerfile uses an unpinned `composer:2` copy source and a Node 14 build image. Node 14 is EOL. Image digests, registry provenance, OS package CVEs, and artifact signing were not verified.

## Classification

SEC-016 is a confirmed dependency-advisory inventory result. SEC-017 is not verified due to tooling limitation. Legacy support status is a release risk but is not automatically a CVE finding.
