<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Sdk\Status\ContactListStatus;

final class ContactsContactlist implements ToArrayInterface
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    public function __construct(int $id, string $status = ContactListStatus::CONFIRMED)
    {
        ContactListStatus::checkValue($status);

        $this->id = $id;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
        ];
    }

}
