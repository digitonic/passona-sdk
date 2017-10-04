<?php


namespace Digitonic\PassonaClient\Entities;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Requests\CampaignRequest as CampaignRequestInterface;
use Digitonic\PassonaClient\Contracts\Entities\Requests\LinkRequest;

class CampaignRequest implements CampaignRequestInterface
{
    const STATUS_QUEUED = 1;
    const STATUS_PREPARING = 2;
    const STATUS_SENDING = 3;
    const STATUS_COMPLETE = 4;
    const STATUS_UNKNOWN = 9;

    const RECIPIENT_TYPE_GROUPS = 'groups';
    const RECIPIENT_TYPE_NUMBERS = 'numbers';

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $sender;
    /**
     * @var bool
     */
    private $scheduledSend;
    /**
     * @var string
     */
    private $recipientType;
    /**
     * @var array
     */
    private $includedContactGroupIds;
    /**
     * @var array
     */
    private $excludedContactGroupIds;
    /**
     * @var Carbon
     */
    private $expiryDate;
    /**
     * @var string
     */
    private $body;
    /**
     * @var array
     */
    private $links;

    /**
     * @var Carbon
     */
    private $scheduledSendDate;

    /**
     * @var string
     */
    private $recipients;

    /**
     * @var int
     */
    private $messageTemplateId;

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

    public function addLink(LinkRequest $link)
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
     * @return string
     */
    public function getRecipients(): string
    {
        return $this->recipients;
    }

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = implode(',', $recipients);
    }

    /**
     * @param int $messageTemplateId
     */
    public function setMessageTemplateId(int $messageTemplateId)
    {
        $this->messageTemplateId = $messageTemplateId;
    }

    /**
     * @return int
     */
    public function getMessageTemplateId(): int
    {
        return $this->messageTemplateId;
    }
}