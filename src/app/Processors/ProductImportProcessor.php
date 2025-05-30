<?php

namespace App\Processors;

use App\Contracts\ImportProcessorInterface;

class ProductImportProcessor implements ImportProcessorInterface
{
    public function import(string $filePath): bool
    {
        return true;
    }
}