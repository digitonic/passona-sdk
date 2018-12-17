<?php


namespace Digitonic\PassonaClient\Entities\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest as TemplateRequestInterface;

class TemplateRequest implements TemplateRequestInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $body;
    /**
     * @var array
     */
    private $links;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param array $links
     */
    public function setLinks(array $links)
    {
        $this->links = $links;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
