<?php

namespace App\Dto;

use App\Contracts\ImportDtoInterface;

class CsvImportDto implements ImportDtoInterface
{
    /** @var ProductDataImportDto[] */
    private array $items;

    /**
     * @param ProductDataImportDto[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ProductDataImportDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
