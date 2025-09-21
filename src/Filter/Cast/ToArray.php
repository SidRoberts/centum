<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;
use UnexpectedValueException;

/**
 * Casts any value to an array.
 */
class ToArray implements FilterInterface
{
    /**
     * @return array<mixed>
     *
     * @throws UnexpectedValueException
     */
    public function filter(mixed $value): array
    {
        if (is_object($value) && method_exists($value, "toArray")) {
            /** @var mixed */
            $value = $value->toArray();

            if (!is_array($value)) {
                throw new UnexpectedValueException(
                    "toArray() did not return an array."
                );
            }
        }

        return (array) $value;
    }
}
