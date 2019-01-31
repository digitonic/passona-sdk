<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse as ContactResponseInterface;
use Digitonic\PassonaClient\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

interface ContactResponseMapper
{
    /**
     * @param \stdClass $contactResponseParameters
     * @param string $contactResponseClass
     * @return ContactResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $contactResponseParameters, string $contactResponseClass = ContactResponse::class): ContactResponseInterface;

    /**
     * @param ContactResponseInterface $contactResponse
     * @return \stdClass
     */
    public function toStdClass(ContactResponseInterface $contactResponse): \stdClass;

    /**
     * @param array $contactResponseParameters
     * @param string $contactResponseClass
     * @return ContactResponseInterface
     */
    public function fromArray(array $contactResponseParameters, string $contactResponseClass = ContactResponse::class): ContactResponseInterface;

    /**
     * @param ContactResponseInterface $contactResponse
     * @return array
     */
    public function toArray(ContactResponseInterface $contactResponse): array;

    /**
     * @param string $contactResponseParameters
     * @param string $contactResponseClass
     * @return ContactResponseInterface
     */
    public function fromJson(string $contactResponseParameters, string $contactResponseClass = ContactResponse::class): ContactResponseInterface;

    /**
     * @param ContactResponseInterface $contactResponse
     * @return string
     */
    public function toJson(ContactResponseInterface $contactResponse): string;
}
