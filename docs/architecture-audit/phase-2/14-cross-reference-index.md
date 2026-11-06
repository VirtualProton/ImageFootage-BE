# Cross-reference index

## Route → controller → source

Use `route-execution-inventory.csv` as the complete index. Its `Controller`, `Method`, `Handler resolution`, and `Evidence` columns link every runtime route to a handler or explicitly mark closure/unresolved status.

## Controller → routes/models

Use `controller-dependency-matrix.csv` for all 60 controller files. `Route associations` lists every registered route action matched to the controller; `Models referenced`, `External integrations`, and `Jobs/events` provide static call markers.

## Model → table/callers

Use `model-usage-matrix.csv` for all 65 model files. It records explicit `$table`, `$connection`, primary-key evidence, methods/relationships, and source files that mention the model class.

## Table → reads/writes

Use `database-read-write-matrix.csv` for migration-observed entities. It links table names to model mappings, source files with query/write markers, transaction markers, and confidence.

## Workflow pointers

| Concern | Primary source | Phase 2 document |
|---|---|---|
| Auth | `AuthController`, `JwtMiddleware`, `Admin`, `CheckPermission` | 05 |
| Search | `SearchController`, `ElasticSearchController`, provider wrappers | 06 |
| Commerce | `FrontuserController`, `PaymentController`, order/package models | 07 |
| Payments | `PaymentController`, Atom classes, PayU/Razorpay packages | 08 |
| Downloads | `MediaController`, download/package models | 09 |
| Admin | `routes/web.php`, `Admin/*Controller`, permission helpers | 10 |
| External calls | app providers/controllers/jobs/mail | 11 |
| Failures/transactions | all critical controller paths; explicit DB markers | 12 |

## Unresolved references

The index intentionally preserves unresolved external package handlers, closures, resource methods not found in the static class map, and dynamic/inherited behavior. These are gaps to verify, not fabricated links.
