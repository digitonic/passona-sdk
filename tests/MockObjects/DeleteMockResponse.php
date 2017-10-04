<?php


namespace Tests\MockObjects;

class DeleteMockResponse extends MockResponse
{
    public function __construct(string $json)
    {
        parent::__construct(204, $json);
    }

    public function constructBody(string $json): string
    {
        return '';
    }
}