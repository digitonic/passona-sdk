<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

use Carbon\Carbon;

interface ContactGroupResponse
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
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @return array
     */
    public function getFields(): array;

    /**
     * @param array $fields
     */
    public function setFields(array $fields);

    /**
     * @return int
     */
    public function getNumberOfUniqueProfiles(): int;

    /**
     * @param int $numberOfUniqueProfiles
     */
    public function setNumberOfUniqueProfiles(int $numberOfUniqueProfiles);

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon;

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt);

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon;

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt);

    /**
     * @return int
     */
    public function getNumberOfContacts(): int;

    /**
     * @param int $numberOfContacts
     */
    public function setNumberOfContacts(int $numberOfContacts);
}
