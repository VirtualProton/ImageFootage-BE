# Admin operation flows

## Authorization chain

Admin routes are grouped under `/admin`, use the `admin` session guard middleware, and most operations add `check.permission`. `CheckPermission` resolves module/action from explicit middleware parameters or URL/method, lets the super-admin role bypass, and returns JSON 403 for AJAX/JSON requests or redirects with an error for browser requests.

## Modules

- Products and attributes: product CRUD, categories, subcategories, colors, genders, ethnicities, locations, sizes, image types/people/orientations/sort types, bulk upload.
- Customers/contributors: user/admin contributor CRUD, statuses, OTP/password flows, cart/order views.
- Commerce: orders, quotations, invoices, purchase orders, subscriptions, plans, promo codes, promotions, prices, discount messages.
- Content: editorials, static pages, modules, settings, subscribers.
- Maintenance: product API, provider imports, log viewer and utility routes.

The controller matrix and runtime route CSV cross-reference every admin action. Admin controllers frequently access models/query builders directly and render Blade views or echo/return JSON.

## State-changing GET routes

The route source includes GET actions named `delete*`, `status`, `change*`, `package/{status}/{id}`, and similar admin mutations. These are documented as registered behavior; no change was made.

## Customer-facing effects

Admin product/invoice/package/promotion changes affect the same Eloquent tables used by customer APIs. Invoice controllers additionally generate PDFs/emails and update order/quotation state. Exact side effects are controller-specific and listed in `controller-dependency-matrix.csv`.
