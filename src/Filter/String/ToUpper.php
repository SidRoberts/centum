<?php

namespace Centum\Filter\String;

use Centum\Filter\FilterInterface;
use InvalidArgumentException;

class ToUpper implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return mb_strtoupper($value);
    }
}
