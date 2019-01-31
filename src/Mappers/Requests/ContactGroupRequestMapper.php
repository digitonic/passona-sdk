<?php


namespace Digitonic\PassonaClient\Mappers\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\ContactGroupRequest as ContactGroupRequestInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Requests\ContactGroupRequestMapper as ContactGroupRequestMapperInterface;
use Digitonic\PassonaClient\Entities\Requests\ContactGroupRequest;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class ContactGroupRequestMapper implements ContactGroupRequestMapperInterface
{
    /**
     * @param ContactGroupRequestInterface $contactGroupRequest
     * @return array
     */
    public function toArray(ContactGroupRequestInterface $contactGroupRequest): array
    {
        return [
            'name' => $contactGroupRequest->getName(),
            'description' => $contactGroupRequest->getDescription()
        ];
    }

    /**
     * @param array $contactGroupRequestParameters
     * @param string $contactGroupRequestClass
     * @return ContactGroupRequestInterface
     */
    public function fromArray(array $contactGroupRequestParameters, string $contactGroupRequestClass = ContactGroupRequest::class): ContactGroupRequestInterface
    {
        $reflectionClass = new \ReflectionClass($contactGroupRequestClass);

        $this->validateContactGroupRequestClass($reflectionClass);

        /** @var ContactGroupRequestInterface $contactGroupRequest */
        $contactGroupRequest = $reflectionClass->newInstance();
        $contactGroupRequest->setName($contactGroupRequestParameters['name']);
        $contactGroupRequest->setDescription($contactGroupRequestParameters['description']);

        return $contactGroupRequest;
    }

    /**
     * @param ContactGroupRequestInterface $contactGroupRequest
     * @return \stdClass
     */
    public function toStdClass(ContactGroupRequestInterface $contactGroupRequest): \stdClass
    {
        $contactGroupRequestStdClass = new \stdClass();
        $contactGroupRequestStdClass->name = $contactGroupRequest->getName();
        $contactGroupRequestStdClass->description = $contactGroupRequest->getDescription();

        return $contactGroupRequestStdClass;
    }

    /**
     * @param \stdClass $contactGroupRequestParameters
     * @param string $contactGroupRequestClass
     * @return ContactGroupRequestInterface
     */
    public function fromStdClass(\stdClass $contactGroupRequestParameters, string $contactGroupRequestClass = ContactGroupRequest::class): ContactGroupRequestInterface
    {
        $contactGroupRequest = new ContactGroupRequest();
        $contactGroupRequest->setName($contactGroupRequestParameters->name);
        $contactGroupRequest->setDescription($contactGroupRequestParameters->description);

        return $contactGroupRequest;
    }

    /**
     * @param ContactGroupRequestInterface $contactGroupRequest
     * @return string
     */
    public function toJson(ContactGroupRequestInterface $contactGroupRequest): string
    {
        return json_encode($this->toArray($contactGroupRequest));
    }

    /**
     * @param string $contactGroupRequestParameters
     * @param string $contactGroupRequestClass
     * @return ContactGroupRequestInterface|\Digitonic\PassonaClient\Entities\Requests\ContactGroupRequest
     */
    public function fromJson(string $contactGroupRequestParameters, string $contactGroupRequestClass = ContactGroupRequest::class): ContactGroupRequestInterface
    {
        return $this->fromArray(json_decode($contactGroupRequestParameters, true), $contactGroupRequestClass);
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateContactGroupRequestClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(ContactGroupRequestInterface::class)) {
            throw new InterfaceImplementationException(ContactGroupRequestInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}
