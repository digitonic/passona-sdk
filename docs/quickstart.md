# Quick Start

Although the SDK can be used in a standalone application with composer, it works best when it is included with a Laravel application.

## Installation

You can install the package via composer:

```bash
composer require digitonic/passona-sdk
```

## Basic Usage 

Obtain your API keys from the Passona API settings page
```php
$passonaBaseUri=https://passona.co.uk/api/2.0/
$passonaApiKey=wuehvjTM6ZdEsi7iEFx0D7X8z3R09i2NARoKhHki8qK3JjyMHx6kbHlddnB5
```

The SDK uses Guzzle as dependency for interacting with the HTTP layer. You should instantiate a new Guzzle client with your `$passonaBaseUri` and `$passonaApiKey` as shown below.

```php
$guzzle = new Client([
    'base_uri' => $passonaBaseUri,
    'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => "Bearer {$passonaApiKey}"
    ],
]);
```

You can now use the Guzzle client as a dependency for the Passona SDK client. 

```php
$client = new \Digitonic\PassonaClient\Client($guzzle);
```

The Passona API Client can now be used as a dependency for communicating with various endpoints. for example, to call the `account/metadata` endpoint - 

```php
use \Digitonic\IexCloudSdk\Account\Metadata;

$metadata = new Metadata($client);
$response = $metadata->get();

print_r($response);
```

All endpoints that return data will return data as a `\Illuminate\Support\Collection`. This will provide various utility methods when searching the response. For more information on Laravel Collections see [https://laravel.com/docs/6.x/collections](https://laravel.com/docs/6.x/collections).

```php
Collection {#275 ▼
  #items: array:7 [▼
    "payAsYouGoEnabled" => false
    "effectiveDate" => 1621337109805
    "subscriptionTermType" => "mnlhyto"
    "tierName" => "tstar"
    "messageLimit" => 514440
    "messagesUsed" => 13578
    "circuitBreaker" => null
  ]
}
```

## Laravel Usage

The SDK comes with a Laravel Service Provider to facilitate a much cleaner and streamlined setup. The SDK supports Laravel 5.4 and upwards, the service provider will only be auto discovered from Laravel 5.5 onwards.

You can publish the config file of this package with this command:

``` bash
php artisan vendor:publish --provider="Digitonic\PassonaClient\PassonaSDKServiceProvider"
```

The following [config](config/config.php) file will be published in `config/passona-sdk.php`

Once you have installed the package, configure your `.env` with the following keys setting the correct values for your account.

```bash
PASSONA_BASE_URI=https://passona.co.uk/api/2.0/
PASSONA_API_KEY=wuehvjTM6ZdEsi7iEFx0D7X8z3R09i2NARoKhHki8qK3JjyMHx6kbHlddnB5
```

#### IoC container

The IoC container will automatically resolve the `Passona API Client` dependencies for you when calling any endpoint. Which means you can just type hint your endpoint to retrieve the object from the container with all configurations in place.

With Laravel you may use the facades directly which provides a much faster and fluent interface.

```php
use \Digitonic\PassonaClient\Facades\Campaigns\RetrieveCampaigns;

$response = RetrieveCampaigns::get(null, true, 20);
```

Some endpoints require extra parameters being passed to the endpoint object. Please see [Http Actions](/http-actions.md)
