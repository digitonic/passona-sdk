<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Requests;

interface TemplateRequest
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
     * @param string $body
     */
    public function setBody(string $body);

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @param array $links
     */
    public function setLinks(array $links);

    /**
     * @return array
     */
    public function getLinks(): array;
}