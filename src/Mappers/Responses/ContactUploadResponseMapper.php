<?php


namespace Digitonic\PassonaClient\Mappers\Responses;


use Carbon\Carbon;
use Digitonic\PassonaClient\Contracts\Entities\Responses\ContactUploadResponse as ContactUploadResponseInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\ContactUploadResponseMapper as ContactUploadResponseMapperInterface;
use Digitonic\PassonaClient\Entities\Responses\ContactUploadResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class ContactUploadResponseMapper implements ContactUploadResponseMapperInterface
{
    /**
     * @var UploadedCsvFileResponseMapper
     */
    private $uploadedCsvFileMapper;

    public function __construct(UploadedCsvFileResponseMapper $uploadedCsvFileMapper)
    {
        $this->uploadedCsvFileMapper = $uploadedCsvFileMapper;
    }

    /**
     * @param array $contactUploadResponseParameters
     * @param string $contactUploadResponseClass
     * @return ContactUploadResponseInterface
     */
    public function fromArray(array $contactUploadResponseParameters, string $contactUploadResponseClass = ContactUploadResponse::class): ContactUploadResponseInterface
    {
        $reflectionClass = new \ReflectionClass($contactUploadResponseClass);
        $this->validateContactUploadResponseClass($reflectionClass);

        /** @var ContactUploadResponseInterface $contactUpload */
        $contactUpload = $reflectionClass->newInstance();
        $contactUpload->setId($contactUploadResponseParameters['id']);
        $contactUpload->setStatus($contactUploadResponseParameters['status']);
        $contactUpload->setCreatedAt(Carbon::parse($contactUploadResponseParameters['createdAt']['date']));
        $contactUpload->setPhoneNumberIndex($contactUploadResponseParameters['phoneNumberIndex']);
        $contactUpload->setUploadedCsvFile($this->uploadedCsvFileMapper->fromArray($contactUploadResponseParameters['uploadedCsvFile']['data']));

        return $contactUpload;
    }

    /**
     * @param ContactUploadResponseInterface $contactUploadResponse
     * @return array
     */
    public function toArray(ContactUploadResponseInterface $contactUploadResponse): array
    {
        $contactUploadResponseArray = [];
        $contactUploadResponseArray['id'] = $contactUploadResponse->getId();
        $contactUploadResponseArray['status'] = $contactUploadResponse->getStatus();
        $contactUploadResponseArray['createdAt']['date'] = $contactUploadResponse->getCreatedAt()->toW3cString();
        $contactUploadResponseArray['phoneNumberIndex'] = $contactUploadResponse->getPhoneNumberIndex();
        $contactUploadResponseArray['uploadedCsvFile']['data'] = $this->uploadedCsvFileMapper->toArray($contactUploadResponse->getUploadedCsvFile());

        return $contactUploadResponseArray;
    }

    /**
     * @param \stdClass $contactUploadResponseParameters
     * @param string $contactUploadResponseClass
     * @return ContactUploadResponseInterface
     */
    public function fromStdClass(\stdClass $contactUploadResponseParameters, string $contactUploadResponseClass = ContactUploadResponse::class): ContactUploadResponseInterface
    {
        $reflectionClass = new \ReflectionClass($contactUploadResponseClass);
        $this->validateContactUploadResponseClass($reflectionClass);

        /** @var ContactUploadResponseInterface $contactUpload */
        $contactUpload = $reflectionClass->newInstance();
        $contactUpload->setId($contactUploadResponseParameters->id);
        $contactUpload->setStatus($contactUploadResponseParameters->status);
        $contactUpload->setCreatedAt(Carbon::parse($contactUploadResponseParameters->createdAt->date));
        $contactUpload->setPhoneNumberIndex($contactUploadResponseParameters->phoneNumberIndex);
        $contactUpload->setUploadedCsvFile($this->uploadedCsvFileMapper->fromStdClass($contactUploadResponseParameters->uploadedCsvFile->data));

        return $contactUpload;
    }

    /**
     * @param ContactUploadResponseInterface $contactUploadResponse
     * @return \stdClass
     */
    public function toStdClass(ContactUploadResponseInterface $contactUploadResponse): \stdClass
    {
        $contactUploadResponseStdClass = new \stdClass();
        $contactUploadResponseStdClass->id = $contactUploadResponse->getId();
        $contactUploadResponseStdClass->status = $contactUploadResponse->getStatus();
        $contactUploadResponseStdClass->createdAt = new \stdClass();
        $contactUploadResponseStdClass->createdAt->date = $contactUploadResponse->getCreatedAt()->toW3cString();
        $contactUploadResponseStdClass->phoneNumberIndex = $contactUploadResponse->getPhoneNumberIndex();
        $contactUploadResponseStdClass->uploadedCsvFile = new \stdClass();
        $contactUploadResponseStdClass->uploadedCsvFile->data = $this->uploadedCsvFileMapper->toStdClass($contactUploadResponse->getUploadedCsvFile());

        return $contactUploadResponseStdClass;
    }

    /**
     * @param string $contactUploadResponseParameters
     * @param string $contactUploadResponseClass
     * @return ContactUploadResponseInterface
     */
    public function fromJson(string $contactUploadResponseParameters, string $contactUploadResponseClass = ContactUploadResponse::class): ContactUploadResponseInterface
    {
        return $this->fromArray(json_decode($contactUploadResponseParameters, true), $contactUploadResponseClass);
    }

    /**
     * @param ContactUploadResponseInterface $contactUploadResponse
     * @return string
     */
    public function toJson(ContactUploadResponseInterface $contactUploadResponse): string
    {
        return json_encode($this->toArray($contactUploadResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateContactUploadResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(ContactUploadResponseInterface::class)) {
            throw new InterfaceImplementationException(ContactUploadResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}