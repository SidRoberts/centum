<?php

namespace Centum\Filter\Cast;

use Centum\Filter\FilterInterface;

class ToArray implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (is_object($value) && method_exists($value, "toArray")) {
            return $value->toArray();
        }

        return (array) $value;
    }
}
