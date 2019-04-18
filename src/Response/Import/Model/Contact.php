<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Response\Import\Model;

final class Contact
{

    /**
     * ID of imported contact
     * @var int
     */
    private $id;

    /**
     * Email address of imported contact, lowercased and trimmed
     * @var string
     */
    private $emailAddress;

    public function __construct(int $contactId, string $emailAddress)
    {
        //@todo check types
        $this->id = $contactId;
        $this->emailAddress = $emailAddress;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

}
