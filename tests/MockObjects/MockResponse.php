<?php


namespace Tests\MockObjects;


use GuzzleHttp\Psr7\Response;

abstract class MockResponse extends Response
{
    protected $body;

    protected $headers = [
        'Server' => 'nginx/1.11.9',
        'Content-Type' => 'application/json',
        'Transfer-Encoding' => 'chunked',
        'Connection' => 'keep-alive',
        'Cache-Control' => 'no-cache, private',
        'Date' => 'Tue, 19 Sep 2017 14:36:55 GMT',
        'X-RateLimit-Limit' => '60',
        'X-RateLimit-Remaining' => '58'
    ];

    public function __construct(int $status, string $parameters)
    {
        $this->body = $this->constructBody($parameters);

        parent::__construct($status, $this->headers, $this->body, '1.1', null);
    }

    abstract protected function constructBody(string $json): string;
}