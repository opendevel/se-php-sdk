<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\AbstractModel;
use SmartEmailing\Sdk\Status\ContactListStatus;

final class ContactsContactlist extends AbstractModel
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
