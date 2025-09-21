<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Casts resources, scalars, and null values to integers.
 */
class ToInteger implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): int
    {
        if (!is_resource($value) && !is_null($value) && !is_scalar($value)) {
            throw new InvalidArgumentException(
                "Value must be a resource, a scalar, or null."
            );
        }

        return (int) $value;
    }
}
