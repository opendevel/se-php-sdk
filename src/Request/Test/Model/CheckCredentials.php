<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Test\Model;

use SmartEmailing\Sdk\ToArrayInterface;

final class CheckCredentials implements ToArrayInterface
{

    public function __construct()
    {
    }

    public static function fromArray(): self
    {
        return new self();
    }

    public function toArray(): array
    {
        return [
        ];
    }

}
