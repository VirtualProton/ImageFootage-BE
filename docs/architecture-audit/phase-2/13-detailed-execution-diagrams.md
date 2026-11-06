# Detailed execution diagrams

## Controller/model call path

```mermaid
flowchart TD
  Route --> Middleware
  Middleware --> Controller
  Controller --> Request[Inline/FormRequest validation]
  Controller --> Helper[Helpers/permission/date/formatting]
  Controller --> Model[Eloquent/query builder]
  Model --> DB[(Configured DB)]
  Controller --> Provider[External SDK/cURL/provider]
  Controller --> Job[Dispatchable job]
  Controller --> Response[JSON/view/redirect/echo]
```

## Authentication

```mermaid
flowchart LR
  Login --> Validate --> Guard[JWT/session guard]
  Guard --> Token[JWT or admin session]
  Token --> Middleware[JwtMiddleware/Admin/CheckPermission]
  Middleware --> ProtectedHandler
```

## Search and ingestion

```mermaid
flowchart LR
  SearchRequest --> SearchController --> Pond5[Live Pond5 search]
  SearchController --> TrendingWord
  CronRoute --> FetchThirdPartyData --> Panther[P​​anther/Pond5 APIs]
  FetchThirdPartyData --> Product[(Product records)]
  ElasticRoute --> ElasticController --> Elasticsearch
```

## Commerce/payment/download

```mermaid
flowchart LR
  Cart --> PaymentController
  PaymentController --> Orders
  PaymentController --> Items[Order items]
  PaymentController --> Gateway[Atom/PayU/Razorpay]
  Gateway --> Callback
  Callback --> Invoice[Invoice/mail]
  Callback --> CartDelete[Cart delete]
  Package --> DownloadLimit
  DownloadLimit --> DownloadHistory
  DownloadHistory --> ProviderURL
```

## Admin authorization

```mermaid
flowchart LR
  AdminRoute --> AdminSession
  AdminSession --> Permission[CheckPermission]
  Permission -->|super admin or allowed| AdminController
  Permission -->|denied| JSON403orRedirect
```

Only repository-observed components are shown; production load balancers, workers, and provider dashboards are omitted.
