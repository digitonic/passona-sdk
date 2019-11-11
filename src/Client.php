<?php

namespace Digitonic\PassonaClient;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Exceptions\InvalidData;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements Passona
{
    /**
     * @var Guzzle
     */
    private $client = null;

    /**
     * Client constructor.
     * @param Guzzle $client
     */
    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws InvalidData
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->send($request);
        } catch (ClientException $e) {
            throw new InvalidData($e->getMessage());
        } catch (GuzzleException $e) {
            throw new InvalidData($e->getMessage());
        }
    }
}
