<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;

class ToString implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (is_object($value) && !method_exists($value, "__toString")) {
            return serialize($value);
        }

        if (is_array($value)) {
            return json_encode($value);
        }

        return (string) $value;
    }
}
