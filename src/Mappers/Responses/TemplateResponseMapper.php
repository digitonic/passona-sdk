<?php


namespace Digitonic\PassonaClient\Mappers\Responses;


use Digitonic\PassonaClient\Contracts\Entities\Responses\TemplateResponse as TemplateResponseInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\TemplateResponseMapper as TemplateResponseMapperInterface;
use Digitonic\PassonaClient\Entities\Responses\TemplateResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class TemplateResponseMapper implements TemplateResponseMapperInterface
{
    /**
     * @var LinkResponseMapper
     */
    private $linkResponseMapper;

    public function __construct(LinkResponseMapper $linkResponseMapper)
    {
        $this->linkResponseMapper = $linkResponseMapper;
    }

    /**
     * @param \stdClass $templateResponseParameters
     * @param string $templateResponseClass
     * @return TemplateResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $templateResponseParameters, string $templateResponseClass = TemplateResponse::class)
    {
        $reflectionClass = new \ReflectionClass($templateResponseClass);
        $this->validateTemplateResponseClass($reflectionClass);

        /** @var TemplateResponseInterface $templateResponse */
        $templateResponse = $reflectionClass->newInstance();
        $templateResponse->setId($templateResponseParameters->id);
        $templateResponse->setName($templateResponseParameters->name);
        $templateResponse->setBody($templateResponseParameters->body);

        $linkResponses = [];
        foreach($templateResponseParameters->links->data as $datum){
            $linkResponses[] = $this->linkResponseMapper->fromStdClass($datum);
        }
        $templateResponse->setLinks($linkResponses);

        return $templateResponse;
    }

    /**
     * @param TemplateResponseInterface $templateResponse
     * @return \stdClass
     */
    public function toStdClass(TemplateResponseInterface $templateResponse): \stdClass
    {
        $templateResponseStdClass = new \stdClass();
        $templateResponseStdClass->id = $templateResponse->getId();
        $templateResponseStdClass->name = $templateResponse->getName();
        $templateResponseStdClass->body = $templateResponse->getBody();

        $templateResponseStdClass->links = new \stdClass();
        foreach($templateResponse->getLinks() as $link){
            $templateResponseStdClass->links->data[] = $this->linkResponseMapper->toStdClass($link);
        }

        return $templateResponseStdClass;
    }

    /**
     * @param array $templateResponseParameters
     * @param string $templateResponseClass
     * @return TemplateResponseInterface
     */
    public function fromArray(array $templateResponseParameters, string $templateResponseClass = TemplateResponse::class): TemplateResponseInterface
    {
        $reflectionClass = new \ReflectionClass($templateResponseClass);
        $this->validateTemplateResponseClass($reflectionClass);

        /** @var TemplateResponseInterface $templateResponse */
        $templateResponse = $reflectionClass->newInstance();
        $templateResponse->setId($templateResponseParameters['id']);
        $templateResponse->setName($templateResponseParameters['name']);
        $templateResponse->setBody($templateResponseParameters['body']);

        $linkResponses = [];
        foreach($templateResponseParameters['links']['data'] as $datum){
            $linkResponses[] = $this->linkResponseMapper->fromArray($datum);
        }
        $templateResponse->setLinks($linkResponses);

        return $templateResponse;
    }

    /**
     * @param TemplateResponseInterface $templateResponse
     * @return array
     */
    public function toArray(TemplateResponseInterface $templateResponse): array
    {
        $templateResponseStdClass = [];
        $templateResponseStdClass['id'] = $templateResponse->getId();
        $templateResponseStdClass['name'] = $templateResponse->getName();
        $templateResponseStdClass['body'] = $templateResponse->getBody();

        $templateResponseStdClass['links'] = [
            'data' => []
        ];
        foreach($templateResponse->getLinks() as $link){
            $templateResponseStdClass['links']['data'][] = $this->linkResponseMapper->toArray($link);;
        }

        return $templateResponseStdClass;
    }

    /**
     * @param string $templateResponseParameters
     * @param string $templateResponseClass
     * @return TemplateResponseInterface
     */
    public function fromJson(string $templateResponseParameters, string $templateResponseClass = TemplateResponse::class): TemplateResponseInterface
    {
        return $this->fromArray(json_decode($templateResponseParameters, true), $templateResponseClass);
    }

    /**
     * @param TemplateResponseInterface $templateResponse
     * @return string
     */
    public function toJson(TemplateResponseInterface $templateResponse): string
    {
        return json_encode($this->toArray($templateResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateTemplateResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(TemplateResponseInterface::class)) {
            throw new InterfaceImplementationException(TemplateResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}