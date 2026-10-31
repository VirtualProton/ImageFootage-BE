# Payment callbacks, signatures and replay

Phase 2.2 adds actual MySQL persistence/Common/PDF/mail to payment-link callbacks. Valid conversion, sequential replay without new artifact/mail, invalid-signature and expired-quotation cases pass; three financial mismatch and one downgrade invariant fail with real persistence. A separate two-connection SQL lock test passes, but concurrent callback exactly-once effects remain unproven. No live payment call occurs. See [current report](16_REAL_DATABASE_INTEGRATION_REPORT.md); original findings and approval limits remain.

Phase 2.1 refines the evidence with real routed callbacks, an unconverted quotation, a stricter DB boundary fixture, matching/invalid/unknown-reference controls and consistently signed nonpaid responses. See the [canonical investigation and proposals](15_CRITICAL_DEFECT_VERIFICATION.md). Missing financial binding/non-monotonic updates are verified code gaps; forged provider responses, backward provider states and concurrent duplicate effects are not established. No payment business logic was changed.

Tests: `tests/Feature/PaymentRegressionTest.php`, `tests/Unit/PaymentLinkRegressionTest.php`, `AtomSignatureTest.php`, `tests/KnownFailures/PaymentInvariantTest.php`.

Razorpay SDK and HMAC verification execute locally with synthetic credentials; `GatewayTransport` replaces the SDK Requests transport before calls occur. Expectations specify method/path and ordered response, and unexpected operations cannot open a socket. No charges, live link creation, merchant queries, webhook delivery or customer data are used.

PASS characterization includes:

- Rupee-to-paise conversion, currency, callback URL, notification flags, normalized link metadata, nonpositive amount early return and bounded/invalid expiry.
- `PaymentController::razorpayInvoiceResponse`: real synthetic signature verification, missing link/signature/tampered reference rejection before fetch/write, paid/pending/partial/expired/cancelled/unknown provider status mappings and signin redirect.
- Late already-cancelled quotation remaining cancelled, already-converted sequential replay avoiding invoice-creator delegation, unconverted payment delegating to existing creator, provider 500 leaving state unchanged and a later retry accepting a paid response.
- Atom SHA-512 response signature primitive accepts a correctly signed synthetic payload and rejects amount tampering. This is not end-to-end Atom order fulfillment coverage.

FAIL invariants remain unsuppressed: fetched paid amount/currency/reference are not compared with the local invoice (three cases, LEGACY-PAY-01); a pending provider response can downgrade already-paid local state (LEGACY-PAY-02). These are reproducible controller-boundary defects. They do not establish actual merchant/provider attack prerequisites or live exposure.

`CallbackStore` does not model where clauses, locks, transactions or concurrent writes. The sequential replay test checks the already-converted branch only; it explicitly observes repeated status updates. It does not prove one payment record, one invoice, one notification or one fulfillment under a real repeated/concurrent callback. Those invariants require real persistence/two-process fixtures and remain BLOCKED.

Legacy `razor_response`/`razor_plan_response`, PayU callback fulfillment, Atom fulfillment, missing-record persistence behavior and concurrent callbacks have named blockers. PayU vendor-approved synthetic merchant/hash/order fixtures and active Atom confirmation were not available. No wrapper behavior or provider correctness was invented. Use the named gates in `UnavailableFlowsTest` and the traceability matrix; do not remove runner restrictions or substitute a live gateway to clear them.
