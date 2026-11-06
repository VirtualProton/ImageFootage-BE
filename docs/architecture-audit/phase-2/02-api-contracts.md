# API contracts

## Contract coverage

The runtime inventory contains 136 `/api/*` entries. `openapi.yaml` includes all registered route paths and methods, including web/admin paths for cross-reference; API operations are tagged `API`. Path parameters are generated only from verified route templates. Request bodies, query fields, response shapes, and status codes are left unspecified when the controller source is branch-specific, uses raw `echo`, or could not establish a stable schema.

This is intentional: an OpenAPI operation requires a response object, so the generated document uses a `default` response description stating that the handler defines the actual result. It does not invent 200/401/422 behavior.

## Verified API contract examples

### `POST /api/login`

- Controller: `AuthController::login`, `app/Http/Controllers/AuthController.php:61`.
- Middleware: API/CORS route group; the controller constructor excludes `login` from its `auth:api` middleware.
- Inputs verified: `email`, `password`; both are required by inline `Validator::make`.
- Success: `respondWithToken()` JSON structure, including bearer token fields and user/package-derived flags; exact nested fields are in the method body.
- Validation failure: validator messages returned with HTTP 200.
- Invalid credentials: `{"error": ...}` with HTTP 401.

### `POST /api/signup`

- Controller: `AuthController::signup`, plus `SignUpRequest`.
- FormRequest rules: `first_name|required`, `email|required|email|unique:imagefootage_users|max:255`, `mobile|required|unique:imagefootage_users`, `password|required`.
- `SignUpRequest::failedValidation` returns errors with HTTP 422.
- Controller additionally checks `first_name` and `mobile`, saves a user with status `0`, creates an email verification token/expiry, sends `createusermail`, and returns status/message JSON with HTTP 200. Duplicate email returns status/message with HTTP 200.

### `POST /api/search`

- Controller: `SearchController::index(SearchRequest)`.
- FormRequest rule: `productType|required`.
- Recognized request fields in source: `search`, `sort`, `productType`, `limit` (default 25), `pagenumber` (converted to zero-based), `category_id`, `adult_content_filter`, `duration`, `resolution`, `artist_name`.
- Calls `Pond5\ImageApi::search`, transforms provider results, records a trending word for non-empty searches, and returns JSON with provider-derived product arrays and pagination values.

### `POST /api/payment`

The handler uses nested request structures such as `type`, `tokenData.Utype`, `cartval[0]`, `usrData.*`, optional discount fields, and optional currency. It creates `Orders` and `OrderItem` records before gateway branching. Atom returns a generated gateway URL, PayU returns `/payu/{transactionId}`, and Razorpay creates a gateway order and returns checkout data. The source does not provide a single typed request schema.

### Download endpoints

`download`, `multi-download`, `re-download`, `downloadProxy`, and `downloadindi` are JWT-protected by their route group. Their inputs and response variants are controller-specific; detailed verified branches are in [09](09-download-authorization-and-delivery.md).

## Authentication/error variants

`JwtMiddleware` can return 401 for invalid, expired, missing, Google, or Facebook tokens. Some controllers return validation errors with HTTP 200, some with 400/422, and many legacy handlers use raw `echo json_encode`. Consumers must therefore use endpoint-specific behavior rather than assuming a uniform Laravel API error contract.
