<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;
use JsonException;

/**
 * Casts values to a string. Objects are cast using `__toString()` or are serialised; arrays are JSON encoded.
 */
class ToString implements FilterInterface
{
    /**
     * @throws JsonException
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): string
    {
        if (is_object($value)) {
            if (method_exists($value, "__toString")) {
                return (string) $value;
            }

            return serialize($value);
        }

        if (is_array($value)) {
            $json = json_encode($value);

            if ($json === false) {
                throw new JsonException();
            }

            return $json;
        }

        if (!is_null($value) && !is_scalar($value)) {
            throw new InvalidArgumentException();
        }

        return (string) $value;
    }
}
