<?php

namespace Centum\App;

use Centum\Interfaces\Container\ContainerInterface;

abstract class Bootstrap
{
    abstract public function boot(ContainerInterface $container): void;
}
