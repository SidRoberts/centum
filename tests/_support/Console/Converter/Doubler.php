<?php

namespace Centum\Tests\Console\Converter;

use Centum\Container\Container;
use Centum\Console\ConverterInterface;

class Doubler implements ConverterInterface
{
    public function convert(string $value, Container $container) : int
    {
        return ($value * 2);
    }
}