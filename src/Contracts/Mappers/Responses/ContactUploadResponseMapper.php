<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse as ContactUploadResponseInterface;
use Digitonic\PassonaClient\Entities\Responses\ContactUploadResponse;

interface ContactUploadResponseMapper
{
    /**
     * @param array $contactUploadResponseParameters
     * @param string $contactUploadResponseClass
     * @return ContactUploadResponseInterface
     */
    public function fromArray(array $contactUploadResponseParameters, string $contactUploadResponseClass = ContactUploadResponse::class): ContactUploadResponseInterface;

    /**
     * @param ContactUploadResponseInterface $contactUploadResponse
     * @return array
     */
    public function toArray(ContactUploadResponseInterface $contactUploadResponse): array;

    /**
     * @param \stdClass $contactUploadResponseParameters
     * @param string $contactUploadResponseClass
     * @return ContactUploadResponseInterface
     */
    public function fromStdClass(\stdClass $contactUploadResponseParameters, string $contactUploadResponseClass = ContactUploadResponse::class): ContactUploadResponseInterface;

    /**
     * @param ContactUploadResponseInterface $contactUploadResponse
     * @return \stdClass
     */
    public function toStdClass(ContactUploadResponseInterface $contactUploadResponse): \stdClass;

    /**
     * @param string $contactUploadResponseParameters
     * @param string $contactUploadResponseClass
     * @return ContactUploadResponseInterface
     */
    public function fromJson(string $contactUploadResponseParameters, string $contactUploadResponseClass = ContactUploadResponse::class): ContactUploadResponseInterface;

    /**
     * @param ContactUploadResponseInterface $contactUploadResponse
     * @return string
     */
    public function toJson(ContactUploadResponseInterface $contactUploadResponse): string;
}
