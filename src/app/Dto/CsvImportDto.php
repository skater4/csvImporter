<?php

namespace App\Dto;

use App\Contracts\ImportDtoInterface;
use Countable;
use IteratorAggregate;
use ArrayIterator;

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
