# Campaigns

## Explanation
Campaigns are the basis of what will be sent to the end device. They comprise of the campaign itself, 
[Contact Groups](/contact-groups.md), [Keywords](/keywords.md), [Links](/links.md), [Senders](/senders.md), 
[Templates](/templates.md), [Vanity Domains](/vanity-domains.md) and [Webhooks](/webhooks.md)

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
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\CreateCampaign;
$response = CreateCampaign::setPayload($data)->post();
```

Or use the built in request setters

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Create;

$endpoint = new Create($client);
$endpoint
    ->setName('SDK MADE')
    ->setSender('Digitonic')
    ->setScheduledSendDate('2019-11-25 15:25:00')
    ->setExpiryDate('2019-12-26 15:25:00')
    ->setIncludedContactGroups(['f213fd72-f986-11e9-970f-0a58646001df'])
    ->setExcludedContactGroups(['f213fd72-f521-21e9-970f-0a58614121df'])
    ->setTemplateUuid('bedf2e8a-f653-11e9-bcd4-0a58646002d9');
$response = $endpoint->post();
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
$response = $endpoint->setPayload($data)->put('a6589912-fa42-11e9-80c5-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\UpdateCampaign;
$response = UpdateCampaign::setPayload($data)->put('a6589912-fa42-11e9-80c5-0a58646001fa');
```

Or use the built in request setters

```php
use \Digitonic\PassonaClient\Entities\Campaigns\Update;

$endpoint = new Update($client);
$endpoint
    ->setName('SDK MADE Update')
    ->setSender('Digitonic')
    ->setScheduledSendDate('2019-11-25 17:30:00')
    ->setExpiryDate('2019-12-26 17:30:00')
    ->setIncludedContactGroups(['f213fd72-f986-11e9-970f-0a58646001df'])
    ->setExcludedContactGroups( ['f213fd72-f521-21e9-970f-0a58614121df'])
    ->setTemplateUuid('bedf2e8a-f653-11e9-bcd4-0a58646002d9');
$response = $endpoint->put('a6589912-fa42-11e9-80c5-0a58646001fa');
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
$response = $endpoint->paginate(20, 1)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\RetrieveCampaigns;
$response = RetrieveCampaigns::paginate(20, 1)->get();
```

**Response**

```php
Collection {#227 ▼
  #items: array:3 [▼
    "data" => array:1 [▼
      0 => {#238 ▼
        +"uuid": "cfb31368-f98a-11e9-9f54-0a58646001df"
        +"team_uuid": "4db7d890-f63c-11e9-afc6-0a58646002d8"
        +"name": "Campaign Test Send"
        +"sender": "Digitonic"
        +"scheduled_send_date": "2019-10-28 13:56:59"
        +"expiry_date": "2019-10-30 13:56:59"
        +"status": 2
        +"included_contact_groups": array:1 [▼
          0 => "47915da0-f63d-11e9-a9c1-0a58646002d8"
        ]
        +"excluded_contact_groups": []
        +"started_sending_at": "2019-10-28 13:57:01"
        +"template_uuid": "79b56ffa-f972-11e9-af8c-0a58646001df"
        +"finished_sending_at": "2019-10-28 13:57:02"
        +"created_at": "2019-10-28 13:56:59"
        +"updated_at": "2019-10-28 13:57:02"
      }
    ]
    "links" => {#239 ▼
      +"first": "https://passona.co.uk/api/2.0/campaigns?page=1"
      +"last": "https://passona.co.uk/api/2.0/campaigns?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#233 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/campaigns"
      +"per_page": "20"
      +"to": 1
      +"total": 1
    }
  ]
}
```

## Send Test

Send a test campaign to a single contact.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Campaigns\SendTest;

$data = [
    'template_uuid' => '68f69f96-f732-11e9-ba60-0a58646001cd',
    'name' => 'Campaign Test Send',
    'sender' => 'Digitonic',
    'contact_number' => '447758741254',
    'custom_fields' => [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ]
];


$endpoint = new SendTest($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\SendTestCampaign;
$response = SendTestCampaign::setPayload($data)->post();
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "2cf2ca0c-fa51-11e9-a170-0a58646001fa"
      +"team_uuid": "4db7d890-f63c-11e9-afc6-0a58646002d8"
      +"name": "Campaign Test Send"
      +"sender": "Digitonic"
      +"scheduled_send_date": "2019-10-29 13:36:00"
      +"expiry_date": "2019-10-31 13:36:56"
      +"status": 0
      +"included_contact_groups": array:1 [▼
        0 => "47915da0-f63d-11e9-a9c1-0a58646002d8"
      ]
      +"excluded_contact_groups": []
      +"started_sending_at": ""
      +"template_uuid": "68f69f96-f732-11e9-ba60-0a58646001cd"
      +"finished_sending_at": ""
      +"created_at": "2019-10-29 13:36:56"
      +"updated_at": ""
    }
  ]
}
```

