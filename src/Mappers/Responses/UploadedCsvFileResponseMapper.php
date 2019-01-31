<?php


namespace Digitonic\PassonaClient\Mappers\Responses;

use Digitonic\PassonaClient\Contracts\Entities\Responses\UploadedCsvFileResponse as UploadedCsvFileResponseInterface;
use Digitonic\PassonaClient\Contracts\Mappers\Responses\UploadedCsvFileResponseMapper as UploadedCsvFileResponseMapperInterface;
use Digitonic\PassonaClient\Entities\Responses\UploadedCsvFileResponse;
use Digitonic\PassonaClient\Exceptions\ClassInstantiableException;
use Digitonic\PassonaClient\Exceptions\InterfaceImplementationException;

class UploadedCsvFileResponseMapper implements UploadedCsvFileResponseMapperInterface
{
    /**
     * @param array $uploadedCsvFileResponseParameters
     * @return UploadedCsvFileResponseInterface
     */
    public function fromArray(array $uploadedCsvFileResponseParameters, $uploadedCsvFileResponseClass = UploadedCsvFileResponse::class): UploadedCsvFileResponseInterface
    {
        $reflectionClass = new \ReflectionClass($uploadedCsvFileResponseClass);

        $this->validateUploadedCsvFileResponseClass($reflectionClass);

        /** @var UploadedCsvFileResponseInterface $uploadedCsvFile */
        $uploadedCsvFile = $reflectionClass->newInstance();
        $uploadedCsvFile->setId($uploadedCsvFileResponseParameters['id']);
        $uploadedCsvFile->setFilename($uploadedCsvFileResponseParameters['filename']);
        $uploadedCsvFile->setFilesize($uploadedCsvFileResponseParameters['filesize']);
        $uploadedCsvFile->setColumnCount($uploadedCsvFileResponseParameters['columnCount']);
        $uploadedCsvFile->setNumRows($uploadedCsvFileResponseParameters['numRows']);
        $uploadedCsvFile->setHeadings($uploadedCsvFileResponseParameters['headings']);
        $uploadedCsvFile->setRows($uploadedCsvFileResponseParameters['rows']);
        $uploadedCsvFile->setOriginalFilename($uploadedCsvFileResponseParameters['originalFilename']);
        $uploadedCsvFile->setPossiblePhoneColumns($uploadedCsvFileResponseParameters['possiblePhoneColumns']);

        return $uploadedCsvFile;
    }

    /**
     * @param UploadedCsvFileResponseInterface $uploadedCsvFileResponse
     * @return array
     */
    public function toArray(UploadedCsvFileResponseInterface $uploadedCsvFileResponse): array
    {
        return [
            'id' => $uploadedCsvFileResponse->getId(),
            'filename' => $uploadedCsvFileResponse->getFilename(),
            'filesize' => $uploadedCsvFileResponse->getFilesize(),
            'columnCount' => $uploadedCsvFileResponse->getColumnCount(),
            'numRows' => $uploadedCsvFileResponse->getNumRows(),
            'headings' => $uploadedCsvFileResponse->getHeadings(),
            'rows' => $uploadedCsvFileResponse->getRows(),
            'originalFilename' => $uploadedCsvFileResponse->getOriginalFilename(),
            'possiblePhoneColumns' => $uploadedCsvFileResponse->getPossiblePhoneColumns()
        ];
    }

    /**
     * @param \stdClass $uploadedCsvFileResponseParameters
     * @param string $uploadedCsvFileResponseClass
     * @return UploadedCsvFileResponseInterface
     */
    public function fromStdClass(\stdClass $uploadedCsvFileResponseParameters, $uploadedCsvFileResponseClass = UploadedCsvFileResponse::class): UploadedCsvFileResponseInterface
    {
        $reflectionClass = new \ReflectionClass($uploadedCsvFileResponseClass);

        $this->validateUploadedCsvFileResponseClass($reflectionClass);

        /** @var UploadedCsvFileResponseInterface $uploadedCsvFile */
        $uploadedCsvFile = $reflectionClass->newInstance();
        $uploadedCsvFile->setId($uploadedCsvFileResponseParameters->id);
        $uploadedCsvFile->setFilename($uploadedCsvFileResponseParameters->filename);
        $uploadedCsvFile->setFilesize($uploadedCsvFileResponseParameters->filesize);
        $uploadedCsvFile->setColumnCount($uploadedCsvFileResponseParameters->columnCount);
        $uploadedCsvFile->setNumRows($uploadedCsvFileResponseParameters->numRows);
        $uploadedCsvFile->setHeadings($uploadedCsvFileResponseParameters->headings);
        $uploadedCsvFile->setRows($uploadedCsvFileResponseParameters->rows);
        $uploadedCsvFile->setOriginalFilename($uploadedCsvFileResponseParameters->originalFilename);
        $uploadedCsvFile->setPossiblePhoneColumns((array) $uploadedCsvFileResponseParameters->possiblePhoneColumns);

        return $uploadedCsvFile;
    }

    /**
     * @param UploadedCsvFileResponseInterface $uploadedCsvFileResponse
     * @return \stdClass
     */
    public function toStdClass(UploadedCsvFileResponseInterface $uploadedCsvFileResponse): \stdClass
    {
        $uploadedCsvFileResponseStdClass = new \stdClass();
        $uploadedCsvFileResponseStdClass->id = $uploadedCsvFileResponse->getId();
        $uploadedCsvFileResponseStdClass->filename = $uploadedCsvFileResponse->getFilename();
        $uploadedCsvFileResponseStdClass->filesize = $uploadedCsvFileResponse->getFilesize();
        $uploadedCsvFileResponseStdClass->columnCount = $uploadedCsvFileResponse->getColumnCount();
        $uploadedCsvFileResponseStdClass->numRows = $uploadedCsvFileResponse->getNumRows();
        $uploadedCsvFileResponseStdClass->headings = $uploadedCsvFileResponse->getHeadings();
        $uploadedCsvFileResponseStdClass->rows = $uploadedCsvFileResponse->getRows();
        $uploadedCsvFileResponseStdClass->originalFilename = $uploadedCsvFileResponse->getOriginalFilename();
        $uploadedCsvFileResponseStdClass->possiblePhoneColumns = $uploadedCsvFileResponse->getPossiblePhoneColumns();

        return $uploadedCsvFileResponseStdClass;
    }

    /**
     * @param string $uploadedCsvFileResponseParameters
     * @param string $uploadedCsvFileResponseClass
     * @return UploadedCsvFileResponseInterface
     */
    public function fromJson(string $uploadedCsvFileResponseParameters, $uploadedCsvFileResponseClass = UploadedCsvFileResponse::class): UploadedCsvFileResponseInterface
    {
        return $this->fromArray(json_decode($uploadedCsvFileResponseParameters, true), $uploadedCsvFileResponseClass);
    }

    /**
     * @param UploadedCsvFileResponseInterface $uploadedCsvFileResponse
     * @return string
     */
    public function toJson(UploadedCsvFileResponseInterface $uploadedCsvFileResponse): string
    {
        return json_encode($this->toArray($uploadedCsvFileResponse));
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @throws ClassInstantiableException
     * @throws InterfaceImplementationException
     */
    private function validateUploadedCsvFileResponseClass(\ReflectionClass $reflectionClass): void
    {
        if (!$reflectionClass->implementsInterface(UploadedCsvFileResponseInterface::class)) {
            throw new InterfaceImplementationException(UploadedCsvFileResponseInterface::class);
        }

        if ($reflectionClass->isAbstract()) {
            throw new ClassInstantiableException();
        }
    }
}
