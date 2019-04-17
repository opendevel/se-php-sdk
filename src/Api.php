<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Client\HttpClient;

final class Api
{

    /**
     * @var string
     */
    private $baseUri = 'https://app.smartemailing.cz/api/v3/';

    /**
     * @var \Http\Client\HttpClient
     */
    private $client;

    public function __construct(string $username, string $password)
    {

        $config = [
            'auth' => [
                $username,
                $password,
            ],
            'base_uri' => $this->baseUri,
            'timeout' => 5.0,
        ];

        $this->client = new GuzzleAdapter(new GuzzleClient($config));
    }


    public function getHttpClient(): HttpClient
    {
        return $this->client;
    }

}
