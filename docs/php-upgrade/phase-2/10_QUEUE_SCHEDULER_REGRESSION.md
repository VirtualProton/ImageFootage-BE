# Queues and scheduled business behavior

Phase 2.2 executes real MySQL quotation expiry/cancellation/repeat, actual carry-forward synthetic remainder/year-expiry/sequential duplicate behavior, DatabaseQueue reservation/release/retry/fixture handle/ack, and failed-job persistence. No live worker runs. Full application worker orchestration, concurrent credit/notification effects and business-approved calendar policy remain pending. See [current report](16_REAL_DATABASE_INTEGRATION_REPORT.md). Earlier registration-only limitations below remain historical where superseded.

Tests: `tests/Feature/QueueSchedulerRegressionTest.php`, mail failure/recipient tests in PdfEmailRegressionTest, package/expiry date tests in InvoiceDatesRegressionTest, and blocked integration gates.

PASS tests dispatch FetchThirdPartyData, SendEmail and SendPlanEmail through QueueFake and assert job classes/payloads. No job worker or third-party fetch is started. Mail jobs are tested separately with MailFake. A thrown synthetic mail failure is propagated, but persistent retry counts, queue statuses, failed-job records and duplicate worker delivery are not certified.

The actual application Schedule registration is inspected without running it: `quotation:deactive` hourly (`0 * * * *`), `package:to-credit-balance` daily (`0 0 * * *`), two active scheduled entries. This is test-environment registration only, not proof of a configured production cron/scheduler. Phase 1 operational tasks remain deferred.

QuotationDeactive::handle is invoked only with a synthetic SQL observer and mocked Common gateway-cancellation boundary. Tests verify the <= deadline/status/proforma selection SQL, the cancellation reason, status-3 UPDATE bindings, no eligible rows/no writes and two controlled Carbon times one second apart. ObservedConnection does not execute SQL filtering: it supplies a named eligible row. Actual MySQL deadline/eligibility and duplicate/concurrent expiry persistence still require integration fixtures.

Package extended/base expiry resolution is characterized with valid/missing/invalid dates. Carry-forward credit calculation, duplicate processing, yearly/month-end/timezone policy, media fetch job persistence/failure and backend retry delivery remain BLOCKED/PENDING ACCEPTANCE. No live expiry/balance/media command was invoked against data, and no cron-like GET routes were crawled.

Do not infer exactly-once job processing or production timezone correctness from these passing registration/delegation tests. Required fixtures and acceptance gates are listed in the traceability matrix.
