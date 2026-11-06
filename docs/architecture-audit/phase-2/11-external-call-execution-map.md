# External call execution map

## Inventory

`external-call-inventory.csv` contains 796 static markers across application and route source files. Repeated markers are retained because the same provider may be called in multiple branches.

## Provider groups

| Group | Source evidence | Execution mode |
|---|---|---|
| Panther/Pond5 | `app/Http/PantherMedia/*`, `app/Http/Pond5/*`, `SearchController`, `FetchThirdPartyData` | Synchronous search in request paths; queued provider ingestion in job paths |
| Payments | `PaymentController`, SDK/custom Atom classes | Synchronous initiation/callback processing |
| Elasticsearch | `ElasticsearchServiceProvider`, `ElasticSearchController` | Synchronous client calls |
| SMS | `SmsService`, `Msg91SmsProvider`, auth/user controllers | Synchronous cURL/provider calls |
| Email | controllers, `Common`, jobs/mailables | Synchronous in many controllers; `ShouldQueue` jobs exist |
| Storage/media/PDF | `Storage`, Intervention, FFmpeg, Dompdf, AWS references | Handler-dependent; Docker supplies FFmpeg/GD/Chromium |

## Timeouts/retries

The call-site inventory records inline timeout/retry markers when visible. A universal retry/timeout abstraction was not found. Provider-side limits and deployed HTTP client settings are unknown. Several external calls occur before or between database writes, notably payment initiation/callback invoice/email branches and provider-backed search.

## Side effects

External calls can be coupled with user creation, order/package state, invoice generation, cart deletion, download-history writes, or trending-word writes. The source does not establish an outbox or compensating transaction mechanism.
