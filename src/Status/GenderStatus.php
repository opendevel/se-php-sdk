<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Status;

use SmartEmailing\Types\Enum;
use SmartEmailing\Types\ExtractableTraits\EnumExtractableTrait;

final class GenderStatus extends Enum
{

    use EnumExtractableTrait;

    public const MALE = 'M';
    public const FEMALE = 'F';

}
