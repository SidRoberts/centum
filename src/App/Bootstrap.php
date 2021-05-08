<?php

namespace Centum\App;

use Centum\Container\Container;

abstract class Bootstrap
{
    abstract public function boot(Container $container): void;
}
