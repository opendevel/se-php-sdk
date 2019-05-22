<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Types\Arrays;
use SmartEmailing\Types\PrimitiveTypes;

final class ShoppingCartResponse extends BaseResponse
{
    
    public static function fromArray(array $array): self
    {
        $response = new self();
        
        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);
        
        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);
        
        $response->meta = Arrays::extractArray($array, 'meta');
        
        return $response;
    }
    
}
