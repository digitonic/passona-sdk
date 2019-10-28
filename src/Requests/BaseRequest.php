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
     * @var int
     */
    protected $defaultPaginateBy = 15;

    /**
     * @var bool
     */
    protected $requiresPagination = false;


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
            throw InvalidData::invalidValuesProvided('A valid entity UUID identifier is required for a PUT request');
        }

        if (empty($this->payload)) {
            throw InvalidData::invalidValuesProvided('A payload is required for a PUT request');
        }

        return $this->send();
}

    /**
     * @param string $entityIdentifier
     * @return Collection
     * @throws InvalidData
     */
    public function delete(string $entityIdentifier): Collection
    {
        $this->method = 'DELETE';

        if ($this->requiresEntityUuid()) {
            $this->entityUuid = $entityIdentifier;
        }

        if ($this->entityUuid === '') {
            throw InvalidData::invalidValuesProvided('A valid entity UUID identifier is required for a DELETE request');
        }

        return $this->send();
    }

    /**
     * @param string|null $entityIdentifier
     * @param bool $requirePagination
     * @param int|null $paginateBy
     * @return Collection
     * @throws InvalidData
     */
    public function get(?string $entityIdentifier, bool $requirePagination = false, ?int $paginateBy = 15): Collection
    {
        if ($this->requiresEntityUuid()) {
            $this->entityUuid = $entityIdentifier;

            if ($this->entityUuid === '' || $this->entityUuid === null) {
                throw InvalidData::invalidValuesProvided(
                    'A valid entity UUID identifier is required for a GET request'
                );
            }
        }

        $this->requiresPagination = $requirePagination;

        $this->defaultPaginateBy = $paginateBy;

        if ($this->defaultPaginateBy <= 0) {
            throw InvalidData::invalidValuesProvided('Pagination cannot be 0 or a negative integer.');
        }

        return $this->send();
    }

    /**
     * @return string
     */
    private function buildEndpoint(): string
    {
        $endpoint = $this->getFullEndpoint();

        if ($this->requiresEntityUuid()) {
            $regex = '/({((?:[^{}]* | (?1))*)})/x';

            $endpoint = preg_replace($regex, $this->entityUuid, $endpoint);
            return $endpoint .= $this->requiresPagination ? "/?per_page={$this->defaultPaginateBy}" : '';
        }

        if ($this->requiresPagination) {
            return $endpoint .=  "/?per_page={$this->defaultPaginateBy}";
        }

        return $endpoint;
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
