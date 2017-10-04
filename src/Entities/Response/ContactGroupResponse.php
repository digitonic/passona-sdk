<?php


namespace Digitonic\PassonaClient\Entities;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse as ContactGroupResponseInterface;

class ContactGroupResponse implements ContactGroupResponseInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var array
     */
    private $fields = [];
    /**
     * @var int
     */
    private $numberOfUniqueProfiles;
    /**
     * @var Carbon
     */
    private $createdAt;
    /**
     * @var Carbon
     */
    private $updatedAt;
    /**
     * @var int
     */
    private $numberOfContacts;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return int
     */
    public function getNumberOfUniqueProfiles(): int
    {
        return $this->numberOfUniqueProfiles;
    }

    /**
     * @param int $numberOfUniqueProfiles
     */
    public function setNumberOfUniqueProfiles(int $numberOfUniqueProfiles)
    {
        $this->numberOfUniqueProfiles = $numberOfUniqueProfiles;
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
     * @return int
     */
    public function getNumberOfContacts(): int
    {
        return $this->numberOfContacts;
    }

    /**
     * @param int $numberOfContacts
     */
    public function setNumberOfContacts(int $numberOfContacts)
    {
        $this->numberOfContacts = $numberOfContacts;
    }
}