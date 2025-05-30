<?php

namespace App\Contracts;

use ArrayIterator;

interface ImportDtoInterface
{
    public function getItems(): array;
}