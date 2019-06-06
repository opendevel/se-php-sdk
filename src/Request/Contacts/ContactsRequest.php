<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Contacts;

use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;

final class ContactsRequest implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'GET';

    /**
     * @var string
     */
    protected static $endpoint = 'contacts';

    public function __construct()
    {
    }

    public static function getHttpMethod(): string
    {
        return self::$method;
    }

    public function getEndpoint(): string
    {
        return self::$endpoint;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
        ];
    }

}
