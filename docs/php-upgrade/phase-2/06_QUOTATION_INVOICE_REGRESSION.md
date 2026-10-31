# Quotation, invoice, pricing and tax coverage

Phase 2.2 now executes actual Common quotation create/edit retrieval/replacement/expiry/conversion against synthetic SQL fixtures, including creator/customer/items, CP PDF, real Swift mail attachments and cloud delivery sinks. Existing CP HTML is unchanged. Full HTTP/ownership matrices and approved policy/visual outputs remain pending. See [current business integration evidence](16_REAL_DATABASE_INTEGRATION_REPORT.md); prior blocked lifecycle statements below describe the earlier Phase 2 snapshot.

Implemented tests: `tests/Unit/PricingRegressionTest.php`, `InvoiceDatesRegressionTest.php`, `tests/Feature/QuotationRegressionTest.php`, payment-link tests and the real SQL tests described separately. No changes were made to Common.php, Admin/InvoiceController, invoice models, routes or custom quotation HTML.

PASS coverage at the tested boundary:

- Subtotal source precedence, missing prices/default zero and total-minus-tax clamping. The quantity-ignored example is explicitly observed behavior; intended quantity semantics remain PENDING ACCEPTANCE.
- Flat/percentage discount calculation, negative/oversized discount clamping and cent rounding.
- Explicit GST precedence/applicability flags, zero amounts, discounted taxable base, two-decimal tax/payable arithmetic and paise conversion through the actual SDK payload path.
- Custom quotation date display, package extension date preference and malformed date behavior.
- Existing creation-input/address validation, optional online terms, permitted cheque terms and missing customer field response shape.
- Existing Common status UPDATE compilation/payment-status strings, zero affected rows and cancellation delegation; admin cancellation redirect/flash/gateway reason.
- Template contract: Estimate labels, fixed existing CP company name, dynamic contact placeholder and tax-row slot.

These are helper/controller/delegation contracts. Full quotation creation, editing, replacement, customer/creator joins, sequential numbering, actual persistence, promotion usage, quotation-to-invoice artifact generation and attachments require a schema-matched isolated SQL fixture and approved synthetic business examples. Those paths are explicitly BLOCKED; their tests are not claimed to be implemented merely because a private helper was invoked. No real payment link is generated: requests are fulfilled by the in-memory SDK transport.

Expected amounts are two-decimal strings from specified synthetic examples. No floating epsilon, copied live invoice amount, assumed conversion rate or invented legal GST rule is used. Native wall-clock payment dates are asserted only as existing fields/structure, not falsely described as frozen. Currency conversion, invalid item quantity policy, optional tax-row assembly in the full Common workflow and complete output acceptance remain PENDING ACCEPTANCE/BLOCKED.

The existing CP changes, including fixed address and creator/client selection code, remain byte-unchanged. Visual brand/layout approval is not supplied. See [PDF/email coverage](08_PDF_EMAIL_REGRESSION.md) and [traceability](11_TEST_TRACEABILITY_MATRIX.md).
