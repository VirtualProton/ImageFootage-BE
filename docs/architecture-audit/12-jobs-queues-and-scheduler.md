# Jobs, queues, and scheduler

## Jobs

| Job | Purpose | Trigger/evidence |
|---|---|---|
| `FetchThirdPartyData` | Fetch Panther/Pond5 media and persist product data | Dispatchable job; provider calls and product saves in `handle` |
| `SendEmail` | Send order email through `EmailForQueuing` | Implements `ShouldQueue` |
| `SendPlanEmail` | Send package/plan email through `EmailForPlanQueuing` | Implements `ShouldQueue` |

`config/queue.php` supports sync, database, Beanstalkd, SQS, and Redis-style connections; `.env-sample` defaults to `QUEUE_CONNECTION=sync`. `jobs` and `failed_jobs` migrations exist. Therefore queued behavior is deployment-dependent; a sync default executes job work inline.

## Scheduled commands

Active in `app/Console/Kernel.php`:

- `quotation:deactive` hourly (`QuotationDeactive`)
- `package:to-credit-balance` daily (`CreateEntryForCarryForwardBalance`)

Registered but commented from the schedule: `hour:update`, `currency:update`, and `regenerate:image`. `scheduled-jobs.csv` records these states. Retry, timeout, worker count, cron invocation, and failed-job operations are not established by repository configuration alone.
