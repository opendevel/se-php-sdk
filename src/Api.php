<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

use SmartEmailing\Sdk\Request\Import\Import;
use SmartEmailing\Sdk\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\Request\Test\Ping;
use SmartEmailing\Sdk\Response\Import\ImportResponse;
use SmartEmailing\Sdk\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\Response\Test\PingResponse;

class Api
{

    /**
     * @var \SmartEmailing\Sdk\ApiClient
     */
    private $apiClient;

    public function __construct(?string $username = null, ?string $password = null)
    {
        $this->apiClient = new ApiClient($username, $password);
    }

    public function ping(Ping $requestModel): PingResponse
    {
        $result = $this->apiClient->sendRequest($requestModel);
        return PingResponse::fromArray(json_decode($result, true));
    }

    public function checkCredentials(CheckCredentials $requestModel): CheckCredentialsResponse
    {
        $result = $this->apiClient->sendRequest($requestModel);
        return CheckCredentialsResponse::fromArray(json_decode($result, true));
    }

    public function import(Import $requestModel): ImportResponse
    {
        $result = $this->apiClient->sendRequest($requestModel);
        return ImportResponse::fromArray(json_decode($result, true));
    }

}
