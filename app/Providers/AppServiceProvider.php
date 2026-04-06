<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Modules;
use Illuminate\Support\Facades\URL;
use App\Services\Sms\SmsService;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register SMS Service as singleton
        $this->app->singleton(SmsService::class, function ($app) {
            return new SmsService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force scheme based on environment + APP_URL host
        if (App::environment('local')) {
            URL::forceScheme('http');
        } else {
            $appUrl = config('app.url');

            if ($appUrl) {
                $appHost     = parse_url($appUrl, PHP_URL_HOST);
                $requestHost = request()->getHost();

                // Only force HTTPS when the request host matches APP_URL host
                if ($requestHost === $appHost) {
                    URL::forceScheme('https');
                }
            }
        }

        Schema::defaultStringLength(191); // NEW: Increase StringLength

        view()->composer('admin.layouts.default', function ($view) {
            $modules = Modules::with('submodules')
                ->where('status', 'A')
                ->where('parent_module_id', 0)
                ->orderBy('sort_order', 'ASC')
                ->get()
                ->toArray();

            $curl        = URL::current();
            $current_url = explode('/', $curl);
            $endurl      = end($current_url);

            $modules1     = new Modules;
            $modules_list = $modules1->where('url', $endurl)->get()->toArray();

            if (isset($modules_list) && !empty($modules_list)) {
                $parent_id = $modules_list[0]['parent_module_id'];
            } else {
                $parent_id = 0;
            }

            $view->with('modules', $modules);
            $view->with('parent_id', $parent_id);
        });
    }
}
