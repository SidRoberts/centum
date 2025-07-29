<?php

namespace Tests\Support\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;

final class DoNothingTask implements TaskInterface
{
    public function execute(ContainerInterface $container): void
    {
    }
}
