<?php

namespace Selkis\VenID\Providers;

use Illuminate\Support\ServiceProvider;
use Selkis\VenID\Seniat;
use Selkis\VenID\CNE;

class VenIdServicesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['seniat'] = $this->app->share(function($app)
        {
            return new Seniat();
        });

        $this->app['cne'] = $this->app->share(function($app)
        {
            return new Cne();
        });
    }
}
