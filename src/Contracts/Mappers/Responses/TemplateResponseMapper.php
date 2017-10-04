<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\TemplateResponse as TemplateResponseInterface;
use Digitonic\PassonaClient\Entities\TemplateResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

interface TemplateResponseMapper
{
    /**
     * @param \stdClass $templateResponseParameters
     * @param string $templateResponseClass
     * @return TemplateResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $templateResponseParameters, string $templateResponseClass = TemplateResponse::class);

    /**
     * @param TemplateResponseInterface $templateResponse
     * @return \stdClass
     */
    public function toStdClass(TemplateResponseInterface $templateResponse): \stdClass;

    /**
     * @param array $templateResponseParameters
     * @param string $templateResponseClass
     * @return TemplateResponseInterface
     */
    public function fromArray(array $templateResponseParameters, string $templateResponseClass = TemplateResponse::class): TemplateResponseInterface;

    /**
     * @param TemplateResponseInterface $templateResponse
     * @return array
     */
    public function toArray(TemplateResponseInterface $templateResponse): array;

    /**
     * @param string $templateResponseParameters
     * @param string $templateResponseClass
     * @return TemplateResponseInterface
     */
    public function fromJson(string $templateResponseParameters, string $templateResponseClass = TemplateResponse::class): TemplateResponseInterface;

    /**
     * @param TemplateResponseInterface $templateResponse
     * @return string
     */
    public function toJson(TemplateResponseInterface $templateResponse): string;
}