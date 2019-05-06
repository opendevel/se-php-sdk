<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use Dotenv\Dotenv;
use Http\Message\Authentication\BasicAuth;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\ContactRequest;
use SmartEmailing\Sdk\ApiV3Client\Request\Contacts\Contacts;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Import;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\Contact;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\Ping;
use SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\PingResponse;

final class ApiTest extends TestCase
{

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $dotEnv = Dotenv::create(__DIR__)->load();
        $this->username = $dotEnv['username'] ?? '';
        $this->password = $dotEnv['password'] ?? '';
    }

    public function testApiPingResponse(): void
    {
        // API
        $authentication = new BasicAuth($this->username, $this->password);
        $api = new Api($authentication);

        // Ping
        $ping = new Ping();
        $pingResponse = $api->ping($ping);

        $this->assertInstanceOf(PingResponse::class, $pingResponse);
        $this->assertSame('ok', $pingResponse->getStatus());
        $this->assertSame('Hi there! API version 3 here!', $pingResponse->getMessage());
        $this->assertSame([], $pingResponse->getMeta());
    }

    public function testCheckCredentialsResponse(): void
    {
        // API
        $authentication = new BasicAuth($this->username, $this->password);
        $api = new Api($authentication);

        // Check Credentials
        $checkCredentials = new CheckCredentials();
        $checkCredentialsResponse = $api->checkCredentials($checkCredentials);

        $this->assertInstanceOf(CheckCredentialsResponse::class, $checkCredentialsResponse);
        $this->assertSame('ok', $checkCredentialsResponse->getStatus());
        $this->assertSame('Hi there! Your credentials are valid!', $checkCredentialsResponse->getMessage());
        $this->assertSame([], $checkCredentialsResponse->getMeta());
    }

    public function testImportResponse(): void
    {
        // API
        $authentication = new BasicAuth($this->username, $this->password);
        $api = new Api($authentication);

        // Import contacts
        $import = new Import();
        $import->addContact(new Contact('john.doe@example.com'));
        $importResponse = $api->import($import);

        $this->assertInstanceOf(ImportResponse::class, $importResponse);
        $this->assertSame('created', $importResponse->getStatus());
        $this->assertSame(null, $importResponse->getMessage());
        $this->assertSame([], $importResponse->getMeta());
        $this->assertIsArray($importResponse->getContacts());
    }

    public function testContactsResponse(): void
    {
        // API
        $authentication = new BasicAuth($this->username, $this->password);
        $api = new Api($authentication);

        $contacts = new Contacts();
        $contactsResponse = $api->contacts($contacts);

        $this->assertIsArray($contactsResponse->getContacts());
    }

    public function testContactResponse(): void
    {
        // API
        $authentication = new BasicAuth($this->username, $this->password);
        $api = new Api($authentication);

        $contact = new ContactRequest(40);
        $contactResponse = $api->contact($contact);
    }

}
