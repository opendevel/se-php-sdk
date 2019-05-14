<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Campaigns;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class SendCustomEmailsBulkResponseTest extends TestCase
{

    public function testCreateFromJson(): void
    {

        $json = '{
            "status": "created",
            "meta": []
        }';

        $array = json_decode($json, true);

        $response = SendCustomEmailsBulkResponse::fromArray($array);

        $this->assertInstanceOf(SendCustomEmailsBulkResponse::class, $response);
        $this->assertSame('created', $response->getStatus());
        $this->assertSame(null, $response->getMessage());
        $this->assertSame([], $response->getMeta());
    }

}
