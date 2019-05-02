<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use SmartEmailing\Sdk\ApiV3Client\Request\Import\Import;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\Ping;
use SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\PingResponse;

class Api
{

    /**
     * @var \SmartEmailing\Sdk\ApiV3Client\ApiClient
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
