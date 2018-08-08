<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Requests;

use Carbon\Carbon;

interface CampaignRequest
{
    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $body
     */
    public function setBody(?string $body);

    /**
     * @return string
     */
    public function getBody(): ?string;

    /**
     * @param int $templateId
     */
    public function setTemplateId(?int $templateId);

    /**
     * @return int
     */
    public function getTemplateId(): ?int;

    /**
     * @param string $sender
     */
    public function setSender(string $sender);

    /**
     * @return string
     */
    public function getSender(): string;

    /**
     * @param string $recipientType
     */
    public function setRecipientType(string $recipientType);

    /**
     * @return string
     */
    public function getRecipientType(): string;

    /**
     * @param array $includedContactGroupIds
     */
    public function setIncludedContactGroupIds(array $includedContactGroupIds);

    /**
     * @return array
     */
    public function getIncludedContactGroupIds(): array;

    /**
     * @param array $excludedContactGroupIds
     */
    public function setExcludedContactGroupIds(array $excludedContactGroupIds);

    /**
     * @return array
     */
    public function getExcludedContactGroupIds(): array;

    /**
     * @param Carbon $expiryDate
     */
    public function setExpiryDate(Carbon $expiryDate);

    /**
     * @return Carbon
     */
    public function getExpiryDate(): Carbon;

    /**
     * @param array $links
     */
    public function setLinks(array $links);

    /**
     * @return array
     */
    public function getLinks(): array;

    /**
     * @param LinkRequest $link
     */
    public function addLink(LinkRequest $link);

    /**
     * @param Carbon $scheduledSendDate
     */
    public function setScheduledSendDate(Carbon $scheduledSendDate);

    /**
     * @return Carbon
     */
    public function getScheduledSendDate(): ?Carbon;

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients);

    /**
     * @return string
     */
    public function getRecipients(): ?string;
}