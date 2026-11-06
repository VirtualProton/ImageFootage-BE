# Catalog and search execution

## Provider-backed search

`SearchController::index` receives `SearchRequest`, defaults `limit` to 25 and page to zero-based, derives media type, and calls `Pond5\ImageApi::search`. Response mappers generate `imgfootage`, `total`, `perpage`, `tp`, encrypted API IDs, slugs, thumbnails, metadata, and music version fields. Searches with a non-empty keyword update or create `TrendingWord`; if results are low/empty it marks processing state.

## Local catalog

`ProductController::productListApi` performs a direct join across `imagefootage_products`, `imagefootage_productcategory`, `imagefootage_productsubcategory`, and `imagefootage_productimages`, returning JSON-encoded rows. Product detail and category methods use Eloquent models and related metadata. `FiltersController` serves filter metadata from filter models.

## Elasticsearch

`ElasticSearchServiceProvider` binds `Elasticsearch\Client` using `ELASTICSEARCH_HOSTS`. `/api/search/{query}` and `/api/store-elasticword` are registered outside the main CORS/JWT group and use `ElasticSearchController`. Index names, document schemas, and live cluster state are not established by the route file alone.

## Provider ingestion

`CronController` dispatches `FetchThirdPartyData` for provider import routes. The job invokes Panther image and Pond5 footage/music/image wrappers and saves provider data through product methods. This is distinct from request-time search: ingestion persists data, while `SearchController` can return provider results directly.

## Caching/error behavior

No dedicated search cache or rate limiter was verified. Provider failure behavior is wrapper/controller-specific; timeouts/retries are unknown unless visible in the wrapper implementation.
