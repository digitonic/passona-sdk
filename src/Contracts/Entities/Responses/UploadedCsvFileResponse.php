<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

interface UploadedCsvFileResponse
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id);

    /**
     * @return string
     */
    public function getFilename(): string;

    /**
     * @param string $filename
     */
    public function setFilename(string $filename);

    /**
     * @return string
     */
    public function getFilesize(): string;

    /**
     * @param string $filesize
     */
    public function setFilesize(string $filesize);

    /**
     * @return int
     */
    public function getColumnCount(): int;

    /**
     * @param int $columnCount
     */
    public function setColumnCount(int $columnCount);

    /**
     * @return int
     */
    public function getNumRows(): int;

    /**
     * @param int $numRows
     */
    public function setNumRows(int $numRows);

    /**
     * @return array
     */
    public function getHeadings(): array;

    /**
     * @param array $headings
     */
    public function setHeadings(array $headings);

    /**
     * @return array
     */
    public function getRows(): array;

    /**
     * @param array $rows
     */
    public function setRows(array $rows);

    /**
     * @return string
     */
    public function getOriginalFilename(): string;

    /**
     * @param string $originalFilename
     */
    public function setOriginalFilename(string $originalFilename);

    /**
     * @return array
     */
    public function getPossiblePhoneColumns(): array;

    /**
     * @param array $possiblePhoneColumns
     */
    public function setPossiblePhoneColumns(array $possiblePhoneColumns);
}
