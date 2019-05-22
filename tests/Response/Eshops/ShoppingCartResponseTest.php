<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class ShoppingCartResponseTest extends TestCase
{
    
    public function testCreateFromJson(): void
    {
        
        $json = '{
            "status": "ok",
            "meta": []
        }';
        
        $array = json_decode($json, true);
        
        $shoppingCartResponse = ShoppingCartResponse::fromArray($array);
        
        $this->assertSame('ok', $shoppingCartResponse->getStatus());
        $this->assertSame(null, $shoppingCartResponse->getMessage());
        $this->assertSame([], $shoppingCartResponse->getMeta());
    }
    
}
