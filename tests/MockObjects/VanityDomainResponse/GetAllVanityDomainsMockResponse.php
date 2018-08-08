<?php


namespace Tests\MockObjects\VanityDomainResponse;

use Tests\MockObjects\MockResponse;

class GetAllVanityDomainsMockResponse extends MockResponse
{


    public function __construct($json)
    {
        parent::__construct(
            200,
            $json
        );
    }

    protected function constructBody(string $json): string
    {
        return '{
            "data":[
                {
                    "id":1,
                    "status":1,
                    "nameservers":[
                        "ns-1234.awsdns-27.com.",
                        "ns-1234.awsdns-27.com.",
                        "ns-1234.awsdns-27.com.",
                        "ns-1234.awsdns-27.com."],
                    "domain":"short.co.uk",
                    "hostedZoneId":"W3ZINZHDBUK2"
                },
                {
                    "id":2,
                    "status":0,
                    "nameservers":[
                        "ns-1234.awsdns-56.com.",
                        "ns-1234.awsdns-56.com.",
                        "ns-1234.awsdns-56.com.",
                        "ns-1234.awsdns-56.com."
                    ],
                    "domain":"long.co.uk",
                    "hostedZoneId":"I72KUBDHZNIZ"
                }
            ],
            "meta":{
                "execution_time":1.2160279750823975
            }
        }';
    }
}