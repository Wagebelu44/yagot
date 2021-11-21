<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
     

        View::composer('admin.layout.master_layout', function ($view) {
            $view->with('settings', \App\Models\Setting::where('id',1)->first(['title_ar','title_en']));
        });

        View::composer('admin.layout.header', function ($view) {
            $view->with('settings', \App\Models\Setting::where('id',1)->first(['title_ar','title_en']));
        });
  
    }
}
