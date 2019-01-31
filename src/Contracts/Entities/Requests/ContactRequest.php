<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Requests;

interface ContactRequest
{
    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber);

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @param string $key
     * @param $value
     */
    public function addCustomField(string $key, $value);

    /**
     * @return array
     */
    public function getCustomFields(): array;

    /**
     * @param string $key
     */
    public function removeCustomField(string $key);
}
