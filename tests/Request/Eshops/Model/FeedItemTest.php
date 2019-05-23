<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class FeedItemTest extends TestCase
{

    public function testCreate(): void
    {
        // ARRANGE
        $output = [
            'item_id' => 'ZYX987',
            'feed_name' => 'my-feed',
            'quantity' => 3,
        ];

        $feedItem = new FeedItem('ZYX987', 'my-feed', 3);

        // ASSERT
        $this->assertSame($output, $feedItem->toArray());
    }

    public function testCreateWithQuantityZero(): void
    {
        // ARRANGE
        $output = [
            'item_id' => 'ZYX987',
            'feed_name' => 'my-feed',
            'quantity' => 0,
        ];

        $feedItem = new FeedItem('ZYX987', 'my-feed', 0);

        // ASSERT
        $this->assertSame($output, $feedItem->toArray());
    }

    public function testCreateWithQuantityNegative(): void
    {
        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        new FeedItem('ZYX987', 'my-feed', -3);
    }

}
