<?php


namespace Digitonic\PassonaClient\Entities;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\UploadedCsvFileResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse as ContactUploadResponseInterface;

class ContactUploadResponse implements ContactUploadResponseInterface
{
    const STATUS_PENDING = 1;
    const STATUS_COMPLETE = 2;

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $phoneNumberIndex;
    /**
     * @var Carbon
     */
    private $createdAt;
    /**
     * @var UploadedCsvFileResponse
     */
    private $uploadedCsvFile;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getPhoneNumberIndex(): int
    {
        return $this->phoneNumberIndex;
    }

    /**
     * @param int $phoneNumberIndex
     */
    public function setPhoneNumberIndex(int $phoneNumberIndex)
    {
        $this->phoneNumberIndex = $phoneNumberIndex;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return UploadedCsvFileResponse
     */
    public function getUploadedCsvFile(): UploadedCsvFileResponse
    {
        return $this->uploadedCsvFile;
    }
    /**
     * @param UploadedCsvFileResponse $uploadedCsvFile
     */
    public function setUploadedCsvFile(UploadedCsvFileResponse $uploadedCsvFile)
    {
        $this->uploadedCsvFile = $uploadedCsvFile;
    }
}