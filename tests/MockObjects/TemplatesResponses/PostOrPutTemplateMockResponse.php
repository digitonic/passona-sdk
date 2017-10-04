<?php


namespace Tests\MockObjects\TemplatesResponses;

class PostOrPutTemplateMockResponse extends TemplateMockResponse
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
        $jsonDecoded = json_decode($json);

        return '
    {
        "data": {
            "id": 1,
            "name": "'.$jsonDecoded->name.'",
            "body": "Test 1",
            "links": {
                "data": [
                    {
                        "id": 1,
                        "name": "my link",
                        "destination": "http://my.destination.co.uk",
                        "vanityDomainId": 1,
                        "vanityDomainDomain": "my-domain",
                        "deleted": false,
                        "vanityDomain": {
                            "data": {
                                "id": 1,
                                "status": 1,
                                "nameservers": [
                                    "my nameserver"
                                ],
                                "domain": "my-domain",
                                "hostedZoneId": "my hosted zone id"
                            }
                        }
                    }
                ]
            }
        },
        "meta": {
            "execution_time": 1.107835054397583
        }
    }';
    }
}