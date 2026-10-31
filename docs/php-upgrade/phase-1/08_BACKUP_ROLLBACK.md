# Backup, restore rehearsal and rollback

Status: **PENDING / NOT VERIFIED**. No backup, restore, export, live data read or deployment rollback was executed. Existing SQL/PDF/data files in this checkout are not accepted recovery artifacts. Phase 1 cannot be marked complete until recovery is rehearsed safely.

## Scope and recovery record

Preserve SQL and MongoDB data with indexes, uploaded media and generated PDFs, application volumes/bind mounts, S3 object versions, search index rebuild/snapshot inputs, baseline image/source/lockfiles, current environment configuration including APP_KEY/JWT secrets, and Coolify resource metadata. Record backup timestamp/timezone, consistency boundary, application commit/image digest, DB/tool versions, source identifiers, encryption/key owner, checksums, retention and off-host location. RPO/RTO and cross-store consistency requirements are **PENDING** business/operations decisions; do not invent recovery targets.

Environment values must be exported only by an authorized operator into an encrypted restricted secret store, never printed or committed. Production APP_KEY is needed to recover encrypted application data; do not regenerate it. A separate test key does not decrypt existing encrypted fixtures unless data is re-encrypted or an explicitly controlled recovery rehearsal uses protected keys. Coolify image rollback uses current runtime settings, so preserve a versioned configuration snapshot separately.

## Read-only preflight — PENDING

Use the inventory commands in `03_RUNTIME_INVENTORY.md`, then inspect selected mounts without displaying environment:

```sh
APP_CONTAINER='<verified-application-container>'
SOURCE_VOLUME='<verified-volume-name>'
docker inspect --format '{{json .Mounts}}' "$APP_CONTAINER"
docker volume inspect --format '{{.Name}} {{.Driver}} {{.Mountpoint}}' "$SOURCE_VOLUME"
docker exec "$APP_CONTAINER" sh -c 'test -d /var/www/html/storage/app/public/pdf && test -d /var/www/html/public/uploads'
mysqldump --version
mongodump --version
mongorestore --version
```

A false path check is evidence of a missing/different path, not permission to create one in production. Privately confirm all bind paths, SQL engines, Mongo replica-set/sharded topology and backup tool flags. Physical database volume archives from a live database are not consistent logical backups. Cross-MySQL/Mongo/media consistency requires a documented snapshot/write boundary or an approved coordinated approach; this phase does not stop production or pause customer writes.

## Backup procedures — runbook only, NOT executed

Choose the active Coolify engine-aware backup mechanism if available and record execution/location/checksum. A successful dump file alone is insufficient; [Coolify's backup guide](https://coolify.io/docs/databases/backups) requires a disposable restore/read verification. External managed databases need their own provider-supported backup/PITR inventory. Coolify's own control-plane backup is distinct from application database/media backups.

Example Linux commands below write new protected backup artifacts but do not alter source data. Resolve placeholders, verify supported flags for actual tool/server versions, obtain the required database backup permissions, and use encrypted storage. Do not execute blindly or pass passwords in CLI arguments.

```sh
umask 077
BACKUP_DIR='<existing-protected-encrypted-backup-directory>'
MYSQL_DATABASE='<verified-source-database>'
MONGO_DATABASE='<verified-source-database>'

# /secure/phase1-mysql-backup.cnf contains protected credentials and verified TLS settings.
# --defaults-extra-file must be the first option.
mysqldump --defaults-extra-file=/secure/phase1-mysql-backup.cnf \
  --single-transaction --quick --routines --triggers --events --hex-blob \
  --set-gtid-purged=OFF --no-tablespaces \
  --result-file="$BACKUP_DIR/mysql-baseline.sql" "$MYSQL_DATABASE"

# Mongo Database Tools config contains the verified URI/auth/TLS settings; no URI is printed.
mongodump --config=/secure/phase1-mongodb-backup.yml \
  --db="$MONGO_DATABASE" --archive="$BACKUP_DIR/mongodb-baseline.archive.gz" --gzip

sha256sum "$BACKUP_DIR/mysql-baseline.sql" "$BACKUP_DIR/mongodb-baseline.archive.gz"
```

`--single-transaction` is appropriate for transactional tables without conflicting DDL; nontransactional tables need an engine-appropriate consistent backup approach. SQL routines/events may require extra privileges. Mongo per-database dump above is not an application-wide point-in-time snapshot during concurrent writes; full replica-set/oplog or sharded backups require a topology-specific procedure. Do not add `--oplog` to a filtered per-database dump indiscriminately. Sources: [MySQL backup manual](https://downloads.mysql.com/docs/mysql-backup-excerpt-8.0-en.pdf), [MongoDB dump tools](https://www.mongodb.com/docs/database-tools/mongodump/).

For filesystem media volumes, archive source read-only into an independent backup directory using a reviewed tool image:

```sh
SOURCE_VOLUME='<verified-media-volume>'
BACKUP_IMAGE='<trusted-backup-image@sha256:verified-digest>'
docker run --rm --network none \
  --mount "type=volume,source=$SOURCE_VOLUME,target=/source,readonly" \
  --mount "type=bind,source=$BACKUP_DIR,target=/backup" \
  "$BACKUP_IMAGE" tar -czpf /backup/media-baseline.tar.gz -C /source .
sha256sum "$BACKUP_DIR/media-baseline.tar.gz"
tar -tzf "$BACKUP_DIR/media-baseline.tar.gz" >/dev/null
```

For bind mounts substitute the verified absolute source path with `type=bind` and keep it read-only. Capture ownership/permissions/symlinks. Coordinate media consistency with data references; a live archive can race with uploads. Use logical DB backups for SQL/Mongo, not this media-volume recipe. Back up S3 objects via approved versioning/replication/backup tooling to an independent destination; never use a destructive sync/delete command. Redis persistence/queues and Elasticsearch snapshots/reindex inputs require role-specific recovery decisions.

Verify off-host retrieval, checksums and decryption with the actual recovery owner. Keep backup tools/logs from exposing customer data. Preserve Coolify backup/execution/resource settings and secret-store versions privately. Do not run Coolify control-plane restore against the running instance as a rehearsal.

## Restore rehearsal — disposable targets only, NOT executed

1. Provision brand-new isolated SQL/Mongo instances and application media volumes on an isolated network. Record their IDs and verify they differ from source resources. Use staging-only credentials with no production privileges. Deny external email/SMS/payments/media/search writes and disable all workers/scheduled tasks and SQL event scheduling before importing data.
2. Retrieve encrypted backup copies, validate checksums and test decryption. Inspect schema/events/routines and archive paths privately before restore. A sanitizer cannot rely on running the application while unsanitized restored jobs are active.
3. Restore SQL into a new empty database. The protected option file must point only to the disposable target. Avoid `--databases` dumps that could unexpectedly select the original DB name. Review embedded `USE`, DEFINER, routines, events and triggers first.

```sh
STAGING_MYSQL_DATABASE='<new-empty-staging-database>'
mysql --defaults-extra-file=/secure/phase1-mysql-staging.cnf \
  --database="$STAGING_MYSQL_DATABASE" < "$BACKUP_DIR/mysql-baseline.sql"

SOURCE_MONGO_DATABASE='<source-name-in-archive>'
STAGING_MONGO_DATABASE='<new-staging-name>'
mongorestore --config=/secure/phase1-mongodb-staging.yml \
  --archive="$BACKUP_DIR/mongodb-baseline.archive.gz" --gzip \
  --nsInclude="$SOURCE_MONGO_DATABASE.*" \
  --nsFrom="$SOURCE_MONGO_DATABASE.*" --nsTo="$STAGING_MONGO_DATABASE.*"
```

4. Restore media only into a separately created empty staging volume. Validate the resolved destination and archive entries; never extract into source mounts or a host root directory. Recreate required ownership and the public-storage symlink in staging only. SQL/Mongo raw credentials are not copied into the application environment.
5. Keep the data private while replacing PII/contact endpoints, stored API/payment tokens, callback URLs and provider IDs. Remove or quarantine copied queue payloads from the fixture and keep events disabled. Preserve foreign keys and representative pricing/tax/currency/expiry cases. Obtain data-owner approval before allowing a staging app to consume it.
6. Compare source backup metadata with restore results: schema/table/collection counts, indexes, required uniqueness, foreign-key/reference sampling, Mongo ObjectId/date types, selected totals/statuses and media checksums/readability. Capture counts/summaries, not customer rows, in project evidence. Validate encrypted fields with the approved key procedure.
7. Start only the isolated baseline app with sink/fake integrations. Verify representative authenticated reads, quotation/invoice retrieval, media lookup and PDF output on synthetic or approved sanitized records. Do not invoke real payment or notification paths.
8. Record actual backup IDs/checksums, target IDs, tools, duration, errors, comparisons, operator/date and cleanup owner. Verify measured RPO/RTO against agreed targets. A checklist or archive listing is not a successful restore.

Mongo restore flags depend on installed Database Tools; consult the [official mongorestore reference](https://www.mongodb.com/docs/database-tools/mongorestore/). All rehearsal result fields are **PENDING**.

## Deployment rollback rehearsal — NOT executed

Record baseline image digest and availability in the private registry/Coolify image list, source SHA, environment version, mount map, migration state, worker commands and callback destinations. Rehearse image selection on staging first. [Coolify rollback](https://coolify.io/docs/applications/deployments/rollbacks) changes the application image; it does not reverse schema changes, restore storage or external provider state, and uses current runtime configuration.

For a later runtime upgrade: agree failure thresholds and an observation window; stop incompatible staging consumers, select the previous immutable image, restore the matching reviewed runtime configuration if needed, restart compatible consumers, and run targeted read/sandbox checks. Never run old and new consumers concurrently on incompatible queue payloads. Phase 1 makes no schema changes, but future releases still require an explicit schema/job compatibility check.

Do not restore a historical production database over new orders/payments as an ordinary image rollback. A data recovery incident requires separate operator approval, point-in-time planning and reconciliation of accepted payments, media changes and notifications. No destructive production command is provided here.
