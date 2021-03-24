<?php

namespace Centum\Events;

use Centum\Container\Container;

interface EventInterface
{
    public function handle(Container $container) : void;
}
