<?php

namespace Tests\Container;

class ResolvableClass
{
    public function __construct(Incrementer $incrementer)
    {
        $this->incrementer = $incrementer;
    }
}
