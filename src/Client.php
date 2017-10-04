<?php


namespace Digitonic\PassonaClient;


use Digitonic\PassonaClient\Contracts\Controllers\CampaignController;
use Digitonic\PassonaClient\Contracts\Controllers\ContactGroupController;
use Digitonic\PassonaClient\Contracts\Controllers\ContactController;
use Digitonic\PassonaClient\Contracts\Controllers\TemplateController;
use Digitonic\PassonaClient\Contracts\Controllers\VanityDomainController;
use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest;
use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest;
use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\TemplateResponse;

class Client implements CampaignController, ContactGroupController, ContactController, TemplateController, VanityDomainController
{
    /**
     * @var CampaignController
     */
    private $campaignManager;

    /**
     * @var ContactGroupController
     */
    private $contactGroupManager;

    /**
     * @var ContactController
     */
    private $contactManager;

    /**
     * @var TemplateController
     */
    private $templateManager;

    /**
     * @var VanityDomainController
     */
    private $vanityDomainManager;

    public function __construct(
        CampaignController $campaignManager,
        ContactGroupController $contactGroupManager,
        ContactController $contactManager,
        TemplateController $templateManager,
        VanityDomainController $vanityDomainManager
    )
    {
        $this->campaignManager = $campaignManager;
        $this->contactGroupManager = $contactGroupManager;
        $this->contactManager = $contactManager;
        $this->templateManager = $templateManager;
        $this->vanityDomainManager = $vanityDomainManager;
    }

    public function getAllCampaigns(): array
    {
        return $this->campaignManager->getAllCampaigns();
    }

    public function getCampaign(int $campaignId): CampaignResponse
    {
        return $this->campaignManager->getCampaign($campaignId);
    }

    public function postCampaign(CampaignRequest $campaignRequest): CampaignResponse
    {
        return $this->campaignManager->postCampaign($campaignRequest);
    }

    public function putCampaign(int $campaignId, CampaignRequest $campaignRequest): CampaignResponse
    {
        return $this->campaignManager->putCampaign($campaignId, $campaignRequest);
    }

    public function deleteCampaign(int $campaignId): bool
    {
        return $this->campaignManager->deleteCampaign($campaignId);
    }

    public function getAllContactGroups(): array
    {
        return $this->contactGroupManager->getAllContactGroups();
    }

    public function postContactGroup(ContactGroupRequest $contactGroupRequest): ContactGroupResponse
    {
        return $this->contactGroupManager->postContactGroup($contactGroupRequest);
    }

    public function putContactGroup(int $groupId, ContactGroupRequest $contactGroupRequestDTO): ContactGroupResponse
    {
        return $this->contactGroupManager->putContactGroup($groupId, $contactGroupRequestDTO);
    }

    public function deleteContactGroup(int $groupId): bool
    {
        return $this->contactGroupManager->deleteContactGroup($groupId);
    }

    public function getAllContactsInContactGroup(int $groupId): array
    {
        return $this->contactManager->getAllContactsInContactGroup($groupId);
    }

    public function getContactInContactGroup(int $groupId, int $contactId): ContactResponse
    {
        return $this->contactManager->getContactInContactGroup($groupId, $contactId);
    }

    public function upsertContactsToContactGroup(int $groupId, array $contacts): ContactUploadResponse
    {
        return $this->contactManager->upsertContactsToContactGroup($groupId, $contacts);
    }

    public function deleteContactFromContactGroup(int $groupId, string $phoneNumber): bool
    {
        return $this->contactManager->deleteContactFromContactGroup($groupId, $phoneNumber);
    }

    public function getAllTemplates(): array
    {
        return $this->templateManager->getAllTemplates();
    }

    public function getTemplate(int $templateId): TemplateResponse
    {
        return $this->templateManager->getTemplate($templateId);
    }

    public function postTemplate(TemplateRequest $templateRequest): TemplateResponse
    {
        return $this->templateManager->postTemplate($templateRequest);
    }

    public function putTemplate(int $templateId, TemplateRequest $templateRequest): TemplateResponse
    {
        return $this->templateManager->putTemplate($templateId, $templateRequest);
    }

    public function deleteTemplate(int $templateId): bool
    {
        return $this->templateManager->deleteTemplate($templateId);
    }

    public function getAllVanityDomains(): array
    {
        return $this->vanityDomainManager->getAllVanityDomains();
    }
}