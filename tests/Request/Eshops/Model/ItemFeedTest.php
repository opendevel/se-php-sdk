<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class ItemFeedTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [
            'item_id' => 'ZYX987',
            'feed_name' => 'my-feed',
            'quantity' => 3,
        ];

        $itemFeed = new ItemFeed('ZYX987', 'my-feed', 3);

        // ASSERT
        $this->assertSame($output, $itemFeed->toArray());
    }

    public function testCreateWithQuantityZero(): void
    {
        // ARRANGE
        $output = [
            'item_id' => 'ZYX987',
            'feed_name' => 'my-feed',
            'quantity' => 0,
        ];

        $itemFeed = new ItemFeed('ZYX987', 'my-feed', 0);

        // ASSERT
        $this->assertSame($output, $itemFeed->toArray());
    }

    public function testCreateWithQuantityNegative(): void
    {
        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        new ItemFeed('ZYX987', 'my-feed', -3);
    }

}
