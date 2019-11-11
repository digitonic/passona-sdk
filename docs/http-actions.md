# HTTP Actions

The SDK supports typical http verbs such as `GET`, `POST`, `PUT` and `DELETE`. However to allow for flexibility some of these will
take extra parameters depending on what you wish to do with them. This is explained below.

## Explanation

## GET
The `GET` endpoint used by the `Passona SDK API Client` takes one parameter __which is optional__ dependant on its usage.

```php
    public function get(string $entityIdentifier)
```

The `$entityIdentifier` parameter takes in a UUID for the particular entity you wish to retrieve. If you wish to retrieve only one entity from
an endpoint then a UUID passed in as the first and only parameter will return the expected result.

The get function can also be used for an index or retrieval of all entities in a paginated return.

#### Paginate
When using the `paginate` function it can take two parameters, the first is how many entities you want to return per page
and the second variable is the current page you wish to retrieve is the result is split into many paginated pages.

```php
// First parameter links
->paginate(20, 1)
```

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
$response = $endpoint->paginate(20)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\RetrieveTemplates;
$response = RetrieveTemplates::paginate(20)->get();
```

## POST
The `POST` endpoint used by the `Passona SDK API Client` can be called on to create new entities within Passona.

```php
    public function post()
```

The payload that is set requires array of key values pairs as is expected by Passona for the respective entity being created.
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
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\CreateCampaign;
$response = CreateCampaign::setPayload($data)->post();
```

## PUT
The `PUT` endpoint used by the `Passona SDK API Client` takes one parameter and can be called on to update an existing entity within Passona.

```php
        public function put(string $entityIdentifier)
```

The `$entityIdentifier` parameter takes in a UUID for the particular entity you wish to update.

The payload that is set requires array of key values pairs as is expected by Passona for the respective entity being created.
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
$response = $endpoint->setPayload($data)->put('a6589912-fa42-11e9-80c5-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\UpdateCampaign;
$response = UpdateCampaign::setPayload($data)->put('a6589912-fa42-11e9-80c5-0a58646001fa');
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
