<?php

namespace Tests\Support\Container;

class ResolvableClass
{
    protected Incrementer $incrementer;



    public function __construct(Incrementer $incrementer)
    {
        $this->incrementer = $incrementer;
    }



    public function getIncrementer(): Incrementer
    {
        return $this->incrementer;
    }
}