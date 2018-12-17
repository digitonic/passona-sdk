<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest;

interface ContactGroupRequestMapper
{
    /**
     * @param ContactGroupRequest $contactGroupRequest
     * @return array
     */
    public function toArray(ContactGroupRequest $contactGroupRequest): array;

    /**
     * @param array $contactGroupRequestParameters
     * @param string $contactGroupRequestClass
     * @return ContactGroupRequest
     */
    public function fromArray(array $contactGroupRequestParameters, string $contactGroupRequestClass = ContactGroupRequest::class): ContactGroupRequest;

    /**
     * @param ContactGroupRequest $contactGroupRequest
     * @return \stdClass
     */
    public function toStdClass(ContactGroupRequest $contactGroupRequest): \stdClass;

    /**
     * @param \stdClass $contactGroupRequestParameters
     * @param string $contactGroupRequestClass
     * @return ContactGroupRequest
     */
    public function fromStdClass(\stdClass $contactGroupRequestParameters, string $contactGroupRequestClass = ContactGroupRequest::class): ContactGroupRequest;

    /**
     * @param ContactGroupRequest $contactGroupRequest
     * @return string
     */
    public function toJson(ContactGroupRequest $contactGroupRequest): string;

    /**
     * @param string $contactGroupRequestParameters
     * @param string $contactGroupRequestClass
     * @return ContactGroupRequest
     */
    public function fromJson(string $contactGroupRequestParameters, string $contactGroupRequestClass = ContactGroupRequest::class): ContactGroupRequest;
}
