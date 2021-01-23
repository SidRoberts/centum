<?php

namespace Centum\Tests\Mvc\Converter;

use Centum\Mvc\ConverterInterface;

class Doubler implements ConverterInterface
{
    public function convert(string $value) : int
    {
        return ($value * 2);
    }
}
