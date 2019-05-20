<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model\Data;
use SmartEmailing\Types\Arrays;
use SmartEmailing\Types\PrimitiveTypes;

final class OrdersResponse extends BaseResponse
{
    
    /**
     * Response data
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model\Data
     */
    private $data;
    
    public static function fromArray(array $array): self
    {
        $response = new self();
        
        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);
        
        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);
        
        $response->meta = Arrays::extractArray($array, 'meta');
        
        $response->data = Data::fromArray(Arrays::extractArray($array, 'data'));
        
        return $response;
    }
    
    public function getData(): Data
    {
        return $this->data;
    }
    
}
