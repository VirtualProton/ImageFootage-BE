<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Modules;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //NEW: Increase StringLength

        view()->composer('admin.layouts.default', function($view)
        {
            $modules = Modules::with('submodules')
            ->where('status','=','A')
            ->where('parent_module_id','=',0)
            ->orderBy('sort_order','ASC')
            ->get()->toArray();

            $view->with('modules', $modules);
        });
    }
}
