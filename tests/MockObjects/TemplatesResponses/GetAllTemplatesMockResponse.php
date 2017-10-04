<?php


namespace Tests\MockObjects\TemplatesResponses;


class GetAllTemplatesMockResponse extends TemplateMockResponse
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
                "name": "Test 1",
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
            {
                "id": 2,
                "name": "Test 2",
                "body": "Test 2",
                "links": {
                    "data": [
                        {
                            "id": 2,
                            "name": "my link 2",
                            "destination": "http://my.destination.com",
                            "vanityDomainId": 2,
                            "vanityDomainDomain": "my-domain 2",
                            "deleted": false,
                            "vanityDomain": {
                                "data": {
                                    "id": 2,
                                    "status": 0,
                                    "nameservers": [
                                        "my nameserver 2"
                                    ],
                                    "domain": "my-domain 2",
                                    "hostedZoneId": "my hosted zone id 2"
                                }
                            }
                        }
                    ]
                }
            }
        ],
        "meta": {
            "execution_time": 1.107835054397583
        }
    }';
    }
}