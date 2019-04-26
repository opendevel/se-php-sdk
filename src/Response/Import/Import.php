<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Response\Import;

use SmartEmailing\Sdk\Response\Import\Model\Contact;
use SmartEmailing\Types\Emailaddress;

final class Import
{

    /**
     * All imported contacts' email addresses mapped to their Ids.
     * This is only available when not using double opt-in. If double opt-in is used, contacts_map will be empty array.
     *
     * @var array
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = [];
    }

    public function addContact(Contact $contact): void
    {
        $this->contacts[$contact->getId()] = $contact;
    }

    public function getContacts(): array
    {
        return $this->contacts;
    }

    public function newContact(array $contactArray): void
    {
        //@todo split input to id and email

        if (!isset($contactArray['contact_id']) || $contactArray['contact_id'] === null) {
            //@todo exception
        }

        if (!isset($contactArray['emailaddress']) || $contactArray['emailaddress'] === null) {
            //@todo exception
        }

        $contactArray = new Contact($contactArray['contact_id'], Emailaddress::from($contactArray['emailaddress']));
        $this->addContact($contactArray);
    }

}
