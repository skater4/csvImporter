<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected string $table = 'products';
    protected string $modelClass = Product::class;
}