# Phase 1 risk register

Audit date: 29 October 2026. Owners below are proposed roles, not confirmed assignments. All risks remain open unless the resolution column says otherwise. Risk priority is an engineering assessment; source evidence is identified separately from unverified impact.

| ID | Priority / evidence status | Finding and impact | Resolution / gate | Proposed owner |
| --- | --- | --- | --- | --- |
| R01 | Critical; VERIFIED versions, production exposure PENDING | PHP 7.4/Laravel 5.8 are unsupported; locked dependencies match known advisories | Assess live exposure privately; complete isolated migration path and security triage without forcing installations | Backend + operations |
| R02 | Critical; PENDING recovery | No verified backup restore or RPO/RTO; existing dump files are not recovery proof | Execute and evidence isolated SQL/Mongo/media restore, key recovery and reconciled consistency checks | Operations + data owner |
| R03 | Critical; VERIFIED repository, live validity PENDING | Credential-like fallback literals in config; tracked environment-like files enter Docker context | Restricted review, stop staging/external build until isolation is proven; separately scope secret hygiene/rotation if needed; never print values | Security + operations |
| R04 | Critical; VERIFIED constraints | Payumoney latest wrapper only permits Laravel 5.5/6; CKEditor latest only ~5 | Select maintained integrations/replacements and test contracts before upgrade checkpoints | Backend + payments/admin owners |
| R05 | High; VERIFIED metadata | LaravelCollective abandoned; latest proxy/dump-server constraints block target | Decide replacement/framework middleware/unused-tool handling in implementation; do not remove during audit | Backend |
| R06 | Critical; VERIFIED code coupling, correctness PENDING | Payments, quotation conversion, PDF and mail coupled; repeated/concurrent callbacks not tested | Sandbox signature/amount/reference/replay/concurrency tests; compare business outputs | Backend + finance |
| R07 | Critical; VERIFIED legacy Mongo integration | Jenssegers namespace v3.5; new integration/extension/server behavior can alter ids, dates and queries | Confirm server version/topology; checkpoint integration upgrades and fixture comparisons | Backend + DBA |
| R08 | High; VERIFIED tooling drift | Node 14 Docker vs local Node 24, v3 lockfile, npm install, Vue drift/missing AngularJS | Clean isolated Docker baseline build; resolve deterministic build strategy later; no lock changes in Phase 1 | Frontend + operations |
| R09 | High; VERIFIED local failure | npm production build fails with webpack/OpenSSL under Node 24 | Preserve failure; verify original Docker Node 14 separately before deciding build migration | Frontend |
| R10 | High; VERIFIED limited tests | Only examples, one feature test fails 404; no business coverage | Establish meaningful characterization tests after isolation/recovery acceptance | Backend + QA |
| R11 | High; VERIFIED image strategy, deployment PENDING | Floating Composer 2/base OS packages and snapshot repositories prevent fully pinned reproduction; Docker absent locally | Record clean install/build and actual digests; retain immutable baseline image | Operations |
| R12 | High; PENDING persistence | Coolify volume/bind/object storage configuration unknown | Inventory every write path/mount, capacity, ownership, backup and independent staging destination | Operations |
| R13 | High; VERIFIED scheduler definitions, execution PENDING | Expiry/balance jobs can affect money and payment links; Docker CMD starts no workers/scheduler | Confirm actual host/Coolify launchers; disable staging jobs/cron endpoints until fixtures and queues isolated | Operations + backend |
| R14 | High; VERIFIED legacy deployment files, active usage PENDING | Existing SSH/git-pull workflow and CodeDeploy Apache paths may conflict with reported Coolify path | Inspect webhook/branch/server mapping before any push; no workflow added or edited | Operations |
| R15 | High; VERIFIED client, server PENDING | Elasticsearch 7 client cannot be upgraded independently of cluster | Verify cluster version/mappings; separate index/snapshot migration from framework change | Search owner |
| R16 | High; VERIFIED source, output PENDING | Dompdf/Chromium/Browserless/font or image/FFmpeg API upgrades can change deliverables | Baseline visual/media fixtures; test all renderers and fallback without provider side effects | Backend + QA |
| R17 | High; VERIFIED integrations, isolation PENDING | Staging could send email/SMS, charge gateway, spend media quota, expose data or modify S3/search | Egress deny first; dedicated stores/accounts/credentials; review literal defaults and all direct integrations | Operations + security |
| R18 | Medium; VERIFIED audit limitation | Native Composer audit unavailable; fallback 77 matches/21 packages; npm reports 127 vulnerable entries | Repeat supported native lock audit; assess applicability and remediation owners; no blind audit-fix | Backend + security |
| R19 | High; PENDING live environment | CLI/FPM/worker PHP, DB versions, TLS/proxies/cookies and cron timezone unverified | Run exact read-only inventory in runtime document and attach sanitized results | Operations |
| R20 | High; INFERRED architecture consequence | SQL/Mongo/media consistency and accepted payments complicate rollback | Agree consistency boundary, immutable artifacts and forward-write reconciliation; staging rehearsal required | Operations + finance |

## Restricted findings: locations only

**VERIFIED source pattern matches**, not proof of active/valid credentials: credential-like nonempty environment defaults in `config/aws.php` (20–21), `config/constants.php` (59, 63), `config/database.php` (53, 73), `config/payments.php` (5, 10), `config/thirdparty.php` (6, 17, 27, 34, 41, 48); literal salt-like field in `config/payumoney.php` (6). Line numbers refer to baseline `a461926a4` and can move. There are also historical commented payment literals; do not assume comments are harmless for source/image disclosure. Values are omitted from these documents/evidence.

Tracked environment-like files: ` - Copy.env`, `.env-sample`. Exact `.env` is ignored, but those two are tracked and are not excluded by the current Docker context rules. Existing SQL files/customer documents and a legacy log are also in the tracked tree; their contents were not exported into the audit. A simple password-pattern scan can match validation messages; those are not automatically classified as secrets. No values were validated with external services and no credentials were rotated.

## Phase 1 exit blockers

1. **BLOCKED locally:** no Docker builder for full baseline image reproduction.
2. **PENDING operator access:** deployed runtime/topology, mounts, worker/scheduler and Coolify settings verification.
3. **PENDING recovery proof:** complete SQL/Mongo/media restore with key/config preservation, consistency and RPO/RTO evidence.
4. **PENDING isolation proof:** dedicated staging identities/stores, notification/payment egress controls, and safe handling of tracked environment files/configuration defaults.
5. **PENDING compatibility decisions:** unsupported wrappers, exact bridge package sets and target dependency solving. The audit matrix identifies these gaps; it does not certify a working PHP 8.5/Laravel 13 graph.

No risk was silently fixed and no production setting was changed. First resolve recovery and staging isolation; then characterize business behavior before implementation.
