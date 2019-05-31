<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Newsletter;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class NewsletterRequestTest extends TestCase
{

    public function testCreateMin(): void
    {
        $output = [
            'email_id' => 1,
            'contactlists' => [
                1,
                2,
            ],
        ];

        $request = new NewsletterRequest(1, [1, 2]);

        $this->assertEquals($output, $request->toArray());
    }

    public function testCreateFull(): void
    {
        $output = [
            'email_id' => 1,
            'contactlists' => [
                1,
                2,
            ],
            'excluded_contactlists' => [
                3,
            ],
            'name' => 'My awesome newsletter',
            'start' => '2020-06-15 18:30:00',
            'measurestats' => true,
            'sendOnPreferredTime' => false,
            'senderemail' => 'john.doe@example.com',
            'sendername' => 'John Doe',
            'replyto' => 'john.doe@example.com',
            'utm_source' => 'summer-mailer',
            'utm_medium' => 'email',
            'utm_campaign' => 'summer-sale',
            'utm_content' => 'toplink',
        ];

        $request = new NewsletterRequest(1, [1, 2]);
        $request->setExcludedContactLists([3]);
        $request->setName('My awesome newsletter');
        $request->setStart(new DateTimeImmutable('2020-06-15 18:30:00'));
        $request->setMeasureStats(true);
        $request->setSendOnPreferredTime(false);
        $request->setSenderEmail('john.doe@example.com');
        $request->setSenderName('John Doe');
        $request->setReplyTo('john.doe@example.com');
        $request->setUtmSource('summer-mailer');
        $request->setUtmMedium('email');
        $request->setUtmCampaign('summer-sale');
        $request->setUtmContent('toplink');

        $this->assertEquals($output, $request->toArray());
    }

}
