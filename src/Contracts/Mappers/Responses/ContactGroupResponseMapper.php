<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse as ContactGroupResponseInterface;
use Digitonic\PassonaClient\Entities\ContactGroupResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

interface ContactGroupResponseMapper
{
    /**
     * @param \stdClass $contactGroupResponseParameters
     * @param string $contactGroupResponseClass
     * @return ContactGroupResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $contactGroupResponseParameters, string $contactGroupResponseClass = ContactGroupResponse::class): ContactGroupResponseInterface;

    /**
     * @param ContactGroupResponseInterface $contactGroupResponse
     * @return \stdClass
     */
    public function toStdClass(ContactGroupResponseInterface $contactGroupResponse): \stdClass;

    /**
     * @param array $contactGroupResponseParameters
     * @param string $contactGroupResponseClass
     * @return ContactGroupResponseInterface
     */
    public function fromArray(array $contactGroupResponseParameters, string $contactGroupResponseClass = ContactGroupResponse::class): ContactGroupResponseInterface;

    /**
     * @param ContactGroupResponseInterface $contactGroupResponse
     * @return array
     */
    public function toArray(ContactGroupResponseInterface $contactGroupResponse): array;

    /**
     * @param string $contactGroupResponseParameters
     * @param string $contactGroupResponseClass
     * @return ContactGroupResponseInterface
     */
    public function fromJson(string $contactGroupResponseParameters, string $contactGroupResponseClass = ContactGroupResponse::class): ContactGroupResponseInterface;

    /**
     * @param ContactGroupResponseInterface $contactGroupResponse
     * @return string
     */
    public function toJson(ContactGroupResponseInterface $contactGroupResponse): string;
}