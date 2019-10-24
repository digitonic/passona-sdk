<?php

namespace Digitonic\PassonaClient;

use GuzzleHttp\Client;
use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Exceptions\InvalidConfig;
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
        $this->mergeConfigFrom(__DIR__.'/../config/passona-sdk.php', 'passona-sdk');

        $this->app->bind(Passona::class, function () {
            $config = config('passona-sdk');

            $this->catchInvalidConfig($config);

            $guzzle = new Client([
                'base_uri' => $config['passona_base_uri'],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $config['passona_api_key']
                ],
            ]);
            return new \Digitonic\PassonaClient\Client($guzzle);
        });
    }

    /**
     * @param array|null $config
     * @throws InvalidConfig
     */
    protected function catchInvalidConfig(array $config = null)
    {
        if (empty($config['passona_base_uri'])) {
            throw InvalidConfig::baseUrlNotSpecified();
        }
        if (empty($config['passona_api_key'])) {
            throw InvalidConfig::passonaApiKeyNotSpecified();
        }
        if (empty($config['passona_team_uuid'])) {
            throw InvalidConfig::noTeamUuidSpecified();
        }
    }
}
