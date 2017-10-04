<?php


namespace Digitonic\PassonaClient\Controllers;


use Digitonic\PassonaClient\Contracts\Controllers\VanityDomainController as VanityDomainControllererInterface;
use Digitonic\PassonaClient\Mappers\Responses\VanityDomainResponseMapper;
use Psr\Http\Message\ResponseInterface;

class VanityDomainController extends Controller implements VanityDomainControllererInterface
{
    /**
     * @var VanityDomainResponseMapper
     */
    private $vanityDomainMapper;

    /**
     * @return array
     */
    public function getAllVanityDomains(): array
    {
        $rawResponse = $this->client->get('vanity-domains', ['headers' => $this->headers]);

        return $this->formatMultipleVanityDomainResponses($rawResponse);
    }

    /**
     * @param VanityDomainResponseMapper $vanityDomainMapper
     */
    public function setVanityDomainMapper(VanityDomainResponseMapper $vanityDomainMapper)
    {
        $this->vanityDomainMapper = $vanityDomainMapper;
    }

    /**
     * @param ResponseInterface $rawResponse
     * @return array
     */
    private function formatMultipleVanityDomainResponses(ResponseInterface $rawResponse): array
    {
        $decodedResponse = json_decode($rawResponse->getBody()->getContents());

        $vanityDomainResponses = [];
        foreach ($decodedResponse->data as $datum) {
            $vanityDomainResponses[] = $this->vanityDomainMapper->fromStdClass($datum);
        }

        return $vanityDomainResponses;
    }


}