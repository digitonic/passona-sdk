<?php


namespace Tests\MockObjects\ContactGroupResponses;


use Tests\MockObjects\MockResponse;

class GetAllContactGroupsMockResponse extends MockResponse
{

    public function __construct(string $json)
    {
        parent::__construct(200, $json);
    }

    protected function constructBody(string $json): string
    {
        return '
        {
            "data": [
                {
                    "id": 1,
                    "name": "my group 1",
                    "description": "Description for my group 1",
                    "fields": [
                        "firstName", 
                        "lastName"
                    ],
                    "numberOfUniqueProfiles": "1",
                    "createdAt": "2017-09-26T14:43:52+01:00",
                    "updatedAt": "2017-09-26T14:44:15+01:00",
                    "numberOfContacts": "1"
                },
                {
                    "id": 2,
                    "name": "my group 2",
                    "description": "Description for my group 2",
                    "fields": [
                        "firstName", 
                        "lastName"
                    ],
                    "numberOfUniqueProfiles": "1",
                    "createdAt": "2017-09-26T14:43:52+01:00",
                    "updatedAt": "2017-09-26T14:44:15+01:00",
                    "numberOfContacts": "1"
                }
            ],
            "meta": {
                "execution_time": 1.3447248935699463
            }
        }';
    }
}