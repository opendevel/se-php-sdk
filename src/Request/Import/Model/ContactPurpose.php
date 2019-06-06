<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
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

    public function __construct(int $id, ?DateTimeImmutable $validFrom = null, ?DateTimeImmutable $validTo = null)
    {
        $this->id = $id;
        $this->validFrom = $validFrom;
        $this->validTo = $validTo;
    }

    /**
     * @param mixed[] $array
     * @return \SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\ContactPurpose
     */
    public static function fromArray(array $array): self
    {
        return new self(
            PrimitiveTypes::extractInt($array, 'id'),
            DateTimesImmutable::extractOrNull($array, 'valid_from'),
            DateTimesImmutable::extractOrNull($array, 'valid_to')
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'valid_from' => DateTimeFormatter::formatOrNull($this->validFrom),
            'valid_to' => DateTimeFormatter::formatOrNull($this->validTo),
        ];
    }

    public function setValidFrom(?DateTimeImmutable $validFrom): void
    {
        $this->validFrom = $validFrom;
    }

    public function setValidTo(?DateTimeImmutable $validTo): void
    {
        $this->validTo = $validTo;
    }

}
