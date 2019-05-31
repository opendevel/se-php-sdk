<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class ForgetContactResponseTest extends TestCase
{

    public function testCreateFromJson204(): void
    {

        //@todo meta neni
        $json = '{
            "status": "deleted",
            "meta": []
        }';

        $array = json_decode($json, true);

        $response = ForgetContactResponse::fromArray($array);

        $this->assertSame('deleted', $response->getStatus());
        $this->assertSame(null, $response->getMessage());
        $this->assertSame([], $response->getMeta());
    }

    public function testCreateFromJson404(): void
    {

        //@todo meta neni
        $json = '{
            "message": "Not Found",
            "status": "error",
            "meta": []
        }';

        $array = json_decode($json, true);

        $response = ForgetContactResponse::fromArray($array);

        $this->assertSame('error', $response->getStatus());
        $this->assertSame('Not Found', $response->getMessage());
        $this->assertSame([], $response->getMeta());
    }

}
