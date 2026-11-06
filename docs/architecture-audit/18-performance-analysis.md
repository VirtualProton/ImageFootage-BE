# Performance analysis

Observed performance-sensitive patterns:

- Provider searches and imports can be synchronous in controllers or run through `FetchThirdPartyData`; external calls and large media result sets are therefore request/queue dependent.
- Admin layout composition queries module trees on each composed view.
- Search/product code uses pagination/limit configuration in some branches, but route-wide pagination behavior is not uniform.
- Eloquent models and controllers contain direct query/database work, increasing risk of repeated queries and N+1 behavior; no benchmark was performed.
- PDF rendering, image/video processing, provider imports, and email sending can be resource-intensive; jobs exist for some email/provider work but not every heavy path.
- Redis, file, and database cache/queue options are configured, but active production selection is unknown.

No response-time, memory, capacity, or traffic claims are made. These are source-level characteristics only.
