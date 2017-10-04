<?php


namespace Digitonic\PassonaClient\Entities;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\CampaignResponse as CampaignResponseInterface;
use Digitonic\PassonaClient\Contracts\Entities\Responses\LinkResponse;

class CampaignResponse implements CampaignResponseInterface
{
    const STATUS_QUEUED = 1;
    const STATUS_PREPARING = 2;
    const STATUS_SENDING = 3;
    const STATUS_COMPLETE = 4;
    const STATUS_UNKNOWN = 9;

    const RECIPIENT_TYPE_GROUPS = 'groups';
    const RECIPIENT_TYPE_NUMBERS = 'numbers';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $messageTemplate;
    /**
     * @var string
     */
    private $sender;
    /**
     * @var bool
     */
    private $scheduledSend;
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var string
     */
    private $statusDescription;
    /**
     * @var Carbon
     */
    private $startedSendingAt;
    /**
     * @var bool
     */
    private $isViewable;
    /**
     * @var bool
     */
    private $isEditable;
    /**
     * @var bool
     */
    private $isDeletable;
    /**
     * @var Carbon
     */
    private $createdAt;
    /**
     * @var Carbon
     */
    private $updatedAt;
    /**
     * @var string
     */
    private $recipientType;
    /**
     * @var array
     */
    private $includedContactGroupIds = [];
    /**
     * @var array
     */
    private $excludedContactGroupIds = [];
    /**
     * @var Carbon
     */
    private $expiryDate;
    /**
     * @var string
     */
    private $body;
    /**
     * @var Carbon
     */
    private $finishedSendingAt;
    /**
     * @var int
     */
    private $numberOfRecpient;
    /**
     * @var array
     */
    private $links = [];

    /**
     * @var Carbon
     */
    private $scheduledSendDate;

    /**
     * @var array
     */
    private $recipients = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMessageTemplate(): string
    {
        return $this->messageTemplate;
    }

    /**
     * @param string $messageTemplate
     */
    public function setMessageTemplate(string $messageTemplate)
    {
        $this->messageTemplate = $messageTemplate;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     */
    public function setSender(string $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return bool
     */
    public function isScheduledSend(): bool
    {
        return $this->scheduledSend;
    }

    /**
     * @param bool $scheduledSend
     */
    public function setScheduledSend(bool $scheduledSend)
    {
        $this->scheduledSend = $scheduledSend;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getStatusDescription(): string
    {
        return $this->statusDescription;
    }

    /**
     * @param string $statusDescription
     */
    public function setStatusDescription(string $statusDescription)
    {
        $this->statusDescription = $statusDescription;
    }

    /**
     * @return Carbon
     */
    public function getStartedSendingAt(): Carbon
    {
        return $this->startedSendingAt;
    }

    /**
     * @param Carbon|null $startedSendingAt
     */
    public function setStartedSendingAt(?Carbon $startedSendingAt)
    {
        $this->startedSendingAt = $startedSendingAt;
    }

    /**
     * @return bool
     */
    public function isViewable(): bool
    {
        return $this->isViewable;
    }

    /**
     * @param bool $isViewable
     */
    public function setIsViewable(bool $isViewable)
    {
        $this->isViewable = $isViewable;
    }

    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->isEditable;
    }

    /**
     * @param bool $isEditable
     */
    public function setIsEditable(bool $isEditable)
    {
        $this->isEditable = $isEditable;
    }

    /**
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->isDeletable;
    }

    /**
     * @param bool $isDeletable
     */
    public function setIsDeletable(bool $isDeletable)
    {
        $this->isDeletable = $isDeletable;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getRecipientType(): string
    {
        return $this->recipientType;
    }

    /**
     * @param string $recipientType
     */
    public function setRecipientType(string $recipientType)
    {
        $this->recipientType = $recipientType;
    }

    /**
     * @return array
     */
    public function getIncludedContactGroupIds(): array
    {
        return $this->includedContactGroupIds;
    }

    /**
     * @param array $includedContactGroupIds
     */
    public function setIncludedContactGroupIds(array $includedContactGroupIds)
    {
        $this->includedContactGroupIds = $includedContactGroupIds;
    }

    /**
     * @return array
     */
    public function getExcludedContactGroupIds(): array
    {
        return $this->excludedContactGroupIds;
    }

    /**
     * @param array $excludedContactGroupIds
     */
    public function setExcludedContactGroupIds(array $excludedContactGroupIds)
    {
        $this->excludedContactGroupIds = $excludedContactGroupIds;
    }

    /**
     * @return Carbon
     */
    public function getExpiryDate(): Carbon
    {
        return $this->expiryDate;
    }

    /**
     * @param Carbon $expiryDate
     */
    public function setExpiryDate(Carbon $expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return Carbon
     */
    public function getFinishedSendingAt(): Carbon
    {
        return $this->finishedSendingAt;
    }

    /**
     * @param Carbon $finishedSendingAt
     */
    public function setFinishedSendingAt(Carbon $finishedSendingAt)
    {
        $this->finishedSendingAt = $finishedSendingAt;
    }

    /**
     * @return int
     */
    public function getNumberOfRecipient(): int
    {
        return $this->numberOfRecpient;
    }

    /**
     * @param int $numberOfRecpient
     */
    public function setNumberOfRecipient(int $numberOfRecpient)
    {
        $this->numberOfRecpient = $numberOfRecpient;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array $links
     */
    public function setLinks(array $links)
    {
        $this->links = $links;
    }

    public function addLink(LinkResponse $link)
    {
        $this->links[] = $link;
    }

    /**
     * @return Carbon
     */
    public function getScheduledSendDate(): Carbon
    {
        return $this->scheduledSendDate;
    }

    /**
     * @param Carbon $scheduledSendDate
     */
    public function setScheduledSendDate(Carbon $scheduledSendDate)
    {
        $this->scheduledSendDate = $scheduledSendDate;
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
    }
}