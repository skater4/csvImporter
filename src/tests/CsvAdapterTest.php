<?php

namespace Skater4\CsvImporter\tests;

use App\Dto\ProductDataImportDto;
use App\Enum\ImportResourceEnum;
use App\Factories\AdapterFactory;
use PHPUnit\Framework\TestCase;
use SplFileObject;

final class CsvAdapterTest extends TestCase
{
    public function testParseProducesCorrectDto(): void
    {
        $csv  = <<<CSV
Код,Наименование,Уровень1,Уровень2,Уровень3,Цена,ЦенаСП,Количество,Поля свойств,Совместные покупки,Единица измерения,Картинка,Выводить на главной,Описание
SKU123,Тестовый товар,A,B,C,12.34,5.67,100,foo:bar,joint,шт,http://img,1,Описание тест
CSV;
        $path = tempnam(sys_get_temp_dir(), 'csv');
        file_put_contents($path, $csv);

        $parser    = AdapterFactory::make(ImportResourceEnum::CSV);
        $importDto = $parser->parse(new SplFileObject($path));

        $items = $importDto->getItems();
        $this->assertCount(1, $items);

        $dto = $items[0];
        $this->assertInstanceOf(ProductDataImportDto::class, $dto);
        $this->assertSame('SKU123',   $dto->code);
        $this->assertSame('Тестовый товар', $dto->name);
        $this->assertSame('A',        $dto->categoryLevel1);
        $this->assertSame('B',        $dto->categoryLevel2);
        $this->assertSame('C',        $dto->categoryLevel3);
        $this->assertSame(12.34,      $dto->price);
        $this->assertSame(5.67,       $dto->priceSp);
        $this->assertSame(100,        $dto->quantity);
        $this->assertSame('foo:bar',  $dto->propertyFields);
        $this->assertSame('joint',    $dto->jointPurchases);
        $this->assertSame('шт',       $dto->unit);
        $this->assertSame('http://img',$dto->imagePath);
        $this->assertTrue(            $dto->showOnMain);
        $this->assertSame('Описание тест', $dto->description);
    }
}