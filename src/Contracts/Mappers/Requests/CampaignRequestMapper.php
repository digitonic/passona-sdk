<?php

namespace Digitonic\PassonaClient\Contracts\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest;

interface CampaignRequestMapper
{
    /**
     * @param CampaignRequest $campaign
     * @return array
     */
    public function toArray(CampaignRequest $campaign): array;

    /**
     * @param array $campaignRequestParameters
     * @param string $campaignRequestClass
     * @return CampaignRequest
     */
    public function fromArray(array $campaignRequestParameters, string $campaignRequestClass = CampaignRequest::class): CampaignRequest;

    /**
     * @param CampaignRequest $campaign
     * @return \stdClass
     */
    public function toStdClass(CampaignRequest $campaign): \stdClass;

    /**
     * @param \stdClass $campaignRequestParameters
     * @param string $campaignRequestClass
     * @return CampaignRequest
     */
    public function fromStdClass(\stdClass $campaignRequestParameters, string $campaignRequestClass = CampaignRequest::class): CampaignRequest;

    /**
     * @param CampaignRequest $campaignRequest
     * @return string
     */
    public function toJson(CampaignRequest $campaignRequest): string;

    /**
     * @param string $campaignRequestParameters
     * @param $
     * @param string $campaignRequestClass
     * @return CampaignRequest
     */
    public function fromJson(string $campaignRequestParameters, string $campaignRequestClass = CampaignRequest::class): CampaignRequest;
}
