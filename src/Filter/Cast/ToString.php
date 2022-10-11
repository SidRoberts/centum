<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

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

        if (!is_null($value) && !is_object($value) && !is_scalar($value)) {
            throw new InvalidArgumentException();
        }

        return strval($value);
    }
}
