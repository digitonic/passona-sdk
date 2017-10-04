<?php


namespace Tests\MockObjects\ContactResponses;


use Tests\MockObjects\MockResponse;

class ContactMockResponse extends MockResponse
{

    protected function constructBody(string $json): string
    {
        return $json;
    }
}