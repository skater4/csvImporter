<?php

namespace Skater4\CsvImporter\tests;

use App\Dto\ProductDataImportDto;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

final class ProductModelTest extends TestCase
{
    public function testFromDtoMapsAllFields(): void
    {
        $dto = new ProductDataImportDto(
            code:            'X1',
            name:            'Name',
            categoryLevel1:  'L1',
            categoryLevel2:  'L2',
            categoryLevel3:  'L3',
            price:           9.99,
            priceSp:         4.44,
            quantity:        42,
            propertyFields:  'p1',
            jointPurchases:  'jp',
            unit:            'pcs',
            imagePath:       'img.jpg',
            showOnMain:      true,
            description:     'desc',
        );

        $product = Product::fromDto($dto);

        $this->assertSame('X1',     $product->code);
        $this->assertSame('Name',   $product->name);
        $this->assertSame('L1',     $product->categoryLevel1);
        $this->assertSame('L2',     $product->categoryLevel2);
        $this->assertSame('L3',     $product->categoryLevel3);
        $this->assertSame(9.99,     $product->price);
        $this->assertSame(4.44,     $product->priceSp);
        $this->assertSame(42,       $product->quantity);
        $this->assertSame('p1',     $product->propertyFields);
        $this->assertSame('jp',     $product->jointPurchases);
        $this->assertSame('pcs',    $product->unit);
        $this->assertSame('img.jpg',$product->imagePath);
        $this->assertTrue(          $product->showOnMain);
        $this->assertSame('desc',   $product->description);
    }
}