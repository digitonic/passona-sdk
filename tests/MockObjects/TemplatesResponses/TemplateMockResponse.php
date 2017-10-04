<?php


namespace Tests\MockObjects\TemplatesResponses;

use Tests\MockObjects\MockResponse;

class TemplateMockResponse extends MockResponse
{
    public function __construct(int $status, string $json)
    {
        parent::__construct($status, $json);
    }

    /**
     * @param string $json
     * @return string
     */
    protected function constructBody(string $json): string
    {
//        $id = $parameters['id'] ?? 1;
//
//        $body = "{\"data\": {\"id\": {$id},";
//        $body .= "\"name\": \"{$parameters['name']}\",";
//        $body .= "\"body\": \"{$parameters['body']}\",";
//        $body .= "\"links\": {\"data\": [";
//
//        foreach ($parameters['links'] as $index => $linkParameters) {
//            $body = $this->addLinkToJson($index + 1, $body, $linkParameters);
//        }
//
//        $body .= "]}},\"meta\": {";
//        $body .= "\"execution_time\": 1.107835054397583";
//        $body .= "}}";

        return $json;
    }

    /**
     * @param int $id
     * @param string $json
     * @param array $vanityParameters
     * @return string
     */
    protected function addVanityDomainToJson(int $id, string $json, array $vanityParameters): string
    {
        $nameservers = $this->getNameServersFromParameters($vanityParameters);
        $id = $vanityParameters['id'] ?? $id;

        $json .= "\"vanityDomain\": {\"data\": {";
        $json .= "\"id\": {$id},";
        $json .= "\"status\": {$vanityParameters['status']},";
        $json .= "\"nameservers\": {$nameservers},";
        $json .= "\"domain\": \"{$vanityParameters['domain']}\",";
        $json .= "\"hostedZoneId\": \"{$vanityParameters['hostedZoneId']}\"";
        $json .= "}}";

        return $json;
    }

    /**
     * @param $id
     * @param $json
     * @param $linkParameters
     * @return string
     */
    protected function addLinkToJson(int $id, string $json, array $linkParameters): string
    {
        $deleted = $this->getDeletedFromParameters($linkParameters);
        $id = $linkParameters['id'] ?? $id;

        $json .= "{";
        $json .= "\"id\": {$id},";
        $json .= "\"name\": \"{$linkParameters['name']}\",";
        $json .= "\"destination\": \"{$linkParameters['destination']}\",";
        $json .= "\"vanityDomainId\": {$linkParameters['vanityDomainId']},";
        $json .= "\"vanityDomainDomain\": \"{$linkParameters['vanityDomainDomain']}\",";
        $json .= "\"deleted\": {$deleted},";
        $json = $this->addVanityDomainToJson($id, $json, $linkParameters['vanityDomain']);
        $json .= "}";

        return $json;
    }

    /**
     * @param array $parameters
     * @return string
     */
    protected function getNameServersFromParameters(array $parameters): string
    {
        $nameservers = json_encode($parameters['nameservers']);

        return $nameservers;
    }

    /**
     * @param array $parameters
     * @return string
     */
    protected function getDeletedFromParameters(array $parameters): string
    {
        $deleted = $parameters['deleted'] ? "true" : "false";

        return $deleted;
    }
}