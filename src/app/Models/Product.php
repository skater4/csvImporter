<?php
declare(strict_types=1);

namespace App\Models;

class Product extends BaseModel
{
    public ?int    $id               = null;
    public string  $code;
    public string  $name;
    public string  $categoryLevel1;
    public ?string $categoryLevel2   = null;
    public ?string $categoryLevel3   = null;
    public float   $price            = 0.0;
    public float   $priceSp          = 0.0;
    public int     $quantity         = 0;
    public string  $propertyFields   = '';
    public string  $jointPurchases   = '';
    public string  $unit;
    public ?string $imagePath        = null;
    public bool    $showOnMain       = false;
    public ?string $description      = null;
}
