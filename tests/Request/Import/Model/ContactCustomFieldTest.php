<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\TestCase;

final class ContactCustomFieldTest extends TestCase
{

    public function testCreateSimple(): void
    {
        // ARRANGE
        $customField = new ContactCustomField(1, '2016-01-10 13:53:03');

        $output = [
            'id' => 1,
            'value' => '2016-01-10 13:53:03',
        ];

        // ACT

        // ASSERT
        $this->assertSame($output, $customField->toArray());
    }

    public function testCreateComposite(): void
    {
        // ARRANGE
        $customField = new ContactCustomField(1, [1, 3]);

        $output = [
            'id' => 1,
            'options' => [1, 3],
        ];

        // ACT

        // ASSERT
        $this->assertSame($output, $customField->toArray());
    }

    public function testCreateFromArraySimple(): void
    {
        // ARRANGE
        $input = [
            'id' => 8,
            'value' => '2016-01-10 13:53:03',
        ];

        $output = [
            'id' => 8,
            'value' => '2016-01-10 13:53:03',
        ];

        $customField = ContactCustomField::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactCustomField::class, $customField);
        $this->assertSame($output, $customField->toArray());
    }

    public function testCreateFromArrayComposite(): void
    {
        // ARRANGE
        $input = [
            'id' => 1,
            'options' => [
                1,
                3,
            ],
        ];

        $output = [
            'id' => 1,
            'options' => [
                1,
                3,
            ],
        ];

        $customField = ContactCustomField::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactCustomField::class, $customField);
        $this->assertSame($output, $customField->toArray());
    }

    public function testCreateFromArrayException(): void
    {
        $input = [
            'id' => 1,
        ];

        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        ContactCustomField::fromArray($input);
    }

}
