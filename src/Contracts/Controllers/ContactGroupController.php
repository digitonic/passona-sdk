<?php


namespace Digitonic\PassonaClient\Contracts\Controllers;


use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse;

interface ContactGroupController
{
    public function getAllContactGroups(): array;
    public function postContactGroup(ContactGroupRequest $contactGroupRequest): ContactGroupResponse;
    public function putContactGroup(int $groupId, ContactGroupRequest $contactGroupRequestDTO): ContactGroupResponse;
    public function deleteContactGroup(int $groupId): bool;
}