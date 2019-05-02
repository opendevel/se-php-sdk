<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Import\Model;

use SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse;
use SmartEmailing\Sdk\ApiV3Client\TestCase;
use SmartEmailing\Types\Emailaddress;

final class ImportResponseTest extends TestCase
{

    public function testCreateFromJson(): void
    {

        $json = '{
            "status": "created",
            "meta": [],
            "contacts_map": [
                {
                    "emailaddress": "john.doe@example.com",
                    "contact_id": 1
                },
                {
                    "emailaddress": "jane.doe@example.com",
                    "contact_id": 2
                }
            ]
        }';

        $array = json_decode($json, true);

        $importResponse = ImportResponse::fromArray($array);

        $this->assertInstanceOf(ImportResponse::class, $importResponse);
        $this->assertSame('created', $importResponse->getStatus());
        $this->assertSame(null, $importResponse->getMessage());
        $this->assertSame([], $importResponse->getMeta());
    }

    public function testCreateFromJson422(): void
    {

        $json = '{
            "status": "error",
            "meta": [],
            "message": "Emailaddress invalid@email@gmail.com is not valid email address."
        }';

        $array = json_decode($json, true);

        $importResponse = ImportResponse::fromArray($array);

        $this->assertInstanceOf(ImportResponse::class, $importResponse);
        $this->assertSame('error', $importResponse->getStatus());
        $this->assertSame('Emailaddress invalid@email@gmail.com is not valid email address.', $importResponse->getMessage());
        $this->assertSame([], $importResponse->getMeta());
        $this->assertSame([], $importResponse->getContacts());
    }

    public function testCreateFromJson401(): void
    {

        $json = '{
            "status": "error",
            "meta": [],
            "message": "Authentication Failed"
        }';

        $array = json_decode($json, true);

        $importResponse = ImportResponse::fromArray($array);

        $this->assertInstanceOf(ImportResponse::class, $importResponse);
        $this->assertSame('error', $importResponse->getStatus());
        $this->assertSame('Authentication Failed', $importResponse->getMessage());
        $this->assertSame([], $importResponse->getMeta());
        $this->assertSame([], $importResponse->getContacts());
    }

    public function testGetContacts(): void
    {
        $json = '{
            "status": "created",
            "meta": [],
            "contacts_map": [
                {
                    "emailaddress": "john.doe@example.com",
                    "contact_id": 1
                },
                {
                    "emailaddress": "jane.doe@example.com",
                    "contact_id": 2
                }
            ]
        }';

        $array = json_decode($json, true);

        $importResponse = ImportResponse::fromArray($array);

        $contacts = $importResponse->getContacts();
        $contact = $contacts[1];

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertSame(1, $contact->getId());
        $this->assertEquals(Emailaddress::from('john.doe@example.com'), $contact->getEmailAddress());
    }

    public function testGetContact(): void
    {
        $json = '{
            "status": "created",
            "meta": [],
            "contacts_map": [
                {
                    "emailaddress": "john.doe@example.com",
                    "contact_id": 1
                },
                {
                    "emailaddress": "jane.doe@example.com",
                    "contact_id": 2
                }
            ]
        }';

        $array = json_decode($json, true);

        $importResponse = ImportResponse::fromArray($array);

        $contact = $importResponse->getContact(1);

        $this->assertInstanceOf(Contact::class, $contact);
        //$this->assertSame(1, $contact->getId());
        //$this->assertEquals(Emailaddress::from('john.doe@example.com'), $contact->getEmailAddress());
    }

    public function testHasContact(): void
    {
        $json = '{
            "status": "created",
            "meta": [],
            "contacts_map": [
                {
                    "emailaddress": "john.doe@example.com",
                    "contact_id": 1
                }
            ]
        }';

        $array = json_decode($json, true);
        $importResponse = ImportResponse::fromArray($array);

        $this->assertSame(true, $importResponse->hasContact(1));
        $this->assertSame(false, $importResponse->hasContact(11));
    }

}
