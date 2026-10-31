# Synthetic fixtures and boundaries

Phase 2.2 adds actual engine-backed customer/admin/location/product/quotation fixtures (`BusinessFixtures`), a real Swift array transport with send-time attachment materialization, and explicit cloud SDK construction/upload sinks. Historical migration-based test schema and the Mongo fixture timestamp correction are documented in the [real integration report](16_REAL_DATABASE_INTEGRATION_REPORT.md). These replace no production behavior. Cloud delivery remains fake; actual SQL/Mongo, HMAC/controller/fulfillment, Dompdf and MIME attachment construction execute.

All data is invented. Emails use `example.invalid`, URLs use `phase2.invalid`, IDs use the 700001 range, and signing keys contain explicit `phase2` markers. No Phase 1 customer PDF/SQL dump, real merchant secret, APP_KEY, JWT secret, token or customer record is used.

| Fixture/helper | Purpose and limitation |
| --- | --- |
| `tests/Support/Fixtures.php` | Synthetic payment-link callback HMAC, fixed Common keys, reflective access to existing private helper boundaries, two-decimal formatting |
| `tests/Fixtures/invoice.html` | Synthetic quotation/invoice HTML, table, numeric totals, explicit second page and dummy payment URL; not an approved business template/reference PDF |
| Inline GD image in PDF/image tests | Tiny generated raster; exercises actual embedding/resize with no external files or artist assets |
| `ReadFixtureConnection` | Exact synthetic SELECT boundary for Eloquent authentication paths; real guards/bcrypt/JWT run, but SQL correctness is not established |
| `ObservedConnection` | Captures actual generated SELECT/UPDATE SQL/bindings for quotation status and expiry delegation; no PDO access or transaction emulation |
| `CallbackStore` | One synthetic invoice plus recorded controller updates; Phase 2.1 adds equality-predicate/SELECT-projection fidelity and no-match writes. No SQL engine/locking/concurrency semantics are modeled |
| `GatewayTransport` | Ordered SDK request expectations and synthetic HTTP responses; actual Razorpay SDK and signature verifier run without networking |
| `MySqlTestCase` | Real SQL tests against pre-existing empty baseline schema; transactional fixture writes and rollback, no migrations |
| `MongoTestCase` | Real document tests in precreated empty collection; deterministic ObjectIds and cleanup restricted to inserted IDs |

Carbon time is `2026-10-29 12:00:00 UTC` at each test start. `Common` changes the process timezone to Kolkata; the date-only payment expiry example explicitly expects the corresponding UTC instant. Native `date()`/`time()` metadata is not frozen and is not compared byte-for-byte. JWT jtis/signatures and PDF metadata need not be identical across runs; claim relationships, content, statuses and monetary strings must be repeatable.

Synthetic arithmetic examples: subtotal 100.00 less discount 10.00 gives 90.00 taxable base, GST 16.20 and payable 106.20 at the fixture's 18% rate; 0.05 plus rounded GST 0.01 gives 0.06. Flat/percentage discounts are bounded to subtotal in the tested helper. These examples test arithmetic, not legal tax applicability. Approved rate/currency/quantity examples remain PENDING ACCEPTANCE.

`User` has same-named country/state/city relations. An unpersisted fixture with absent attributes recursively resolved those relations during test development; the corrected address-validation fixture explicitly supplies null schema attributes. No model method was changed. Dompdf output is checked through decompressed content streams, page count, link/image structure and PDF header rather than variable bytes. Approved screenshot/font/layout references are still blocked.

Do not treat test doubles as standalone simulators of correct business persistence. The traceability matrix marks the layer and outstanding real fixture for each flow.
