<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse as CampaignResponseInterface;
use Digitonic\PassonaClient\Entities\CampaignResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

interface CampaignResponseMapper
{
    /**
     * @param \stdClass $campaignResponseParameters
     * @param string $campaignResponseClass
     * @return CampaignResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $campaignResponseParameters, string $campaignResponseClass = CampaignResponse::class): CampaignResponseInterface;

    /**
     * @param CampaignResponseInterface $campaignResponse
     * @return \stdClass
     */
    public function toStdClass(CampaignResponseInterface $campaignResponse): \stdClass;

    /**
     * @param array $campaignResponseParameters
     * @param string $campaignResponseClass
     * @return CampaignResponseInterface
     */
    public function fromArray(array $campaignResponseParameters, string $campaignResponseClass = CampaignResponse::class): CampaignResponseInterface;

    /**
     * @param CampaignResponseInterface $campaignResponse
     * @return array
     */
    public function toArray(CampaignResponseInterface $campaignResponse): array;

    /**
     * @param string $campaignResponseParameters
     * @param string $campaignResponseClass
     * @return CampaignResponseInterface
     */
    public function fromJson(string $campaignResponseParameters, string $campaignResponseClass = CampaignResponse::class): CampaignResponseInterface;

    /**
     * @param CampaignResponseInterface $campaignResponse
     * @return string
     */
    public function toJson(CampaignResponseInterface $campaignResponse): string;
}