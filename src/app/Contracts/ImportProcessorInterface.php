<?php

namespace App\Contracts;

interface ImportProcessorInterface
{
    public function import(string $filePath): bool;
}