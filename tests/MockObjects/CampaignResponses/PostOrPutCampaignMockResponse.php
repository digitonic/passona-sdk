<?php


namespace Tests\MockObjects\CampaignResponses;


use Tests\MockObjects\MockResponse;

class PostOrPutCampaignMockResponse extends MockResponse
{
    public function __construct(string $json)
    {
        parent::__construct(200, $json);
    }


    protected function constructBody(string $json): string
    {
        $jsonDecoded = json_decode($json);

        return '
        {
          "data": {
              "id": 1,
              "name": "'.$jsonDecoded->name.'",
              "messageTemplate": "my body is ready",
              "sender": "'.$jsonDecoded->sender.'",
              "scheduledSend": true,
              "statusCode": 2,
              "statusDescription": "Pending",
              "startedSendingAt": "2017-09-26T14:32:14.000000+0100",
              "isViewable": false,
              "isEditable": false,
              "isDeletable": false,
              "createdAt": "2017-09-26T16:27:02.000000+0100",
              "updatedAt": "2017-09-26T16:27:20.000000+0100",
              "recipientType": "'.$jsonDecoded->recipientType.'",
              "includedContactGroupIds": [
                1
              ],
              "excludedContactGroupIds": [
                2
              ],
              "scheduledSendDate": "'.$jsonDecoded->scheduledSendDate.'+01:00",
              "expiryDate": "'.$jsonDecoded->expiryDate.'+01:00",
              "body": "'.$jsonDecoded->body.'",
              "finishedSendingAt": "2017-09-26T16:29:39.000000+0100",
              "numberOfRecipients": 1,
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
                  },
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
            },
          "meta": {
            "execution_time": 0.7430419921875
          }
        }';
    }
}