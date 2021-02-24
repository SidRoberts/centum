<?php

namespace Centum\Queue;

use Centum\Container\Container;

abstract class Task
{
    abstract public function execute(Container $container) : bool;
}
