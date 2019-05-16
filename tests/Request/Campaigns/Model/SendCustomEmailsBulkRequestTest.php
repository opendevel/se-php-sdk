<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\SendCustomEmailsBulkRequest;
use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class SendCustomEmailsBulkRequestTest extends TestCase
{

    public function testCreate(): void
    {

        // ARRANGE
        $output = [
            'sender_credentials' => [
                'from' => 'jane.doe@example.com',
                'sender_name' => 'John Doe',
                'reply_to' => 'john.doe@example.com',
            ],
            'tag' => 'bulk_1',
            'email_id' => 71,
            'tasks' => [
                [
                    'recipient' => [
                        'emailaddress' => 'john.doe@example.com',
                    ],
                    'template_variables' => [
                        'order_id' => 0037565,
                        'products' => [
                            [
                                'name' => 'Red car',
                                'description' => 'lightning fast!',
                                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png',
                            ],
                            [
                                'name' => 'Zed\'s chopper',
                                'description' => 'It\'s not a motorcycle, baby. It\'s a chopper.',
                                'image_url' => 'http://www.imcdb.org/i013795.jpg',
                            ],
                        ],
                    ],
                ],
                [
                    'recipient' => [
                        'emailaddress' => 'john.doe@example.com',
                    ],
                ],
            ],
        ];

        // ACT
        $senderCredentials = new SenderCredentials(
            'jane.doe@example.com',
            'John Doe',
            'john.doe@example.com'
        );

        $sendCustomEmailsBulkRequest = new SendCustomEmailsBulkRequest(
            $senderCredentials,
            'bulk_1',
            71
        );

        $recipient1 = new Recipient('john.doe@example.com');
        $task1 = new Task($recipient1);
        $task1->addTemplateVariable('order_id', 0037565);
        $task1->addTemplateVariable(
            'products',
            [
                [
                    'name' => 'Red car',
                    'description' => 'lightning fast!',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png',
                ],
                [
                    'name' => 'Zed\'s chopper',
                    'description' => 'It\'s not a motorcycle, baby. It\'s a chopper.',
                    'image_url' => 'http://www.imcdb.org/i013795.jpg',
                ],
            ]
        );

        $sendCustomEmailsBulkRequest->addTask($task1);

        $task2 = new Task(new Recipient('john.doe@example.com'));

        $sendCustomEmailsBulkRequest->addTask($task2);

        // ASSERT
        $this->assertSame($output, $sendCustomEmailsBulkRequest->toArray());
    }

}
