<?php

namespace App\Factories;

use App\Adapters\CsvAdapter;
use App\Contracts\ParserInterface;
use App\Enum\ImportResourceEnum;
use InvalidArgumentException;

class AdapterFactory
{
    public static function make(ImportResourceEnum $resource): ParserInterface
    {
        return match ($resource) {
            ImportResourceEnum::CSV => new CsvAdapter(),
            default => throw new InvalidArgumentException(
                sprintf('Unsupported import resource: %s', $resource->value)
            ),
        };
    }
}