<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Sdk\Status\ContactListStatus;
use SmartEmailing\Types\PrimitiveTypes;

final class ContactContactlist implements ToArrayInterface
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var \SmartEmailing\Sdk\Status\ContactListStatus
     */
    private $status;

    public function __construct(int $id, ContactListStatus $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public static function fromArray(array $array): self
    {
        $array = array_change_key_case($array, CASE_LOWER);

        return new self(
            PrimitiveTypes::extractInt($array, 'id'),
            ContactListStatus::extract($array, 'status')
        );
    }

    public function toArray(): array
    {
        $array = [
            'id' => $this->id,
            'status' => $this->status->getValue(),
        ];

        return array_filter($array, function ($var) {
            return !is_null($var);
        });
    }

}
