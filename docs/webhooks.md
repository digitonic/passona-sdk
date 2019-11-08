# Webhooks

## Explanation
Webhooks are linked to a keyword. When a keyword that is associated with a webhook is received in an inbound message,the webhook will be fired to alert the recipient.

## Create
Create a new webhook for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Webhooks\Create;

$data = [
    'name' => 'New Webhook',
    'url' => 'https://digitonic.co.uk/webhook',
    'headers' => [
        'Accept' => 'application/json'
    ]
];

$endpoint = new Create($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Webhooks\CreateWebhook;
$response = CreateWebhook::setPayload($data)->post();
```

**Response**

```php
Collection {#227 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"name": "New Webhook"
      +"uuid": "346575fc-fb0d-11e9-a4d2-0a586460022b"
      +"url": "https://digitonic.co.uk/webhook"
      +"headers": {#236 ▼
        +"Accept": "application/json"
      }
      +"links": array:1 [▼
        0 => {#239 ▶}
      ]
    }
  ]
}
```

## Update

Update a webhook for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Webhookd\Update;

$data = [
    'name' => 'Updated Webhook',
        'headers' => [
            'Content-Type' => 'application/json'
        ]
];

$endpoint = new Update($client);
$response = $endpoint->setPayload($data)->put('346575fc-fb0d-11e9-a4d2-0a586460022b');

// Laravel
use \Digitonic\PassonaClient\Facades\Webhooks\UpdateWebhook;
$response = UpdateWebhook::setPayload($data)->put('346575fc-fb0d-11e9-a4d2-0a586460022b');
```

**Response**

```php
Collection {#227 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"name": "Updated Webhook"
      +"uuid": "491460ee-fb0d-11e9-a46c-0a586460022b"
      +"url": "https://digitonic.co.uk/webhook"
      +"headers": {#236 ▼
        +"Content-Type": "application/json"
      }
      +"links": array:1 [▼
        0 => {#239 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/webhooks/491460ee-fb0d-11e9-a46c-0a586460022b"
        }
      ]
    }
  ]
}

```

## Show

Retrieve a specific webhook.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Webhooks\Show;

$endpoint = new Show($client);
$response = $endpoint->get('491460ee-fb0d-11e9-a46c-0a586460022b');

// Laravel
use \Digitonic\PassonaClient\Facades\Webhhoks\ShowWebhook;
$response = ShowWebhook::get('491460ee-fb0d-11e9-a46c-0a586460022b');
```

**Response**

```php
Collection {#227 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"name": "Updated Webhook"
      +"uuid": "491460ee-fb0d-11e9-a46c-0a586460022b"
      +"url": "https://digitonic.co.uk/webhook"
      +"headers": {#236 ▼
        +"Content-Type": "application/json"
      }
      +"links": array:1 [▼
        0 => {#239 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/webhooks/491460ee-fb0d-11e9-a46c-0a586460022b"
        }
      ]
    }
  ]
}
```

## Delete

Delete a webhook from use with your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Webhooks\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('491460ee-fb0d-11e9-a46c-0a586460022b');

// Laravel
use \Digitonic\PassonaClient\Facades\Webhooks\DeleteWebhook;
$response = DeleteWebhook::delete('491460ee-fb0d-11e9-a46c-0a586460022b');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of webhooks.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Webhooks\Index;

$endpoint = new Index($client);
$response = $endpoint->paginate(20, 1)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\Webhooks\RetrieveWebhooks;
$response = RetrieveWebhooks::paginate(20, 1)->get();
```

**Response**

```php
Collection {#237 ▼
  #items: array:3 [▼
    "data" => array:1 [▼
      0 => {#238 ▼
        +"name": "Updated Webhook"
        +"uuid": "491460ee-fb0d-11e9-a46c-0a586460022b"
        +"url": "https://digitonic.co.uk/webhook"
        +"headers": {#236 ▼
          +"Content-Type": "application/json"
        }
        +"links": array:1 [▼
          0 => {#239 ▼
            +"rel": "self"
            +"uri": "https://passona.co.uk/api/2.0/webhooks/491460ee-fb0d-11e9-a46c-0a586460022b"
          }
        ]
      }
    ]
    "links" => {#227 ▼
      +"first": "https://passona.co.uk/api/2.0/webhooks?page=1"
      +"last": "https://passona.co.uk/api/2.0/webhooks?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#224 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/webhooks"
      +"per_page": "20"
      +"to": 1
      +"total": 1
    }
  ]
}

```
