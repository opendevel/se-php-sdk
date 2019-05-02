<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Enum;

use SmartEmailing\Types\Enum;
use SmartEmailing\Types\ExtractableTraits\EnumExtractableTrait;

final class ContactListStatus extends Enum
{

    use EnumExtractableTrait;

    public const CONFIRMED = 'confirmed';
    public const UNSUBSCRIBED = 'unsubscribed';
    public const REMOVED = 'removed';

}
