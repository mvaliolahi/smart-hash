<?php

namespace Mvaliolahi\SmartHash;

use Hashids\Hashids;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use Mvaliolahi\SmartHash\Middleware\SmartHashMiddleware;

/**
 * Package Service Provider.
 */
class ServiceProvider extends SupportServiceProvider
{
    /**
     * Register Services to Service Container
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot
     *
     * @return void
     */
    public function boot()
    {
        // Register Middleware
        app('router')->aliasMiddleware('smart-hash-middleware', SmartHashMiddleware::class);

        // override route model binding.
        collect(app('smart-hash'))->each(function ($model, $alias) {
            Route::bind($alias, function ($value) use ($model) {
                return $model::find((new Hashids())->decode($value)[0]);
            });
        });
    }
}
