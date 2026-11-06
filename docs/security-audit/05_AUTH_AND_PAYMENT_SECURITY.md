# Authentication and Payment Security

## Authentication

The baseline has JWT authentication, a separate admin guard, social-token branches, OTP generation, reset-token handling, and a public login/signup surface. JWT secret configuration is environment-driven and blacklist support is enabled by default, which are positive controls. The following remain material risks:

1. `ChangePasswordController::changePassword()` assigns the submitted password directly while the user password mutator is commented out. This is a confirmed plaintext-password storage defect.
2. `/api/me` returns the user model while `$hidden` declarations are commented out. A synthetic response test is required to confirm whether password and remember-token fields serialize, but the source-level exposure is confirmed as a high-risk design defect.
3. OTP values use `rand(1000,9999)`. Endpoint-specific rate limits, retry counters, expiry, enumeration resistance, and delivery binding were not proven.
4. Admin status and role enforcement are split across middleware/controller code. A disabled-admin negative test and route permission matrix are required.

## Payment

`POST /api/payment` is JWT-protected but accepts client-derived cart, discount, tax, billing, and user-token fields. Authentication does not make those values trustworthy. The server must derive payable amount, discount eligibility, tax, purchaser, and order ownership from authoritative records.

The Razorpay invoice callback verifies the provider signature, which is a verified positive control at source level. However, the visible path updates invoice state after fetching provider status without an obvious idempotency key, state monotonicity rule, transaction boundary, or row lock. Duplicate, stale, reordered, and concurrent synthetic callbacks are required before release.

## Required isolated fixtures

- User A attempts User B's profile, plan, address, and media download identifiers.
- Authenticated user submits a reduced or negative cart total and a different purchaser identifier.
- Duplicate successful callbacks, stale failure after success, and concurrent callbacks for one invoice.
- Expired/replayed reset token and repeated OTP attempts.
- Disabled admin, low-privilege admin, and missing-module permission cases.

No live payment provider or customer account was contacted.
