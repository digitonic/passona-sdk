<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\LinkRequest;

interface CampaignResponse
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getMessageTemplate(): string;

    /**
     * @param string $messageTemplate
     */
    public function setMessageTemplate(string $messageTemplate);

    /**
     * @return string
     */
    public function getSender(): string;

    /**
     * @param string $sender
     */
    public function setSender(string $sender);

    /**
     * @return bool
     */
    public function isScheduledSend(): bool;

    /**
     * @param bool $scheduledSend
     */
    public function setScheduledSend(bool $scheduledSend);

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode);

    /**
     * @return string
     */
    public function getStatusDescription(): string;

    /**
     * @param string $statusDescription
     */
    public function setStatusDescription(string $statusDescription);

    /**
     * @return Carbon
     */
    public function getStartedSendingAt(): Carbon;

    /**
     * @param Carbon $startedSendingAt
     */
    public function setStartedSendingAt(?Carbon $startedSendingAt);

    /**
     * @return bool
     */
    public function isViewable(): bool;

    /**
     * @param bool $isViewable
     */
    public function setIsViewable(bool $isViewable);

    /**
     * @return bool
     */
    public function isEditable(): bool;

    /**
     * @param bool $isEditable
     */
    public function setIsEditable(bool $isEditable);

    /**
     * @return bool
     */
    public function isDeletable(): bool;

    /**
     * @param bool $isDeletable
     */
    public function setIsDeletable(bool $isDeletable);

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon;

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt);

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon;

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt);

    /**
     * @return string
     */
    public function getRecipientType(): string;

    /**
     * @param string $recipientType
     */
    public function setRecipientType(string $recipientType);

    /**
     * @return array
     */
    public function getIncludedContactGroupIds(): array;

    /**
     * @param array $includedContactGroupIds
     */
    public function setIncludedContactGroupIds(array $includedContactGroupIds);

    /**
     * @return array
     */
    public function getExcludedContactGroupIds(): array;

    /**
     * @param array $excludedContactGroupIds
     */
    public function setExcludedContactGroupIds(array $excludedContactGroupIds);

    /**
     * @return Carbon
     */
    public function getExpiryDate(): Carbon;

    /**
     * @param Carbon $expiryDate
     */
    public function setExpiryDate(Carbon $expiryDate);

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @param string $body
     */
    public function setBody(string $body);

    /**
     * @return Carbon
     */
    public function getFinishedSendingAt(): Carbon;

    /**
     * @param Carbon $finishedSendingAt
     */
    public function setFinishedSendingAt(Carbon $finishedSendingAt);

    /**
     * @return int
     */
    public function getNumberOfRecipient(): int;

    /**
     * @param int $numberOfRecpient
     */
    public function setNumberOfRecipient(int $numberOfRecpient);

    /**
     * @return array
     */
    public function getLinks(): array;

    /**
     * @param array $links
     */
    public function setLinks(array $links);

    /**
     * @param LinkResponse $link
     */
    public function addLink(LinkResponse $link);

    /**
     * @return Carbon
     */
    public function getScheduledSendDate(): Carbon;

    /**
     * @param Carbon $scheduledSendDate
     */
    public function setScheduledSendDate(Carbon $scheduledSendDate);

    /**
     * @return array
     */
    public function getRecipients(): array;

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients);
}