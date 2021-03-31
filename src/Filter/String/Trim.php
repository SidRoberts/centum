<?php

namespace Centum\Filter\String;

use Centum\Filter\FilterInterface;
use InvalidArgumentException;

class Trim implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return trim($value);
    }
}
