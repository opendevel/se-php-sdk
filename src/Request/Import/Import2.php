<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import;

use SmartEmailing\Sdk\Request\Import\Model\Contact;
use SmartEmailing\Sdk\Request\Import\Model\Settings;

final class Import2
{

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string
     */
    protected $uri = 'import';

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
        if (is_null($settings)) {
            $this->settings = new Settings();
        }
    }

    public static function fromArray(array $array): self
    {
        $import = new self();

        foreach ($array as $subarray) {
            //@todo lze pouzit smartemailing/types?
            if (is_array($subarray)) {
                $contact = Contact::fromArray($subarray);
                $import->addContact($contact);
            } else {
                //@todo?
            }
        }

        return $import;
    }

    protected function toArray(): array
    {
        return [
            'settings' => array_filter($this->settings->toArray()),
            'data' => array_filter($this->data),
        ];
    }

    public function getBody(): array
    {
        return $this->toArray();
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
        $this->data[] = array_filter($contact->toArray());
    }

}
