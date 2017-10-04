<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\LinkRequest;

interface LinkRequestMapper
{
    /**
     * @param LinkRequest $linkRequest
     * @return array
     */
    public function toArray(LinkRequest $linkRequest): array;

    /**
     * @param array $linkRequestParameters
     * @param string $linkRequestClass
     * @return LinkRequest
     */
    public function fromArray(array $linkRequestParameters, string $linkRequestClass = LinkRequest::class): LinkRequest;

    /**
     * @param LinkRequest $linkRequest
     * @return \stdClass
     */
    public function toStdClass(LinkRequest $linkRequest): \stdClass;

    /**
     * @param \stdClass $linkRequestParameters
     * @param string $linkRequestClass
     * @return LinkRequest
     */
    public function fromStdClass(\stdClass $linkRequestParameters, string $linkRequestClass = LinkRequest::class): LinkRequest;

    /**
     * @param LinkRequest $linkRequest
     * @return string
     */
    public function toJson(LinkRequest $linkRequest): string;

    /**
     * @param string $linkRequestParameters
     * @param string $linkRequestClass
     * @return LinkRequest
     */
    public function fromJson(string $linkRequestParameters, string $linkRequestClass = LinkRequest::class): LinkRequest;
}