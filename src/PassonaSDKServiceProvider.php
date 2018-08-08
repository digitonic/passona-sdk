<?php

namespace Digitonic\PassonaClient;

use Illuminate\Support\ServiceProvider;

class PassonaSDKServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/passona-sdk.php' => config_path('passona-sdk.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(\Digitonic\PassonaClient\Client::class, function () {
            $config = config('passona-sdk');
            return new Client(
                $config['passona_org_id'],
                $config['passona_token'],
                $config['passona_base_uri'],
                \GuzzleHttp\Client::class);
        });
    }
}
