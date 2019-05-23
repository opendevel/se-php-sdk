<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
use SmartEmailing\Types\UnsignedInt;

final class FeedItem implements ToArrayInterface
{

    /**
     * Item ID
     *
     * @var string
     */
    private $itemId;

    /**
     * Name of feed
     *
     * @var string
     */
    private $feedName;

    /**
     * Item quantity
     *
     * @var \SmartEmailing\Types\UnsignedInt
     */
    private $quantity;

    public function __construct(string $itemId, string $feedName, int $quantity)
    {
        $this->itemId = $itemId;
        $this->feedName = $feedName;
        $this->quantity = UnsignedInt::from($quantity);
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->itemId,
            'feed_name' => $this->feedName,
            'quantity' => $this->quantity->getValue(),
        ];
    }

}
