<?php

namespace Digitonic\PassonaClient;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Exceptions\InvalidData;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements Passona
{
    /**
     * @var Guzzle
     */
    private $client = null;
    private $bearerToken;

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
        $this->updateBearerToken($request);

        try {
            return $this->client->send($request);
        } catch (ClientException $e) {
            throw new InvalidData($e->getMessage());
        } catch (GuzzleException $e) {
            throw new InvalidData($e->getMessage());
        }
    }

    /**
     * @param array $bearerToken
     * @return $this
     */
    public function setBearerToken(string $bearerToken)
    {
        $this->bearerToken = $bearerToken;
        return $this;
    }

    /**
     * @param RequestInterface $request
     * @return Request|RequestInterface
     */
    private function updateBearerToken(RequestInterface &$request)
    {
        if ($this->bearerToken) {
            $request = new Request(
                $request->getMethod(),
                $request->getUri(),
                array_merge($request->getHeaders(), ['Authorization' => ['Bearer ' . $this->bearerToken]]),
                $request->getBody(),
                $request->getProtocolVersion()
            );
        }
    }
}
