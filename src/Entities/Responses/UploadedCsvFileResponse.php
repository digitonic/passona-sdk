<?php


namespace Digitonic\PassonaClient\Entities\Responses;


use Digitonic\PassonaClient\Contracts\Entities\Responses\UploadedCsvFileResponse as UploadedCsvFileResponseInterface;

class UploadedCsvFileResponse implements UploadedCsvFileResponseInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $filename;
    /**
     * @var string
     */
    private $filesize;
    /**
     * @var int
     */
    private $columnCount;
    /**
     * @var int
     */
    private $numRows;
    /**
     * @var array
     */
    private $headings;
    /**
     * @var array
     */
    private $rows;
    /**
     * @var string
     */
    private $originalFilename;
    /**
     * @var array
     */
    private $possiblePhoneColumns;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilesize(): string
    {
        return $this->filesize;
    }

    /**
     * @param string $filesize
     */
    public function setFilesize(string $filesize)
    {
        $this->filesize = $filesize;
    }

    /**
     * @return int
     */
    public function getColumnCount(): int
    {
        return $this->columnCount;
    }

    /**
     * @param int $columnCount
     */
    public function setColumnCount(int $columnCount)
    {
        $this->columnCount = $columnCount;
    }

    /**
     * @return int
     */
    public function getNumRows(): int
    {
        return $this->numRows;
    }

    /**
     * @param int $numRows
     */
    public function setNumRows(int $numRows)
    {
        $this->numRows = $numRows;
    }

    /**
     * @return array
     */
    public function getHeadings(): array
    {
        return $this->headings;
    }

    /**
     * @param array $headings
     */
    public function setHeadings(array $headings)
    {
        $this->headings = $headings;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->originalFilename;
    }

    /**
     * @param string $originalFilename
     */
    public function setOriginalFilename(string $originalFilename)
    {
        $this->originalFilename = $originalFilename;
    }

    /**
     * @return array
     */
    public function getPossiblePhoneColumns(): array
    {
        return $this->possiblePhoneColumns;
    }
    /**
     * @param array $possiblePhoneColumns
     */
    public function setPossiblePhoneColumns(array $possiblePhoneColumns)
    {
        $this->possiblePhoneColumns = $possiblePhoneColumns;
    }
}