# Frontend/backend interactions

The repository includes Blade templates, Laravel Mix assets (`resources/js/app.js`, `resources/sass/app.scss`), Vue 2.7 tooling, Angular 1.7.9 as a declared dependency, Bootstrap/jQuery, and extensive static assets under `public`. Blade admin views submit browser forms and AJAX-style requests to web/admin routes. API clients are expected to call `/api/*` routes, with Axios available in the JavaScript build.

Backend assumptions visible in code include JWT authorization headers, `Login-Type` handling for social login, CORS middleware, JSON response branches for API requests, and server-rendered invoice/email/PDF views. A separate frontend repository is not present in the inspected checkout; therefore its complete route usage, token storage, and production build/deployment behavior are unknown.
