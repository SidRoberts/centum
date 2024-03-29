<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is an integer or an integer string.
 */
class IsInteger implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (is_bool($value) || !is_scalar($value) || preg_match("/^\d+$/", (string) $value) !== 1) {
            return [
                "Value is not an integer.",
            ];
        }

        return [];
    }
}
