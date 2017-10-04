<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

interface TemplateResponse
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
    public function getBody(): string;

    /**
     * @param string $body
     */
    public function setBody(string $body);

    /**
     * @return array
     */
    public function getLinks(): array;

    /**
     * @param array $links
     */
    public function setLinks(array $links);

    /**
     * @param string $key
     * @param $value
     */
    public function addLink(string $key, $value);
}