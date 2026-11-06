# Authentication, authorization, and security

## Authentication

`config/auth.php` defines session guards for `web` and `admins`, and a JWT `api` guard backed by `App\Models\User`. `JwtMiddleware` parses normal JWTs and has Google/Facebook validation branches. Password reset uses Laravel’s `password_resets` table and web/API controllers. Password fields are excluded from exception flashing in `Handler`.

## Authorization

Admin requests use `Admin` session middleware plus `CheckPermission`. Super-admin role ID bypasses checks; other roles resolve modules/actions from route metadata and `PermissionHelper`. Blade has a matching `@canPermission` directive. API authorization is route-by-route via `jwt.verify` or `auth:api`, not globally applied.

## Security controls and findings

- CORS is configured through `config/cors.php` and a custom middleware.
- Web routes receive Laravel web middleware, including CSRF behavior where applicable; API routes use API middleware.
- File/download authorization is implemented in media controllers and download models; signed URL coverage is not established.
- Credentials are environment-backed in the sample, but `config/database.php` contains fallback database credentials. **Severity: High if deployed without overrides; Verified source finding.**
- Public GET routes perform state changes in admin areas. **Severity: Medium; Verified from route definitions.**
- Provider/import/cron endpoints are route-visible without an explicit admin/JWT middleware in the route list. **Severity: High pending deployment controls; Verified route exposure, runtime access control unknown.**
- JWT/social token handling contains multiple parsing paths and external token validation. **Severity: Medium review item; Verified implementation, exploitability unknown.**
- The log viewer provider is registered. **Severity: Medium pending route protection/configuration; Verified provider registration and route presence.**

No exploitation or security modification was performed.
