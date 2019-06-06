<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Import;

use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\Contact;
use SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\Settings;
use SmartEmailing\Types\PrimitiveTypes;

final class ImportRequest implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'POST';

    /**
     * @var string
     */
    protected static $endpoint = 'import';

    /**
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\Settings
     */
    protected $settings;

    /**
     * @var mixed[]
     */
    protected $data = [];

    public function __construct(?Settings $settings = null)
    {
        if ($settings === null) {
            $settings = new Settings();
        }

        $this->settings = $settings;
    }

    public static function getHttpMethod(): string
    {
        return self::$method;
    }

    public function getEndpoint(): string
    {
        return self::$endpoint;
    }

    /**
     * @param mixed[] $data
     * @param \SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\Settings|null $settings
     * @return \SmartEmailing\Sdk\ApiV3Client\Request\Import\ImportRequest
     */
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

    /**
     * @return mixed[]
     */
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
