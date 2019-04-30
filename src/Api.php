<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

use SmartEmailing\Sdk\Request\Import\ImportRequest;
use SmartEmailing\Sdk\Request\Import\Model\Import;
use SmartEmailing\Sdk\Request\Test\CheckCredentialsRequest;
use SmartEmailing\Sdk\Request\Test\Model\CheckCredentials;
use SmartEmailing\Sdk\Request\Test\Model\Ping;
use SmartEmailing\Sdk\Request\Test\PingRequest;
use SmartEmailing\Sdk\Response\Import\ImportResponse;
use SmartEmailing\Sdk\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\Response\Test\PingResponse;

class Api
{

    /**
     * @var \SmartEmailing\Sdk\HttpClient
     */
    private $httpClient;

    public function __construct(?string $username = null, ?string $password = null)
    {
        $this->httpClient = new HttpClient($username, $password);
    }

    public function ping(Ping $requestModel): PingResponse
    {
        $request = new PingRequest();
        $result = $this->httpClient->send($request->getMethod(), $request->getUri(), $requestModel->toArray());
        return PingResponse::fromArray(json_decode($result, true));
    }

    public function checkCredentials(CheckCredentials $requestModel): CheckCredentialsResponse
    {
        $request = new CheckCredentialsRequest();
        $result = $this->httpClient->send($request->getMethod(), $request->getUri(), $requestModel->toArray());
        return CheckCredentialsResponse::fromArray(json_decode($result, true));
    }

    public function import(Import $requestModel): ImportResponse
    {
        $request = new ImportRequest();
        $result = $this->httpClient->send($request->getMethod(), $request->getUri(), $requestModel->toArray());
        return ImportResponse::fromArray(json_decode($result, true));
    }

}
