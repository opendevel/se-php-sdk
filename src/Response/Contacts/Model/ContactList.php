<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\Enum\ContactListStatus;
use SmartEmailing\Types\DateTimesImmutable;
use SmartEmailing\Types\PrimitiveTypes;

/**
 * Contact list
 */
final class ContactList
{

    /**
     * Contact's presence in list ID
     *
     * @var int
     */
    private $id;

    /**
     * Contactlist ID
     *
     * @var int
     */
    private $contactListId;

    /**
     * Contact's status in list
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Enum\ContactListStatus|null
     */
    private $status = null;

    /**
     * Date and time when contact has been added to list
     *
     * @var \DateTimeImmutable|null
     */
    private $added = null;

    /**
     * Date and time of Contact's last status change in list
     *
     * @var \DateTimeImmutable|null
     */
    private $updated = null;

    //@todo score_clicks
    //@todo score_opens
    //@todo contact_id

    public function __construct(int $id, int $contactListId)
    {
        $this->id = $id;
        $this->contactListId = $contactListId;
    }

    public static function fromArray(array $array): self
    {
        $self = new self(
            PrimitiveTypes::extractInt($array, 'id'),
            PrimitiveTypes::extractInt($array, 'contactlist_id')
        );
        $self->status = ContactListStatus::extractOrNull($array, 'status', true);
        $self->added = DateTimesImmutable::extractOrNull($array, 'added', true);
        $self->updated = DateTimesImmutable::extractOrNull($array, 'updated', true);

        return $self;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContactListId(): int
    {
        return $this->contactListId;
    }

    public function getStatus(): ?ContactListStatus
    {
        return $this->status;
    }

    public function getAdded(): ?DateTimeImmutable
    {
        return $this->added;
    }

    public function getUpdated(): ?DateTimeImmutable
    {
        return $this->updated;
    }

}
