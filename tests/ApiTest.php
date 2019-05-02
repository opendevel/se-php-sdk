<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

use Dotenv\Dotenv;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Import;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\Contact;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Test\Ping;
use SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Test\PingResponse;

final class ApiTest extends TestCase
{

    public function testApiPing(): void
    {
        // API
        $dotEnv = Dotenv::create(__DIR__)->load();
        $api = new Api($dotEnv['username'], $dotEnv['password']);

        // Ping
        $ping = new Ping();
        $pingResponse = $api->ping($ping);

        $this->assertInstanceOf(PingResponse::class, $pingResponse);
        $this->assertSame('ok', $pingResponse->getStatus());
        $this->assertSame('Hi there! API version 3 here!', $pingResponse->getMessage());
        $this->assertSame([], $pingResponse->getMeta());
    }

    public function testCheckCredentials(): void
    {
        // API
        $dotEnv = Dotenv::create(__DIR__)->load();
        $api = new Api($dotEnv['username'], $dotEnv['password']);

        // Check Credentials
        $checkCredentials = new CheckCredentials();
        $checkCredentialsResponse = $api->checkCredentials($checkCredentials);

        $this->assertInstanceOf(CheckCredentialsResponse::class, $checkCredentialsResponse);
        $this->assertSame('ok', $checkCredentialsResponse->getStatus());
        $this->assertSame('Hi there! Your credentials are valid!', $checkCredentialsResponse->getMessage());
        $this->assertSame([], $checkCredentialsResponse->getMeta());
    }

    public function testImport(): void
    {
        // API
        $dotEnv = Dotenv::create(__DIR__)->load();
        $api = new Api($dotEnv['username'], $dotEnv['password']);

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

}
