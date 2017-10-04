<?php


namespace Digitonic\PassonaClient\Mappers\Responses;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\CampaignResponseMapper as CampaignResponseMapperInterface;
use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse as CampaignResponseInterface;
use Digitonic\PassonaClient\Entities\CampaignResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class CampaignResponseMapper implements CampaignResponseMapperInterface
{
    /**
     * @var LinkResponseMapper
     */
    private $linkResponseMapper;

    public function __construct(LinkResponseMapper $linkMapper)
    {
        $this->linkResponseMapper = $linkMapper;
    }

    /**
     * @param \stdClass $campaignResponseParameters
     * @param string $campaignResponseClass
     * @return CampaignResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $campaignResponseParameters, string $campaignResponseClass = CampaignResponse::class): CampaignResponseInterface
    {
        $reflectionClass = new \ReflectionClass($campaignResponseClass);
        $this->validateCampaignResponseClass($reflectionClass);

        /** @var CampaignResponse $campaign */
        $campaign = $reflectionClass->newInstance();
        $campaign->setId($campaignResponseParameters->id);
        $campaign->setName($campaignResponseParameters->name);
        $campaign->setMessageTemplate($campaignResponseParameters->messageTemplate);
        $campaign->setSender($campaignResponseParameters->sender);
        $campaign->setScheduledSend($campaignResponseParameters->scheduledSend);
        $campaign->setStatusCode($campaignResponseParameters->statusCode);
        $campaign->setStatusDescription($campaignResponseParameters->statusDescription);
        $campaign->setStartedSendingAt($campaignResponseParameters->startedSendingAt !== null ? Carbon::parse($campaignResponseParameters->startedSendingAt) : null);
        $campaign->setIsViewable($campaignResponseParameters->isViewable);
        $campaign->setIsEditable($campaignResponseParameters->isEditable);
        $campaign->setIsDeletable($campaignResponseParameters->isDeletable);
        $campaign->setCreatedAt(Carbon::parse($campaignResponseParameters->createdAt));
        $campaign->setUpdatedAt(Carbon::parse($campaignResponseParameters->updatedAt));
        $campaign->setExpiryDate(Carbon::parse($campaignResponseParameters->expiryDate));
        $campaign->setBody($campaignResponseParameters->body);
        $campaign->setFinishedSendingAt(Carbon::parse($campaignResponseParameters->finishedSendingAt));
        $campaign->setNumberOfRecipient($campaignResponseParameters->numberOfRecipients);

        if ($campaignResponseParameters->recipientType === 'groups') {
            $campaign->setRecipientType('groups');
            $campaign->setIncludedContactGroupIds($campaignResponseParameters->includedContactGroupIds);
            $campaign->setExcludedContactGroupIds($campaignResponseParameters->excludedContactGroupIds);
        }

        if ($campaignResponseParameters->recipientType === 'numbers') {
            $campaign->setRecipientType('numbers');
            $campaign->setRecipients(explode(',', $campaignResponseParameters->recipients));
        }

        if ($campaignResponseParameters->scheduledSend) {
            $campaign->setScheduledSend(true);
            $campaign->setScheduledSendDate(Carbon::parse($campaignResponseParameters->scheduledSendDate));
        }

        foreach ($campaignResponseParameters->links->data as $linkDatum) {
            $campaign->addLink($this->linkResponseMapper->fromStdClass($linkDatum));
        }

        return $campaign;
    }

    /**
     * @param CampaignResponseInterface $campaignResponse
     * @return \stdClass
     */
    public function toStdClass(CampaignResponseInterface $campaignResponse): \stdClass
    {
        $campaignResponseStdClass = new \stdClass();
        $campaignResponseStdClass->id = $campaignResponse->getId();
        $campaignResponseStdClass->name = $campaignResponse->getName();
        $campaignResponseStdClass->messageTemplate = $campaignResponse->getMessageTemplate();
        $campaignResponseStdClass->sender = $campaignResponse->getSender();
        $campaignResponseStdClass->scheduledSend = $campaignResponse->isScheduledSend();
        $campaignResponseStdClass->statusCode = $campaignResponse->getStatusCode();
        $campaignResponseStdClass->statusDescription = $campaignResponse->getStatusDescription();
        $campaignResponseStdClass->startedSendingAt = $campaignResponse->getStartedSendingAt() !== null ? $campaignResponse->getStartedSendingAt()->toW3cString() : null;
        $campaignResponseStdClass->isViewable = $campaignResponse->isViewable();
        $campaignResponseStdClass->isEditable = $campaignResponse->isEditable();
        $campaignResponseStdClass->isDeletable = $campaignResponse->isDeletable();
        $campaignResponseStdClass->createdAt = $campaignResponse->getCreatedAt()->toW3cString();
        $campaignResponseStdClass->updatedAt = $campaignResponse->getUpdatedAt()->toW3cString();
        $campaignResponseStdClass->expiryDate = $campaignResponse->getExpiryDate()->toW3cString();
        $campaignResponseStdClass->body = $campaignResponse->getBody();
        $campaignResponseStdClass->finishedSendingAt = $campaignResponse->getFinishedSendingAt()->toW3cString();
        $campaignResponseStdClass->numberOfRecipients = $campaignResponse->getNumberOfRecipient();

        if ($campaignResponse->getRecipientType() === 'groups') {
            $campaignResponseStdClass->recipientType = 'groups';
            $campaignResponseStdClass->includedContactGroupIds = $campaignResponse->getIncludedContactGroupIds();
            $campaignResponseStdClass->excludedContactGroupIds = $campaignResponse->getExcludedContactGroupIds();
        }

        if ($campaignResponse->getRecipientType() === 'numbers') {
            $campaignResponseStdClass->recipientType = 'numbers';
            $campaignResponseStdClass->recipients = implode(',',$campaignResponse->getRecipients());
        }

        if ($campaignResponse->isScheduledSend()) {
            $campaignResponseStdClass->scheduledSend = true;
            $campaignResponseStdClass->scheduledSendDate = $campaignResponse->getScheduledSendDate()->toW3cString();
        }

        $campaignResponseStdClass->links = new \stdClass();
        $campaignResponseStdClass->links->data = [];
        foreach ($campaignResponse->getLinks() as $linkDatum) {
            $campaignResponseStdClass->links['data'][] = $this->linkResponseMapper->toStdClass($linkDatum);
        }

        return $campaignResponseStdClass;
    }

    /**
     * @param array $campaignResponseParameters
     * @param string $campaignResponseClass
     * @return CampaignResponseInterface
     */
    public function fromArray(array $campaignResponseParameters, string $campaignResponseClass = CampaignResponse::class): CampaignResponseInterface
    {
        $reflectionClass = new \ReflectionClass($campaignResponseClass);
        $this->validateCampaignResponseClass($reflectionClass);

        /** @var CampaignResponse $campaign */
        $campaign = $reflectionClass->newInstance();
        $campaign->setId($campaignResponseParameters['id']);
        $campaign->setName($campaignResponseParameters['name']);
        $campaign->setMessageTemplate($campaignResponseParameters['messageTemplate']);
        $campaign->setSender($campaignResponseParameters['sender']);
        $campaign->setScheduledSend($campaignResponseParameters['scheduledSend']);
        $campaign->setStatusCode($campaignResponseParameters['statusCode']);
        $campaign->setStatusDescription($campaignResponseParameters['statusDescription']);
        $campaign->setStartedSendingAt($campaignResponseParameters['startedSendingAt'] !== null ? Carbon::parse($campaignResponseParameters['startedSendingAt']) : null);
        $campaign->setIsViewable($campaignResponseParameters['isViewable']);
        $campaign->setIsEditable($campaignResponseParameters['isEditable']);
        $campaign->setIsDeletable($campaignResponseParameters['isDeletable']);
        $campaign->setCreatedAt(Carbon::parse($campaignResponseParameters['createdAt']));
        $campaign->setUpdatedAt(Carbon::parse($campaignResponseParameters['updatedAt']));
        $campaign->setExpiryDate(Carbon::parse($campaignResponseParameters['expiryDate']));
        $campaign->setBody($campaignResponseParameters['body']);
        $campaign->setFinishedSendingAt(Carbon::parse($campaignResponseParameters['finishedSendingAt']));
        $campaign->setNumberOfRecipient($campaignResponseParameters['numberOfRecipients']);

        if ($campaignResponseParameters['recipientType'] === 'groups') {
            $campaign->setRecipientType('groups');
            $campaign->setIncludedContactGroupIds($campaignResponseParameters['includedContactGroupIds']);
            $campaign->setExcludedContactGroupIds($campaignResponseParameters['excludedContactGroupIds']);
        }

        if ($campaignResponseParameters['recipientType'] === 'numbers') {
            $campaign->setRecipientType('numbers');
            $campaign->setRecipients(explode(',', $campaignResponseParameters['recipients']));
        }

        if ($campaignResponseParameters['scheduledSend']) {
            $campaign->setScheduledSend(true);
            $campaign->setScheduledSendDate(Carbon::parse($campaignResponseParameters['scheduledSendDate']));
        }

        foreach ($campaignResponseParameters['links']['data'] as $linkDatum) {
            $campaign->addLink($this->linkResponseMapper->convertStdClassToLinkResponse($linkDatum));
        }

        return $campaign;
    }

    /**
     * @param CampaignResponseInterface $campaignResponse
     * @return array
     */
    public function toArray(CampaignResponseInterface $campaignResponse): array
    {
        $campaignResponseStdClass = [];
        $campaignResponseStdClass['id'] = $campaignResponse->getId();
        $campaignResponseStdClass['name'] = $campaignResponse->getName();
        $campaignResponseStdClass['messageTemplate'] = $campaignResponse->getMessageTemplate();
        $campaignResponseStdClass['sender'] = $campaignResponse->getSender();
        $campaignResponseStdClass['scheduledSend'] = $campaignResponse->isScheduledSend();
        $campaignResponseStdClass['statusCode'] = $campaignResponse->getStatusCode();
        $campaignResponseStdClass['statusDescription'] = $campaignResponse->getStatusDescription();
        $campaignResponseStdClass['startedSendingAt'] = $campaignResponse->getStartedSendingAt() !== null ? $campaignResponse->getStartedSendingAt()->toW3cString() : null;
        $campaignResponseStdClass['isViewable'] = $campaignResponse->isViewable();
        $campaignResponseStdClass['isEditable'] = $campaignResponse->isEditable();
        $campaignResponseStdClass['isDeletable'] = $campaignResponse->isDeletable();
        $campaignResponseStdClass['createdAt'] = $campaignResponse->getCreatedAt()->toW3cString();
        $campaignResponseStdClass['updatedAt'] = $campaignResponse->getUpdatedAt()->toW3cString();
        $campaignResponseStdClass['expiryDate'] = $campaignResponse->getExpiryDate()->toW3cString();
        $campaignResponseStdClass['body'] = $campaignResponse->getBody();
        $campaignResponseStdClass['finishedSendingAt'] = $campaignResponse->getFinishedSendingAt()->toW3cString();
        $campaignResponseStdClass['numberOfRecipients'] = $campaignResponse->getNumberOfRecipient();

        if ($campaignResponse->getRecipientType() === 'groups') {
            $campaignResponse->setRecipientType('groups');
            $campaignResponseStdClass['includedContactGroupIds'] = $campaignResponse->getIncludedContactGroupIds();
            $campaignResponseStdClass['excludedContactGroupIds'] = $campaignResponse->getExcludedContactGroupIds();
        }

        if ($campaignResponse->getRecipientType() === 'numbers') {
            $campaignResponseStdClass['recipientType'] = 'numbers';
            $campaignResponseStdClass['recipients'] = implode(',',$campaignResponse->getRecipients());
        }

        if ($campaignResponse->isScheduledSend()) {
            $campaignResponseStdClass['scheduledSend'] = true;
            $campaignResponseStdClass['scheduledSendDate'] = $campaignResponse->getScheduledSendDate()->toW3cString();
        }

        $campaignResponseStdClass['links'] = ['data' => []];
        foreach ($campaignResponse->getLinks() as $linkDatum) {
            $campaignResponseStdClass['links']['data'][] = $this->linkResponseMapper->toStdClass($linkDatum);
        }

        return $campaignResponseStdClass;
    }

    /**
     * @param string $campaignResponseParameters
     * @param string $campaignResponseClass
     * @return CampaignResponseInterface
     */
    public function fromJson(string $campaignResponseParameters, string $campaignResponseClass = CampaignResponse::class): CampaignResponseInterface
    {
        return $this->fromArray(json_decode($campaignResponseParameters, true), $campaignResponseClass);
    }

    /**
     * @param CampaignResponseInterface $campaignResponse
     * @return string
     */
    public function toJson(CampaignResponseInterface $campaignResponse): string
    {
        return json_encode($this->toArray($campaignResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateCampaignResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(CampaignResponseInterface::class)) {
            throw new InterfaceImplementationException(CampaignResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}