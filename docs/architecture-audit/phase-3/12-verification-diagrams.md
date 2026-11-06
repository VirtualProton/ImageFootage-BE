# Verification diagrams

## JWT/social validation

```mermaid
flowchart LR
  Request --> Type{Login-Type}
  Type -->|normal| JWT[JWTAuth parse/authenticate]
  Type -->|google| Google[Google ID token verify]
  Type -->|facebook| Facebook[Facebook app/user token checks]
  JWT -->|failure| 401
  Google -->|failure| 401
  Facebook -->|invalid| 401
  JWT --> Handler
  Google --> Handler
  Facebook --> Handler
```

## Admin permission

```mermaid
flowchart TD
  Route --> AdminSession{admins guard?}
  AdminSession -- no --> Login
  AdminSession -- yes --> Super{super-admin?}
  Super -- yes --> Handler
  Super -- no --> ModuleAction[Resolve module/action]
  ModuleAction --> Allowed{Permission?}
  Allowed -- yes --> Handler
  Allowed -- no --> Denied[403 JSON or redirect]
```

## Payment callbacks

```mermaid
flowchart TD
  Callback --> Verify{Hash/checksum/signature}
  Verify -- fail --> Failure[Failure response/redirect]
  Verify -- pass --> Status[Order/package status update]
  Status --> Invoice[Invoice/email side effect]
  Invoice --> Cart[Cart deletion]
  Status -->|no visible idempotency guard| Repeat[Repeated callback may repeat branch]
```

## Download/proxy

```mermaid
flowchart LR
  Download --> JWT
  JWT --> Entitlement[Package/history/order checks]
  Entitlement --> History[Write/update history]
  History --> URL[Provider or stored URL]
  Proxy --> Scheme[http/https prefix only]
  Scheme --> Curl[Follow redirects; TLS verify disabled]
  Curl --> Bytes[Return full body]
```

## Database state

```mermaid
stateDiagram-v2
  Cart --> OrderCreated: payment()
  OrderCreated --> GatewayPending
  GatewayPending --> Paid: verified callback
  GatewayPending --> Failed: failed callback
  Paid --> Invoiced
  Invoiced --> CartCleared
  PackageActive --> DownloadRecorded
  DownloadRecorded --> CreditIncremented
  UserDeletion --> RelatedRowsDeleted
  RelatedRowsDeleted --> UserDeleted
```

Transitions involving live provider responses, database locks, duplicate callbacks, and deployed workers are marked by the surrounding documents as unknown or source-only.
