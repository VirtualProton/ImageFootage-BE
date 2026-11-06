# Third-party integrations

| Provider | Purpose | Evidence |
|---|---|---|
| Panther Media | Image/media search and URL/import operations | `app/Http/PantherMedia/*`, `config/thirdparty.php`, helper/functions, jobs/routes |
| Pond5 | Footage, image, and music search/import | `app/Http/Pond5/*`, `config/thirdparty.php`, jobs/routes |
| Razorpay | Payment gateway | `PaymentController`, Razorpay SDK, routes |
| PayU Money | Payment gateway | `PaymentController`, PayU config/package, routes |
| AtomPay | Payment gateway/custom protocol | `app/Http/AtomPay/*`, payment routes/config |
| Elasticsearch | Search/indexing | Elasticsearch provider/controller/config |
| Msg91 | SMS and OTP | `SmsService`, `Msg91SmsProvider`, `config/services.php` |
| Google | Social token verification/API client | `JwtMiddleware`, Google client config |
| Facebook | Social token verification | `JwtMiddleware`, Facebook endpoint config |
| AWS | SDK/storage support | AWS provider/config; actual active disk depends on environment |
| SMTP/Mailgun/SES-compatible mail | Email | Laravel mail config and `app/Mail`, queued email jobs |

Visible non-sensitive base URLs and environment-variable names are captured in `external-integrations.csv`. API keys, secrets, passwords, and local `.env` values are intentionally excluded. Provider timeouts, retry policies, webhook signatures, and provider-side configuration are only documented where direct source evidence exists; otherwise they are marked unknown.
