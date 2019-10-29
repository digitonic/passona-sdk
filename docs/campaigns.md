# Campaigns

## Create
Schedule a new campaign within Passona.

**Example**

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

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "a6589912-fa42-11e9-80c5-0a58646001fa"
      +"team_uuid": "4db7d890-f63c-11e9-afc6-0a58646002d8"
      +"name": "SDK MADE"
      +"sender": "Digitonic"
      +"scheduled_send_date": "2019-11-25 15:25:00"
      +"expiry_date": "2019-12-26 15:25:0"
      +"status": 0
      +"included_contact_groups": array:1 [▼
        0 => "f213fd72-f986-11e9-970f-0a58646001df"
      ]
      +"excluded_contact_groups": array:1 [▼
        0 => "f213fd72-f521-21e9-970f-0a58614121df"
      ]
      +"started_sending_at": ""
      +"template_uuid": "bedf2e8a-f653-11e9-bcd4-0a58646002d9"
      +"finished_sending_at": ""
      +"created_at": "2019-10-29 11:52:57"
      +"updated_at": ""
    }
  ]
}
```

## Update

Update any campaign that is not currently sending or its send date is not in the past.

**Example**

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
$response = $endpoint->put('a6589912-fa42-11e9-80c5-0a58646001fa', $data);

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\UpdateCampaign;
$response = UpdateCampaign::put('a6589912-fa42-11e9-80c5-0a58646001fa', $data);
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "a6589912-fa42-11e9-80c5-0a58646001fa"
      +"team_uuid": "4db7d890-f63c-11e9-afc6-0a58646002d8"
      +"name": "SDK MADE Update"
      +"sender": "Digitonic"
      +"scheduled_send_date": "2019-11-25 17:30:00"
      +"expiry_date": "2019-12-26 17:30:00"
      +"status": 0
      +"included_contact_groups": array:1 [▼
        0 => "f213fd72-f986-11e9-970f-0a58646001df"
      ]
      +"excluded_contact_groups": array:1 [▼
        0 => "f213fd72-f521-21e9-970f-0a58614121df"
      ]
      +"started_sending_at": ""
      +"template_uuid": "bedf2e8a-f653-11e9-bcd4-0a58646002d9"
      +"finished_sending_at": ""
      +"created_at": "2019-10-29 11:52:57"
      +"updated_at": ""
    }
  ]
}
```

## Delete

Delete any campaign that is not currently sending.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('a6589912-fa42-11e9-80c5-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\DeleteCampaign;
$response = DeleteCampaign::delete('a6589912-fa42-11e9-80c5-0a58646001fa');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of campaigns

**Example**

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Index;

$endpoint = new Index($client);
$response = $endpoint->get(null, true, 20);

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\RetrieveCampaigns;
$response = RetrieveCampaigns::get(null, true, 20);
```

**Response**

```php

```
