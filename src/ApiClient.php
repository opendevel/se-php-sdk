<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use function GuzzleHttp\Psr7\stream_for;

final class ApiClient
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
     * @param \SmartEmailing\Sdk\ApiRequestInterface $apiRequest
     * @return string
     * @throws \Http\Client\Exception
     */
    public function sendRequest(ApiRequestInterface $apiRequest): string
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $stream = stream_for(json_encode($apiRequest->toArray()));
        $request = new Request($apiRequest::getHttpMethod(), $apiRequest::getEndpoint(), $headers, $stream);
        $response = $this->client->sendRequest($request);

        return $response->getBody()->getContents();
    }

}
