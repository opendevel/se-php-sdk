<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Request\AbstractModel;

/**
 * Customfields assigned to contact
 * Customfields unlisted in imported data will be untouched.
 */
final class ContactCustomField extends AbstractModel
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
     * @var \DateTimeImmutable|null
     */
    private $value = null;

    /**
     * Array of Customfields options IDs matching with selected Customfield.
     * Required for composite customfields
     *
     * @var array|null
     */
    private $options = null;

    public function __construct(int $id, ?DateTimeImmutable $value = null, ?array $options = null)
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
            'value' => !is_null($this->value) ? $this->value->format('Y-m-d H:i:s') : null,
            'options' => is_array($this->options) && count($this->options) ? $this->options : null,
        ];
    }

    public function setValue(DateTimeImmutable $value): ContactCustomField
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
