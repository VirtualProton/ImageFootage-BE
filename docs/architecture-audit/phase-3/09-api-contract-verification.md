# API contract verification

Phase 2’s `openapi.yaml` is preserved. `openapi-verified.yaml` is the Phase 3 corrected evidence-preserving copy: it includes route/method/path parameters and explicitly annotates unknown body/response schemas rather than inventing them.

## Verified contract improvements

- `POST /api/signup`: exact `SignUpRequest` rules and 422 failed-validation behavior are documented.
- `POST /api/login`: required `email`/`password`, 200 validation-message branch, 401 credential failure, and token response path are documented.
- `POST /api/search`: `productType` requirement, default `limit=25`, zero-based page conversion, provider call, trending-word side effect, and response pagination fields are documented.
- `POST /api/payment`: nested input names, tax/discount calculation, gateway branches, and order/item writes are documented.
- Download endpoints: route JWT middleware, package/history inputs, status/message variants, and provider URL branches are documented.

## OpenAPI boundary

The document has 403 unique path templates and 666 operations. `x-route-entries` preserves route-list entries that collapse to the same OpenAPI path/method. The default response description states that exact handler status/schema varies. This is syntactically valid OpenAPI 3.1 but intentionally not a claim of a stable public contract.
