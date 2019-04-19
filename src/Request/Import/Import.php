<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import;

use SmartEmailing\Sdk\Request\AbstractBaseRequest;
use SmartEmailing\Sdk\Request\Import\Model\Contact;
use SmartEmailing\Sdk\Request\Import\Model\Settings;
use SmartEmailing\Sdk\Response\Import\Import as ResponseImport;
use SmartEmailing\Sdk\Response\JsonStream;

final class Import extends AbstractBaseRequest
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
     * @var \SmartEmailing\Sdk\Request\Import\Model\Settings|null
     */
    protected $settings;

    /**
     * @var array
     */
    protected $data = [];

    protected function toArray(): array
    {
        if (!is_null($this->settings)) {
            $return['settings'] = array_filter($this->settings->toArray());
        }

        $return['data'] = array_filter($this->data);

        return $return;
    }

    public function getSettings(): ?Settings
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

    public function send(): ResponseImport
    {
        $jsonStream = new JsonStream($this->sendRequest()->getBody());
        $array = $jsonStream->jsonSerialize();

        $import = new ResponseImport();

        if (isset($array['contacts_map'])) {
            foreach ($array['contacts_map'] as $contact) {
                $import->newContact($contact);
            }
        }

        return $import;
    }

}
