<?php

namespace AldoZumaran\Kaleyra;

use Illuminate\Support\ServiceProvider;

class KaleyraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('kaleyra', function()
        {
            return new Kaleyra();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/kaleyra.php' => config_path('kaleyra.php'),
        ]);
    }
}
