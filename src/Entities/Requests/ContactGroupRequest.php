<?php


namespace Digitonic\PassonaClient\Entities\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest as ContactGroupRequestInterface;

class ContactGroupRequest implements ContactGroupRequestInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;

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
}
