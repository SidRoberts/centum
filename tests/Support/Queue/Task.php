<?php

namespace Tests\Support\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;

final class Task implements TaskInterface
{
    protected bool $wasExecuted = false;



    public function execute(ContainerInterface $container): void
    {
        $this->wasExecuted = true;
    }



    public function getWasExecuted(): bool
    {
        return $this->wasExecuted;
    }
}
