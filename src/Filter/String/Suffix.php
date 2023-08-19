<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Adds a suffix to a string.
 */
class Suffix implements FilterInterface
{
    public function __construct(
        protected readonly string $suffix
    ) {
    }



    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return $value . $this->suffix;
    }
}
