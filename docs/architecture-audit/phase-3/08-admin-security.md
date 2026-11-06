# Admin security verification

## Controls

Admin login/authentication routes are outside the protected admin group. Authenticated admin routes use `admin` session middleware and `check.permission`. `CheckPermission` supports super-admin bypass, module/action resolution, JSON 403 for AJAX/JSON requests, and browser redirects for denied requests.

## Verified concerns

- Many state-changing operations are registered as GET routes, including deletion/status/change operations. They still sit within web middleware and the admin permission group, but the method choice increases accidental/CSRF review surface.
- The route inventory exposes provider/import/maintenance endpoints under API/CORS groups without visible admin or JWT middleware in the route definition. Deployment-level protection is unknown.
- The log-viewer route uses a randomized/configured path and the package controller. `/api/debug/logs` has explicit local/debug/token logic; production reachability depends on environment/configuration.
- Bulk product upload and file-handling code is permissioned through admin routes; exact MIME/size validation is controller-specific.
- Permission resolution allows access when no module ID can be inferred (`CheckPermission`), which is a verified fallback branch requiring route coverage review.

No admin endpoint was invoked. No session or CSRF bypass was tested.
