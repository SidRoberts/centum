<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Rot13 implements FilterInterface
{
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException(
                "Value must be a string."
            );
        }

        return str_rot13($value);
    }
}
