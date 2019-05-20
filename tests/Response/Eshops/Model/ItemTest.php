<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Eshops\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;
use SmartEmailing\Types\UrlType;

final class ItemTest extends TestCase
{
    
    public function testCreateFromArrayMin(): void
    {
        $array = [
            'id' => 'ABC123',
            'name' => 'My product',
            'price' => [
                'without_vat' => 123.97,
                'with_vat' => 150,
                'currency' => 'CZK',
            ],
            'quantity' => 1,
            'url' => 'https://www.example.com/my-product',
        ];
        
        $item = Item::fromArray($array);
        
        $this->assertInstanceOf(Item::class, $item);
        
        $this->assertSame('ABC123', $item->getId());
        $this->assertSame('My product', $item->getName());
        $this->assertSame(null, $item->getDescription());
        $this->assertSame(123.97, $item->getPrice()->getWithoutVat());
        $this->assertSame(150.00, $item->getPrice()->getWithVat());
        $this->assertSame('CZK', $item->getPrice()->getCurrency()->getValue());
        $this->assertSame(1, $item->getQuantity()->getValue());
        $this->assertSame('https://www.example.com/my-product', $item->getUrl()->getAbsoluteUrl());
        $this->assertSame(null, $item->getImageUrl());
    }
    
    public function testCreateFromArrayFull(): void
    {
        $array = [
            'id' => 'ABC123',
            'name' => 'My product',
            'description' => 'My product description',
            'price' => [
                'without_vat' => 123.97,
                'with_vat' => 150,
                'currency' => 'CZK',
            ],
            'quantity' => 1,
            'url' => 'https://www.example.com/my-product',
            'image_url' => 'https://www.example.com/images/my-product.jpg',
        ];
        
        $item = Item::fromArray($array);
        
        $this->assertInstanceOf(Item::class, $item);
        
        $this->assertSame('ABC123', $item->getId());
        $this->assertSame('My product', $item->getName());
        $this->assertSame('My product description', $item->getDescription());
        $this->assertSame(123.97, $item->getPrice()->getWithoutVat());
        $this->assertSame(150.00, $item->getPrice()->getWithVat());
        $this->assertSame('CZK', $item->getPrice()->getCurrency()->getValue());
        $this->assertSame(1, $item->getQuantity()->getValue());
        $this->assertSame('https://www.example.com/my-product', $item->getUrl()->getAbsoluteUrl());
        $this->assertEquals(UrlType::from('https://www.example.com/images/my-product.jpg'), $item->getImageUrl());
    }
    
}
