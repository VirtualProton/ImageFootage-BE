# Environment and configuration

Environment names were collected from `.env-sample`, configuration files, and source references. Values, including the local `.env`, are excluded. See `environment-variables.csv` for the inventory.

Important groups are application identity/debug/URL, MySQL and MongoDB, Redis, cache/session/queue, mail, AWS, JWT, payment gateway credentials, Panther/Pond5 credentials and URLs, Elasticsearch, Google/Facebook social login, Msg91, frontend URL, tax/expiry values, media limits, and logging paths.

Behavior when missing varies: Laravel config defaults often provide local fallback values; credentials may result in provider failure; `APP_KEY`/`JWT_SECRET` are security-critical; database and mail settings depend on environment. The repository does not provide a verified required/optional matrix for every deployment.
