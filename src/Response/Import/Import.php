<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Response\Import;

use SmartEmailing\Sdk\Collect\Support\Collection;
use SmartEmailing\Sdk\Response\Import\Model\Contact;

final class Import
{

    /**
     * All imported contacts' email addresses mapped to their Ids.
     * This is only available when not using double opt-in. If double opt-in is used, contacts_map will be empty array.
     *
     * @var \SmartEmailing\Sdk\Collect\Support\Collection
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new Collection();
    }

    public function addContact(Contact $contact): void
    {
        $this->contacts->add($contact);
    }

    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function newContact(array $contactArray): void
    {
        if (!isset($contactArray['contact_id']) || is_null($contactArray['contact_id'])) {
            //@todo exception
        }

        if (!isset($contactArray['emailaddress']) || is_null($contactArray['emailaddress'])) {
            //@todo exception
        }

        $contactArray = new Contact($contactArray['contact_id'], $contactArray['emailaddress']);
        $this->addContact($contactArray);
    }

}
