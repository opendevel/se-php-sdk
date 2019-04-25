<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\TestCase;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\UrlType;

final class SettingsConfirmationRequestTest extends TestCase
{

    public function testCreateMinimum(): void
    {
        // ARRANGE
        $output = [
            'email_id' => 1,
            'sender_credentials' => [
                'from' => "john.doe@example.com",
                'sender_name' => "John Doe",
                'reply_to' => "jane.doe@example.com",
            ],
        ];

        $confirmationRequest = new SettingsConfirmationRequest(
            1,
            Emailaddress::from('john.doe@example.com'),
            'John Doe',
            Emailaddress::from('jane.doe@example.com')
        );

        // ACT

        // ASSERT
        $this->assertSame($output, $confirmationRequest->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'email_id' => 1,
            'sender_credentials' => [
                'from' => "john.doe@example.com",
                'sender_name' => "John Doe",
                'reply_to' => "jane.doe@example.com",
            ],
            'confirmation_thank_you_page_url' => 'https://www.example.com/',
        ];

        $confirmationRequest = new SettingsConfirmationRequest(
            1,
            Emailaddress::from('john.doe@example.com'),
            'John Doe',
            Emailaddress::from('jane.doe@example.com'),
            UrlType::from('https://www.example.com/')
        );

        // ACT

        // ASSERT
        $this->assertSame($output, $confirmationRequest->toArray());
    }

    public function testSetConfirmationThankYouPageUrl(): void
    {
        // ARRANGE
        $output = [
            'email_id' => 1,
            'sender_credentials' => [
                'from' => "john.doe@example.com",
                'sender_name' => "John Doe",
                'reply_to' => "jane.doe@example.com",
            ],
            'confirmation_thank_you_page_url' => 'https://www.example.com/',
        ];

        $confirmationRequest = new SettingsConfirmationRequest(
            1,
            Emailaddress::from('john.doe@example.com'),
            'John Doe',
            Emailaddress::from('jane.doe@example.com')
        );

        // ACT
        $confirmationRequest->setConfirmationThankYouPageUrl(UrlType::from('https://www.example.com/'));

        // ASSERT
        $this->assertSame($output, $confirmationRequest->toArray());
    }

}
