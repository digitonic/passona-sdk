<?php


namespace Digitonic\PassonaClient\Entities;


use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactRequest as ContactRequestInterface;

class ContactRequest implements ContactRequestInterface
{
    /**
     * @var string
     */
    private $phoneNumber = '';

    /**
     * @var array
     */
    private $customFields = [];

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
    public function removeCustomField(string $key){
        if (isset($this->customFields[$key])){
            unset ($this->customFields[$key]);
        }
    }
}