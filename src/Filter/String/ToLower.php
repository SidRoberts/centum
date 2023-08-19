<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Filters a string to lowercase.
 */
class ToLower implements FilterInterface
{
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return mb_strtolower($value);
    }
}
