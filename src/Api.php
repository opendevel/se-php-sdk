<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use Http\Message\Authentication;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\SendCustomEmailsBulkRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\SendTransactionalEmailsBulkRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ContactRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ContactsRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ForgetContactRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Eshops\OrdersRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Eshops\ShoppingCartRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\ImportRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Newsletter\NewsletterRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\Ping;
use SmartEmailing\Sdk\ApiV3Client\Response\Campaigns\SendCustomEmailsBulkResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Campaigns\SendTransactionalEmailsBulkResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\ContactResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\ContactsResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\ForgetContactResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Eshops\OrdersResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Eshops\ShoppingCartResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Newsletter\NewsletterResponse;
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

    public function importContacts(ImportRequest $apiRequest): ImportResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ImportResponse::fromArray(json_decode($result, true));
    }

    public function getContacts(ContactsRequest $apiRequest): ContactsResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ContactsResponse::fromArray(json_decode($result, true));
    }

    public function getContact(ContactRequest $apiRequest): ContactResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ContactResponse::fromArray(json_decode($result, true));
    }

    public function sendCustomEmailsBulk(SendCustomEmailsBulkRequest $apiRequest): SendCustomEmailsBulkResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return SendCustomEmailsBulkResponse::fromArray(json_decode($result, true));
    }

    public function sendTransactionalEmailsBulk(SendTransactionalEmailsBulkRequest $apiRequest): SendTransactionalEmailsBulkResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return SendTransactionalEmailsBulkResponse::fromArray(json_decode($result, true));
    }

    public function addPlacedOrder(OrdersRequest $apiRequest): OrdersResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return OrdersResponse::fromArray(json_decode($result, true));
    }

    public function updateShoppingCart(ShoppingCartRequest $apiRequest): ShoppingCartResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ShoppingCartResponse::fromArray(json_decode($result, true));
    }

    public function createNewsletter(NewsletterRequest $apiRequest): NewsletterResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return NewsletterResponse::fromArray(json_decode($result, true));
    }

    public function forgetContact(ForgetContactRequest $apiRequest): ForgetContactResponse
    {
        $result = $this->apiClient->sendRequest($apiRequest);
        return ForgetContactResponse::fromArray(json_decode($result, true));
    }

}
