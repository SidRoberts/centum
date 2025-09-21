<?php

namespace Centum\Filter;

use Centum\Interfaces\Filter\FilterInterface;

/**
 * Filters a value based on a callback.
 */
class Callback implements FilterInterface
{
    /**
     * @param callable $callable
     */
    public function __construct(
        protected $callable
    ) {
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
