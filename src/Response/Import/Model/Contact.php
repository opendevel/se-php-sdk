<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Response\Import\Model;

use SmartEmailing\Types\Emailaddress;

final class Contact
{

    /**
     * ID of imported contact
     * @var int
     */
    private $id;

    /**
     * Email address of imported contact, lowercased and trimmed
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $emailAddress;

    public function __construct(int $contactId, Emailaddress $emailAddress)
    {
        $this->id = $contactId;
        $this->emailAddress = $emailAddress;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmailAddress(): Emailaddress
    {
        return $this->emailAddress;
    }

}
