<?php


namespace Digitonic\PassonaClient\Controllers;


use Digitonic\PassonaClient\Contracts\Controllers\ContactController as ContactControllerInterface;
use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\ContactRequestMapper;
use Digitonic\PassonaClient\Mappers\Responses\ContactResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\ContactUploadResponseMapper;
use Psr\Http\Message\ResponseInterface;

class ContactController extends Controller implements ContactControllerInterface
{
    /**
     * @var ContactResponseMapper
     */
    private $contactResponseMapper;

    /**
     * @var ContactRequestMapper
     */
    private $contactRequestMapper;

    /**
     * @var ContactUploadResponseMapper
     */
    private $contactUploadMapper;

    /**
     * @param int $groupId
     * @return array
     */
    public function getAllContactsInContactGroup(int $groupId): array
    {
        $response = $this->client->get("groups/{$groupId}/contacts", ['headers' => $this->headers]);

        return $this->convertMultipleContactResponses($response);
    }

    /**
     * @param int $groupId
     * @param int $contactId
     * @return ContactResponse
     */
    public function getContactInContactGroup(int $groupId, int $contactId): ContactResponse
    {
        $response = $this->client->get("groups/{$groupId}/contacts/{$contactId}", ['headers' => $this->headers]);

        return $this->convertSingleContactResponse($response);
    }

    /**
     * @param int $groupId
     * @param array $contacts
     * @return ContactUploadResponse
     */
    public function upsertContactsToContactGroup(int $groupId, array $contacts): ContactUploadResponse
    {
        $json = $this->createJsonInput($contacts);
        $response = $this->client->post("groups/{$groupId}/contacts", [
            'headers' => $this->headers,
            'json' => $json
        ]);

        return $this->convertSingleContactUploadResponse($response);
    }

    /**
     * @param int $groupId
     * @param string $phoneNumber
     * @return bool
     */
    public function deleteContactFromContactGroup(int $groupId, string $phoneNumber):  bool
    {
        $response = $this->client->delete("groups/{$groupId}/contacts/{$phoneNumber}", [
            'headers' => $this->headers
        ]);

        return $response->getStatusCode() === 204;
    }

    public function upsertGroupsToContact(int $contactId, array $contact, array $groups)
    {
        $json = json_encode(['groups' => $groups, 'contact' => $contact]);
        $response = $this->client->post("contact/{$contactId}/groups/", [
            'headers' => $this->headers,
            'json' => $json
        ]);

        return $response;
    }

    /**
     * @param ContactResponseMapper $contactResponseMapper
     */
    public function setContactResponseMapper(ContactResponseMapper $contactResponseMapper)
    {
        $this->contactResponseMapper = $contactResponseMapper;
    }

    /**
     * @param ContactUploadResponseMapper $contactUploadMapper
     */
    public function setContactUploadMapper(ContactUploadResponseMapper $contactUploadMapper)
    {
        $this->contactUploadMapper = $contactUploadMapper;
    }

    /**
     * @param ContactRequestMapper $contactRequestMapper
     */
    public function setContactRequestMapper(ContactRequestMapper $contactRequestMapper)
    {
        $this->contactRequestMapper = $contactRequestMapper;
    }

    /**
     * @param array $contacts
     * @return array
     */
    private function createJsonInput(array $contacts): array
    {
        $json = [
            'data' => []
        ];

        /** @var ContactRequest $contact */
        foreach ($contacts as $contact) {
            $json['data'][] = $this->contactRequestMapper->toArray($contact);
        }

        return $json;
    }

    /**
     * @param $response
     * @return array
     */
    private function convertMultipleContactResponses(ResponseInterface $response): array
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        $contactResponses = [];
        foreach ($decodedResponse->data as $datum) {
            $contactResponses[] = $this->contactResponseMapper->fromStdClass($datum);
        }

        return $contactResponses;
    }

    /**
     * @param ResponseInterface $response
     * @return ContactResponse
     */
    private function convertSingleContactResponse(ResponseInterface $response): ContactResponse
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        return $this->contactResponseMapper->fromStdClass($decodedResponse->data);
    }

    /**
     * @param ResponseInterface $response
     * @return ContactUploadResponse
     */
    private function convertSingleContactUploadResponse(ResponseInterface $response): ContactUploadResponse
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        return $this->contactUploadMapper->fromStdClass($decodedResponse->data);
    }
}