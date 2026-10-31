# Coolify staging strategy

Status: **PENDING implementation by authorized operator**. No Coolify/server session or credentials were available; no resources, domains, variables, deployments, branches or volumes were created/changed. Production remains untouched. This is a plan, not a claim that staging exists.

## Isolation design

| Boundary | Required staging configuration | Verification / stop condition |
| --- | --- | --- |
| Application/environment | Separate Coolify project environment and application, preferably a separate server for stronger isolation | Record distinct resource IDs; staging must not edit production settings |
| Source | Dedicated branch such as `upgrade/phase-1-baseline`, pinned initially to `a461926a4`; preserve root Dockerfile build strategy | Review existing workflow/webhook triggers before creating/pushing branch; no automatic production deployments |
| Build | Dockerfile build pack, existing Dockerfile and context paths; no new Compose or Actions | No production build secrets; review current tracked env-like files before sending context to builder |
| Domain | Dedicated private/restricted staging hostname, separate cookies/origin and TLS | Access restriction before first deployment; no customer DNS changes |
| MySQL | Separate staging instance/database and user restricted to it; dedicated persistent volume | Read-only version/schema inventory first; restore only into explicit staging target |
| MongoDB | Separate instance/database/auth user and volume | Credentials cannot read/write production; verify indexes/types after sanitized restore |
| Redis | Prefer separate instance/volume; otherwise verified DB separation plus unique cache/session/queue prefixes | Prefix alone is insufficient if code can flush a shared DB; staging cannot access production queues |
| Elasticsearch | Separate instance or protected staging-only indices/aliases with restricted credentials | No production index write or delete permission; cluster version must match client plan |
| Storage | Separate named volumes/bind directories for every required destination; separate S3 bucket or restricted prefix with independent IAM | No shared production source mounts or write-capable bucket credentials; restrict media access |
| Payments | Sandbox/test merchant credentials, staging callback URLs, separate accounts as supported | Deny gateway egress until credentials, hardcoded defaults and callback handling are reviewed |
| Email | Array/discard transport or private mail sink with all external delivery disabled | Test only synthetic recipients; verify no direct SMTP/provider bypass; no production queue consumers |
| SMS | Disabled and egress denied; fake/sandbox provider for later tests | Cover Msg91 and older TnnraoSms adapter; no real OTP/notification calls |
| Media/Google/Browserless | Disable or isolate external APIs; dedicated test account/renderer only when required | No provider quotas/costs/customer HTML transmitted during baseline tests |
| Workers | Initially stopped; later staging-only queues with staging-only DB/Redis | Never consume copied production jobs or enable broad network access |
| Scheduler/cron endpoints | No schedule runner or host cron; block cron-like HTTP endpoints | No expiry, balance transfer, downloads or imports until isolated fixtures approved |
| Secrets | Separate staged secret store, testing APP_KEY/JWT secrets, `APP_DEBUG=false` | Do not copy production environment wholesale; production keys are for protected recovery only |
| Database events | Disable event scheduler and inspect SQL routines/events before restored data becomes active | No imported event, trigger or routine may contact production systems |

**VERIFIED source risk**: config files have credential-like fallback literals, ` - Copy.env` and `.env-sample` are tracked, and `.dockerignore` only excludes the exact `.env`. Blanket environment copying or relying on absent environment variables is unsafe. Variable substitution alone cannot neutralize all literal Payumoney configuration. Do not publish or run the current image with unrestricted egress. Review this in a restricted environment; any later code/config fix needs its own scoped change. No secret value belongs in a Docker build argument, commit, document, screenshot or build log.

## Operator sequence — all PENDING

1. Finish the read-only production inventory in `03_RUNTIME_INVENTORY.md`; record application/image IDs, mount destinations, service versions and active deployment path. Review both existing workflows and Coolify webhooks privately. Do not trigger the legacy SSH/git-pull deploy path.
2. Decide the branch/resource names, private hostname, storage destinations and sandbox owners. Verify the production resource is not selected before changing any Coolify setting.
3. Provision independent stores and volumes using the existing infrastructure process. Restrict network access before deployment; allow only staging data stores and approved mail sink. Do not attach staging to a production database network merely for convenience.
4. Review a fresh baseline build context for tracked secret-bearing files and hardcoded defaults. Keep build artifacts restricted. Record a clean build result without changing dependencies or bypassing checks; unresolved failures are Phase 1 blockers.
5. Supply staging-only variables through Coolify runtime settings. Key families: `APP_*`, `DB_*`, `MONGO_DB_*`, `REDIS_*`, `CACHE_*`, `QUEUE_CONNECTION`, `SESSION_*`, `MAIL_*`, `FILESYSTEM_*`, `AWS_*`, `KEYRAZOR*`, Atom keys/mode, provider keys, `ELASTICSEARCH_HOSTS`, PDF renderer keys and `SMS_*`. Set actual key names from source inventory, not a generic Laravel 13 example. Laravel 5.8 uses `MAIL_DRIVER`/`CACHE_DRIVER` here.
6. Start with no restored customer data, no workers, no scheduler and no permitted external notifications. Confirm UI/app IDs, domain, mounts, driver selection and service endpoints without exposing values.
7. Rehearse restore into disposable staging targets using `08_BACKUP_ROLLBACK.md`. Keep restored data private until scrubbed; replace contacts, credentials/tokens, payment references and notification destinations while preserving relationships and business edge cases. Disable restored jobs/events and discard production queue payloads from the test fixture.
8. Verify isolation explicitly: staging principals cannot access production SQL/Mongo, Redis queue, S3 write paths or search indexes. Verify absence of public cron endpoints and customer notifications through network policy/controlled instrumentation rather than calling real gateways.
9. Record baseline route/build/tests and private PDF/email reference output after safe service fixtures exist. Only then permit synthetic integration tests and controlled staging workers. Phase 2 requires separate authorization after Phase 1 acceptance.

## Persistent paths to map

**VERIFIED source**: `storage/app/public/pdf`, `storage/app/public`, `storage/app`, `public/uploads`, runtime logs/framework state, and temporary `storage/app/browser-pdf`. Inventory direct writes elsewhere, object storage and existing `public/storage` symlink before finalizing mounts. Temporary browser profiles may be ephemeral; customer media/PDF files require explicit durability/retention decisions. Do not mount a whole production `public` tree into staging or cover application assets unintentionally.

No `VOLUME` declaration in Dockerfile proves only that mounts are not declared there. Coolify can supply external mounts. [Coolify storage documentation](https://coolify.io/docs/applications/configuration/persistent-storage) explains source/destination configuration; [storage overview](https://coolify.io/docs/core/persistent-storage/storage-mounts/overview) distinguishes persistence from backup. Live feature names depend on the unverified installed Coolify version.

Acceptance evidence required: staging resource IDs, baseline image digest, endpoint ownership, mount map, database/IAM privilege checks, blocked outbound notification paths, disabled task/worker proof, sanitized fixture approval and successful restore record. Store secret-bearing screenshots/configurations outside Git.
