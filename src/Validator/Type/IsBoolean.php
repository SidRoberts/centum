<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a boolean.
 */
class IsBoolean implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_bool($value)) {
            return [
                "Value is not boolean.",
            ];
        }

        return [];
    }
}
