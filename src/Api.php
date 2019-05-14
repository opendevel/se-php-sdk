<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use Http\Message\Authentication;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\SendCustomEmailsBulkRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ContactRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ContactsRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\ImportRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\Ping;
use SmartEmailing\Sdk\ApiV3Client\Response\Campaigns\SendCustomEmailsBulkResponse;
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

    public function import(ImportRequest $apiRequest): ImportResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ImportResponse::fromArray(json_decode($result, true));
    }

    public function contacts(ContactsRequest $apiRequest): ContactsResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ContactsResponse::fromArray(json_decode($result, true));
    }

    public function contact(ContactRequest $apiRequest): ContactResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ContactResponse::fromArray(json_decode($result, true));
    }

    public function sendCustomEmailsBulk(SendCustomEmailsBulkRequest $apiRequest): SendCustomEmailsBulkResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return SendCustomEmailsBulkResponse::fromArray(json_decode($result, true));
    }

}
