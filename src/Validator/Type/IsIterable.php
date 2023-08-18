<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is iterable.
 */
class IsIterable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_iterable($value)) {
            return [
                "Value is not iterable.",
            ];
        }

        return [];
    }
}
