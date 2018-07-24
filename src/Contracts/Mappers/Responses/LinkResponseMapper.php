<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\LinkResponse as LinkResponseInterface;
use Digitonic\PassonaClient\Entities\Responses\LinkResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

interface LinkResponseMapper
{
    /**
     * @param \stdClass $linkResponseParameters
     * @param string $linkResponseClass
     * @return LinkResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $linkResponseParameters, string $linkResponseClass = LinkResponse::class): LinkResponseInterface;

    /**
     * @param LinkResponseInterface $linkResponse
     * @return \stdClass
     */
    public function toStdClass(LinkResponseInterface $linkResponse): \stdClass;

    /**
     * @param array $linkResponseParameters
     * @param string $linkResponseClass
     * @return LinkResponseInterface
     */
    public function fromArray(array $linkResponseParameters, string $linkResponseClass = LinkResponse::class): LinkResponseInterface;

    /**
     * @param LinkResponseInterface $linkResponse
     * @return array
     */
    public function toArray(LinkResponseInterface $linkResponse): array;

    /**
     * @param string $linkResponseParameters
     * @param string $linkResponseClass
     * @return LinkResponseInterface
     */
    public function fromJson(string $linkResponseParameters, string $linkResponseClass = LinkResponse::class): LinkResponseInterface;

    /**
     * @param LinkResponseInterface $linkResponse
     * @return string
     */
    public function toJson(LinkResponseInterface $linkResponse): string;
}