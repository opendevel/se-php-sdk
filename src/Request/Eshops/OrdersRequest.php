<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;
use SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model\Item;
use SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model\ItemFeed;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\Price;

final class OrdersRequest implements ApiRequestInterface
{
    
    /**
     * @var string
     */
    protected static $method = 'POST';
    
    /**
     * @var string
     */
    protected static $endpoint = 'orders';
    
    /**
     * E-shop name
     *
     * @var string
     */
    private $eshopName;
    
    /**
     * Contact's email address
     *
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $emailAddress;
    
    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;
    
    /**
     * Array of items in shopping cart
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model\Item[]
     */
    private $items = [];
    
    /**
     * Array of items in shopping cart with feed reference
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model\ItemFeed[]
     */
    private $itemFeeds = [];
    
    public function __construct(
        string $eshopName,
        string $emailAddress,
        DateTimeImmutable $createdAt
    ) {
        $this->eshopName = $eshopName;
        $this->emailAddress = Emailaddress::from($emailAddress);
        $this->createdAt = $createdAt;
    }
    
    public static function getHttpMethod(): string
    {
        return self::$method;
    }
    
    public function getEndpoint(): string
    {
        return self::$endpoint;
    }
    
    public function toArray(): array
    {
        return [
            'eshop_name' => $this->eshopName,
            'emailaddress' => $this->emailAddress->getValue(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'items' => $this->toArrayItems(),
            'item_feeds' => $this->toArrayItemFeeds(),
        ];
    }
    
    public function addItem(
        string $id,
        string $name,
        ?string $description,
        Price $price,
        int $quantity,
        string $url,
        ?string $imageUrl = null
    ): void {
        $this->items[] = new Item(
            $id,
            $name,
            $description,
            $price,
            $quantity,
            $url,
            $imageUrl
        );
    }
    
    public function addItemFeed(string $itemId, string $feedName, int $quantity): void
    {
        $this->itemFeeds[] = new ItemFeed($itemId, $feedName, $quantity);
    }
    
    private function toArrayItems(): array
    {
        $return = [];
        
        /** @var \SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model\Item $item */
        foreach ($this->items as $item) {
            $return[] = $item->toArray();
        }
        
        return $return;
    }
    
    private function toArrayItemFeeds(): array
    {
        $return = [];
        
        /** @var \SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model\ItemFeed $itemFeed */
        foreach ($this->itemFeeds as $itemFeed) {
            $return[] = $itemFeed->toArray();
        }
        
        return $return;
    }
    
}
