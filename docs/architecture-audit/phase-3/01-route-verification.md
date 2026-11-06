# Route verification

## Reconciliation

The current checkout still reports 426 registered route entries. Phase 2’s static matcher resolves 408 controller methods, marks 13 entries as unresolved/external/resource-method gaps, and marks 5 as closures.

### Previously unresolved entries

- `IiFgd1SKbZ` → package `Rap2hpoutre\LaravelLogViewer\LogViewerController@index`; the package implementation is outside application controller source. The route is registered from `routes/web.php:15` using `RANDOM_PATH_FOR_LOGS`.
- `admin/editorials/{editorial}` and `admin/price/{price}` are resource `show` entries. The resource registration is executable, but no explicit `show` method was found in the application controller files. Exact inherited/resource response requires runtime/framework resolution.
- `admin/viewcontributor/{id}` points to `ContributorController@viewcontributor`; no method with that name was found in the controller file. This is an unresolved application handler reference.
- Web `login`, `logout`, password reset, and `register` routes are provided by `Auth::routes()` and Laravel traits. `LoginController` uses `AuthenticatesUsers`, `RegisterController` uses `RegistersUsers`, `ForgotPasswordController` uses `SendsPasswordResetEmails`, and `ResetPasswordController` uses `ResetsPasswords`. The methods are inherited rather than absent.
- Five closures are executable inline handlers: `/api/debug/logs` in `routes/api.php:21`, and the four preview routes in `routes/web.php` inside the local/debug block. Phase 2’s route source marker was generic for closures; this document corrects it with direct source locations.

## Closure behavior

`/api/debug/logs` permits access when the environment is local or debug is enabled; otherwise it requires `LOG_VIEW_API_TOKEN` matched against `X-Log-Token` or `token`, returning JSON 403 when denied. The four preview closures build sample or database-backed quotation data, render invoice/quotation views, and in debug/local contexts can render Dompdf output.

## OpenAPI reconciliation

The Phase 2 OpenAPI document has 403 unique path templates and 666 method operations because Laravel’s `GET|HEAD` entries expand to two OpenAPI operations. Duplicate Laravel registrations cannot be represented as duplicate OpenAPI operations, so the generated operation retains all source entries in `x-route-entries`. `openapi.yaml` contains 666 method operations and does not introduce methods absent from the route list.

No live HTTP call was made to any route.
