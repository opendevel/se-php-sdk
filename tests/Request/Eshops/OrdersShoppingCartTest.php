<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\TestCase;
use SmartEmailing\Types\Price;

final class OrdersShoppingCartTest extends TestCase
{
    
    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'eshop_name' => 'my-eshop',
            'emailaddress' => 'john.doe@example.com',
            'updated_at' => '2019-01-01 00:00:00',
            'items' => [
                [
                    'id' => 'ABC123',
                    'name' => 'My product',
                    'description' => 'My product description',
                    'price' => [
                        'without_vat' => 123.97,
                        'with_vat' => 150.00,
                        'currency' => 'CZK',
                    ],
                    'quantity' => 1,
                    'url' => 'https://www.example.com/my-product',
                    'image_url' => 'https://www.example.com/images/my-product.jpg',
                ],
                [
                    'id' => 'XYZ789',
                    'name' => 'My another product',
                    'description' => 'My another product description',
                    'price' => [
                        'without_vat' => 165.70,
                        'with_vat' => 200.50,
                        'currency' => 'CZK',
                    ],
                    'quantity' => 2,
                    'url' => 'https://www.example.com/my-another-product',
                    'image_url' => 'https://www.example.com/images/my-another-product.jpg',
                ],
            ],
            'item_feeds' => [
                [
                    'item_id' => 'ZYX987',
                    'feed_name' => 'my-feed',
                    'quantity' => 3,
                ],
            ],
        ];
        
        $shoppingCartRequest = new ShoppingCartRequest(
            'my-eshop',
            'john.doe@example.com',
            new DateTimeImmutable('2019-01-01 00:00:00')
        );
        
        $shoppingCartRequest->addItem(
            'ABC123',
            'My product',
            'My product description',
            Price::from([
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => 'CZK',
            ]),
            1,
            'https://www.example.com/my-product',
            'https://www.example.com/images/my-product.jpg'
        );
        
        $shoppingCartRequest->addItem(
            'XYZ789',
            'My another product',
            'My another product description',
            Price::from([
                'without_vat' => 165.70,
                'with_vat' => 200.50,
                'currency' => 'CZK',
            ]),
            2,
            'https://www.example.com/my-another-product',
            'https://www.example.com/images/my-another-product.jpg'
        );
        
        $shoppingCartRequest->addItemFeed('ZYX987', 'my-feed', 3);
        
        // ASSERT
        $this->assertEquals($output, $shoppingCartRequest->toArray());
    }
    
}
