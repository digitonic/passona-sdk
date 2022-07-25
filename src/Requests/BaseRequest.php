<?php

namespace Digitonic\PassonaClient\Requests;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Exceptions\InvalidData;
use Digitonic\PassonaClient\Exceptions\UndefinedMethodException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

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
    protected $paginateBy = 15;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var bool
     */
    protected $requiresPagination = false;

    /**
     * @var array
     */
    protected $headers = [];

    protected $attributes = [];

    /**
     * BaseRequest constructor.
     * @param Passona $api
     */
    public function __construct(Passona $api)
    {
        $this->api = $api;
        $config = config('passona-sdk');

        $this->headers = [
            'Authorization' => 'Bearer ' . $config['passona_api_key']
        ];
    }

    /**
     * @return Collection|\stdClass
     */
    public function send()
    {
        $request = new Request($this->method, $this->buildEndpoint(), $this->headers, json_encode($this->payload));

        $response = $this->api->send($request);

        return collect(json_decode($response->getBody()->getContents()));
    }

    /**
     * @return Collection|\stdClass
     * @throws InvalidData
     */
    public function post()
    {
        $this->method = 'POST';

        if (empty($this->payload)) {
            throw InvalidData::invalidValuesProvided('A payload is required for a POST request');
        }

        return $this->send();
    }

    /**
     * @param string $entityIdentifier
     * @return Collection|\stdClass
     * @throws InvalidData
     */
    public function put(string $entityIdentifier)
    {
        $this->method = 'PUT';

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
     * @return Collection|\stdClass
     * @throws InvalidData
     */
    public function get(string $entityIdentifier = null)
    {
        if ($this->requiresEntityUuid()) {
            $this->entityUuid = $entityIdentifier;

            if ($this->entityUuid === '' || $this->entityUuid === null) {
                throw InvalidData::invalidValuesProvided(
                    'A valid entity UUID identifier is required for a GET request'
                );
            }
        }

        return $this->send();
    }

    /**
     * @param array $payload
     * @return $this
     */
    public function setPayload(array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @param int $paginateBy
     * @param int $pageNumber
     * @return $this
     * @throws InvalidData
     */
    public function paginate(int $paginateBy = 15, int $pageNumber = 1): self
    {
        if ($paginateBy <= 0) {
            throw InvalidData::invalidValuesProvided('Pagination cannot be 0 or a negative integer.');
        }

        if ($pageNumber <= 0) {
            throw InvalidData::invalidValuesProvided('The current page selector cannot be 0 or a negative integer');
        }

        $this->requiresPagination = true;
        $this->paginateBy = $paginateBy;
        $this->currentPage = $pageNumber;

        return $this;
    }

    /**
     * @return string
     */
    protected function buildEndpoint(): string
    {
        $endpoint = $this->getFullEndpoint();

        if ($this->requiresEntityUuid()) {
            $regex = '/({((?:[^{}]* | (?1))*)})/x';

            $endpoint = preg_replace($regex, $this->entityUuid, $endpoint);
            return $endpoint;
        }

        if ($this->requiresPagination) {
            return $endpoint .= "/?per_page={$this->paginateBy}&page={$this->currentPage}";
        }

        return $endpoint;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return string
     */
    abstract protected function getFullEndpoint(): string;

    /**
     * @return bool
     */
    abstract protected function requiresEntityUuid(): bool;

    public function __call($method, $parameters)
    {
        $attribute = Str::snake(str_replace('set', '', $method));

        if (!in_array($attribute, array_values($this->attributes))){
            throw new UndefinedMethodException('Call to undefined method '. self::class.'::'. $method.'()');
        }

        $this->payload[$attribute] = $parameters[0];

        return $this;
    }
}
