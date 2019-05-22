<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns;

use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Recipient;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\SenderCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Task2;
use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class SendTransactionalEmailsBulkRequestTest extends TestCase
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
            'tag' => 'transactional_1',
            'email_id' => 14,
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
                    'attachments' => [
                        [
                            'file_name' => 'Invoice.pdf',
                            'content_type' => 'application/pdf',
                            'data_base64' => 'XNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlzIHNpbmd1bGFy=',
                        ],
                        [
                            'file_name' => 'TermsAndConditions.pdf',
                            'content_type' => 'application/pdf',
                            'data_base64' => 'YNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlzIHNpbmd1bGFy=',
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

        $sendTransactionalEmailsBulkRequest = new SendTransactionalEmailsBulkRequest(
            $senderCredentials,
            'transactional_1',
            14
        );

        $recipient1 = new Recipient('john.doe@example.com');
        $task1 = new Task2($recipient1);
        $task1->addTemplateVariable('order_id', 0037565);
        $task1->addTemplateVariable(
            'products',
            [
                [
                    "name" => "Red car",
                    "description" => "lightning fast!",
                    "image_url" => "https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png",
                ],
                [
                    "name" => "Zed's chopper",
                    "description" => "It's not a motorcycle, baby. It's a chopper.",
                    "image_url" => "http://www.imcdb.org/i013795.jpg",
                ],
            ]
        );

        $task1->addAttachment(
            'Invoice.pdf',
            'application/pdf',
            'XNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlzIHNpbmd1bGFy='
        );
        $task1->addAttachment(
            'TermsAndConditions.pdf',
            'application/pdf',
            'YNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlzIHNpbmd1bGFy='
        );

        $sendTransactionalEmailsBulkRequest->addTask($task1);

        $task2 = new Task2(new Recipient('john.doe@example.com'));

        $sendTransactionalEmailsBulkRequest->addTask($task2);

        // ASSERT
        $this->assertSame($output, $sendTransactionalEmailsBulkRequest->toArray());
    }

}
