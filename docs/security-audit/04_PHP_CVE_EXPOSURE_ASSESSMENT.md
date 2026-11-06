# PHP CVE Exposure Assessment

## Scope

The baseline declares PHP `^7.4.33` in `composer.json` and uses `php:7.4.33-fpm` in the Dockerfile. PHP 7.4 is outside upstream support. The deployed binary, container digest, vendor backports, and actual web mode are not available from the repository.

## CVE-2026-109618 and CVE-2026-109619

PHP's official security release describes both as critical unauthenticated remote-code-execution issues affecting supported PHP branches before the fixed releases. The official fixed releases are PHP 8.2.35, 8.3.36, 8.4.27, and 8.5.12. GitHub's advisory for the stale-global-state issue lists the same affected ranges and patched versions. AWS describes the issues as allowing unauthenticated code execution, data access available to the PHP process, or denial of service.

The baseline is therefore classified **POTENTIAL VULNERABILITY**, not confirmed runtime exposure: repository intent proves an old image tag, but it does not prove the currently deployed binary or whether a vendor backport exists.

## Related CVE-2026-115560

The requested related identifier must be checked against the authoritative PHP/vendor advisory set before making an exposure claim. This audit does not infer affected versions or exploitability from the identifier alone. It remains **NOT VERIFIED** for this repository until the advisory record and deployed runtime are correlated.

## Safe validation evidence required

- `php -v` and `php -i` from every deployed image/host.
- FPM, mod_php, Caddy/FrankenPHP, LiteSpeed, or CGI mode inventory.
- Image digest and operating-system package provenance.
- Vendor security bulletin showing whether PHP 7.4 received a backport.
- WAF/proxy exposure and request logs, without sending exploit payloads.

## Interim risk reduction

PHP's advisory mentions limiting upload/request memory and disabling session upload progress as temporary risk reduction for specific paths, but these are not complete fixes. PHP patching to a supported fixed branch is the required remediation. Do not treat configuration changes as a substitute for patching.
