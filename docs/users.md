# Users

## Explanation
This section contains examples of useful endpoints for users performing general tasks.

## Switch Team

Switch your current active team to another of which you are a member.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Users\SwitchTeam;

$endpoint = new SwitchTeam($client);
$response = $endpoint->get('4da54216-f63c-11e9-902c-0a58646002d8', false, null);

// Laravel
use \Digitonic\PassonaClient\Facades\Users\SwitchTeam;
$response = SwitchTeam::get('4da54216-f63c-11e9-902c-0a58646002d8', false, null);
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "4da35eba-f63c-11e9-b0cb-0a58646002d8"
      +"name": "Team Owner"
      +"email": "owner@digitonic.co.uk"
      +"current_team_id": 3
      +"created_at": "2019-10-24 09:57:27"
      +"updated_at": "2019-10-29 16:08:42"
    }
  ]
}
```



