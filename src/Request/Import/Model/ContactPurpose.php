<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Request\ToArrayInterface;

final class ContactPurpose implements ToArrayInterface
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var \DateTimeImmutable|null
     */
    public $valid_from = null;

    /**
     * @var \DateTimeImmutable|null
     */
    public $valid_to = null;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'valid_from' => !empty($this->valid_from) ? $this->valid_from->format('Y-m-d H:i:s') : null,
            'valid_to' => !empty($this->valid_to) ? $this->valid_to->format('Y-m-d H:i:s') : null,
        ];
    }

    public function __construct(int $id, ?DateTimeImmutable $valid_from = null, ?DateTimeImmutable $valid_to = null)
    {
        $this->id = $id;
        $this->valid_from = $valid_from;
        $this->valid_to = $valid_to;
    }

    public function setValidFrom(?DateTimeImmutable $valid_from): ContactPurpose
    {
        $this->valid_from = $valid_from;
        return $this;
    }

    public function setValidTo(?DateTimeImmutable $valid_to): ContactPurpose
    {
        $this->valid_to = $valid_to;
        return $this;
    }

}
