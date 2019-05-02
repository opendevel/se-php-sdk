<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class ContactPurposeTest extends TestCase
{

    public function testCreateMinimum(): void
    {
        // ARRANGE
        $output = [
            'id' => 1,
            'valid_from' => null,
            'valid_to' => null,
        ];

        $contactPurpose = new ContactPurpose(1);

        // ACT

        // ASSERT
        $this->assertSame($output, $contactPurpose->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'id' => 1,
            'valid_from' => '2020-12-31 12:59:59',
            'valid_to' => '2020-12-31 12:59:59',
        ];

        $contactPurpose = new ContactPurpose(1);

        // ACT
        $contactPurpose->setValidFrom(new DateTimeImmutable('2020-12-31 12:59:59'));

        $contactPurpose->setValidTo(new DateTimeImmutable('2020-12-31 12:59:59'));

        // ASSERT
        $this->assertSame($output, $contactPurpose->toArray());
    }

    public function testCreateFromArray1(): void
    {
        // ARRANGE
        $input = [
            'id' => 1,
        ];

        $output = [
            'id' => 1,
            'valid_from' => null,
            'valid_to' => null,
        ];

        $contactPurpose = ContactPurpose::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactPurpose::class, $contactPurpose);
        $this->assertSame($output, $contactPurpose->toArray());
    }

    public function testCreateFromArray2(): void
    {
        // ARRANGE
        $input = [
            'id' => 1,
            'valid_from' => new DateTimeImmutable('2019-04-24 20:35:00'),
        ];

        $output = [
            'id' => 1,
            'valid_from' => '2019-04-24 20:35:00',
            'valid_to' => null,
        ];

        $contactPurpose = ContactPurpose::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactPurpose::class, $contactPurpose);
        $this->assertSame($output, $contactPurpose->toArray());
    }

    public function testCreateFromArray3(): void
    {
        // ARRANGE
        $input = [
            'id' => 1,
            'valid_to' => new DateTimeImmutable('2019-04-24 20:35:00'),
        ];

        $output = [
            'id' => 1,
            'valid_from' => null,
            'valid_to' => '2019-04-24 20:35:00',
        ];

        $contactPurpose = ContactPurpose::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactPurpose::class, $contactPurpose);
        $this->assertSame($output, $contactPurpose->toArray());
    }

    public function testCreateFromArray4(): void
    {
        // ARRANGE
        $input = [
            'id' => 1,
            'valid_from' => new DateTimeImmutable('2019-04-23 19:40:00'),
            'valid_to' => new DateTimeImmutable('2019-04-24 20:35:00'),
        ];

        $output = [
            'id' => 1,
            'valid_from' => '2019-04-23 19:40:00',
            'valid_to' => '2019-04-24 20:35:00',
        ];

        $contactPurpose = ContactPurpose::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(ContactPurpose::class, $contactPurpose);
        $this->assertSame($output, $contactPurpose->toArray());
    }

}
