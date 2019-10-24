<?php

namespace Digitonic\PassonaClient\Requests;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Exceptions\InvalidData;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

abstract class BaseRequest
{
    const ENDPOINT = '';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var array
     */
    protected $payload = [];

    /**
     * @var Passona
     */
    protected $api;

    /**
     * BaseRequest constructor.
     * @param Passona $api
     */
    public function __construct(Passona $api)
    {
        $this->api = $api;
    }

    /**
     * @return Collection
     */
    public function send(): Collection
    {
        $request = new Request($this->method, $this->getFullEndpoint(), [], json_encode($this->payload));

        $response = $this->api->send($request);

        return collect(json_decode($response->getBody()->getContents()));
    }


    /**
     * @param array $payload
     * @return Collection
     */
    public function post(array $payload = []): Collection
    {
        $this->method = 'POST';

        if (empty($this->payload)) {
            InvalidData::invalidValuesProvided('A payload is required for a POST request');
        }

        $this->payload = $payload;

        return $this->send();
    }

    /**
     * @return string
     */
    abstract protected function getFullEndpoint(): string;

    /**
     * @return bool
     */
    abstract protected function requiresTeamIdentifier(): bool;
}
