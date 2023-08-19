<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Adds a prefix to a string.
 */
class Prefix implements FilterInterface
{
    public function __construct(
        protected readonly string $prefix
    ) {
    }



    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return $this->prefix . $value;
    }
}
