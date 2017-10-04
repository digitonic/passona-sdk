<?php


namespace Digitonic\PassonaClient\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Mappers\Responses\LinkResponseMapper as LinkResponseMapperInterface;
use Digitonic\PassonaClient\Entities\LinkResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\LinkResponse as LinkResponseInterface;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class LinkResponseMapper implements LinkResponseMapperInterface
{
    /**
     * @var VanityDomainResponseMapper
     */
    private $vanityDomainMapper;

    public function __construct(VanityDomainResponseMapper $vanityDomainMapper = null)
    {
        $this->vanityDomainMapper = $vanityDomainMapper;
    }

    /**
     * @param \stdClass $linkResponseParameters
     * @param string $linkResponseClass
     * @return LinkResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $linkResponseParameters, string $linkResponseClass = LinkResponse::class): LinkResponseInterface
    {
        $reflectionClass = new \ReflectionClass($linkResponseClass);
        $this->validateLinkResponseClass($reflectionClass);

        /** @var LinkResponseInterface $link */
        $link = $reflectionClass->newInstance();
        $link->setId($linkResponseParameters->id);
        $link->setName($linkResponseParameters->name);
        $link->setDestination($linkResponseParameters->destination);
        $link->setDeleted($linkResponseParameters->deleted);
        $vanityDomain = $this->vanityDomainMapper->fromStdClass($linkResponseParameters->vanityDomain->data);
        $link->setVanityDomain($vanityDomain);
        $link->setVanityDomainDomain($vanityDomain->getDomain());
        $link->setVanityDomainId($vanityDomain->getId());

        return $link;
    }

    /**
     * @param LinkResponseInterface $linkResponse
     * @return \stdClass
     */
    public function toStdClass(LinkResponseInterface $linkResponse): \stdClass
    {
        $linkResponseStdClass = new \stdClass();
        $linkResponseStdClass->id = $linkResponse->getId();
        $linkResponseStdClass->name = $linkResponse->getName();
        $linkResponseStdClass->destination = $linkResponse->getDestination();
        $linkResponseStdClass->deleted = $linkResponse->isDeleted();
        $vanityDomain = $this->vanityDomainMapper->toStdClass($linkResponse->getVanityDomain());
        $linkResponseStdClass->vanityDomain = new \stdClass();
        $linkResponseStdClass->vanityDomain->data = $vanityDomain;
        $linkResponseStdClass->vanityDomainDomain = $vanityDomain->domain;
        $linkResponseStdClass->vanityDomainId = $vanityDomain->id;

        return $linkResponseStdClass;
    }

    /**
     * @param array $linkResponseParameters
     * @param string $linkResponseClass
     * @return LinkResponseInterface
     */
    public function fromArray(array $linkResponseParameters, string $linkResponseClass = LinkResponse::class): LinkResponseInterface
    {
        $reflectionClass = new \ReflectionClass($linkResponseClass);
        $this->validateLinkResponseClass($reflectionClass);

        /** @var LinkResponseInterface $link */
        $link = $reflectionClass->newInstance();
        $link->setId($linkResponseParameters['id']);
        $link->setName($linkResponseParameters['name']);
        $link->setDestination($linkResponseParameters['destination']);
        $link->setDeleted($linkResponseParameters['deleted']);
        $vanityDomain = $this->vanityDomainMapper->fromArray($linkResponseParameters['vanityDomain']['data']);
        $link->setVanityDomain($vanityDomain);
        $link->setVanityDomainDomain($vanityDomain->getDomain());
        $link->setVanityDomainId($vanityDomain->getId());

        return $link;
    }

    /**
     * @param LinkResponseInterface $linkResponse
     * @return array
     */
    public function toArray(LinkResponseInterface $linkResponse): array
    {
        $linkResponseStdClass = [];
        $linkResponseStdClass['id'] = $linkResponse->getId();
        $linkResponseStdClass['name'] = $linkResponse->getName();
        $linkResponseStdClass['destination'] = $linkResponse->getDestination();
        $linkResponseStdClass['deleted'] = $linkResponse->isDeleted();
        $vanityDomain = $this->vanityDomainMapper->toArray($linkResponse->getVanityDomain());
        $linkResponseStdClass['vanityDomain'] = ['data' => $vanityDomain];
        $linkResponseStdClass['vanityDomainDomain'] = $vanityDomain['domain'];
        $linkResponseStdClass['vanityDomainId'] = $vanityDomain['id'];

        return $linkResponseStdClass;
    }

    /**
     * @param string $linkResponseParameters
     * @param string $linkResponseClass
     * @return LinkResponseInterface
     */
    public function fromJson(string $linkResponseParameters, string $linkResponseClass = LinkResponse::class): LinkResponseInterface
    {
        return $this->fromArray(json_decode($linkResponseParameters, true), $linkResponseClass);
    }

    /**
     * @param LinkResponseInterface $linkResponse
     * @return string
     */
    public function toJson(LinkResponseInterface $linkResponse): string
    {
        return json_encode($this->toArray($linkResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateLinkResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(LinkResponseInterface::class)) {
            throw new InterfaceImplementationException(LinkResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}