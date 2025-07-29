<?php

namespace Tests\Support\Container;

final class UnresolvableClass
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
