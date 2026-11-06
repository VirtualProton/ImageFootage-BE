# Test Coverage and Gaps

## Existing evidence

The baseline contains four original test files and no visible events/listeners. Static review covered routes, controllers, models, middleware, jobs, configuration, Docker, Composer/npm metadata, and selected sinks. No live or production test was run.

## Material gaps

- No demonstrated two-user object-authorization matrix for profile, plans, addresses, downloads, or orders.
- No payment tampering, duplicate callback, stale callback, concurrent callback, or order-finalization fixture.
- No reset-password storage assertion or `/api/me` serialization assertion.
- No anonymous/low-privilege tests for cron and product mutation routes.
- No upload polyglot, wrong MIME, oversized file, archive-bomb, or filename traversal tests.
- No SSRF/non-routable URL, DNS rebinding, PDF asset, or outbound egress test.
- No OTP brute-force, enumeration, retry, expiry, or replay tests.
- No deployed header/TLS/CORS/proxy validation.
- Composer audit is blocked by the available Composer version; npm audit output exists but has not been triaged to reachable production code.

## Safe test contract

Use a disposable database, synthetic users, fake payment signatures/providers, local object storage, non-routable test destinations, bounded request sizes, and disabled external email/SMS. Do not run exploit payloads against production.
