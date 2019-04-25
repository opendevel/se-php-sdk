<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Types\PrimitiveTypes;
use SmartEmailing\Types\UniqueIntArray;

/**
 * Customfields assigned to contact
 * (Customfields unlisted in imported data will be untouched.)
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
     * @var \SmartEmailing\Types\UniqueIntArray|null
     */
    private $options = null;

    public function __construct(int $id, $value = null, ?array $options = null)
    {
        //@todo $value or $options is required

        $this->id = $id;
        $this->value = $value;
        $this->options = !is_null($options) ? UniqueIntArray::from($options) : null;
    }

    public static function fromArray(array $array): self
    {
        $array = array_change_key_case($array, CASE_LOWER);

        $customField = new self(PrimitiveTypes::extractInt($array, 'id'));

        if (!is_null(PrimitiveTypes::extractStringOrNull($array, 'value', true))) {
            $customField->setValue(PrimitiveTypes::extractString($array, 'value'));
        }

        if (!is_null(PrimitiveTypes::extractArrayOrNull($array, 'options'))) {
            $customField->setOptions(PrimitiveTypes::extractArray($array, 'options'));
        }

        return $customField;
    }

    public function toArray(): array
    {
        //@todo return id and (value or options)
        $array = [
            'id' => $this->id,
            'value' => $this->value,
            'options' => !is_null($this->options) ? $this->options->getValues() : null,
        ];

        return array_filter($array, function ($var) {
            return !is_null($var);
        });
    }

    /**
     * @param mixed $value
     * @return \SmartEmailing\Sdk\Request\Import\Model\ContactCustomField
     */
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
        $this->options = UniqueIntArray::from($options);
        return $this;
    }

}
