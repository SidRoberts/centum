<?php

namespace Centum\Tests\Mvc\Converter;

use Centum\Container\Container;
use Centum\Mvc\ConverterInterface;

class Doubler implements ConverterInterface
{
    public function convert(string $value, Container $container) : int
    {
        return ($value * 2);
    }
}
