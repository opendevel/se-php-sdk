<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class RecipientTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [
            'emailaddress' => 'john.doe@example.com',
        ];

        $recipient = new Recipient('john.doe@example.com');

        // ACT

        // ASSERT
        $this->assertSame($output, $recipient->toArray());
    }

}
