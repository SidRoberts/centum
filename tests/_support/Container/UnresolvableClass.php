<?php

namespace Tests\Container;

class UnresolvableClass
{
    protected string $name;



    public function __construct(string $name)
    {
        $this->name = $name;
    }



    public function getName() : string
    {
        return $this->name;
    }
}
