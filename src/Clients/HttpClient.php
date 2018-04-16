<?php


namespace Digitonic\PassonaClient\Clients;


use Digitonic\PassonaClient\Contracts\Clients\HttpClient as HttpClientInterface;
use GuzzleHttp\Client;

class HttpClient extends Client implements HttpClientInterface
{

}