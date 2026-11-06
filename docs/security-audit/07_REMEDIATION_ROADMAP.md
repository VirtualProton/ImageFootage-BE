# Security Remediation Roadmap

This roadmap is prioritization guidance from the audit. It does not authorize implementation in this audit task.

## P0 - contain before release

1. Verify and patch every internet-reachable PHP runtime to a supported fixed release; preserve runtime and access-log evidence.
2. Revoke and rotate all repository credential-like material through the owning providers; review access logs and remove the artifacts from all release inputs.
3. Remove/deny `public/dbc.php` and confirm the deployed image cannot execute unapproved public PHP files.
4. Disable the plaintext password-reset path until password hashing and reset-token controls are verified.
5. Freeze payment release until server-side amount/ownership checks and callback idempotency fixtures pass.

## P1 - authorization and exposure

1. Build a route authorization matrix for users, admins, cron, product mutations, downloads, and payment callbacks.
2. Enforce authenticated-subject ownership rather than request `id`, `user_id`, `Utype`, or token payload fields.
3. Protect ingestion/cron routes with non-user authentication, replay protection, and bounded work.
4. Apply upload content/size/extension validation and generated storage keys; isolate public delivery.
5. Constrain outbound network access for media/PDF processing and add request/asset limits.

## P2 - platform and assurance

1. Run supported Composer and npm audits in CI with lockfile review and SBOM generation.
2. Replace EOL Node/build tooling and pin image digests.
3. Verify HTTPS, HSTS, CSP, framing, content-type, cookie, and cache headers at the deployed edge.
4. Add negative authorization, payment tampering, callback replay, upload, SSRF, rate-limit, and secret-scanning tests.
5. Establish patch SLAs, incident-response ownership, and a production evidence bundle.
