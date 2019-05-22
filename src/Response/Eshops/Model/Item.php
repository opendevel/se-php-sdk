<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model;

use SmartEmailing\Types\Price;
use SmartEmailing\Types\PrimitiveTypes;
use SmartEmailing\Types\UnsignedInt;
use SmartEmailing\Types\UrlType;

final class Item
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var \SmartEmailing\Types\Price
     */
    private $price;

    /**
     * @var \SmartEmailing\Types\UnsignedInt
     */
    private $quantity;

    /**
     * @var \SmartEmailing\Types\UrlType
     */
    private $url;

    /**
     * @var \SmartEmailing\Types\UrlType|null
     */
    private $imageUrl = null;

    public static function fromArray(array $array): self
    {
        $item = new self();

        $item->id = PrimitiveTypes::extractString($array, 'id');
        $item->name = PrimitiveTypes::extractString($array, 'name');
        $item->description = PrimitiveTypes::extractStringOrNull($array, 'description');
        $item->price = Price::extract($array, 'price');
        $item->quantity = UnsignedInt::extract($array, 'quantity');
        $item->url = UrlType::extract($array, 'url');
        $item->imageUrl = UrlType::extractOrNull($array, 'image_url');

        return $item;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity->getValue();
    }

    public function getUrl(): UrlType
    {
        return $this->url;
    }

    public function getImageUrl(): ?UrlType
    {
        return $this->imageUrl;
    }

}
