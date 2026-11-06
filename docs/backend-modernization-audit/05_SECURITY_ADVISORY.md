# PHP Security Advisory — CVE-2026-109618 and CVE-2026-109619

**Disclosure/release date:** 21 October 2026  
**Audit baseline:** PHP 7.4.33 in `composer.json` and `Dockerfile`  
**Finding status:** source baseline is known affected software; deployed runtime and exploitation status are unknown.

## What was disclosed

PHP published an urgent advisory for two critical vulnerabilities rated CVSS v4.0 9.2:

| CVE | Advisory | High-level cause | Impact |
|---|---|---|---|
| CVE-2026-109618 | GHSA-w8hw-w9fx-j79w | Out-of-memory handling can interrupt PHP while request data is only partially initialized; cleanup may treat invalid data as valid | Potential unauthenticated RCE, memory corruption and denial of service |
| CVE-2026-109619 | GHSA-6wmf-4rv5-p3rp | Request-owned internal state can remain after backing memory is freed and be reused by a later request on the same worker | Confirmed impact includes unauthenticated use-after-free, memory disclosure and RCE with worker privileges |

The PHP advisory says the affected web-serving modes include PHP-FPM, Apache/mod_php, php-cgi, FrankenPHP and LiteSpeed. The precise exploitability depends on worker paths, configuration and request handling; this is not a claim that every Laravel request is exploitable.

## Affected and fixed branches

The GitHub advisory lists versions below the fixed points as affected: `<8.2.35`, `<8.3.36`, `<8.4.27` and `<8.5.12`. PHP 7.4 is outside the current upstream support table. PHP supplied minimal source backports for 7.4, 8.0 and 8.1 for builders without vendor support, and distributions/LTS vendors may publish their own backports. Therefore the exact package build and vendor patch level must be verified before declaring a production host vulnerable.

The complete upstream fix is to update to PHP 8.5.12, 8.4.27, 8.3.36 or 8.2.35. PHP explicitly says configuration changes are not a complete solution.

## ImageFootage relevance

The original repository declares PHP 7.4.33 and packages a PHP 7.4 FPM image. That makes the source/runtime plan a major concern: PHP 7.4 is EOL, and Laravel-level changes cannot repair an engine-level memory-safety flaw. The repository also contains public HTTP routes, file uploads, PDF/media processing, sessions/authentication, S3 and payment callbacks, so runtime exposure assessment is urgent. None of those facts proves compromise.

Distinguish:

- **Known affected software:** PHP 7.4.33 is the documented baseline.
- **Possible application exposure:** a web-facing PHP worker may be reachable, subject to actual deployment and vendor patches.
- **Verified exploitation:** not established; no production logs or hosts were examined.
- **Unknown production status:** actual PHP binary, package provenance, FPM configuration and WAF/proxy controls require owner verification.

## Immediate response

### A. Inventory and exposure assessment

Record `php -v` and package versions on every web, FPM, CLI, queue and scheduler host; identify container image digests, OS backports, web-server mode, public endpoints, worker recycling and `php.ini`/FPM pool settings. Preserve logs before rotation.

### B. Emergency risk reduction

Patch to a fixed supported branch immediately. Until rollout, PHP’s advisory describes controls such as disabling session upload progress before request parsing, reviewing request size/part limits, and using container/cgroup boundaries carefully. These reduce specific paths only; do not treat them as guaranteed protection or use `RLIMIT_AS`/`RLIMIT_DATA` as a substitute.

### C. Priority

Runtime patching is a security priority independent of the Laravel modernization schedule. Test the application against PHP 8.5.12 or another fixed supported branch in a safe environment, then roll out with rollback prepared.

### D. Log and indicator review

Review web/FPM logs for unusual malformed multipart/session requests, worker crashes/restarts, memory exhaustion, unexpected outbound connections, new files, changed application/vendor files, unexplained admin activity, credential use and access to process-readable secrets. Engage incident response if indicators are found; do not infer compromise from vulnerability presence alone.

### E. Long-term modernization

Move off PHP 7.4 and Laravel 5.8 through controlled checkpoints, preserve financial/API behavior, and keep dependency and runtime patching in the normal release process.

## References

- PHP official advisory: https://www.php.net/archive/2026.php#2026-10-21-5
- GHSA-w8hw-w9fx-j79w: https://github.com/php/php-src/security/advisories/GHSA-w8hw-w9fx-j79w
- GHSA-6wmf-4rv5-p3rp: https://github.com/php/php-src/security/advisories/GHSA-6wmf-4rv5-p3rp
- AWS bulletin 2026-143: https://aws.amazon.com/security/security-bulletins/2026-143-aws/
- PHP supported versions: https://www.php.net/supported-versions.php
