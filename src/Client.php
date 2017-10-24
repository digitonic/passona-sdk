<?php


namespace Digitonic\PassonaClient;


use Digitonic\PassonaClient\Contracts\Controllers\CampaignController as CampaignControllerInterface;
use Digitonic\PassonaClient\Contracts\Controllers\ContactGroupController as ContactGroupControllerInterface;
use Digitonic\PassonaClient\Contracts\Controllers\ContactController as ContactControllerInterface;
use Digitonic\PassonaClient\Contracts\Controllers\TemplateController as TemplateControllerInterface;
use Digitonic\PassonaClient\Contracts\Controllers\VanityDomainController as VanityDomainControllerInterface;
use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest;
use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest;
use Digitonic\PassonaClient\Contracts\Entities\Requests\TemplateRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\TemplateResponse;
use Digitonic\PassonaClient\Controllers\CampaignController;
use Digitonic\PassonaClient\Controllers\ContactController;
use Digitonic\PassonaClient\Controllers\ContactGroupController;
use Digitonic\PassonaClient\Controllers\TemplateController;
use Digitonic\PassonaClient\Controllers\VanityDomainController;
use Digitonic\PassonaClient\Mappers\Requests\CampaignRequestMapper;
use Digitonic\PassonaClient\Mappers\Requests\ContactGroupRequestMapper;
use Digitonic\PassonaClient\Mappers\Requests\ContactRequestMapper;
use Digitonic\PassonaClient\Mappers\Requests\LinkRequestMapper;
use Digitonic\PassonaClient\Mappers\Requests\TemplateRequestMapper;
use Digitonic\PassonaClient\Mappers\Responses\CampaignResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\ContactGroupResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\ContactResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\ContactUploadResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\LinkResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\TemplateResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\UploadedCsvFileResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\VanityDomainResponseMapper;
use GuzzleHttp\Client as GuzzleClient;

class Client implements CampaignControllerInterface, ContactGroupControllerInterface, ContactControllerInterface, TemplateControllerInterface, VanityDomainControllerInterface
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
        $orgId,
        $apiToken,
        $baseUri = 'https://passona.digitonic.co.uk/api/external/v1/'
    )
    {
        $guzzleClient = new GuzzleClient(['base_uri' => $baseUri]);
        $this->campaignManager = new CampaignController($guzzleClient, $orgId, $apiToken);
        $this->campaignManager->setCampaignResponseMapper(new CampaignResponseMapper(new LinkResponseMapper(new VanityDomainResponseMapper())));
        $this->campaignManager->setCampaignRequestMapper(new CampaignRequestMapper(new LinkRequestMapper()));
        $this->contactGroupManager = new ContactGroupController($guzzleClient, $orgId, $apiToken);
        $this->contactGroupManager->setContactGroupRequestMapper(new ContactGroupRequestMapper());
        $this->contactGroupManager->setContactGroupResponseMapper(new ContactGroupResponseMapper());
        $this->contactManager = new ContactController($guzzleClient, $orgId, $apiToken);
        $this->contactManager->setContactUploadMapper(new ContactUploadResponseMapper(new UploadedCsvFileResponseMapper()));
        $this->contactManager->setContactRequestMapper(new ContactRequestMapper());
        $this->contactManager->setContactResponseMapper(new ContactResponseMapper());
        $this->templateManager = new TemplateController($guzzleClient, $orgId, $apiToken);
        $this->templateManager->setTemplateRequestMapper(new TemplateRequestMapper(new LinkRequestMapper()));
        $this->templateManager->setTemplateResponseMapper(new TemplateResponseMapper(new LinkResponseMapper(new VanityDomainResponseMapper())));
        $this->vanityDomainManager = new VanityDomainController($guzzleClient, $orgId, $apiToken);
        $this->vanityDomainManager->setVanityDomainMapper(new VanityDomainResponseMapper());
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