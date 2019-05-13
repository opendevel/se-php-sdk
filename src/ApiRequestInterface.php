<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client;

interface ApiRequestInterface
{

    /**
     * @return mixed[]
     */
    public function toArray(): array;

    public static function getHttpMethod(): string;

    public function getEndpoint(): string;

    //public function getEndpoint2(): string;

}
