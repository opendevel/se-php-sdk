<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request;

class BaseRequest
{

    /**
     * @var string
     */
    protected $method = '';

    /**
     * @var string
     */
    protected $uri = '';

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

}
