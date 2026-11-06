# Libraries and dependencies

## Direct production dependencies

The declared production set in `composer.json` contains 23 packages. Locked versions include Laravel 5.8.38, JWT Auth 1.0.2, Razorpay 2.9.2, PayU Money 1.0.4, Elasticsearch client 7.17.3, MongoDB Laravel 3.5.3, Predis 3.3.0, Laravel FFmpeg 4.1.0, Intervention Image 2.7.2, Dompdf bridge 0.8.7, Google API client 2.14.0, Guzzle 6.5.8, AWS Laravel 3.8.1, and Excel 3.1.67.

| Area | Packages and observed use |
|---|---|
| Framework/UI | `laravel/framework`, `laravelcollective/html`, `laravel/tinker`; Laravel routing, sessions, validation, Blade, Eloquent |
| Authentication | `tymon/jwt-auth`; JWT guard/middleware; Google client and Facebook HTTP verification also appear in `JwtMiddleware` |
| Payments | `razorpay/razorpay`, `riazxrazor/payumoney`; Atom request/response classes are custom |
| Data | `doctrine/dbal`, `mongodb/laravel-mongodb`, `predis/predis` |
| Search | `elasticsearch/elasticsearch` and custom `ElasticSearchController`/provider |
| Media | `intervention/image`, `pbmedia/laravel-ffmpeg`, AWS SDK; actual media-provider wrappers are custom |
| Documents/imports | `barryvdh/laravel-dompdf`, `maatwebsite/excel`, `phpoffice/phpspreadsheet`, CKEditor |
| External HTTP/SMS | `guzzlehttp/guzzle`, custom Msg91 cURL provider, Google client |
| Admin/diagnostics | Laravel log viewer |

Composer lock contains 125 production and 35 development package records. The JavaScript project declares Laravel Mix/Vue 2-era tooling plus Angular 1.7.9; `package-lock.json` is lockfile v3 with 1,191 package entries. `node_modules` and `vendor` are present locally but are not treated as source evidence.

## Development dependencies

PHPUnit 7.5.20, Mockery, Collision, Faker, Whoops, Laravel dump server, and migrations generator are declared. JavaScript build tooling is Laravel Mix 4, Webpack-era Sass/Vue tooling, Axios, Bootstrap, jQuery, Lodash, and Angular.

## Usage classification

The accompanying `dependencies.csv` identifies declared/locked versions, directness, and observed source references. Presence in the lockfile is not treated as proof of use. FFmpeg, AWS, Excel, Dompdf, Image, Elasticsearch, JWT, Razorpay, PayU, MongoDB, Redis, and Google integrations have direct source/config references; maintenance status was not independently verified in this repository-only audit.
