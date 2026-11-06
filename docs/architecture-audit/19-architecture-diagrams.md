# Architecture diagrams

## Current application

```mermaid
flowchart TB
  Users --> Nginx[Nginx / PHP-FPM or local PHP]
  Nginx --> Laravel[Laravel 5.8 bootstrap]
  Laravel --> Web[Web/admin routes]
  Laravel --> Api[API routes]
  Web --> Controllers
  Api --> Controllers
  Controllers --> Models
  Models --> SQL[(MySQL)]
  Models --> Mongo[(MongoDB model path)]
  Controllers --> Gateways[Atom / PayU / Razorpay]
  Controllers --> Providers[Panther / Pond5 / Msg91 / Google / Facebook]
  Controllers --> Search[Elasticsearch]
  Jobs --> Providers
  Scheduler --> Jobs
```

## Request and identity lifecycle

```mermaid
sequenceDiagram
  Client->>Route: HTTP request
  Route->>Middleware: web/api, CORS, auth/permission
  Middleware->>Controller: authorized request
  Controller->>Model: validate/read/write
  Model-->>Controller: records
  Controller-->>Client: Blade redirect/view or JSON
```

## Commerce/payment/download

```mermaid
flowchart LR
  User --> Cart --> Checkout[PaymentController]
  Checkout --> Gateway[Atom/PayU/Razorpay]
  Gateway --> Callback[Callback route]
  Callback --> Invoice[Orders/invoices/payments]
  Invoice --> Rights[Package/order/download authorization]
  Rights --> Download[MediaController]
```

## Background/deployment

```mermaid
flowchart LR
  Cron[System cron] --> Artisan[artisan schedule:run]
  Artisan --> Scheduler[Laravel Kernel]
  Scheduler --> Commands[Hourly/daily commands]
  QueueWorker[Queue worker] --> Jobs[ShouldQueue jobs]
  Docker[Docker multi-stage build] --> Nginx
  CodeDeploy[appspec/scripts] --> Runtime[Deployed Laravel runtime]
```

The diagrams contain only components verified in source/configuration; unverified production infrastructure is intentionally omitted.
