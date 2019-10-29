# HTTP Actions

The SDK supports typical http verbs such as `GET`, `POST`, `PUT` and `DELETE`. However to allow for flexibility some of these will
take extra parameters depending on what you wish to do with them. This is explained below.

## Explanation

## GET
The `GET` endpoint used by the `Passona SDK API Client` takes three parameters.

```php
    public function get(?string $entityIdentifier, bool $requirePagination = false, ?int $paginateBy = 15)
```

The `$entityIdentifier` parameter takes in a UUID for the particular entity you wish to retrieve. If you wish to retrieve only one entity from
an endpoint then a UUID passed in as the first and only parameter will return the expected result.

However if you wish to retrieve a paginated collection of entities and would like to customise the pagination length, you can do so
by passing in `NULL` as the parameter for `$entityIdentifier`, `true` for `$requirePagination` and an integer value
greater than 0 of your choosing for `$paginateBy`

### Examples

**Retrieving a single template entity**

```php
use \Digitonic\PassonaClient\Entities\Templates\Show;

$endpoint = new Show($client);
$response = $endpoint->get('68f69f96-f732-11e9-ba60-0a58646001cd');

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\ShowTemplate;
$response = ShowTemplate::get('68f69f96-f732-11e9-ba60-0a58646001cd');
```

**Retrieving a paginated collection of template entities**

```php
use \Digitonic\PassonaClient\Entities\Templates\Index;

$endpoint = new Index($client);
//Paginated return with 20 entites per page, default is 15 per page
$response = $endpoint->get(null, true, 20);

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\RetrieveTemplates;
$response = RetrieveTemplates::get(null, true, 20);
```

## POST
The `POST` endpoint used by the `Passona SDK API Client` takes a single parameter.

```php
    public function post(array $payload)
```

The `$payload` parameter takes an array of key values pairs as is expected by Passona for the respective entity being created.
You can find our [API documentation here.](https://digitonic.co.uk) 

### Examples

**Creating a campaign**

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Create;

$data = [
    'name' => 'SDK MADE',
    'sender' => 'Digitonic',
    'scheduled_send_date' => '2019-11-25 15:25:00',
    'expiry_date' => '2019-12-26 15:25:00',
    'included_contact_groups' => ['f213fd72-f986-11e9-970f-0a58646001df'],
    'excluded_contact_groups' =>  ['f213fd72-f521-21e9-970f-0a58614121df'],
    'template_uuid' => 'bedf2e8a-f653-11e9-bcd4-0a58646002d9'
];

$endpoint = new Create($client);
$response = $endpoint->post($data);

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\CreateCampaign;
$response = CreateCampaign::post($data);
```

## PUT
The `PUT` endpoint used by the `Passona SDK API Client` takes two parameters

```php
        public function put(string $entityIdentifier, array $payload)
```

The `$entityIdentifier` parameter takes in a UUID for the particular entity you wish to update.
The `$payload` parameter takes an array of key values pairs as is expected by Passona for the respective entity being created.
You can find our [API documentation here.](https://digitonic.co.uk) 

### Examples

**Updating a campaign**

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Update;

$data = [
    'name' => 'SDK MADE Update',
    'sender' => 'Digitonic',
    'scheduled_send_date' => '2019-11-25 17:30:00',
    'expiry_date' => '2019-12-26 17:30:00',
    'included_contact_groups' => ['f213fd72-f986-11e9-970f-0a58646001df'],
    'excluded_contact_groups' =>  ['f213fd72-f521-21e9-970f-0a58614121df'],
    'template_uuid' => 'bedf2e8a-f653-11e9-bcd4-0a58646002d9'
];

$endpoint = new Update($client);
$response = $endpoint->put($data);

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\UpdateCampaign;
$response = UpdateCampaign::put('a6589912-fa42-11e9-80c5-0a58646001fa', $data);
```

## DELETE
The `DELETE` endpoint used by the `Passona SDK API Client` takes a single parameter.

```php
   public function delete(string $entityIdentifier)
```

The `$entityIdentifier` parameter takes in a UUID for the particular entity you wish to delete.

### Examples

**Deleting a campaign**

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('a6589912-fa42-11e9-80c5-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\DeleteCampaign;
$response = DeleteCampaign::delete('a6589912-fa42-11e9-80c5-0a58646001fa');
```





