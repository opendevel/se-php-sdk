<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class AttachmentTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [
            'file_name' => 'Invoice.pdf',
            'content_type' => 'application/pdf',
            'data_base64' => 'XNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlzIHNpbmd1bGFy=',
        ];

        // ACT
        $attachment = new Attachment(
            'Invoice.pdf',
            'application/pdf',
            'XNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlzIHNpbmd1bGFy='
        );

        // ASSERT
        $this->assertSame($output, $attachment->toArray());
    }

}
