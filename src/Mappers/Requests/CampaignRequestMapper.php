<?php


namespace Digitonic\PassonaClient\Mappers\Requests;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest as CampaignRequestInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\CampaignRequestMapper as CampaignRequestMapperInterface;
use Digitonic\PassonaClient\Entities\CampaignRequest;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class CampaignRequestMapper implements CampaignRequestMapperInterface
{
    /**
     * @var LinkRequestMapper
     */
    private $linkRequestMapper;

    public function __construct(LinkRequestMapper $linkRequestMapper)
    {
        $this->linkRequestMapper = $linkRequestMapper;
    }

    /**
     * @param CampaignRequestInterface $campaign
     * @return array
     */
    public function toArray(CampaignRequestInterface $campaign): array
    {
        $campaignArray = [
            'name' => $campaign->getName(),
            'messageTemplateId' => $campaign->getMessageTemplateId(),
            'sender' => $campaign->getSender(),
            'expiryDate' => $campaign->getExpiryDate()->toW3cString(),
            'body' => $campaign->getBody(),
            'recipientType' => $campaign->getRecipientType(),
        ];

        if ($campaign->getRecipientType() === 'groups') {
            $campaignArray['includedContactGroupIds'] = $campaign->getIncludedContactGroupIds();
            $campaignArray['excludedContactGroupIds'] = $campaign->getExcludedContactGroupIds();
        }

        if ($campaign->getRecipientType() === 'numbers') {
            $campaignArray['recipients'] = implode(',', $campaign->getRecipients());
        }

        if ($campaign->getScheduledSendDate()) {
            $campaignArray['scheduledSendDate'] = $campaign->getScheduledSendDate()->toW3cString();
        }

        foreach ($campaign->getLinks() as $link) {
            $campaignArray['links'][] = $this->linkRequestMapper->toArray($link);
        }

        return $campaignArray;
    }

    /**
     * @param array $campaignRequestParameters
     * @param string $campaignRequestClass
     * @return CampaignRequestInterface
     */
    public function fromArray(array $campaignRequestParameters, string $campaignRequestClass = CampaignRequest::class): CampaignRequestInterface
    {
        $reflectionClass = new \ReflectionClass($campaignRequestClass);
        $this->validateCampaignRequestClass($reflectionClass);

        /** @var CampaignRequest $campaignRequest */
        $campaignRequest = $reflectionClass->newInstance();
        $campaignRequest->setName($campaignRequestParameters['name']);
        $campaignRequest->setMessageTemplateId($campaignRequestParameters['messageTemplateId']);
        $campaignRequest->setSender($campaignRequestParameters['sender']);
        $campaignRequest->setExpiryDate(Carbon::parse($campaignRequestParameters['expiryDate']));
        $campaignRequest->setBody($campaignRequestParameters['body']);
        $campaignRequest->setRecipientType($campaignRequestParameters['recipientType']);

        if ($campaignRequestParameters['recipientType'] === 'groups') {
            $campaignRequest->setIncludedContactGroupIds($campaignRequestParameters['includedContactGroupIds']);
            $campaignRequest->setExcludedContactGroupIds($campaignRequestParameters['excludedContactGroupIds']);
        }

        if ($campaignRequestParameters['recipientType'] === 'numbers') {
            $campaignRequest->setRecipients($campaignRequestParameters['recipients']);
        }

        if ($campaignRequestParameters['scheduledSendDate']) {
            $campaignRequest->setScheduledSend(true);
            $campaignRequest->setScheduledSendDate(Carbon::parse($campaignRequestParameters['scheduledSendDate']));
        } else {
            $campaignRequest->setScheduledSend(false);
        }

        foreach ($campaignRequestParameters['links'] as $link) {
            $campaignRequest->addLink($this->linkRequestMapper->fromArray($link));
        }

        return $campaignRequest;
    }

    /**
     * @param CampaignRequestInterface $campaign
     * @return \stdClass
     */
    public function toStdClass(CampaignRequestInterface $campaign): \stdClass
    {
        $campaignStdClass = new \stdClass();
        $campaignStdClass->name = $campaign->getName();
        $campaignStdClass->messageTemplateId = $campaign->getMessageTemplateId();
        $campaignStdClass->sender = $campaign->getSender();
        $campaignStdClass->expiryDate = $campaign->getExpiryDate()->toW3cString();
        $campaignStdClass->body = $campaign->getBody();
        $campaignStdClass->recipientType = $campaign->getRecipientType();

        if ($campaign->getRecipientType() === 'groups') {
            $campaignStdClass->includedContactGroupIds = $campaign->getIncludedContactGroupIds();
            $campaignStdClass->excludedContactGroupIds = $campaign->getExcludedContactGroupIds();
        }

        if ($campaign->getRecipientType() === 'numbers') {
            $campaignStdClass->recipients = implode(',', $campaign->getRecipients());
        }

        if ($campaign->getScheduledSendDate()) {
            $campaignStdClass->scheduledSendDate = $campaign->getScheduledSendDate()->toW3cString();
        }

        foreach ($campaign->getLinks() as $link) {
            $campaignStdClass->links[] = $this->linkRequestMapper->toStdClass($link);
        }

        return $campaignStdClass;
    }

    /**
     * @param \stdClass $campaignRequestParameters
     * @param string $campaignRequestClass
     * @return CampaignRequestInterface
     */
    public function fromStdClass(\stdClass $campaignRequestParameters, string $campaignRequestClass = CampaignRequest::class): CampaignRequestInterface
    {
        $reflectionClass = new \ReflectionClass($campaignRequestClass);
        $this->validateCampaignRequestClass($reflectionClass);

        /** @var CampaignRequest $campaignRequest */
        $campaignRequest = $reflectionClass->newInstance();
        $campaignRequest->setName($campaignRequestParameters->name);
        $campaignRequest->setMessageTemplateId($campaignRequestParameters->messageTemplateId);
        $campaignRequest->setSender($campaignRequestParameters->sender);
        $campaignRequest->setExpiryDate(Carbon::parse($campaignRequestParameters->expiryDate));
        $campaignRequest->setBody($campaignRequestParameters->body);
        $campaignRequest->setRecipientType($campaignRequestParameters->recipientType);

        if ($campaignRequestParameters->recipientType === 'groups') {
            $campaignRequest->setIncludedContactGroupIds($campaignRequestParameters->includedContactGroupIds);
            $campaignRequest->setExcludedContactGroupIds($campaignRequestParameters->excludedContactGroupIds);
        }

        if ($campaignRequestParameters->recipientType === 'numbers') {
            $campaignRequest->setRecipients($campaignRequestParameters->recipients);
        }

        if ($campaignRequestParameters->scheduledSendDate) {
            $campaignRequest->setScheduledSend(true);
            $campaignRequest->setScheduledSendDate(Carbon::parse($campaignRequestParameters->scheduledSendDate));
        } else {
            $campaignRequest->setScheduledSend(false);
        }

        foreach ($campaignRequestParameters->links as $link) {
            $campaignRequest->addLink($this->linkRequestMapper->fromStdClass($link));
        }

        return $campaignRequest;
    }


    /**
     * @param CampaignRequestInterface $campaignRequest
     * @return string
     */
    public function toJson(CampaignRequestInterface $campaignRequest): string
    {
        return json_encode($this->toArray($campaignRequest));
    }

    /**
     * @param string $campaignRequestParameters
     * @param string $campaignRequestClass
     * @return CampaignRequestInterface
     */
    public function fromJson(string $campaignRequestParameters, string $campaignRequestClass = CampaignRequest::class): CampaignRequestInterface
    {
        return $this->fromArray(json_decode($campaignRequestParameters, true), $campaignRequestClass);
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateCampaignRequestClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(CampaignRequestInterface::class)) {
            throw new InterfaceImplementationException(CampaignRequestInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}