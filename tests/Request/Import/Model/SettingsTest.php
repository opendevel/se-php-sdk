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
            'confirmation_request' => null,
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
                    'confirmation_thank_you_page_url' => null,
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

    public function testPropertyUpdate(): void
    {
        $settings = new Settings();
        $this->assertSame(true, $settings->toArray()['update']);

        $settings = new Settings();
        $settings->setUpdate(true);
        $this->assertSame(true, $settings->toArray()['update']);

        $settings = new Settings();
        $settings->setUpdate(false);
        $this->assertSame(false, $settings->toArray()['update']);
    }

    public function testPropertyAddNamedays(): void
    {
        $settings = new Settings();
        $this->assertSame(true, $settings->toArray()['add_namedays']);

        $settings = new Settings();
        $settings->setAddNamedays(true);
        $this->assertSame(true, $settings->toArray()['add_namedays']);

        $settings = new Settings();
        $settings->setAddNamedays(false);
        $this->assertSame(false, $settings->toArray()['add_namedays']);
    }

    public function testPropertyAddGenders(): void
    {
        $settings = new Settings();
        $this->assertSame(true, $settings->toArray()['add_genders']);

        $settings = new Settings();
        $settings->setAddGenders(true);
        $this->assertSame(true, $settings->toArray()['add_genders']);

        $settings = new Settings();
        $settings->setAddGenders(false);
        $this->assertSame(false, $settings->toArray()['add_genders']);
    }

    public function testPropertyAddSalutions(): void
    {
        $settings = new Settings();
        $this->assertSame(true, $settings->toArray()['add_salutions']);

        $settings = new Settings();
        $settings->setAddSalutions(true);
        $this->assertSame(true, $settings->toArray()['add_salutions']);

        $settings = new Settings();
        $settings->setAddSalutions(false);
        $this->assertSame(false, $settings->toArray()['add_salutions']);
    }

    public function testPropertyPreserveUnsubscribed(): void
    {
        $settings = new Settings();
        $this->assertSame(true, $settings->toArray()['preserve_unsubscribed']);

        $settings = new Settings();
        $settings->setPreserveUnsubscribed(true);
        $this->assertSame(true, $settings->toArray()['preserve_unsubscribed']);

        $settings = new Settings();
        $settings->setPreserveUnsubscribed(false);
        $this->assertSame(false, $settings->toArray()['preserve_unsubscribed']);
    }

    public function testPropertySkipInvalidEmails(): void
    {
        $settings = new Settings();
        $this->assertSame(false, $settings->toArray()['skip_invalid_emails']);

        $settings = new Settings();
        $settings->setSkipInvalidemails(true);
        $this->assertSame(true, $settings->toArray()['skip_invalid_emails']);

        $settings = new Settings();
        $settings->setSkipInvalidemails(false);
        $this->assertSame(false, $settings->toArray()['skip_invalid_emails']);
    }

    public function testPropertyConfirmationRequest(): void
    {
        //@todo:
//        $settings = new Settings();
//        dump($settings->toArray()['confirmation_request']);
//
//        $settings = new Settings();
//        $settings->setConfirmationRequest(new SettingsConfirmationRequest('https://www.example.com/'));
//        dump($settings->toArray()['confirmation_request']);
    }

}
