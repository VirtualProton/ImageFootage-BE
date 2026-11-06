# Cart and order integrity

## Cart ownership and pricing

`addtocart` decodes a client-supplied token and uses its `Utype` as the cart owner. It checks prior download history, prevents some duplicate cart entries, and stores client-supplied product metadata/prices in `Usercart`. `userCartList` filters by submitted `Utype`; `deleteCartItem` deletes by submitted cart ID without an observable owner predicate. `editCartDetails` is controller-specific and was not normalized into a shared service.

## Checkout

`PaymentController::payment` reads cart data through the user relationship, but monetary values come from request/cart fields. It creates an order and order items before gateway initiation. Cart deletion occurs in successful callback branches, not at initial checkout.

## Packages

`paymentPlan` checks for an active same-type package with remaining products, then creates a `UserPackage` record containing plan fields. The individual product checkout path does not consume package credits; package/download logic is separate. This is verified from current methods, not inferred from package names.

## Order details/history

`orderDetails`, `purchaseHistory`, `downloadHistory`, user order routes, and admin order/invoice routes read related order/package/download models. The exact response shape varies and can include raw arrays/JSON. No concurrency lock is visible around cart edits, order creation, or callback cart deletion.

## Integrity classifications

- Verified protection: duplicate checks in some cart branches; active package check in `paymentPlan`.
- Verified concern: request-derived user IDs and cart IDs are used in protected operations; cart deletion lacks a visible ownership predicate.
- Verified concern: order/items and gateway initiation are not wrapped in an explicit transaction.
- Unknown: database unique constraints, isolation level, and concurrent request outcomes in the live database.
