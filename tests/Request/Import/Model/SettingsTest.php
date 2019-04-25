<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\TestCase;
use SmartEmailing\Types\Emailaddress;

final class SettingsTest extends TestCase
{

    public function testCreateMinimum(): void
    {
        // ARRANGE
        $output = [
            'update' => true,
            'add_namedays' => true,
            'add_genders' => true,
            'add_salutions' => true,
            'preserve_unsubscribed' => true,
            'skip_invalid_emails' => false,
        ];

        $settings = new Settings();

        // ACT

        // ASSERT
        $this->assertSame($output, $settings->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'update' => true,
            'add_namedays' => true,
            'add_genders' => true,
            'add_salutions' => true,
            'preserve_unsubscribed' => true,
            'skip_invalid_emails' => true,
            'confirmation_request' =>
                [
                    'email_id' => 1,
                    'sender_credentials' =>
                        [
                            'from' => 'john.doe@example.com',
                            'sender_name' => 'John Doe',
                            'reply_to' => 'jane.doe@example.com',
                        ],
                ],
        ];

        $settings = new Settings();
        $settings->setUpdate(true);
        $settings->setAddNamedays(true);
        $settings->setAddGenders(true);
        $settings->setAddSalutions(true);
        $settings->setPreserveUnsubscribed(true);
        $settings->setSkipInvalidemails(true);
        $settings->setConfirmationRequest(new SettingsConfirmationRequest(
            1,
            Emailaddress::from('john.doe@example.com'),
            'John Doe',
            Emailaddress::from('jane.doe@example.com')
        ));

        // ACT

        // ASSERT
        $this->assertSame($output, $settings->toArray());
    }

}
