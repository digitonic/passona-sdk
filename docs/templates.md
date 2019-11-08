# Templates

## Explanation
Templates contain that actual content that will be delivered to the end recipients handset. Within the template you can include
custom fields along with a template link which will contain a tracker for the provided link.

## Create
Create a new template.

Template links provided within the `body` property should be denoted with `::` I.e `::SOME_LINK::`. 
This should correlate to an already created template link that is attached to a vanity domain.

The Keywords within the template are denoted as their provided `keyword` value when they were created. I.e `OPTOUT`, `STOP` etc..

The Sender field can either be the text value of an existing sender attached to your team or a new one can be created on the fly
by simply populating the field in the request as shown below.

Templates are set to use the standard SMS length of **160** characters.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Templates\Create;

$data = [
    'name' => 'New Template',
    'body' => 'This is the content with a ::LINK:: OPTOUT',
    'sender' => 'Digitonic',
];

$endpoint = new Create($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\CreateTemplate;
$response = CreateTemplate::setPayload($data)->post();
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
      +"name": "New Template"
      +"body": "This is the content with a ::LINK:: OPTOUT"
      +"links": []
      +"is_locked": false
      +"sender": "Digitonic"
      +"created_at": "2019-10-29 15:49:24"
      +"updated_at": "2019-10-29 15:49:24"
    }
  ]
}
```

## Update

Update a template in use with your current team.

If a template is currently in use with another active campaign, the template is considered locked until such time when the campaign
using it has finished sending and you will receive an HTTP response code of `423 Locked`.

Should this occur you must create a new template or wait until the campaign using it has finished.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Templates\Update;

$data = [
    'name' => 'New Template',
    'body' => 'This is the updated body content with a ::LINK:: OPTOUT',
    'sender' => 'Digitonic',
];

$endpoint = new Update($client);
$response = $endpoint->setPayload($data)->put('ae17d458-fa63-11e9-83fe-0a58646001fd');

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\UpdateTemplate;
$response = UpdateTemplate::setPayload($data)->put('ae17d458-fa63-11e9-83fe-0a58646001fd');
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
      +"name": "New Template"
      +"body": "This is the updated body content with a ::LINK:: OPTOUT"
      +"links": []
      +"is_locked": false
      +"sender": "Digitonic"
      +"created_at": "2019-10-29 15:49:24"
      +"updated_at": "2019-10-29 15:56:01"
    }
  ]
}
```

## Show

Retrieve a specific template.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Templates\Show;

$endpoint = new Show($client);
$response = $endpoint->get('ae17d458-fa63-11e9-83fe-0a58646001fd');

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\ShowTemplate;
$response = ShowTemplate::get('ae17d458-fa63-11e9-83fe-0a58646001fd');
```

**Response**

```php
Collection {#239 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
      +"name": "New Template"
      +"body": "This is the updated body content with a ::LINK:: OPTOUT"
      +"links": []
      +"is_locked": false
      +"sender": "Digitonic"
      +"created_at": "2019-10-29 15:49:24"
      +"updated_at": "2019-10-29 15:56:01"
    }
  ]
}
```

## Delete

Delete a template.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Templates\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('ae17d458-fa63-11e9-83fe-0a58646001fd');

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\DeleteTemplate;
$response = DeleteTemplate::delete('ae17d458-fa63-11e9-83fe-0a58646001fd');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of templates.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Templates\Index;

$endpoint = new Index($client);
$response = $endpoint->paginate(20)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\RetrieveTemplates;
$response = RetrieveTemplates::paginate(20)->get();
```

**Response**

```php
Collection {#237 ▼
  #items: array:3 [▼
    "data" => array:2 [▼
      0 => {#238 ▼
        +"uuid": "ae17d458-fa63-11e9-83fe-0a58646001fd"
        +"name": "New Template"
        +"body": "This is the updated body content with a ::LINK:: OPTOUT"
        +"links": []
        +"is_locked": false
        +"sender": "Digitonic"
        +"created_at": "2019-10-29 15:49:24"
        +"updated_at": "2019-10-29 15:56:01"
      }
      1 => {#236 ▼
        +"uuid": "bedf2e8a-f653-11e9-bcd4-0a58646002d9"
        +"name": "Testing"
        +"body": "test"
        +"links": array:1 [▶]
        +"is_locked": false
        +"sender": "QA_Test_Tea"
        +"created_at": "2019-10-24 12:45:15"
        +"updated_at": "2019-10-24 12:45:15"
      }
    ]
    "links" => {#227 ▼
      +"first": "https://passona.co.uk/api/2.0/templates?page=1"
      +"last": "https://passona.co.uk/api/2.0/templates?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#224 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/templates"
      +"per_page": "20"
      +"to": 2
      +"total": 2
    }
  ]
}
```

## Preview

Preview a template as it would be displayed on the end recipients handset with link placeholders and custom fields replaced with their
respective real counterparts.

**Example**

```php
use \Digitonic\PassonaClient\Entities\Templates\Preview;

$endpoint = new Preview($client);
$response = $endpoint->get('bedf2e8a-f653-11e9-bcd4-0a58646002d9');

// Laravel
use \Digitonic\PassonaClient\Facades\Templates\PreviewTemplate;
$response = PreviewTemplate::get('bedf2e8a-f653-11e9-bcd4-0a58646002d9');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "bedf2e8a-f653-11e9-bcd4-0a58646002d9"
      +"name": "Testing"
      +"body": "Here is an example of a populated http://www.google.co.uk"
      +"links": array:1 [▶]
      +"is_locked": false
      +"sender": "QA_Test_Tea"
      +"created_at": "2019-10-24 12:45:15"
      +"updated_at": "2019-10-24 12:45:15"
    }
  ]
}
```

