<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

use Carbon\Carbon;

interface ContactUploadResponse
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id);

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     */
    public function setStatus(int $status);

    /**
     * @return int
     */
    public function getPhoneNumberIndex(): int;

    /**
     * @param int $phoneNumberIndex
     */
    public function setPhoneNumberIndex(int $phoneNumberIndex);

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon;

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt);

    /**
     * @return UploadedCsvFileResponse
     */
    public function getUploadedCsvFile(): UploadedCsvFileResponse;

    /**
     * @param UploadedCsvFileResponse $uploadedCsvFile
     */
    public function setUploadedCsvFile(UploadedCsvFileResponse $uploadedCsvFile);
}
