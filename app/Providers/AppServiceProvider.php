<?php

namespace App\Providers;

use App\Services\Assets;
use App\Services\Search\SearchEngine;
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
        $this->app->singleton('assets', function ($app) {
            return new Assets;
        });
        $this->app->singleton('search.engine', function ($app) {
            return new SearchEngine;
        });

        $this->app->bind('App\Repositories\Contracts\UserRepository', 'App\Repositories\Eloquent\UserRepository');
    }
}
