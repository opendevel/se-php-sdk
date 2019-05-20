<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops;

use SmartEmailing\Sdk\ApiV3Client\TestCase;

final class OrdersResponseTest extends TestCase
{
    
    public function testCreateFromJson(): void
    {
        
        $json = '{
            "status": "ok",
            "meta": [],
            "data": {
                "id": "11e91b137503deb2a4e66c4008be149e",
                "created_at": "2019-01-01 00:00:00",
                "contact_id": 35839,
                "status": "placed",
                "eshop_name": "my-eshop",
                "items": [
                    {
                        "id": "ABC123",
                        "name": "My product",
                        "description": "My product description",
                        "price": {
                            "without_vat": 123.97,
                            "with_vat": 150,
                            "currency": "CZK"
                        },
                        "quantity": 1,
                        "url": "https://www.example.com/my-product",
                        "image_url": "https://www.example.com/images/my-product.jpg"
                    },
                    {
                        "id": "XYZ789",
                        "name": "My another product",
                        "description": "My another product description",
                        "price": {
                            "without_vat": 165.7,
                            "with_vat": 200.5,
                            "currency": "CZK"
                        },
                        "quantity": 2,
                        "url": "https://www.example.com/my-another-product",
                        "image_url": "https://www.example.com/images/my-another-product.jpg"
                    },
                    {
                        "id": "ZYX987",
                        "name": "Product loaded from feed",
                        "description": "Description",
                        "price": {
                            "without_vat": 100.0,
                            "with_vat": 121.0,
                            "currency": "CZK"
                        },
                        "quantity": 3,
                        "url": "https://www.example.com/my-feed-product",
                        "image_url": "https://www.example.com/images/my-feed-product.jpg"
                    }
                ]
            }
        }';
        
        $array = json_decode($json, true);
        
        $orderResponse = OrdersResponse::fromArray($array);
        
        $this->assertSame('ok', $orderResponse->getStatus());
        $this->assertSame([], $orderResponse->getMeta());
    }
    
}
