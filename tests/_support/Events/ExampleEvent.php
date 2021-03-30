<?php

namespace Tests\Events;

use Centum\Container\Container;
use Centum\Events\EventInterface;

class ExampleEvent implements EventInterface
{
    public function handle(Container $container): void
    {
    }
}
