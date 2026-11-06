# Authentication and authorization verification

## Customer identity

`config/auth.php` uses a JWT `api` guard backed by `App\Models\User`; web uses a session guard. `AuthController` also applies `auth:api` in its constructor except for public auth actions. `JwtMiddleware` validates normal JWTs, Google ID tokens, or Facebook access tokens based on `Login-Type`, returning JSON 401 for missing, invalid, or expired tokens.

## Verified protections

- `signup` uses `SignUpRequest` and unique email/mobile rules; passwords use `Hash::make`.
- `signupV2` accepts email or 10–15 digit phone-shaped input, stores inactive status, and uses email/SMS verification branches.
- Google social login verifies the ID token, checks Google email verification, and rejects inactive existing accounts.
- Admin routes use `Admin` session validation and `CheckPermission`; super-admin role ID bypass is explicit; other roles resolve module/action permissions.
- `SignUpRequest` returns 422 on FormRequest validation failure; other auth endpoints have inconsistent status codes documented in Phase 2.

## Ownership and identity risks

Several protected methods consume IDs from request payloads or decoded `tokenData` rather than deriving identity only from the authenticated guard. Examples include `FrontuserController::userCartList`, `deleteCartItem`, `MediaController::reDownload`, `multipleDownload`, and `UserController::deleteUserAccount`. The source contains lookups, but ownership consistency is method-specific and not centralized.

`deleteCartItem` finds a cart record by submitted cart ID without an observable `cart_added_by` ownership predicate (`FrontuserController.php:266-279`). `reDownload` queries download history using submitted `user_id`, `id_media`, and `type` (`MediaController.php:628-635`). These are **verified source concerns requiring authorization review**, not exploit tests.

## Inactive/disabled accounts

Social login checks `status == 0`; JWT guard/provider behavior for inactive users is not visibly overridden in `User` or middleware. Normal login uses `auth()->attempt` and does not show an explicit status predicate in `AuthController::login`.

## Tests

No unauthenticated or ownership attack tests were run. Production/live routes were not invoked.
