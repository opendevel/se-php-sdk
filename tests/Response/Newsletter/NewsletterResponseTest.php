<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Newsletter;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class NewsletterResponseTest extends TestCase
{

    public function testCreateFromJson(): void
    {

        $json = '{
            "status": "created",
            "meta": [],
            "data": {
                "id": 1
            }
        }';

        $array = json_decode($json, true);

        $response = NewsletterResponse::fromArray($array);

        $this->assertSame('created', $response->getStatus());
        $this->assertSame(null, $response->getMessage());
        $this->assertSame([], $response->getMeta());
        $this->assertSame(['id' => 1], $response->getData());
    }

}
