<?php

namespace Centum\Interfaces\Queue;

use Centum\Interfaces\Container\ContainerInterface;

interface TaskInterface
{
    public function execute(ContainerInterface $container): void;
}
