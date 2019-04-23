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
     * @var \SmartEmailing\Sdk\Status\ContactListStatus
     */
    private $status;

    public function __construct(int $id, ?ContactListStatus $status = null)
    {
        if ($status === null) {
            $status = ContactListStatus::from(ContactListStatus::CONFIRMED);
        }

        $this->id = $id;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->getValue(),
        ];
    }

}
