<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use SmartEmailing\Sdk\Api;
use function GuzzleHttp\Psr7\stream_for;

abstract class AbstractBaseRequest
{

    /**
     * @var \SmartEmailing\Sdk\Api
     */
    protected $api;

    /**
     * Request method
     * @var string
     */
    protected $method = '';

    /**
     * Request uri
     * @var string
     */
    protected $uri = '';

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    abstract protected function toArray(): array;

    public function getBody(): array
    {
        return $this->toArray();
    }

    public function sendRequest(): ResponseInterface
    {
        $client = $this->api->getHttpClient();

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $stream = stream_for(json_encode($this->getBody()));

        $request = new Request($this->method, $this->uri, $headers, $stream);

        return $client->sendRequest($request);
    }

}
