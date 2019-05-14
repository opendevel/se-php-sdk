<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class SenderCredentialsTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [
            'from' => 'jane.doe@example.com',
            'sender_name' => 'John Doe',
            'reply_to' => 'john.doe@example.com',
        ];

        $senderCredentials = new SenderCredentials('jane.doe@example.com', 'John Doe', 'john.doe@example.com');

        // ACT

        // ASSERT
        $this->assertSame($output, $senderCredentials->toArray());
    }

}
