# Contact Groups

## Explanation
Contact groups are collections of contacts which are used to define which contact numbers will either be considered optins or optouts for a campaign.


## Create
Create a new empty contact group.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\Create;

$data = [
     'name' => 'SDK Contact Group',
     'description' => 'Created from the SDK',
];

$endpoint = new Create($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\CreateContactGroup;
$response = CreateContactGroup::setPayload($data)->post();
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "dffcefc8-fa52-11e9-b179-0a58646001fa"
      +"name": "SDK Contact Group"
      +"description": "Created from the SDK"
      +"created_at": "2019-10-29 13:49:06"
      +"updated_at": "2019-10-29 13:49:06"
      +"deletable": true
      +"number_of_contacts": 0
      +"scheduled_jobs_number": 0
      +"status": "Empty"
      +"headers": []
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/contact-groups/dffcefc8-fa52-11e9-b179-0a58646001fa"
        }
      ]
    }
  ]
}
```

## Update

Update a previously created contact group.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\Update;

$data = [
    'name' => 'SDK Contact Group Updated',
    'description' => 'Updated from the SDK.',
];

$endpoint = new Update($client);
$response = $endpoint->setPayload($data)->put('dffcefc8-fa52-11e9-b179-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\UpdateContactGroup;
$response = UpdateContactGroup::setPayload($data)->put('dffcefc8-fa52-11e9-b179-0a58646001fa');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "dffcefc8-fa52-11e9-b179-0a58646001fa"
      +"name": "SDK Contact Group Updated"
      +"description": "Updated from the SDK."
      +"created_at": "2019-10-29 13:49:06"
      +"updated_at": "2019-10-29 13:58:00"
      +"deletable": true
      +"number_of_contacts": 0
      +"scheduled_jobs_number": 0
      +"status": "Empty"
      +"headers": []
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/contact-groups/dffcefc8-fa52-11e9-b179-0a58646001fa"
        }
      ]
    }
  ]
}
```

## Show

Retrieve a specific contact group.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\Show;

$endpoint = new Show($client);
$response = $endpoint->get('dffcefc8-fa52-11e9-b179-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\ShowContactGroup;
$response = ShowContactGroup::put('dffcefc8-fa52-11e9-b179-0a58646001fa');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "dffcefc8-fa52-11e9-b179-0a58646001fa"
      +"name": "SDK Contact Group Updated"
      +"description": "Updated from the SDK."
      +"created_at": "2019-10-29 13:49:06"
      +"updated_at": "2019-10-29 14:23:59"
      +"deletable": true
      +"number_of_contacts": 1
      +"scheduled_jobs_number": 0
      +"status": "Ready"
      +"headers": array:2 [▼
        0 => "last_name"
        1 => "first_name"
      ]
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/contact-groups/dffcefc8-fa52-11e9-b179-0a58646001fa"
        }
      ]
    }
  ]
}
```

## Delete

Delete a previously created contact group.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\Delete;

$endpoint = new Delete($client);
$response = $endpoint->delete('dffcefc8-fa52-11e9-b179-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\DeleteContactGroup;
$response = DeleteContactGroup::delete('dffcefc8-fa52-11e9-b179-0a58646001fa');
```

**Response**

```php
Collection {#238 ▼
  #items: []
}
```

## Retrieve

Retrieve a paginated list of contact groups.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\Index;

$endpoint = new Index($client);
$response = $endpoint->paginate(20)->get();

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\RetrieveContactGroups;
$response = RetrieveContactGroups::paginate(20)->get();
```

**Response**

```php
Collection {#230 ▼
  #items: array:3 [▼
    "data" => array:2 [▼
      0 => {#238 ▼
        +"uuid": "dffcefc8-fa52-11e9-b179-0a58646001fa"
        +"name": "SDK Contact Group Updated"
        +"description": "Updated from the SDK."
        +"created_at": "2019-10-29 13:49:06"
        +"updated_at": "2019-10-29 14:00:07"
        +"deletable": true
        +"number_of_contacts": 0
        +"scheduled_jobs_number": 0
        +"status": "Empty"
        +"headers": []
        +"links": array:1 [▼
          0 => {#236 ▼
            +"rel": "self"
            +"uri": "https://passona.co.uk/api/2.0/contact-groups/dffcefc8-fa52-11e9-b179-0a58646001fa"
          }
        ]
      }
      1 => {#239 ▼
        +"uuid": "f213fd72-f986-11e9-970f-0a58646001df"
        +"name": "Basic Contact Group"
        +"description": "A basic contact group."
        +"created_at": "2019-10-28 13:29:19"
        +"updated_at": "2019-10-28 13:29:20"
        +"deletable": true
        +"number_of_contacts": 2
        +"scheduled_jobs_number": 0
        +"status": "Ready"
        +"headers": []
        +"links": array:1 [▼
          0 => {#233 ▼
            +"rel": "self"
            +"uri": "https://passona.co.uk/api/2.0/contact-groups/f213fd72-f986-11e9-970f-0a58646001df"
          }
        ]
      }
    ]
    "links" => {#224 ▼
      +"first": "https://passona.co.uk/api/2.0/contact-groups?page=1"
      +"last": "https://passona.co.uk/api/2.0/contact-groups?page=1"
      +"prev": null
      +"next": null
    }
    "meta" => {#237 ▼
      +"current_page": 1
      +"from": 1
      +"last_page": 1
      +"path": "https://passona.co.uk/api/2.0/contact-groups"
      +"per_page": "20"
      +"to": 2
      +"total": 2
    }
  ]
}
```

## Add Contacts

Add contacts to a pre-existing contact group.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\AddContacts;

$data = [
    [
        'contacts' => [
            [
                'phone_number' => '447713252151',
                'custom_fields' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe'
                ]
          ],
          [
              'phone_number' => '447711256854',
              'custom_fields' => [
                'first_name' => 'Jane',
                'last_name' => 'Doe'
              ]
          ]
      ]
  ]
];

$endpoint = new AddContacts($client);
$response = $endpoint->setPayload($data)->put('dffcefc8-fa52-11e9-b179-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\AddContactsToGroup;
$response = AddContactsToGroup::setPayload($data)->put('dffcefc8-fa52-11e9-b179-0a58646001fa');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "dffcefc8-fa52-11e9-b179-0a58646001fa"
      +"name": "SDK Contact Group Updated"
      +"description": "Updated from the SDK."
      +"created_at": "2019-10-29 13:49:06"
      +"updated_at": "2019-10-29 14:11:08"
      +"deletable": true
      +"number_of_contacts": 0
      +"scheduled_jobs_number": 1
      +"status": "Modifying"
      +"headers": []
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/contact-groups/dffcefc8-fa52-11e9-b179-0a58646001fa"
        }
      ]
    }
  ]
}
```

## Remove Contacts

Remove contacts from a pre-existing contact group.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\RemoveContacts;

$data = [
    'phone_numbers' => 
        [
            '447713252151'
        ]
  ]
];


$endpoint = new RemoveContacts($client);
$response = $endpoint->setPayload($data)->put('dffcefc8-fa52-11e9-b179-0a58646001fa');

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\RemoveContactsFromGroup;
$response = RemoveContactsFromGroup::setPayload($data)->put('dffcefc8-fa52-11e9-b179-0a58646001fa');
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "dffcefc8-fa52-11e9-b179-0a58646001fa"
      +"name": "SDK Contact Group Updated"
      +"description": "Updated from the SDK."
      +"created_at": "2019-10-29 13:49:06"
      +"updated_at": "2019-10-29 14:23:58"
      +"deletable": true
      +"number_of_contacts": 1
      +"scheduled_jobs_number": 1
      +"status": "Modifying"
      +"headers": array:2 [▼
        0 => "last_name"
        1 => "first_name"
      ]
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/contact-groups/dffcefc8-fa52-11e9-b179-0a58646001fa"
        }
      ]
    }
  ]
}
```

## Upload Bulk

Create a contact group with contacts in one request.

**Example**

```php
use \Digitonic\PassonaClient\Entities\ContactGroups\UploadBulkContacts;

$data = [
    'name' => 'Bulk Contact Group',
    'description' => 'A Bulk contact group.',
        'contacts' => [
            '447252625874',
            '447798521302'
        ]
    ]
];


$endpoint = new UploadBulkContacts($client);
$response = $endpoint->setPayload($data)->post();

// Laravel
use \Digitonic\PassonaClient\Facades\ContactGroups\UploadBulkContactsGroup;
$response = UploadBulkContactsGroup::setPayload($data)->post();
```

**Response**

```php
Collection {#233 ▼
  #items: array:1 [▼
    "data" => {#238 ▼
      +"uuid": "c9caf71c-fa58-11e9-b486-0a58646001fa"
      +"name": "Bulk Contact Group"
      +"description": "A Bulk contact group."
      +"created_at": "2019-10-29 14:31:26"
      +"updated_at": "2019-10-29 14:31:26"
      +"deletable": true
      +"number_of_contacts": 0
      +"scheduled_jobs_number": 1
      +"status": "Modifying"
      +"headers": []
      +"links": array:1 [▼
        0 => {#236 ▼
          +"rel": "self"
          +"uri": "https://passona.co.uk/api/2.0/contact-groups/c9caf71c-fa58-11e9-b486-0a58646001fa"
        }
      ]
    }
  ]
}
```


