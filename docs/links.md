# Links

## Explanation
Links can be added to a template and are individual to a specific template. Links have a direct relationship with a vanity domain.

When created they can be inserted into a template and can be denoted in the template with the `::` placeholder - `::NEW_LINK::` these will be replaced with a personalised
link when the message is sent to the end recipients handset.

Links are used in campaigns via a template. A link can be in a locked state if they are in use with another template, should this happen the API will return an HTTP `423 - Locked` status
when a modification attempts to be made on it. 

The link is considered locked until such time when the campaign it is being used in has finished.

## Create
Create a new template for your current team.

By default all teams will have at least one vanity domain of `https://psms.io` available for use.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Links\Create;

$data = [
    'vanity_domain_uuid' => '4d47ca82-f63c-11e9-a674-0a58646002d8',
    'template_uuid' => 'ae17d458-fa63-11e9-83fe-0a58646001fd',
    'name' => 'New Link',
    'destination' => 'https://digitonic.co.uk'
];

$endpoint = new Create($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Links\CreateLink;
$response = CreateLink::setPayload($data)->post();
```

or use the built-in setters

```php
use \Digitonic\PassonaClient\Entities\Links\Create;

$endpoint = new Create($client);
$endpoint
    ->setVanityDomainUuid('4d47ca82-f63c-11e9-a674-0a58646002d8')
    ->setTemplateUuid('ae17d458-fa63-11e9-83fe-0a58646001fd')
    ->setName('New Link')
    ->setDestination('https://digitonic.co.uk');

$response = $endpoint->post();
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "e8cbe94a-faf4-11e9-96cc-0a5864600115"
      +"vanity_domain_uuid": "4d47ca82-f63c-11e9-a674-0a58646002d8"
      +"template_uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
      +"name": "New Link"
      +"destination": "https://digitonic.co.uk"
      +"created_at": "2019-10-30 09:08:59"
      +"updated_at": "2019-10-30 09:08:59"
    }
  ]
}
```

## Update

Update a link for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Links\Update;

$data = [
    'name' => 'New Link Updated',
    'destination' => 'https://digitonic.co.uk/update'
];

$endpoint = new Update($client);
$response = $endpoint->setPayload($data)->put('e8cbe94a-faf4-11e9-96cc-0a5864600115');

// Laravel
use \Digitonic\PassonaClient\Facades\Links\UpdateLink;
$response = UpdateLink::setPayload($data)->put('e8cbe94a-faf4-11e9-96cc-0a5864600115');
```

or use the built-in setters

```php
use \Digitonic\PassonaClient\Entities\Links\Update;

$endpoint = new Update($client);
$endpoint
    ->setName('New Link Updated')
    ->setDestination('https://digitonic.co.uk/update');
];

$response = $endpoint->put('e8cbe94a-faf4-11e9-96cc-0a5864600115');
```


**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "e8cbe94a-faf4-11e9-96cc-0a5864600115"
      +"vanity_domain_uuid": "4d47ca82-f63c-11e9-a674-0a58646002d8"
      +"template_uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
      +"name": "New Link Updated"
      +"destination": "https://digitonic.co.uk/update"
      +"created_at": "2019-10-30 09:08:59"
      +"updated_at": "2019-10-30 09:12:02"
    }
  ]
}
```

## Show

Retrieve a specific link.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Links\Show;

$endpoint = new Show($client);
$response = $endpoint->get('93c21ac-fa5d-11e9-88db-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\Links\ShowLink;
$response = ShowLink::get('93c21ac-fa5d-11e9-88db-0a58646001fa');
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "e8cbe94a-faf4-11e9-96cc-0a5864600115"
      +"vanity_domain_uuid": "4d47ca82-f63c-11e9-a674-0a58646002d8"
      +"template_uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
      +"name": "New Link"
      +"destination": "https://digitonic.co.uk"
      +"created_at": "2019-10-30 09:08:59"
      +"updated_at": "2019-10-30 09:08:59"
    }
  ]
}

```

## Delete

Delete a link for your current team that is not currently locked.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Links\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('93c21ac-fa5d-11e9-88db-0a58646001fa);

// Laravel
use \Digitonic\PassonaClient\Facades\Links\DeleteLink;
$response = DeleteLink::delete('93c21ac-fa5d-11e9-88db-0a58646001fa');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```
