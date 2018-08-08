<?php


namespace Digitonic\PassonaClient\Contracts\Controllers;


use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse;

interface ContactController
{
    public function getAllContactsInContactGroup(int $groupId): array;
    public function getContactInContactGroup(int $groupId, int $contactId): ContactResponse;
    public function upsertContactsToContactGroup(int $groupId, array $contacts): ContactUploadResponse;
    public function deleteContactFromContactGroup(int $groupId, string $phoneNumber): bool;
    public function upsertGroupsToContact(array $contact, array $groups);
}