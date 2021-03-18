<?php

namespace Tests\Console\Converter;

use Centum\Container\Container;
use Centum\Console\ConverterInterface;

class Doubler implements ConverterInterface
{
    public function convert(string|bool $value, Container $container) : int
    {
        $value = (int) $value;

        return ($value * 2);
    }
}
