<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Eshops\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;
use SmartEmailing\Types\CurrencyCode;
use SmartEmailing\Types\Price;

final class ItemTest extends TestCase
{

    public function testCreateMin(): void
    {
        // ARRANGE
        $output = [
            'id' => 'ABC123',
            'name' => 'My product',
            'price' => [
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => 'CZK',
            ],
            'quantity' => 1,
            'url' => 'https://www.example.com/my-product',
        ];

        $item = new Item(
            'ABC123',
            'My product',
            null,
            Price::from([
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => CurrencyCode::CZK,
            ]),
            1,
            'https://www.example.com/my-product'
        );

        // ASSERT
        $this->assertSame($output, $item->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'id' => 'ABC123',
            'name' => 'My product',
            'price' => [
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => 'CZK',
            ],
            'quantity' => 1,
            'url' => 'https://www.example.com/my-product',
            'description' => 'My product description',
            'image_url' => 'https://www.example.com/images/my-product.jpg',
        ];

        $item = new Item(
            'ABC123',
            'My product',
            'My product description',
            Price::from([
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => CurrencyCode::CZK,
            ]),
            1,
            'https://www.example.com/my-product',
            'https://www.example.com/images/my-product.jpg'
        );

        // ASSERT
        $this->assertSame($output, $item->toArray());
    }

    public function testCreateException(): void
    {
        // ARRANGE
        $output = [
            'id' => 'ABC123',
            'name' => 'My product',
            'description' => null,
            'price' => [
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => 'CZK',
            ],
            'quantity' => 1,
            'url' => 'lorem ipsum',
            'image_url' => null,
        ];


        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        $item = new Item(
            'ABC123',
            'My product',
            null,
            Price::from([
                'without_vat' => 123.97,
                'with_vat' => 150.00,
                'currency' => CurrencyCode::CZK,
            ]),
            1,
            'lorem ipsum'
        );

        // ASSERT
        $this->assertSame($output, $item->toArray());
    }

}
