<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class TaskTest extends TestCase
{

    public function testCreateMin(): void
    {
        // ARRANGE
        $output = [
            'recipient' => [
                'emailaddress' => 'john.doe@example.com',
            ],
        ];

        // ACT
        $task = new Task(new Recipient('john.doe@example.com'));

        // ASSERT
        $this->assertSame($output, $task->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'recipient' => [
                'emailaddress' => 'john.doe@example.com',
            ],
            'template_variables' => [
                'order_id' => '0037565',
                'products' => [
                    [
                        'name' => 'Red car',
                        'description' => 'lightning fast!',
                        'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png!',
                    ],
                    [
                        'name' => 'Zed\'s chopper',
                        'description' => 'It\'s not a motorcycle, baby. It\'s a chopper.',
                        'image_url' => 'http://www.imcdb.org/i013795.jpg',
                    ],
                ],
            ],
        ];

        // ACT
        $task = new Task(new Recipient('john.doe@example.com'));

        $task->addTemplateVariable('order_id', '0037565');

        $templateVariable2Value = [
            [
                'name' => 'Red car',
                'description' => 'lightning fast!',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png!',
            ],
            [
                'name' => 'Zed\'s chopper',
                'description' => 'It\'s not a motorcycle, baby. It\'s a chopper.',
                'image_url' => 'http://www.imcdb.org/i013795.jpg',
            ],
        ];

        $task->addTemplateVariable('products', $templateVariable2Value);

        // ASSERT
        $this->assertSame($output, $task->toArray());
    }

}
