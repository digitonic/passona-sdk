<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactRequest;

interface ContactRequestMapper
{
    /**
     * @param ContactRequest $contact
     * @return array
     */
    public function toArray(ContactRequest $contact): array;

    /**
     * @param array $contactRequestParameters
     * @param string $contactRequestClass
     * @return ContactRequest
     */
    public function fromArray(array $contactRequestParameters, string $contactRequestClass = ContactRequest::class): ContactRequest;

    /**
     * @param ContactRequest $contact
     * @return \stdClass
     */
    public function toStdClass(ContactRequest $contact): \stdClass;

    /**
     * @param \stdClass $contactRequestParameters
     * @param string $contactRequestClass
     * @return ContactRequest
     */
    public function fromStdClass(\stdClass $contactRequestParameters, string $contactRequestClass = ContactRequest::class): ContactRequest;

    /**
     * @param ContactRequest $contact
     * @return string
     */
    public function toJson(ContactRequest $contact): string;

    /**
     * @param string $contactRequestParameters
     * @param string $contactRequestClass
     * @return ContactRequest
     */
    public function fromJson(string $contactRequestParameters, string $contactRequestClass = ContactRequest::class): ContactRequest;
}