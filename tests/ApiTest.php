<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

use Dotenv\Dotenv;
use SmartEmailing\Sdk\Request\Import\Import;
use SmartEmailing\Sdk\Request\Import\Model\Contact;
use SmartEmailing\Sdk\Request\Test\CheckCredentials;
use SmartEmailing\Sdk\Request\Test\Ping;
use SmartEmailing\Sdk\Response\Import\ImportResponse;
use SmartEmailing\Sdk\Response\Test\CheckCredentialsResponse;
use SmartEmailing\Sdk\Response\Test\PingResponse;

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
