<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class ToInteger implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): int
    {
        if (!is_array($value) && !is_resource($value) && !is_null($value) && !is_scalar($value)) {
            throw new InvalidArgumentException(
                "Value must be an array, a resource, a scalar, or null."
            );
        }

        return intval($value);
    }
}
