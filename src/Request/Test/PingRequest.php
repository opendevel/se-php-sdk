<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Test;

use SmartEmailing\Sdk\Request\BaseRequest;

final class PingRequest extends BaseRequest
{

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $uri = 'ping';

}
