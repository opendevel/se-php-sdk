<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk;

interface ApiRequestInterface
{

    /**
     * @return mixed[]
     */
    public function toArray(): array;

    public static function getHttpMethod(): string;

    public static function getEndpoint(): string;

}
