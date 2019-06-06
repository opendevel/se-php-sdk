<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model;

use DateTimeImmutable;
use SmartEmailing\Types\Arrays;
use SmartEmailing\Types\DateTimesImmutable;
use SmartEmailing\Types\PrimitiveTypes;

class Data
{

    /**
     * @var string|null
     */
    private $id = null;

    /**
     * @var \DateTimeImmutable|null
     */
    private $created_at = null;

    /**
     * @var int|null
     */
    private $contact_id = null;

    /**
     * @var string|null
     */
    private $status = null;

    /**
     * @var string|null
     */
    private $eshop_name = null;

    /**
     * @var \SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model\Item[]
     */
    private $items = [];

    /**
     * @param mixed[] $array
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model\Data
     */
    public static function fromArray(array $array): self
    {
        $data = new self();

        $data->id = PrimitiveTypes::extractStringOrNull($array, 'id');
        $data->created_at = DateTimesImmutable::extractOrNull($array, 'created_at');
        $data->contact_id = PrimitiveTypes::extractIntOrNull($array, 'contact_id');
        $data->status = PrimitiveTypes::extractStringOrNull($array, 'status');
        $data->eshop_name = PrimitiveTypes::extractStringOrNull($array, 'eshop_name');

        $items = Arrays::extractArrayOrNull($array, 'items');
        if (is_array($items)) {
            foreach ($items as $item) {
                $data->items[] = Item::fromArray(Arrays::getArray($item));
            }
        }

        return $data;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getContactId(): ?int
    {
        return $this->contact_id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getEshopName(): ?string
    {
        return $this->eshop_name;
    }

    /**
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model\Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}
