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

    /**
     * @param int $id
     * @param mixed $value
     */
    public function __construct(int $id, $value)
    {
        $this->id = $id;

        $options = UniqueIntArray::fromOrNull($value, true);
        if ($options !== null) {
            $this->options = UniqueIntArray::from($options);
        } else {
            $this->value = $value;
        }
    }

    public static function fromArray(array $array): self
    {
        $array = array_change_key_case($array, CASE_LOWER);

        $id = PrimitiveTypes::extractInt($array, 'id');

        if (PrimitiveTypes::extractArrayOrNull($array, 'options') !== null) {
            $value = PrimitiveTypes::extractArray($array, 'options');
        } else {
            $value = PrimitiveTypes::extractString($array, 'value');
        }

        $customField = new self($id, $value);
        return $customField;

    }

    public function toArray(): array
    {
        if ($this->options !== null) {
            return [
                'id' => $this->id,
                'options' => $this->options !== null ? $this->options->getValues() : null,
            ];
        } else {
            return [
                'id' => $this->id,
                'value' => $this->value,
            ];
        }

    }

}
