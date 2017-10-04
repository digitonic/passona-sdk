<?php


namespace Digitonic\PassonaClient\Controllers;


use Digitonic\PassonaClient\Contracts\Controllers\ContactGroupController as ContactGroupControllerInterface;
use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\ContactGroupRequestMapper;
use Digitonic\PassonaClient\Mappers\Responses\ContactGroupResponseMapper;
use Psr\Http\Message\ResponseInterface;

class ContactGroupController extends Controller implements ContactGroupControllerInterface
{
    /**
     * @var ContactGroupResponseMapper
     */
    private $contactGroupResponseMapper;

    /**
     * @var ContactGroupRequestMapper
     */
    private $contactGroupRequestMapper;

    /**
     * @return array
     */
    public function getAllContactGroups(): array
    {
        $response = $this->client->get('groups', ['headers' => $this->headers]);

        return $this->convertMultipleContactGroupResponse($response);
    }

    /**
     * @param ContactGroupRequest $contactGroupRequest
     * @return ContactGroupResponse
     */
    public function postContactGroup(ContactGroupRequest $contactGroupRequest): ContactGroupResponse
    {
        $response = $this->client->post('groups', [
            'headers' => $this->headers,
            'json' => $this->contactGroupRequestMapper->toArray($contactGroupRequest)
        ]);

        return $this->convertSingleContactGroupResponse($response);
    }

    /**
     * @param int $groupId
     * @param ContactGroupRequest $contactGroupRequest
     * @return ContactGroupResponse
     */
    public function putContactGroup(int $groupId, ContactGroupRequest $contactGroupRequest): ContactGroupResponse
    {
        $response = $this->client->put("groups/{$groupId}", [
            'headers' => $this->headers,
            'json' => $this->contactGroupRequestMapper->toArray($contactGroupRequest)
        ]);

        return $this->convertSingleContactGroupResponse($response);
    }

    /**
     * @param int $groupId
     * @return bool
     */
    public function deleteContactGroup(int $groupId): bool
    {
        $response = $this->client->delete("groups/{$groupId}", [
            'headers' => $this->headers
        ]);

        return $response->getStatusCode() === 204;
    }

    /**
     * @param ContactGroupResponseMapper $contactGroupResponseMapper
     */
    public function setContactGroupResponseMapper(ContactGroupResponseMapper $contactGroupResponseMapper)
    {
        $this->contactGroupResponseMapper = $contactGroupResponseMapper;
    }

    /**
     * @param ContactGroupRequestMapper $contactGroupRequestMapper
     */
    public function setContactGroupRequestMapper(ContactGroupRequestMapper $contactGroupRequestMapper)
    {
        $this->contactGroupRequestMapper = $contactGroupRequestMapper;
    }

    /**
     * @param ResponseInterface $response
     * @return ContactGroupResponse
     */
    private function convertSingleContactGroupResponse(ResponseInterface $response): ContactGroupResponse
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        return $this->contactGroupResponseMapper->fromStdClass($decodedResponse->data);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function convertMultipleContactGroupResponse(ResponseInterface $response): array
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        $contactResponses = [];
        foreach ($decodedResponse->data as $datum) {
            $contactResponses[] = $this->contactGroupResponseMapper->fromStdClass($datum);
        }

        return $contactResponses;
    }
}