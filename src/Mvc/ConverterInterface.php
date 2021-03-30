<?php

namespace Centum\Mvc;

use Centum\Container\Container;

interface ConverterInterface
{
    public function convert(string $value, Container $container): mixed;
}
