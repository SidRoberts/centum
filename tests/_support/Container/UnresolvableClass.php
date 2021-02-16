<?php

namespace Centum\Tests\Container;

class UnresolvableClass
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
