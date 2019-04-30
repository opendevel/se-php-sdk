<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use function GuzzleHttp\Psr7\stream_for;

final class HttpClient
{

    /**
     * Base URI of the client
     *
     * @var string|\Psr\Http\Message\UriInterface
     */
    private $configBaseUri = 'https://app.smartemailing.cz/api/v3/';

    /**
     * @var float
     */
    private $configTimeout = 2.0;

    /**
     * @var \Http\Adapter\Guzzle6\Client
     */
    private $client;

    /**
     * Create HTTP client
     *
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct(?string $username = null, ?string $password = null)
    {
        $config = [
            'auth' => [
                $username,
                $password,
            ],
            'base_uri' => $this->configBaseUri,
            'timeout' => $this->configTimeout,
        ];

        $this->client = new GuzzleAdapter(new GuzzleClient($config));
    }

    /**
     * Send HTTP request and get response
     *
     * @param string $method
     * @param string $uri
     * @param array $body
     * @return string
     * @throws \Http\Client\Exception
     */
    public function send(string $method, string $uri, array $body = []): string
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $stream = stream_for(json_encode($body));
        $request = new Request($method, $uri, $headers, $stream);
        $response = $this->client->sendRequest($request);

        return $response->getBody()->getContents();
    }

}
