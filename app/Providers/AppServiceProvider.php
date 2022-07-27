<?php

namespace App\Providers;

use A17\Localization\Support\Helpers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadHelpers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function loadHelpers()
    {
        Helpers::loadGlobalHelpers();
    }
}
