<?php


namespace Digitonic\PassonaClient\Controllers;

use Digitonic\PassonaClient\Contracts\Controllers\TemplateController as TemplateControllerInterface;
use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\TemplateResponse;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\TemplateRequestMapper;
use Digitonic\PassonaClient\Mappers\Responses\TemplateResponseMapper;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class TemplateController extends Controller implements TemplateControllerInterface
{
    /**
     * @var TemplateResponseMapper
     */
    private $templateResponseMapper;

    /**
     * @var TemplateRequestMapper
     */
    private $templateRequestMapper;

    /**
     * @return array|TemplateResponse[]
     */
    public function getAllTemplates(): array
    {
        $rawResponse = $this->client->get('templates', ['headers' => $this->headers]);

        return $this->convertMultipleTemplateResponse($rawResponse);
    }

    /**
     * @param int $templateId
     * @return TemplateResponse
     */
    public function getTemplate(int $templateId): TemplateResponse
    {
        $rawResponse = $this->client->get("templates/{$templateId}", ['headers' => $this->headers]);

        return $this->convertSingleTemplateResponse($rawResponse);
    }

    /**
     * @param TemplateRequest $templateRequest
     * @return TemplateResponse
     */
    public function postTemplate(TemplateRequest $templateRequest): TemplateResponse
    {
        $rawResponse = $this->client->post('templates', [
            'headers' => $this->headers,
            'json' => $this->templateRequestMapper->toArray($templateRequest)
        ]);

        return $this->convertSingleTemplateResponse($rawResponse);
    }

    /**
     * @param int $templateId
     * @param TemplateRequest $templateRequest
     * @return TemplateResponse
     */
    public function putTemplate(int $templateId, TemplateRequest $templateRequest): TemplateResponse
    {
        $rawResponse = $this->client->put("templates/{$templateId}", [
            'headers' => $this->headers,
            'json' => $this->templateRequestMapper->toArray($templateRequest)
        ]);

        return $this->convertSingleTemplateResponse($rawResponse);
    }

    /**
     * @param int $templateId
     * @return bool
     */
    public function deleteTemplate(int $templateId): bool
    {
        $response = $this->client->delete("templates/{$templateId}", [
            'headers' => $this->headers,
        ]);

        return $response->getStatusCode() === 204;
    }

    /**
     * @param TemplateResponseMapper $templateResponseMapper
     */
    public function setTemplateResponseMapper(TemplateResponseMapper $templateResponseMapper)
    {
        $this->templateResponseMapper = $templateResponseMapper;
    }

    /**
     * @param TemplateRequestMapper $templateRequestMapper
     */
    public function setTemplateRequestMapper(TemplateRequestMapper $templateRequestMapper)
    {
        $this->templateRequestMapper = $templateRequestMapper;
    }

    /**
     * @param ResponseInterface $response
     * @return TemplateResponse
     */
    private function convertSingleTemplateResponse(ResponseInterface $response): TemplateResponse
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        return $this->templateResponseMapper->fromStdClass($decodedResponse->data);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function convertMultipleTemplateResponse(ResponseInterface $response): array
    {
        $decodedResponse = json_decode($response->getBody()->getContents());

        $templates = [];
        foreach ($decodedResponse->data as $data) {
            $template = $this->templateResponseMapper->fromStdClass($data);
            $templates[] = $template;
        }

        return $templates;
    }
}
