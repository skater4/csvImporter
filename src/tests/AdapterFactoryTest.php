<?php

namespace Skater4\CsvImporter\tests;

use PHPUnit\Framework\TestCase;
use App\Adapters\CsvAdapter;
use App\Contracts\ParserInterface;
use App\Enum\ImportResourceEnum;
use App\Factories\AdapterFactory;

class AdapterFactoryTest extends TestCase
{
    public function testMakeCsvAdapter(): void
    {
        $parser = AdapterFactory::make(ImportResourceEnum::CSV);

        $this->assertInstanceOf(ParserInterface::class, $parser);
        $this->assertInstanceOf(CsvAdapter::class,    $parser);
    }
}