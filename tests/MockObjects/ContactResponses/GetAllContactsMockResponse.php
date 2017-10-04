<?php


namespace Tests\MockObjects\ContactResponses;


class GetAllContactsMockResponse extends ContactMockResponse
{
    public function __construct(string $json)
    {
        parent::__construct(
            200,
            $json
        );
    }

    public function constructBody(string $json): string
    {
        return '
        {
        "data": [
            {
                "id": 1,
                "phoneNumber": "447123456789",
                "updatedAt": "2017-09-25 15:15:08",
                "customFields": {
                    "firstname": "yannick"
                }
            },
            {
                "id": 2,
                "phoneNumber": "447987654321",
                "updatedAt": "2017-09-25 15:15:40"
            }
        ],
        "meta": {
            "execution_time": 1.107835054397583
        }
    }
        ';
    }
}