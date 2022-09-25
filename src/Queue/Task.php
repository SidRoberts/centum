<?php

namespace Centum\Queue;

use Centum\Interfaces\Container\ContainerInterface;

abstract class Task
{
    abstract public function execute(ContainerInterface $container): void;
}
