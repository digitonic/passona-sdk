<?php


namespace Digitonic\PassonaClient\Mappers\Requests;


use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest as TemplateRequestInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\TemplateRequestMapper as TemplateRequestMapperInterface;
use Digitonic\PassonaClient\Entities\TemplateRequest;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class TemplateRequestMapper implements TemplateRequestMapperInterface
{
    /**
     * @var LinkRequestMapper
     */
    private $linkMapper;

    public function __construct(LinkRequestMapper $linkRequestMapper)
    {
        $this->linkMapper = $linkRequestMapper;
    }

    /**
     * @param TemplateRequestInterface $template
     * @return array
     */
    public function toArray(TemplateRequestInterface $template): array
    {
        $templateRequestArray = [
            'name' => $template->getName(),
            'body' => $template->getBody(),
            'links' => []
        ];

        foreach($template->getLinks() as $link){
            $templateRequestArray['links'][] = $this->linkMapper->toArray($link);
        }

        return $templateRequestArray;
    }

    /**
     * @param array $templateParameters
     * @param string $templateRequestClass
     * @return TemplateRequestInterface
     */
    public function fromArray(array $templateParameters, string $templateRequestClass = TemplateRequest::class): TemplateRequestInterface
    {
        $reflectionClass = new \ReflectionClass($templateRequestClass);
        $this->validateTemplateRequestClass($reflectionClass);

        /** @var TemplateRequestInterface $templateRequest */
        $templateRequest = $reflectionClass->newInstance();
        $templateRequest->setName($templateParameters['name']);
        $templateRequest->setBody($templateParameters['body']);

        $linkRequests = [];
        foreach($templateParameters['links'] as $linkRequestParameter){
            $linkRequests[] = $this->linkMapper->fromArray($linkRequestParameter);
        }

        $templateRequest->setLinks($linkRequests);

        return $templateRequest;
    }

    /**
     * @param TemplateRequestInterface $template
     * @return \stdClass
     */
    public function toStdClass(TemplateRequestInterface $template): \stdClass
    {
        $templateRequestStdClass = new \stdClass();
        $templateRequestStdClass->name = $template->getName();
        $templateRequestStdClass->body = $template->getBody();
        $templateRequestStdClass->links = [];

        foreach($template->getLinks() as $link){
            $templateRequestStdClass->links[] = $this->linkMapper->toStdClass($link);
        }

        return $templateRequestStdClass;
    }

    /**
     * @param \stdClass $templateRequestParameters
     * @param string $templateRequestClass
     * @return TemplateRequestInterface
     */
    public function fromStdClass(\stdClass $templateRequestParameters, string $templateRequestClass = TemplateRequest::class): TemplateRequestInterface
    {
        $reflectionClass = new \ReflectionClass($templateRequestClass);
        $this->validateTemplateRequestClass($reflectionClass);

        /** @var TemplateRequestInterface $templateRequest */
        $templateRequest = $reflectionClass->newInstance();
        $templateRequest->setName($templateRequestParameters->name);
        $templateRequest->setBody($templateRequestParameters->body);

        $linkRequests = [];
        foreach($templateRequestParameters->links as $linkRequestParameter){
            $linkRequests[] = $this->linkMapper->fromStdClass($linkRequestParameter);
        }

        $templateRequest->setLinks($linkRequests);

        return $templateRequest;
    }

    /**
     * @param TemplateRequestInterface $templateRequest
     * @return string
     */
    public function toJson(TemplateRequestInterface $templateRequest): string
    {
        return json_encode($this->toArray($templateRequest));
    }

    /**
     * @param string $templateRequestParameters
     * @param string $templateRequestClass
     * @return TemplateRequestInterface
     */
    public function fromJson(string $templateRequestParameters, string $templateRequestClass = TemplateRequest::class): TemplateRequestInterface
    {
        return $this->fromArray(json_decode($templateRequestParameters, true), $templateRequestClass);
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateTemplateRequestClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(TemplateRequestInterface::class)) {
            throw new InterfaceImplementationException(TemplateRequestInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}