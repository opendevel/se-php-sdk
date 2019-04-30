<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Enum;

use SmartEmailing\Types\Enum;
use SmartEmailing\Types\ExtractableTraits\EnumExtractableTrait;

final class ResponseStatus extends Enum
{

    use EnumExtractableTrait;

    public const SUCCESS = 'ok';
    public const CREATED = 'created';
    public const ERROR = 'error';

}
