<?php

namespace Tests\Support\Container;

class UnresolvableClass
{
    protected readonly string $name;



    public function __construct(string $name)
    {
        $this->name = $name;
    }



    public function getName(): string
    {
        return $this->name;
    }
}
