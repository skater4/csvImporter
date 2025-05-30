<?php

namespace App\Contracts;

use SplFileObject;

interface ServiceInterface
{
    public function importCsv(SplFileObject $file): int;

    public function getAll(): array;
}