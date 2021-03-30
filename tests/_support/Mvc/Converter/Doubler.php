<?php

namespace Tests\Mvc\Converter;

use Centum\Container\Container;
use Centum\Mvc\ConverterInterface;

class Doubler implements ConverterInterface
{
    public function convert(string $value, Container $container): int
    {
        $value = (int) $value;

        return ($value * 2);
    }
}
