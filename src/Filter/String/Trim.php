<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Trims a string.
 */
class Trim implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return mb_trim($value);
    }
}
