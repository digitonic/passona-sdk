<?php


namespace Tests\MockObjects;


use Digitonic\PassonaClient\Contracts\Clients\HttpClient;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Tests\MockObjects\CampaignResponses\GetAllCampaignsMockResponse;
use Tests\MockObjects\CampaignResponses\GetCampaignMockeResponse;
use Tests\MockObjects\CampaignResponses\PostOrPutCampaignMockResponse;
use Tests\MockObjects\ContactGroupResponses\GetAllContactGroupsMockResponse;
use Tests\MockObjects\ContactGroupResponses\PostOrPutContactGroupMockResponse;
use Tests\MockObjects\ContactResponses\DeleteContactMockResponse;
use Tests\MockObjects\ContactResponses\GetAllContactsMockResponse;
use Tests\MockObjects\ContactResponses\GetContactMockResponse;
use Tests\MockObjects\DeleteMockResponse;
use Tests\MockObjects\TemplatesResponses\GetAllTemplatesMockResponse;
use Tests\MockObjects\TemplatesResponses\GetTemplateMockResponse;
use Tests\MockObjects\TemplatesResponses\PostOrPutTemplateMockResponse;
use Tests\MockObjects\TemplatesResponses\UpsertContactMockResponse;
use Tests\MockObjects\VanityDomainResponse\GetAllVanityDomainsMockResponse;

class MockClient extends Client implements HttpClient
{
    /**
     * @param \Psr\Http\Message\UriInterface|string $uri
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function get( $uri, array $options = []): ResponseInterface
    {
        $uri = explode('/', $uri);

        switch ($uri[0]) {
            case 'vanity-domains':
                return new GetAllVanityDomainsMockResponse('');
                break;
            case 'templates':
                if (!isset($uri[1])) {
                    return new GetAllTemplatesMockResponse('');
                } elseif ($uri[1] == 1) {
                    return new GetTemplateMockResponse('');
                }
                break;
            case 'groups':
                if (isset($uri[3]) && isset($uri[1]) && $uri[1] == 1 && $uri[3] == 1) {
                    return new GetContactMockResponse('');
                } else if (isset($uri[1]) && $uri[1] == 1) {
                    return new GetAllContactsMockResponse('');
                } else {
                    return new GetAllContactGroupsMockResponse('');
                }
                break;
            case 'campaigns':
                if (isset($uri[1]) && $uri[1] == 1){
                    return new GetCampaignMockeResponse('');
                } else {
                    return new GetAllCampaignsMockResponse('');
                }
                break;
            default:
                return null;
        }
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        if (!isset($options['json'])) {
            throw new \Exception('json not set');
        }

        $uri = explode('/', $uri);

        switch ($uri[0]) {
            case 'templates':
                return new PostOrPutTemplateMockResponse(json_encode($options['json']));
                break;
            case 'groups':
                if (isset($uri[1])) {
                    return new UpsertContactMockResponse(json_encode($options['json']));
                } else {
                    return new PostOrPutContactGroupMockResponse(json_encode($options['json']));
                }
                break;
            case 'campaigns':
                return new PostOrPutCampaignMockResponse(json_encode($options['json']));
                break;
        }
    }

    public function put($uri, array $options = []): ResponseInterface
    {
        if (!isset($options['json'])) {
            throw new \Exception('json not set');
        }

        $uri = explode('/', $uri);

        switch ($uri[0]) {
            case "templates":
                return new PostOrPutTemplateMockResponse(json_encode($options['json']));
                break;
            case "groups":
                return new PostOrPutContactGroupMockResponse(json_encode($options['json']));
                break;
            case "campaigns":
                return new PostOrPutCampaignMockResponse(json_encode($options['json']));
                break;
        }
    }

    public function delete($uri, array $options = []): ResponseInterface
    {
        return new DeleteMockResponse('');
    }
}