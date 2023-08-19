<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Performs the `rot13` transformation on a string.
 */
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
