# Database consistency and concurrency

## Verified transaction boundary

`UserController::deleteUserAccount` starts a transaction, deletes related packages/downloads/orders/invoices/cart/subscriptions/payments/wishlist rows, deletes the user, commits, and rolls back on inner exception (`UserController.php:860-892`). The outer catch returns an HTTP 200 JSON error for exceptions.

## Unwrapped multi-record operations

- Registration saves user, updates verification fields, then sends email/SMS.
- Checkout saves order and each order item, then initiates a gateway.
- Payment callbacks update order, generate invoice/email side effects, and delete cart.
- Multiple download inserts history and increments package counters.
- Carry-forward command updates package/balance records according to command logic.

No explicit `FOR UPDATE`, `lockForUpdate`, atomic conditional counter update with an entitlement predicate, or general idempotency table was found in the inspected critical paths. Absence of a marker is classified as source evidence requiring runtime/database verification, not automatic proof of incorrectness.

## Concurrency concerns requiring verification

Two simultaneous download requests may both observe remaining package capacity before incrementing. Two callbacks may both generate invoice/email side effects. Two cart requests may pass duplicate checks before either insert. Live unique indexes, isolation level, and deployment retry behavior are unknown.

## Database evidence

The Phase 2 `database-read-write-matrix.csv` identifies 113 migration-observed entities and related files. Phase 3 does not alter or introspect a live database.
