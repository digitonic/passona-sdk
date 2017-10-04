<?php


namespace Tests\MockObjects\TemplatesResponses;


use Tests\MockObjects\ContactResponses\ContactMockResponse;

class UpsertContactMockResponse extends ContactMockResponse
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
        "status": 2,
        "phoneNumberIndex": 0,
        "createdAt": {
            "date": "2017-09-26 13:46:52.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "uploadedCsvFile": {
            "data": {
                "id": 1,
                "filename": "my-hash.txt",
                "filesize": "25.00 B",
                "columnCount": 1,
                "numRows": "1",
                "headings": [
                    "phoneNumber"
                ],
                "rows": [
                    [
                        "447123456789"
                    ],
                    [],
                    [],
                    [],
                    []
                ],
                "originalFilename": "my-hash.txt",
                "possiblePhoneColumns": [
                    0
                ]
            }
        }
    },
    "meta": {
        "execution_time": 1.4918148517608643
    }
}';
    }
}