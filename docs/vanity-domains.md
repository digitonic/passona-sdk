# Vanity Domains

## Explanation
Vanity domains are shorthand http links redirecting to external target urls (e.g. http://google.com) and are used to monitor recipient clicks. They are displayed to recipients within the message template body.
Trackers will be appended to these links to allow tracking of clicks to provide metrics for your campaigns.

Vanity domains can either belong to Digitonic or the user of Passona can specify their own domain and point it towards our name servers.

All teams by default will have access to `https://psms.io` for use as a vanity domain.

**Vanity Domains are subject to moderation by Digitonic**


## Create
Create a new vanity domain for your current team.

`Nameservers` and `zone_id` can take time to update and will not be immediately populated upon creation.

**Example**

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Create;

$data = [
    'domain' => 'https://vani.io'
];

$endpoint = new Create($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\VanityDomains\CreateVanityDomain;
$response = CreateVanityDomain::setPayload($data)->post();
```

or use the built-in setters

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Create;

$endpoint = new Create($client);
$endpoint->setDomain('https://vani.io');

$response = $endpoint->post();
```


**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "55fb450c-fb03-11e9-b23a-0a586460022b"
      +"domain": "https://vani.io"
      +"dns_status": "Pending Validation"
      +"nameservers": "[]"
      +"status": "1"
      +"created_at": "2019-10-30 10:52:15"
      +"updated_at": "2019-10-30 10:52:15"
      +"zone_id": ""
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/vanity-domains/55fb450c-fb03-11e9-b23a-0a586460022b"
        }
      ]
    }
  ]
}
```

## Update

Update a vanity domain for your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Update;

$data = [
    'domain' => 'https://vaniup.io'
];

$endpoint = new Update($client);
$response = $endpoint->setPayload($data)->put('55fb450c-fb03-11e9-b23a-0a586460022b');

// Laravel
use \Digitonic\PassonaClient\Facades\VanityDomains\UpdateVanityDomain;
$response = UpdateVanityDomain::setPayload($data)->put('55fb450c-fb03-11e9-b23a-0a586460022b');
```

or use the built-in setters

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Update;

$endpoint = new Update($client);
$endpoint->setDomain('https://vaniup.io');

$response = $endpoint->put('55fb450c-fb03-11e9-b23a-0a586460022b');
```


**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "7ba996f0-fb03-11e9-b29e-0a586460022b"
      +"domain": "https://vaniup.io"
      +"dns_status": "Pending Validation"
      +"nameservers": "[]"
      +"status": "1"
      +"created_at": "2019-10-30 10:53:18"
      +"updated_at": "2019-10-30 10:55:43"
      +"zone_id": ""
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/vanity-domains/7ba996f0-fb03-11e9-b29e-0a586460022b"
        }
      ]
    }
  ]
}
```

## Show

Retrieve a specific keyword.

**Example**

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Show;

$endpoint = new Show($client);
$response = $endpoint->get('7ba996f0-fb03-11e9-b29e-0a586460022b');

// Laravel
use \Digitonic\PassonaClient\Facades\VanityDomains\ShowVanityDomain;
$response = ShowVanityDomain::get('7ba996f0-fb03-11e9-b29e-0a586460022b');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "7ba996f0-fb03-11e9-b29e-0a586460022b"
      +"domain": "https://vaniup.io"
      +"dns_status": "Pending Validation"
      +"nameservers": "[]"
      +"status": "1"
      +"created_at": "2019-10-30 10:53:18"
      +"updated_at": "2019-10-30 10:55:43"
      +"zone_id": ""
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/vanity-domains/7ba996f0-fb03-11e9-b29e-0a586460022b"
        }
      ]
    }
  ]
}
```

## Delete

Delete a vanity domain from use with your current team.

**Example**

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('7ba996f0-fb03-11e9-b29e-0a586460022b');

// Laravel
use \Digitonic\PassonaClient\Facades\VanityDomains\DeleteVanityDomain;
$response = DeleteVanityDomain::delete('7ba996f0-fb03-11e9-b29e-0a586460022b');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of vanity domains.

**Example**

```php
use \Digitonic\PassonaClient\Entities\VanityDomains\Index;

$endpoint = new Index($client);
$response = $endpoint->paginate(20, 1)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\VanityDomains\RetrieveVanityDomains;
$response = RetrieveVanityDomains::paginate(20, 1)->get();
```

**Response**

```php
Collection {#230 ▼
  #items: array:3 [▼
    "data" => array:2 [▼
      0 => {#238 ▼
        +"uuid": "4d47ca82-f63c-11e9-a674-0a58646002d8"
        +"domain": "https://psms.io"
        +"dns_status": "Pending Validation"
        +"nameservers": "[]"
        +"status": "1"
        +"created_at": "2019-10-24 09:57:26"
        +"updated_at": "2019-10-24 09:57:26"
        +"zone_id": ""
        +"links": array:1 [▼
          0 => {#236 ▼
            +"rel": "self"
            +"uri": "https://passona.co.uk/api/2.0/vanity-domains/4d47ca82-f63c-11e9-a674-0a58646002d8"
          }
        ]
      }
      1 => {#239 ▼
        +"uuid": "7ba996f0-fb03-11e9-b29e-0a586460022b"
        +"domain": "https://vaniup.io"
        +"dns_status": "Pending Validation"
        +"nameservers": "[]"
        +"status": "1"
        +"created_at": "2019-10-30 10:53:18"
        +"updated_at": "2019-10-30 10:55:43"
        +"zone_id": ""
        +"links": array:1 [▶]
      }
    ]
    "links" => {#224 ▼bv
      +"first": "https://passona.co.uk/api/2.0/vanity-domains?page=1"
      +"last": "https://passona.co.uk/api/2.0/vanity-domains?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#237 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/vanity-domains"
      +"per_page": "20"
      +"to": 2
      +"total": 2
    }
  ]
}
```

