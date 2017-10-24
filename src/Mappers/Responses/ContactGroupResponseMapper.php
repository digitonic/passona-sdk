<?php


namespace Digitonic\PassonaClient\Mappers\Responses;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactGroupResponse as ContactGroupResponseInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\ContactGroupResponseMapper as ContactGroupResponseMapperInterface;
use Digitonic\PassonaClient\Entities\ContactGroupResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class ContactGroupResponseMapper implements ContactGroupResponseMapperInterface
{
    /**
     * @param \stdClass $contactGroupResponseParameters
     * @param string $contactGroupResponseClass
     * @return ContactGroupResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $contactGroupResponseParameters, string $contactGroupResponseClass = ContactGroupResponse::class): ContactGroupResponseInterface
    {
        $reflectionClass = new \ReflectionClass($contactGroupResponseClass);
        $this->validateContactGroupResponseClass($reflectionClass);

        /** @var ContactGroupResponseInterface $contactGroupResponse */
        $contactGroupResponse = $reflectionClass->newInstance();
        $contactGroupResponse->setId($contactGroupResponseParameters->id);
        $contactGroupResponse->setNumberOfUniqueProfiles($contactGroupResponseParameters->numberOfUniqueProfiles);
        $contactGroupResponse->setNumberOfContacts($contactGroupResponseParameters->numberOfContacts);
        $contactGroupResponse->setDescription($contactGroupResponseParameters->description ?? '');

        $fields = [];
        foreach($contactGroupResponseParameters->fields as $key => $value){
            $fields[$key] = $value;
        }

        $contactGroupResponse->setFields($fields);
        $contactGroupResponse->setName($contactGroupResponseParameters->name);
        $contactGroupResponse->setUpdatedAt(Carbon::parse($contactGroupResponseParameters->updatedAt));
        $contactGroupResponse->setCreatedAt(Carbon::parse($contactGroupResponseParameters->createdAt));

        return $contactGroupResponse;
    }

    /**
     * @param ContactGroupResponseInterface $contactGroupResponse
     * @return \stdClass
     */
    public function toStdClass(ContactGroupResponseInterface $contactGroupResponse): \stdClass
    {
        $contactGroupResponseStdClass = new \stdClass();
        $contactGroupResponseStdClass->id = $contactGroupResponse->getId();
        $contactGroupResponseStdClass->numberOfUniqueProfiles = $contactGroupResponse->getNumberOfUniqueProfiles();
        $contactGroupResponseStdClass->numberOfContacts = $contactGroupResponse->getNumberOfContacts();
        $contactGroupResponseStdClass->description = $contactGroupResponse->getDescription();
        $contactGroupResponseStdClass->fields = new \stdClass();
        foreach($contactGroupResponse->getFields() as $key => $value){
            $contactGroupResponseStdClass->fields->$key = $value;
        }
        $contactGroupResponseStdClass->name = $contactGroupResponse->getName();
        $contactGroupResponseStdClass->updatedAt = $contactGroupResponse->getUpdatedAt()->toW3cString();
        $contactGroupResponseStdClass->createdAt = $contactGroupResponse->getCreatedAt()->toW3cString();

        return $contactGroupResponseStdClass;
    }

    /**
     * @param array $contactGroupResponseParameters
     * @param string $contactGroupResponseClass
     * @return ContactGroupResponseInterface
     */
    public function fromArray(array $contactGroupResponseParameters, string $contactGroupResponseClass = ContactGroupResponse::class): ContactGroupResponseInterface
    {
        $reflectionClass = new \ReflectionClass($contactGroupResponseClass);
        $this->validateContactGroupResponseClass($reflectionClass);

        /** @var ContactGroupResponseInterface $contactGroupResponse */
        $contactGroupResponse = $reflectionClass->newInstance();
        $contactGroupResponse->setId($contactGroupResponseParameters['id']);
        $contactGroupResponse->setNumberOfUniqueProfiles($contactGroupResponseParameters['numberOfUniqueProfiles']);
        $contactGroupResponse->setNumberOfContacts($contactGroupResponseParameters['numberOfContacts']);
        $contactGroupResponse->setDescription($contactGroupResponseParameters['description']);
        $contactGroupResponse->setFields($contactGroupResponseParameters['fields']);
        $contactGroupResponse->setName($contactGroupResponseParameters['name']);
        $contactGroupResponse->setUpdatedAt(Carbon::parse($contactGroupResponseParameters['updatedAt']));
        $contactGroupResponse->setCreatedAt(Carbon::parse($contactGroupResponseParameters['createdAt']));

        return $contactGroupResponse;
    }

    /**
     * @param ContactGroupResponseInterface $contactGroupResponse
     * @return array
     */
    public function toArray(ContactGroupResponseInterface $contactGroupResponse): array
    {
        $contactGroupResponseArray = [];
        $contactGroupResponseArray['id'] = $contactGroupResponse->getId();
        $contactGroupResponseArray['numberOfUniqueProfiles'] = $contactGroupResponse->getNumberOfUniqueProfiles();
        $contactGroupResponseArray['numberOfContacts'] = $contactGroupResponse->getNumberOfContacts();
        $contactGroupResponseArray['description'] = $contactGroupResponse->getDescription();
        $contactGroupResponseArray['fields'] = $contactGroupResponse->getFields();
        $contactGroupResponseArray['name'] = $contactGroupResponse->getName();
        $contactGroupResponseArray['updatedAt'] = $contactGroupResponse->getUpdatedAt()->toW3cString();
        $contactGroupResponseArray['createdAt'] = $contactGroupResponse->getCreatedAt()->toW3cString();

        return $contactGroupResponseArray;
    }

    /**
     * @param string $contactGroupResponseParameters
     * @return ContactGroupResponseInterface
     */
    public function fromJson(string $contactGroupResponseParameters, string $contactGroupResponseClass = ContactGroupResponse::class): ContactGroupResponseInterface
    {
        return $this->fromArray(json_decode($contactGroupResponseParameters, true), $contactGroupResponseClass);
    }

    /**
     * @param ContactGroupResponseInterface $contactGroupResponse
     * @return string
     */
    public function toJson(ContactGroupResponseInterface $contactGroupResponse): string
    {
        return json_encode($this->toArray($contactGroupResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateContactGroupResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(ContactGroupResponseInterface::class)) {
            throw new InterfaceImplementationException(ContactGroupResponse::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}