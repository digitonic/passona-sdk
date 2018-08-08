<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\VanityDomainResponse as VanityDomainResponseInterface;
use Digitonic\PassonaClient\Entities\Responses\VanityDomainResponse;

interface VanityDomainResponseMapper
{
    /**
     * @param array $vanityDomainParameters
     * @param string $vanityDomainResponseClass
     * @return VanityDomainResponseInterface
     */
    public function fromArray(array $vanityDomainParameters, string $vanityDomainResponseClass = VanityDomainResponse::class): VanityDomainResponseInterface;

    /**
     * @param VanityDomainResponseInterface $vanityDomainResponse
     * @return array
     */
    public function toArray(VanityDomainResponseInterface $vanityDomainResponse): array;

    /**
     * @param \stdClass $vanityDomainParameters
     * @param string $vanityDomainResponseClass
     * @return VanityDomainResponseInterface
     */
    public function fromStdClass(\stdClass $vanityDomainParameters, string $vanityDomainResponseClass = VanityDomainResponse::class): VanityDomainResponseInterface;

    /**
     * @param VanityDomainResponseInterface $vanityDomainResponse
     * @return \stdClass
     */
    public function toStdClass(VanityDomainResponseInterface $vanityDomainResponse): \stdClass;

    /**
     * @param string $vanityDomainParameters
     * @param string $vanityDomainResponseClass
     * @return VanityDomainResponseInterface
     */
    public function fromJson(string $vanityDomainParameters, string $vanityDomainResponseClass = VanityDomainResponse::class): VanityDomainResponseInterface;

    /**
     * @param VanityDomainResponseInterface $vanityDomainResponse
     * @return string
     */
    public function toJson(VanityDomainResponseInterface $vanityDomainResponse): string;
}