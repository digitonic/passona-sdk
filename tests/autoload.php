<?php
if (file_exists(__DIR__ . '/../vendor/autoload.php')){
    require __DIR__ . '/../vendor/autoload.php';
}

require_once __DIR__ . '/../tests/Features/ClientTestCase.php';

require_once __DIR__ . '/../src/Contracts/Controllers/CampaignController.php';
require_once __DIR__ . '/../src/Contracts/Controllers/ContactGroupController.php';
require_once __DIR__ . '/../src/Contracts/Controllers/ContactController.php';
require_once __DIR__ . '/../src/Contracts/Controllers/TemplateController.php';
require_once __DIR__ . '/../src/Contracts/Controllers/VanityDomainController.php';

require_once __DIR__ . '/../src/Contracts/Entities/Requests/CampaignRequest.php';
require_once __DIR__ . '/../src/Contracts/Entities/Requests/ContactGroupRequest.php';
require_once __DIR__ . '/../src/Contracts/Entities/Requests/ContactRequest.php';
require_once __DIR__ . '/../src/Contracts/Entities/Requests/LinkRequest.php';
require_once __DIR__ . '/../src/Contracts/Entities/Requests/TemplateRequest.php';

require_once __DIR__ . '/../src/Contracts/Entities/Responses/CampaignResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/ContactGroupResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/ContactResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/ContactUploadResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/LinkResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/TemplateResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/UploadedCsvFileResponse.php';
require_once __DIR__ . '/../src/Contracts/Entities/Responses/VanityDomainResponse.php';

require_once __DIR__ . '/../src/Contracts/Mappers/Requests/CampaignRequestMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Requests/ContactRequestMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Requests/ContactGroupRequestMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Requests/LinkRequestMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Requests/TemplateRequestMapper.php';

require_once __DIR__ . '/../src/Contracts/Mappers/Responses/CampaignResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/ContactResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/TemplateResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/ContactGroupResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/ContactUploadResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/LinkResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/UploadedCsvFileResponseMapper.php';
require_once __DIR__ . '/../src/Contracts/Mappers/Responses/VanityDomainResponseMapper.php';

require_once __DIR__ . '/../src/Entities/Requests/TemplateRequest.php';
require_once __DIR__ . '/../src/Entities/Requests/LinkRequest.php';
require_once __DIR__ . '/../src/Entities/Requests/ContactRequest.php';
require_once __DIR__ . '/../src/Entities/Requests/CampaignRequest.php';
require_once __DIR__ . '/../src/Entities/Requests/ContactGroupRequest.php';
require_once __DIR__ . '/../src/Entities/Response/VanityDomainResponse.php';
require_once __DIR__ . '/../src/Entities/Response/UploadedCsvFileResponse.php';
require_once __DIR__ . '/../src/Entities/Response/TemplateResponse.php';
require_once __DIR__ . '/../src/Entities/Response/LinkResponse.php';
require_once __DIR__ . '/../src/Entities/Response/ContactUploadResponse.php';
require_once __DIR__ . '/../src/Entities/Response/ContactResponse.php';
require_once __DIR__ . '/../src/Entities/Response/ContactGroupResponse.php';
require_once __DIR__ . '/../src/Entities/Response/CampaignResponse.php';

require_once __DIR__ . '/../src/Controllers/Controller.php';
require_once __DIR__ . '/../src/Controllers/CampaignController.php';
require_once __DIR__ . '/../src/Controllers/ContactGroupController.php';
require_once __DIR__ . '/../src/Controllers/ContactController.php';
require_once __DIR__ . '/../src/Controllers/TemplateController.php';
require_once __DIR__ . '/../src/Controllers/VanityDomainController.php';

require_once __DIR__ . '/../src/Client.php';

require_once __DIR__ . '/MockObjects/MockResponse.php';
require_once __DIR__ . '/MockObjects/DeleteMockResponse.php';
require_once __DIR__ . '/MockObjects/VanityDomainResponse/GetAllVanityDomainsMockResponse.php';
require_once __DIR__ . '/MockObjects/TemplatesResponses/TemplateMockResponse.php';
require_once __DIR__ . '/MockObjects/TemplatesResponses/GetAllTemplatesMockResponse.php';
require_once __DIR__ . '/MockObjects/TemplatesResponses/GetTemplateMockResponse.php';
require_once __DIR__ . '/MockObjects/TemplatesResponses/PostOrPutTemplateMockResponse.php';
require_once __DIR__ . '/MockObjects/ContactResponses/ContactMockResponse.php';
require_once __DIR__ . '/MockObjects/ContactResponses/GetAllContactsMockResponse.php';
require_once __DIR__ . '/MockObjects/ContactResponses/GetContactMockResponse.php';
require_once __DIR__ . '/MockObjects/ContactResponses/UpsertContactMockResponse.php';
require_once __DIR__ . '/MockObjects/ContactGroupResponses/GetAllContactGroupsMockResponse.php';
require_once __DIR__ . '/MockObjects/ContactGroupResponses/PostOrPutContactGroupMockResponse.php';
require_once __DIR__ . '/MockObjects/CampaignResponses/GetAllCampaignsMockResponse.php';
require_once __DIR__ . '/MockObjects/CampaignResponses/GetCampaignMockeResponse.php';
require_once __DIR__ . '/MockObjects/CampaignResponses/PostOrPutCampaignMockResponse.php';
require_once __DIR__ . '/MockObjects/MockClient.php';

require_once __DIR__ . '/../src/Mappers/Responses/VanityDomainResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Requests/LinkRequestMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/LinkResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Requests/TemplateRequestMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/TemplateResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Requests/ContactGroupRequestMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/ContactGroupResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Requests/ContactRequestMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/ContactResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/UploadedCsvFileResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/ContactUploadResponseMapper.php';
require_once __DIR__ . '/../src/Mappers/Requests/CampaignRequestMapper.php';
require_once __DIR__ . '/../src/Mappers/Responses/CampaignResponseMapper.php';
