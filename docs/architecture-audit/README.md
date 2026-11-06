# ImageFootage Architecture Audit

This audit documents the implementation present in this repository as inspected on 2026-11-06. It is repository-only: production infrastructure, live database state, credentials, traffic, and external-provider dashboards were not accessed.

## Navigation

- [00 Executive summary](00-executive-summary.md)
- [01 Project overview](01-project-overview.md)
- [02 Libraries and dependencies](02-libraries-and-dependencies.md)
- [03 API and route inventory](03-api-and-route-inventory.md)
- [04 Database architecture](04-database-architecture.md)
- [04 Database relationships](04-database-relationships.md)
- [05 Module architecture](05-module-architecture.md)
- [06 Business logic and workflows](06-business-logic-and-workflows.md)
- [07 Payment system](07-payment-system.md)
- [08 Search system](08-search-system.md)
- [09 Third-party integrations](09-third-party-integrations.md)
- [10 Authentication and security](10-authentication-and-security.md)
- [11 Media and file management](11-media-and-file-management.md)
- [12 Jobs, queues, and scheduler](12-jobs-queues-and-scheduler.md)
- [13 Infrastructure and deployment](13-infrastructure-and-deployment.md)
- [14 Frontend/backend interactions](14-frontend-backend-interactions.md)
- [15 Error handling and observability](15-error-handling-and-observability.md)
- [16 Testing and code quality](16-testing-and-code-quality.md)
- [17 Environment and configuration](17-environment-and-configuration.md)
- [18 Performance analysis](18-performance-analysis.md)
- [19 Architecture diagrams](19-architecture-diagrams.md)
- [20 Complete technical findings](20-complete-technical-findings.md)

## Machine-readable inventories

`dependencies.csv`, `routes.csv`, `modules.csv`, `database-entities.csv`, `external-integrations.csv`, `scheduled-jobs.csv`, and `environment-variables.csv` accompany the narrative documents.

## Phase 2

The deeper static execution audit is in [phase-2/README.md](phase-2/README.md). It adds route-to-handler tracing, controller/model/database matrices, API-contract evidence, payment/download/authentication execution flows, external-call mapping, failure analysis, detailed diagrams, and a generated OpenAPI 3.1 document.

Phase 3 verification is in [phase-3/README.md](phase-3/README.md). It records source-backed security, authorization, payment-integrity, cart/order, download/media, database-consistency, external-integration, admin, API-contract, and safe-test verification results.

## Evidence convention

**Verified** means directly observed in source, configuration, migrations, or a successfully executed local command. **Inferred** means supported by implementation but not directly confirmed at runtime. **Unknown** means the repository does not establish the fact.
