<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Modules;
use Illuminate\Support\Facades\URL;


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
			$curl=URL::current();
			$current_url=explode('/',$curl);
			$endurl=end($current_url);
            $view->with('modules', $modules);
        });
    }
}
