<?php


namespace Digitonic\PassonaClient\Mappers\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactResponse as ContactResponseInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\ContactResponseMapper as ContactResponseMapperInterface;
use Digitonic\PassonaClient\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class ContactResponseMapper implements ContactResponseMapperInterface
{

    /**
     * @param \stdClass $contactResponseParameters
     * @param string $contactResponseClass
     * @return ContactResponseInterface
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    public function fromStdClass(\stdClass $contactResponseParameters, string $contactResponseClass = ContactResponse::class): ContactResponseInterface
    {
        $reflectionClass = new \ReflectionClass($contactResponseClass);

        $this->validateContactRequestClass($reflectionClass);

        /** @var ContactResponseInterface $contact */
        $contact = $reflectionClass->newInstance();
        $contact->setId($contactResponseParameters->id);
        $contact->setPhoneNumber($contactResponseParameters->phoneNumber);
        $contact->setUpdatedAt(Carbon::parse($contactResponseParameters->updatedAt));
        if (isset($contactResponseParameters->customFields)) {
            foreach ($contactResponseParameters->customFields as $key => $value) {
                $contact->addCustomField($key, $value);
            }
        }

        return $contact;
    }

    /**
     * @param ContactResponseInterface $contactResponse
     * @return \stdClass
     */
    public function toStdClass(ContactResponseInterface $contactResponse): \stdClass
    {
        $contactResponseStdClass = new \stdClass();
        /** @var ContactResponseInterface $contactResponse */
        $contactResponseStdClass->id = $contactResponse->getId();
        $contactResponseStdClass->phoneNumber = $contactResponse->getPhoneNumber();
        $contactResponseStdClass->updatedAt = $contactResponse->getUpdatedAt()->toW3cString();
        if (!empty($contactResponse->getCustomFields())) {
            $contactResponseStdClass->customFields = new \stdClass();
            foreach ($contactResponse->getCustomFields() as $key => $value) {
                $contactResponseStdClass->customFields->$key = $value;
            }
        }

        return $contactResponseStdClass;
    }


    /**
     * @param array $contactResponseParameters
     * @param string $contactResponseClass
     * @return ContactResponseInterface
     */
    public function fromArray(array $contactResponseParameters, string $contactResponseClass = ContactResponse::class): ContactResponseInterface
    {
        $reflectionClass = new \ReflectionClass($contactResponseClass);

        $this->validateContactRequestClass($reflectionClass);

        /** @var ContactResponseInterface $contact */
        $contact = $reflectionClass->newInstance();
        $contact->setId($contactResponseParameters['id']);
        $contact->setPhoneNumber($contactResponseParameters['phoneNumber']);
        $contact->setUpdatedAt(Carbon::parse($contactResponseParameters['updatedAt']));
        if (isset($contactResponseParameters['customFields'])) {
            foreach ($contactResponseParameters['customFields'] as $key => $value) {
                $contact->addCustomField($key, $value);
            }
        }

        return $contact;
    }

    /**
     * @param ContactResponseInterface $contactResponse
     * @return array
     */
    public function toArray(ContactResponseInterface $contactResponse): array
    {
        $contactResponseArray = [];
        /** @var ContactResponseInterface $contactResponse */
        $contactResponseArray['id'] = $contactResponse->getId();
        $contactResponseArray['phoneNumber'] = $contactResponse->getPhoneNumber();
        $contactResponseArray['updatedAt'] = $contactResponse->getUpdatedAt()->toW3cString();
        if (!empty($contactResponse->getCustomFields())) {
            $contactResponseArray['customFields'] = [];
            foreach ($contactResponse->getCustomFields() as $key => $value) {
                $contactResponseArray['customFields'][$key] = $value;
            }
        }

        return $contactResponseArray;
    }

    /**
     * @param string $contactResponseParameters
     * @param string $contactResponseClass
     * @return ContactResponseInterface
     */
    public function fromJson(string $contactResponseParameters, string $contactResponseClass = ContactResponse::class): ContactResponseInterface
    {
        return $this->fromArray(json_decode($contactResponseParameters, true), $contactResponseClass);
    }

    /**
     * @param ContactResponseInterface $contactResponse
     * @return string
     */
    public function toJson(ContactResponseInterface $contactResponse): string
    {
        return json_encode($this->toArray($contactResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateContactRequestClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(ContactResponseInterface::class)) {
            throw new InterfaceImplementationException(ContactResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}
