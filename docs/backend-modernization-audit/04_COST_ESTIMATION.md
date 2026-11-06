# Cost Estimation — India Planning Model

This is an indicative modernization estimate, not a fixed quote. It assumes no new features, no UI redesign, no standalone Angular 10 upgrade and no unapproved database redesign.

## Rate and effort assumptions

Planning rate: INR 1,200–1,800 per engineering hour, equivalent to INR 9,600–14,400 per eight-hour day. QA and security work are shown separately so the client can distinguish coding from acceptance effort.

| Cost component | Lean hours | Risk-adjusted hours | Indicative cost |
|---|---:|---:|---:|
| Audit, architecture and runtime security | 45 | 70 | INR 0.6–1.3 lakh |
| Baseline tests and recovery planning | 60 | 100 | INR 0.7–1.8 lakh |
| Laravel/PHP checkpoint migration | 240 | 390 | INR 2.9–7.0 lakh |
| Package replacements and integrations | 90 | 170 | INR 1.1–3.1 lakh |
| JavaScript/build track | 25 | 50 | INR 0.3–0.9 lakh |
| QA, security review and staging/UAT | 90 | 150 | INR 1.1–2.7 lakh |
| Contingency | — | — | 15–25% of approved work |

The full program therefore plans at approximately **INR 5.0–8.5 lakh + applicable GST** after scope confirmation. Exact billing may use checkpoint milestones rather than hourly invoicing.

## Three commercial options

### A — Essential security and compatibility work: INR 1.5–2.5 lakh + GST

Runtime inventory, fixed supported PHP deployment plan, dependency risk triage, critical smoke tests, emergency mitigations, backup/rollback runbook and security log review preparation. It does not deliver Laravel 13 or full integration modernization.

### B — Full backend modernization: INR 5.0–8.5 lakh + GST

All Laravel checkpoints through 13, PHP 8.5, package compatibility/replacements, regression coverage, payment/media/PDF/storage/database QA, staging, UAT and deployment handover.

### C — Phased modernization with staged payments: INR 5.5–9.0 lakh + GST

Milestones: audit/security, baseline tests, Laravel 6–8, Laravel 9–10, Laravel 11–13, integration QA and release. Each milestone has a reviewable branch, evidence pack and rollback point. The premium reflects coordination and repeated acceptance overhead.

## Commercial assumptions and exclusions

Included: existing business behavior, source-compatible API preservation, current payment semantics, regression tests, documentation and deployment planning. Excluded: new marketplace/CRM capabilities, new business or payment policies, standalone Angular frontend modernization, redesign, unrelated infrastructure, production data cleansing and unapproved schema changes.

GST is added where legally applicable and is not included in the ranges above. Cloud, vendor, WAF, managed database, SMS, email, payment and test-environment charges are pass-through costs unless separately agreed.
