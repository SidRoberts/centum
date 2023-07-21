<?php

namespace Tests\Support\Container;

class ResolvableClass
{
    public function __construct(
        protected readonly Incrementer $incrementer
    ) {
    }



    public function getIncrementer(): Incrementer
    {
        return $this->incrementer;
    }
}
