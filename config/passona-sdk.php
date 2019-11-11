<?php
return [
    /*
     |--------------------------------------------------------------------------
     | Passona API Key
     |--------------------------------------------------------------------------
     |
     | Here you may specify your Passona API Key. This key will be
     | required for every request you make to Passona via the SDK.
     |
     */
    'passona_api_key' => env('PASSONA_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Passona Base URI
    |--------------------------------------------------------------------------
    |
    | Here you may specify the Passona Base URL for API requests.
    | This URL is used to configure the client for every request.
    |
    */
    'passona_base_uri' => env('PASSONA_BASE_URI', 'https://passona.co.uk/api/2.0'),
];
