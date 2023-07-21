<?php

namespace Tests\Support\Container;

class UnresolvableClass
{
    public function __construct(
        protected readonly string $name
    ) {
    }



    public function getName(): string
    {
        return $this->name;
    }
}
