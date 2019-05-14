<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class TemplateVariableTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $templateVariable = new TemplateVariable('key1', 'value1');

        // ACT

        // ASSERT
        $this->assertSame('key1', $templateVariable->getKey());
        $this->assertSame('value1', $templateVariable->getValue());
    }

}
