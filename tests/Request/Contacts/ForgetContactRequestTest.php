<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Contacts;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class ForgetContactRequestTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [];

        $request = new ForgetContactRequest(1);

        // ASSERT
        $this->assertEquals($output, $request->toArray());
    }

}
