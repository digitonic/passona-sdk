<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\UploadedCsvFileResponse as UploadedCsvFileResponseInterface;
use Digitonic\PassonaClient\Entities\Responses\UploadedCsvFileResponse;

interface UploadedCsvFileResponseMapper
{
    /**
     * @param array $uploadedCsvFileResponseParameters
     * @param string $uploadedCsvFileResponseClass
     * @return UploadedCsvFileResponseInterface
     */
    public function fromArray(array $uploadedCsvFileResponseParameters, $uploadedCsvFileResponseClass = UploadedCsvFileResponse::class): UploadedCsvFileResponseInterface;

    /**
     * @param UploadedCsvFileResponseInterface $uploadedCsvFileResponse
     * @return array
     */
    public function toArray(UploadedCsvFileResponseInterface $uploadedCsvFileResponse): array;

    /**
     * @param \stdClass $uploadedCsvFileResponseParameters
     * @param string $uploadedCsvFileResponseClass
     * @return UploadedCsvFileResponseInterface
     */
    public function fromStdClass(\stdClass $uploadedCsvFileResponseParameters, $uploadedCsvFileResponseClass = UploadedCsvFileResponse::class): UploadedCsvFileResponseInterface;

    /**
     * @param UploadedCsvFileResponseInterface $uploadedCsvFileResponse
     * @return \stdClass
     */
    public function toStdClass(UploadedCsvFileResponseInterface $uploadedCsvFileResponse): \stdClass;

    /**
     * @param string $uploadedCsvFileResponseParameters
     * @param string $uploadedCsvFileResponseClass
     * @return UploadedCsvFileResponseInterface
     */
    public function fromJson(string $uploadedCsvFileResponseParameters, $uploadedCsvFileResponseClass = UploadedCsvFileResponse::class): UploadedCsvFileResponseInterface;

    /**
     * @param UploadedCsvFileResponseInterface $uploadedCsvFileResponse
     * @return string
     */
    public function toJson(UploadedCsvFileResponseInterface $uploadedCsvFileResponse): string;
}