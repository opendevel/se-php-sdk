<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
use SmartEmailing\Types\Price;
use SmartEmailing\Types\UnsignedInt;
use SmartEmailing\Types\UrlType;

final class Item implements ToArrayInterface
{

    /**
     * Item ID
     *
     * @var string
     */
    private $id;

    /**
     * Item name
     *
     * @var string
     */
    private $name;

    /**
     * Item description
     *
     * @var string|null
     */
    private $description = null;

    /**
     * price per item
     *
     * @var \SmartEmailing\Types\Price
     */
    private $price;

    /**
     * Item quantity
     *
     * @var \SmartEmailing\Types\UnsignedInt
     */
    private $quantity;

    /**
     * Item URL
     *
     * @var \SmartEmailing\Types\UrlType
     */
    private $url;

    /**
     * Item image URL
     *
     * @var \SmartEmailing\Types\UrlType|null
     */
    private $imageUrl = null;

    public function __construct(
        string $id,
        string $name,
        Price $price,
        int $quantity,
        string $url,
        ?string $description = null,
        ?string $imageUrl = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = UnsignedInt::from($quantity);
        $this->url = UrlType::from($url);
        $this->imageUrl = UrlType::fromOrNull($imageUrl);
    }


    public function toArray(): array
    {
        $return = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price->toArray(),
            'quantity' => $this->quantity->getValue(),
            'url' => $this->url->getAbsoluteUrl(),
        ];

        if (!is_null($this->description)) {
            $return['description'] = $this->description;
        }

        if (!is_null($this->imageUrl)) {
            $return['image_url'] = $this->imageUrl->getAbsoluteUrl();
        }

        return $return;
    }

}
