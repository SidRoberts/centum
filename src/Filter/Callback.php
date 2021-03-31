<?php

namespace Centum\Filter;

class Callback implements FilterInterface
{
    /**
     * @var callable
     */
    protected $callable;



    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }



    public function filter(mixed $value): mixed
    {
        return ($this->callable)($value);
    }
}
