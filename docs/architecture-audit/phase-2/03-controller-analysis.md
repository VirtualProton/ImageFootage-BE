# Controller-by-controller analysis

The generated `controller-dependency-matrix.csv` represents all 60 controller files under `app/Http/Controllers`, including admin controllers. It records file/class, inheritance, imported dependencies, public methods, route associations, observed middleware, model names, query-operation markers, external markers, jobs/events, and evidence path.

## Major execution chains

### Authentication

`AuthController::__construct(SmsService)` applies `auth:api` except for public auth routes. `login()` validates credentials and calls `auth()->attempt`; `signup()` uses `SignUpRequest`, creates `User`, writes verification data, and sends mail. `signupV2()` branches email vs mobile registration and uses `SmsService` for OTP. `socialLoginv2()` verifies Google tokens and creates/logs in a `User`.

### Search

`SearchController::index(SearchRequest)` normalizes request fields, calls `Pond5\ImageApi::search`, transforms the result, and updates `TrendingWord`. `ElasticSearchController` is a separate direct Elasticsearch route path.

### Commerce/payment

`PaymentController::payment()` loads user/cart state, applies discount/tax handling, creates `Orders` and `OrderItem` rows, then branches to Atom, PayU, or Razorpay. Callback methods update order state, invoice/email effects, and cart state. `paymentPlan()` checks for an active same-type package before creating `UserPackage` gateway state.

### Downloads

`MediaController` branches on package type, expiry, monthly/download limits, provider type, and history records. `multipleDownload()` writes download history and increments package download count; `reDownload()` retrieves prior history and may call Pond5 for a fresh URL.

## Direct business logic in controllers

Controllers contain validation, pricing/tax calculations, gateway parameter construction, direct Eloquent/query-builder writes, mail sending, file proxying, and provider calls. The matrix records these markers; no service/repository layer was inferred where the code calls models directly.

## Evidence limitations

Static method extraction does not prove all dynamic calls or runtime branches. Trait use, inherited methods, resource-controller conventions, closures, and external package handlers are separately marked in the route inventory.
