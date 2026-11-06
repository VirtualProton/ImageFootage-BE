# Search system

Search has two visible implementations. `SearchController` performs application-level product/category/filter/trending operations and includes routes such as `/api/search`, `/api/relatedsearch`, `/api/music-search/{query}`, and category/product endpoints. `ElasticSearchController` exposes `/api/search/{query}` and `/api/store-elasticword`; `ElasticsearchServiceProvider` builds the client from `ELASTICSEARCH_HOSTS`.

Panther Media and Pond5 wrappers provide provider-specific search/import operations. `FetchThirdPartyData` runs those searches asynchronously when dispatched, then saves provider results through `Product` methods. Pagination and limits use configuration values such as `PRODUCT_IN_DATABASE_LIMIT` and `PAGE_LIMIT_THIRD_PARTY` where referenced.

Caching and rate limiting are not established as a dedicated search concern in the inspected source. Request error handling is controller/provider specific; timeout/retry guarantees are unknown unless implemented in the wrapper branch. Search result normalization is performed in custom controllers/wrappers rather than by an indexed search abstraction.
