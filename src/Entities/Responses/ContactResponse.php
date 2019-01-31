<?php


namespace Digitonic\PassonaClient\Entities\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse as ContactResponseInterface;

class ContactResponse implements ContactResponseInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * @var array
     */
    private $customFields = [];

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
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }
    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return array
     */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function addCustomField(string $key, $value)
    {
        $this->customFields[$key] = $value;
    }

    /**
     * @param string $key
     */
    public function removeCustomField(string $key)
    {
        if (isset($this->customFields[$key])) {
            unset($this->customFields[$key]);
        }
    }
}
