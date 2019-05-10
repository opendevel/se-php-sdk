<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\Enum\ContactListStatus;
use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class ContactListTest extends TestCase
{

    public function testCreateFromArrayMin(): void
    {
        $input = [
            'id' => 5,
            'contactlist_id' => 1,
        ];

        $contactList = ContactList::fromArray($input);

        $this->assertInstanceOf(ContactList::class, $contactList);

        $this->assertSame(5, $contactList->getId());
        $this->assertSame(1, $contactList->getContactListId());
        $this->assertSame(null, $contactList->getStatus());
        $this->assertSame(null, $contactList->getAdded());
        $this->assertSame(null, $contactList->getUpdated());
    }

    public function testCreateFromArrayFull(): void
    {
        $input = [
            'id' => 5,
            'contactlist_id' => 1,
            'status' => 'confirmed',
            'added' => '2018-12-30 01:02:00',
            'updated' => '2019-12-31 01:02:00',
        ];

        $contactList = ContactList::fromArray($input);

        $this->assertInstanceOf(ContactList::class, $contactList);
        $this->assertInstanceOf(ContactListStatus::class, $contactList->getStatus());

        $this->assertSame(5, $contactList->getId());
        $this->assertSame(1, $contactList->getContactListId());
        if (!is_null($contactList->getStatus())) {  // because of phpstan
            $this->assertSame(ContactListStatus::CONFIRMED, $contactList->getStatus()->getValue());
        }
        $this->assertEquals(new DateTimeImmutable($input['added']), $contactList->getAdded());
        $this->assertEquals(new DateTimeImmutable($input['updated']), $contactList->getUpdated());
    }

}
