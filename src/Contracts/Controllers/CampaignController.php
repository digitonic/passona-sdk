<?php


namespace Digitonic\PassonaClient\Contracts\Controllers;

use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse;

interface CampaignController
{
    public function getAllCampaigns(): array;
    public function getCampaign(int $campaignId): CampaignResponse;
    public function postCampaign(CampaignRequest $campaignRequest): CampaignResponse;
    public function putCampaign(int $campaignId, CampaignRequest $campaignRequest): CampaignResponse;
    public function deleteCampaign(int $campaignId): bool;
}
