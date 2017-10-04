<?php


namespace Tests\MockObjects\ContactResponses;


class GetContactMockResponse extends ContactMockResponse
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
            "data": {
                "id": 1,
                "phoneNumber": "447123456789",
                "updatedAt": "2017-09-25 15:15:08",
                "customFields": {
                    "firstname": "yannick"
                }
            },
            "meta": {
                "execution_time": 1.107835054397583
            }
        }
        ';
    }
}