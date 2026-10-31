# Runtime and environment inventory

**VERIFIED** means local or repository evidence, not a live-production claim. No environment values are reproduced. Key names are documented only where needed to configure isolated staging.

| Component | VERIFIED local / repository evidence | INFERRED or PENDING live detail |
| --- | --- | --- |
| PHP CLI/FPM | Local CLI 7.4.33; Docker `php:7.4.33-fpm` | Live CLI/FPM/worker binaries, image digest and INI limits PENDING |
| Composer | Local 2.2.25; Docker copies floating Composer 2 | Actual build Composer version PENDING |
| Nginx | Docker installs Nginx; root `/var/www/html/public`, port 80, FPM `127.0.0.1:9000` | Coolify proxy TLS, forwarding, health checks and limits PENDING |
| Apache | appspec scripts install/start/stop httpd | Legacy path INFERRED; active hosts PENDING |
| MySQL | Default connection mysql, pdo_mysql; env `DB_*`, `DATABASE_URL`; `strict=false`, InnoDB declared | Server version, engines, SQL modes, TLS, grants, size, schema drift PENDING |
| MongoDB | `mongodb` connection uses `MONGO_DB_*`; `ImageFilterValue` uses legacy Jenssegers model | Version/topology/auth DB/TLS/collection sizes/indexes PENDING |
| Redis | Default client `predis`; default and cache connections in config; `REDIS_*` keys | Instance/version, DB indexes, queue/cache/session use and isolation PENDING |
| Elasticsearch | Client 7.17.3, ElasticsearchServiceProvider builds hosts from `ELASTICSEARCH_HOSTS` | Cluster version, auth/TLS, index mappings/aliases and snapshot capability PENDING |
| Queue | Default `sync`; config supports database/Redis/SQS/beanstalkd; three queued-job classes | Actual `QUEUE_CONNECTION`, worker processes, queues, retry/timeout/failed jobs PENDING |
| Scheduler | hourly `quotation:deactive`, daily `package:to-credit-balance`; other schedules commented | Host/Coolify task or cron launch, timezone, lock/concurrency behavior PENDING |
| Storage | Defaults local, cloud S3; roots storage/app, storage/app/public; direct public uploads; PDFs under storage/app/public/pdf | Mounts, symlinks, object prefixes, retention, size, backups PENDING |
| Mail | Laravel 5.8 `MAIL_DRIVER`, SMTP keys and from identity; queued and direct sending paths | Selected transport, queue delivery and staging sink PENDING |
| Payments | Razorpay and Atom config keys; Payumoney config/provider and callbacks | Merchant accounts, modes, callback registration and sandbox availability PENDING |
| SMS/media | Msg91, TnnraoSms, Pond5/PantherMedia and Google-related code/config | Quotas, billable calls, test accounts, credentials and endpoint reachability PENDING |
| Browser PDF | BrowserPdf supports Browserless env URL/token or local Chromium; CHROME_PATH in Docker | Selected renderer, remote data handling, font availability PENDING |
| FFmpeg/fonts | Docker installs ffmpeg, Chromium, DejaVu/Liberation/Noto fonts | Built binary versions and runtime availability PENDING |
| Persistent volumes | No `VOLUME` instruction; .dockerignore excludes logs/cache content | Coolify mounts are external configuration and cannot be inferred absent |
| Coolify | User reports Dockerfile deployment | App/server IDs, version, branch, build context, env scopes, volumes, networks and backups PENDING |

## PHP extensions and image packages

**VERIFIED local `php -m`**: bcmath, calendar, Core, ctype, curl, date, dom, exif, fileinfo, filter, gd, hash, iconv, json, libxml, mbstring, mongodb, mysqlnd, openssl, pcre, PDO, pdo_mysql, Phar, readline, Reflection, session, SimpleXML, SPL, standard, tokenizer, xml, xmlreader, xmlwriter, zip, zlib. No Zend extension is listed. Redis and pcntl extensions are not loaded locally; Predis can operate without phpredis. MongoDB extension version is 1.16.2 locally, not Docker's pinned 1.16.1.

**VERIFIED Docker additions**: `pdo_mysql mbstring exif pcntl bcmath gd zip`; GD configured with FreeType/JPEG. PECL `mongodb-1.16.1 redis-5.3.7` enabled. Base-image extensions must be inventoried on the actual built image, not assumed from these additions.

System packages: nginx, git, curl, ca-certificates, zip, unzip, ffmpeg, chromium, fonts-dejavu-core, fonts-liberation, fonts-noto-core, libpng-dev, libjpeg62-turbo-dev, libfreetype6-dev, libonig-dev, libxml2-dev, libzip-dev. Docker rewrites Debian repositories to an August 2026 Bullseye snapshot and disables Valid-Until checks. Node build uses `npm install`, then `npm run production`; PHP installation uses `composer install --no-dev --optimize-autoloader --no-interaction --no-progress`. CMD starts FPM and Nginx only; it does not start workers or cron.

## Read-only production checklist — PENDING, not executed

Operator: fill non-secret container names from the Coolify UI. Run on the authorized Linux Docker host. Do not paste unfiltered `docker inspect`, container environment, `phpinfo`, `nginx -T`, application logs, or secret configuration into chat.

```sh
APP_CONTAINER='<application-container>'
MYSQL_CONTAINER='<mysql-container>'
MONGO_CONTAINER='<mongodb-container>'
REDIS_CONTAINER='<redis-container>'
docker version --format '{{.Server.Version}}'
docker ps --format 'table {{.Names}}\t{{.Image}}\t{{.Status}}'
docker inspect --format '{{.Config.Image}} {{.Image}}' "$APP_CONTAINER"
docker inspect --format '{{json .Mounts}}' "$APP_CONTAINER"
docker inspect --format '{{json .NetworkSettings.Networks}}' "$APP_CONTAINER"
docker top "$APP_CONTAINER" -eo pid,comm
docker exec "$APP_CONTAINER" php -v
docker exec "$APP_CONTAINER" php-fpm -v
docker exec "$APP_CONTAINER" php -m
docker exec "$APP_CONTAINER" composer --version
docker exec "$APP_CONTAINER" nginx -v
docker exec "$APP_CONTAINER" ffmpeg -version
docker exec "$APP_CONTAINER" chromium --version
docker exec "$MYSQL_CONTAINER" mysqld --version
docker exec "$MONGO_CONTAINER" mongod --version
docker exec "$REDIS_CONTAINER" redis-server --version
```

Use protected credentials already provisioned on the host for optional read-only service queries. The following option files must exist securely; do not create or reveal them in chat:

```sh
mysql --defaults-extra-file=/secure/phase1-mysql-readonly.cnf --batch --skip-column-names \
  -e 'SELECT VERSION(); SELECT @@sql_mode; SELECT ENGINE,COUNT(*) FROM information_schema.tables WHERE table_schema=DATABASE() GROUP BY ENGINE;'
mongosh --host '<verified-host>' --port '<verified-port>' --username '<readonly-user>' \
  --authenticationDatabase '<verified-auth-db>' --password --quiet \
  --eval 'print(db.version()); printjson(db.hello().setName || "standalone")'
curl --fail --silent --show-error --config /secure/phase1-elasticsearch-readonly.curl \
  'https://<verified-cluster>/?filter_path=version.number'
```

Adapt TLS/CA options to verified service settings. No brute-force port discovery is needed. Redis version above uses the server binary without authentication; an INFO query is optional via an approved secret-injection method. Privately inspect scheduled tasks and worker supervisors through Coolify/host configuration; record command names, cadence, timezone and queue names only, with embedded credentials redacted. Do not run `schedule:run`, workers, migrations, or cron endpoints as an inventory check.

Coolify UI fields to record: version, project/environment/app identifier, source repo and branch, Dockerfile/build-context paths, build arguments by name only, runtime variable names/scopes, published ports, health check, domains, replica count, restart policy, scheduled tasks, persistent source/destination mounts and permissions, attached services/networks, backup schedules/retention and last restore evidence. Mounts/network output may contain private paths/addresses; retain it in restricted operations evidence and summarize identifiers in project docs.
