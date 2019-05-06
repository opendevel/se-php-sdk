<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use Http\Message\Authentication;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ContactRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\Contacts;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Import;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\Ping;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\ContactResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\ContactsResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\PingResponse;

final class Api
{

    /**
     * @var \SmartEmailing\Sdk\ApiV3Client\ApiClient
     */
    private $apiClient;

    public function __construct(Authentication $authentication)
    {
        $this->apiClient = new ApiClient($authentication);
    }

    public function ping(Ping $apiRequest): PingResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return PingResponse::fromArray(json_decode($result, true));
    }

    public function checkCredentials(CheckCredentials $apiRequest): CheckCredentialsResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return CheckCredentialsResponse::fromArray(json_decode($result, true));
    }

    public function import(Import $apiRequest): ImportResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ImportResponse::fromArray(json_decode($result, true));
    }

    public function contacts(Contacts $apiRequest): ContactsResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ContactsResponse::fromArray(json_decode($result, true));
    }

    public function contact(ContactRequest $apiRequest): ContactResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ContactResponse::fromArray(json_decode($result, true));
    }

}
