<?php


namespace Digitonic\PassonaClient\Mappers\Requests;


use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactRequest as ContactRequestInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\ContactRequestMapper as ContactRequestMapperInterface;
use Digitonic\PassonaClient\Entities\ContactRequest;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class ContactRequestMapper implements ContactRequestMapperInterface
{
    /**
     * @param ContactRequestInterface $contact
     * @return array
     */
    public function toArray(ContactRequestInterface $contact): array
    {
        $contactArray = [
            'phoneNumber' => $contact->getPhoneNumber()
        ];
        foreach ($contact->getCustomFields() as $key => $value) {
            $contactArray[$key] = $value;
        }

        return $contactArray;
    }

    /**
     * @param array $contactRequestParameters
     * @param string $contactRequestClass
     * @return ContactRequestInterface
     */
    public function fromArray(array $contactRequestParameters, string $contactRequestClass = ContactRequest::class): ContactRequestInterface
    {
        $reflectionClass = new \ReflectionClass($contactRequestClass);
        $this->validateContactRequestClass($reflectionClass);

        /** @var ContactRequestInterface $contactRequest */
        $contactRequest = $reflectionClass->newInstance();
        $contactRequest->setPhoneNumber($contactRequestParameters['phoneNumber']);
        foreach($contactRequestParameters as $key => $value){
            if ($key !== 'phoneNumber'){
                $contactRequest->addCustomField($key, $value);
            }
        }

        return $contactRequest;
    }

    /**
     * @param ContactRequestInterface $contact
     * @return \stdClass
     */
    public function toStdClass(ContactRequestInterface $contact): \stdClass
    {
        $contactStdClass = new \stdClass();
        $contactStdClass->phoneNumber = $contact->getPhoneNumber();
        foreach ($contact->getCustomFields() as $key => $value) {
            $contactStdClass->$key = $value;
        }

        return $contactStdClass;
    }

    /**
     * @param \stdClass $contactRequestParameters
     * @param string $contactRequestClass
     * @return ContactRequestInterface
     */
    public function fromStdClass(\stdClass $contactRequestParameters, string $contactRequestClass = ContactRequest::class): ContactRequestInterface
    {
        $reflectionClass = new \ReflectionClass($contactRequestClass);
        $this->validateContactRequestClass($reflectionClass);

        /** @var ContactRequestInterface $contactRequest */
        $contactRequest = $reflectionClass->newInstance();
        $contactRequest->setPhoneNumber($contactRequestParameters->phoneNumber);
        foreach($contactRequestParameters as $key => $value){
            if ($key !== 'phoneNumber'){
                $contactRequest->addCustomField($key, $value);
            }
        }

        return $contactRequest;
    }

    /**
     * @param ContactRequestInterface $contact
     * @return string
     */
    public function toJson(ContactRequestInterface $contact): string
    {
        return json_encode($this->toArray($contact));
    }

    /**
     * @param string $contactRequestParameters
     * @param string $contactRequestClass
     * @return ContactRequestInterface
     */
    public function fromJson(string $contactRequestParameters, string $contactRequestClass = ContactRequest::class): ContactRequestInterface
    {
        return $this->fromArray(json_decode($contactRequestParameters, true), $contactRequestClass);
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateContactRequestClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(ContactRequestInterface::class)) {
            throw new InterfaceImplementationException(ContactRequestInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}