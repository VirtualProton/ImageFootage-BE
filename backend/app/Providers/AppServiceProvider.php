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
			$modules1=new Modules;
			$modules_list=$modules1->where('url', $endurl)->get()->toArray();
			//echo '<pre>'; print_r($modules); exit();
			if(isset($modules_list) && !empty($modules_list)){
				$parent_id=$modules_list[0]['parent_module_id'];
			}else{
				$parent_id=0;
			}
            $view->with('modules', $modules);
			$view->with('parent_id',$parent_id);
        });
    }
}
