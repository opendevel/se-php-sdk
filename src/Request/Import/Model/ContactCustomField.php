<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Types\DateTimeFormatter;
use SmartEmailing\Types\PrimitiveTypes;

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
     * String value for simple customfield
     * or
     * YYYY-MM-DD HH:MM:SS for date customfield
     * (value size is limited to 64KB)
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
        //@todo $value or $options is required

        $this->id = $id;
        $this->value = $value;  //@todo value can be null
        $this->options = $options; //@todo options can be null
    }

    public static function fromArray(array $array): self
    {
        $array = array_change_key_case($array, CASE_LOWER);

        return new self(PrimitiveTypes::extractInt($array, 'id'));
    }

    public function toArray(): array
    {
        $array = [
            'id' => $this->id,
            'value' => DateTimeFormatter::formatOrNull($this->value),
            'options' => is_array($this->options) && count($this->options) ? $this->options : null,
        ];

        return array_filter($array, function ($var) {
            return !is_null($var);
        });
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
