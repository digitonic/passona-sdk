# Keywords

## Explanation
Keywords are words that will trigger an automated action in Passona when received within the body of an inbound message.

Keywords can be assigned to a contact group and set whether to call a webhook based on a `boolean` flag passed in at its 
creation.

## Create
Create a new keyword for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Keywords\Create;

$data = [
    'keyword' => 'OPTOUT',
    'message' => 'Optout example.',
    'help' => 'Optout tooltip text.',
    'add_contact_to_group' => true,
    'call_webhook' => true,
    'contact_groups_uuid' => ['c9caf71c-fa58-11e9-b486-0a58646001fa'],
    'webhooks_uuid' => ['4db7d890-f63c-11e9-afc6-0a58646002d8']
];

$endpoint = new Create($client);
$response = $endpoint->post($data);

// Laravel
use \Digitonic\PassonaClient\Facades\Keywords\CreateKeyword;
$response = CreateKeyword::post($data);
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "ef464c40-faf2-11e9-bef1-0a5864600115"
      +"keyword": "OPTOUT"
      +"message": "Optout example."
      +"status": "1"
      +"help": "Optout tooltip text."
      +"add_contact_to_group": true
      +"contact_groups_uuid": array:1 [▼
        0 => "c9caf71c-fa58-11e9-b486-0a58646001fa"
      ]
      +"call_webhook": true
      +"webhooks_uuid": array:1 [▼
        0 => "93ce0e94-f65f-11e9-8880-0a58646002d8"
      ]
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/keywords/ef464c40-faf2-11e9-bef1-0a5864600115"
        }
      ]
    }
  ]
}
```

## Update

Update a keyword for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Keywords\Update;

$data = [
    'keyword' => 'OPTOUT',
    'message' => 'Optout example updated.',
    'help' => 'Optout tooltip text.',
    'call_webhook' => true,
    'webhooks_uuid' => ['4db7d890-f63c-11e9-afc6-0a58646002d8']
];

$endpoint = new Update($client);
$response = $endpoint->put('a6589912-fa42-11e9-80c5-0a58646001fa', $data);

// Laravel
use \Digitonic\PassonaClient\Facades\Keywords\UpdateKeyword;
$response = UpdateKeyword::put('a6589912-fa42-11e9-80c5-0a58646001fa', $data);
```

**Response**

```php

```

## Show

Retrieve a specific keyword.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Keywords\Show;

$endpoint = new Show($client);
$response = $endpoint->get('493c21ac-fa5d-11e9-88db-0a58646001fa', false, null);

// Laravel
use \Digitonic\PassonaClient\Facades\Keywords\ShowKeyword;
$response = ShowKeyword::get('493c21ac-fa5d-11e9-88db-0a58646001fa', false, null);
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "493c21ac-fa5d-11e9-88db-0a58646001fa"
      +"keyword": "OPTOUT"
      +"message": "This is a test"
      +"status": "1"
      +"help": "Test Text"
      +"add_contact_to_group": true
      +"contact_groups_uuid": array:1 [▼
        0 => "c9caf71c-fa58-11e9-b486-0a58646001fa"
      ]
      +"call_webhook": false
      +"webhooks_uuid": []
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/keywords/493c21ac-fa5d-11e9-88db-0a58646001fa"
        }
      ]
    }
  ]
}
```

## Delete

Delete a keyword from use with your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Keywords\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('493c21ac-fa5d-11e9-88db-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\Keywords\DeleteKeyword;
$response = DeleteKeyword::delete('493c21ac-fa5d-11e9-88db-0a58646001fa');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of keywords.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Keywords\Index;

$endpoint = new Index($client);
$response = $endpoint->get(null, true, 20);

// Laravel
use \Digitonic\PassonaClient\Facades\Keywords\RetrieveKeywords;
$response = RetrieveKeywords::get(null, true, 20);
```

**Response**

```php
Collection {#230 ▼
  #items: array:3 [▼
    "data" => array:2 [▼
      0 => {#238 ▼
        +"uuid": "493c21ac-fa5d-11e9-88db-0a58646001fa"
        +"keyword": "OPTOUT"
        +"message": "This is a test"
        +"status": "1"
        +"help": "Test Text"
        +"add_contact_to_group": true
        +"contact_groups_uuid": array:1 [▼
          0 => "c9caf71c-fa58-11e9-b486-0a58646001fa"
        ]
        +"call_webhook": false
        +"webhooks_uuid": []
        +"links": array:1 [▼
          0 => {#236 ▼
            +"rel": "self"
            +"uri": "https://passona.co.uk/api/2.0/keywords/493c21ac-fa5d-11e9-88db-0a58646001fa"
          }
        ]
      }
      1 => {#239 ▼
        +"uuid": "36afec58-fa5d-11e9-80e1-0a58646001fa"
        +"keyword": "TestKeyword"
        +"message": "This is a test"
        +"status": "1"
        +"help": "Test Text"
        +"add_contact_to_group": true
        +"contact_groups_uuid": array:1 [▼
          0 => "c9caf71c-fa58-11e9-b486-0a58646001fa"
        ]
        +"call_webhook": false
        +"webhooks_uuid": []
        +"links": array:1 [▶]
      }
    ]
    "links" => {#224 ▼
      +"first": "https://passona.co.uk/api/2.0/keywords?page=1"
      +"last": "https://passona.co.uk/api/2.0/keywords?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#237 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/keywords"
      +"per_page": "20"
      +"to": 2
      +"total": 2
    }
  ]
}
```
