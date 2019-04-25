<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import;

use SmartEmailing\Sdk\Request\Import\Model\Contact;
use SmartEmailing\Sdk\Request\Import\Model\Settings;
use SmartEmailing\Sdk\Request\ToArrayInterface;

final class Import2 implements ToArrayInterface
{

    /**
     * @var \SmartEmailing\Sdk\Request\Import\Model\Settings
     */
    protected $settings;

    /**
     * @var array
     */
    protected $data = [];

    public function __construct(?Settings $settings = null)
    {
        if ($settings === null) {
            $settings = new Settings();
        }

        $this->settings = $settings;
    }

    public static function fromArrayData(array $contactsArray): self
    {
        $import = new self();

        foreach ($contactsArray as $contactArray) {
            if (is_array($contactArray)) {  //@todo lze pouzit smartemailing/types?
                $contact = Contact::fromArray($contactArray);
                $import->addContact($contact);
            } else {
                //@todo?
            }
        }

        return $import;
    }

    public function toArray(): array
    {
        $array = [
            'settings' => $this->settings->toArray(),
            'data' => $this->data,
        ];

        return array_filter($array, function ($var) {
            return !is_null($var);
        });
    }

    public function getSettings(): Settings
    {
        return $this->settings;
    }

    public function setSettings(Settings $settings): void
    {
        $this->settings = $settings;
    }

    public function addContact(Contact $contact): void
    {
        $this->data[] = $contact->toArray();
    }

}
