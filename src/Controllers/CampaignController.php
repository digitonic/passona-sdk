<?php


namespace Digitonic\PassonaClient\Controllers;


use Digitonic\PassonaClient\Contracts\Controllers\CampaignController as CampaignControllerInterface;
use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\CampaignRequestMapper;
use Digitonic\PassonaClient\Mappers\Responses\CampaignResponseMapper;
use Psr\Http\Message\ResponseInterface;

class CampaignController extends Controller implements CampaignControllerInterface
{
    /**
     * @var CampaignResponseMapper
     */
    private $campaignResponseMapper;

    /**
     * @var CampaignRequestMapper
     */
    private $campaignRequestMapper;


    /**
     * @return array
     */
    public function getAllCampaigns(): array
    {
        $response = $this->client->get('campaigns', ['headers' => $this->headers]);

        return $this->formatMultipleCampaignResponses($response);
    }

    /**
     * @param int $campaignId
     * @return CampaignResponse
     */
    public function getCampaign(int $campaignId): CampaignResponse
    {
        $response = $this->client->get("campaigns/{$campaignId}", ['headers' => $this->headers]);

        return $this->formatSingleCampaignResponse($response);
    }

    /**
     * @param CampaignRequest $campaignRequest
     * @return CampaignResponse
     */
    public function postCampaign(CampaignRequest $campaignRequest): CampaignResponse
    {
        $response = $this->client->post('campaigns', [
            'headers' => $this->headers,
            'json' => $this->campaignRequestMapper->toArray($campaignRequest)
            ]
        );

        return $this->formatSingleCampaignResponse($response);
    }

    /**
     * @param int $campaignId
     * @param CampaignRequest $campaignRequest
     * @return CampaignResponse
     */
    public function putCampaign(int $campaignId, CampaignRequest $campaignRequest): CampaignResponse
    {
        $response = $this->client->put("campaigns/{$campaignId}", [
                'headers' => $this->headers,
                'json' => $this->campaignRequestMapper->toArray($campaignRequest)
            ]
        );

        return $this->formatSingleCampaignResponse($response);
    }

    /**
     * @param int $campaignId
     * @return bool
     */
    public function deleteCampaign(int $campaignId): bool
    {
        $response = $this->client->delete("campaigns/{$campaignId}", ['headers' => $this->headers]);

        return $response->getStatusCode() === 204;
    }

    /**
     * @param CampaignResponseMapper $campaignResponseMapper
     */
    public function setCampaignResponseMapper(CampaignResponseMapper $campaignResponseMapper)
    {
        $this->campaignResponseMapper = $campaignResponseMapper;
    }

    /**
     * @param CampaignRequestMapper $campaignRequestMapper
     */
    public function setCampaignRequestMapper(CampaignRequestMapper $campaignRequestMapper)
    {
        $this->campaignRequestMapper = $campaignRequestMapper;
    }

    /**
     * @param ResponseInterface $response
     * @return CampaignResponse
     */
    private function formatSingleCampaignResponse(ResponseInterface $response): CampaignResponse
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        return $this->campaignResponseMapper->fromStdClass($decodedResponse->data);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function formatMultipleCampaignResponses(ResponseInterface $response): array
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        $campaignResponses = [];
        foreach ($decodedResponse->data as $datum) {
            $campaignResponses[] = $this->campaignResponseMapper->fromStdClass($datum);
        }

        return $campaignResponses;
    }
}