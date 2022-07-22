<?php

namespace App\Providers;

use View;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeSharedVariables();
        $this->bootBladeComponents();
    }

    /**
     * Define shared variables through all blade files
     * @return void
     */
    protected function bootBladeSharedVariables(): void
    {
        View::share('FE', config('frontend'));
    }

    /**
     * Define frontend components path with aliases
     * @return void
     */
    protected function bootBladeComponents(): void
    {
        Blade::anonymousComponentNamespace('frontend/layouts', 'layouts');
        Blade::anonymousComponentNamespace('frontend/pages', 'pages');
        Blade::anonymousComponentNamespace('frontend/partials', 'partials');
        Blade::anonymousComponentNamespace('frontend/components', 'components');
    }
}
