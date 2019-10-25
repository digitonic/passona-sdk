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
     * @var string
     */
    protected $entityUuid = '';


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
        $request = new Request($this->method, $this->buildEndpoint(), [], json_encode($this->payload));

        $response = $this->api->send($request);

        return collect(json_decode($response->getBody()->getContents()));
    }

    /**
     * @param array $payload
     * @return Collection
     * @throws InvalidData
     */
    public function post(array $payload = []): Collection
    {
        $this->method = 'POST';
        $this->payload = $payload;

        if (empty($this->payload)) {
            throw InvalidData::invalidValuesProvided('A payload is required for a POST request');
        }

        return $this->send();
    }

    /**
     * @param string $entityIdentifier
     * @param array $payload
     * @return Collection
     * @throws InvalidData
     */
    public function put(string $entityIdentifier, array $payload = []): Collection
    {
        $this->method = 'PUT';
        $this->payload = $payload;

        if ($this->requiresEntityUuid()) {
            $this->entityUuid = $entityIdentifier;
        }
        if ($this->entityUuid === '') {
            throw InvalidData::invalidValuesProvided('A valid team UUID identifier is required for a PUT request');
        }

        if (empty($this->payload)) {
            throw InvalidData::invalidValuesProvided('A payload is required for a PUT request');
        }

        return $this->send();
    }

    /**
     * @return string
     */
    private function buildEndpoint(): string
    {
        if ($this->requiresEntityUuid()) {
            $endpoint = $this->getFullEndpoint();

            $endpoint = substr($endpoint, 0, strpos($endpoint, '/'));
            return $endpoint .= "/{$this->entityUuid}";
        }

        return $this->getFullEndpoint();
    }

    /**
     * @return string
     */
    abstract protected function getFullEndpoint(): string;

    /**
     * @return bool
     */
    abstract protected function requiresEntityUuid(): bool;
}
