<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import;

use SmartEmailing\Sdk\Request\AbstractBaseRequest;
use SmartEmailing\Sdk\Request\Import\Model\Contact;
use SmartEmailing\Sdk\Request\Import\Model\Settings;
use SmartEmailing\Sdk\Response\Import\Import as ResponseImport;

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

    public function getData(): ResponseImport
    {
        $contentsArray = $this->decodeStreamToArray();

        $import = new ResponseImport();

        if (isset($contentsArray['contacts_map'])) {
            foreach ($contentsArray['contacts_map'] as $contactArray) {
                $import->newContactMap($contactArray);
            }
        }

        return $import;
    }

}
