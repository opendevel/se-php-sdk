<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Types\DateTimeFormatter;

/**
 * Customfields assigned to contact
 * Customfields unlisted in imported data will be untouched.
 */
final class ContactCustomField implements ToArrayInterface
{

    /**
     * Customfield ID
     * @var int
     */
    private $id;

    /**
     * String value for simple customfields, and YYYY-MM-DD HH:MM:SS for date customfields. Value size is limited to 64KB.
     * Required for simple customfields
     *
     * @var mixed|null
     */
    private $value = null;

    /**
     * Array of Customfields options IDs matching with selected Customfield.
     * Required for composite customfields
     *
     * @var array|null
     */
    private $options = null;

    public function __construct(int $id, $value = null, ?array $options = null)
    {
        //@todo $value or $options has to be required

        $this->id = $id;
        $this->value = $value;
        $this->options = $options;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'value' => DateTimeFormatter::formatOrNull($this->value),
            'options' => is_array($this->options) && count($this->options) ? $this->options : null,
        ];
    }

    public function setValue($value): ContactCustomField
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param array $options
     * @return \SmartEmailing\Sdk\Request\Import\Model\ContactCustomField
     */
    public function setOptions(array $options): ContactCustomField
    {
        $this->options = $options;
        return $this;
    }

}
