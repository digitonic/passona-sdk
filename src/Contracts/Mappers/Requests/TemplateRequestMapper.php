<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest;

interface TemplateRequestMapper
{
    /**
     * @param TemplateRequest $template
     * @return array
     */
    public function toArray(TemplateRequest $template): array;

    /**
     * @param array $templateParameters
     * @param string $templateRequestClass
     * @return TemplateRequest
     */
    public function fromArray(array $templateParameters, string $templateRequestClass = TemplateRequest::class): TemplateRequest;

    /**
     * @param TemplateRequest $template
     * @return \stdClass
     */
    public function toStdClass(TemplateRequest $template): \stdClass;

    /**
     * @param \stdClass $templateRequestParameters
     * @param string $templateRequestClass
     * @return TemplateRequest
     */
    public function fromStdClass(\stdClass $templateRequestParameters, string $templateRequestClass = TemplateRequest::class): TemplateRequest;

    /**
     * @param TemplateRequest $templateRequest
     * @return string
     */
    public function toJson(TemplateRequest $templateRequest): string;

    /**
     * @param string $templateRequestParameters
     * @param string $templateRequestClass
     * @return TemplateRequest
     */
    public function fromJson(string $templateRequestParameters, string $templateRequestClass = TemplateRequest::class): TemplateRequest;
}