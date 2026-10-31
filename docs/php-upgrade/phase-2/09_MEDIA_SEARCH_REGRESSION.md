# Media, storage and search

Phase 2.2 executes actual Product Mongo orientation filtering joined to SQL keyword/category/pagination, encrypted result identity and empty result behavior, plus import/duplicate/partial-failure/retry. This resolves the named Product cross-store filter gate. Elasticsearch cluster, full controllers/upload/video/download/S3 acceptance remain blocked. See [current report and 18-gate map](16_REAL_DATABASE_INTEGRATION_REPORT.md).

Tests: `tests/Feature/SearchMediaRegressionTest.php`, `tests/Integration/MongoRegressionTest.php` and named coverage gates in UnavailableFlowsTest.

PASS boundary scenarios:

- Real `/api/search/{query}` route invokes ElasticSearchController with mocked Elasticsearch Client; exact keyword/index/match query and response shape are checked for populated and empty hits.
- Existing search indexing failure returns HTTP 500 with the current error message; generateVariants order is pinned for a three-word example. Search algorithms were not changed.
- MediaController::downloadProxy rejects absent URL, file/FTP protocols and relative paths before cURL execution. No HTTP URL was fetched.
- Actual private local filesystem put/read/missing/delete lifecycle; no shared public directory or cloud disk is configured.
- Actual installed Intervention/GD creates/resizes a tiny synthetic PNG and rejects invalid image input. This is a library-boundary compatibility check, not image upload/orientation/watermark controller coverage.

BLOCKED: SQL/Mongo-backed product/category/filter combinations, pagination/sort correctness in full SearchController/FiltersController, real Elasticsearch index mappings/failures, S3 adapter/emulator, licensed/cross-user/exhausted-plan downloads and history, upload validation/orientation/watermarks, and FFmpeg metadata/thumbnail/error integration. A host FFmpeg executable was found, but process execution is intentionally disabled in this suite; absence of process isolation is the blocker, not an asserted missing binary.

The real MongoDB tests cover nested document filtering/sorting/aggregation when enabled, but are unexecuted here. Mocked Elasticsearch PASS results do not certify relevance, clustering, real pagination or cross-store consistency. Full SQL/Mongo and external acceptance fixtures remain named blockers rather than empty green tests.

Source-only risk requiring separate review: downloadProxy permits any HTTP/HTTPS URL and disables TLS verification. The tests only exercise the early protocol boundary and do not claim SSRF/host/redirect validation or TLS security. Do not probe internal endpoints or enable live networking to demonstrate it in this phase.
