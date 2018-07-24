<?php


namespace Digitonic\PassonaClient\Mappers\Responses;


use Digitonic\PassonaClient\Contracts\Entities\Responses\VanityDomainResponse as VanityDomainResponseInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\VanityDomainResponseMapper as VanityDomainResponseMapperInterface;
use Digitonic\PassonaClient\Entities\Responses\VanityDomainResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class VanityDomainResponseMapper implements VanityDomainResponseMapperInterface
{
    /**
     * @param array $vanityDomainParameters
     * @param string $vanityDomainResponseClass
     * @return VanityDomainResponseInterface
     */
    public function fromArray(array $vanityDomainParameters, string $vanityDomainResponseClass = VanityDomainResponse::class): VanityDomainResponseInterface
    {
        $reflectionClass = new \ReflectionClass($vanityDomainResponseClass);

        $this->validateVanityDomainResponseClass($reflectionClass);

        /** @var VanityDomainResponseInterface $vanityDomain */
        $vanityDomain = $reflectionClass->newInstance();
        $vanityDomain->setId($vanityDomainParameters['id']);
        $vanityDomain->setDomain($vanityDomainParameters['domain']);
        $vanityDomain->setHostedZoneId($vanityDomainParameters['hostedZoneId']);
        $vanityDomain->setStatus($vanityDomainParameters['status']);
        $vanityDomain->setNameservers($vanityDomainParameters['nameservers']);

        return $vanityDomain;
    }

    /**
     * @param VanityDomainResponseInterface $vanityDomainResponse
     * @return array
     */
    public function toArray(VanityDomainResponseInterface $vanityDomainResponse): array
    {
        return [
            'id' => $vanityDomainResponse->getId(),
            'domain' => $vanityDomainResponse->getDomain(),
            'hostedZoneId' => $vanityDomainResponse->getHostedZoneId(),
            'status' => $vanityDomainResponse->getStatus(),
            'nameservers' => $vanityDomainResponse->getNameservers()
        ];
    }

    /**
     * @param \stdClass $vanityDomainParameters
     * @param string $vanityDomainResponseClass
     * @return VanityDomainResponseInterface
     */
    public function fromStdClass(\stdClass $vanityDomainParameters, string $vanityDomainResponseClass = VanityDomainResponse::class): VanityDomainResponseInterface
    {
        $reflectionClass = new \ReflectionClass($vanityDomainResponseClass);

        $this->validateVanityDomainResponseClass($reflectionClass);

        /** @var VanityDomainResponseInterface $vanityDomain */
        $vanityDomain = $reflectionClass->newInstance();
        $vanityDomain->setId($vanityDomainParameters->id);
        $vanityDomain->setDomain($vanityDomainParameters->domain);
        $vanityDomain->setHostedZoneId($vanityDomainParameters->hostedZoneId);
        $vanityDomain->setStatus($vanityDomainParameters->status);
        $vanityDomain->setNameservers($vanityDomainParameters->nameservers);

        return $vanityDomain;
    }

    /**
     * @param VanityDomainResponseInterface $vanityDomainResponse
     * @return \stdClass
     */
    public function toStdClass(VanityDomainResponseInterface $vanityDomainResponse): \stdClass
    {
        $vanityDomainResponseStdClass = new \stdClass();

        $vanityDomainResponseStdClass->id = $vanityDomainResponse->getId();
        $vanityDomainResponseStdClass->domain = $vanityDomainResponse->getDomain();
        $vanityDomainResponseStdClass->hostedZoneId = $vanityDomainResponse->getHostedZoneId();
        $vanityDomainResponseStdClass->status = $vanityDomainResponse->getStatus();
        $vanityDomainResponseStdClass->nameservers = $vanityDomainResponse->getNameservers();

        return $vanityDomainResponseStdClass;
    }

    /**
     * @param string $vanityDomainParameters
     * @param string $vanityDomainResponseClass
     * @return VanityDomainResponseInterface
     */
    public function fromJson(string $vanityDomainParameters, string $vanityDomainResponseClass = VanityDomainResponse::class): VanityDomainResponseInterface
    {
        return $this->fromArray(json_decode($vanityDomainParameters, true), $vanityDomainResponseClass);
    }

    /**
     * @param VanityDomainResponseInterface $vanityDomainResponse
     * @return string
     */
    public function toJson(VanityDomainResponseInterface $vanityDomainResponse): string
    {
        return json_encode($this->toArray($vanityDomainResponse));
    }

    /**
     * @param $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateVanityDomainResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(VanityDomainResponseInterface::class)) {
            throw new InterfaceImplementationException(VanityDomainResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}