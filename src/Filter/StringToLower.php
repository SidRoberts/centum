<?php

namespace Centum\Filter;

use InvalidArgumentException;

class StringToLower implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return mb_strtolower($value);
    }
}
