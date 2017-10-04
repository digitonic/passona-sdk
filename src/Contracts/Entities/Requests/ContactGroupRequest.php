<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Requests;

interface ContactGroupRequest
{
    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @return string
     */
    public function getDescription(): string;
}