# External integrations verification

## Credential and transport handling

Credentials are generally read through `config()`/environment-backed configuration. Payment SDKs use configured keys; Google/Facebook use configured client identifiers/secrets; Msg91 uses configured auth/template values; Panther/Pond5 use `config/thirdparty.php`; Elasticsearch uses `ELASTICSEARCH_HOSTS`.

## Verified integration behavior

- Razorpay signature verification is called in `razor_response` and `razor_plan_response` branches.
- PayU checksum validation is called in `payUResponse`.
- Atom response hash validation is called in `atomPayResponse` and related callbacks.
- Google ID token verification uses `Google_Client::verifyIdToken`.
- Facebook validation uses Guzzle requests to app/user token endpoints in `JwtMiddleware`.
- Msg91 provider uses cURL and returns success/error arrays consumed by auth flows.
- Provider media wrappers are called synchronously in search and from `FetchThirdPartyData` jobs.

## Failure/partial completion

Payment and registration flows can write local state before external calls or send mail. Provider failure handling is branch-specific; no universal retry, timeout, circuit-breaker, or outbox abstraction was found. `downloadProxy` is separately documented for TLS/SSRF/resource issues.

## Unknowns

Provider dashboard signing configuration, production CA bundles, gateway webhook settings, timeout values outside visible call sites, rate limits, and reconciliation processes cannot be verified from the repository. No live provider call was made.
