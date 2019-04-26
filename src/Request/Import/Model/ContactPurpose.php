<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Types\DateTimeFormatter;
use SmartEmailing\Types\DateTimesImmutable;
use SmartEmailing\Types\PrimitiveTypes;

final class ContactPurpose implements ToArrayInterface
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTimeImmutable|null
     */
    private $validFrom = null;

    /**
     * @var \DateTimeImmutable|null
     */
    private $validTo = null;

    public function __construct(int $id, ?DateTimeImmutable $valid_from = null, ?DateTimeImmutable $valid_to = null)
    {
        $this->id = $id;
        $this->validFrom = $valid_from;
        $this->validTo = $valid_to;
    }

    public static function fromArray(array $array): self
    {
        $array = array_change_key_case($array, CASE_LOWER);
        //@todo replace char '_' from array keys? (i jinde)

        return new self(
            PrimitiveTypes::extractInt($array, 'id'),
            DateTimesImmutable::extractOrNull($array, 'valid_from', true),
            DateTimesImmutable::extractOrNull($array, 'valid_to', true)
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'valid_from' => DateTimeFormatter::formatOrNull($this->validFrom),
            'valid_to' => DateTimeFormatter::formatOrNull($this->validTo),
        ];
    }

    public function setValidFrom(?DateTimeImmutable $validFrom): ContactPurpose
    {
        $this->validFrom = $validFrom;
        return $this;
    }

    public function setValidTo(?DateTimeImmutable $validTo): ContactPurpose
    {
        $this->validTo = $validTo;
        return $this;
    }

}
