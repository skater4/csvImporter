<?php
namespace App\Dto;

use App\Contracts\ImportDtoRowInterface;

final class ProductDataImportDto implements ImportDtoRowInterface
{
    public function __construct(
        public string  $code,
        public string  $name,
        public string  $categoryLevel1,
        public ?string $categoryLevel2,
        public ?string $categoryLevel3,
        public float   $price,
        public float   $priceSp,
        public int     $quantity,
        public string  $propertyFields,
        public string  $jointPurchases,
        public string  $unit,
        public ?string $imagePath,
        public bool    $showOnMain,
        public ?string $description,
    ) {}
}
