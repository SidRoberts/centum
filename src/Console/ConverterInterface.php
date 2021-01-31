<?php

namespace Centum\Console;

use Centum\Container\Container;

interface ConverterInterface
{
    public function convert(string $value, Container $container) : mixed;
}
