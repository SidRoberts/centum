<?php

namespace Tests\Events;

use Centum\Container\Container;
use Centum\Events\EventInterface;
use Exception;

class ProblematicEvent implements EventInterface
{
    public function handle(Container $container) : void
    {
        throw new Exception("I'm just being difficult.");
    }
}
