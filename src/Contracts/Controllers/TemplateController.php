<?php


namespace Digitonic\PassonaClient\Contracts\Controllers;


use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\TemplateResponse;

interface TemplateController
{
    public function getAllTemplates(): array;
    public function getTemplate(int $templateId): TemplateResponse;
    public function postTemplate(TemplateRequest $templateRequest): TemplateResponse;
    public function putTemplate(int $templateId, TemplateRequest $templateRequest): TemplateResponse;
    public function deleteTemplate(int $templateId): bool;
}