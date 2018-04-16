<?php

namespace Digitonic\PassonaClient\Contracts\Clients;

use Psr\Http\Message\ResponseInterface;

interface HttpClient
{
    /**
     * @param \Psr\Http\Message\UriInterface|string $uri
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function get($uri, array $options = []): ResponseInterface;

    public function post($uri, array $options = []): ResponseInterface;

    public function put($uri, array $options = []): ResponseInterface;

    public function delete($uri, array $options = []): ResponseInterface;
}