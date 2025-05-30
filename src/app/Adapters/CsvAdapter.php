<?php

namespace App\Adapters;

use App\Contracts\ImportDtoInterface;
use App\Contracts\ParserInterface;
use App\Dto\CsvImportDto;
use App\Dto\ProductDataImportDto;
use SplFileObject;

class CsvAdapter implements ParserInterface
{
    public function parse(SplFileObject $file): ImportDtoInterface
    {
        $file->setFlags(
            SplFileObject::READ_CSV
            | SplFileObject::SKIP_EMPTY
            | SplFileObject::READ_AHEAD
        );

        $header = [];
        $items  = [];

        foreach ($file as $rowNum => $row) {
            if ($rowNum === 0) {
                $header = $row;
                continue;
            }

            if (!is_array($row) || count($row) !== count($header)) {
                continue;
            }

            $data = array_combine($header, $row);

            $items[] = new ProductDataImportDto(
                code:            $data['Код'],
                name:            $data['Наименование'],
                categoryLevel1:  $data['Уровень1'],
                categoryLevel2:  $data['Уровень2'] ?: null,
                categoryLevel3:  $data['Уровень3'] ?: null,
                price:           (float) $data['Цена'],
                priceSp:         (float) $data['ЦенаСП'],
                quantity:        (int)   $data['Количество'],
                propertyFields:  $data['Поля свойств'],
                jointPurchases:  $data['Совместные покупки'],
                unit:             $data['Единица измерения'],
                imagePath:       $data['Картинка'] ?: null,
                showOnMain:      !empty($data['Выводить на главной']),
                description:     $data['Описание'] ?? null,
            );
        }

        return new CsvImportDto($items);
    }
}
