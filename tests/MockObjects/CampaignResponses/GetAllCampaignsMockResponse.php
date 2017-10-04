<?php


namespace Tests\MockObjects\CampaignResponses;


use Tests\MockObjects\MockResponse;

class GetAllCampaignsMockResponse extends MockResponse
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
              "name": "my first campaign",
              "messageTemplate": "my body is ready",
              "sender": "sender",
              "scheduledSend": true,
              "statusCode": 2,
              "statusDescription": "Pending",
              "startedSendingAt": "2017-09-26T14:32:14+01:00",
              "isViewable": false,
              "isEditable": false,
              "isDeletable": false,
              "createdAt": "2017-09-26T16:27:02+01:00",
              "updatedAt": "2017-09-26T16:27:20+01:00",
              "recipientType": "groups",
              "includedContactGroupIds": [
                1
              ],
              "excludedContactGroupIds": [
                2
              ],
              "scheduledSendDate": "2017-09-26T14:30:21+01:00",
              "expiryDate": "2017-09-27T16:28:33+01:00",
              "body": "my body is ready",
              "finishedSendingAt": "2017-09-26T16:29:39+01:00",
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
            {
              "id": 2,
              "name": "my second campaign",
              "messageTemplate": "my body is also ready",
              "sender": "Bernie",
              "scheduledSend": false,
              "statusCode": 1,
              "statusDescription": "Queued",
              "startedSendingAt": "2017-09-26T14:32:14+01:00",
              "isViewable": false,
              "isEditable": false,
              "isDeletable": false,
              "createdAt": "2017-09-26T16:27:02+01:00",
              "updatedAt": "2017-09-26T16:27:20+01:00",
              "recipientType": "numbers",
              "includedContactGroupIds": [],
              "excludedContactGroupIds": [],
              "scheduledSendDate": "2017-09-06T12:00:00+01:00",
              "expiryDate": "2017-09-27T16:28:33+01:00",
              "recipients": "447123456789,447987654321",
              "body": "my body is also ready",
              "finishedSendingAt": "2017-09-26T16:29:39+01:00",
              "numberOfRecipients": 10,
              "links": {
                "data": []
              }
            }
          ],
          "meta": {
            "execution_time": 0.7430419921875
          }
        }';
    }
}