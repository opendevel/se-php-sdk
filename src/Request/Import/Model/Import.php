<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\ToArrayInterface;
use SmartEmailing\Types\PrimitiveTypes;

final class Import implements ToArrayInterface
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

    public static function fromArray(array $data, ?Settings $settings = null): self
    {
        $import = new self();

        if ($settings !== null) {
            $import->setSettings($settings);
        }

        foreach ($data as $contact) {
            $import->addContact(Contact::fromArray(PrimitiveTypes::getArray($contact)));
        }

        return $import;
    }

    public function toArray(): array
    {
        return [
            'settings' => $this->settings->toArray(),
            'data' => $this->data,
        ];
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
