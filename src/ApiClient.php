<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\Authentication;
use function GuzzleHttp\Psr7\stream_for;

final class ApiClient
{

    /**
     * Base URI of the client
     *
     * @var string|\Psr\Http\Message\UriInterface
     */
    private $configBaseUri = 'https://app.smartemailing.cz/api/v3';

    /**
     * @var \Http\Client\HttpClient
     */
    private $client;

    /**
     * Create HTTP client
     *
     * @param \Http\Message\Authentication $authentication
     */
    public function __construct(Authentication $authentication)
    {
        $baseUriPlugin = new BaseUriPlugin(UriFactoryDiscovery::find()->createUri($this->configBaseUri), [
            'replace' => true,
        ]);

        $authenticationPlugin = new AuthenticationPlugin($authentication);

        $pluginClient = new PluginClient(
            HttpClientDiscovery::find(),
            [
                $authenticationPlugin,
                $baseUriPlugin,
                //@todo more plugins
            ]
        );

        $this->client = $pluginClient;
    }

    /**
     * Send HTTP request and get response
     *
     * @param \SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface $apiRequest
     * @return string
     * @throws \Http\Client\Exception
     */
    public function sendRequest(ApiRequestInterface $apiRequest): string
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $stream = stream_for(json_encode($apiRequest->toArray()));

        $messageFactory = MessageFactoryDiscovery::find();

        $request = $messageFactory->createRequest(
            $apiRequest::getHttpMethod(),
            '/' . $apiRequest->getEndpoint(),
            $headers,
            $stream
        );

        $response = $this->client->sendRequest($request);

        return $response->getBody()->getContents();
    }

}
