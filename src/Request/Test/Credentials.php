<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Test;

use SmartEmailing\Sdk\Request\AbstractBaseRequest;

final class Credentials extends AbstractBaseRequest
{

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $uri = 'check-credentials';

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [];
    }

}
