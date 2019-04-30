<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Enum;

use SmartEmailing\Types\Enum;
use SmartEmailing\Types\ExtractableTraits\EnumExtractableTrait;

final class Gender extends Enum
{

    use EnumExtractableTrait;

    public const MALE = 'M';
    public const FEMALE = 'F';

}
