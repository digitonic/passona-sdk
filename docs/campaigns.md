# Campaigns

## Create
Schedule a new campaign within Passona.

**Example**

```php
use \Digitonic\PassonaClient\Facades\Campaigns\Create;

$data = [
    "name" => "SDK MADE",
    "sender"=> "Digitonic",
    "scheduled_send_date" => "2019-11-25 15:25:05",
    "expiry_date" => "2019-12-26 15:25:05",
    "included_contact_groups" => ["ab8e21ac-f653-11e9-93bb-1b16546002d9"],
    "excluded_contact_groups" =>  ["4dbbc66c-f63c-11e9-b532-0a58646002d8"],
    "template_uuid" => "cadf2e2a-f241-11e9-bcd4-0a58646002d9"
];

$endpoint = new Create($client);
$response = $endpoint->post($data);

// Laravel
use \Digitonic\PassonaClient\Facades\Campaigns\Create;
$response = Create::post($data);
```

**Response**

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

## Usage

Used to retrieve current month usage for your account.

**Example**

```php
use \Digitonic\IexCloudSdk\Account\Usage;

$endpoint = new Usage($client);
$response = $endpoint->get();

// Laravel
use \Digitonic\IexCloudSdk\Facades\Account\Usage;

$response = Usage::get();
```

**Response**

```php
Collection {#265 ▼
  #items: array:2 [▼
    "messages" => {#275 ▼
      +"dailyUsage": {#277 ▶}
      +"monthlyUsage": 12778
      +"monthlyPayAsYouGo": 0
      +"tokenUsage": {#278 ▶}
      +"keyUsage": {#272 ▶}
    }
    "rules" => []
  ]
}
```
