<?php


namespace Digitonic\PassonaClient\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\LinkRequest as LinkRequestInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\LinkRequestMapper as LinkRequestMapperInterface;
use Digitonic\PassonaClient\Entities\Requests\LinkRequest;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class LinkRequestMapper implements LinkRequestMapperInterface
{
    /**
     * @param LinkRequestInterface $linkRequest
     * @return array
     */
    public function toArray(LinkRequestInterface $linkRequest): array
    {
        return [
            'name' => $linkRequest->getName(),
            'destination' => $linkRequest->getDestination(),
            'vanityDomainId' => $linkRequest->getVanityDomainId(),
        ];
    }

    /**
     * @param array $linkRequestParameters
     * @param string $linkRequestClass
     * @return LinkRequestInterface
     */
    public function fromArray(array $linkRequestParameters, string $linkRequestClass = LinkRequest::class): LinkRequestInterface
    {
        $reflectionClass = new \ReflectionClass($linkRequestClass);
        $this->validateLinkRequestClass($reflectionClass);

        /** @var LinkRequestInterface $linkRequest */
        $linkRequest = $reflectionClass->newInstance();
        $linkRequest->setName($linkRequestParameters['name']);
        $linkRequest->setVanityDomainId($linkRequestParameters['vanityDomainId']);
        $linkRequest->setDestination($linkRequestParameters['destination']);

        return $linkRequest;
    }

    /**
     * @param LinkRequestInterface $linkRequest
     * @return \stdClass
     */
    public function toStdClass(LinkRequestInterface $linkRequest): \stdClass
    {
        $linkRequestStdClass = new \stdClass();
        $linkRequestStdClass->name = $linkRequest->getName();
        $linkRequestStdClass->destination = $linkRequest->getDestination();
        $linkRequestStdClass->vanityDomainId = $linkRequest->getVanityDomainId();

        return $linkRequestStdClass;
    }

    /**
     * @param \stdClass $linkRequestParameters
     * @param string $linkRequestClass
     * @return LinkRequestInterface
     */
    public function fromStdClass(\stdClass $linkRequestParameters, string $linkRequestClass = LinkRequest::class): LinkRequestInterface
    {
        $reflectionClass = new \ReflectionClass($linkRequestClass);
        $this->validateLinkRequestClass($reflectionClass);

        /** @var LinkRequestInterface $linkRequest */
        $linkRequest = $reflectionClass->newInstance();
        $linkRequest->setDestination($linkRequestParameters->destination);
        $linkRequest->setVanityDomainId($linkRequestParameters->vanityDomainId);
        $linkRequest->setName($linkRequestParameters->name);

        return $linkRequest;
    }

    /**
     * @param LinkRequestInterface $linkRequest
     * @return string
     */
    public function toJson(LinkRequestInterface $linkRequest): string
    {
        return json_encode($this->toArray($linkRequest));
    }

    /**
     * @param string $linkRequestParameters
     * @param string $linkRequestClass
     * @return LinkRequestInterface
     */
    public function fromJson(string $linkRequestParameters, string $linkRequestClass = LinkRequest::class): LinkRequestInterface
    {
        return $this->fromArray(json_decode($linkRequestParameters, true), $linkRequestClass);
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateLinkRequestClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(LinkRequestInterface::class)) {
            throw new InterfaceImplementationException(LinkRequestInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}
