<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

use Carbon\Carbon;

interface ContactResponse
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
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber);

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon;

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt);

    /**
     * @return array
     */
    public function getCustomFields(): array;

    /**
     * @param string $key
     * @param $value
     */
    public function addCustomField(string $key, $value);

    /**
     * @param string $key
     */
    public function removeCustomField(string $key);
}