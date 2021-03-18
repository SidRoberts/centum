<?php

namespace Tests\Container;

class UnresolvableClass
{
    protected string $name;



    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
