<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Contacts;

use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;

final class ContactRequest implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'GET';

    /**
     * @var string
     */
    protected static $endpoint = 'contacts';

    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function getHttpMethod(): string
    {
        return self::$method;
    }

    public function getEndpoint(): string
    {
        return self::$endpoint . '/' . $this->id;
    }

    public function toArray(): array
    {
        return [
        ];
    }

}
