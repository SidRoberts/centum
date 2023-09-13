<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Base64 encodes a string.
 */
class Base64Encode implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return base64_encode($value);
    }
}
