<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Test;

use SmartEmailing\Sdk\ApiRequestInterface;

final class Ping implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'GET';

    /**
     * @var string
     */
    protected static $endpoint = 'ping';

    public function __construct()
    {
    }

    public static function getHttpMethod(): string
    {
        return self::$method;
    }

    public static function getEndpoint(): string
    {
        return self::$endpoint;
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
