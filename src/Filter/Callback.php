<?php

namespace Centum\Filter;

class Callback implements FilterInterface
{
    /** @var callable */
    protected $callable;



    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }



    public function filter(mixed $value): mixed
    {
        return call_user_func_array(
            $this->callable,
            [
                $value,
            ]
        );
    }
}
