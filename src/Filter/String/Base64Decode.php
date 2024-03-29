<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

/**
 * Base64 decodes a string.
 */
class Base64Decode implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        $decoded = base64_decode($value, true);

        if ($decoded === false) {
            throw new InvalidArgumentException("Value must be a valid base64 string.");
        }

        return $decoded;
    }
}
