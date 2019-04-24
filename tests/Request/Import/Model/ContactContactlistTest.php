<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Status\ContactListStatus;
use SmartEmailing\Sdk\TestCase;

final class ContactContactlistTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [
            'id' => 1,
            'status' => 'confirmed',
        ];

        $contactList = new ContactContactlist(1, ContactListStatus::from('confirmed'));

        // ACT

        // ASSERT
        $this->assertSame($output, $contactList->toArray());
    }

    public function testCreateFromArray(): void
    {
        // ARRANGE
        $input = [
            'id' => 1,
            'status' => 'confirmed',
        ];

        $output = [
            'id' => 1,
            'status' => 'confirmed',
        ];

        $contactList = ContactContactlist::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactContactlist::class, $contactList);
        $this->assertSame($output, $contactList->toArray());
    }

    public function testStatus(): void
    {
        // ARRANGE
        $status = ContactListStatus::from('confirmed');

        // ACT

        // ASSERT
        $this->assertSame('confirmed', $status->getValue());
    }

    public function testStatusException(): void
    {
        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        ContactListStatus::from('');

        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        ContactListStatus::from('aaa');
    }

}
