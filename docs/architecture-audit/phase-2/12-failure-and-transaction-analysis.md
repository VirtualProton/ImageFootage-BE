# Failure and transaction analysis

## Verified protection

- User account deletion wraps related deletes in `DB::beginTransaction`/`commit` and rolls back on exception (`UserController.php:866-880`).
- Atom validates response hash before successful order updates.
- PayU checks checksum and success before successful order updates.
- Razorpay calls `verifyPaymentSignature` and branches on verification failure.
- `SignUpRequest` converts validation failure to HTTP 422 JSON.

## Verified non-atomic sequences

- Individual payment creates order/items before external gateway initiation. If gateway creation fails, the source does not show a compensating delete.
- Payment callbacks update order state, generate invoice/email effects, and delete cart in separate operations without an enclosing transaction marker.
- Multiple download writes history and increments package counters in separate operations without an enclosing transaction marker.
- Registration saves a user, then updates verification data, then sends email/SMS; provider failure can leave an inactive user with partial verification state.

These are execution facts, not automatic vulnerability classifications. Database constraints, retries, and deployed queue behavior can affect outcomes.

## Idempotency/concurrency

No explicit payment callback idempotency key, row lock, or duplicate callback guard was identified in the inspected payment methods. `updateOrInsert` appears in re-download handling. Monthly/package counts are read and later updated in separate statements in download flows. Repeated-request outcomes therefore require live database/concurrency verification.

## Failure classes

| Classification | Examples |
|---|---|
| Verified protection | User deletion rollback; gateway signature/checksum/hash branches |
| Verified missing protection marker | No transaction marker around order+gateway and download multi-write sequences |
| Potential concern requiring review | Duplicate callback effects; remote proxy SSL verification disabled; provider failures after local writes |
| Unknown | Live DB constraints, worker retries, gateway dashboard idempotency/reconciliation |
