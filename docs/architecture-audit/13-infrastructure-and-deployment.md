# Infrastructure and deployment

## Container

`Dockerfile` uses a Node 14.21.3 frontend build stage and PHP 7.4.33 FPM runtime. The runtime installs Nginx, FFmpeg, Chromium, GD/JPEG/Freetype/XML/zip-related system libraries, PDO MySQL, MongoDB 1.16.1, and Redis 5.3.7. It builds frontend assets with `npm run production`, installs Composer dependencies without dev packages, copies `docker/nginx.conf`, exposes port 80, and starts PHP-FPM plus Nginx.

## Deployment material

`appspec.yml` describes AWS CodeDeploy-style file copy and lifecycle hooks. `scripts/install_dependencies`, `start_server`, and `stop_server` are repository deployment scripts. `.github/workflows` contains a stage-branch SSH deployment workflow and a commented master workflow. These files describe intended deployment paths, not proof of current production topology.

## Runtime configuration

Configuration includes MySQL, MongoDB, Redis, file/database/Redis cache choices, sync/database/Redis/SQS queue choices, session drivers, mail, AWS, JWT, payment, provider, and Elasticsearch settings. Health checks, reverse-proxy behavior, queue-worker supervision, and cron installation are not fully represented in the repository.
