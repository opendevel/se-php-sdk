<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Test;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Types\PrimitiveTypes;

final class PingResponse extends BaseResponse
{

    /**
     * @param array $array
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Test\PingResponse
     */
    public static function fromArray(array $array): self
    {
        $response = new self();

        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);

        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);

        $response->meta = PrimitiveTypes::extractArray($array, 'meta');

        return $response;
    }

}
