<?php


namespace Tests\Feature;


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
use GuzzleHttp\Client;
use Tests\MockObjects\MockClient;

class ClientTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Digitonic\PassonaClient\Client
     */
    protected $client;

    public function setUp()
    {
        $client = new MockClient();
//        $client = new Client(['base_uri' => "http://sms.platonic.com/api/external/v1/"]);

        $this->buildClient($client);
    }

    /**
     * @return CampaignController
     */
    private function buildCampaignController(Client $client): CampaignController
    {
        $campaignController = new CampaignController($client, getenv('ORG_ID'), getenv('USERNAME'), getenv('API_KEY'));
        $campaignController->setCampaignResponseMapper(new CampaignResponseMapper(new LinkResponseMapper(new VanityDomainResponseMapper())));
        $campaignController->setCampaignRequestMapper(new CampaignRequestMapper(new LinkRequestMapper()));

        return $campaignController;
    }

    /**
     * @param Client $client
     * @return ContactGroupController
     */
    private function buildContactGroupController(Client $client): ContactGroupController
    {
        $contactGroupController = new ContactGroupController($client, getenv('ORG_ID'), getenv('USERNAME'), getenv('API_KEY'));
        $contactGroupController->setContactGroupRequestMapper(new ContactGroupRequestMapper());
        $contactGroupController->setContactGroupResponseMapper(new ContactGroupResponseMapper());

        return $contactGroupController;
    }

    /**
     * @param $client
     * @return ContactController
     */
    private function buildContactController($client): ContactController
    {
        $contactController = new ContactController($client, getenv('ORG_ID'), getenv('USERNAME'), getenv('API_KEY'));
        $contactController->setContactResponseMapper(new ContactResponseMapper());
        $contactController->setContactRequestMapper(new ContactRequestMapper());
        $contactController->setContactUploadMapper(new ContactUploadResponseMapper(new UploadedCsvFileResponseMapper()));
        return $contactController;
    }

    /**
     * @param $client
     * @return TemplateController
     */
    private function buildTemplateController($client): TemplateController
    {
        $templateController = new TemplateController($client, getenv('ORG_ID'), getenv('USERNAME'), getenv('API_KEY'));
        $templateController->setTemplateResponseMapper(new TemplateResponseMapper(new LinkResponseMapper(new VanityDomainResponseMapper())));
        $templateController->setTemplateRequestMapper(new TemplateRequestMapper(new LinkRequestMapper()));
        return $templateController;
    }

    /**
     * @param $client
     * @return VanityDomainController
     */
    private function buildVanityDomainController($client): VanityDomainController
    {
        $vanityDomainController = new VanityDomainController($client, getenv('ORG_ID'), getenv('USERNAME'), getenv("API_KEY"));
        $vanityDomainController->setVanityDomainMapper(new VanityDomainResponseMapper());
        return $vanityDomainController;
    }

    /**
     * @param $client
     */
    private function buildClient(Client $client): void
    {
        $campaignController = $this->buildCampaignController($client);
        $contactGroupController = $this->buildContactGroupController($client);
        $contactController = $this->buildContactController($client);
        $templateController = $this->buildTemplateController($client);
        $vanityDomainController = $this->buildVanityDomainController($client);

        $this->client = new \Digitonic\PassonaClient\Client($campaignController, $contactGroupController, $contactController, $templateController, $vanityDomainController);
    }
}