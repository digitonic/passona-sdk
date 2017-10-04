<?php


namespace Tests\MockObjects\ContactGroupResponses;


use Tests\MockObjects\MockResponse;

class PostOrPutContactGroupMockResponse extends MockResponse
{

    public function __construct(string $json)
    {
        parent::__construct(
            200,
            $json
        );
    }

    protected function constructBody(string $json): string
    {
        $jsonDecoded = json_decode($json);

        return '
        {
            "data": {
                "id": 1,
                "name": "'.$jsonDecoded->name.'",
                "description": "Description for my group 1",
                "fields": ["firstName", "lastName"],
                "numberOfUniqueProfiles": "1",
                "createdAt": "2017-09-26T14:43:52+00:00",
                "updatedAt": "2017-09-26T14:44:15+00:00",
                "numberOfContacts": "1"
            },
            "meta": {
                "execution_time": 1.4226830005645752
            }
        }
        ';
    }
}