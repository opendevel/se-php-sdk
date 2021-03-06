<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Import\Model;

use SmartEmailing\Sdk\ApiV3Client\Enum\ContactListStatus;
use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
use SmartEmailing\Types\PrimitiveTypes;

final class ContactContactlist implements ToArrayInterface
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var \SmartEmailing\Sdk\ApiV3Client\Enum\ContactListStatus
     */
    private $status;

    public function __construct(int $id, ContactListStatus $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public static function fromArray(array $array): self
    {
        return new self(
            PrimitiveTypes::extractInt($array, 'id'),
            ContactListStatus::extract($array, 'status')
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->getValue(),
        ];
    }

}
