# Senders

## Explanation
Senders are the name of the team the message is coming from that will be displayed on the handset for the end recipient.

Senders must be between **3-11** characters in length, if it is outwith this limit it will be rejected. 
New senders are subject to moderation from Digitonic.

All teams get a default sender of `88440` and a 11 character version of their team name.

## Create
Create a new sender for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Senders\Create;

$data = [
    'sender' => 'NewSend'
];

$endpoint = new Create($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Senders\CreateSender;
$response = CreateSender::setPayload($data)->post();
```

or use the built-in setters

```php
use \Digitonic\PassonaClient\Entities\Senders\Create;

$endpoint = new Create($client);
$endpoint->setSender('NewSend');

$response = $endpoint->post();
```


**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "02e8187e-fa6b-11e9-94c2-0a5864600225"
      +"team_id": ""
      +"sender": "NewSend"
      +"status": "1"
      +"created_at": "2019-10-29 16:41:52"
      +"updated_at": "2019-10-29 16:41:52"
      +"links": array:1 [▶]
    }
  ]
}
```

## Update

Update a sender for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Senders\Update;

$data = [
    'sender' => 'NewSendUp'
];

$endpoint = new Update($client);
$response = $endpoint->setPayload($data)->put('02e8187e-fa6b-11e9-94c2-0a5864600225');

// Laravel
use \Digitonic\PassonaClient\Facades\Senders\UpdateSender;
$response = UpdateSender::setPayload($data)->put('a6589912-fa42-11e9-80c5-0a58646001fa');
```

or use the built-in setters

```php
use \Digitonic\PassonaClient\Entities\Senders\Update;

$endpoint = new Update($client);
$endpoint->setSender('NewSendUp');

$response = $endpoint->put('02e8187e-fa6b-11e9-94c2-0a5864600225');
```


**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "02e8187e-fa6b-11e9-94c2-0a5864600225"
      +"team_id": ""
      +"sender": "NewSendUp"
      +"status": "1"
      +"created_at": "2019-10-29 16:41:52"
      +"updated_at": "2019-10-29 16:43:30"
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/senders/02e8187e-fa6b-11e9-94c2-0a5864600225"
        }
      ]
    }
  ]
}
```

## Show

Retrieve a specific sender.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Senders\Show;

$endpoint = new Show($client);
$response = $endpoint->get('02e8187e-fa6b-11e9-94c2-0a5864600225');

// Laravel
use \Digitonic\PassonaClient\Facades\Senders\ShowSender;
$response = ShowSender::get('02e8187e-fa6b-11e9-94c2-0a5864600225');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "02e8187e-fa6b-11e9-94c2-0a5864600225"
      +"team_id": ""
      +"sender": "NewSendUp"
      +"status": "1"
      +"created_at": "2019-10-29 16:41:52"
      +"updated_at": "2019-10-29 16:43:30"
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/senders/02e8187e-fa6b-11e9-94c2-0a5864600225"
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
use \Digitonic\PassonaClient\Entities\Senders\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('4db96e30-f63c-11e9-83f9-0a58646002d8');

// Laravel
use \Digitonic\PassonaClient\Facades\Senders\DeleteSender;
$response = DeleteSender::delete('4db96e30-f63c-11e9-83f9-0a58646002d8');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of senders.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Senders\Index;

$endpoint = new Index($client);
$response = $endpoint->paginate(20, 1)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\Senders\RetrieveSenders;
$response = RetrieveSenders::paginate(20, 1)->get();
```

**Response**

```php
Collection {#241 ▼
  #items: array:3 [▼
    "data" => array:3 [▼
      0 => {#238 ▼
        +"uuid": "4db96e30-f63c-11e9-83f9-0a58646002d8"
        +"team_id": ""
        +"sender": "QA_Test_Tea"
        +"status": "1"
        +"created_at": "2019-10-24 09:57:27"
        +"updated_at": "2019-10-24 09:57:27"
        +"links": array:1 [▼
          0 => {#236 ▼
            +"rel": "self"
            +"uri": "https://passona.co.uk/api/2.0/senders/4db96e30-f63c-11e9-83f9-0a58646002d8"
          }
        ]
      }
      1 => {#239 ▼
        +"uuid": "4d3c59c2-f63c-11e9-a22b-0a58646002d8"
        +"team_id": ""
        +"sender": "884400"
        +"status": "1"
        +"created_at": "2019-10-24 09:57:26"
        +"updated_at": "2019-10-24 09:57:26"
        +"links": array:1 [▶]
      }
      2 => {#227 ▼
        +"uuid": "02e8187e-fa6b-11e9-94c2-0a5864600225"
        +"team_id": ""
        +"sender": "NewSendUp"
        +"status": "1"
        +"created_at": "2019-10-29 16:41:52"
        +"updated_at": "2019-10-29 16:43:30"
        +"links": array:1 [▶]
      }
    ]
    "links" => {#230 ▼
      +"first": "https://passona.co.uk/api/2.0/senders?page=1"
      +"last": "https://passona.co.uk/api/2.0/senders?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#240 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/senders"
      +"per_page": "20"
      +"to": 3
      +"total": 3
    }
  ]
}
```
