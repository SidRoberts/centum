<?php

namespace Centum\Boot;

use Centum\Container\Container;

abstract class Bootstrap
{
    abstract public function boot(Container $container) : void;
}
