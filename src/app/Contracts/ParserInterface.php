<?php

namespace App\Contracts;

use SplFileObject;

interface ParserInterface
{
    public function parse(SplFileObject $file): ImportDtoInterface;
}